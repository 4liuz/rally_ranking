-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2025 a las 21:09:30
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
  `ruta` varchar(250) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `participante` varchar(30) DEFAULT NULL,
  `votos` int(11) DEFAULT 0,
  `admin` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 2,
  `rally` int(11) DEFAULT NULL,
  `ultima_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `ruta`, `foto`, `participante`, `votos`, `admin`, `estado`, `rally`, `ultima_actualizacion`) VALUES
(1, 'img_684398bb98a1b4.30321722.jpg', 'Cisne', 'aliuz', 0, 'admin', 2, 1, '2025-06-08 03:41:20'),
(2, 'img_684398eb9604a7.04352394.jpg', 'Ganso', 'aliuz', 0, 'admin', 0, 1, '2025-06-08 07:40:51'),
(3, 'img_6844575f4e5e83.77251735.jpg', 'Frailecillo en su salsa', 'esthertru', 0, 'admin', 2, 1, '2025-06-08 12:38:01'),
(4, 'img_6845691f075e50.32025054.jpg', 'Búho 2', 'aliuz', 0, 'admin', 1, 1, '2025-06-08 12:43:38'),
(5, 'img_6845de73d2e628.03426005.jpg', 'Verde que te quiero verde', 'dukati', 0, 'admin', 1, 1, '2025-06-08 21:03:41');

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
(1, 'aliuz', 'Aliuz.1', 'Alejandro ', 'Ruiz Martín', 'aliuz@gmail.com', '2025-05-27', 0, '2025-06-08 17:19:24', 'aliuz'),
(2, 'dukati', 'Dukati.1', 'Sergio', 'Morales Trujillo', 'sergio@gmail.com', '2025-05-27', 0, '2025-05-28 18:26:56', NULL),
(3, 'esthertru', 'Esthertru.1', 'Esther', 'Núñez Burgos', 'esther@gmail.com', '2025-05-27', 0, '2025-05-28 20:34:10', NULL),
(4, 'parras', 'Parras.1', 'Antonio José', 'Parras Flores', 'parras@gmail.com', '2025-06-04', 0, '2025-06-04 03:21:51', 'parras'),
(5, 'yzzz', 'Yaqi.1', 'Ya Qiang', 'Zhu', 'yaqiang@gmail.com', '2025-05-28', 1, '2025-05-28 20:32:49', NULL),
(6, 'talegaso', 'Talegaso.1', 'José', 'García de Lemus', 'jose@gmail.com', '2025-06-08', 0, '2025-06-08 20:59:16', 'talegaso');

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

--
-- Volcado de datos para la tabla `rally`
--

INSERT INTO `rally` (`id`, `fecha_inicio_subidas`, `fecha_fin_subidas`, `fecha_inicio_votaciones`, `fecha_fin_votaciones`, `limite_fotos_participante`, `ultima_actualizacion`) VALUES
(1, '2025-06-08', '2025-06-09', '2025-06-10', '2025-06-11', 3, '2025-06-08 12:48:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votantes`
--

CREATE TABLE `votantes` (
  `ip` varchar(20) NOT NULL,
  `rally` int(11) NOT NULL,
  `votos` int(1) NOT NULL DEFAULT 3
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
  ADD PRIMARY KEY (`ip`,`rally`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rally`
--
ALTER TABLE `rally`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
