@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-30 px-4">

        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8">

            {{-- ================= ROOM INFO ================= --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <div
                    class="h-56 bg-gradient-to-r from-amber-500 to-orange-400 flex items-center justify-center text-white text-5xl">
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Room {{ $room->roomNumber }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>

                <div class="p-6 space-y-4">

                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $room->name }}
                    </h2>

                    <p class="text-gray-500">
                        Chambre confortable idéale pour votre séjour.
                    </p>

                    <div class="grid grid-cols-2 gap-4 text-sm">

                        <div class="bg-slate-50 p-3 rounded-xl">
                            <p class="text-gray-400">Prix / Nuit</p>
                            <p class="font-semibold text-amber-600">
                                {{ $room->price }} MAD
                            </p>
                        </div>

                        <div class="bg-slate-50 p-3 rounded-xl">
                            <p class="text-gray-400">Type</p>
                            <p class="font-semibold">
                                {{ $room->type }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-3 rounded-xl">
                            <p class="text-gray-400">Étage</p>
                            <p class="font-semibold">
                                {{ $room->floor }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-3 rounded-xl">
                            <p class="text-gray-400">Status</p>
                            <p class="font-semibold text-green-600">
                                Disponible
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Réserver maintenant
                </h2>

                @if ($errors->any())
                    <div id="errorBox"
                        class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
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
                    <div id="errorBox"
                        class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                        {{ session('error') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('reservations.store', $room->id) }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="text-sm text-gray-600">Check In</label>
                        <input type="datetime-local" name="check_in" required
                            class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Check Out</label>
                        <input type="datetime-local" name="check_out" required
                            class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Guests</label>
                        <input type="number" name="guests" min="1" value="1"
                            class="w-full mt-1 border rounded-xl p-3">
                    </div>

                    <div class="flex justify-between items-center pt-6">

                        <a href="{{ route('Room.index') }}"
                            class="px-5 py-2 rounded-xl border border-gray-300
                              hover:bg-gray-100 transition">
                            ← Retour
                        </a>

                        <button
                            class="px-6 py-3 rounded-xl
                               bg-gradient-to-r from-amber-500 to-orange-400
                               text-white font-semibold
                               shadow-lg hover:scale-105 transition">
                            Confirmer réservation
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        setTimeout(() => {
            document.getElementById('error')?.remove();
            document.getElementById('success')?.remove();
        }, 4000);
    </script>
@endsection
