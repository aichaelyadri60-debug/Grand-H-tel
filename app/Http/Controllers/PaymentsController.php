<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentsController extends Controller
{
    public function pay(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'method' => 'cash'
        ]);
        Invoice::create([
            'payment_id' => $payment->id,
            'user_id' => $payment->reservation->user_id,
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'amount' => $payment->amount,
            'issued_at' => now(),
        ]);

        return back()->with('success', 'Payment completed');
    }
}
