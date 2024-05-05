<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="apple-touch-icon" href="/logo192.png" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="description" content="Web site created using create-react-app" />
    <title>Nour It Portfolio</title>
    @vite(['resources/css/style.scss', 'resources/js/app.js'])
</head>

<body>
    <header class="header">
        <div><a class="logo" href="/">Nour<span>It</span></a><span class="hover"><svg id="sun"
                    width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#sun') }}"></use>
                </svg></span></div>
        <nav>
            <ul>
                <li class="text-black-1"><a href="#home">Home</a></li>
                <li class="text-black-1"><a href="#about">About</a></li>
                <li class="text-black-1"><a href="#service">Service</a></li>
                <li class="text-black-1"><a href="#skills">Skills</a></li>
                <li class="text-black-1"><a href="#blog">Blog</a></li>
                <li class="text-black-1"><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="burger__wrapper">
            <div class="burger"></div>
        </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="logo">Nour<span>It</span></div>
        <nav>
            <ul>
                <li class="h2"><a href="/#about">About</a></li>
                <li class="h2"><a href="/projects">Projects</a></li>
                <li class="h2"><a href="/support">Services</a></li>
            </ul>
            <ul>
                <li><a href="https://www.facebook.com/nourxxIt/"><img src={{ url("assets/img/social/Facebook.svg") }} alt="Facebook.svg"
                            height="32"></a></li>
                <li><a href="https://twitter.com/nour_it_"><img src={{ url("assets/img/social/Twitter.svg") }} alt="Twitter.svg"
                            height="32"></a></li>
                <li><a href="https://www.linkedin.com/in/nour-it/"><img src={{ url("assets/img/social/LinkedIn.svg") }}
                            alt="LinkedIn.svg" height="32"></a></li>
                <li><a href="https://www.instagram.com/nour.it.ng/"><img src={{ url("assets/img/social/Instagram.svg") }}
                            alt="Instagram.svg" height="32"></a></li>
                <li><a href="https://github.com/nour-it/"><img src={{ url("assets/img/social/Github.svg") }} alt="Github.svg"
                            height="32"></a></li>
            </ul>
        </nav><span class="copy-right">@krish4alex. All rights reserved</span>
    </footer>
</body>

</html>
