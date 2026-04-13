<section class="space-y-6">

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs text-gray-500 mb-1">
                Mot de passe actuel
            </label>
            <input type="password" name="current_password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-amber-400 outline-none">

            @error('current_password', 'updatePassword')
                <p id="errorBox" class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">
                Nouveau mot de passe
            </label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-amber-400 outline-none">

            @error('password', 'updatePassword')
                <p id="errorBox" class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs text-gray-500 mb-1">
                Confirmer le mot de passe
            </label>
            <input type="password" name="password_confirmation"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-amber-400 outline-none">
        </div>

        <div class="flex items-center gap-3">
            <button
                class="px-5 py-2 bg-amber-500 text-white text-sm rounded-lg hover:bg-amber-600 transition">
                Mettre à jour
            </button>

            @if (session('status') === 'password-updated')
                <span id="successBox" class="text-xs text-green-600">
                     Mot de passe mis à jour
                </span>
            @endif
        </div>

    </form>

</section>
