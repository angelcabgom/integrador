-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2024 a las 16:25:26
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
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `dificultad` varchar(30) NOT NULL,
  `actividad` varchar(30) NOT NULL,
  `archivo` varchar(60) NOT NULL,
  `distancia` varchar(10) NOT NULL,
  `altMin` varchar(10) NOT NULL,
  `altMax` varchar(10) NOT NULL,
  `desnivelPos` varchar(10) NOT NULL,
  `desnivelNeg` varchar(10) NOT NULL,
  `ciudad` varchar(40) NOT NULL,
  `region` varchar(40) NOT NULL,
  `pais` varchar(40) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `nombre`, `descripcion`, `dificultad`, `actividad`, `archivo`, `distancia`, `altMin`, `altMax`, `desnivelPos`, `desnivelNeg`, `ciudad`, `region`, `pais`, `id_usuario`) VALUES
(37, 'Bike Sebring - Racetrack', 'qwEDAWEF', '🟨   Intermedio', 'Running', '65c60b1c5a0f1_Bike_Sebring_-_Racetrack.gpx', '8692.16730', '16.6', '19.9', '9.7', '9.6', '', 'Florida', 'United States', 65),
(38, 'Wikiloc - 2023 Dakar Stage 1 (The Rugged Rides)', 'erwferfwerf', '🟥   Dificil', 'Motos', '65c60d4ba185c_2023-dakar-stage-1-the-rugged-rides.gpx', '1061316.63', '-94.386', '2193.528', '11799.267', '11081.414', 'Azzaba', 'Cercle de Sefrou دائرة صفرو', 'Morocco', 65),
(39, 'Wikiloc - Circuito de Nürburgring', 'swertg', '🟩   Facil', 'Ski', '65c9d5e7dec8b_nurburgring.gpx', '20664.1190', '328.917', '630.723', '676.7', '676.732', 'Herschbroich', 'Rhineland-Palatinate', 'Germany', 65),
(40, 'Isle of Man TT Course', 'fwerf', '🟩   Facil', 'Hiking', '65c9d5f461bed_isleOfManTT.gpx', '60732.4758', '6.8', '431.8', '887.5', '887.5', 'Braddan', 'Middle', 'Isle of Man', 65),
(41, 'Wikiloc - Circuito de Nürburgring', 'wergf', '🟩   Facil', 'Hiking', '65c9d5fdafdac_nurburgring.gpx', '20664.1190', '328.917', '630.723', '676.7', '676.732', 'Herschbroich', 'Rhineland-Palatinate', 'Germany', 65);

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
(64, 'angelcabgom', 'angelsw55', 'angel@angel.com', '$2y$10$Sn.3VPW8hTylyybI8kksa.lKfC8lHnK0JBdo2zN2XtP8pl8XuuRfu', 'Switzerland', NULL, NULL, 'user', '65b4bbfb6ced0_GOAT.jpeg'),
(65, 'angelorg', 'organ12', 'angel@angel1.com', '$2y$10$iMrCRqrxPj6omif6HJlqrOy90mBOLG3XTm9EFr3EqV6iFQnRtYmt2', 'Cyprus', '1234561233', 'angelRun333', 'org', '65b191a631b45_sunset-anime-comet-stars-scenery-digital-art-4k-wallpaper-uhdpaper.com-771@0@i.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
