@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-teal-50 flex items-center justify-center px-4 py-24">

    <div class="pointer-events-none fixed top-20 right-0 w-72 h-72 bg-amber-200/20 rounded-full blur-3xl"></div>
    <div class="pointer-events-none fixed bottom-10 left-0 w-60 h-60 bg-teal-200/20 rounded-full blur-3xl"></div>

    <div class="w-full max-w-xl relative z-10">

        <div class="bg-white rounded-2xl shadow-xl shadow-amber-100/50 overflow-hidden border border-amber-100">

            <div class="bg-gradient-to-r from-amber-500 to-amber-400 px-8 pt-8 pb-10 text-center relative">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <p class="text-amber-100 text-xs tracking-widest uppercase mb-1 font-medium">Room Management</p>
                <h2 class="text-white text-2xl font-bold font-serif tracking-wide">Edit Room</h2>

                <div class="absolute bottom-0 left-0 right-0 h-6 bg-white rounded-t-3xl"></div>
            </div>

            {{-- Form body --}}
            <div class="px-8 pb-8 pt-2">

                <form action="{{ route('updateRoom', $room->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-xs font-semibold text-gray-400 tracking-widest uppercase">Room Details</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                                <span class="w-4 h-4 bg-gradient-to-br from-amber-400 to-amber-500 rounded flex items-center justify-center">
                                    <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M3 21h18M4 21V7l8-4 8 4v14"/>
                                    </svg>
                                </span>
                                Room No.
                            </label>
                            <input
                                type="text"
                                name="roomNumber"
                                value="{{ old('roomNumber', $room->roomNumber) }}"
                                required
                                placeholder="ex: 214"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:border-amber-400 transition"
                            >
                        </div>

                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                                <span class="w-4 h-4 bg-gradient-to-br from-amber-400 to-amber-500 rounded flex items-center justify-center">
                                    <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                                    </svg>
                                </span>
                                Type
                            </label>
                            <div class="relative">
                                <select
                                    name="type"
                                    required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:border-amber-400 transition appearance-none pr-9"
                                >
                                    <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double</option>
                                    <option value="Suite"  {{ $room->type == 'Suite'  ? 'selected' : '' }}>Suite</option>
                                </select>
                                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            <span class="w-4 h-4 bg-gradient-to-br from-amber-400 to-amber-500 rounded flex items-center justify-center">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 9.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H15"/>
                                </svg>
                            </span>
                            Price per Night
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-amber-500 font-bold text-sm">$</span>
                            <input
                                type="number"
                                name="price"
                                step="0.01"
                                value="{{ old('price', $room->price) }}"
                                required
                                placeholder="0.00"
                                class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:border-amber-400 transition"
                            >
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <span class="text-xs font-semibold text-gray-400 tracking-widest uppercase">Room Status</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            <span class="w-4 h-4 bg-gradient-to-br from-amber-400 to-amber-500 rounded flex items-center justify-center">
                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                            </span>
                            Current Status
                        </label>

                        <select name="status" id="statusSelect" class="hidden">
                            <option value="available"    {{ $room->status == 'available'    ? 'selected' : '' }}>Available</option>
                            <option value="occupied"     {{ $room->status == 'occupied'     ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance"  {{ $room->status == 'maintenance'  ? 'selected' : '' }}>Maintenance</option>
                        </select>

                        <div class="grid grid-cols-3 gap-3">

                            <button type="button"
                                onclick="setStatus('available')"
                                id="pill-available"
                                class="status-pill flex flex-col items-center gap-1.5 py-3 px-2 border-2 rounded-xl text-xs font-semibold transition-all duration-200
                                       {{ $room->status == 'available' ? 'border-teal-400 bg-teal-50 text-teal-700 shadow-sm shadow-teal-100' : 'border-gray-200 bg-gray-50 text-gray-400 hover:border-teal-300 hover:bg-teal-50/50 hover:text-teal-600' }}">
                                <span class="w-2.5 h-2.5 rounded-full bg-teal-400"></span>
                                Available
                            </button>

                            <button type="button"
                                onclick="setStatus('occupied')"
                                id="pill-occupied"
                                class="status-pill flex flex-col items-center gap-1.5 py-3 px-2 border-2 rounded-xl text-xs font-semibold transition-all duration-200
                                       {{ $room->status == 'occupied' ? 'border-red-400 bg-red-50 text-red-600 shadow-sm shadow-red-100' : 'border-gray-200 bg-gray-50 text-gray-400 hover:border-red-300 hover:bg-red-50/50 hover:text-red-500' }}">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                                Occupied
                            </button>

                            <button type="button"
                                onclick="setStatus('maintenance')"
                                id="pill-maintenance"
                                class="status-pill flex flex-col items-center gap-1.5 py-3 px-2 border-2 rounded-xl text-xs font-semibold transition-all duration-200
                                       {{ $room->status == 'maintenance' ? 'border-amber-400 bg-amber-50 text-amber-700 shadow-sm shadow-amber-100' : 'border-gray-200 bg-gray-50 text-gray-400 hover:border-amber-300 hover:bg-amber-50/50 hover:text-amber-600' }}">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                Maintenance
                            </button>

                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-3">
                            <ul class="text-xs text-red-600 space-y-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">

                        <a href="{{ url()->previous() }}"
                           class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 12H5M12 19l-7-7 7-7"/>
                            </svg>
                            Cancel
                        </a>

                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 text-white text-sm font-semibold rounded-xl shadow-md shadow-amber-200 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-amber-200 active:translate-y-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Room
                        </button>

                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
const statusConfig = {
    available:   { border: 'border-teal-400',  bg: 'bg-teal-50',   text: 'text-teal-700',  shadow: 'shadow-teal-100'  },
    occupied:    { border: 'border-red-400',    bg: 'bg-red-50',    text: 'text-red-600',   shadow: 'shadow-red-100'   },
    maintenance: { border: 'border-amber-400',  bg: 'bg-amber-50',  text: 'text-amber-700', shadow: 'shadow-amber-100' },
};

const defaultClasses = 'border-gray-200 bg-gray-50 text-gray-400';

function setStatus(val) {
    document.getElementById('statusSelect').value = val;

    ['available', 'occupied', 'maintenance'].forEach(s => {
        const pill = document.getElementById('pill-' + s);
        pill.className = pill.className
            .replace(/border-\S+/g, '')
            .replace(/bg-\S+/g, '')
            .replace(/text-\S+/g, '')
            .replace(/shadow-\S+/g, '')
            .replace(/shadow\b/g, '')
            .trim();

        if (s === val) {
            const c = statusConfig[s];
            pill.classList.add('border-2', c.border, c.bg, c.text, 'shadow-sm', c.shadow);
        } else {
            pill.classList.add('border-2', ...defaultClasses.split(' '));
        }
    });
}
</script>

@endsection
