{{-- resources/views/receptionist/dashboard.blade.php --}}
@extends('layouts.app1')
@section('content')
<div class="min-h-screen bg-gray-100 p-6">

  {{-- TOPBAR --}}
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-lg font-semibold text-gray-800">Tableau de bord</h1>
      <p class="text-xs text-gray-500 mt-0.5">Réception · Vue d'ensemble</p>
    </div>
    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium
                 bg-amber-50 text-amber-700 border border-amber-200">
      <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
      En direct
    </span>
  </div>

  {{-- KPI CARDS --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">

    <div class="bg-white rounded-xl border border-gray-200 p-4">
      <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
          <circle cx="8" cy="5" r="3"/><path stroke-linecap="round" d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
        </svg>
      </div>
      <p class="text-xs text-gray-400 mb-1">Total clients</p>
      <p class="text-2xl font-semibold text-gray-900">{{ $totalClients }}</p>
      <p class="text-xs text-gray-400 mt-1">Tous rôles</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4">
      <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center mb-3">
        <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
          <rect x="2" y="4" width="12" height="10" rx="2"/>
          <path stroke-linecap="round" d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1M6 8h4M6 11h2"/>
        </svg>
      </div>
      <p class="text-xs text-gray-400 mb-1">Chambres</p>
      <p class="text-2xl font-semibold text-gray-900">{{ $totalRooms }}</p>
      <p class="text-xs text-gray-400 mt-1">Total inventaire</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4">
      <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center mb-3">
        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
          <rect x="2" y="3" width="12" height="11" rx="2"/>
          <path stroke-linecap="round" d="M5 2v2M11 2v2M2 7h12"/>
        </svg>
      </div>
      <p class="text-xs text-gray-400 mb-1">Réservations aujourd'hui</p>
      <p class="text-2xl font-semibold text-gray-900">{{ $todayReservations }}</p>
      <p class="text-xs text-gray-400 mt-1">Depuis minuit</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4">
      <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center mb-3">
        <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
          <circle cx="8" cy="8" r="6"/>
          <path stroke-linecap="round" d="M8 5v3.5l2 1.5"/>
        </svg>
      </div>
      <p class="text-xs text-gray-400 mb-1">En attente</p>
      <p class="text-2xl font-semibold text-gray-900">{{ $pending }}</p>
      <p class="text-xs text-gray-400 mt-1">À traiter</p>
    </div>

  </div>

  {{-- STATUS STRIP --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div class="bg-amber-50 rounded-xl p-4">
      <p class="text-xl font-semibold text-amber-800">{{ $pending }}</p>
      <p class="text-xs text-amber-600 mt-0.5">En attente</p>
    </div>
    <div class="bg-green-50 rounded-xl p-4">
      <p class="text-xl font-semibold text-green-800">{{ $accepted }}</p>
      <p class="text-xs text-green-600 mt-0.5">Acceptées</p>
    </div>
    <div class="bg-red-50 rounded-xl p-4">
      <p class="text-xl font-semibold text-red-800">{{ $cancelled }}</p>
      <p class="text-xs text-red-600 mt-0.5">Annulées</p>
    </div>
  </div>

  {{-- CHARTS --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-5">

    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-sm font-medium text-gray-700 mb-3">Répartition des statuts</p>
      <div class="flex gap-4 text-xs text-gray-400 mb-3">
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-amber-600 inline-block"></span>En attente</span>
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-green-600 inline-block"></span>Acceptées</span>
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-red-500 inline-block"></span>Annulées</span>
      </div>
      <div class="relative h-48">
        <canvas id="doughnutChart"></canvas>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
      <p class="text-sm font-medium text-gray-700 mb-3">Réservations — 7 derniers jours</p>
      <div class="flex gap-4 text-xs text-gray-400 mb-3">
        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-sm bg-blue-500 inline-block"></span>Réservations</span>
      </div>
      <div class="relative h-48">
        <canvas id="lineChart"></canvas>
      </div>
    </div>

  </div>

  {{-- TABLE --}}
  <div class="bg-white rounded-xl border border-gray-200 p-5">
    <p class="text-sm font-medium text-gray-700 mb-4">Dernières réservations</p>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-100">
            <th class="text-left text-xs text-gray-400 font-medium pb-2">Client</th>
            <th class="text-left text-xs text-gray-400 font-medium pb-2">Chambre</th>
            <th class="text-left text-xs text-gray-400 font-medium pb-2">Date</th>
            <th class="text-left text-xs text-gray-400 font-medium pb-2">Statut</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          @foreach($latestReservations as $r)
          <tr>
            <td class="py-2.5 text-gray-800">{{ $r->user->name ?? '—' }}</td>
            <td class="py-2.5 text-gray-600">{{ $r->room->name ?? 'Chambre ' . $r->room_id }}</td>
            <td class="py-2.5 text-gray-500">{{ $r->created_at->format('d M Y') }}</td>
            <td class="py-2.5">
              @if($r->status === 'pending')
                <span class="px-2 py-0.5 rounded-full text-xs bg-amber-50 text-amber-700">En attente</span>
              @elseif($r->status === 'accepted')
                <span class="px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-700">Acceptée</span>
              @else
                <span class="px-2 py-0.5 rounded-full text-xs bg-red-50 text-red-700">Annulée</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
  new Chart(document.getElementById('doughnutChart'), {
    type: 'doughnut',
    data: {
      labels: ['En attente', 'Acceptées', 'Annulées'],
      datasets: [{
        data: @json([ $pending ,  $accepted ,  $cancelled ]),
        backgroundColor: ['#d97706', '#16a34a', '#ef4444'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '68%',
      plugins: { legend: { display: false } }
    }
  });

  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'],
      datasets: [{
        label: 'Réservations',
        data: [3, 5, 4, 8, 6, 9, {{ $todayReservations }}],
        borderColor: '#3b82f6',
        backgroundColor: 'rgba(59,130,246,0.07)',
        borderWidth: 1.5,
        pointBackgroundColor: '#3b82f6',
        pointRadius: 3,
        tension: 0.4, fill: true
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#9ca3af' } },
        y: { beginAtZero: true, grid: { color: 'rgba(156,163,175,0.15)' },
             ticks: { font: { size: 11 }, color: '#9ca3af', stepSize: 2 } }
      }
    }
  });
</script>
@endpush

@endsection
