<?php

namespace App\Http\Controllers;

use App\Models\orderfood;
use Illuminate\Http\Request;

class EsewaController extends Controller
{
    public function index()
    {
        // Return a payment page view where users can trigger the eSewa payment
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Test credentials and URLs
        $amt=$request->input('amt');
        $tax=20;
        $menu_item=$request->input('menu_item');

        $total=$amt+$tax;
        $unique_id=uniqid();
        $esewa_url = 'https://uat.esewa.com.np/epay/main';
        $success_url = route('payment.success');
        $failure_url = route('payment.failure');


        // Payment request payload
        $data = [
            'amt' => $amt, // Payment amount
            'pdc' => 0, // Tax amount
            'psc' => 0, // Service charge
            'txAmt' => $tax, // Delivery charge or additional charge
            'tAmt' => $total, // Total amount
            'pid' => $unique_id, // Unique ID for transaction
            'scd' => 'epay_payment', // Merchant code (test mode)
            'su'  => $success_url, // Success URL
            'fu'  => $failure_url, // Failure URL
        ];
        orderfood::create([
            'transaction_id'=>$unique_id,
            'user_id'=>auth()->user()->id,
            'menu_item_id'=>$menu_item,
            'price'=>$amt,
            'total_amount'=>$total,
        ]);

        // Redirecting to eSewa payment page
        $query = http_build_query($data);
        return redirect("{$esewa_url}?{$query}");
    }

    public function paymentSuccess(Request $request)
    {
        // Handle success response from eSewa
        $refId = $request->input('refId');
        return 'Payment Successful with Reference ID: ' . $refId;
        // return redirect('/')
    }

    public function paymentFailure()
    {
        return 'Payment Failed!';
    }
}
