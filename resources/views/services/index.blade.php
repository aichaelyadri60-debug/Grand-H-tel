@extends('layouts.app')

@section('content')

    {{-- HERO : pleine largeur, pas de conteneur --}}
    <section class="relative h-[420px] flex items-center justify-center overflow-hidden mb-10">

        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1400&q=80')">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950/75 to-slate-900/55"></div>
        </div>

        <div class="relative z-10 text-center text-white px-6">

            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="w-8 h-px bg-amber-400/60"></span>
                <p class="text-[11px] font-medium tracking-[0.22em] uppercase text-amber-400">Amenities</p>
                <span class="w-8 h-px bg-amber-400/60"></span>
            </div>

            <h1 class="font-serif text-5xl md:text-6xl font-bold leading-tight tracking-tight mb-4">
                Hotel Services
            </h1>

            <p class="text-[15px] font-light text-white/80 max-w-md mx-auto leading-relaxed">
                Exceptional amenities designed to enhance every moment of your stay
            </p>

        </div>

    </section>


    {{-- TOUT LE CONTENU CENTRÉ dans ce seul conteneur --}}
    <div class="max-w-7xl mx-auto px-6">

        {{-- STATS --}}
        <div class="grid grid-cols-3 gap-4 mb-10">
            @foreach ([
                ['num' => '24/7',  'label' => 'Guest support'],
                ['num' => '100+',  'label' => 'Premium services'],
                ['num' => '5★',    'label' => 'Luxury rating'],
            ] as $stat)
                <div class="bg-slate-100 rounded-xl p-4 text-center">
                    <div class="font-serif text-[2rem] font-bold text-amber-600 leading-none mb-1">
                        {{ $stat['num'] }}
                    </div>
                    <div class="text-xs text-slate-500">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>


        {{-- SERVICES HEADER --}}
        <div class="flex items-end justify-between gap-4 flex-wrap mb-6">

            <div>
                <p class="text-[10.5px] font-medium tracking-[0.2em] uppercase text-slate-400 mb-1">
                    What we offer
                </p>
                <h2 class="font-serif text-3xl font-bold text-slate-900 leading-tight">
                    Everything for a perfect stay
                </h2>
            </div>

            <p class="text-[13.5px] font-light text-slate-500 max-w-xs leading-relaxed">
                At Grand Hotel, we believe in providing more than just accommodation — every detail is curated for you.
            </p>

        </div>


        {{-- SERVICES GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">

            @foreach ($services as $service)

                <div class="group relative bg-white border border-slate-200/80 rounded-2xl p-5 cursor-pointer
                            hover:border-slate-300 hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">

                    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-amber-500
                                scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300">
                    </div>

                    <div class="w-11 h-11 rounded-full bg-amber-50 flex items-center justify-center
                                text-amber-700 text-[19px] mb-4">
                        @switch($service['icon'])
                            @case('utensils')   <i class="bi bi-egg-fried"></i>   @break
                            @case('waves')      <i class="bi bi-water"></i>        @break
                            @case('wifi')       <i class="bi bi-wifi"></i>         @break
                            @case('car')        <i class="bi bi-car-front"></i>    @break
                            @case('dumbbell')   <i class="bi bi-activity"></i>     @break
                            @case('coffee')     <i class="bi bi-cup-hot"></i>      @break
                            @case('shield')     <i class="bi bi-shield-check"></i> @break
                            @case('headphones') <i class="bi bi-headphones"></i>   @break
                        @endswitch
                    </div>

                    <h3 class="text-sm font-medium text-slate-900 mb-1.5 leading-snug">
                        {{ $service['title'] }}
                    </h3>

                    <p class="text-[12.5px] font-light text-slate-500 leading-relaxed">
                        {{ $service['description'] }}
                    </p>

                    @isset($service['availability'])
                        <p class="mt-3 text-[11px] font-medium text-amber-600 tracking-wide">
                            {{ $service['availability'] }}
                        </p>
                    @endisset

                </div>

            @endforeach

        </div>


        {{-- DIVIDER --}}
        <hr class="border-slate-200 my-8">


        {{-- CTA BAND --}}
        <div class="bg-[#1A1209] rounded-2xl px-8 py-8 flex items-center justify-between gap-6 flex-wrap mb-10">

            <div>
                <h2 class="font-serif text-[1.4rem] font-bold text-[#F5ECD7] mb-1">
                    Ready to experience Grand Hotel?
                </h2>
                <p class="text-[13px] font-light text-[#F5ECD7]/55">
                    Reserve your suite today and enjoy every amenity from day one.
                </p>
            </div>

            <a href="{{ route('Room.index') }}"
               class="flex-shrink-0 bg-amber-500 hover:bg-amber-400 text-[#1A1209] font-medium
                      text-[13.5px] px-6 py-2.5 rounded-xl transition-colors duration-150 tracking-wide">
                Book your stay →
            </a>

        </div>

    </div>{{-- fin max-w-7xl --}}

@endsection
