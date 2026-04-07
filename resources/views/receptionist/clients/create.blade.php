

@vite(['resources/css/app.css','resources/js/app.js'])

<div class="min-h-screen bg-black/70 flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden">

        <div class="bg-amber-700 text-center pt-8 px-8 relative">

            <div class="w-11 h-11 mx-auto mb-3 rounded-xl bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>

            <p class="text-[10px] tracking-widest uppercase text-amber-100">
                Client Management
            </p>

            <h2 class="text-white text-2xl font-serif mt-1 mb-6">
                Create Client
            </h2>

            <div class="h-6 bg-white rounded-t-2xl"></div>
        </div>


        <div class="px-8 pb-8 pt-4">


            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif


            @if (session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{route('Client.store')}}" method="POST">
                @csrf

                <div class="flex items-center gap-3 my-5">
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">
                        Client Details
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Name
                    </label>

                    <input type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="ex: Aicha"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="ex: aicha@gmail.com"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>


                <div class="mb-6">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Phone Number
                    </label>

                    <input type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="ex: 0600000000"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>

                <div class="flex justify-between items-center pt-6 border-t">

                    <a href="{{ route('clients.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium
                               text-gray-600 border border-gray-300 rounded-lg
                               hover:bg-gray-100 transition">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>

                        Back
                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 bg-amber-700 text-white
                               rounded-lg text-sm font-medium
                               hover:bg-amber-800 transition shadow-sm">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>

                        Create
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>


