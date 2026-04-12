<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture</title>

    <style>
        body {
            font-family: DejaVu Sans;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .invoice-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }

        .small-text {
            font-size: 12px;
            color: #6b7280;
        }

        .section {
            margin-top: 25px;
        }

        .section h3 {
            font-size: 13px;
            color: #9ca3af;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .section p {
            margin: 3px 0;
            color: #374151;
            font-size: 14px;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th {
            background: #f9fafb;
            padding: 10px;
            font-size: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            padding: 10px;
            font-size: 13px;
            border-bottom: 1px solid #f1f5f9;
        }

        .total {
            margin-top: 25px;
            text-align: right;
        }

        .total span {
            display: block;
            font-size: 14px;
            color: #6b7280;
        }

        .total strong {
            font-size: 22px;
            color: #16a34a;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

<div class="invoice-box">

    {{-- HEADER --}}
    <div class="header">
        <div>
            <div class="title">Facture Hôtel</div>
            <div class="small-text">Merci pour votre confiance</div>
        </div>

        <div class="small-text" style="text-align:right;">
            <p><strong>Réf :</strong> {{ $invoice->invoice_number }}</p>
            <p><strong>Date :</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    {{-- CLIENT --}}
    <div class="section">
        <h3>Client</h3>
        <p><strong>Nom :</strong> {{ $invoice->payment->reservation->user->name }}</p>
        <p><strong>Email :</strong> {{ $invoice->payment->reservation->user->email }}</p>
    </div>

    {{-- TABLE DETAILS --}}
    <div class="section">
        <h3>Détails de réservation</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Chambre</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Nombre de nuits</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->payment->reservation->room->roomNumber }}</td>
                    <td>{{ $invoice->payment->reservation->check_in }}</td>
                    <td>{{ $invoice->payment->reservation->check_out }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($invoice->payment->reservation->check_in)
                        ->diffInDays($invoice->payment->reservation->check_out) }}
                    </td>
                    <td>{{ $invoice->amount }} MAD</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- TOTAL --}}
    <div class="total">
        <span>Total à payer</span>
        <strong>{{ $invoice->amount }} MAD</strong>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        © {{ date('Y') }} Hôtel - Tous droits réservés
    </div>

</div>

</body>
</html>
