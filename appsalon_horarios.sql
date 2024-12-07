-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 18:04:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appsalon_horarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaId` int(11) DEFAULT NULL,
  `usuarioId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `horaId`, `usuarioId`) VALUES
(1, '2024-12-09', 3, 4),
(2, '2024-12-12', 7, 4),
(3, '2024-12-11', 7, 4),
(4, '2024-12-17', 10, 4),
(5, '2024-12-24', 14, 4),
(6, '2024-12-30', 10, 4),
(7, '2024-12-16', 11, 4),
(8, '2024-12-12', 11, 4),
(9, '2024-12-09', 14, 4),
(10, '2024-12-17', 13, 4),
(11, '2024-12-11', 12, 4),
(12, '2024-12-10', 11, 4),
(13, '2024-12-17', 15, 4),
(14, '2024-12-11', 13, 4),
(15, '2024-12-10', 14, 4),
(16, '2024-12-19', 14, 4),
(17, '2024-12-17', 14, 4),
(18, '2024-12-19', 12, 4),
(19, '2024-12-12', 15, 4),
(20, '2024-12-18', 14, 4),
(21, '2024-12-18', 12, 4),
(22, '2024-12-10', 7, 4),
(23, '2024-12-12', 9, 4),
(24, '2024-12-11', 15, 4),
(25, '2024-12-18', 15, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citasservicios`
--

CREATE TABLE `citasservicios` (
  `id` int(11) NOT NULL,
  `citaId` int(11) DEFAULT NULL,
  `servicioId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citasservicios`
--

INSERT INTO `citasservicios` (`id`, `citaId`, `servicioId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 3, 1),
(6, 3, 3),
(7, 4, 13),
(8, 5, 1),
(9, 6, 1),
(10, 6, 2),
(11, 7, 11),
(12, 8, 1),
(13, 9, 1),
(14, 10, 1),
(15, 11, 1),
(16, 12, 1),
(17, 13, 1),
(18, 14, 1),
(19, 15, 1),
(20, 16, 1),
(21, 17, 1),
(22, 18, 1),
(23, 19, 1),
(24, 20, 1),
(25, 21, 1),
(26, 22, 1),
(27, 23, 1),
(28, 24, 1),
(29, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `id` int(11) NOT NULL,
  `hora` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`id`, `hora`) VALUES
(1, '9:00 am'),
(2, '9:30 am'),
(3, '10:00 am'),
(4, '10:30 am'),
(5, '11:00 am'),
(6, '11:30 am'),
(7, '12:00 pm'),
(8, '12:30 pm'),
(9, '1:00 pm'),
(10, '1:30 pm'),
(11, '4:00 pm'),
(12, '4:30 pm'),
(13, '5:00 pm'),
(14, '5:30 pm'),
(15, '6:00 pm'),
(16, '6:30 pm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
(1, 'Corte de Cabello Mujer', 90.00),
(2, 'Corte de Cabello Hombre', 80.00),
(3, 'Corte de Cabello Niño', 60.00),
(4, 'Peinado Mujer', 80.00),
(5, 'Peinado Hombre', 60.00),
(6, 'Peinado Niño', 60.00),
(7, 'Corte de Barba', 60.00),
(8, 'Tinte Mujer', 300.00),
(9, 'Uñas', 400.00),
(10, 'Lavado de Cabello', 50.00),
(11, 'Tratamiento Capilar', 150.00),
(12, ' Tinte para cabello', 120.00),
(13, 'tinte total', 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `admin`, `confirmado`, `token`) VALUES
(1, 'Admin', 'Super Poderoso', 'admin@admin.com', '$2y$10$t4eDIrvOExTaTpZXsWknYORQ5iAZLofW4jmVCiHHTDcTRtBfPTCsC', '1234567890', 1, 1, ''),
(2, 'pepe', 'juan', 'pepe@juan', '123456', '123456789', 0, 1, '0'),
(4, 'jose', 'luis', 'jose@luis', '$2y$10$gWJXL/Fdt4OgfE0hMxJ5reUP0VsyLCRm2y5d511TzYYtbI2nXrXwW', '123456789', 0, 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_usuarios_idx` (`usuarioId`),
  ADD KEY `hora_id` (`horaId`) USING BTREE;

--
-- Indices de la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citaId_idx` (`citaId`),
  ADD KEY `servicioId_idx` (`servicioId`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`horaId`) REFERENCES `horas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `citasservicios`
--
ALTER TABLE `citasservicios`
  ADD CONSTRAINT `citasServicios_ibfk_1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `citasServicios_ibfk_2` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
