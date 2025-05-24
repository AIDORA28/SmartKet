@extends('layouts.main')

@section('title', 'Dashboard - SmartKet')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card widget-card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Nuevos Pedidos</h5>
                    <p class="card-text display-4">150</p>
                    <a href="#" class="text-white">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card widget-card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Ventas Totales</h5>
                    <p class="card-text display-4">S/ 5,200</p>
                    <a href="#" class="text-white">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card widget-card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Usuarios Activos</h5>
                    <p class="card-text display-4">44</p>
                    <a href="#" class="text-white">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card widget-card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Stock Bajo</h5>
                    <p class="card-text display-4">12</p>
                    <a href="#" class="text-white">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ventas -->
    <div class="card">
        <div class="card-header">
            Ventas Mensuales
        </div>
        <div class="card-body">
            <canvas id="salesChartMain" height="200"></canvas>
        </div>
    </div>

    <!-- Widgets -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm widget-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-boxes fa-2x text-primary me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Total Productos</h6>
                            <h4 class="mb-0" id="totalProducts">2</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm widget-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shopping-cart fa-2x text-primary me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Ventas Hoy</h6>
                            <h4 class="mb-0" id="todaySales">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm widget-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                        <div>
                            <h6 class="card-title mb-0">Stock Bajo</h6>
                            <h4 class="mb-0" id="lowStock">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card shadow-sm indice-card-custom">
        <div class="card-header indice-card-header-custom">
            <ul class="nav nav-tabs" id="inventoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab" aria-controls="products" aria-selected="false">Productos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="purchases-tab" data-bs-toggle="tab" data-bs-target="#purchases" type="button" role="tab" aria-controls="purchases" aria-selected="false">Compras</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="false">Ventas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab" aria-controls="billing" aria-selected="false">Facturación</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content indice-tab-content-custom" id="inventoryTabsContent">
                <!-- Dashboard -->
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <h4 class="mb-3">Estadísticas</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Ventas Mensuales</h5>
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Stock por Categoría</h5>
                                    <canvas id="stockChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" id="exportStatsBtn">Exportar a Excel</button>
                    </div>
                </div>

                <!-- Productos -->
                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Gestión de Productos</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus me-2"></i> Agregar Producto
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="productsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-id="1">
                                    <td>1</td>
                                    <td>Producto A</td>
                                    <td>Categoría 1</td>
                                    <td>50</td>
                                    <td>$10.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1 edit-product" data-id="1"><i class="fas fa-edit"></i> Editar</button>
                                        <button class="btn btn-sm btn-danger delete-product" data-id="1"><i class="fas fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
                                <tr data-id="2">
                                    <td>2</td>
                                    <td>Producto B</td>
                                    <td>Categoría 2</td>
                                    <td>30</td>
                                    <td>$15.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1 edit-product" data-id="2"><i class="fas fa-edit"></i> Editar</button>
                                        <button class="btn btn-sm btn-danger delete-product" data-id="2"><i class="fas fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Compras -->
                <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Registrar Compra</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPurchaseModal">
                            <i class="fas fa-plus me-2"></i> Nueva Compra
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="purchasesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- Ventas -->
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Registrar Venta</h4>
                        <button class="btn btn-primary" id="newSaleBtn">
                            <i class="fas fa-cart-plus me-2"></i> Nueva Venta
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="salesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Stock Disponible</th>
                                    <th>Cantidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-id="1">
                                    <td>1</td>
                                    <td>Producto A</td>
                                    <td>$10.00</td>
                                    <td>50</td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm sale-quantity" style="width: 80px;" value="1" min="1" data-id="1">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary add-to-cart" data-id="1">
                                            <i class="fas fa-cart-plus"></i> Agregar al Carrito
                                        </button>
                                    </td>
                                </tr>
                                <tr data-id="2">
                                    <td>2</td>
                                    <td>Producto B</td>
                                    <td>$15.00</td>
                                    <td>30</td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm sale-quantity" style="width: 80px;" value="1" min="1" data-id="2">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary add-to-cart" data-id="2">
                                            <i class="fas fa-cart-plus"></i> Agregar al Carrito
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Carrito -->
                    <div class="mt-4" id="cartSection" style="display: none;">
                        <h5>Carrito de Ventas</h5>
                        <table class="table table-bordered" id="cartTable">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <button class="btn btn-success" id="confirmSaleBtn">Confirmar Venta</button>
                    </div>
                </div>

                <!-- Facturación -->
                <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <h4 class="mb-3">Facturación</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="billingTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    @csrf
                    <input type="hidden" id="productId" name="id">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="productCategory" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required min="0" step="0.01">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar compra -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPurchaseModalLabel">Registrar Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="purchaseForm">
                    @csrf
                    <div class="mb-3">
                        <label for="purchaseProduct" class="form-label">Producto</label>
                        <select class="form-control" id="purchaseProduct" name="product" required>
                            <option value="">Seleccionar producto</option>
                            <option value="1">Producto A</option>
                            <option value="2">Producto B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="purchaseSupplier" class="form-label">Proveedor</label>
                        <input type="text" class="form-control" id="purchaseSupplier" name="supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="purchaseQuantity" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="purchaseQuantity" name="quantity" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="purchasePrice" class="form-label">Precio Unitario</label>
                        <input type="number" class="form-control" id="purchasePrice" name="price" required min="0" step="0.01">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection