@extends('layouts.app1')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
                    Mes Réservations
                </h1>

                <p class="mt-1 text-xs text-gray-400 uppercase tracking-widest font-light">
                    {{ $reservations->total() }} réservations
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-300 overflow-hidden">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Réservation</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Date</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Statut</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Paiement</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-50/60 transition">

                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">
                                    #{{ $reservation->id }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $reservation->created_at?->format('d M Y') }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $reservation->created_at?->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($reservation->status === 'confirmed')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Confirmée
                                    </span>
                                @elseif($reservation->status === 'cancelled')
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700">
                                        Annulée
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        En attente
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if (optional($reservation->payment)->status === 'paid')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        Payé
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Non payé
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- Voir  --}}
                                    <a href="{{route('detailReservation' , $reservation->id)}}"
                                        class="px-4 py-2 text-xs font-medium
                               text-blue-700 bg-blue-100 border border-blue-300
                               rounded-lg hover:bg-blue-200">
                                        Voir
                                    </a>

                                    {{-- FACTURE --}}
                                    @if ($reservation->status === 'confirmed')
                                        <a href="{{route('invoice.print' ,$reservation->id)}}" target="_blank"
                                            class="px-4 py-2 text-xs font-medium
                                   text-green-700 bg-green-100 border border-green-300
                                   rounded-lg hover:bg-green-200">
                                            Imprimer facture
                                        </a>
                                    @endif

                                    @if (
                                        $reservation->status !== 'confirmed' &&
                                            $reservation->status !== 'cancelled' &&
                                            optional($reservation->payment)->status !== 'paid')
                                        <form method="POST" @csrf @method('DELETE') <button
                                            onclick="return confirm('Annuler cette réservation ?')"
                                            class="px-4 py-2 text-xs font-medium
                                        text-red-700 bg-red-100 border border-red-300
                                        rounded-lg hover:bg-red-200">
                                            Annuler
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-16 text-gray-400">
                                Aucune réservation trouvée
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-8 flex justify-center">
            {{ $reservations->links() }}
        </div>

    </div>
@endsection
