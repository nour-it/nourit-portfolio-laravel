<header class="header">
    <a class="" href="{{ url()->previous() }}">
        <svg id="back" width="18" height="18">
            <use xlink:href="{{ url('assets/icon/sprite.svg#back') }}"></use>
        </svg>
        Go back
    </a>
    <div style="display: flex; align-items: center; gap: calc(var(--space) * 1)">
        @isset($user)
        <a class="logo" href="{{ route("user.home", ['user' => $user->slug]) }}" >
            @foreach ($user->images as $image)
                @if ($image->category->first()->name == 'Profile')
                    @includeIf('components.core.img', [
                        'src' => url($image->path),
                        'alt' => 'user',
                        'width' => 48,
                    ])
                @endif
            @endforeach
            {{ Str::substr($user->username, 0, strrpos($user->username, ' ')) }}
            <span> {{ Str::substr($user->username, strrpos($user->username, ' ')) }}</span>
        </a>
        @endisset
        <span>
            <svg id="sun" width="24" height="24">
                <use xlink:href="{{ url('assets/icon/sprite.svg#sun') }}"></use>
            </svg>
        </span>
    </div>
</header>
