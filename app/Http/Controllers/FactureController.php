<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;

class FactureController extends Controller
{

public function print(Reservation $reservation)
{
    if ($reservation->user_id !== auth()->id()) {
        abort(403);
    }

    if (!$reservation->payment) {
        return back()->with('error', 'Aucun paiement trouvé');
    }

    $payment = $reservation->payment;

    if (!$payment->invoice) {
        $invoice = $payment->invoice()->create([
            'user_id' => $reservation->user->id,
            'invoice_number' => 'INV-' . time(),
            'amount' => $payment->amount
        ]);
    } else {
        $invoice = $payment->invoice;
    }

    $pdf = pdf::loadView('invoices.pdf', compact('invoice'));

    return $pdf->download('facture-' . $invoice->invoice_number . '.pdf');
}
}
