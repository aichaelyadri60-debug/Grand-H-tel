@extends('layouts.app1')

@section('content')


    <div class="p-6 max-w-7xl mx-auto">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
                    Clients Management
                </h1>

                <p class="mt-1 text-xs text-gray-400 uppercase tracking-widest font-light">
                    {{ $clients->total() }} clients registered · Updated today
                </p>
            </div>
            <a href="{{ route('Client.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium
              bg-gradient-to-br from-[#D85A30] to-[#EF9F27]
              hover:opacity-90 transition shadow-md shadow-orange-200">
                <span
                    class="w-5 h-5 bg-white/25 rounded-full flex items-center justify-center text-base leading-none">+</span>
                Add Client
            </a>
        </div>


        <form method="GET"
            class="bg-white rounded-2xl border border-gray-300 p-5 mb-6
        grid grid-cols-1 md:grid-cols-3 gap-3">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email "
                class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
            focus:ring-2 focus:ring-orange-300 focus:border-orange-400 outline-none">

            <select name="status"
                class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-orange-300 outline-none">

                <option value="">All Status</option>
                <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>banned</option>
                <option value="debanned" {{ request('status') == 'debanned' ? 'selected' : '' }}>debanned</option>

            </select>

            <button class="bg-gray-900 hover:bg-black text-white rounded-lg px-4 py-2.5 text-sm font-medium transition">
                Search
            </button>
        </form>
        @if ($errors->any())
            <div id="errorBox" class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
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
            <div id="errorBox" class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif


        <div class="bg-white rounded-2xl border border-gray-300 overflow-hidden">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Client</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Email</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Phone</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase">Joined</th>
                        <th class="px-6 py-4 text-xs text-gray-400 uppercase text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50/60 transition">

                            <td class="px-6 py-4 flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-full bg-orange-100
                            flex items-center justify-center
                            font-semibold text-orange-700">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $client->name }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Client #{{ $client->id }}
                                    </p>
                                </div>

                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $client->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $client->phone ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $client->created_at ? $client->created_at->format('d M Y') : '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    <a
                                        class="flex items-center justify-center px-4 py-2 text-xs font-medium
                                text-blue-700 bg-blue-100 border border-blue-300
                                rounded-lg transition duration-200
                                hover:bg-blue-200 hover:shadow-sm">
                                        View
                                    </a>


                                    @if (!$client->is_banned)
                                        <form action="{{ route('clients.banordeban', $client->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="flex items-center justify-center px-4 py-2 text-xs font-medium
                                text-red-700 bg-red-100 border border-red-300
                                rounded-lg transition duration-200
                                hover:bg-red-200 hover:shadow-sm">
                                                Ban
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('clients.banordeban', $client->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="flex items-center justify-center px-4 py-2 text-xs font-medium
                                text-green-700 bg-green-100 border border-green-300
                                rounded-lg transition duration-200
                                hover:bg-green-200 hover:shadow-sm">
                                                Deban
                                            </button>
                                        </form>
                                    @endif

                            </td>

        </div>
        </td>

        </tr>

    @empty
        <tr>
            <td colspan="5" class="text-center py-16 text-gray-400">
                No clients found
            </td>
        </tr>
        @endforelse

        </tbody>
        </table>
    </div>


    <div class="mt-8 flex justify-center">
        {{ $clients->links() }}
    </div>

    </div>
@endsection
