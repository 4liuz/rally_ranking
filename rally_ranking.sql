-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2025 a las 17:55:19
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
-- Base de datos: `rally_ranking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `usuario` varchar(30) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`usuario`, `password`) VALUES
('admin', 'rally_ranking');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `participante` varchar(30) DEFAULT NULL,
  `votos` int(11) DEFAULT NULL,
  `admin` varchar(30) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `rally` int(11) DEFAULT NULL,
  `ultima_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `baja` tinyint(1) DEFAULT 0,
  `ultima_actualizacion` datetime DEFAULT NULL,
  `ultimo_usuario` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participantes`
--

INSERT INTO `participantes` (`id`, `usuario`, `password`, `nombre`, `apellidos`, `email`, `fecha_creacion`, `baja`, `ultima_actualizacion`, `ultimo_usuario`) VALUES
(1, 'aliuz', 'aliuz', 'Alejandro', 'Ruiz Martín', 'aliuz@gmail.com', '2025-05-27', 0, '2025-06-01 17:30:17', 'aliuz'),
(2, 'dukati', 'dukati', 'Sergio', 'Morales Trujillo', 'sergio@gmail.com', '2025-05-27', 0, '2025-05-28 18:26:56', NULL),
(3, 'esthertru', 'esthertru', 'Esther', 'Núñez Burgos', 'esther@gmail.com', '2025-05-27', 0, '2025-05-28 20:34:10', NULL),
(4, 'martin', 'martin', 'Martín', 'Gómez Tovaruela', 'martin@gmail.com', '2025-05-28', 1, '2025-05-28 20:32:49', NULL),
(5, 'orc', 'orc', 'Orc', 'Bad Rlybad', 'orc@gmail.com', '2025-05-28', 0, '2025-05-28 21:30:30', NULL),
(6, 'goblin', 'goblin', 'Goblin', 'Duende Verde', 'goblin@gmail.com', '2025-05-28', 0, '2025-05-29 18:15:19', NULL),
(7, 'Alquimia', 'Alquimia', 'Alquimia', 'Pérez Rayuela', 'alquimia@gmail.com', '2025-05-29', 0, '2025-05-29 18:18:17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rally`
--

CREATE TABLE `rally` (
  `id` int(11) NOT NULL,
  `fecha_inicio_subidas` date DEFAULT NULL,
  `fecha_fin_subidas` date DEFAULT NULL,
  `fecha_inicio_votaciones` date DEFAULT NULL,
  `fecha_fin_votaciones` date DEFAULT NULL,
  `limite_fotos_participante` int(3) DEFAULT NULL,
  `ultima_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votantes`
--

CREATE TABLE `votantes` (
  `ip` varchar(20) NOT NULL,
  `votos` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`usuario`(20));

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `rally`
--
ALTER TABLE `rally`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votantes`
--
ALTER TABLE `votantes`
  ADD PRIMARY KEY (`ip`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rally`
--
ALTER TABLE `rally`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
