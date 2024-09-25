<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillOrderItem;
use App\Models\Order;
use App\Models\menu_item;
use App\Models\OrderItem;
use App\Models\tabledata;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $tables = tabledata::where('status', 'Available')->get();
        $menus = menu_item::all();
        $orders = OrderItem::with(['Order', 'menu'])->whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->get()->groupBy('order_id');
        return view('pages.orders', compact('tables', 'menus', 'orders'));
    }


    public function previousPending()
    {
        $tables = tabledata::where('status', 'Available')->get();
        $menus = menu_item::all();
        $orders = OrderItem::with(['Order', 'menu'])->whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->get()->groupBy('order_id');
        $pending = OrderItem::with(['Order', 'menu'])->where('status', 0)->whereDate('created_at', '<', Carbon::today())->orderBy('id', 'desc')->get()->groupBy('order_id');
        return view('pages.pendingPreviousOrder', compact('tables', 'menus', 'orders', 'pending'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_no' => 'required',
            'menu_items' => 'required|array',
        ]);

        $order = Order::create([
            'table_id' => $request->table_no
        ]);

        $table = tabledata::where('id', $order->table_id)->first();
        if ($table) {
            $table->status = 'Reserved';
            $table->save();
        }

        foreach ($request->menu_items as $menuId) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menuId
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order saved successfully!'
        ], 200);
    }

    public function delete($id, $table_id)
    {
        try {
            tabledata::where('id', '=', $table_id)->update([
                'status' => 'Available',
            ]);
            // First, delete OrderItems based on the original order ID
            $order_id = $id; // Store original order ID
            $orderItemDeleteCount = OrderItem::where('order_id', $order_id)->delete();

            // Check if any OrderItems were deleted, then proceed to delete the Order
            if ($orderItemDeleteCount > 0) {
                // Delete the Order using the original order ID
                Order::where('id', $order_id)->delete();
            }
            return response()->json(['success' => true, 'message' => $id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    // Controller for editing order
    public function edit($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        return response()->json([
            'success' => true,
            'orderItems' => $orderItems
        ]);
    }

    public function update(Request $request, $orderId)
    {
        OrderItem::where('order_id', $orderId)->delete();

        foreach ($request->menu_id as $menuId) {
            OrderItem::create([
                'order_id' => $orderId,
                'menu_id' => $menuId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully'
        ]);
    }

    public function getOrderDetails($orderId)
    {
        $orderItems = OrderItem::with(['menu', 'order'])->where('order_id', $orderId)->get();

        return response()->json([
            'success' => true,
            'orderItems' => $orderItems
        ]);
    }

    public function saveBill(Request $request)
    {
        // dd($request->all());
        try {

            $validatedData = $request->validate([
                'tables_id' => 'required|array',
                'menus_id' => 'required|array',
                'price' => 'required|array',
                'tax' => 'numeric|min:0',
                'discount' => 'numeric|min:0',
                'service_charge' => 'numeric|min:0',
            ]);

            $bill = new Bill();
            $bill->total_amount = $request->input('subTotal');
            $bill->tax = $request->input('tax');
            $bill->discount = $request->input('discount');
            $bill->service_charge = $request->input('service_charge');
            $bill->grand_total = $request->input('totalAmount');
            $bill->status = 1;
            if (!empty($request->tables_id)) {
                $bill->order_id = $request->tables_id[0];
            }
            OrderItem::where('order_id', $request->tables_id[0])->update([
                'status' => 1,
            ]);

            tabledata::where('id', $request->getTableid)->update([
                'status' => 'Available',
            ]);


            $bill->created_by = Auth::id();
            $bill->save();


            foreach ($request->menus_id as $key => $menu_id) {
                if (isset($request->tables_id[$key]) && isset($request->price[$key]) && isset($request->menus_id[$key])) {
                    $orderItem = new BillOrderItem();
                    $orderItem->order_id = $request->tables_id[$key];
                    $orderItem->menu_id = $request->menus_id[$key];
                    $orderItem->price = $request->price[$key];
                    $orderItem->bill_id = $bill->id;
                    $orderItem->save();
                } else {
                    return response()->json(['success' => false, 'message' => 'Invalid data at index ' . $key], 400);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Bill generated successfully',
                'bill_id' => $bill->id
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function viewBill($orderId)
    {
        $bill = Bill::where('order_id', $orderId)
            ->with(['billOrderItems.menuItem', 'billOrderItems.order']) // Fetch related items
            ->first();

        if (!$bill) {
            return redirect()->back()->with('error', 'No bill found for this order.');
        }

        return view('pages.printBill', compact('bill'));
    }

    public function listBills()
    {
        $bills = Bill::with('order')->whereDate('created_at', date('Y-m-d'))->paginate(10);
        return view('pages.BillList', compact('bills'));
    }
}
