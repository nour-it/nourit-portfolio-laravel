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
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <header class="header fade-out">
  <div></div>
    <nav>
      <ul>
        <li class="text-black-1" style="right: 0px; opacity: 1;"><a href="{{ route("skill.page.index") }}">Skills</a></li>
        <li class="text-black-1" style="right: 0px; opacity: 1;"><a href="{{ route("project.page.index") }}">Projects</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    @yield("content")
  </div>
</body>
</html>
