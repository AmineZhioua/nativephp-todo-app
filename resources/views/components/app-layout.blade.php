<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/33f8496b80.js" crossorigin="anonymous"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="nativephp-safe-area h-screen w-screen bg-[#eee]">
    <div class="relative h-full p-3" id="app">

        {{-- NavBar --}}
        <header class="mb-4">
            <div class="header-card">
                {{-- Avatar --}}
                <div class="avatar-wrapper">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                {{-- Welcome Text --}}
                <div class="header-text">
                    <h1>Hello there 👋</h1>
                    <p>We're happy to see you again</p>
                </div>
            </div>
        </header>

        {{ $slot }}

        <native:bottom-nav label-visibility="labeled">
            <native:bottom-nav-item id="home" icon="home" label="Home" url="/" />
        </native:bottom-nav>
    </div>
</body>
</html>