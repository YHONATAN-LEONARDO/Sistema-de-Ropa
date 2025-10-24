/* ===========================
   BASE DE DATOS Y ESQUEMA
   =========================== */
DROP DATABASE IF EXISTS [db-sis];

IF DB_ID(N'db-sis') IS NULL
BEGIN
  CREATE DATABASE [db-sis];
END
GO

USE [db-sis];
GO

/* Por orden, creamos tablas base primero */

/* ===========================
   TABLA: clientes
   Usada por:
   - admin/clientes/lista.php
   - admin/ventas/lista.php (LEFT JOIN)
   =========================== */
IF OBJECT_ID('dbo.clientes') IS NULL
BEGIN
  CREATE TABLE dbo.clientes(
    id           INT IDENTITY(1,1) PRIMARY KEY,
    nombre       VARCHAR(100)    NOT NULL,
    apellido     VARCHAR(100)    NULL,
    correo       VARCHAR(150)    NULL,
    telefono     VARCHAR(50)     NULL,
    creado_en    DATETIME2(0)    NOT NULL CONSTRAINT DF_clientes_creado DEFAULT (SYSDATETIME())
  );
  -- Si quieres impedir correos repetidos (permitiendo NULLs)
  CREATE UNIQUE INDEX UX_clientes_correo ON dbo.clientes(correo) WHERE correo IS NOT NULL;
END
GO

/* ===========================
   TABLA: vendedor
   Usada por:
   - admin/productos/*.php
   - admin/ventas/lista.php (LEFT JOIN)
   =========================== */
IF OBJECT_ID('dbo.vendedor') IS NULL
BEGIN
  CREATE TABLE dbo.vendedor(
    id        INT IDENTITY(1,1) PRIMARY KEY,
    nombre    VARCHAR(100) NOT NULL,
    apellido  VARCHAR(100) NULL,
    correo    VARCHAR(150) NULL,
    telefono  VARCHAR(50)  NULL,
    activo    BIT          NOT NULL CONSTRAINT DF_vendedor_activo DEFAULT(1),
    creado_en DATETIME2(0) NOT NULL CONSTRAINT DF_vendedor_creado DEFAULT (SYSDATETIME())
  );
  CREATE UNIQUE INDEX UX_vendedor_correo ON dbo.vendedor(correo) WHERE correo IS NOT NULL;
END
GO

/* ===========================
   TABLA: productos
   Usada por:
   - admin/productos/*.php
   =========================== */
IF OBJECT_ID('dbo.productos') IS NULL
BEGIN
  CREATE TABLE dbo.productos(
    id          INT IDENTITY(1,1) PRIMARY KEY,
    titulo      VARCHAR(200)    NOT NULL,
    precio      DECIMAL(10,2)   NOT NULL CHECK (precio >= 0),
    descripcion VARCHAR(2000)   NULL,
    cantidad    INT             NOT NULL CHECK (cantidad >= 0),
    categoria   VARCHAR(50)     NOT NULL,      -- (camisa, pantalon, abrigo, falda, vestido)
    talla       VARCHAR(10)     NOT NULL,      -- (S,M,L,XL)
    genero      VARCHAR(10)     NOT NULL,      -- (hombre, mujer)
    color       VARCHAR(50)     NOT NULL,
    vendedor    INT             NOT NULL,      -- FK -> vendedor.id (INNER JOIN en tu código)
    imagen      VARCHAR(255)    NULL,          -- nombre del archivo .jpg
    creado_en   DATETIME2(0)    NOT NULL CONSTRAINT DF_productos_creado DEFAULT (SYSDATETIME()),
    CONSTRAINT FK_productos_vendedor FOREIGN KEY (vendedor) REFERENCES dbo.vendedor(id) ON DELETE NO ACTION ON UPDATE NO ACTION
  );
  CREATE INDEX IX_productos_vendedor ON dbo.productos(vendedor);
  CREATE INDEX IX_productos_categoria ON dbo.productos(categoria);
END
GO

/* ===========================
   TABLA: ventas
   Usada por:
   - admin/ventas/lista.php
   - admin/reportes/ventas_dia.php
   =========================== */
IF OBJECT_ID('dbo.ventas') IS NULL
BEGIN
  CREATE TABLE dbo.ventas(
    id          INT IDENTITY(1,1) PRIMARY KEY,
    fecha       DATETIME2(0)   NOT NULL CONSTRAINT DF_ventas_fecha DEFAULT (SYSDATETIME()),
    total       DECIMAL(12,2)  NOT NULL CHECK (total >= 0),
    estado      VARCHAR(20)    NOT NULL CONSTRAINT DF_ventas_estado DEFAULT('pendiente'), -- (pendiente, pagado, anulado)
    cliente_id  INT            NULL,   -- LEFT JOIN en tu código => puede ser NULL
    vendedor    INT            NULL,   -- LEFT JOIN en tu código => puede ser NULL
    CONSTRAINT FK_ventas_cliente  FOREIGN KEY (cliente_id) REFERENCES dbo.clientes(id) ON DELETE SET NULL,
    CONSTRAINT FK_ventas_vendedor FOREIGN KEY (vendedor)   REFERENCES dbo.vendedor(id) ON DELETE SET NULL,
    CONSTRAINT CK_ventas_estado CHECK (estado IN ('pendiente','pagado','anulado'))
  );
  CREATE INDEX IX_ventas_fecha ON dbo.ventas(fecha);
  CREATE INDEX IX_ventas_cliente ON dbo.ventas(cliente_id);
END
GO

/* ===========================
   TABLA: empleados
   Usada por:
   - admin/usuarios/crear.php (INSERT con password hash)
   - admin/usuarios/lista.php
   =========================== */
IF OBJECT_ID('dbo.empleados') IS NULL
BEGIN
  CREATE TABLE dbo.empleados(
    id        INT IDENTITY(1,1) PRIMARY KEY,
    nombre    VARCHAR(100)   NOT NULL,
    apellido  VARCHAR(100)   NOT NULL,
    correo    VARCHAR(150)   NOT NULL,
    telefono  VARCHAR(50)    NOT NULL,
    rol       VARCHAR(20)    NOT NULL,  -- (admin, vendedor, almacen)
    [password] VARCHAR(255)  NOT NULL,  -- bcrypt desde PHP
    creado_en DATETIME2(0)   NOT NULL CONSTRAINT DF_empleados_creado DEFAULT (SYSDATETIME()),
    CONSTRAINT UX_empleados_correo UNIQUE (correo),
    CONSTRAINT CK_empleados_rol CHECK (rol IN ('admin','vendedor','almacen'))
  );
END
GO

/* ===========================
   TABLA: usuarios (registro/login web)
   Usada por:
   - views/usuarios/registro.php
   - views/usuarios/login.php
   =========================== */
IF OBJECT_ID('dbo.usuarios') IS NULL
BEGIN
  CREATE TABLE dbo.usuarios(
    id            INT IDENTITY(1,1) PRIMARY KEY,
    nombre        VARCHAR(150)  NOT NULL,
    correo        VARCHAR(150)  NOT NULL,
    password_hash VARCHAR(255)  NOT NULL,
    rol           VARCHAR(20)   NOT NULL DEFAULT 'cliente',
    creado_en     DATETIME2(0)  NOT NULL CONSTRAINT DF_usuarios_creado DEFAULT (SYSDATETIME()),
    CONSTRAINT UX_usuarios_correo UNIQUE (correo),
    CONSTRAINT CK_usuarios_rol CHECK (rol IN ('cliente','admin','vendedor','almacen'))
  );
END
GO

/* ===========================
   TABLA: contactos (form de contacto con PDO)
   Usada por:
   - contacto.php (INSERT con $pdo)
   =========================== */
IF OBJECT_ID('dbo.contactos') IS NULL
BEGIN
  CREATE TABLE dbo.contactos(
    id          INT IDENTITY(1,1) PRIMARY KEY,
    nombre      VARCHAR(150)  NOT NULL,
    correo      VARCHAR(150)  NOT NULL,
    asunto      VARCHAR(200)  NOT NULL,
    mensaje     VARCHAR(4000) NOT NULL,
    ip          VARCHAR(64)   NULL,
    user_agent  VARCHAR(400)  NULL,
    creado_en   DATETIME2(0)  NOT NULL CONSTRAINT DF_contactos_creado DEFAULT (SYSDATETIME())
  );
  CREATE INDEX IX_contactos_creado ON dbo.contactos(creado_en DESC);
END
GO

/* ===========================
   VISTA para Reporte Ventas x Día
   (coincide con admin/reportes/ventas_dia.php)
   =========================== */
IF OBJECT_ID('dbo.vw_reportes_ventas_dia','V') IS NOT NULL
  DROP VIEW dbo.vw_reportes_ventas_dia;
GO
CREATE VIEW dbo.vw_reportes_ventas_dia
AS
SELECT
  CONVERT(date, v.fecha) AS dia,
  COUNT(*)               AS ventas,
  SUM(v.total)           AS total_bs
FROM dbo.ventas v
GROUP BY CONVERT(date, v.fecha);
GO

/* ===========================
   SEEDS (datos de arranque)
   =========================== */
IF NOT EXISTS (SELECT 1 FROM dbo.vendedor)
BEGIN
  INSERT INTO dbo.vendedor(nombre, apellido, correo, telefono) VALUES
    ('Juan', 'Pérez', 'juan.perez@tienda.com', '70000001'),
    ('María', 'Gómez', 'maria.gomez@tienda.com', '70000002');
END
GO

IF NOT EXISTS (SELECT 1 FROM dbo.empleados WHERE correo='admin@tienda.com')
BEGIN
  -- La contraseña real la configuras desde tu formulario (se guarda bcrypt).
  INSERT INTO dbo.empleados(nombre, apellido, correo, telefono, rol, [password])
  VALUES ('Admin','Principal','admin@tienda.com','70000000','admin','REEMPLAZAR_POR_HASH');
END
GO
