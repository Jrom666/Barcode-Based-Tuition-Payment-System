<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Payment::with(['student', 'cashier'])
            ->latest()
            ->paginate(10);

        // Calculate stats
        $totalAmount = $transactions->sum('amount');
        $paidCount = $transactions->where('status', 'Paid')->count();
        $pendingCount = $transactions->where('status', 'Pending')->count();

        return view('transactions', compact('transactions', 'totalAmount', 'paidCount', 'pendingCount'));
    }
}
