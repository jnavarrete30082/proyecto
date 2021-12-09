-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2021 a las 06:05:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pwcs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(50) NOT NULL,
  `apellidosCliente` varchar(100) NOT NULL,
  `correoCliente` varchar(100) NOT NULL,
  `celularCliente` int(11) NOT NULL,
  `motivoCliente` varchar(100) NOT NULL,
  `descripcionCliente` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `apellidosCliente`, `correoCliente`, `celularCliente`, `motivoCliente`, `descripcionCliente`) VALUES
(2, 'Maria Mar', 'Navarro', 'marina@mail.com', 78945128, 'Paquetes', 'Quiero cotizar un paquete'),
(3, 'Josue', 'Mora', 'jmora@mail.com', 78945128, 'Paquetes', 'Quiero cotizar un vuelo'),
(7, 'Duvalier', 'Mora', 'dumora@mail.com', 85296345, 'Paquetes', 'quiero cotizar paquete'),
(8, 'Jazmin', 'Loaiza', 'jazala@mail.com', 60526345, 'Entrada', 'Cotizar entrada al museo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(2, 'Josue', 'em otra casa', 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(0, 'Jerson', '$2y$10$rwziiKt.wnpZz1yHXkx31uIAXNdMmofnsm6Sv3fiBDDfDmXAsQMwW', '2021-11-28 12:49:45'),
(0, 'Alex', '$2y$10$/wIzbnBmHicCtqy2D05MOeCNdUvx2xpUb0MNC4RTsV1vQBloM7iSi', '2021-11-30 19:39:53'),
(0, 'Alexa', '$2y$10$jOJpdqnrS4ts8jps7l8DXu6C7B/T/mknhbwLqwP2TusHybdsUeqRq', '2021-11-30 21:16:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `idVuelo` int(11) NOT NULL,
  `nombreVuelo` varchar(100) NOT NULL,
  `nombreAerolinea` varchar(255) NOT NULL,
  `destinoVuelo` varchar(255) NOT NULL,
  `precioVuelo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`idVuelo`, `nombreVuelo`, `nombreAerolinea`, `destinoVuelo`, `precioVuelo`) VALUES
(1, 'CharParis', 'Avianca', 'Paris', 1200);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`idVuelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `idVuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
