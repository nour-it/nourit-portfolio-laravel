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
            <form action="{{ route('skills.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="email" id="email" class="border rounded" placeholder="user name | email"
                    value="">
                <input type="password" name="password" id="password" class="border rounded" placeholder="password"
                    value="">
                <div class="center">
                    <button type="submit" class="btn">
                        Login
                    </button>
                    <a href="border" class="border rounded" style="padding: 5px 20px; width: 100%;">continue with
                        google</a>
                        <p>
                            If you have an acount you can create one <a href="{{ route("register") }}">here</a>
                        </p>
                </div>
        </div>

</body>

</html>
