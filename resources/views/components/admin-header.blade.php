<header class="header">
    <a class="logo" href="{{ route("admin.home") }}">Nour<span>It</span></a>
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <svg id="sun" width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#sun') }}"></use>
                </svg>
            </button>
        </form>
    </div>
</header>
