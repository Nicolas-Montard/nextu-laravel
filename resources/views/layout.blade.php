<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('_include._navbar')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <main>
        @yield('content')
    </main>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>
