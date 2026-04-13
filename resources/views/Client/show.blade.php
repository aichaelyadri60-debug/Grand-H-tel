@extends('layouts.app1')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Détail Réservation
            </h1>
            <p class="text-sm text-slate-400">
                Réservation #{{ $reservation->id }} • {{ $reservation->created_at->format('d M Y') }}
            </p>
        </div>

        <a href="{{ route('client.reservations') }}"
           class="text-sm text-amber-600 hover:underline">
            ← Retour
        </a>
    </div>

    {{-- STATUS --}}
    <div class="flex gap-3">

        <span class="px-3 py-1 text-xs rounded-full
            {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-700' :
               ($reservation->status === 'cancelled' ? 'bg-gray-200 text-gray-700' :
               'bg-yellow-100 text-yellow-700') }}">
            {{ ucfirst($reservation->status) }}
        </span>

        <span class="px-3 py-1 text-xs rounded-full
            {{ optional($reservation->payment)->status === 'paid'
                ? 'bg-blue-100 text-blue-700'
                : 'bg-red-100 text-red-700' }}">
            {{ optional($reservation->payment)->status === 'paid' ? 'Payé' : 'Non payé' }}
        </span>

    </div>

    {{-- MAIN CARD --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">

        {{-- ROOM IMAGE --}}
        @if($reservation->room && $reservation->room->image)
            <img src="{{ asset('storage/'.$reservation->room->image) }}"
                 class="w-full h-64 object-cover">
        @endif

        <div class="p-6 space-y-6">

            {{-- ROOM INFO --}}
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-slate-800">
                        Chambre {{ $reservation->room->roomNumber ?? 0 }}
                    </h2>
                    <p class="text-sm text-slate-400">
                        Chambre réservée
                    </p>
                </div>

                <span class="text-lg font-semibold text-amber-600">
                    {{ $reservation->total_price ?? 0 }} MAD
                </span>
            </div>

            {{-- DETAILS --}}
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400">Date début</p>
                    <p class="font-medium text-slate-800">
                        {{ $reservation->check_in }}
                    </p>
                </div>

                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400">Date fin</p>
                    <p class="font-medium text-slate-800">
                        {{ $reservation->check_out }}
                    </p>
                </div>

                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400">Durée</p>
                    <p class="font-medium text-slate-800">
                        {{ floor(\Carbon\Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out) )}} jours
                    </p>
                </div>

            </div>

            {{-- PAYMENT DETAILS --}}
            <div class="border-t pt-4">
                <h3 class="text-sm font-semibold text-slate-600 mb-3">
                    Paiement
                </h3>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-xs text-slate-400">Méthode</p>
                        <p class="text-sm text-slate-700">
                            {{ $reservation->payment->method ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">Date paiement</p>
                        <p class="text-sm text-slate-700">
                            {{ $reservation->payment->paid_at ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="flex gap-3 flex-wrap pt-4 border-t">

                {{-- FACTURE --}}
                @if(($reservation->payment?->invoice))
                    <a  href="{{route('invoice.print' ,$reservation->id)}}"
                       target="_blank"
                       class="px-5 py-2 text-sm text-white rounded-xl
                              bg-gradient-to-r from-amber-500 to-amber-400
                              hover:from-amber-600 hover:to-amber-500">
                         Télécharger facture
                    </a>
                @endif

                {{-- ANNULER --}}
                @if(
                    $reservation->status !== 'confirmed' &&
                    $reservation->status !== 'cancelled' &&
                    ($reservation->payment)->status !== 'paid'
                )
                    <form method="POST"
                          action="{{ route('client.reservation.cancel', $reservation->id) }}">
                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Annuler cette réservation ?')"
                            class="px-5 py-2 text-sm text-red-700 bg-red-100 border border-red-300 rounded-xl hover:bg-red-200">
                            Annuler réservation
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>

</div>
@endsection
