-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-09-2020 a las 04:42:55
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `microlablina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variablestf`
--

CREATE TABLE `variablestf` (
  `id_variables` int(11) NOT NULL,
  `id_modelos` int(11) NOT NULL,
  `variable` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `maximo` float NOT NULL,
  `minimo` float NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `pinicial` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `variablestf`
--

INSERT INTO `variablestf` (`id_variables`, `id_modelos`, `variable`, `maximo`, `minimo`, `descrip`, `pinicial`) VALUES
(1, 1, 'J', 1, 0.0001, 'MOMENTO DE INERCIA INICIAL DEL MOTOR [kg.m^2]', 0.01),
(2, 1, 'b', 1, 0.0001, 'VISCOCIDAD DE FRICCION DEL MOTOR', 0.1),
(3, 1, 'R', 1, 0.01, 'RESISTENCIA ELECTRICA', 1),
(4, 1, 'L', 1, 0.00001, 'INDUCTANCIA ELECTRICA', 0.5),
(5, 1, 'K', 1, 0.0001, 'TORQUE Y FUERZA DEL MOTOR ', 0.01),
(14, 0, 'mp', 10, -10, 'Control Proporcional Motor', 1),
(15, 0, 'mi', 10, -10, 'Control integral Motor', 0.01),
(16, 0, 'md', 10, -10, 'Control derivativo Motor', 0.01),
(17, 0, 'mf', 1, 0, 'Filtro Control derivativo Motor', 0.01),
(18, 2, 'J', 1, 0.0001, 'momento de inercia inicial del motor [kg.m^2]', 0.44),
(19, 2, 'b', 1, 0.0001, 'viscocidad de friccion del motor', 0.0033),
(20, 2, 'R', 1, 0.01, 'resistencia electrica', 0.015),
(21, 2, 'L', 1, 0.00001, 'inductancia eléctrica', 0.045),
(22, 2, 'K', 1, 0.0001, 'Torque y fuerza del motor', 0.01),
(23, 2, 'g', 10, 8, 'Aceleracion Gravitacional ', -9.8),
(24, 2, 'bb', 6.9, -6.9, 'Angulo de engranaje servomotor [rad]', 1571),
(25, 2, 'y', 1, -1, 'Cordenada de la esfera [met]', 0),
(26, 2, 'a', 6.9, -6.9, 'Coordenada del angulo del haz [rad]', 3.14),
(27, 2, 'd', 0.5, -0.5, 'Desplazamiento del sigueñal en el motor [met]', 0.00000999),
(28, 2, 'm', 1, 0, 'Masa de la esfera [kg]', 0.11),
(29, 2, 'ji', 5, 0, 'Momento inercia esfera ', 0.004),
(30, 3, 'L', 5, 0, 'longitud de la vara [metros]', 0.5),
(31, 3, 'mg', 2, 0, 'Peso del motor [Kg]', 1),
(32, 3, 'K', 1, 0, 'Coheficiente de Empuje', 0.01),
(33, 3, 'c', 2, 0, 'CoHeficiente Friccion', 0.04),
(34, 4, 'wn', 10, -10, 'Frecuencia Natural', 1),
(35, 4, 'zeta', 1, 0, 'Coheficiente de amortiguacion', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `variablestf`
--
ALTER TABLE `variablestf`
  ADD PRIMARY KEY (`id_variables`),
  ADD KEY `id_modelos` (`id_modelos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `variablestf`
--
ALTER TABLE `variablestf`
  MODIFY `id_variables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
