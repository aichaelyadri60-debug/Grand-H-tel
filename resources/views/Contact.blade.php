@extends('layouts.app')

@section('content')

{{-- HERO SECTION : pleine largeur --}}
<section class="relative h-96 flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=80')">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950/75 to-slate-900/55"></div>
    </div>

    <div class="relative z-10 text-center text-white px-6">

        <div class="flex items-center justify-center gap-3 mb-4">
            <span class="w-8 h-px bg-amber-400/60"></span>
            <p class="text-[11px] font-medium tracking-[0.22em] uppercase text-amber-400">Get in Touch</p>
            <span class="w-8 h-px bg-amber-400/60"></span>
        </div>

        <h1 class="font-serif text-5xl md:text-6xl font-bold leading-tight tracking-tight mb-4">
            Contact Us
        </h1>

        <p class="text-[15px] font-light text-white/80 max-w-md mx-auto leading-relaxed">
            We're here to help make your stay unforgettable
        </p>

    </div>

</section>


{{-- CONTENU CENTRÉ --}}
<div class="max-w-7xl mx-auto px-6 py-24">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

        {{-- CONTACT FORM --}}
        <div>

            <p class="text-[10.5px] font-medium tracking-[0.2em] uppercase text-slate-400 mb-1">
                Write to us
            </p>
            <h2 class="font-serif text-3xl font-bold text-slate-900 leading-tight mb-8">
                Send us a Message
            </h2>

            <form method="POST" action="#">
                @csrf

                <div class="space-y-4">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[15px]">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="name" placeholder="Full Name"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200
                                       text-sm text-slate-700 placeholder-slate-400
                                       focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                       transition"
                                required>
                        </div>

                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[15px]">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" placeholder="Email Address"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200
                                       text-sm text-slate-700 placeholder-slate-400
                                       focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                       transition"
                                required>
                        </div>

                    </div>

                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[15px]">
                            <i class="bi bi-telephone"></i>
                        </span>
                        <input type="tel" name="phone" placeholder="Phone Number"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200
                                   text-sm text-slate-700 placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                   transition">
                    </div>

                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[15px]">
                            <i class="bi bi-chat-left-text"></i>
                        </span>
                        <input type="text" name="subject" placeholder="Subject"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200
                                   text-sm text-slate-700 placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                                   transition"
                            required>
                    </div>

                    <textarea name="message" rows="6"
                        placeholder="Tell us how we can help you..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200
                               text-sm text-slate-700 placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent
                               transition resize-none"
                        required></textarea>

                    <button type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-400 text-[#1A1209] font-medium
                               text-[13.5px] py-3 rounded-xl transition-colors duration-150 tracking-wide
                               flex items-center justify-center gap-2">
                        <i class="bi bi-send"></i>
                        Send Message
                    </button>

                </div>
            </form>

        </div>


        {{-- CONTACT INFO --}}
        <div>

            <p class="text-[10.5px] font-medium tracking-[0.2em] uppercase text-slate-400 mb-1">
                Find us
            </p>
            <h2 class="font-serif text-3xl font-bold text-slate-900 leading-tight mb-8">
                Contact Information
            </h2>

            <div class="space-y-6">

                {{-- ADDRESS --}}
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 flex-shrink-0 bg-amber-50 rounded-xl flex items-center justify-center
                                text-amber-700 text-[18px]">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-slate-900 mb-1">Address</h3>
                        <p class="text-[13.5px] font-light text-slate-500 leading-relaxed">
                            123 Luxury Avenue<br>
                            New York, NY 10001<br>
                            United States
                        </p>
                    </div>
                </div>

                {{-- PHONE --}}
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 flex-shrink-0 bg-amber-50 rounded-xl flex items-center justify-center
                                text-amber-700 text-[18px]">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-slate-900 mb-1">Phone</h3>
                        <p class="text-[13.5px] font-light text-slate-500 leading-relaxed">
                            +1 (555) 123-4567<br>
                            +1 (555) 123-4568
                        </p>
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 flex-shrink-0 bg-amber-50 rounded-xl flex items-center justify-center
                                text-amber-700 text-[18px]">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-slate-900 mb-1">Email</h3>
                        <p class="text-[13.5px] font-light text-slate-500 leading-relaxed">
                            info@grandhotel.com<br>
                            reservations@grandhotel.com
                        </p>
                    </div>
                </div>

                {{-- HOURS --}}
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 flex-shrink-0 bg-amber-50 rounded-xl flex items-center justify-center
                                text-amber-700 text-[18px]">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-slate-900 mb-1">Hours</h3>
                        <p class="text-[13.5px] font-light text-slate-500 leading-relaxed">
                            Front Desk: 24/7<br>
                            Restaurant: 6:00 AM – 11:00 PM<br>
                            Spa: 9:00 AM – 9:00 PM
                        </p>
                    </div>
                </div>

            </div>

            {{-- DIVIDER --}}
            <hr class="border-slate-200 my-8">

        </div>

    </div>

</div>

@endsection
