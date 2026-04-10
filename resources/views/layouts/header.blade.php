<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent py-5">


    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between">

            <a class="flex items-center gap-3 group cursor-pointer">
                <div id="logoIcon"
                    class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 transition-all duration-300">

                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="M3 21h18M4 21V7l8-4 8 4v14" />
                    </svg>
                </div>
                <div>
                    <h1 id="logoTitle"
                        class="text-xl font-serif font-bold text-white transition-colors duration-300 leading-tight">
                        Grand Hotel
                    </h1>

                    <p id="logoSub" class="text-xs text-white/70 transition-colors duration-300 tracking-wide">

                        Luxury &amp; Elegance
                    </p>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-8">

                <a href="{{ route('homepage') }}"
                    class="nav-link relative text-sm font-medium text-white/90 hover:text-amber-300 transition-colors duration-200 cursor-pointer
                           after:absolute after:-bottom-0.5 after:left-0 after:w-0 after:h-px after:bg-amber-400 after:transition-all after:duration-300 hover:after:w-full">
                    Home
                </a>
                <a href="{{ route('Room.index') }}"
                    class="nav-link relative text-sm font-medium text-white/90 hover:text-amber-300 transition-colors duration-200 cursor-pointer
                           after:absolute after:-bottom-0.5 after:left-0 after:w-0 after:h-px after:bg-amber-400 after:transition-all after:duration-300 hover:after:w-full">
                    Rooms
                </a>
                <a href="{{ route('services.index') }}"
                    class="nav-link relative text-sm font-medium text-white/90 hover:text-amber-300 transition-colors duration-200 cursor-pointer
                           after:absolute after:-bottom-0.5 after:left-0 after:w-0 after:h-px after:bg-amber-400 after:transition-all after:duration-300 hover:after:w-full">
                    Services
                </a>
                <a href="{{ route('about') }}"
                    class="nav-link relative text-sm font-medium text-white/90 hover:text-amber-300 transition-colors duration-200 cursor-pointer
                           after:absolute after:-bottom-0.5 after:left-0 after:w-0 after:h-px after:bg-amber-400 after:transition-all after:duration-300 hover:after:w-full">
                    About Us
                </a>
                <a href="{{ route('contact.index') }}"
                    class="nav-link relative text-sm font-medium text-white/90 hover:text-amber-300 transition-colors duration-200 cursor-pointer

                           after:absolute after:-bottom-0.5 after:left-0 after:w-0 after:h-px after:bg-amber-400 after:transition-all after:duration-300 hover:after:w-full">
                    Contact
                </a>
            </div>

            @auth
                @if (auth()->user()->role === 'client')
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('client.reservations') }}" id="staffBtn"
                            class="px-5 py-2 rounded-xl text-sm font-medium
            bg-white/15 backdrop-blur-sm text-white border border-white/25
            hover:bg-white/25 hover:border-white/40 transition-all duration-200 cursor-pointer">
                            dashboard
                        </a>
                    </div>
                @else
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('dashboard.statistique') }}" id="staffBtn"
                            class="px-5 py-2 rounded-xl text-sm font-medium
            bg-white/15 backdrop-blur-sm text-white border border-white/25
            hover:bg-white/25 hover:border-white/40 transition-all duration-200 cursor-pointer">
                            dashboard
                        </a>
                    </div>
                @endif




            @endauth

            @guest


                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('Showlogin') }}" id="staffBtn"
                        class="px-5 py-2 rounded-xl text-sm font-medium
                           bg-white/15 backdrop-blur-sm text-white border border-white/25
                           hover:bg-white/25 hover:border-white/40 transition-all duration-200 cursor-pointer">
                        Register / Login

                    </a>
                </div>
            @endguest

            <button id="menuBtn"
                class="lg:hidden p-2 rounded-xl text-white hover:bg-white/10 transition-colors duration-200">

                <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path id="menuIconPath" stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />

                </svg>
            </button>

        </div>
    </div>

    <div id="mobileMenu"
        class="hidden lg:hidden mt-3 mx-4 rounded-2xl bg-white shadow-xl shadow-gray-200/80 border border-amber-100 overflow-hidden">

        <div class="px-6 py-5 space-y-1">

            <a href="{{ route('homepage') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-600 text-sm font-medium hover:bg-amber-50 hover:text-amber-600 transition-colors duration-200 cursor-pointer">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Home
            </a>
            <a href="{{ route('Room.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-600 text-sm font-medium hover:bg-amber-50 hover:text-amber-600 transition-colors duration-200 cursor-pointer">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="14" rx="2" />
                    <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                </svg>
                Rooms
            </a>
            <a href="{{ route('services.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-600 text-sm font-medium hover:bg-amber-50 hover:text-amber-600 transition-colors duration-200 cursor-pointer">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
                Services
            </a>
            <a
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-600 text-sm font-medium hover:bg-amber-50 hover:text-amber-600 transition-colors duration-200 cursor-pointer">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
                </svg>
                About Us
            </a>
            <a
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-600 text-sm font-medium hover:bg-amber-50 hover:text-amber-600 transition-colors duration-200 cursor-pointer">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M22 16.92V19a2 2 0 01-2.18 2A19.79 19.79 0 013 4.18 2 2 0 015 2h2.09a2 2 0 012 1.72c.12.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.58 2.81.7A2 2 0 0122 16.92z" />
                </svg>

                Contact
            </a>

            <div class="h-px bg-amber-100 my-2"></div>

            @auth
                @if (auth()->user()->role === 'client')
                    <a href="{{ route('client.dashboard') }}"
                        class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 text-white text-sm font-semibold shadow-md shadow-amber-200 hover:from-amber-600 hover:to-amber-500 transition-all duration-200">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                        </svg>

                        Reservations
                    </a>
                @else
                    <a href="{{ route('dashboard.statistique') }}"
                        class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 text-white text-sm font-semibold shadow-md shadow-amber-200 hover:from-amber-600 hover:to-amber-500 transition-all duration-200">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                        </svg>

                        Dashboard
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('Showlogin') }}" id="staffBtn"
                    class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 text-white text-sm font-semibold shadow-md shadow-amber-200 hover:from-amber-600 hover:to-amber-500 transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                    </svg>

                    Register / Login
                </a>
            @endguest

        </div>
    </div>
</nav>


<script>
    (function() {
        const navbar = document.getElementById('navbar');
        const logoTitle = document.getElementById('logoTitle');
        const logoSub = document.getElementById('logoSub');
        const staffBtn = document.getElementById('staffBtn');
        const navLinks = document.querySelectorAll('.nav-link');
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        let menuOpen = false;

        function onScroll() {
            const scrolled = window.scrollY > 60;

            navbar.classList.toggle('bg-transparent', !scrolled);
            navbar.classList.toggle('py-5', !scrolled);
            navbar.classList.toggle('bg-white', scrolled);
            navbar.classList.toggle('shadow-md', scrolled);
            navbar.classList.toggle('shadow-gray-200/70', scrolled);
            navbar.classList.toggle('py-3', scrolled);
            navbar.classList.toggle('border-b', scrolled);
            navbar.classList.toggle('border-amber-100', scrolled);

            logoTitle.classList.toggle('text-white', !scrolled);
            logoTitle.classList.toggle('text-gray-800', scrolled);
            logoSub.classList.toggle('text-white/70', !scrolled);
            logoSub.classList.toggle('text-gray-400', scrolled);


            navLinks.forEach(link => {
                link.classList.toggle('text-white/90', !scrolled);
                link.classList.toggle('hover:text-amber-300', !scrolled);
                link.classList.toggle('text-gray-600', scrolled);
                link.classList.toggle('hover:text-amber-500', scrolled);
            });

            if (staffBtn) {
                staffBtn.classList.toggle('bg-white/15', !scrolled);
                staffBtn.classList.toggle('border-white/25', !scrolled);
                staffBtn.classList.toggle('text-white', !scrolled);
                staffBtn.classList.toggle('hover:bg-white/25', !scrolled);

                staffBtn.classList.toggle('bg-gradient-to-r', scrolled);
                staffBtn.classList.toggle('from-amber-500', scrolled);
                staffBtn.classList.toggle('to-amber-400', scrolled);
                staffBtn.classList.toggle('border-transparent', scrolled);
                staffBtn.classList.toggle('text-white', scrolled);
                staffBtn.classList.toggle('shadow-md', scrolled);
                staffBtn.classList.toggle('shadow-amber-200', scrolled);
            }

            menuBtn.classList.toggle('text-white', !scrolled);
            menuBtn.classList.toggle('text-gray-700', scrolled);
            menuBtn.classList.toggle('hover:bg-white/10', !scrolled);
            menuBtn.classList.toggle('hover:bg-gray-100', scrolled);
        }

        menuBtn.addEventListener('click', function() {
            menuOpen = !menuOpen;
            mobileMenu.classList.toggle('hidden', !menuOpen);
        });

        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        onScroll();
    })();
</script>
