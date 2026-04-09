@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative h-96 flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image:url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1920&q=80')">
            <div class="absolute inset-0 bg-slate-900/60"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 text-center text-white">
            <p class="text-amber-400 font-medium mb-2 tracking-wider uppercase text-sm">
                Our Story
            </p>

            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-4">
                About Grand Hotel
            </h1>

            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                A legacy of luxury hospitality spanning over two decades
            </p>
        </div>
    </section>


    {{-- Story Section --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">

                <h2 class="text-4xl font-serif font-bold text-slate-900 mb-6">
                    Our Heritage
                </h2>

                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p>
                        Founded in 1998, Grand Hotel has been a beacon of luxury and elegance
                        in the heart of the city. What began as a vision to create an
                        unparalleled hospitality experience has evolved into one of the most
                        prestigious hotels in the region.
                    </p>

                    <p>
                        Our commitment to excellence is reflected in every detail,
                        from our meticulously designed rooms to our world-class amenities.
                        We believe that true luxury lies not just in opulent surroundings,
                        but in the warmth of genuine hospitality and personalized service.
                    </p>

                    <p>
                        Over the years, we've had the privilege of hosting distinguished guests
                        from around the world, each leaving with memories that last a lifetime.
                        Our dedicated team works tirelessly to ensure every stay exceeds expectations.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- Stats Section --}}
    @php
        $stats = [
            ['icon' => 'award', 'value' => '25+', 'label' => 'Years of Excellence'],
            ['icon' => 'heart', 'value' => '50K+', 'label' => 'Happy Guests'],
            ['icon' => 'users', 'value' => '200+', 'label' => 'Dedicated Staff'],
            ['icon' => 'trending-up', 'value' => '98%', 'label' => 'Satisfaction Rate'],
        ];
    @endphp

    <section class="py-24 bg-gradient-to-b from-slate-50 to-white">
        <div class="container mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif font-bold text-slate-900 mb-4">
                    By the Numbers
                </h2>

                <p class="text-slate-600 text-lg">
                    Our journey in numbers tells a story of dedication and excellence
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach ($stats as $stat)
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">

                            @if ($stat['icon'] == 'award')
                                <i class="bi bi-award text-white text-4xl"></i>
                            @elseif($stat['icon'] == 'heart')
                                <i class="bi bi-heart-fill text-white text-4xl"></i>
                            @elseif($stat['icon'] == 'users')
                                <i class="bi bi-people-fill text-white text-4xl"></i>
                            @else
                                <i class="bi bi-graph-up-arrow text-white text-4xl"></i>
                            @endif
                        </div>

                        <div class="text-4xl font-bold text-slate-900 mb-2">
                            {{ $stat['value'] }}
                        </div>

                        <p class="text-slate-600">
                            {{ $stat['label'] }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
