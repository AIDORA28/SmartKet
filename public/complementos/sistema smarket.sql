-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS Smarket;
USE Smarket;

-- 1. Gestión de Usuarios de Caja
CREATE TABLE usuarios_caja (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    cargo VARCHAR(50) NOT NULL,
    estado_caja VARCHAR(20) NOT NULL,
    hora_apertura DATETIME NULL,
    hora_cierre DATETIME NULL,
    estado VARCHAR(20) NOT NULL,
    CHECK (cargo IN (
        'Administrador de Caja 1', 'Administrador de Caja 2',
        'Auxiliar de Caja 1', 'Auxiliar de Caja 2')),
    CHECK (estado_caja IN ('Abierta', 'Cerrada')),
    CHECK (estado IN ('Activo', 'Inactivo'))
) ENGINE=InnoDB;

-- 2. Gestión de Clientes
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20)
) ENGINE=InnoDB;

-- 3. Gestión de Almacenes
CREATE TABLE almacenes (
    id_almacen INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(150)
) ENGINE=InnoDB;

-- 4. Gestión de Proveedores
CREATE TABLE proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    razon_social VARCHAR(100) NOT NULL,
    ruc VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE
) ENGINE=InnoDB;

-- 5. Gestión de Productos
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT NULL,
    id_almacen INT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    unidad_medida VARCHAR(20) NOT NULL,
    categoria VARCHAR(100),
    marca VARCHAR(100),
    stock INT DEFAULT 0,
    precio_unitario DECIMAL(10,2) NOT NULL,
    precio_promocion DECIMAL(10,2) NULL,
    en_promocion TINYINT(1) DEFAULT 0,
    estado_igv VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor),
    FOREIGN KEY (id_almacen) REFERENCES almacenes(id_almacen),
    CHECK (precio_unitario >= 0),
    CHECK (estado_igv IN ('Gravado', 'No Gravado', 'Exonerado'))
) ENGINE=InnoDB;

-- 6. Gestión de Ventas
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha DATETIME NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    metodo_pago VARCHAR(20) NOT NULL,
    tipo_venta VARCHAR(10) NOT NULL,
    igv DECIMAL(10,2) NOT NULL,
    estado_igv VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuarios_caja(id_usuario),
    CHECK (total >= 0),
    CHECK (metodo_pago IN ('Efectivo', 'Transferencia', 'Tarjeta', 'Credito')),
    CHECK (tipo_venta IN ('Contado', 'Credito')),
    CHECK (estado_igv IN ('Gravado', 'Exonerado'))
) ENGINE=InnoDB;

-- 7. Detalle de Ventas
CREATE TABLE detalle_venta (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
    CHECK (cantidad > 0)
) ENGINE=InnoDB;

-- 8. Comprobantes
CREATE TABLE comprobantes (
    id_comprobante INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    serie VARCHAR(10) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    fecha_emision DATE NOT NULL,
    monto_total DECIMAL(10,2) NOT NULL,
    tipo_moneda VARCHAR(10) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    id_cliente INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta) ON DELETE CASCADE,
    CHECK (monto_total >= 0),
    CHECK (tipo_moneda IN ('S/', '$', '€', '£')),
    CHECK (estado IN ('Emitido', 'Pendiente', 'Anulado'))
) ENGINE=InnoDB;

INSERT INTO usuarios_caja (nombre_usuario, contrasena, cargo, estado_caja, hora_apertura, hora_cierre, estado) VALUES
('admin_caja_1', 'password123', 'Administrador de Caja 1', 'Abierta', NOW(), NULL, 'Activo'),
('admin_caja_2', 'password123', 'Administrador de Caja 2', 'Abierta', NOW(), NULL, 'Activo'),
('aux_caja_1', 'password123', 'Auxiliar de Caja 1', 'Cerrada', NULL, NULL, 'Activo'),
('aux_caja_2', 'password123', 'Auxiliar de Caja 2', 'Cerrada', NULL, NULL, 'Inactivo');

INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 1', '10000001', '912345678');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 2', '10000002', '912345679');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 3', '10000003', '912345680');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 4', '10000004', '912345681');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 5', '10000005', '912345682');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 6', '10000006', '912345683');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 7', '10000007', '912345684');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 8', '10000008', '912345685');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 9', '10000009', '912345686');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 10', '10000010', '912345687');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 11', '10000011', '912345688');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 12', '10000012', '912345689');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 13', '10000013', '912345690');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 14', '10000014', '912345691');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 15', '10000015', '912345692');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 16', '10000016', '912345693');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 17', '10000017', '912345694');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 18', '10000018', '912345695');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 19', '10000019', '912345696');
INSERT INTO clientes (nombre, dni, telefono) VALUES ('Cliente 20', '10000020', '912345697');


INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 1', 'Ubicación 1');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 2', 'Ubicación 2');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 3', 'Ubicación 3');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 4', 'Ubicación 4');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 5', 'Ubicación 5');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 6', 'Ubicación 6');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 7', 'Ubicación 7');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 8', 'Ubicación 8');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 9', 'Ubicación 9');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 10', 'Ubicación 10');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 11', 'Ubicación 11');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 12', 'Ubicación 12');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 13', 'Ubicación 13');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 14', 'Ubicación 14');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 15', 'Ubicación 15');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 16', 'Ubicación 16');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 17', 'Ubicación 17');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 18', 'Ubicación 18');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 19', 'Ubicación 19');
INSERT INTO almacenes (nombre, ubicacion) VALUES ('Almacen 20', 'Ubicación 20');


INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 1', '20100000001', '912345001', 'proveedor1@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 2', '20100000002', '912345002', 'proveedor2@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 3', '20100000003', '912345003', 'proveedor3@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 4', '20100000004', '912345004', 'proveedor4@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 5', '20100000005', '912345005', 'proveedor5@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 6', '20100000006', '912345006', 'proveedor6@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 7', '20100000007', '912345007', 'proveedor7@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 8', '20100000008', '912345008', 'proveedor8@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 9', '20100000009', '912345009', 'proveedor9@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 10', '20100000010', '912345010', 'proveedor10@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 11', '20100000011', '912345011', 'proveedor11@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 12', '20100000012', '912345012', 'proveedor12@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 13', '20100000013', '912345013', 'proveedor13@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 14', '20100000014', '912345014', 'proveedor14@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 15', '20100000015', '912345015', 'proveedor15@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 16', '20100000016', '912345016', 'proveedor16@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 17', '20100000017', '912345017', 'proveedor17@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 18', '20100000018', '912345018', 'proveedor18@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 19', '20100000019', '912345019', 'proveedor19@correo.com');
INSERT INTO proveedores (razon_social, ruc, telefono, email) VALUES ('Proveedor 20', '20100000020', '912345020', 'proveedor20@correo.com');


INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (1, 1, 'Producto 1', 'Descripción del producto 1', 'unidad', 'Categoría 1', 'Marca 1', 100, 10.50, 9.50, 1, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (2, 2, 'Producto 2', 'Descripción del producto 2', 'unidad', 'Categoría 2', 'Marca 2', 200, 20.00, NULL, 0, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (3, 3, 'Producto 3', 'Descripción del producto 3', 'kg', 'Categoría 1', 'Marca 3', 150, 15.75, 14.75, 1, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (4, 4, 'Producto 4', 'Descripción del producto 4', 'litro', 'Categoría 3', 'Marca 4', 80, 12.00, NULL, 0, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (5, 5, 'Producto 5', 'Descripción del producto 5', 'unidad', 'Categoría 2', 'Marca 5', 50, 8.00, 7.50, 1, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (6, 6, 'Producto 6', 'Descripción del producto 6', 'unidad', 'Categoría 1', 'Marca 6', 300, 30.00, NULL, 0, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (7, 7, 'Producto 7', 'Descripción del producto 7', 'kg', 'Categoría 3', 'Marca 7', 120, 18.00, 17.00, 1, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (8, 8, 'Producto 8', 'Descripción del producto 8', 'litro', 'Categoría 2', 'Marca 8', 60, 25.00, NULL, 0, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (9, 9, 'Producto 9', 'Descripción del producto 9', 'unidad', 'Categoría 1', 'Marca 9', 90, 22.50, 21.00, 1, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (10, 10, 'Producto 10', 'Descripción del producto 10', 'unidad', 'Categoría 3', 'Marca 10', 110, 19.99, NULL, 0, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (11, 11, 'Producto 11', 'Descripción del producto 11', 'kg', 'Categoría 2', 'Marca 11', 140, 16.75, 15.75, 1, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (12, 12, 'Producto 12', 'Descripción del producto 12', 'litro', 'Categoría 1', 'Marca 12', 70, 23.50, NULL, 0, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (13, 13, 'Producto 13', 'Descripción del producto 13', 'unidad', 'Categoría 3', 'Marca 13', 85, 27.25, 26.00, 1, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (14, 14, 'Producto 14', 'Descripción del producto 14', 'unidad', 'Categoría 2', 'Marca 14', 95, 21.00, NULL, 0, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (15, 15, 'Producto 15', 'Descripción del producto 15', 'kg', 'Categoría 1', 'Marca 15', 130, 24.00, 22.50, 1, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (16, 16, 'Producto 16', 'Descripción del producto 16', 'litro', 'Categoría 3', 'Marca 16', 55, 28.00, NULL, 0, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (17, 17, 'Producto 17', 'Descripción del producto 17', 'unidad', 'Categoría 2', 'Marca 17', 65, 26.50, 25.00, 1, 'Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (18, 18, 'Producto 18', 'Descripción del producto 18', 'unidad', 'Categoría 1', 'Marca 18', 75, 29.99, NULL, 0, 'No Gravado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (19, 19, 'Producto 19', 'Descripción del producto 19', 'kg', 'Categoría 3', 'Marca 19', 125, 31.50, 30.00, 1, 'Exonerado');
INSERT INTO productos (id_proveedor, id_almacen, nombre, descripcion, unidad_medida, categoria, marca, stock, precio_unitario, precio_promocion, en_promocion, estado_igv)
VALUES (20, 20, 'Producto 20', 'Descripción del producto 20', 'litro', 'Categoría 2', 'Marca 20', 45, 33.00, NULL, 0, 'Gravado');


INSERT INTO ventas (id_cliente, id_usuario, fecha, total, metodo_pago, tipo_venta, igv, estado_igv) VALUES
(3, 1, '2025-05-22 09:15:00', 180.00, 'Efectivo', 'Contado', 32.40, 'Gravado'),
(4, 3, '2025-05-23 14:45:00', 220.00, 'Tarjeta', 'Credito', 39.60, 'Gravado'),
(5, 2, '2025-05-24 13:00:00', 175.00, 'Efectivo', 'Contado', 31.50, 'Gravado'),
(6, 1, '2025-05-25 16:30:00', 190.00, 'Tarjeta', 'Credito', 34.20, 'Gravado'),
(7, 3, '2025-05-26 11:00:00', 210.00, 'Efectivo', 'Contado', 37.80, 'Gravado'),
(8, 2, '2025-05-27 15:20:00', 195.00, 'Tarjeta', 'Credito', 35.10, 'Gravado'),
(9, 1, '2025-05-28 10:10:00', 205.00, 'Efectivo', 'Contado', 36.90, 'Gravado'),
(10, 3, '2025-05-29 09:45:00', 185.00, 'Tarjeta', 'Credito', 33.30, 'Gravado'),
(11, 2, '2025-05-30 14:00:00', 225.00, 'Efectivo', 'Contado', 40.50, 'Gravado'),
(12, 1, '2025-05-31 10:50:00', 230.00, 'Tarjeta', 'Credito', 41.40, 'Gravado'),
(13, 3, '2025-06-01 13:30:00', 240.00, 'Efectivo', 'Contado', 43.20, 'Gravado'),
(14, 2, '2025-06-02 11:15:00', 255.00, 'Tarjeta', 'Credito', 45.90, 'Gravado'),
(15, 1, '2025-06-03 10:05:00', 260.00, 'Efectivo', 'Contado', 46.80, 'Gravado'),
(16, 3, '2025-06-04 15:40:00', 270.00, 'Tarjeta', 'Credito', 48.60, 'Gravado'),
(17, 2, '2025-06-05 09:55:00', 275.00, 'Efectivo', 'Contado', 49.50, 'Gravado'),
(18, 1, '2025-06-06 12:20:00', 280.00, 'Tarjeta', 'Credito', 50.40, 'Gravado'),
(19, 3, '2025-06-07 14:30:00', 290.00, 'Efectivo', 'Contado', 52.20, 'Gravado'),
(20, 2, '2025-06-08 10:45:00', 300.00, 'Tarjeta', 'Credito', 54.00, 'Gravado');

INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario, subtotal) VALUES
(1, 1, 2, 10.50, 21.00),
(2, 2, 3, 20.00, 60.00),
(3, 3, 1, 50.00, 50.00),
(4, 4, 5, 15.00, 75.00),
(5, 5, 2, 40.00, 80.00),
(6, 1, 4, 10.50, 42.00),
(7, 2, 2, 20.00, 40.00),
(8, 3, 3, 50.00, 150.00),
(9, 4, 1, 15.00, 15.00),
(10, 5, 4, 40.00, 160.00),
(11, 1, 1, 10.50, 10.50),
(12, 2, 5, 20.00, 100.00),
(13, 3, 2, 50.00, 100.00),
(14, 4, 3, 15.00, 45.00),
(15, 5, 1, 40.00, 40.00),
(16, 1, 3, 10.50, 31.50),
(17, 2, 4, 20.00, 80.00),
(18, 3, 5, 50.00, 250.00),
(19, 4, 2, 15.00, 30.00),
(20, 5, 3, 40.00, 120.00);

INSERT INTO comprobantes (id_venta, tipo, serie, numero, fecha_emision, monto_total, tipo_moneda, estado, id_cliente) VALUES
(1, 'Factura', 'F001', '000001', '2025-05-20', 150.00, 'S/', 'Emitido', 1),
(2, 'Boleta', 'B001', '000002', '2025-05-21', 200.00, 'S/', 'Emitido', 2),
(3, 'Factura', 'F001', '000003', '2025-05-22', 180.00, 'S/', 'Emitido', 3),
(4, 'Boleta', 'B001', '000004', '2025-05-23', 220.00, 'S/', 'Emitido', 4),
(5, 'Factura', 'F001', '000005', '2025-05-24', 175.00, 'S/', 'Emitido', 5),
(6, 'Boleta', 'B001', '000006', '2025-05-25', 190.00, 'S/', 'Emitido', 6),
(7, 'Factura', 'F001', '000007', '2025-05-26', 210.00, 'S/', 'Emitido', 7),
(8, 'Boleta', 'B001', '000008', '2025-05-27', 195.00, 'S/', 'Emitido', 8),
(9, 'Factura', 'F001', '000009', '2025-05-28', 205.00, 'S/', 'Emitido', 9),
(10, 'Boleta', 'B001', '000010', '2025-05-29', 185.00, 'S/', 'Emitido', 10),
(11, 'Factura', 'F001', '000011', '2025-05-30', 225.00, 'S/', 'Emitido', 1),
(12, 'Boleta', 'B001', '000012', '2025-05-31', 230.00, 'S/', 'Emitido', 2),
(13, 'Factura', 'F001', '000013', '2025-06-01', 240.00, '$', 'Emitido', 3),
(14, 'Boleta', 'B001', '000014', '2025-06-02', 255.00, '$', 'Emitido', 4),
(15, 'Factura', 'F001', '000015', '2025-06-03', 260.00, '$', 'Emitido', 5),
(16, 'Boleta', 'B001', '000016', '2025-06-04', 270.00, '$', 'Emitido', 6),
(17, 'Factura', 'F001', '000017', '2025-06-05', 275.00, '$', 'Emitido', 7),
(18, 'Boleta', 'B001', '000018', '2025-06-06', 280.00, '$', 'Emitido', 8),
(19, 'Factura', 'F001', '000019', '2025-06-07', 290.00, '€', 'Emitido', 9),
(20, 'Boleta', 'B001', '000020', '2025-06-08', 300.00, '€', 'Emitido', 10);
