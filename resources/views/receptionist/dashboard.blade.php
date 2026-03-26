@extends('layouts.app1')

@section('content')
@php
    $userRole = auth()->user()->role ?? 'guest';

    $navItems = [
        [
            'path' => 'dashboard',
            'label' => 'Dashboard',
            'icon' => 'layout-dashboard',
            'roles' => ['admin','receptionniste']
        ],
        [
            'path' => 'rooms',
            'label' => 'Rooms',
            'icon' => 'bed-double',
            'roles' => ['admin','receptionniste']
        ],
        [
            'path' => 'clients',
            'label' => 'Clients',
            'icon' => 'users',
            'roles' => ['admin','receptionniste']
        ],
        [
            'path' => 'reservations',
            'label' => 'Reservations',
            'icon' => 'calendar-check',
            'roles' => ['admin','receptionniste']
        ],
        [
            'path' => 'payments',
            'label' => 'Payments',
            'icon' => 'credit-card',
            'roles' => ['admin']
        ],
    ];
@endphp

<aside
    x-data="{ collapsed:false }"
    :class="collapsed ? 'w-20' : 'w-64'"
    class="fixed left-0 top-0 h-screen bg-slate-900 text-white flex flex-col transition-all duration-300"
>

    {{-- LOGO --}}
    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800">

        <div class="flex items-center gap-3 overflow-hidden">
            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center">
                🏨
            </div>

            <span x-show="!collapsed"
                  class="font-semibold text-lg whitespace-nowrap">
                Grand Hotel
            </span>
        </div>

        <button @click="collapsed = !collapsed"
            class="p-2 hover:bg-slate-800 rounded-lg">
            ◀
        </button>

    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 py-6 px-3 space-y-1 overflow-y-auto">

        @foreach ($navItems as $item)
            @if(in_array($userRole,$item['roles']))

                <a href="{{ route($item['path']) }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-lg
                   {{ request()->routeIs($item['path'])
                        ? 'bg-teal-600 text-white'
                        : 'text-slate-400 hover:bg-slate-800 hover:text-white'
                   }} transition">

                    {{-- ICON --}}
                    <span class="w-5 text-center">📌</span>

                    <span x-show="!collapsed"
                          class="font-medium whitespace-nowrap">
                        {{ $item['label'] }}
                    </span>

                </a>

            @endif
        @endforeach

    </nav>

    {{-- BOTTOM ACTIONS --}}
    <div class="p-3 border-t border-slate-800 space-y-1">

        {{-- PUBLIC SITE --}}
        <a href="/"
           class="flex items-center gap-3 w-full px-3 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white">

            🏠
            <span x-show="!collapsed">Public Site</span>
        </a>

        {{-- LOGOUT --}}
        <form method="POST" >
            @csrf
            <button
                class="flex items-center gap-3 w-full px-3 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white">
                🚪
                <span x-show="!collapsed">Logout</span>
            </button>
        </form>

    </div>

</aside>


@endsection
