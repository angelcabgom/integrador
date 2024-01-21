-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2024 a las 18:35:30
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
  `username` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(60) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `telefono` varchar(16) DEFAULT NULL,
  `organizacionNombre` varchar(150) DEFAULT NULL,
  `userType` varchar(10) NOT NULL,
  `imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `email`, `password`, `localidad`, `telefono`, `organizacionNombre`, `userType`, `imagen`) VALUES
(16, 'mobuv', 'Hedley Harrington', 'jutijowyw@mailinator.com', '$2y$10$FXOJ4oiUav.rleHiVhpxc.VQUifqyleW6eSAofAQZjKFZ3KWfECOG', 'Voluptas nisi possim', '', '', 'user', '65a8efcc638d4_Captura de pantalla (6).png'),
(17, 'wijufulezo', 'Rosalyn Wiggins', 'rinom@mailinator.com', '$2y$10$4KWLY.FazJl1nanX4ZKQ.OU1/XbMt.7fkUp2pdH62cTcBgVuF7dlu', 'Et ad distinctio Po', '', '', 'user', '65a8f05112d65_Captura de pantalla (6).png'),
(18, 'jyfid', 'Shaeleigh Pratt', 'vyfyhaqe@mailinator.com', '$2y$10$GgYrnV6eOSroZpn5vyGM9OALgvMjrC22j4wHwLg63mIWpbQzQJOV.', 'Ut autem omnis ea ve', NULL, NULL, 'user', '65a8f18066230_Captura de pantalla (6).png'),
(19, 'lasode', 'Rogan Meyer', 'turyw@mailinator.com', '$2y$10$.Hbt7F/3.NDuR/VvawLYHuf6dy115n.P/lM2XzYkLJ7uT64v6ja.O', 'Eius temporibus nisi', '', '', 'user', '65a8f2dec9161_Captura de pantalla_20230217_085839.png'),
(20, 'wanyr', 'Chava Wooten', 'ciradajubi@mailinator.com', '$2y$10$TWS5Z9YG4qzL97WqWwIOLeN/QlLLZ4PxrE9HfzbTGpCYhgEb5xwii', 'Et qui libero lorem ', '', '', 'user', '65a8f30066e3e_Captura de pantalla (4).png'),
(21, 'jekelir', 'Britanni Hull', 'ciqah@mailinator.com', '$2y$10$pbYoWeF9F.MtwF4e5WnTpuSBIne9uUuqaYOfLutX10JHbJOX886kS', 'Quisquam temporibus ', '', '', 'user', '65a8f32008418_Captura de pantalla (3).png'),
(22, 'cacopyqon', 'Angela Dorsey', 'cory@mailinator.com', '$2y$10$lEIR0vq2StbQW1pHRltNoubIbgphP6krcFAivE6VHIT5CjJ0l.o3.', 'Placeat ipsum temp', '', '', 'user', '65a8f351d517b_Captura de pantalla_20230217_090223.png'),
(23, 'kugemyw', 'Jordan Blake', 'qukucune@mailinator.com', '$2y$10$E1DZOACusE0tdKG3twGv5eCWMvWgvbkNZlhSab3g6cDvRKqeio1fu', 'Consequuntur sed aut', NULL, NULL, 'user', '65a8f3a886424_Captura de pantalla_20230217_090223.png'),
(24, 'gipoj', 'Marah Hebert', 'kiqycoz@mailinator.com', '$2y$10$XLW4ichK6PJgjtKI8BqDZug7bSFmZswFXwVikeoVBvdZoJNmuhE1G', 'Dicta do consequat ', NULL, NULL, 'user', '65a8f56fb1e1f_Captura de pantalla (6).png'),
(26, 'sigosywem', 'Ulysses Alvarado', 'wanifade@mailinator.com', 'Pa$$w0rd!', 'Sit quibusdam asperi', '+1 (845) 697-640', 'Ipsum omnis qui susc', 'org', '65a8f733cc3b2_Captura de pantalla (6).png'),
(27, 'angelcabgom', 'angel', 'angel@angel.com', '$2y$10$ZBCUD.LQ91R2qC5z0e6M0ODNexJpo5c7O2/vhXUVlU.UzKy9/UZyi', 'lbz', NULL, NULL, 'user', '65a900681c691_Captura de pantalla (6).png'),
(28, 'angelrunning', 'angel', 'ang@angg', '123', 'lbz', '123456789', 'angelrunning', 'org', '65a9088f04aa8_Captura de pantalla (6).png'),
(29, 'angelrunning1', 'angel', 'ang@ang', '123', 'lbz', '123456789', 'angelruning1', 'org', '65a90ad87bd36_Captura de pantalla (6).png'),
(30, 'duturupipa', 'Beck Walker', 'goqu@mailinator.com', 'Pa$$w0rd!', 'Duis aliqua Placeat', '+1 (121) 832-762', 'Eligendi incidunt i', 'org', '65a90c014c4d9_Captura de pantalla (9).png'),
(31, 'angelrunning2', 'angel', 'ang@ang', '123', 'lbz', '123456789', 'angelrunning', 'org', '65a90c7024b40_Captura de pantalla (6).png'),
(33, 'angelrunning3', 'angel', 'ang@ang', '$2y$10$jFplrxkOuIz.YWBzmgCz0ejTFWX5yQoZc9XJjtsFdqrbRfl0PE3Tm', 'lbz', '123456789', 'angelrunning', 'org', '65a90ca06b891_Captura de pantalla (6).png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
