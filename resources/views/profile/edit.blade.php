@extends('layouts.app1')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-semibold text-slate-800">
            Mon Profil
        </h1>
        <p class="text-sm text-gray-400 mt-1">
            Gérez vos informations personnelles
        </p>
    </div>

    {{-- USER CARD --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm p-6 flex items-center gap-5">

        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-amber-500 to-amber-400 flex items-center justify-center text-white text-xl font-bold">
            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
        </div>

        <div>
            <p class="text-lg font-semibold text-slate-800">
                {{ auth()->user()->name }}
            </p>
            <p class="text-sm text-gray-400">
                {{ auth()->user()->email }}
            </p>
        </div>

        <span class="ml-auto px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-700">
            Client
        </span>
    </div>

    {{-- PROFILE INFO --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-sm font-semibold text-slate-700">
                Informations personnelles
            </h2>
        </div>

        <div class="p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

    </div>

    {{-- PASSWORD --}}
    <div class="bg-white rounded-2xl border border-amber-100 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-sm font-semibold text-slate-700">
                Sécurité
            </h2>
        </div>

        <div class="p-6">
            @include('profile.partials.update-password-form')
        </div>

    </div>



</div>
@endsection
