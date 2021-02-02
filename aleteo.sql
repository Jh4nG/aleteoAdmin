-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-02-2021 a las 00:38:25
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aleteo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `desc_categoria` varchar(200) NOT NULL COMMENT 'Comentarios adicionales de la categoría.',
  `cant_reg` int(11) NOT NULL COMMENT 'Cantidad total de registros en categoría',
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`, `desc_categoria`, `cant_reg`, `fecha_creacion`) VALUES
(1, 'Deslizador Inicio', 'Deslizador página inicio. Si tiene vídeo es necesario colocar el \"Iframe\" de Youtube. Si no, es necesario dejar el campo vacío.', 3, '2020-09-29 13:20:08'),
(2, 'Tres Cartas (Inicio)', 'Las tres cartas que aparecen en la página Inicio. Éstas requieren una imagen en tamaño 320x180.', 4, '2020-10-05 20:03:17'),
(3, 'Frases página Inicio', 'Frases relacionadas con aleteo al Inicio de página.', 3, '2020-10-06 13:17:10'),
(4, 'Logos Footer', 'Agregación de los logos de las partes participantes', 10, '2020-12-30 18:09:02'),
(5, 'Redes Sociales Footer', 'Redes Sociales Footer', 5, '2020-12-30 18:46:58'),
(6, 'Información de Contacto', 'Información de Contacto', 0, '2021-01-23 12:22:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp(),
  `imagen` blob DEFAULT NULL,
  `imagen2` blob NOT NULL,
  `logo` blob DEFAULT NULL,
  `ico` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `direccion`, `telefono`, `correo`, `descripcion`, `fecha_creacion`, `fecha_modificacion`, `imagen`, `imagen2`, `logo`, `ico`) VALUES
(1, 'Aleteo - Transmedia', '', '-', '-', '', '2020-09-13 16:15:54', '2020-09-13 16:15:54', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podcast`
--

CREATE TABLE `podcast` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `audio` blob DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Común');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sec_titulo` varchar(50) NOT NULL COMMENT 'Título de sección',
  `sec_desc` varchar(500) NOT NULL COMMENT 'Descripción de la sección',
  `sec_img` text NOT NULL COMMENT 'imgágen',
  `sec_iframe` text NOT NULL COMMENT 'frame',
  `sec_link_redirect` varchar(100) NOT NULL,
  `sec_icon` varchar(20) NOT NULL,
  `sec_estado` tinyint(1) NOT NULL COMMENT 'Estado activo / inactvio',
  `sec_posicion` int(11) NOT NULL COMMENT 'Posición para mostrar',
  `id_categoria` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`, `sec_titulo`, `sec_desc`, `sec_img`, `sec_iframe`, `sec_link_redirect`, `sec_icon`, `sec_estado`, `sec_posicion`, `id_categoria`, `fecha_creacion`) VALUES
(1, 'Vídeo Inicio', 'CROWDFUNDING', 'Este es el contenido', '', '<iframe width=\"650\" height=\"400\" src=\"https://www.youtube.com/embed/dqJ6p7lhg8Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '', '', 1, 1, 1, '2020-09-29 13:38:11'),
(2, 'Imágne inicio deslizadores', 'LA MARIPOSA ALETEA', '\"El aleteo de una mariposa puede generar un tsunami al otro lado del mundo\".', 'Mariposa 1.png', '', '', '', 1, 2, 1, '2020-10-05 19:38:54'),
(3, 'Podcast', 'Podcast', 'En éste podcast encontrarás toda la información hacer de premisas de futuro.', '3Podcast2.jpg', '', '', '', 1, 1, 2, '2020-10-06 12:24:14'),
(4, 'Frase alusiva a la web', '#AleteoHaciaElFuturo', 'Un simple respiro puede cambiar todo lo que conocemos', '2High_Concept.jpg', '', '', 'fa fa-puzzle-piece', 1, 1, 3, '2020-10-06 13:48:27'),
(5, 'Chimenea Cultural', 'Chimenea', 'La chimenea Cultural', 'Chimenea.jpg', '', 'http://lachimeneacultural.org/', '', 1, 1, 4, '2020-12-30 18:11:47'),
(6, 'Facebook', 'Facebook', 'Facebook', '', '', 'https://www.facebook.com/aleteotransmedia', 'fa fa-facebook', 1, 1, 5, '2020-12-30 19:04:27'),
(7, 'Twitter', 'Twitter', 'Twitter', '', '', 'https://twitter.com/CChimenea', 'fa fa-twitter', 1, 2, 5, '2020-12-30 19:04:27'),
(8, 'Instagram', 'Instagram', 'Instagram', '', '', 'https://www.instagram.com/aleteo_transmedia/', 'fa fa-instagram', 1, 3, 5, '2020-12-30 19:05:04'),
(9, 'Youtube', 'Youtube', 'Youtube', '', '', 'https://www.youtube.com/channel/UCVBNYMpvj4liLG6xSaMCJWQ/featured', 'fa fa-youtube', 1, 4, 5, '2020-12-30 20:18:17'),
(10, 'Periódico Digital', 'Periódico Digital', 'Texto sobre un futuro cercano.', 'Periodico_digital.jpg', '', '', '', 1, 2, 2, '2021-01-08 17:38:40'),
(11, 'Video Juego', 'Video Juego', 'Este es el vídeo juego de Aleteo Transmedia', 'Mariposa 3.png', '', '', '', 1, 3, 2, '2021-01-08 17:39:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `comentarios` varchar(400) DEFAULT NULL,
  `codigo` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fecha_suscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `foto` blob DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp(),
  `id_clie` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `contrasena` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombres`, `estado`, `foto`, `fecha_creacion`, `fecha_modificacion`, `id_clie`, `id_rol`, `contrasena`) VALUES
(1, 'admin', 'Administrador', 1, NULL, '2021-01-24 10:42:21', '2021-01-24 10:42:21', 1, 1, '$2y$10$6b6X7.bLU68xsdpJ7BplkOobKw70LCgAiITC5Lkv.ko.9ME7gU9pW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitador`
--

CREATE TABLE `visitador` (
  `id_visitador` varchar(100) NOT NULL,
  `fecha_primer_visita` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitador`
--

INSERT INTO `visitador` (`id_visitador`, `fecha_primer_visita`) VALUES
('192.168.0.13', '2021-01-24 12:43:54'),
('::1', '2021-01-24 12:35:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_vis` int(11) NOT NULL,
  `fecha_visita` datetime DEFAULT current_timestamp(),
  `id_visitador` varchar(100) DEFAULT NULL,
  `pagina` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_vis`, `fecha_visita`, `id_visitador`, `pagina`) VALUES
(1, '2021-01-24 12:35:01', '::1', NULL),
(2, '2021-01-24 12:36:24', '::1', NULL),
(3, '2021-01-24 12:38:04', '::1', NULL),
(4, '2021-01-24 12:39:54', '::1', NULL),
(5, '2021-01-24 12:43:54', '192.168.0.13', NULL),
(6, '2021-01-24 12:44:13', '192.168.0.13', NULL),
(7, '2021-01-24 12:44:20', '192.168.0.13', NULL),
(8, '2021-01-24 12:44:23', '192.168.0.13', NULL),
(9, '2021-01-24 12:44:24', '192.168.0.13', NULL),
(10, '2021-01-24 12:44:26', '192.168.0.13', NULL),
(11, '2021-01-24 12:45:01', '192.168.0.13', NULL),
(12, '2021-01-24 12:45:05', '192.168.0.13', NULL),
(13, '2021-01-24 12:45:53', '192.168.0.13', NULL),
(14, '2021-01-24 12:48:03', '::1', NULL),
(15, '2021-01-24 12:49:41', '::1', NULL),
(16, '2021-01-24 12:49:55', '::1', NULL),
(17, '2021-01-24 12:50:08', '192.168.0.13', NULL),
(18, '2021-01-24 20:38:08', '::1', NULL),
(19, '2021-01-27 16:32:11', '::1', NULL),
(20, '2021-01-27 16:36:09', '::1', NULL),
(21, '2021-01-27 16:48:34', '::1', NULL),
(22, '2021-01-27 16:49:07', '::1', NULL),
(23, '2021-01-30 21:49:15', '::1', NULL),
(24, '2021-01-30 21:54:19', '::1', NULL),
(25, '2021-01-30 22:02:28', '::1', NULL),
(26, '2021-01-31 10:21:35', '::1', NULL),
(27, '2021-01-31 10:50:01', '::1', 'Inicio'),
(28, '2021-01-31 10:50:35', '::1', 'Podcast'),
(29, '2021-02-01 18:30:04', '::1', 'Inicio'),
(30, '2021-02-01 18:40:28', '::1', 'Podcast'),
(31, '2021-02-01 18:42:34', '::1', 'Inicio'),
(32, '2021-02-01 18:54:33', '::1', 'Inicio'),
(33, '2021-02-01 18:55:14', '::1', 'Podcast');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitador`
--
ALTER TABLE `visitador`
  ADD UNIQUE KEY `id_visitador` (`id_visitador`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_vis`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_vis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD CONSTRAINT `podcast_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
