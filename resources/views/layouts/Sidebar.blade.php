@php
    $userRole = auth()->user()->role ?? 'guest';
    $userName = auth()->user()->name ?? 'Utilisateur';
    // dd($userRole);
    $initials = collect(explode(' ', $userName))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
    $navItems = [
        [
            'path' => 'receptionnist.dashboard',
            'label' => 'Dashboard',
            'icon' => 'layout-dashboard',
            'roles' => ['admin', 'Receptionniste'],
        ],
        [
            'path' => 'receptionnist.dashboard.room',
            'label' => 'Rooms',
            'icon' => 'bed-double',
            'roles' => ['admin', 'Receptionniste'],
        ],
        [
            'path' => 'Room.index',
            'label' => 'Clients',
            'icon' => 'users',
            'roles' => ['admin', 'Receptionniste'],
        ],
        [
            'path' => 'Reservations.index',
            'label' => 'Reservations',
            'icon' => 'calendar-check',
            'roles' => ['admin', 'Receptionniste'],
        ],
        [
            'path' => 'Room.index',
            'label' => 'Payments',
            'icon' => 'credit-card',
            'roles' => ['admin'],
        ],
    ];
@endphp

<aside class="fixed left-0 top-0 h-screen  bg-slate-900 w-65 text-white flex flex-col transition-all duration-300">

    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800">

        <div class="flex items-center gap-3 overflow-hidden">
            <div id="logoIcon"
                class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 transition-all duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 21h18M4 21V7l8-4 8 4v14" />
                </svg>
            </div>

            <span x-show="!collapsed" class="font-semibold text-lg whitespace-nowrap">
                Grand Hotel
            </span>
        </div>


    </div>
    <div class="px-4 py-4 border-b border-slate-800">
        <div class="flex items-center gap-3">

            <div
                class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold text-white flex-shrink-0
                 bg-gradient-to-br from-blue to-cyan-600 ">
                {{ $initials }}
            </div>

            <div class="min-w-0 leading-tight">
                <p class="text-sm font-medium text-slate-200 truncate">
                    {{ $userName }}
                </p>
                <p class="text-xs text-slate-500 truncate">
                    {{ $userRole === 'admin' ? 'Administrateur' : 'Réceptionniste' }}
                </p>
            </div>

        </div>
    </div>




    <nav class="flex-1 py-6 px-3 space-y-1 overflow-y-auto">

        @foreach ($navItems as $item)
            @if (in_array($userRole, $item['roles']))
                <a href="{{ route($item['path']) }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg
                   {{ request()->routeIs($item['path'])
                       ? 'bg-teal-600 text-white'
                       : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">


                    <span x-show="!collapsed" class="font-medium whitespace-nowrap">
                        {{ $item['label'] }}
                    </span>

                </a>
            @endif
        @endforeach

    </nav>
    <div class="p-3 border-t border-slate-800 space-y-1">

        <a href="/"
            class="flex items-center gap-3 w-full px-3 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white">

            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5M5 9.5V21h14V9.5" />
            </svg>
            <span x-show="!collapsed">Public Site</span>
        </a>

        <form method="POST" action="{{route('logout')}}">
            @csrf
            <button
                class="flex items-center gap-3 w-full px-3 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white">
                <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12h-9m0 0l3-3m-3 3l3 3" />
                </svg>
                <span x-show="!collapsed">Logout</span>
            </button>
        </form>

    </div>

</aside>
