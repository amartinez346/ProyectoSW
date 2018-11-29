-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2018 a las 13:56:16
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `identificador` int(11) NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `pregunta` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `correcta` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `incorrecta1` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `incorrecta2` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `incorrecta3` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `complejidad` int(1) NOT NULL,
  `tema` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`identificador`, `email`, `pregunta`, `correcta`, `incorrecta1`, `incorrecta2`, `incorrecta3`, `complejidad`, `tema`, `imagen`) VALUES
(1, 'aitor234@ikasle.ehu.eus', 'dasdasdasdasd', 'adsdasdasdas', 'dasdasdasddas', 'dasdasd', 'sadasda', 3, 'dasdas', 'imagenes_bd/fondo.jpg'),
(2, 'sadasdas123@ikasle.ehu.eus', 'dsadasdasdasd', 'deqsdgegdg', 'dgfdfgdgf', 'dfgdgf', 'dgfgdf', 2, '4', 'imagenes_bd/pordefecto.jpg'),
(3, 'asda123@ikasle.ehu.eus', 'wwwwwwwwwwwwwwwww', 'dasd', 'g', 'g', 'gg', 2, 'dd', 'imagenes_bd/fondo.jpg'),
(4, 'asda123@ikasle.ehu.eus', 'wwwwwwwwwwwwwwwww', 'q', 'q', 'q', 'q', 3, 'e', NULL),
(5, 'asda123@ikasle.ehu.eus', 'bbbbbbbbbbbb', 'r', 'r', 'r', 'r', 2, 'r', NULL),
(6, 'asda123@ikasle.ehu.eus', 'fsdfsdfsdfsdf', 'sdfsdfds', 'fdsfsd', 'fdsfsd', 'fdsfsd', 2, 'das', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contrasena` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `nombre`, `apellidos`, `foto`, `contrasena`) VALUES
('', '', '', NULL, ''),
('asda123@ikasle.ehu.eus', 'asda', 'dasdasd dasdas', NULL, '123456'),
('asdadddd123@ikasle.ehu.eus', 'asda', 'dasdasd dasdas', NULL, '98745632');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
