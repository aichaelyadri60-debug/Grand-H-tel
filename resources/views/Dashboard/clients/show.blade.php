@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen bg-amber-50/40 flex items-center justify-center p-8">

    <div class="w-full max-w-md bg-white rounded-2xl border border-amber-100 shadow-lg overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-br from-[#D85A30] to-[#EF9F27]  px-8 py-10 text-center">

            <div class="w-16 h-16 mx-auto rounded-full bg-white/20 border border-white/40
                        flex items-center justify-center text-xl font-semibold text-white">
                {{ strtoupper(substr($client->name, 0, 2)) }}
            </div>

            <h2 class="mt-4 text-lg font-semibold text-white">
                {{ $client->name }}
            </h2>

            <p class="text-sm text-white/80">
                {{ ucfirst($client->role) }}
            </p>

            {{-- STATUS --}}
            <div class="inline-flex items-center gap-2 mt-3 px-3 py-1 rounded-full text-xs font-medium
                        {{ $client->is_banned ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">

                <span class="w-2 h-2 rounded-full
                    {{ $client->is_banned ? 'bg-red-500' : 'bg-green-500' }}"></span>

                {{ $client->is_banned ? 'Banni' : 'Actif' }}
            </div>

        </div>

        {{-- INFOS --}}
        <div class="px-6 py-4 divide-y divide-amber-50">

            <div class="flex justify-between py-3">
                <span class="text-sm text-gray-400">Email</span>
                <span class="text-sm font-medium text-gray-800">
                    {{ $client->email }}
                </span>
            </div>

            <div class="flex justify-between py-3">
                <span class="text-sm text-gray-400">Téléphone</span>
                <span class="text-sm {{ $client->phone ? 'text-gray-800 font-medium' : 'text-gray-400' }}">
                    {{ $client->phone ?? '—' }}
                </span>
            </div>

            <div class="flex justify-between py-3">
                <span class="text-sm text-gray-400">Inscrit le</span>
                <span class="text-sm font-medium text-gray-800">
                    {{ optional($client->created_at)->format('d M Y') }}
                </span>
            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="bg-amber-50 border-t border-amber-100 px-6 py-4 flex justify-between items-center">

            <a href="{{ route('dashboard.clients.index') }}"
               class="px-4 py-2 text-sm rounded-lg border border-gray-200 text-gray-500 hover:bg-white transition">
                ← Retour
            </a>

            <form method="POST" action="{{ route('dashboard.clients.banordeban', $client->id) }}">
                @csrf
                @method('PATCH')

                <button
                    class="px-4 py-2 text-sm rounded-lg text-white
                    {{ $client->is_banned
                        ? 'bg-green-600 hover:bg-green-700'
                        : 'bg-red-500 hover:bg-red-600' }}">

                    {{ $client->is_banned ? 'Debannir' : 'Bannir' }}
                </button>
            </form>

        </div>

    </div>

</div>
