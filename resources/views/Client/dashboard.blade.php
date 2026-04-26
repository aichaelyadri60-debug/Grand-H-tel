@extends('layouts.app1')

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">Mon Dashboard</h1>
                <p class="text-xs text-gray-500 mt-0.5">Vue de vos réservations</p>
            </div>

            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium
                 bg-blue-50 text-blue-700 border border-blue-200">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                Actif
            </span>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-5">

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-xs text-gray-400 mb-1">Total Réservations</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalReservations }}</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-xs text-gray-400 mb-1">Réservations Payées</p>
                <p class="text-2xl font-semibold text-green-600">{{ $paidReservations }}</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <p class="text-xs text-gray-400 mb-1">En attente</p>
                <p class="text-2xl font-semibold text-amber-600">{{ $pendingReservations }}</p>
            </div>

        </div>





        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm font-medium text-gray-700 mb-4">Mes réservations</p>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left text-xs text-gray-400 pb-2">Chambre</th>
                            <th class="text-left text-xs text-gray-400 pb-2">Début</th>
                            <th class="text-left text-xs text-gray-400 pb-2">Fin</th>
                            <th class="text-left text-xs text-gray-400 pb-2">Statut</th>
                            <th class="text-left text-xs text-gray-400 pb-2">Paiement</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse($reservations as $reservation)
                            <tr>

                                <td class="py-2.5 text-gray-800">
                                    {{ $reservation->room->roomNumber ?? 'N/A' }}
                                </td>

                                <td class="py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}
                                </td>

                                <td class="py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}
                                </td>

                                <td class="py-2.5">
                                    @if ($reservation->status === 'confirmed')
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-700">Confirmée</span>
                                    @elseif($reservation->status === 'pending')
                                        <span class="px-2 py-0.5 rounded-full text-xs bg-amber-50 text-amber-700">En
                                            attente</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs bg-red-50 text-red-700">Annulée</span>
                                    @endif
                                </td>

                                <td class="py-2.5">
                                    @if ($reservation->payment && $reservation->payment->status === 'paid')
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-700">Payé</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs bg-red-50 text-red-700">Non
                                            payé</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-400">
                                    Aucune réservation
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        <div class="mt-10 flex justify-center">
            <div class="pagination-wrapper">
                {{ $reservations->links() }}
            </div>

        </div>

    </div>
@endsection
