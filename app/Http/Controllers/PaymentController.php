<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payments(Request $request)
        {
            $validated = $request->validate([
                'student_id' => 'required|exists:student,id',
                'cashier_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:0.01',
                'term' => 'required|in:Prelim,Midterms,Prefinal,Finals',
                'status' => 'required|in:Partial,Paid,Pending,Cancelled',
                'payment_date' => 'required|date',
                'payment_method' => 'nullable|string|max:255',
                'reference_number' => 'nullable|string|max:255',
            ]);

            Payment::create([
                'student_id' => $request->student_id,
                'cashier_id' => auth()->id(), // assumes user is logged in
                'amount' => $request->amount,
                'term' => $request->term,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'reference_number' => $request->reference_number,
            ]);
    
            // Redirect or return response
            return redirect()->back()->with('success', 'Payment recorded successfully!');;
        }


}
