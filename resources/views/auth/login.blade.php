<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Header --}}
    <div class="p-6">
        <a href="/" class="flex items-center text-gray-600 hover:text-black">
            ← Back to Home
        </a>
    </div>

    {{-- Center Content --}}
    <div class="flex flex-col items-center justify-center flex-1">

        {{-- Logo --}}
        <div class="bg-orange-500 w-20 h-20 rounded-2xl flex items-center justify-center shadow-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-10 h-10 text-white"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 21h18M5 21V7l7-4 7 4v14"/>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800">Grand Hotel</h1>
        <p class="text-gray-500 mb-8">Staff Management Portal</p>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-md w-[420px] p-8">

            <h2 class="text-2xl font-semibold text-center mb-6">
                Staff Login
            </h2>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm mb-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                        required
                    >
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                        required
                    >
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm mb-1">Role</label>
                    <select name="role"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
                        <option value="receptionist">Receptionist</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full bg-teal-600 text-white py-3 rounded-lg hover:bg-teal-700 transition">
                    Sign In
                </button>

            </form>
        </div>
    </div>

</body>
</html>
