<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request; 


class PaymentController extends Controller
{
    public function index() {
        $payments = Payment::with('user')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create() {
        $members = User::where('role', 'member')->get();
        return view('admin.payments.create', compact('members'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,due,pending'
        ]);

        Payment::create($request->all());
        return redirect('/payments')->with('success', 'Payment recorded!');
    }
}
