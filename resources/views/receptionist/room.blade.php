@extends('layouts.app1')
@section('content')


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap');

        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <div class="p-6 max-w-7xl mx-auto">


        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
                    Rooms Management
                </h1>
                <p class="mt-1 text-xs text-gray-400 uppercase tracking-widest font-light">
                    {{ $rooms->total() }} rooms found &nbsp;·&nbsp; Last updated today
                </p>
            </div>

            <a href="{{ route('createRoom') }}"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium
              bg-gradient-to-br from-[#D85A30] to-[#EF9F27]
              hover:opacity-90 transition shadow-md shadow-orange-200">
                <span
                    class="w-5 h-5 bg-white/25 rounded-full flex items-center justify-center text-base leading-none">+</span>
                Add Room
            </a>
        </div>




        <form method="GET"
            class="bg-white rounded-2xl border border-gray-300 p-5 mb-6
               grid grid-cols-1 md:grid-cols-4 gap-3 items-center">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search rooms…"
                class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                  focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none transition">

            <select name="status"
                class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-orange-300 outline-none transition">
                <option value="all">All Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>

            <select name="type"
                class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-orange-300 outline-none transition">
                <option value="all">All Types</option>
                <option value="Single" {{ request('type') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Double" {{ request('type') == 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
            </select>

            <button
                class="bg-gray-900 hover:bg-black text-white rounded-lg px-4 py-2.5 text-sm
                   font-medium transition w-full">
                Filter
            </button>
        </form>
        @if ($errors->any())
            <div id="errorBox" class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div id="successBox"
                class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="errorBox" class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif


        <div class="bg-white rounded-2xl m-5 border border-gray-300 overflow-hidden">
            <table class="w-full  text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-widest">Room</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-widest">Type</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-widest">Price / night</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-widest text-right">Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse($rooms as $room)
                        <tr class="hover:bg-gray-50/60 transition">

                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900" style="font-family:'Playfair Display',serif">
                                    #{{ $room->roomNumber }}
                                </p>
                                <p class="text-xs text-gray-400 font-light mt-0.5">Floor
                                    {{ floor($room->roomNumber / 100) }}</p>
                            </td>


                            <td class="px-6 py-4">
                                @if ($room->type === 'Single')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-800">
                                        Single
                                    </span>
                                @elseif($room->type === 'Double')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-50 text-pink-800">
                                        Double
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-800">
                                        Suite
                                    </span>
                                @endif
                            </td>


                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">${{ number_format($room->price, 2) }}</p>
                                <p class="text-xs text-gray-400 font-light">per night</p>
                            </td>


                            <td class="px-6 py-4">
                                @if ($room->status === 'available')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Available
                                    </span>
                                @elseif($room->status === 'occupied')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Occupied
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Maintenance
                                    </span>
                                @endif
                            </td>


                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('editRoom', $room->id) }}"
                                        class="px-3 py-1.5 text-xs font-medium rounded-lg
                        bg-amber-50 text-amber-800 border border-amber-200
                        hover:bg-amber-100 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('destroyRoom', $room->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this room?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="px-3 py-1.5 text-xs font-medium rounded-lg
                               bg-red-50 text-red-800 border border-red-200
                               hover:bg-red-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-16 text-gray-400 text-sm">
                                No rooms found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="mt-8 flex justify-center">
            {{ $rooms->links() }}
        </div>

    </div>
@endsection
