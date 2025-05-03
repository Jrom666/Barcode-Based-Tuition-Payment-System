<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request){
        Payment::create([
            'student_id' => $request->student_id,
            'cashier_id' => auth()->id(), // assumes user is logged in
            'amount' => $request->amount,
            'term' => $request->term,
            'payment_date' => $request->payment_date,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'reference_number' => $request->reference,
        ]);

        // Redirect or return response
        return redirect('payment')->with('success', 'Payment recorded successfully!');;
    }
}


