<footer class="bg-slate-900 text-white">

    <div class="container mx-auto px-6 py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- BRAND --}}
            <div>
                <div class="flex items-center gap-3 mb-4">

                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center">
                        🏨
                    </div>

                    <div>
                        <h3 class="text-xl font-serif font-bold">Grand Hotel</h3>
                        <p class="text-xs text-slate-400">Luxury & Elegance</p>
                    </div>

                </div>

                <p class="text-slate-400 text-sm leading-relaxed">
                    Experience unparalleled luxury and comfort in the heart of the
                    city. Your perfect stay awaits.
                </p>
            </div>


            {{-- QUICK LINKS --}}
            <div>
                <h4 class="font-semibold text-lg mb-4">Quick Links</h4>

                <ul class="space-y-2 text-sm">

                    <li>
                        <a
                           class="text-slate-400 hover:text-amber-400 transition-colors">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/rooms-showcase') }}"
                           class="text-slate-400 hover:text-amber-400 transition-colors">
                            Rooms
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/services') }}"
                           class="text-slate-400 hover:text-amber-400 transition-colors">
                            Services
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/about') }}"
                           class="text-slate-400 hover:text-amber-400 transition-colors">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/contact') }}"
                           class="text-slate-400 hover:text-amber-400 transition-colors">
                            Contact
                        </a>
                    </li>

                </ul>
            </div>


            {{-- CONTACT INFO --}}
            <div>
                <h4 class="font-semibold text-lg mb-4">Contact Us</h4>

                <ul class="space-y-3 text-sm">

                    <li class="flex items-start gap-3">
                        <span class="text-amber-400">📍</span>
                        <span class="text-slate-400">
                            123 Luxury Avenue <br>
                            New York, NY 10001
                        </span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-amber-400">📞</span>
                        <span class="text-slate-400">
                            +1 (555) 123-4567
                        </span>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-amber-400">✉️</span>
                        <span class="text-slate-400">
                            info@grandhotel.com
                        </span>
                    </li>

                </ul>
            </div>


            {{-- SOCIAL MEDIA --}}
            <div>
                <h4 class="font-semibold text-lg mb-4">Follow Us</h4>

                <p class="text-slate-400 text-sm mb-4">
                    Stay connected with us on social media
                </p>

                <div class="flex gap-3">

                    <a href="#"
                       class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition-colors">
                        F
                    </a>

                    <a href="#"
                       class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition-colors">
                        I
                    </a>

                    <a href="#"
                       class="w-10 h-10 bg-slate-800 hover:bg-amber-600 rounded-lg flex items-center justify-center transition-colors">
                        T
                    </a>

                </div>
            </div>

        </div>
    </div>


    {{-- BOTTOM BAR --}}
    <div class="border-t border-slate-800">

        <div class="container mx-auto px-6 py-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-400">

                <p>© {{ date('Y') }} Grand Hotel. All rights reserved.</p>

                <div class="flex gap-6">
                    <a href="#" class="hover:text-amber-400 transition-colors">
                        Privacy Policy
                    </a>

                    <a href="#" class="hover:text-amber-400 transition-colors">
                        Terms of Service
                    </a>
                </div>

            </div>

        </div>

    </div>

</footer>
