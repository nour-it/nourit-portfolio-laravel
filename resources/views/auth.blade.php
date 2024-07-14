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
    <title>{{ $username ?? 'Nour It' }} | Portfolio</title>
    @vite(['resources/css/style.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container center" style="height: 70vh;">
        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif
      
        <div class="transition-fade" id="swup">
            @yield('content')
        </div>
    </div>
</body>

</html>
