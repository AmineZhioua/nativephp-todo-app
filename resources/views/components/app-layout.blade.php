<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- FontAwesome Kit -->
    <script src="https://kit.fontawesome.com/33f8496b80.js" crossorigin="anonymous"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="nativephp-safe-area h-screen w-screen bg-[#eee]">
    <div class="relative h-full p-2" id="app">
        {{-- NavBar --}}
        <header>
            <div class="flex items-center gap-3">
                {{-- Image --}}
                <i class="fa-solid fa-circle-user text-4xl text-[#888]"></i>

                {{-- Welcome Text --}}
                <div>
                    <h1 class="font-semibold text-xl">Hello, Name 👋</h1>
                    <p class="text-[#888] text-sm">Welcome Back</p>
                </div>
            </div>
        </header>
        
        {{ $slot }}

        <native:bottom-nav label-visibility="labeled">
            <native:bottom-nav-item id="home" icon="home" label="Home" url="/" />
            <native:bottom-nav-item id="account" icon="person" label="Account" url="/login" />
        </native:bottom-nav>
    </div>
</body>
</html>