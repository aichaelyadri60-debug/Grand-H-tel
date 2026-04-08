

@vite(['resources/css/app.css','resources/js/app.js'])

<div class="min-h-screen bg-black/70 flex items-center justify-center p-6">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden">

        <div class="bg-amber-700 text-center pt-7 px-7 relative">

            <div class="w-11 h-11 mx-auto mb-2 rounded-xl bg-white/20
                        flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>

            <p class="text-[10px] tracking-widest uppercase text-amber-100">
                Room Management
            </p>

            <h2 class="text-white text-xl font-serif mt-1 mb-5">
                Edit Room
            </h2>

            <div class="h-6 bg-white rounded-t-2xl"></div>
        </div>

        <div class="px-7 pb-6">

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('dashboard.rooms.edit',$room->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-3 my-4">
                    <span class="text-[10px] uppercase tracking-widest text-gray-500 font-medium">
                        Room details
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label class="text-[10px] uppercase tracking-wider text-gray-500">
                            Room No.
                        </label>

                        <input type="text" name="roomNumber"
                            value="{{ old('roomNumber',$room->roomNumber) }}"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border
                                   border-gray-200 rounded-lg text-sm
                                   focus:ring-2 focus:ring-amber-300 outline-none">
                    </div>

                    <div>
                        <label class="text-[10px] uppercase tracking-wider text-gray-500">
                            Type
                        </label>

                        <select name="type"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border
                                   border-gray-200 rounded-lg text-sm
                                   focus:ring-2 focus:ring-amber-300 outline-none">

                            <option value="Single" {{ $room->type=='Single'?'selected':'' }}>Single</option>
                            <option value="Double" {{ $room->type=='Double'?'selected':'' }}>Double</option>
                            <option value="Suite" {{ $room->type=='Suite'?'selected':'' }}>Suite</option>

                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <label class="text-[10px] uppercase tracking-wider text-gray-500">
                        Price per night
                    </label>

                    <div class="relative mt-1">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-amber-700 font-semibold text-sm">$</span>

                        <input type="number" step="0.01" name="price"
                            value="{{ old('price',$room->price) }}"
                            class="w-full pl-7 pr-3 py-2 bg-gray-50 border
                                   border-gray-200 rounded-lg text-sm
                                   focus:ring-2 focus:ring-amber-300 outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-3 my-5">
                    <span class="text-[10px] uppercase tracking-widest text-gray-500 font-medium">
                        Room status
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <input type="hidden" name="status" id="statusInput"
                       value="{{ $room->status }}">

                <div class="grid grid-cols-3 gap-3">

                    @foreach([
                        ['available','bg-emerald-50 border-emerald-500 text-emerald-700','Available','bg-emerald-500'],
                        ['occupied','bg-red-50 border-red-500 text-red-700','Occupied','bg-red-500'],
                        ['maintenance','bg-amber-50 border-amber-500 text-amber-700','Maintenance','bg-amber-500'],
                    ] as [$value,$active,$label,$dot])

                    <button type="button"
                        onclick="setStatus('{{ $value }}')"
                        id="pill-{{ $value }}"
                        class="status-pill flex flex-col items-center gap-2 py-3 rounded-xl border text-xs font-medium
                        {{ $room->status==$value ? $active : 'bg-gray-50 border-gray-200 text-gray-500' }}">

                        <span class="w-2 h-2 rounded-full {{ $dot }}"></span>
                        {{ $label }}

                    </button>

                    @endforeach

                </div>

                <div class="flex justify-between items-center pt-6 mt-6 border-t">

                    <a href="{{ route('dashboard.rooms') }}"
                       class="flex items-center gap-2 px-4 py-2 border rounded-lg
                              text-gray-600 hover:bg-gray-100 text-sm">
                        ← Back
                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 bg-amber-700
                               hover:bg-amber-800 text-white rounded-lg text-sm font-medium">
                        ✓ Update Room
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
function setStatus(val){
    document.getElementById('statusInput').value = val;

    document.querySelectorAll('.status-pill').forEach(p=>{
        p.classList.remove(
            'bg-emerald-50','border-emerald-500','text-emerald-700',
            'bg-red-50','border-red-500','text-red-700',
            'bg-amber-50','border-amber-500','text-amber-700'
        );
        p.classList.add('bg-gray-50','border-gray-200','text-gray-500');
    });

    const active = document.getElementById('pill-'+val);

    if(val==='available')
        active.className += ' bg-emerald-50 border-emerald-500 text-emerald-700';
    if(val==='occupied')
        active.className += ' bg-red-50 border-red-500 text-red-700';
    if(val==='maintenance')
        active.className += ' bg-amber-50 border-amber-500 text-amber-700';
}
</script>


