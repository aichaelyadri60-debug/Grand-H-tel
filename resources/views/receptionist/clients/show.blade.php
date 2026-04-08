@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen bg-black/10 flex items-center justify-center p-8 ">
  <div class="w-full max-w-md bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-2xl">

    <div class="relative bg-orange-700 px-8 py-10 text-center"
         style="background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 10px);">

      <div class="w-16 h-16 mx-auto rounded-full bg-white/20 border-2 border-white/35
                  flex items-center justify-center text-2xl font-medium text-white">
        {{ strtoupper(substr($client->name, 0, 2)) }}
      </div>

      <h2 class="mt-4 text-xl font-medium text-white">{{ $client->name }}</h2>
      <p class="text-sm text-white/70 mt-0.5">{{ ucfirst($client->role) }}</p>

      <div class="inline-flex items-center gap-1.5 mt-3 px-3 py-1 rounded-full text-xs font-medium
                  {{ $client->is_banned ? 'bg-black/25 text-orange-200' : 'bg-white/18 text-white' }}">
        <span class="w-1.5 h-1.5 rounded-full {{ $client->is_banned ? 'bg-red-300' : 'bg-green-300' }}"></span>
        {{ $client->is_banned ? 'Banni' : 'Actif' }}
      </div>
    </div>

    <div class="px-7 py-2 divide-y divide-gray-100">

      <div class="flex justify-between items-center py-3.5">
        <span class="text-sm text-gray-400 flex items-center gap-2">
        Email
        </span>
        <span class="text-sm font-medium text-gray-800">{{ $client->email }}</span>
      </div>

      <div class="flex justify-between items-center py-3.5">
        <span class="text-sm text-gray-400">Téléphone</span>
        <span class="text-sm {{ $client->phone ? 'font-medium text-gray-800' : 'text-gray-400' }}">
          {{ $client->phone ?? '—' }}
        </span>
      </div>

      <div class="flex justify-between items-center py-3.5">
        <span class="text-sm text-gray-400">Créé le</span>
        <span class="text-sm font-medium text-gray-800">
          {{ optional($client->created_at)->format('d M Y') }}
        </span>
      </div>

    </div>

    <div class="bg-gray-50 border-t border-gray-100 px-7 py-4 flex justify-between items-center">

      <a href="{{ route('clients.index') }}"
         class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm text-gray-500
                border border-gray-200 hover:bg-white transition">
        ← Retour
      </a>

      <form method="POST" action="{{ route('clients.banordeban', $client->id) }}">
        @csrf
        @method('PATCH')
        <button class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                       transition
                       {{ $client->is_banned
                           ? 'bg-green-600 hover:bg-green-700 text-white'
                           : 'bg-orange-700 hover:bg-orange-800 text-white' }}">
          {{ $client->is_banned ? 'Débannir le client' : 'Bannir le client' }}
        </button>
      </form>

    </div>

  </div>
</div>
