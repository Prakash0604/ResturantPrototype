<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use App\Models\event;
use App\Models\category;
use App\Models\menu_item;
use App\Models\orderfood;
use App\Models\OrderItem;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\tabledata;
use Illuminate\Http\Request;

use PHPUnit\Framework\fileExists;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Category as CalculationCategory;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    // ================Dashboard Controller Start=======================
    public function dashboard()
    {
        $totaluser = User::where("position", "users")->where('is_admin', 0)->count();
        $totalemployee = User::where("position", "employee")->count();
        $totalBillAmount = Bill::whereDate('created_at', date('Y-m-d'))->sum('grand_total');
        $totalBillNumber = Bill::whereDate('created_at', date('Y-m-d'))->count();
        $stocks = Stock::count();
        $suppliers = Supplier::count();
        $purchases = Purchase::count();

        return view('pages.dashboard', compact('totaluser', 'totalemployee', 'totalBillAmount', 'totalBillNumber', 'stocks', 'suppliers', 'purchases'));
    }
    // ================Dashboard Controller End=======================



    // ================Users Controller Start=======================
    public function userstable()
    {
        $users = User::where('is_admin', 0)->where('position', 'users')->get();
        return view('pages.tables', compact('users'));
        // dd($users);
    }
    // ================Users Controller End=======================



    // ================Profile Controller Start=======================
    public function profile()
    {

        return view('pages.profile')->with('user', auth()->user());
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
        ]);
        $filename = null;
        $file = $request->images;
        if ($file != "") {
            $filename = time() . '-' . $file->getclientOriginalName();
            $file->storeAs('public/teams/' . $filename);
            // $users->images=$filename;
        }
        User::where('email', $request->email)->update(
            [

                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'images' => $filename,
            ]
        );
        return back()->with('message', 'Profile has been updated');
    }

    // ================Profile Controller End=======================


    // ================Menu Controller Start=======================
    public function addMenu(Request $request)
    {
        $category = category::where('status',1)->get();
        if ($request->ajax()) {
            $menuitems = menu_item::with('category')->orderBy('id', 'desc')->get();
            return DataTables::of($menuitems)
                ->addIndexColumn()
                ->addColumn('image', function ($image) {
                    if ($image->images != null) {
                        $imagepath = asset('storage/food/' . $image->images);
                    } else {
                        $imagepath = asset('default/user.png');
                    }

                    // return " <img src='$imagepath' class='avatar avatar-sm' alt='user1' width='200' height='200/>";
                    return "<img src='$imagepath' class='avatar avatar-sm img-thumbnail' alt='user1' width='100' height='100'>";
                })
                ->addColumn('category', function ($cat) {
                    return $cat->category->name;
                })
                ->addColumn('action', function ($item) {
                    $btn = '<button type="button" class="btn btn-primary mr-2 editMenu" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger deleteMenu" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        // }
        return view('pages.menu-item', compact('category'));
    }

    public function additem(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'images' => 'mimes:jpeg,jpg,png,webp',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);

            $menu = new menu_item();
            $menu->name = $request->name;
            $file = $request->file('images');
            if ($file != "") {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/food/' . $filename);
                $menu->images = $filename;
            }
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->category_id = $request->category;
            $menu->save();
            return response()->json(['success' => true, "menu" => $menu]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editMenu($id)
    {
        try {
            $menu = menu_item::find($id);
            return response()->json(['success' => true, 'message' => $menu]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateMenu(Request $request)
    {
        try {
            $id = $request->id;
            $menu = menu_item::find($id);
            $current_image = $menu->images;
            if ($request->hasFile('edit_images')) {
                if ($current_image && file_exists(public_path($current_image))) {
                    unlink(public_path($current_image));
                }
                $newimage = $request->file('edit_images');
                $current_image = time() . '.' . $newimage->getClientOriginalExtension();
                $newimage->storeAs('public/food/' . $current_image);
            }
            $menu->name = $request->edit_name;
            $menu->images = $current_image;
            $menu->description = $request->edit_description;
            $menu->price = $request->edit_price;
            $menu->category_id = $request->edit_category;
            $menu->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteItems($id)
    {
        try {
            $category = menu_item::find($id);
            $category->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()]);
        }
    }
    // ================Menu Controller End=======================

    // ================Category Controller Start=======================
    public function addCategory(Request $request)
    {
        try {
            $request->validate([
                'cat_name' => 'required|string|min:3',
            ]);
            // $data=$request->cat_name;
            category::create([
                'name' => $request->cat_name,
            ]);
            return response()->json(['success' => true, 'message' => 'Category added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function showCategory(Request $request)
    {
        if ($request->ajax()) {
            $categories = category::orderBy('id','desc')->get();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button type="button" class="btn btn-primary mr-2 editcat" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#editCat">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger deletecat" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#deleteCat">Delete</button>';
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    return '<div class="form-check form-switch mx-auto">
                <input class="form-check-input mx-auto statusCheckBoxBtn" data-id="' . $status->id . '" type="checkbox" role="switch" id="flexSwitchCheckDefault" ' . ($status->status ? 'checked' : '') . '>
             </div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.categorylist');
    }

    public function statusCategory($id)
    {
        try {
            $cat = category::find($id);
            if ($cat->status == 1) {
                $cat->status = 0;
            } else {
                $cat->status = 1;
            }
            $cat->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function editcat($id)
    {
        $cat = category::find($id);
        return response()->json(['cat' => $cat]);
    }

    public function updateCat(Request $request)
    {
        try {
            $id = $request->id;
            $catcategory = category::find($id)->update([
                'name' => $request->edit_cat_name,
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteCat($id)
    {
        try {
            $category = category::find($id);
            $category->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()]);
        }
    }
    // ================Category Controller End=======================


    // ========Event Controller start===============

    public function event()
    {
        $events = event::all();
        return view('pages.event', compact('events'));
    }

    public function eventAdd(Request $request)
    {
        try {
            $request->validate([
                'event_name' => 'required|string|min:4',
                'event_description' => 'required|string',
                'event_price' => 'required|numeric',
                'event_images' => 'required|mimes:jpg,jpeg,png'
            ]);
            $event = new event();
            $event->event_name = $request->event_name;
            $event->event_desc = $request->event_description;
            $event->event_price = $request->event_price;
            $images = $request->file('event_images');
            if ($images != "") {
                $filename = time() . '-' . $images->getClientOriginalName();
                $images->storeAs('public/event/' . $filename);
                $event->event_image = $filename;
            }
            $event->save();
            return response()->json(['success' => true, 'message' => $event]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editEvent($id)
    {
        try {
            $events = event::find($id);
            return response()->json(['success' => true, 'message' => $events]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }

    public function updateEvent(Request $request)
    {
        try {
            $id = $request->id;
            $event = event::find($id);
            if (!$event) {
                return response()->json(['success' => false, 'message' => 'Event not found']);
            }
            $imagename = $event->event_image;
            if ($request->hasFile("edit_event_images")) {
                if ($imagename && file_exists(public_path('storage/event/' . $imagename))) {
                    unlink(public_path('storage/event/' . $imagename));
                }
                $image = $request->file('edit_event_images');
                $imagename = time() . '.' . $image->getclientOriginalName();
                $image->storeAs('public/event/' . $imagename);
            }

            $event->update([
                'event_name' => $request->edit_event_name,
                'event_desc' => $request->edit_event_description,
                'event_image' => $imagename,
                'event_price' => $request->edit_event_price,
                'status' => $request->edit_status,
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteEvent($id)
    {
        try {
            $id = event::find($id);
            $id->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    // ========Event Controller End===============

    // =======Teams Member Start =================

    public function Employeelist(Request $request)
    {
        if ($request->ajax()) {
            $employees = User::all();
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('empImage', function ($image) {
                    if ($image->images != null) {
                        $imagepath = asset('storage/teams/' . $image->images);
                    } else {
                        $imagepath = asset('default/user.png');
                    }

                    // return " <img src='$imagepath' class='avatar avatar-sm' alt='user1' width='200' height='200/>";
                    return "<img src='$imagepath' class='avatar avatar-sm img-thumbnail' alt='user1' width='100' height='100'>";
                })
                ->addColumn('action', function ($item) {
                    $btn = '<button type="button" class="btn btn-primary mr-2 editEmployee" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger deleteEmployee" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
                    return $btn;
                })
                ->addColumn('status', function ($status) {
                    return '<div class="form-check form-switch mx-auto">
                    <input class="form-check-input mx-auto statusCheckBoxBtn" data-id="' . $status->id . '" type="checkbox" role="switch" id="flexSwitchCheckDefault" ' . ($status->is_verified ? 'checked' : '') . '>
                 </div>';
                })
                ->rawColumns(['action', 'empImage', 'status'])
                ->make(true);
        };
        return view('pages.employee');
    }

    // Status Update
    public function statusEmployee($id)
    {
        try {
            $user = User::find($id);
            if ($user->is_verified == 1) {
                $user->is_verified = 0;
            } else {
                $user->is_verified = 1;
            }
            $user->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function addEmployee(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3',
                'image' => 'mimes:jpg,png,jpeg',
                'email' => 'required|email|unique:users',
                'phone' => 'required|min:10|numeric',
                'address' => 'required',
                'designation' => 'required|string|min:3',
                'password' => 'required|min:6'
            ]);
            $employee = new User();
            $employee->name = $request->name;
            $image = $request->file('image');
            if ($image) {

                $imagepath = time() . '.' . $image->getClientOriginalName();
                $image->storeAs('public/teams/' . $imagepath);
                $employee->images = $imagepath;
            }
            $employee->address = $request->address;
            $employee->password = $request->password;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->position = "employee";
            $employee->designation = $request->designation;
            $employee->is_verified = 1;
            $employee->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function editEmployee($id)
    {
        try {
            $id = User::find($id);
            return response()->json(['success' => true, 'data' => $id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateEmployee(Request $request)
    {
        try {
            $id = $request->id;
            $users = User::find($id);
            $current_image = $users->images;
            if ($request->hasFile('edit_images')) {
                if ($current_image && file_exists(public_path('storage/teams/' . $current_image))) {
                    unlink(public_path('storage/teams/' . $current_image));
                }
                $image = $request->file('edit_images');
                $current_image = time() . '.' . $image->getClientOriginalName();
                $image->storeAs('public/teams/' . $current_image);
            }
            $data = request(['edit_name', 'edit_address', 'edit_phone', 'edit_email', 'edit_designation', $current_image]);
            // $users->update([
            //     'images'=>$current_image,
            //     'name'=>request('edit_name'),
            //     'address'=>request('edit_address'),
            //     'phone'=>request('edit_phone'),
            //     'email'=>request('edit_email'),
            //     'designation'=>request('edit_designation'),
            // ]);
            $users->images = $current_image;
            $users->email = $request->edit_email;
            $users->name = $request->edit_name;
            $users->address = $request->edit_address;
            $users->phone = $request->edit_phone;
            $users->designation = $request->edit_designation;
            $users->is_verified = $request->edit_status;
            $users->save();
            return response()->json(['success' => true, 'message' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteEmployee($id)
    {
        try {
            $users = User::find($id);
            if ($users != "") {
                $users->delete();
                return response()->json(['success' => true, "message" => $users]);
            } else {
                return response()->json(['success' => false, 'message' => 'User Already deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    // =======Teams Member End ===================

    public function Tabledata(Request $request)
    {
        if($request->ajax()){
            $tabledatas = tabledata::orderBy('id','desc')->get();
            return DataTables::of($tabledatas)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                // $btn = '<button type="button" class="btn btn-primary mr-2 editEmployee" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                return  '<button type="button" class="btn btn-danger deleteTable" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.booktable');
    }
    public function addTabledata(Request $request)
    {
        try {
            $request->validate([
                'table_number' => 'required',
                'seat_capicity' => 'required',
            ]);
            tabledata::create([
                'table_number' => $request->table_number,
                'seat_capicity' => $request->seat_capicity,
                'status' => $request->status
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteTabledata($id)
    {
        try {
            $tabledata = tabledata::find($id);
            if ($tabledata != "") {
                $tabledata->delete();
                return response()->json(["success" => true, 'message' => 'Table deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Table has been already deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function reservedTable() {}

    public function OrderTable()
    {
        $users = orderfood::with(['menu', 'user'])->get();
        return view('pages.orderTable', compact('users'));
    }

    public function orderStatus(Request $request, $id)
    {
        try {
            $order = orderfood::find($id);
            $status = $request->status;
            $order->status = $status;
            $order->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, $e->getMessage()]);
        }
    }
}
