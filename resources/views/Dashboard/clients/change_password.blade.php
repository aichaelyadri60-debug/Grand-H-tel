  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-orange-100">

      <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">

          <div class="text-center mb-6">
              <h2 class="text-2xl font-bold text-gray-800">
                  Change Password
              </h2>
              <p class="text-sm text-gray-500 mt-1">
                  Pour votre sécurité, veuillez changer votre mot de passe.
              </p>
          </div>

          @if ($errors->any())
              <div id="errorBox" class="mb-4 bg-red-100 text-red-600 p-3 rounded-lg text-sm">
                  {{ $errors->first() }}
              </div>
          @endif
                  @if (session('success'))
            <div id="successBox" class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorBox" class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

          <form method="POST" action="{{ route('password.change') }}" class="space-y-5">
              @csrf

              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">
                      Nouveau mot de passe
                  </label>

                  <input type="password" name="password" required
                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                              focus:ring-2 focus:ring-orange-400 outline-none
                              transition">
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">
                      Confirmer mot de passe
                  </label>

                  <input type="password" name="password_confirmation" required
                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                              focus:ring-2 focus:ring-orange-400 outline-none
                              transition">
              </div>

              <button
                  class="w-full bg-gradient-to-br from-[#D85A30] to-[#EF9F27]  text-white
                       font-semibold py-3 rounded-lg transition duration-300
                       shadow-md hover:shadow-lg">

                  Mettre à jour le mot de passe
              </button>

          </form>

      </div>

  </div>
