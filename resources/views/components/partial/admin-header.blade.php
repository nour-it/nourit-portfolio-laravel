<header class="header" style="--max-width: 1400px;">
    <a class="logo" href="{{ route('dashboard.home') }}">
        Nour
        <span>It</span>
    </a>
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div>
                <svg id="sun" width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#sun') }}"></use>
                </svg>
            </div>
        </form>
    </div>
</header>
