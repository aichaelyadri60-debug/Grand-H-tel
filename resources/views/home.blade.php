@extends('layouts.app')

@section('content')
    <section class="h-150 flex items-center justify-center bg-cover bg-center"
        style="background-image:url('{{ asset('img/hero.jpg') }}')">

        <div class="text-center text-white bg-black/40 p-10 rounded-xl">
            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6">
                Welcome to Grand Hotel
            </h1>

            <p class="text-lg mb-8">
                Experience luxury, comfort and unforgettable moments
            </p>

            <a href="{{route('Room.index')}}" class="px-8 py-3 bg-amber-600 hover:bg-amber-700 rounded-lg font-semibold">
                Explore Rooms
            </a>

        </div>
    </section>


    <section class="py-24 bg-gradient-to-b from-white to-slate-50">

        <div class="container mx-auto px-6 text-center">

            <p class="text-amber-600 uppercase tracking-wider text-sm mb-2">
                Why Choose Us
            </p>

            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-4">
                Unparalleled Excellence
            </h2>

            <p class="text-slate-600 max-w-2xl mx-auto mb-16">
                Discover what makes Grand Hotel the premier choice for discerning travelers
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                @php
                    $features = [
                        [
                            'icon' => 'bi bi-star-fill',
                            'title' => '5-Star Service',
                            'desc' => 'Experience world-class hospitality with our dedicated staff available 24/7',
                        ],
                        [
                            'icon' => 'bi bi-award-fill',
                            'title' => 'Award Winning',
                            'desc' => 'Recognized globally for excellence in luxury accommodation and service',
                        ],
                        [
                            'icon' => 'bi bi-people-fill',
                            'title' => 'Guest Focused',
                            'desc' => 'Every detail is crafted with your comfort and satisfaction in mind',
                        ],
                        [
                            'icon' => 'bi bi-stars',
                            'title' => 'Premium Amenities',
                            'desc' => 'Enjoy state-of-the-art facilities and exclusive services',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="text-center">

                        <div
                            class="w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <i class="{{ $feature['icon'] }} text-white text-3xl"></i>
                        </div>

                        <h3 class="text-xl font-semibold mb-3">
                            {{ $feature['title'] }}
                        </h3>

                        <p class="text-slate-600">
                            {{ $feature['desc'] }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <section class="py-24 bg-white">

        <div class="container mx-auto px-6 text-center">

            <p class="text-amber-600 uppercase text-sm mb-2">
                Accommodations
            </p>

            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-4">
                Luxury Rooms & Suites
            </h2>

            <p class="text-slate-600 max-w-2xl mx-auto mb-16">
                Each room is thoughtfully designed to provide the ultimate comfort and elegance
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

                @php
                    $rooms = [
                        ['image' => 'img/rooms/deluxe.jpg', 'title' => 'Deluxe Room', 'price' => 299],
                        ['image' => 'img/rooms/executive.jpg', 'title' => 'Executive Suite', 'price' => 499],
                        ['image' => 'img/rooms/presidential.jpg', 'title' => 'Presidential Suite', 'price' => 799],
                    ];
                @endphp

                @foreach ($rooms as $room)
                    <div class="group relative h-96 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl">

                        <img src="{{ asset($room['image']) }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent">
                        </div>

                        <div class="absolute bottom-0 p-6 text-white text-left">
                            <h3 class="text-2xl font-serif font-bold">
                                {{ $room['title'] }}
                            </h3>

                            <p class="text-amber-400 text-xl font-semibold">
                                From ${{ $room['price'] }}/night
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

            <a href="{{ route('Room.index')}}" class="px-8 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-lg">
                View All Rooms
            </a>

        </div>
    </section>


    <section class="py-24 bg-gradient-to-br from-slate-900 to-slate-800 text-white text-center">

        <div class="container mx-auto px-6">

            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                Ready to Experience Luxury?
            </h2>

            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Book your stay today and discover why Grand Hotel is the preferred choice
                for luxury travelers
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <a href="{{route('Room.index')}}" class="px-8 py-3 bg-amber-600 hover:bg-amber-700 rounded-lg">
                    Book Now
                </a>

                <a href="{{ route('contact.index')}}"
                    class="px-8 py-3 bg-white/20 backdrop-blur text-white border border-white/30 rounded-lg hover:bg-white/30">
                    Contact Us
                </a>

            </div>

        </div>
    </section>
@endsection

