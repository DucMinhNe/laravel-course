{{-- resources/views/layouts/app.blade.php — the parent shell --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'My Site')</title>
</head>
<body>
    @include('partials.nav')   {{-- reusable partial --}}

    <main>
        @yield('content')      {{-- children inject here --}}
    </main>

    @stack('scripts')          {{-- children can push <script> tags here --}}
</body>
</html>
