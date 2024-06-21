<footer class="footer">
    <div class="logo">Nour<span>It</span></div>
    <nav>
        <ul>
            <li class="h2">
                @if ($username)
                    <a href="{{ route('user.home', ['user' => $username]) }}">About</a>
                @else
                    <a href="/">About</a>
                @endif
            </li>
            <li class="h2">
                @if ($username)
                    <a href="{{ route('user.project.page.index', ['user' => $username]) }}">Projects</a>
                @else
                    <a href="/projects">Projects</a>
                @endif
            </li>
            <li class="h2">
                @if ($username)
                    <a href="{{ route('user.service.page.index', ['user' => $username]) }}">Services</a>
                @else
                    <a href="/services">Services</a>
                @endif
            </li>
        </ul>
        <ul>
            <li><a href="https://www.facebook.com/nourxxIt/"><img src={{ url('assets/img/social/Facebook.svg') }}
                        alt="Facebook.svg" height="32"></a></li>
            <li><a href="https://twitter.com/nour_it_"><img src={{ url('assets/img/social/Twitter.svg') }}
                        alt="Twitter.svg" height="32"></a></li>
            <li><a href="https://www.linkedin.com/in/nour-it/"><img src={{ url('assets/img/social/LinkedIn.svg') }}
                        alt="LinkedIn.svg" height="32"></a></li>
            <li><a href="https://www.instagram.com/nour.it.ng/"><img src={{ url('assets/img/social/Instagram.svg') }}
                        alt="Instagram.svg" height="32"></a></li>
            <li><a href="https://github.com/nour-it/"><img src={{ url('assets/img/social/Github.svg') }}
                        alt="Github.svg" height="32"></a></li>
        </ul>
    </nav><span class="copy-right">@krish4alex. All rights reserved</span>
</footer>
