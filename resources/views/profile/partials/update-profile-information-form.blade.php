<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        {{-- NAME --}}
        <div>
            <label class="block text-xs text-gray-500 mb-1">
                Nom
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none"
            >

            @error('name')
                <p id="errorBox" class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-xs text-gray-500 mb-1">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none"
            >

            @error('email')
                <p id="errorBox" class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex items-center gap-3">
            <button
                type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm
                       bg-amber-500 hover:bg-amber-600 transition"
            >
                Enregistrer
            </button>

            {{-- SUCCESS --}}
            @if (session('status') === 'profile updated')
                <span id="successBox" class="text-green-600 text-xs">
                     Sauvegarde
                </span>
            @endif
        </div>
    </form>
</section>
