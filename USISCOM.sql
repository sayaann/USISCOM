-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-12-2017 a las 10:45:36
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `USISCOM`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulo`
--

CREATE TABLE `Articulo` (
  `idArticulo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(50) DEFAULT NULL,
  `Precio` double NOT NULL,
  `Unidades` int(11) NOT NULL,
  `Imagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Articulo`
--

INSERT INTO `Articulo` (`idArticulo`, `Nombre`, `Descripcion`, `Precio`, `Unidades`, `Imagen`) VALUES
(1, 'Resistencia 1K', 'Resistencia 1K 5 unidades', 22.5, 20, 'uploads/Resistencias1K.jpg'),
(2, 'Transistor PNP', 'Transistor de pequeña señal tipo PNP', 5, 300, 'uploads/TransistorPNP.jpg'),
(4, 'Pinzas de corte', 'Pinzas de corte diagonal', 70, 50, 'uploads/PinzasCorte.jpg'),
(5, 'Multímetro digital', 'Multímetro digital con luz de fondo', 215, 40, 'uploads/MultímetroDigital.jpg'),
(6, 'Diodo zener', 'Paquete de 10 Diodo zener', 20, 200, 'uploads/DiodoZener.jpg'),
(7, 'Protoboard', 'Protoboar 400 ountos', 40, 100, 'uploads/ProtoBoard.jpg'),
(8, 'Transistor NPN', 'Transistor de pequeña señal NPN', 4, 250, 'uploads/TransistorNPN.jpg'),
(9, 'Capacitor 100 microF', 'Capacitorelectrolítico 100 microF', 4, 100, 'uploads/CapacitorElectrolitico.jpg'),
(10, 'Capacitor 0.001 microF', 'Capacitor de 0.001 microF', 3, 200, 'uploads/Capacitor0.001.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE `Pedido` (
  `idPedido` int(11) NOT NULL,
  `Nombre_cliente` varchar(50) NOT NULL,
  `Institucion_cliente` varchar(45) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido_Articulo`
--

CREATE TABLE `Pedido_Articulo` (
  `idArticulo` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `Cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Venta`
--

CREATE TABLE `Venta` (
  `idVenta` int(11) NOT NULL,
  `Fecha_inicio` date DEFAULT NULL,
  `Fecha_fin` date DEFAULT NULL,
  `Repartidor` varchar(45) DEFAULT NULL,
  `Estatus` int(11) DEFAULT NULL,
  `idPedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Articulo`
--
ALTER TABLE `Articulo`
  ADD PRIMARY KEY (`idArticulo`);

--
-- Indices de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `Pedido_Articulo`
--
ALTER TABLE `Pedido_Articulo`
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idArticulo` (`idArticulo`);

--
-- Indices de la tabla `Venta`
--
ALTER TABLE `Venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idPedido_idx` (`idPedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Articulo`
--
ALTER TABLE `Articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `Venta`
--
ALTER TABLE `Venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Pedido_Articulo`
--
ALTER TABLE `Pedido_Articulo`
  ADD CONSTRAINT `idArticulo` FOREIGN KEY (`idArticulo`) REFERENCES `Articulo` (`idArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idPedido` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Venta`
--
ALTER TABLE `Venta`
  ADD CONSTRAINT `idPedido_idx` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
