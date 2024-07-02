<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="apple-touch-icon" href="/logo192.png" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="description" content="" />
    <title>{{ $username ?? "Nour It " }} | Portfolio</title>
    @vite(['resources/css/style.scss'])
</head>

<body>
    @yield('header')
    <div class="container" style="display: flex; gap: calc(var(--space) * 2); --max-width: 1400px">
        <aside>
            <ul>
                <li class="text-black-1 @if (request()->is('dashboard/profile')) {{ 'active' }} @endif">
                    <a href="{{ route('profile.index') }}">Profile</a>
                </li>
                <li class="text-black-1 @if (request()->is('dashboard/projects')) {{ 'active' }} @endif">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="text-black-1  @if (request()->is('dashboard/skills')) {{ 'active' }} @endif">
                    <a href="{{ route('skills.index') }}">Skills</a>
                </li>
                <li class="text-black-1  @if (request()->is('dashboard/services')) {{ 'active' }} @endif">
                    <a href="{{ route('services.index') }}">Services</a>
                </li>
                <li class="text-black-1  @if (request()->is('dashboard/qualifications')) {{ 'active' }} @endif">
                    <a href="{{ route('qualifications.index') }}">Qualifications</a>
                </li>
                <li class="text-black-1  @if (request()->is('dashboard/users')) {{ 'active' }} @endif">
                    <a href="{{ route('users.index') }}">Users</a>
                </li>
            </ul>
        </aside>
        @yield('content')
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>
