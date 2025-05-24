<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartKet | Bienvenido</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('img/iconoSK.ico') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo text-center">
                <a href="/">
                    <img src="{{ asset('img/logov1.png') }}" alt="SmartKet Logo">
                </a>
            </div>
            <div class="login-box-body text-center">
                <p class="login-box-msg">Bienvenido a SmartKet</p>
                <p>Sistema de gestión de inventario y ventas.</p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>