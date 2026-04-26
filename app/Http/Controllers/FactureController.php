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

    $invoiceNumber = 'INV-' . now()->format('YmdHis');

    $pdf = Pdf::loadView('invoices.pdf', [
        'reservation' => $reservation,
        'payment' => $payment,
        'invoiceNumber' => $invoiceNumber
    ]);

    return $pdf->download('facture-' . $invoiceNumber . '.pdf');
}
}
