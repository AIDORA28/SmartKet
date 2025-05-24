<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartKet | Iniciar Sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="apple-touch-icon" href="{{ asset('img/iconoSK.png') }}">
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
            <div class="login-box-body">
                <p class="login-box-msg text-center">Acceda y gestione sus documentos y bases de datos desde SmartKet.com.</p>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3 position-relative">
                        <label for="email" class="form-label text-start d-block">Correo Electrónico</label>
                        <div class="input-group login-input-group-custom">
                            <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" placeholder="Email" required>
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label text-start d-block">Contraseña</label>
                        <div class="input-group login-input-group-custom">
                            <input type="password" class="form-control form-control-lg shadow-sm" id="password" name="password" placeholder="Contraseña" required>
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-start d-block" for="remember">Recordar</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="text-primary">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body> 
</html>