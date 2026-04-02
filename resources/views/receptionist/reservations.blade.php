@extends('layouts.app1')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap');
body { font-family: 'DM Sans', sans-serif; }
h1   { font-family: 'Playfair Display', serif; }
</style>

<div class="p-6 max-w-7xl mx-auto">

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
            Reservations Management
        </h1>

        <p class="mt-1 text-xs text-gray-400 uppercase tracking-widest font-light">
            {{ $reservations->total() }} reservations found · Updated today
        </p>
    </div>
</div>


<form method="GET"
      class="bg-white rounded-2xl border border-gray-300 p-5 mb-6
             grid grid-cols-1 md:grid-cols-3 gap-3">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Search by customer name..."
           class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                  focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none">

    <select name="status"
            class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-orange-300 outline-none">

        <option value="">All Status</option>
        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
        <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Confirmed</option>
        <option value="checked_in" {{ request('status')=='checked_in'?'selected':'' }}>Checked In</option>
        <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>

    </select>

    <button class="bg-gray-900 hover:bg-black text-white rounded-lg px-4 py-2.5 text-sm font-medium transition">
        Filter
    </button>
</form>


<div class="bg-white rounded-2xl border border-gray-300 overflow-hidden">

<table class="w-full text-sm text-left">

<thead class="bg-gray-50 border-b border-gray-300">
<tr>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Customer</th>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Room</th>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Check In</th>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Check Out</th>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Status</th>
    <th class="px-6 py-4 text-xs text-gray-400 uppercase text-right">Actions</th>
</tr>
</thead>

<tbody class="divide-y divide-gray-50">

@forelse($reservations as $reservation)
<tr class="hover:bg-gray-50/60 transition">

    <td class="px-6 py-4">
        <p class="font-semibold text-gray-900">
            {{ $reservation->user->name ?? 'Unknown' }}
        </p>
        <p class="text-xs text-gray-400">
            Reservation #{{ $reservation->id }}
        </p>
    </td>

    <td class="px-6 py-4">
        <span class="font-medium text-gray-900">
            Room #{{ $reservation->room_id }}
        </span>
    </td>

    <td class="px-6 py-4">
        {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}
    </td>

    <td class="px-6 py-4">
        {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}
    </td>

    <td class="px-6 py-4">

        @if($reservation->status == 'pending')
            <span class="px-3 py-1 rounded-full text-xs bg-yellow-50 text-yellow-800">
                Pending
            </span>

        @elseif($reservation->status == 'confirmed')
            <span class="px-3 py-1 rounded-full text-xs bg-blue-50 text-blue-800">
                Confirmed
            </span>

        @elseif($reservation->status == 'checked_in')
            <span class="px-3 py-1 rounded-full text-xs bg-green-50 text-green-800">
                Checked In
            </span>

        @else
            <span class="px-3 py-1 rounded-full text-xs bg-red-50 text-red-800">
                Cancelled
            </span>
        @endif

    </td>

    <td class="px-6 py-4">
        <div class="flex justify-end gap-2">

            <a
               class="px-3 py-1.5 text-xs rounded-lg bg-gray-50 border hover:bg-gray-100">
                View
            </a>

            <form method="POST" action="{{route('Reservations.destroy' ,$reservation->id)}}"

                  onsubmit="return confirm('Delete reservation?')">
                @csrf
                @method('DELETE')

                <button class="px-3 py-1.5 text-xs rounded-lg
                               bg-red-50 text-red-800 border border-red-200 hover:bg-red-100">
                    Delete
                </button>
            </form>

        </div>
    </td>

</tr>

@empty
<tr>
<td colspan="6" class="text-center py-16 text-gray-400">
    No reservations found
</td>
</tr>
@endforelse

</tbody>
</table>
</div>


<div class="mt-8 flex justify-center">
    {{ $reservations->appends(request()->query())->links() }}
</div>

</div>
@endsection
