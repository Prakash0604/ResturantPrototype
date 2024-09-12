<?php

namespace App\Http\Controllers;

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
        $esewa_url = 'https://uat.esewa.com.np/epay/main';
        $success_url = route('payment.success');
        $failure_url = route('payment.failure');
        // Payment request payload
        $scharge=20;
        $totalamt=$amt+$scharge;
        $data = [
            'amt' => $amt, // Payment amount
            'pdc' => 0, // Tax amount
            'psc' =>0, // Service charge
            'txAmt' => $scharge, // Delivery charge or additional charge
            'tAmt' => $totalamt, // Total amount
            'pid' => '1234567890abcdef', // Unique ID for transaction
            'scd' => 'epay_payment', // Merchant code (test mode)
            'su'  => $success_url, // Success URL
            'fu'  => $failure_url, // Failure URL
        ];

        // Redirecting to eSewa payment page
        $query = http_build_query($data);
        return redirect("{$esewa_url}?{$query}");
    }

    public function paymentSuccess(Request $request)
    {
        // Handle success response from eSewa
        $refId = $request->input('refId'); // Transaction reference ID from eSewa

        // Here you could verify the payment status with eSewa's verify endpoint (optional)
        // TODO: Implement verification if required

        return 'Payment Successful with Reference ID: ' . $refId;
    }

    public function paymentFailure()
    {
        return 'Payment Failed!';
    }
}
