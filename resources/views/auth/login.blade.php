@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen grid md:grid-cols-2 bg-[#F8F5F1]">


    <div class="hidden md:block relative">


        <img src="{{ asset('img/imaaaaage.webp') }}" alt="Hotel" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 h-full flex flex-col justify-between p-12 text-white">

            <a href="/" class="text-white/80 hover:text-white text-sm">
                ← Back to Home
            </a>

            <div>
                <h1 class="text-4xl font-semibold leading-snug">
                    Hotel Management
                </h1>

                <p class="mt-4 text-sm text-white/80 max-w-md">
                    Gérez vos chambres, réservations et clients
                    avec une plateforme moderne conçue pour les hôtels.
                </p>
            </div>

            <p class="text-xs text-white/60">
                © {{ date('Y') }} Hotel Manager
            </p>

        </div>
    </div>



    <div class="flex items-center justify-center px-6">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10 border border-gray-100">

            <div class="mb-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Connexion
                </h2>
                <p class="text-sm text-gray-400 mt-1">
                    Accédez à votre tableau de bord
                </p>
            </div>

            @if ($errors->any())
                <div id="errorBox"
                    class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div id="successBox"
                    class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div id="errorBox"
                    class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif


            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full border border-gray-200 rounded-lg px-4 py-2.5
                                  focus:ring-2 focus:ring-amber-400
                                  focus:border-amber-400 outline-none transition">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Mot de passe
                    </label>

                    <input type="password" name="password" required
                        class="mt-1 w-full border border-gray-200 rounded-lg px-4 py-2.5
                                  focus:ring-2 focus:ring-amber-400
                                  focus:border-amber-400 outline-none transition">
                </div>

                <button type="submit"
                    class="w-full bg-amber-600 text-white py-3 rounded-lg
                               font-medium hover:bg-amber-700 transition">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Pas encore de compte ?
                <a href="{{ route('Showregister') }}" class="text-amber-600 font-medium hover:underline">
                    Créer un compte
                </a>
            </p>

        </div>
    </div>
</div>



