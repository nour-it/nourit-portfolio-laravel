<header class="header">
    <div>

        <a class="logo" href="/@auth{{ 'dashboard' }} @endauth">
            Port<span>Folio</span>
        </a>
        <span class="hover">
            <svg id="sun" width="24" height="24">
                <use xlink:href="{{ url('assets/icon/sprite.svg#sun') }}"></use>
            </svg>
        </span>
    </div>
    <nav>
        <ul>
            <li class="text-black-1"><a href="#home">Home</a></li>
            <li class="text-black-1"><a href="#about">About</a></li>
            <li class="text-black-1"><a href="#service">Service</a></li>
            @if ($skills->count() > 0)
                <li class="text-black-1"><a href="#skills">Skills</a></li>
            @endif
            @isset($qualifications)
                @if ($qualifications->count() > 0)
                    <li class="text-black-1"><a href="#blog">Blog</a></li>
                @endif
            @endisset
            <li class="text-black-1"><a href="#contact">Contact</a></li>
            @auth
            @else
                <li class="text-black-1"><a href="{{ route('login') }}">Login</a></li>
                <li class="text-black-1"><a href="{{ route('register') }}">Sign in</a></li>
            @endauth
        </ul>
    </nav>
    <div class="burger__wrapper">
        <div class="burger"></div>
    </div>
</header>
