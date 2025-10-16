<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand" href="#">
            <img src="{{ asset('Asset/Components/Navbar/navbarnew3.svg') }}" alt="Hearts Whisper Logo" class="logobg">
            <img src="{{ asset('Asset/Components/Navbar/ribbonnew.svg') }}" alt="Hearts Whisper Logo" class="ribbon">

        </div>
        <ul class="nav main-nav-list">
            <li class="nav-item">
                <a class="button-navbar" aria-current="page" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="button-navbar" href="{{ url('/forums') }}">Forums</a>
            </li>
            <li class="nav-item">
                <a class="button-navbar" href="{{ url('/guides') }}">Guides</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="button-navbar">Login</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    
                    <span class="navbar-text">Hi, {{ auth()->user()->username }}</span>
                </li>
                <li class="nav-item">
                    {{-- Tombol logout harus di dalam form dengan method POST untuk keamanan --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="button-navbar-secondary">Logout</button>
                    </form>
                </li>
            @endauth

        </ul>
    </div>
</nav>
