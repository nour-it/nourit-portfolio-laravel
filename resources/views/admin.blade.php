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
    <title>{{ $username ?? 'Nour It ' }} | Portfolio</title>
    @vite(['resources/css/style.scss'])



</head>

<body>
    @yield('header')
    <hr style="position: sticky; top: 60px;">
    <div class="container" style="display: flex; gap: calc(var(--space) * 2); --max-width: 1400px">
        <aside>
            <ul>
                <li class="text-black-1 @if (Str::contains(request()->url(), 'dashboard/profile')) {{ 'active' }} @endif">
                    <a href="{{ route('profile.index') }}">Profile</a>
                </li>
                <li class="text-black-1 @if (Str::contains(request()->url(), 'dashboard/projects')) {{ 'active' }} @endif">
                    <a href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="text-black-1  @if (Str::contains(request()->url(), 'dashboard/skills')) {{ 'active' }} @endif">
                    <a href="{{ route('skills.index') }}">Skills</a>
                </li>
                <li class="text-black-1  @if (Str::contains(request()->url(), 'dashboard/services')) {{ 'active' }} @endif">
                    <a href="{{ route('services.index') }}">Services</a>
                </li>
                <li class="text-black-1  @if (Str::contains(request()->url(), 'dashboard/qualifications')) {{ 'active' }} @endif">
                    <a href="{{ route('qualifications.index') }}">Qualifications</a>
                </li>
            </ul>
            @if (Auth::user()->canAdmin())
                <h2>Admin</h2>
                <hr>
                <ul>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_report')) {{ 'active' }} @endif">
                        <a href="{{ route('admin.report') }}">Report</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_users')) {{ 'active' }} @endif">
                        <a href="{{ route('_users.index') }}">Users</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_skills')) {{ 'active' }} @endif">
                        <a href="{{ route('_skills.index') }}">Skills</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_socials')) {{ 'active' }} @endif">
                        <a href="{{ route('_socials.index') }}">Socials</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_projects')) {{ 'active' }} @endif">
                        <a href="{{ route('_projects.index') }}">Projects</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_services')) {{ 'active' }} @endif">
                        <a href="{{ route('_services.index') }}">Services</a>
                    </li>
                    <li class="text-black-1  @if (Str::contains(request()->url(), 'admin/_qualifications')) {{ 'active' }} @endif">
                        <a href="{{ route('_qualifications.index') }}">Qualifications</a>
                    </li>
                </ul>
            @endif
        </aside>
        <div class="transition-fade" id="swup">
            @yield('content')
        </div>
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>
