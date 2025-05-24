<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SmartKet - Sistema de gestión de inventario y ventas">
    <title>SmartKet - @yield('title', 'Dashboard')</title>
    <link rel="apple-touch-icon" href="{{ asset('img/iconoSK.png') }}">
    <link rel="shortcut icon" href="{{ asset('img/iconoSK.ico') }}">
    <!-- Precarga de recursos críticos -->
    <link rel="preload" href="{{ Vite::asset('resources/css/app.css') }}" as="style">
    <link rel="preload" href="{{ Vite::asset('resources/js/app.js') }}" as="script">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="main-body">
    <div class="main-wrapper">
        <!-- Navbar -->
        <nav class="main-navbar-custom" role="navigation">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <!-- Izquierda: Toggle y Logo -->
                    <div class="d-flex align-items-center">
                        <button class="sidebar-toggle text-white me-2" aria-label="Toggle sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a class="main-navbar-brand d-flex align-items-center text-white" href="{{ route('dashboard') }}">
                            <img src="{{ asset('img/logo01.jpeg') }}" alt="SmartKet Logo">
                            <span class="fs-5 ms-2">SmartKet</span>
                        </a>
                    </div>
                    <!-- Derecha: IESTP Online, Notificaciones, Perfil de usuario -->
                    <div class="navbar-custom-menu d-flex align-items-center">
                        <ul>
                            <!-- IESTP Online -->
                            <li class="nav-item dropdown user-menu">
                                <a class="nav-link text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                    <span>IESTP</span>
                                    <span class="badge bg-red ms-1">Online</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="user-header text-center">
                                        <!-- Podrías añadir una foto aquí para consistencia -->
                                        <p>IESTP</p>
                                        <p class="text-muted">www.SmartKet.com - Desarrollando Software</p>
                                        <p class="text-muted">www.youtube.com/SmartKet</p>
                                    </div>
                                    <div class="user-footer text-center">
                                        <a href="#" class="btn btn-sm btn-primary">Cerrar</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <!-- Notificaciones -->
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                    <i class="far fa-bell me-1"></i>
                                    <span class="badge bg-red">3</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Notificación 1</a></li>
                                    <li><a class="dropdown-item" href="#">Notificación 2</a></li>
                                    <li><a class="dropdown-item" href="#">Notificación 3</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <!-- Perfil de usuario -->
                            <li class="nav-item dropdown user-menu">
                                <a class="nav-link text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                    <img src="{{ asset('img/user-default.png') }}" alt="Foto de perfil de {{ $user->name ?? 'Nombre de Usuario' }}" class="user-photo me-1">
                                    <span>{{ $user->name ?? 'Nombre de Usuario' }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="user-header text-center">
                                        <img src="{{ asset('img/user-default.png') }}" alt="Foto de perfil de {{ $user->name ?? 'Nombre de Usuario' }}" class="user-photo mb-2">
                                        <p>{{ $user->name ?? 'Nombre de Usuario' }}</p>
                                        <p class="text-muted">Cargo: {{ $user->role ?? 'Administrador' }}</p>
                                    </div>
                                    <div class="user-footer text-center">
                                        <a href="{{ route('logout') }}" class="btn btn-sm btn-danger">Cerrar Sesión</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar" role="complementary">
            <div class="main-sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="{{ route('dashboard') }}" data-bs-toggle="collapse" data-bs-target="#dashboard-menu">
                            <i class="fas fa-tachometer-alt main-nav-icon"></i>
                            <span class="main-nav-text">Dashboard</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu show" id="dashboard-menu">
                            <a class="main-sub-nav-link active" href="{{ route('dashboard') }}">Estadísticas</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#almacen-menu">
                            <i class="fas fa-warehouse main-nav-icon"></i>
                            <span class="main-nav-text">Almacén</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="almacen-menu">
                            <a class="main-sub-nav-link" href="{{ route('almacen.articulos') }}">Artículos</a>
                            <a class="main-sub-nav-link" href="{{ route('almacen.categorias') }}">Categorías</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#compras-menu">
                            <i class="fas fa-shopping-cart main-nav-icon"></i>
                            <span class="main-nav-text">Compras</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="compras-menu">
                            <a class="main-sub-nav-link" href="{{ route('compras.ingresos') }}">Ingresos</a>
                            <a class="main-sub-nav-link" href="{{ route('compras.proveedores') }}">Proveedores</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#ventas-menu">
                            <i class="fas fa-cash-register main-nav-icon"></i>
                            <span class="main-nav-text">Ventas</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="ventas-menu">
                            <a class="main-sub-nav-link" href="{{ route('ventas.ventas') }}">Ventas</a>
                            <a class="main-sub-nav-link" href="{{ route('ventas.clientes') }}">Clientes</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#facturacion-menu">
                            <i class="fas fa-file-invoice main-nav-icon"></i>
                            <span class="main-nav-text">Facturación</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="facturacion-menu">
                            <a class="main-sub-nav-link" href="{{ route('facturacion.boletas') }}">Boletas <span class="badge bg-red">PDF</span></a>
                            <a class="main-sub-nav-link" href="{{ route('facturacion.facturas') }}">Facturas</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#reportes-menu">
                            <i class="fas fa-chart-bar main-nav-icon"></i>
                            <span class="main-nav-text">Reportes</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="reportes-menu">
                            <a class="main-sub-nav-link" href="{{ route('reportes.excel') }}">Exportar Excel</a>
                            <a class="main-sub-nav-link" href="{{ route('reportes.pdf') }}">Exportar PDF</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#devoluciones-menu">
                            <i class="fas fa-undo main-nav-icon"></i>
                            <span class="main-nav-text">Devoluciones</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="devoluciones-menu">
                            <a class="main-sub-nav-link" href="{{ route('devoluciones.registrar') }}">Registrar Devolución</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#promociones-menu">
                            <i class="fas fa-tags main-nav-icon"></i>
                            <span class="main-nav-text">Promociones</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="promociones-menu">
                            <a class="main-sub-nav-link" href="{{ route('promociones.crear') }}">Crear Promoción</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#acceso-menu">
                            <i class="fas fa-users main-nav-icon"></i>
                            <span class="main-nav-text">Acceso</span>
                            <i class="fas fa-angle-left main-nav-angle ms-auto"></i>
                        </a>
                        <div class="collapse main-submenu" id="acceso-menu">
                            <a class="main-sub-nav-link" href="{{ route('acceso.usuarios') }}">Usuarios</a>
                            <a class="main-sub-nav-link" href="{{ route('acceso.permisos') }}">Permisos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="{{ route('ayuda') }}">
                            <i class="fas fa-question-circle main-nav-icon"></i>
                            <span class="main-nav-text">Ayuda <span class="badge bg-red">PDF</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-nav-link" href="{{ route('acerca-de') }}">
                            <i class="fas fa-info-circle main-nav-icon"></i>
                            <span class="main-nav-text">Acerca De... <span class="badge bg-yellow">IT</span></span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <div class="main-content-wrapper">
            <div class="main-content-area">
                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="float-end">Versión 2.3.0</div>
                Copyright © 2015-2025 SmartKet. Todos los derechos reservados.
            </div>
        </footer>
    </div>

    <!-- Script para establecer el enlace activo al cargar la página -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dashboardUrl = @json(route('dashboard')); // Escapar la URL con JSON
            const dashboardLink = document.querySelector(`.main-nav-link[href="${dashboardUrl}"]`);
            if (dashboardLink) {
                dashboardLink.classList.add('active');
            }
        });
    </script>
</body>