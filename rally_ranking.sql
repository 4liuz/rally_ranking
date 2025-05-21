-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2025 a las 23:53:25
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
-- Base de datos: `ceramicart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertantes`
--

CREATE TABLE `ofertantes` (
  `id_ofertante` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertantes`
--

INSERT INTO `ofertantes` (`id_ofertante`, `usuario`) VALUES
(2, 'Aliuz'),
(1, 'Estheresperfecta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id_oferta` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_ofertante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `id_servicio`, `id_ofertante`) VALUES
(1, 1, 1),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(6) NOT NULL,
  `servicio` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `max_participantes` int(11) DEFAULT NULL,
  `maps` varchar(41) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `servicio`, `descripcion`, `max_participantes`, `maps`, `direccion`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Clase cerámica Esther', NULL, NULL, 'https://maps.app.goo.gl/ASkMFWEMkE3MRvD97', 'Sevilla, 41009, C/ Froilán de la Serna, 9, Bajo B', '2024-10-11 18:00:00', NULL),
(2, 'Décimo aniversario Barros Alfonso', NULL, NULL, 'https://maps.app.goo.gl/uxTPoAS3G2XKo9E26', 'Casco Antiguo, 41004 Sevilla', '2024-10-30 20:30:00', NULL),
(3, 'Exposición de innovación cerámica con Amanda', NULL, NULL, 'https://maps.app.goo.gl/uA7gUWSXKuwFDChQ8', 'C. Galena, 3, 41009 Sevilla', '2025-03-10 10:00:00', NULL),
(4, 'Escogiendo colores con Aurelio y Aimar', NULL, NULL, 'https://maps.app.goo.gl/rGGP3NtdwHrcXRQx6', 'San Luis, 54, Casco Antiguo, 41003 Sevilla', '2025-02-15 16:30:00', NULL),
(5, 'Clase de alfarería con Alejandro', NULL, NULL, 'https://maps.app.goo.gl/tqg5psJfF168pAPdA', 'C. San Fernando, 4, 41004 Sevilla', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `passwd`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_registro`) VALUES
(1, 'Estheresperfecta', '', 'Esther', 'Núñez Burgos', 'nubures.ceramicart@gmail.com', '+34 123456789', '2024-10-13'),
(2, 'Aliuz', '', 'Alejandro', 'Ruiz Martín', 'ale2jandro1@gmail.com', '644972645', '2024-10-13'),
(3, 'Batman', '', 'Alphonse', 'Cruz Jhonson', 'crjhoal.ceramicart@gmail.com', '+44 070645248', '2024-12-18');
(4, 'Prueba1', '', 'Prueba1', 'Prueba1 Prueba1', 'nubures.ceramicart@gmail.com', '+34 123456789', '2024-10-13'),
(5, 'Prueba2', '', 'Prueba2', 'Prueba2 Prueba2', 'ale2jandro1@gmail.com', '644972645', '2024-10-13'),
(6, 'Prueba3', '', 'Prueba3', 'Prueba3 Prueba3', 'crjhoal.ceramicart@gmail.com', '+44 070645248', '2024-12-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ofertantes`
--
ALTER TABLE `ofertantes`
  ADD PRIMARY KEY (`id_ofertante`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `oferta_fk_id_ofertante` (`id_ofertante`),
  ADD KEY `oferta_fk_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `solicitud_fk_id_usuario` (`id_usuario`),
  ADD KEY `solicitud_fk_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ofertantes`
--
ALTER TABLE `ofertantes`
  ADD CONSTRAINT `ofertantes_fk_id_usuario` FOREIGN KEY (`id_ofertante`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertantes_fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `oferta_fk_id_ofertante` FOREIGN KEY (`id_ofertante`) REFERENCES `ofertantes` (`id_ofertante`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `oferta_fk_id_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitud_fk_id_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitud_fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
