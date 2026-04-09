@extends('layouts.app1')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
                Receptionists Management
            </h1>

            <p class="mt-1 text-xs text-gray-400 uppercase tracking-widest font-light">
                {{ $receptionists->total() }} receptionists registered
            </p>
        </div>

        <a href="{{ route('admin.receptionists.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium
           bg-gradient-to-br from-[#D85A30] to-[#EF9F27]
           hover:opacity-90 transition shadow-md shadow-orange-200">

            <span class="w-5 h-5 bg-white/25 rounded-full flex items-center justify-center text-base leading-none">
                +
            </span>

            Add Receptionist
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET"
        class="bg-white rounded-2xl border border-gray-300 p-5 mb-6
        grid grid-cols-1 md:grid-cols-2 gap-3">

        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by name or email"
            class="border border-gray-400 bg-gray-50 rounded-lg px-4 py-2.5 text-sm
            focus:ring-2 focus:ring-orange-300 outline-none">

        <button class="bg-gray-900 hover:bg-black text-white rounded-lg px-4 py-2.5 text-sm font-medium transition">
            Search
        </button>
    </form>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-300 overflow-hidden">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-50 border-b border-gray-300">
                <tr>
                    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Receptionist</th>
                    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Email</th>
                    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Phone</th>
                    <th class="px-6 py-4 text-xs text-gray-400 uppercase">Joined</th>
                    <th class="px-6 py-4 text-xs text-gray-400 uppercase text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">

            @forelse($receptionists as $r)
                <tr class="hover:bg-gray-50/60 transition">

                    {{-- USER --}}
                    <td class="px-6 py-4 flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full bg-orange-100
                                    flex items-center justify-center
                                    font-semibold text-orange-700">
                            {{ strtoupper(substr($r->name,0,1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $r->name }}
                            </p>
                            <p class="text-xs text-gray-400">
                                Receptionist #{{ $r->id }}
                            </p>
                        </div>

                    </td>

                    {{-- EMAIL --}}
                    <td class="px-6 py-4 text-gray-700">
                        {{ $r->email }}
                    </td>

                    {{-- PHONE --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $r->phone ?? '-' }}
                    </td>

                    {{-- DATE --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $r->created_at?->format('d M Y') }}
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-2">

                            <a href="{{ route('admin.receptionists.show',$r->id) }}"
                               class="px-4 py-2 text-xs font-medium
                               text-blue-700 bg-blue-100 border border-blue-300
                               rounded-lg hover:bg-blue-200">
                                View
                            </a>

                            <a href="{{ route('admin.receptionists.edit',$r->id) }}"
                               class="px-4 py-2 text-xs font-medium
                               text-amber-700 bg-amber-100 border border-amber-300
                               rounded-lg hover:bg-amber-200">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.receptionists.destroy',$r->id) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this receptionist?')"
                                    class="px-4 py-2 text-xs font-medium
                                    text-red-700 bg-red-100 border border-red-300
                                    rounded-lg hover:bg-red-200">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="5" class="text-center py-16 text-gray-400">
                        No receptionists found
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8 flex justify-center">
        {{ $receptionists->links() }}
    </div>

</div>
@endsection
