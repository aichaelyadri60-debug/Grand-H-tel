  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <div class="min-h-screen bg-black/70 flex items-center justify-center p-6">

      <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden">

          {{-- HEADER --}}
          <div class="bg-amber-700 text-center pt-7 px-7">
              <h2 class="text-white text-xl font-serif mb-6">
                  Add Reservation
              </h2>
              <div class="h-6 bg-white rounded-t-2xl"></div>
          </div>

          <div class="px-7 pb-6">
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



              <form action="{{ route('receptionnist.reservations.store') }}" method="POST">
                  @csrf

                  <div class="mb-4">
                      <label class="text-xs uppercase text-gray-500">Client</label>

                      <select name="client_id"
                          class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-300">

                          @foreach ($clients as $client)
                              <option value="{{ $client->id }}">
                                  {{ $client->name }} — {{ $client->email }}
                              </option>
                          @endforeach

                      </select>
                  </div>

                  <div class="mb-4">
                      <label class="text-xs uppercase text-gray-500">Room</label>

                      <select name="room_id"
                          class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-300">

                          @foreach ($rooms as $room)
                              <option value="{{ $room->id }}">
                                  Room {{ $room->roomNumber }} — {{ $room->type }} (${{ $room->price }}/night)
                              </option>
                          @endforeach

                      </select>
                  </div>

                  <div class="grid grid-cols-2 gap-3">

                      <div>
                          <label class="text-xs uppercase text-gray-500">Check In</label>
                          <input type="date" name="check_in"
                              class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-300">
                      </div>

                      <div>
                          <label class="text-xs uppercase text-gray-500">Check Out</label>
                          <input type="date" name="check_out"
                              class="w-full mt-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-300">
                      </div>

                  </div>

                  <div class="flex justify-end mt-6">

                      <button type="submit"
                          class="px-6 py-2 bg-amber-700 hover:bg-amber-800 text-white rounded-lg font-medium">
                          Create Reservation
                      </button>

                  </div>

              </form>

          </div>
      </div>
  </div>


  <script>
      setTimeout(() => {
          document.getElementById('errorBox')?.remove();
          document.getElementById('successBox')?.remove();
      }, 4000);
  </script>
