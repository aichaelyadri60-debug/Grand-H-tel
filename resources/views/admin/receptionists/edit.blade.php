

@vite(['resources/css/app.css','resources/js/app.js'])

<div class="min-h-screen bg-black/70 flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-br from-[#D85A30] to-[#EF9F27] text-center pt-8 px-8 relative">

            <div class="w-11 h-11 mx-auto mb-3 rounded-xl bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M12 14c4 0 7 2 7 4v2H5v-2c0-2 3-4 7-4z"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>

            <p class="text-[10px] tracking-widest uppercase text-amber-100">
                Staff Management
            </p>

            <h2 class="text-white text-2xl font-serif mt-1 mb-6">
                Edit Receptionist
            </h2>

            <div class="h-6 bg-white rounded-t-2xl"></div>
        </div>

        {{-- FORM --}}
        <div class="px-8 pb-8 pt-4">

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST"
                action="{{ route('admin.receptionists.update', $receptionist->id) }}">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-3 my-5">
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">
                        Receptionist Details
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- NAME --}}
                <div class="mb-4">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Name
                    </label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $receptionist->name) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>

                {{-- EMAIL --}}
                <div class="mb-4">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        value="{{ old('email', $receptionist->email) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>

                {{-- PHONE --}}
                <div class="mb-6">
                    <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1">
                        Phone Number
                    </label>

                    <input type="tel"
                        name="phone"
                        value="{{ old('phone', $receptionist->phone) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm
                               focus:ring-2 focus:ring-amber-300 focus:border-amber-400 outline-none">
                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-between items-center pt-6 border-t">

                    <a href="{{ route('admin.receptionists.index') }}"
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
                        class="flex items-center gap-2 px-5 py-2 bg-gradient-to-br from-[#D85A30] to-[#EF9F27] text-white
                               rounded-lg text-sm font-medium
                               hover:bg-green-700 transition shadow-sm">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>

                        Update
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>


