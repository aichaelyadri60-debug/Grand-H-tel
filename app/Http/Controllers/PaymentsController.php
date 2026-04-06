<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function pay(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'method' => 'cash'
        ]);

        return back()->with('success', 'Payment completed');
    }
}
