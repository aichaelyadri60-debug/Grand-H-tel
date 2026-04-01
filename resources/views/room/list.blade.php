@extends('layouts.app')

@section('content')
    <section class="relative h-[420px] flex items-center justify-center overflow-hidden">

        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('img/hero.jpg') }}');">
        </div>

        <div class="absolute inset-0 bg-black/55"></div>

        <div class="relative z-10 text-center px-6">
            <p class="text-amber-400 text-sm font-semibold tracking-[0.25em] uppercase mb-3">
                Accommodations

            </p>
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-white leading-tight mb-4">
                Our Rooms &amp; Suites
            </h1>
            <p class="text-white/75 text-lg max-w-xl mx-auto leading-relaxed">
                Discover your perfect sanctuary from our collection of elegantly designed rooms
            </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60 C360 0 1080 0 1440 60 L1440 60 L0 60 Z" fill="#f8f5f0" />
            </svg>
        </div>
    </section>

    <div class="bg-gradient-to-b from-[#f8f5f0] to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">

                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-800">
                        Rooms Management
                    </h2>
                    <p class="text-sm text-gray-400 mt-0.5">
                        {{ $rooms->total() }} room{{ $rooms->total() != 1 ? 's' : '' }} found
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">

                    <form method="GET" class="flex gap-2">
                        <div class="relative">
                            <select name="type"
                                class="pl-4 pr-9 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:border-amber-400 transition shadow-sm">
                                <option value="">All Types</option>
                                <option value="Single" {{ request('type') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Double" {{ request('type') == 'Double' ? 'selected' : '' }}>Double</option>
                                <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                            </select>
                            <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>
                        </div>

                        <button type="submit"
                            class="flex items-center gap-1.5 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 font-medium hover:bg-amber-50 hover:border-amber-300 hover:text-amber-600 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 4h18M7 10h10M11 16h2" />
                            </svg>
                            Filter
                        </button>
                    </form>


                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                @forelse($rooms as $room)
                    <div
                        class="group bg-white rounded-2xl shadow-sm shadow-gray-200/80 overflow-hidden border border-gray-100 hover:shadow-xl hover:shadow-amber-100/60 hover:-translate-y-1 transition-all duration-300">

                        <div class="relative h-52 overflow-hidden bg-gray-100">
                            @if ($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="Room {{ $room->roomNumber }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-amber-50 to-amber-100/50">
                                    <svg class="w-12 h-12 text-amber-300" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>
                                    <p class="text-amber-400 text-xs mt-2 font-medium">No image</p>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3">
                                <span
                                    class="px-3 py-1.5 bg-amber-500 text-white text-sm font-bold rounded-full shadow-lg shadow-amber-500/30">
                                    ${{ number_format($room->price) }}/night
                                </span>
                            </div>

                            <div class="absolute top-3 left-3">
                                <span
                                    class="px-3 py-1.5 bg-black/40 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                    # {{ $room->roomNumber }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">

                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 bg-amber-50 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="2" y="7" width="20" height="14" rx="2" />
                                            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                                        </svg>
                                    </span>
                                    <span class="text-gray-800 font-semibold text-sm">{{ $room->type }} Room</span>
                                </div>

                                @if ($room->status == 'available')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-teal-50 text-teal-700 text-xs font-semibold rounded-full border border-teal-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                                        Available
                                    </span>
                                @elseif($room->status == 'occupied')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-600 text-xs font-semibold rounded-full border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Occupied
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Maintenance
                                    </span>
                                @endif
                            </div>

                            <div class="h-px bg-gray-100 mb-3"></div>

                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    Added {{ $room->created_at->format('d M Y') }}
                                </span>
                                <span class="font-semibold text-amber-500 text-sm">
                                    ${{ number_format($room->price, 2) }}
                                </span>
                            </div>
                            <a href="{{ route('ShowReservation', $room->id) }}"
                                class="flex items-center justify-center gap-2 w-full py-3 px-4
          rounded-xl bg-gradient-to-r from-amber-500 to-orange-400
          text-white font-semibold
          shadow-lg hover:shadow-xl
          hover:scale-[1.02]
          transition-all duration-200">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                                </svg>

                                Réserver
                            </a>
                        </div>



                    </div>
                @empty
                    <div class="col-span-3 flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 bg-amber-50 rounded-2xl flex items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </div>
                        <h3 class="text-gray-700 font-semibold text-lg mb-1">No rooms found</h3>
                    </div>
                @endforelse

            </div>


            @if ($rooms->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="pagination-wrapper">
                        {{ $rooms->withQueryString()->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .pagination-wrapper nav span[aria-current="page"] span,
        .pagination-wrapper nav a:hover {
            background: linear-gradient(135deg, #f59e0b, #f97316) !important;
            color: white !important;
            border-color: transparent !important;
        }

        .pagination-wrapper nav span,
        .pagination-wrapper nav a {
            border-radius: 10px !important;
            border: 1px solid #e5e7eb !important;
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 0.9rem !important;
            transition: all 0.2s !important;
        }
    </style>
@endsection
