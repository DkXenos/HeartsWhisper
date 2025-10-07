<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hearts Whisper')</title>
    @vite(['resources/css/site.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')
    @include('components.nav')

    <div class="container">
        <main>
            @yield('content')
        </main>

        @includeWhen(View::exists('components.sidebar'), 'components.sidebar')
    </div>

    @include('components.footer')
</body>
</html>
