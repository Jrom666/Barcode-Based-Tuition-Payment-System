<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $payments = Payment::all();
        return view('transactions',compact('payments'));
    }
}
