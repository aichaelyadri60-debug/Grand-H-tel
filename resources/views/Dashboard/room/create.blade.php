@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="min-h-screen bg-black/10 flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden">

        <div class="bg-amber-700 text-center pt-8 px-7">
            <div class="w-11 h-11 mx-auto mb-3 rounded-xl bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <path d="M9 22V12h6v10" />
                </svg>
            </div>

            <p class="text-[10px] tracking-widest uppercase text-amber-100">
                Room Management
            </p>

            <h2 class="text-2xl text-white font-serif mb-6">
                Add New Room
            </h2>

            <div class="h-6 bg-white rounded-t-2xl"></div>
        </div>

        <div class="px-7 pb-7 relative">

            <a href="{{ route('dashboard.rooms') }}"
                class="inline-flex items-center  mb-4 text-sm text-amber-700 font-medium hover:text-amber-900 absolute bottom-119 left-10">
                ← Retour
            </a>
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

            <form action="{{ route('dashboard.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex items-center gap-3 my-5">
                    <span class="text-xs uppercase tracking-widest text-gray-400">
                        Room details
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">

                    <div>
                        <label class="text-xs text-gray-400 uppercase">Room No.</label>
                        <input type="text" name="roomNumber" value="{{ old('roomNumber') }}"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-600 outline-none"
                            required>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase">Type</label>
                        <select name="type"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-600 outline-none"
                            required>
                            <option value="">Select</option>
                            <option>Single</option>
                            <option>Double</option>
                            <option>Suite</option>
                        </select>
                    </div>

                </div>

                <div class="mb-4">
                    <label class="text-xs text-gray-400 uppercase">Price per night</label>

                    <div class="relative mt-1">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-amber-700">$</span>

                        <input type="number" name="price"
                            class="w-full pl-7 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-600 outline-none"
                            required>
                    </div>
                </div>

                <div class="flex items-center gap-3 my-5">
                    <span class="text-xs uppercase tracking-widest text-gray-400">
                        Room status
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="grid grid-cols-3 gap-3 text-xs">

                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="available" checked class="peer hidden">

                        <div
                            class="p-3 rounded-xl border border-green-600
                            bg-green-50 text-green-700 text-center
                            peer-checked:ring-2 peer-checked:ring-green-500">
                            Available
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="occupied" class="peer hidden">

                        <div
                            class="p-3 rounded-xl border border-gray-200
                            bg-gray-50 text-gray-500 text-center
                            peer-checked:border-red-600
                            peer-checked:bg-red-50
                            peer-checked:text-red-700">
                            Occupied
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="maintenance" class="peer hidden">

                        <div
                            class="p-3 rounded-xl border border-gray-200
                            bg-gray-50 text-gray-500 text-center
                            peer-checked:border-amber-600
                            peer-checked:bg-amber-50
                            peer-checked:text-amber-700">
                            Maintenance
                        </div>
                    </label>

                </div>

                <div class="flex items-center gap-3 my-5">
                    <span class="text-xs uppercase tracking-widest text-gray-400">
                        Room image
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <input type="file" name="image"
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg">

                <button type="submit"
                    class="w-full mt-6 py-3 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                    Create Room
                </button>

            </form>
        </div>
    </div>
</div>
