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

    <div class="container" style="height: 70vh">
        <div class="edit center" style="margin-top: 0">
            <div><img src="{{ url('assets/img/logo512.png') }}" alt="user" height="100"></div>
            <form action="{{ route('login.attempt') }}" method="post" enctype="multipart/form-data">
                @csrf
                @includeIf('components.input', [
                    'name' => 'email',
                    'value' => '',
                    'holder' => 'user name or email',
                ])
                @includeIf('components.input', [
                    'name' => 'password',
                    'value' => '',
                    'holder' => 'password',
                ])
                <div class="center">
                    <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                        Login
                    </button>
                    <a href="{{ route('login.social') }}?type=google" class="border rounded"
                        style="padding: 5px 20px; width: 100%;">
                        <div style="display: flex; justify-content: space-evenly; padding-block: var(--space)">
                            <img src="{{ url('assets/icon/google.png') }}" alt="user" height="24">
                            <span> continue with google</span>
                        </div>
                    </a>
                    <p>
                        If you have an acount you can create one <a href="{{ route('register') }}"
                            style="color: var(--color-red)">here</a>
                    </p>
                </div>
        </div>

</body>

</html>
