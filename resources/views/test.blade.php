<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="nativephp-safe-area h-screen w-screen">
    <div 
        class="h-full p-2 text-white" 
        style="background-color: #18181b;"
        id="app"
    >
        <h1>YALA HEYYYYYYYYY</h1>
        <test-comp />
        <button onclick="window.location.href='/'">click me</button>
    </div>
</body>
</html>