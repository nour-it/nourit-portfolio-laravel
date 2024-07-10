<footer class="footer">
    @isset($user)
        <div class="logo">
            {{ Str::substr($user->username, 0, strrpos($user->username, ' ')) }}
            <span> {{ Str::substr($user->username, strrpos($user->username, ' ')) }}</span>
        </div>
    @endisset
    <nav>
        <ul>
            <li class="h2">
                @if ($user)
                    <a href="{{ route('user.home', ['user' => $user->slug]) }}">About</a>
                @else
                    <a href="/">About</a>
                @endif
            </li>
            <li class="h2">
                @if ($user)
                    <a href="{{ route('user.project.page.index', ['user' => $user->slug]) }}">Projects</a>
                @else
                    <a href="/projects">Projects</a>
                @endif
            </li>
            <li class="h2">
                @if ($user)
                    <a href="{{ route('user.service.page.index', ['user' => $user->slug]) }}">Services</a>
                @else
                    <a href="/services">Services</a>
                @endif
            </li>
        </ul>

        <ul>
            @isset($profileLinks)
                @foreach ($profileLinks as $link)
                    <li>
                        <a href="{{ $link->link }}">
                            <img src={{ url($link->social->images->first()->path) }} alt="{{ $link->social->name }}"
                                height="32">
                        </a>
                    </li>
                @endforeach
            @endisset
        </ul>
    </nav><span class="copy-right">@krish4alex. All rights reserved</span>
</footer>
