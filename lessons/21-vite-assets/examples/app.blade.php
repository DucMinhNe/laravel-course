{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My App')</title>

    {{-- Compiles + injects CSS/JS. Works in dev (HMR) and prod (hashed build). --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <img src="{{ asset('images/logo.png') }}" alt="Logo">

    <main>
        @yield('content')
    </main>
</body>
</html>
