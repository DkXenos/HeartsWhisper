<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hearts Whisper')</title>
    <!-- Favicons / App icons: place files in `public/` (examples: favicon.ico, apple-touch-icon.png, site.webmanifest) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @vite(entrypoints: ['resources/css/site.css', 'resources/js/app.js'])
</head>
<body>
    {{-- @include('components.header') --}}
    @include('components.nav')

    <div class="container">
        <main>
            @yield('content')
        </main>

        {{-- @includeWhen(View::exists('components.sidebar'), 'components.sidebar') --}}
    </div>

    @include('components.footer')
</body>
</html>
