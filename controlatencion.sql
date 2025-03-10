-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2024 a las 22:23:55
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
-- Base de datos: `bd_crua`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlatencion`
--

CREATE TABLE `controlatencion` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellido` varchar(80) NOT NULL,
  `Cedula` varchar(80) NOT NULL,
  `Fecha` date NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Entidad` varchar(50) NOT NULL,
  `Tipoatencion` varchar(50) NOT NULL,
  `Otro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `controlatencion`
--

INSERT INTO `controlatencion` (`id`, `Nombre`, `Apellido`, `Cedula`, `Fecha`, `Telefono`, `Entidad`, `Tipoatencion`, `Otro`) VALUES
(3, 'Melany', 'Quintero', '6-720-2280', '2024-08-08', '', '1', 'option2', ''),
(4, 'Melany', 'Quintero', '6-720-2280', '2024-08-08', '', '1', 'option2', ''),
(5, 'Melany', 'Quintero', '6-720-2280', '2024-08-06', '', 'Estudiante', 'Cima-Crua-Moodle', ''),
(6, 'Melany', 'Quintero', '6-720-2280', '2024-08-06', '', 'Estudiante', 'Cima-Crua-Moodle', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `controlatencion`
--
ALTER TABLE `controlatencion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `controlatencion`
--
ALTER TABLE `controlatencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
