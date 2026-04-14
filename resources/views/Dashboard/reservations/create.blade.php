@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen bg-black/70 flex items-center justify-center p-6">

    <div class="w-full max-w-md min-h-[580px] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col">

        <div class="bg-gradient-to-br from-[#D85A30] to-[#EF9F27] text-center pt-8 px-7">
            <h2 class="text-white text-xl font-serif mb-6">
                Add Reservation
            </h2>
            <div class="h-6 bg-white rounded-t-2xl"></div>
        </div>

        <div class="px-7 pb-8 flex-1 flex flex-col justify-between">

            <form action="{{ route('dashboard.reservations.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div id="errorBox"
                        class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm shadow">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div id="successBox"
                        class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-5 text-center">
                    <button type="button" onclick="toggleManualClient()"
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-orange-500 rounded-lg shadow hover:scale-105 transition">
                        + Ajouter un client sans compte
                    </button>
                </div>

                <div id="selectClientBox" class="mb-5">
                    <label class="text-xs uppercase text-gray-500">Client existant</label>

                    <select name="client_id" id="clientSelect"
                        class="w-full mt-2 px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-300 focus:outline-none shadow-sm">

                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">
                                {{ $client->name }} — {{ $client->email }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div id="manualClient"
                    class="hidden mb-5 bg-orange-50 border border-orange-200 rounded-xl p-4 shadow-inner">

                    <p class="text-sm font-semibold text-orange-700 mb-3">
                        Informations du client
                    </p>

                    <input type="text" name="manual_name" placeholder="Nom du client"
                        class="w-full mb-3 px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-300">

                    <input type="email" name="manual_email" placeholder="Email"
                        class="w-full mb-3 px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-300">

                    <input type="text" name="manual_phone" placeholder="Téléphone"
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-300">
                </div>

                <div class="mb-5">
                    <label class="text-xs uppercase text-gray-500">Room</label>

                    <select name="room_id"
                        class="w-full mt-2 px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-300 shadow-sm">

                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">
                                Room {{ $room->roomNumber }} — {{ $room->type }} (${{ $room->price }}/night)
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div>
                        <label class="text-xs uppercase text-gray-500">Check In</label>
                        <input type="date" name="check_in"
                            class="w-full mt-2 px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-300 shadow-sm">
                    </div>

                    <div>
                        <label class="text-xs uppercase text-gray-500">Check Out</label>
                        <input type="date" name="check_out"
                            class="w-full mt-2 px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-300 shadow-sm">
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">

                    <a href="{{ route('dashboard.reservations.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium
                               text-gray-600 border border-gray-300 rounded-lg
                               hover:bg-gray-100 transition">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>

                        Back
                    </a>

                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-orange-600 to-amber-500 hover:from-orange-700 hover:to-amber-600 text-white rounded-xl font-semibold shadow-md transition transform hover:scale-105">
                        Create Reservation
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function toggleManualClient() {
        const manualBox = document.getElementById('manualClient');
        const selectBox = document.getElementById('selectClientBox');
        const select = document.getElementById('clientSelect');

        manualBox.classList.toggle('hidden');
        selectBox.classList.toggle('hidden');

        select.disabled = !select.disabled;
    }

    setTimeout(() => {
        document.getElementById('errorBox')?.remove();
        document.getElementById('successBox')?.remove();
    }, 4000);
</script>
