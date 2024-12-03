-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2024 a las 14:17:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `restaurante`
--
CREATE DATABASE IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurante`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codigo`, `nombre`, `descripcion`) VALUES
(1, 'Bebidas', 'Agua, zumos y refrescos'),
(2, 'Comida', 'Platos de preparación rápida como hamburguesas y papas fritas'),
(3, 'Postres', 'Dulces y otros productos para después de las comidas'),
(4, 'Bebidas', 'Líquidos para beber, como agua, jugos y refrescos'),
(5, 'Comida Rápida', 'Platos de preparación rápida como hamburguesas y papas fritas'),
(6, 'Postres', 'Dulces y otros productos para después de las comidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproducto`
--

DROP TABLE IF EXISTS `pedidoproducto`;
CREATE TABLE `pedidoproducto` (
  `Codigo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Pedido` int(11) NOT NULL,
  `Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidoproducto`
--

INSERT INTO `pedidoproducto` (`Codigo`, `Cantidad`, `Pedido`, `Producto`) VALUES
(1, 2, 1, 21),
(2, 1, 1, 22),
(3, 3, 1, 23),
(4, 4, 2, 26),
(5, 2, 2, 25),
(6, 1, 2, 27),
(7, 1, 3, 30),
(8, 3, 3, 31),
(9, 2, 3, 28),
(10, 2, 3, 29),
(11, 2, 2, 25),
(12, 5, 1, 22),
(13, 5, 5, 23),
(14, 5, 2, 26),
(15, 10, 4, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `codigo` int(11) NOT NULL,
  `restaurante_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `enviado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `restaurante_id`, `fecha`, `enviado`) VALUES
(1, 1, '2024-01-01', 0),
(2, 2, '2024-01-02', 1),
(3, 3, '2024-01-03', 0),
(4, 4, '2024-01-04', 1),
(5, 5, '2024-01-05', 0),
(6, 6, '2024-01-06', 1),
(7, 7, '2024-01-07', 0),
(8, 8, '2024-01-08', 1),
(9, 9, '2024-01-09', 0),
(10, 10, '2024-01-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `descripcion`, `peso`, `cantidad_stock`, `categoria_id`) VALUES
(21, 'Coca Cola', 'Bebida gaseosa azucarada', 0.50, 100, 1),
(22, 'Fanta', 'Bebida gaseosa azucarada', 0.50, 100, 1),
(23, 'Agua', 'Bebida gaseosa azucarada', 0.50, 100, 1),
(24, 'Hamburguesa', 'Carne, lechuga y pan con salsas', 0.25, 50, 2),
(25, 'Helado', 'Postre frío de diferentes sabores', 0.30, 30, 3),
(26, 'Brownie', 'Postre de chocolate', 0.25, 15, 3),
(27, 'Papas Fritas', 'Tiras de papa frita', 0.20, 80, 2),
(28, 'Tequeños', 'Masa rellena de queso', 0.70, 15, 2),
(29, 'Perrito caliente', 'Pan con salchicha', 0.40, 25, 2),
(30, 'Churros de pescado', 'Pescado frito', 0.60, 10, 2),
(31, 'Hamburguesa de pollo', 'Pan con carne', 0.75, 18, 2),
(32, 'Croissant de pollo', 'Panecillo de hojaldre', 0.30, 40, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

DROP TABLE IF EXISTS `restaurantes`;
CREATE TABLE `restaurantes` (
  `codigo` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`codigo`, `correo`, `clave`, `pais`, `direccion`, `codigo_postal`) VALUES
(1, 'restaurante1@mail.com', 'clave123', 'España', 'Calle Falsa 123', '28001'),
(2, 'restaurante2@mail.com', 'clave234', 'México', 'Avenida Siempre Viva 456', '01000'),
(3, 'restaurante3@mail.com', 'clave345', 'Argentina', 'Boulevard Sol 789', '1003'),
(4, 'restaurante4@mail.com', 'clave456', 'Chile', 'Avenida Luna 101', '75005'),
(5, 'restaurante5@mail.com', 'clave567', 'Perú', 'Calle Estrella 202', '15000'),
(6, 'restaurante6@mail.com', 'clave678', 'Colombia', 'Carrera 7 #33', '11001'),
(7, 'restaurante7@mail.com', 'clave789', 'Ecuador', 'Calle 10 #45', '090105'),
(8, 'restaurante8@mail.com', 'clave890', 'Venezuela', 'Calle Sol 50', '1001'),
(9, 'restaurante9@mail.com', 'clave901', 'Brasil', 'Avenida Rio 25', '20031'),
(10, 'restaurante10@mail.com', 'clave012', 'Uruguay', 'Calle Lago 13', '11000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `codigo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `passw`, `codigo`) VALUES
(1, 'user1@mail.com', 'password1', 'ABC123'),
(2, 'user2@mail.com', 'password2', 'DEF456'),
(3, 'user3@mail.com', 'password3', 'GHI789'),
(4, 'user4@mail.com', 'password4', 'JKL012'),
(5, 'user5@mail.com', 'password5', 'MNO345'),
(6, 'user6@mail.com', 'password6', 'PQR678'),
(7, 'user7@mail.com', 'password7', 'STU901'),
(8, 'user8@mail.com', 'password8', 'VWX234'),
(9, 'user9@mail.com', 'password9', 'YZA567'),
(10, 'user10@mail.com', 'password10', 'BCD890');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_pedido_producto` (`Pedido`),
  ADD KEY `fk_producto_pedido` (`Producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `restaurante_id` (`restaurante_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD CONSTRAINT `fk_pedido_producto` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_pedido` FOREIGN KEY (`Producto`) REFERENCES `productos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurantes` (`codigo`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`codigo`);
COMMIT;
