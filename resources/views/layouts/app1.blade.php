<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/script.js') }}"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap');

        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>


<body class="font-sans antialiased bg-rose-50/40 min-h-screen">


    {{-- Navigation --}}

    @include('layouts.Sidebar')



    {{-- Page Content --}}
    <main class="ml-[260px] min-h-screen">

        @yield('content')
    </main>

 @stack('scripts')
</body>

</html>
<script>
    setTimeout(() => {
        document.getElementById('errorBox')?.remove();
        document.getElementById('successBox')?.remove();
    }, 4000);
</script>
