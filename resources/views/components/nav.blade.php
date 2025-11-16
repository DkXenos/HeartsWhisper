<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand" href="#">
            
            <img src="{{ asset('Asset/Components/Navbar/navbarnew3.svg') }}" alt="Hearts Whisper Logo" class="logobg">
            <img src="{{ asset(path: 'Asset/Components/Navbar/mobilenavbar.svg') }}" alt="Hearts Whisper Logo" class="mobile-logobg">
            {{-- <img src="{{ asset('Asset/Components/Navbar/ribbonnew.svg') }}" alt="Hearts Whisper Logo" class="ribbon"> --}}
        </div>

        <!-- Hamburger Menu Button (Mobile Only) -->
        <button class="hamburger-menu" id="hamburgerBtn" aria-label="Toggle menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <!-- Desktop Navigation -->
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
                    <a href="{{ route('login') }}" class="button-navbar">Login</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="button-navbar">
                        Hi, {{ auth()->user()->username }}
                    </a>
                </li>
            @endauth
        </ul>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-nav-list">
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ url('/forums') }}">Forums</a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ url('/guides') }}">Guides</a>
            </li>
            @guest
                <li class="mobile-nav-item">
                    <a href="{{ route('login') }}" class="mobile-nav-link">Login</a>
                </li>
            @endguest

            @auth
                <li class="mobile-nav-item">
                    <a href="{{ route('dashboard') }}" class="mobile-nav-link">
                        Hi, {{ auth()->user()->username }}
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
