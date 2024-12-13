<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa Detalhada</title>
    @vite('resources/css/app.css') <!-- ou use o método tradicional de incluir o CSS -->
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        @yield('content')
    </div>
    @livewireScripts
</body>
</html>
