        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <div
            style="min-height:100vh;background:rgba(15,10,5,0.72);display:flex;align-items:center;justify-content:center;padding:24px;">

            <div
                style="background:var(--color-background-primary,#fff);border-radius:20px;width:100%;max-width:480px;overflow:hidden;box-shadow:0 24px 60px rgba(0,0,0,0.25);">

                <div style="background:#B45309;padding:28px 28px 0;text-align:center;position:relative;">
                    <div
                        style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.18);display:flex;align-items:center;justify-content:center;margin:0 auto 10px">
                        <svg style="width:22px;height:22px;color:#fff" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <p
                        style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,230,180,0.8);font-weight:500;margin-bottom:4px">
                        Room Management</p>
                    <h2 style="font-family:Georgia,serif;color:#fff;font-size:22px;font-weight:400;margin-bottom:20px">
                        Edit Room</h2>
                    <div style="height:22px;background:#fff;border-radius:22px 22px 0 0"></div>
                </div>

                <div style="padding:4px 28px 0">
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
                    <form action="{{ route('updateRoom', $room->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="display:flex;align-items:center;gap:10px;margin:18px 0 14px">
                            <span
                                style="font-size:10px;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;color:#888;white-space:nowrap">Room
                                details</span>
                            <div style="flex:1;height:0.5px;background:#e5e7eb"></div>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                            <div>
                                <label
                                    style="display:flex;align-items:center;gap:6px;font-size:10px;font-weight:500;letter-spacing:0.09em;text-transform:uppercase;color:#888;margin-bottom:6px">
                                    Room No.
                                </label>
                                <input type="text" name="roomNumber"
                                    value="{{ old('roomNumber', $room->roomNumber) }}" required placeholder="ex: 214"
                                    style="width:100%;padding:9px 14px;background:#f9fafb;border:0.5px solid #e5e7eb;border-radius:10px;font-size:13px;outline:none">
                            </div>
                            <div>
                                <label
                                    style="display:flex;align-items:center;gap:6px;font-size:10px;font-weight:500;letter-spacing:0.09em;text-transform:uppercase;color:#888;margin-bottom:6px">
                                    Type
                                </label>
                                <div style="position:relative">
                                    <select name="type" required
                                        style="width:100%;padding:9px 32px 9px 14px;background:#f9fafb;border:0.5px solid #e5e7eb;border-radius:10px;font-size:13px;appearance:none;outline:none">
                                        <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single
                                        </option>
                                        <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double
                                        </option>
                                        <option value="Suite" {{ $room->type == 'Suite' ? 'selected' : '' }}>Suite
                                        </option>
                                    </select>
                                    <svg style="position:absolute;right:10px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#888;pointer-events:none"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:14px">
                            <label
                                style="display:flex;align-items:center;gap:6px;font-size:10px;font-weight:500;letter-spacing:0.09em;text-transform:uppercase;color:#888;margin-bottom:6px">
                                Price per night
                            </label>
                            <div style="position:relative">
                                <span
                                    style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#B45309;font-weight:600;font-size:13px">$</span>
                                <input type="number" name="price" step="0.01"
                                    value="{{ old('price', $room->price) }}" required placeholder="0.00"
                                    style="width:100%;padding:9px 14px 9px 26px;background:#f9fafb;border:0.5px solid #e5e7eb;border-radius:10px;font-size:13px;outline:none">
                            </div>
                        </div>

                        <div style="display:flex;align-items:center;gap:10px;margin:18px 0 14px">
                            <span
                                style="font-size:10px;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;color:#888;white-space:nowrap">Room
                                status</span>
                            <div style="flex:1;height:0.5px;background:#e5e7eb"></div>
                        </div>

                        <select name="status" id="statusSelect" style="display:none">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied
                            </option>
                            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>
                                Maintenance
                            </option>
                        </select>

                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px">
                            @foreach ([['available', '#1D9E75', '#0F6E56', 'rgba(29,158,117,0.08)', '#0F9A6E', 'Available'], ['occupied', '#E24B4A', '#A32D2D', 'rgba(226,75,74,0.07)', '#E24B4A', 'Occupied'], ['maintenance', '#D97706', '#854F0B', 'rgba(212,119,6,0.09)', '#D97706', 'Maintenance']] as [$val, $dot, $text, $bg, $border, $label])
                                <button type="button" id="pill-{{ $val }}"
                                    onclick="setStatus('{{ $val }}')"
                                    style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 8px;border-radius:12px;font-size:11px;font-weight:500;font-family:inherit;cursor:pointer;transition:all 0.18s;
                        {{ $room->status == $val ? "border:1.5px solid {$border};background:{$bg};color:{$text}" : 'border:1.5px solid #e5e7eb;background:#f9fafb;color:#888' }}">
                                    <span
                                        style="width:9px;height:9px;border-radius:50%;background:{{ $dot }}"></span>
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>



                        <div
                            style="display:flex;justify-content:space-between;align-items:center;padding:16px 0 24px;margin-top:16px;border-top:0.5px solid #f0f0f0">
                            <a href="{{ route('receptionnist.dashboard.room') }}"
                                style="display:flex;align-items:center;gap:7px;padding:9px 16px;border:0.5px solid #d1d5db;border-radius:10px;font-size:13px;font-weight:500;color:#6b7280;text-decoration:none;transition:all 0.15s">
                                <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 12H5M12 19l-7-7 7-7" />
                                </svg>
                                Back
                            </a>
                            <button type="submit"
                                style="display:flex;align-items:center;gap:7px;padding:9px 20px;background:#B45309;border:none;border-radius:10px;color:#fff;font-size:13px;font-weight:500;font-family:inherit;cursor:pointer">
                                <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" />
                                </svg>
                                Update Room
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script>
            const pillConfig = {
                available: {
                    border: '#0F9A6E',
                    bg: 'rgba(29,158,117,0.08)',
                    color: '#0F6E56'
                },
                occupied: {
                    border: '#E24B4A',
                    bg: 'rgba(226,75,74,0.07)',
                    color: '#A32D2D'
                },
                maintenance: {
                    border: '#D97706',
                    bg: 'rgba(212,119,6,0.09)',
                    color: '#854F0B'
                },
            };

            function setStatus(val) {
                document.getElementById('statusSelect').value = val;
                ['available', 'occupied', 'maintenance'].forEach(s => {
                    const p = document.getElementById('pill-' + s);
                    if (s === val) {
                        const c = pillConfig[s];
                        p.style.cssText = p.style.cssText.replace(/border:[^;]+;/, '').replace(/background:[^;]+;/, '')
                            .replace(/color:[^;]+;/, '');
                        p.style.border = '1.5px solid ' + c.border;
                        p.style.background = c.bg;
                        p.style.color = c.color;
                    } else {
                        p.style.border = '1.5px solid #e5e7eb';
                        p.style.background = '#f9fafb';
                        p.style.color = '#888';
                    }
                });
            }
        </script>
