@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-orange-100">

    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">

        {{-- Title --}}
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Change Password 🔐
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Pour votre sécurité, veuillez changer votre mot de passe.
            </p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-600 p-3 rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('password.change') }}" class="space-y-5">
            @csrf

            {{-- New Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nouveau mot de passe
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                              focus:ring-2 focus:ring-orange-400 outline-none
                              transition">
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirmer mot de passe
                </label>

                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                              focus:ring-2 focus:ring-orange-400 outline-none
                              transition">
            </div>

            {{-- Button --}}
            <button
                class="w-full bg-orange-500 hover:bg-orange-600 text-white
                       font-semibold py-3 rounded-lg transition duration-300
                       shadow-md hover:shadow-lg">

                Mettre à jour le mot de passe
            </button>

        </form>

    </div>

</div>

@endsection
