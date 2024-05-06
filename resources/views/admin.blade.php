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
    @yield('header')
    <div class="container" style="display: flex; gap: calc(var(--space) * 2)">
        <aside>
            <ul>
                <li class="text-black-1  @if (request()->is('admin/skills')) {{ 'active' }} @endif">
                    <a href="{{ route('skills.index') }}">Skill</a>
                </li>
                <li class="text-black-1 @if (request()->is('admin/projects')) {{ 'active' }} @endif">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
            </ul>
        </aside>
        @yield('content')
    </div>
</body>

</html>
