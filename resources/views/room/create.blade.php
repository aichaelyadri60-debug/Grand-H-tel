@extends('layouts.app')

@section('content')

    <div
        class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-teal-50 flex items-center justify-center px-4 py-24">

        {{-- Background blobs --}}
        <div class="pointer-events-none fixed top-20 right-0 w-72 h-72 bg-amber-200/20 rounded-full blur-3xl"></div>
        <div class="pointer-events-none fixed bottom-10 left-0 w-60 h-60 bg-teal-200/20 rounded-full blur-3xl"></div>

        <div class="w-full max-w-xl relative z-10">

            <div class="bg-white rounded-2xl shadow-xl shadow-amber-100/50 overflow-hidden border border-amber-100">

                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-amber-500 to-amber-400 px-8 pt-8 pb-10 text-center relative">

                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>

                    <p class="text-amber-100 text-xs tracking-widest uppercase mb-1 font-medium">
                        Room Management
                    </p>

                    <h2 class="text-white text-2xl font-bold font-serif tracking-wide">
                        Add New Room
                    </h2>

                    <div class="absolute bottom-0 left-0 right-0 h-6 bg-white rounded-t-3xl"></div>
                </div>

                {{-- FORM --}}
                <div class="px-8 pb-8 pt-2">

                    <form action="{{ route('storeRoom') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                        @csrf

                        {{-- SECTION --}}
                        <div class="flex items-center gap-3 mb-1">
                            <span class="text-xs font-semibold text-gray-400 tracking-widest uppercase">
                                Room Details
                            </span>
                            <div class="flex-1 h-px bg-gray-100"></div>
                        </div>

                        {{-- NUMBER + TYPE --}}
                        <div class="grid grid-cols-2 gap-4">

                            {{-- Room Number --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Room No.</label>
                                <input type="text" name="roomNumber" value="{{ old('roomNumber') }}" required
                                    placeholder="ex: 214"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-400/40">
                            </div>

                            {{-- Type --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Type</label>

                                <select name="type"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-400/40"
                                    required>

                                    <option value="">Select</option>
                                    <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Double" {{ old('type') == 'Double' ? 'selected' : '' }}>Double</option>
                                    <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>

                                </select>
                            </div>

                        </div>

                        {{-- PRICE --}}
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase">
                                Price per Night
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-amber-500 font-bold">$</span>

                                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                                    class="w-full pl-8 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-400/40">
                            </div>
                        </div>

                        {{-- STATUS --}}
                        <div>

                            <label class="text-xs font-semibold text-gray-500 uppercase mb-2 block">
                                Room Status
                            </label>

                            <select name="status" id="statusSelect" class="hidden">
                                <option value="available" selected>Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>

                            <div class="grid grid-cols-3 gap-3">

                                <button type="button" onclick="setStatus('available')" id="pill-available"
                                    class="status-pill border-2 border-teal-400 bg-teal-50 text-teal-700 rounded-xl py-3 text-xs font-semibold">
                                    Available
                                </button>

                                <button type="button" onclick="setStatus('occupied')" id="pill-occupied"
                                    class="status-pill border-2 border-gray-200 bg-gray-50 text-gray-400 rounded-xl py-3 text-xs font-semibold">
                                    Occupied
                                </button>

                                <button type="button" onclick="setStatus('maintenance')" id="pill-maintenance"
                                    class="status-pill border-2 border-gray-200 bg-gray-50 text-gray-400 rounded-xl py-3 text-xs font-semibold">
                                    Maintenance
                                </button>

                            </div>
                        </div>
                        {{-- Room Image --}}
                        <div>
                            <label
                                class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                                Room Image
                            </label>

                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:text-sm file:font-semibold
               file:bg-amber-50 file:text-amber-600
               hover:file:bg-amber-100
               focus:outline-none focus:ring-2 focus:ring-amber-400/40">
                        </div>

                        {{-- ERRORS --}}
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-xl p-3">
                                <ul class="text-xs text-red-600 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- BUTTON --}}
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 text-white rounded-xl font-semibold shadow-md transition">
                            Create Room
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setStatus(val) {
            document.getElementById('statusSelect').value = val;

            document.querySelectorAll('.status-pill').forEach(p => {
                p.classList.remove('border-teal-400', 'bg-teal-50', 'text-teal-700');
                p.classList.add('border-gray-200', 'bg-gray-50', 'text-gray-400');
            });

            const active = document.getElementById('pill-' + val);
            active.classList.remove('border-gray-200', 'bg-gray-50', 'text-gray-400');
            active.classList.add('border-teal-400', 'bg-teal-50', 'text-teal-700');
        }
    </script>

@endsection
