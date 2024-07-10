<header class="header" style="--max-width: 1400px;">
    <a class="logo" href="{{ route('dashboard.home') }}"
        style="display: flex; align-items: center; gap: calc(var(--space) * 1)">
        @foreach (Auth::user()->images as $image)
            @if ($image->category->first()->name == 'Profile')
                @includeIf('components.core.img', [
                    'src' => url($image->path),
                    'alt' => 'user',
                    'width' => 48,
                ])
            @endif
        @endforeach
        {{ Str::substr(Auth::user()->username, 0, strrpos(Auth::user()->username, ' ')) }}
        <span> {{ Str::substr(Auth::user()->username, strrpos(Auth::user()->username, ' ')) }}</span>
    </a>
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
