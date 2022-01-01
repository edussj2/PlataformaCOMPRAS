-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2022 a las 01:15:43
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_pernos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCaja` int(11) NOT NULL,
  `numero` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `efectivo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `numero`, `descripcion`, `vigencia`, `efectivo`) VALUES
(1, '0001', 'CAJAADM', 'Habilitada', 1800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `vigencia`, `ubicacion`) VALUES
(1, 'ELÉCTRICOS', 'Habilitada', 'PASILLO A3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `numDocumento` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombres` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `idDocumento` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `CodigoCompra` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `montoTotal` float NOT NULL,
  `subtotal` float NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idCaja` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `idCompraDetalle` int(11) NOT NULL,
  `idCompra` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `CodigoCompra` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `subTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `idDevolucion` int(11) NOT NULL,
  `idCompraDetalle` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `razSocial` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `ruc` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nomComercial` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `razSocial`, `ruc`, `nomComercial`, `direccion`, `telefono`, `email`) VALUES
(1, 'Pernos y Pernos', '9876543218', 'Tapias SAC', 'Las Lomas #185', '987654321', 'pernos@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `idKardex` int(11) NOT NULL,
  `uniEntrada` int(11) NOT NULL,
  `uniSalida` int(11) NOT NULL,
  `dinerEntrada` float NOT NULL,
  `dinerSalida` float NOT NULL,
  `invenInicial` int(11) NOT NULL,
  `invenActual` int(11) NOT NULL,
  `mesxyear` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`idKardex`, `uniEntrada`, `uniSalida`, `dinerEntrada`, `dinerSalida`, `invenInicial`, `invenActual`, `mesxyear`, `idProducto`) VALUES
(1, 60, 0, 1800, 0, 60, 60, 'PROD04621322201', 1),
(2, 40, 0, 3600, 0, 40, 40, 'PROD86655190772', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_detalle`
--

CREATE TABLE `kardex_detalle` (
  `idKardexDetalle` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` float NOT NULL,
  `total` float NOT NULL,
  `idKardex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `kardex_detalle`
--

INSERT INTO `kardex_detalle` (`idKardexDetalle`, `fecha`, `tipo`, `descripcion`, `unidades`, `precio`, `total`, `idKardex`) VALUES
(1, '2021-12-31', 'Entrada', 'Compra de producto (Mediante registro)', 60, 30, 1800, 1),
(2, '2021-12-31', 'Entrada', 'Compra de producto (Mediante registro)', 40, 90, 3600, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `idMovimiento` int(11) NOT NULL,
  `motivo` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `monto` float NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCaja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_venta`
--

CREATE TABLE `pago_venta` (
  `idPago` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL,
  `CodigoVenta` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCaja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `idPresentacion` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`idPresentacion`, `descripcion`, `vigencia`) VALUES
(1, 'Unidad', 'Habilitada'),
(2, 'Bolsa', 'Habilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `stockTotal` int(11) NOT NULL,
  `stockMinimo` int(11) NOT NULL,
  `precioCompra` float NOT NULL,
  `precioVenta` float NOT NULL,
  `modelo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `diametro` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `longitud` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `idPresentacion` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `identificador` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `codigo`, `nombre`, `stockTotal`, `stockMinimo`, `precioCompra`, `precioVenta`, `modelo`, `estado`, `imagen`, `diametro`, `longitud`, `idPresentacion`, `idCategoria`, `identificador`) VALUES
(1, '8754564', 'Taladro', 60, 5, 30, 35, 'Tornado', 'Habilitada', 'PROD04621322201-112465.jpg', '0', '0', 1, 1, 'PROD04621322201'),
(2, '8547001', 'Destornillador Eléctrico', 40, 1, 90, 100, 'TORNADO', 'Habilitada', 'PROD86655190772-descarga.jpg', '0', '0', 1, 1, 'PROD86655190772');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `numDocumento` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `razSocial` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `contNombres` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `contTelefono` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `contEmail` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `contPuesto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cuenta` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `numDocumento`, `razSocial`, `direccion`, `vigencia`, `contNombres`, `contTelefono`, `contEmail`, `contPuesto`, `cuenta`, `idDocumento`) VALUES
(1, '17406299', 'Backus', 'Ferreñafe', 'Habilitada', 'Edgardo Cespedes', '074638540', 'edgardo@gmail.com', 'Jefe', '98741112058454555123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_detalle`
--

CREATE TABLE `temp_detalle` (
  `idTempDetalle` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `subtotal` float NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idDocumento` int(11) NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idDocumento`, `descripcion`, `vigencia`) VALUES
(1, 'DNI', 'Habilitada'),
(2, 'Pasaporte', 'Habilitada'),
(3, 'Licencia', 'Habilitada'),
(4, 'Cédula', 'Habilitada'),
(5, 'RUC', 'Habilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `idTipoPago` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `icono` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`idTipoPago`, `descripcion`, `vigencia`, `icono`) VALUES
(1, 'Efectivo', 'Habilitada', 'fas fa-money-bill-wave'),
(2, 'Tarjeta', 'Habilitada', 'fas fa-credit-card');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_trabajador`
--

CREATE TABLE `tipo_trabajador` (
  `idTrabajador` int(11) NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_trabajador`
--

INSERT INTO `tipo_trabajador` (`idTrabajador`, `descripcion`, `vigencia`) VALUES
(1, 'Administrador', 'Habilitada'),
(2, 'Personal de Almacén', 'Habilitada'),
(3, 'Personal de Logística', 'Habilitada'),
(4, 'Personal de Ventas', 'Habilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `numDocumento` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombres` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `genero` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `vigencia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `idDocumento` int(11) NOT NULL,
  `idTrabajador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `numDocumento`, `nombres`, `apellidos`, `telefono`, `genero`, `usuario`, `clave`, `email`, `vigencia`, `avatar`, `idDocumento`, `idTrabajador`) VALUES
(1, '12345678', 'Edu', 'Cepsedes', '074500622', 'Masculino', 'edussj2', 'TDNyK3pHRjZ5c2lKMFdmVWlyNUZ5UT09', 'educespedes1998@gmail.com', 'Habilitada', 'avatar1.png', 1, 1),
(2, '76557891', 'Ana Lucia', 'Cespedes', '074500622', 'Femenino', 'anassj2', 'TDNyK3pHRjZ5c2lKMFdmVWlyNUZ5UT09', 'analu@gmail.com', 'Habilitada', 'avatar4.png', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `CodigoVenta` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `montoTotal` float NOT NULL,
  `numero` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `descuento` float NOT NULL,
  `idCaja` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idTipoPago` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `idVentaDetalle` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `subTotal` float NOT NULL,
  `CodigoVenta` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCaja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `idDocumento` (`idDocumento`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `idCaja` (`idCaja`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idEmpresa` (`idEmpresa`),
  ADD KEY `idEmpresa_2` (`idEmpresa`),
  ADD KEY `idPago` (`idPago`);

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`idCompraDetalle`),
  ADD KEY `idCompra` (`idCompra`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`idDevolucion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`idKardex`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `kardex_detalle`
--
ALTER TABLE `kardex_detalle`
  ADD PRIMARY KEY (`idKardexDetalle`),
  ADD KEY `idKardex` (`idKardex`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`idMovimiento`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCaja` (`idCaja`);

--
-- Indices de la tabla `pago_venta`
--
ALTER TABLE `pago_venta`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idCaja` (`idCaja`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`idPresentacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idPresentacion` (`idPresentacion`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD KEY `idDocumento` (`idDocumento`);

--
-- Indices de la tabla `temp_detalle`
--
ALTER TABLE `temp_detalle`
  ADD PRIMARY KEY (`idTempDetalle`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idDocumento`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`idTipoPago`);

--
-- Indices de la tabla `tipo_trabajador`
--
ALTER TABLE `tipo_trabajador`
  ADD PRIMARY KEY (`idTrabajador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idDocumento` (`idDocumento`),
  ADD KEY `idTrabajador` (`idTrabajador`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTipoPago` (`idTipoPago`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idCaja` (`idCaja`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`idVentaDetalle`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `idCompraDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `idDevolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `idKardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `kardex_detalle`
--
ALTER TABLE `kardex_detalle`
  MODIFY `idKardexDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `idMovimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_venta`
--
ALTER TABLE `pago_venta`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `idPresentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `temp_detalle`
--
ALTER TABLE `temp_detalle`
  MODIFY `idTempDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `idTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_trabajador`
--
ALTER TABLE `tipo_trabajador`
  MODIFY `idTrabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `idVentaDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idDocumento`) REFERENCES `tipo_documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_5` FOREIGN KEY (`idPago`) REFERENCES `tipo_pago` (`idTipoPago`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD CONSTRAINT `compra_detalle_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_detalle_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kardex_detalle`
--
ALTER TABLE `kardex_detalle`
  ADD CONSTRAINT `kardex_detalle_ibfk_1` FOREIGN KEY (`idKardex`) REFERENCES `kardex` (`idKardex`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_venta`
--
ALTER TABLE `pago_venta`
  ADD CONSTRAINT `pago_venta_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_venta_ibfk_2` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_venta_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idPresentacion`) REFERENCES `presentacion` (`idPresentacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idDocumento`) REFERENCES `tipo_documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temp_detalle`
--
ALTER TABLE `temp_detalle`
  ADD CONSTRAINT `temp_detalle_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idDocumento`) REFERENCES `tipo_documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idTrabajador`) REFERENCES `tipo_trabajador` (`idTrabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`idTipoPago`) REFERENCES `tipo_pago` (`idTipoPago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
