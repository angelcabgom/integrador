-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2024 a las 12:31:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trekwikia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(60) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `telefono` varchar(16) DEFAULT NULL,
  `organizacionNombre` varchar(30) DEFAULT NULL,
  `userType` varchar(10) NOT NULL,
  `imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `email`, `password`, `pais`, `telefono`, `organizacionNombre`, `userType`, `imagen`) VALUES
(64, 'angelcabgom', 'angelsw55', 'angel@angel.com', '$2y$10$Sn.3VPW8hTylyybI8kksa.lKfC8lHnK0JBdo2zN2XtP8pl8XuuRfu', 'Switzerland', NULL, NULL, 'user', '65b1902119f8f_venom.jpeg'),
(65, 'angelorg', 'organ12', 'angel@angel1.com', '$2y$10$iMrCRqrxPj6omif6HJlqrOy90mBOLG3XTm9EFr3EqV6iFQnRtYmt2', 'Cyprus', '1234561233', 'angelRun333', 'org', '65b191a631b45_sunset-anime-comet-stars-scenery-digital-art-4k-wallpaper-uhdpaper.com-771@0@i.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
