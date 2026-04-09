@extends('layouts.app1')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Receptionist Details
            </h1>

            <p class="text-xs text-gray-400 uppercase tracking-widest">
                User profile information
            </p>
        </div>

        <a href="{{ route('admin.receptionists.index') }}"
           class="px-4 py-2 text-sm bg-gray-900 text-white rounded-lg hover:bg-black">
            ← Back
        </a>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-gray-300 shadow-sm p-8">

        <div class="flex items-center gap-6 mb-8">

            {{-- Avatar --}}
            <div
                class="w-20 h-20 rounded-full bg-orange-100
                       flex items-center justify-center
                       text-2xl font-bold text-orange-700">

                {{ strtoupper(substr($user->name,0,1)) }}
            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ $user->name }}
                </h2>

                <p class="text-gray-500 text-sm">
                    Receptionist #{{ $user->id }}
                </p>
            </div>

        </div>

        {{-- Info Grid --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- Email --}}
            <div>
                <p class="text-xs text-gray-400 uppercase">Email</p>
                <p class="font-medium text-gray-800 mt-1">
                    {{ $user->email }}
                </p>
            </div>

            {{-- Phone --}}
            <div>
                <p class="text-xs text-gray-400 uppercase">Phone</p>
                <p class="font-medium text-gray-800 mt-1">
                    {{ $user->phone ?? '-' }}
                </p>
            </div>

            {{-- Role --}}
            <div>
                <p class="text-xs text-gray-400 uppercase">Role</p>

                <span class="inline-block mt-1 px-3 py-1 text-xs
                    bg-blue-100 text-blue-700 rounded-full">
                    Receptionist
                </span>
            </div>

            {{-- Status --}}
            <div>
                <p class="text-xs text-gray-400 uppercase">Status</p>

                @if($user->is_banned)
                    <span class="inline-block mt-1 px-3 py-1 text-xs
                        bg-red-100 text-red-700 rounded-full">
                        Banned
                    </span>
                @else
                    <span class="inline-block mt-1 px-3 py-1 text-xs
                        bg-green-100 text-green-700 rounded-full">
                        Active
                    </span>
                @endif
            </div>

            {{-- Created --}}
            <div>
                <p class="text-xs text-gray-400 uppercase">Created At</p>
                <p class="font-medium text-gray-800 mt-1">
                    {{ $user->created_at ?$user->created_at ->format('d M Y') :'-'}}
                </p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex gap-3 mt-10 border-t pt-6">

            {{ dd($user->id) }}
            {{-- Ban / Deban --}}
            <form method="POST"
                action="{{ route('dashboard.clients.banordeban',['client' =>$user->id]) }}">
                @csrf

                @if(!$user->is_banned)
                    <button
                        class="px-5 py-2 text-sm font-medium
                               text-red-700 bg-red-100 border border-red-300
                               rounded-lg hover:bg-red-200">
                        Ban Receptionist
                    </button>
                @else
                    <button
                        class="px-5 py-2 text-sm font-medium
                               text-green-700 bg-green-100 border border-green-300
                               rounded-lg hover:bg-green-200">
                        Deban Receptionist
                    </button>
                @endif
            </form>

            {{-- Delete --}}
            <form method="POST"
                action="{{ route('dashboard.receptionists.destroy',$user->id) }}"
                onsubmit="return confirm('Delete this receptionist ?')">

                @csrf
                @method('DELETE')

                <button
                    class="px-5 py-2 text-sm font-medium
                           text-white bg-gray-900 rounded-lg hover:bg-black">
                    Delete
                </button>
            </form>

        </div>

    </div>

</div>

@endsection
