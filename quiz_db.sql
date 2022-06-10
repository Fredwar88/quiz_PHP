-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2022 a las 21:42:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiz_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cagt_ID` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cagt_ID`, `nombre`) VALUES
(1, 'Biologia'),
(2, 'Fisica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `fech_ID` int(11) NOT NULL,
  `fecha` year(4) NOT NULL COMMENT 'Año al que corresponde la pregunta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fecha`
--

INSERT INTO `fecha` (`fech_ID`, `fecha`) VALUES
(1, 2018),
(2, 2019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `preg_ID` int(11) NOT NULL,
  `Pregunta` varchar(300) NOT NULL,
  `tutor_descrip` text NOT NULL,
  `cag_pre_ID` int(11) NOT NULL,
  `fech_pre_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`preg_ID`, `Pregunta`, `tutor_descrip`, `cag_pre_ID`, `fech_pre_ID`) VALUES
(1, '¿Cual de los siguientes animales es un mamífero?', 'Los mamiferos son animales que amamantan a sus crias.', 1, 1),
(2, 'Las plantas ganan energía a través de la __', 'Las plantas aprovechan mucho la luz solar', 1, 1),
(3, '¿Cual es la constante de la gravedad?', 'La gravedad es la fuerza con la que un cuerpo atrae a otro en el espacio', 2, 2),
(4, '¿Quién descubrió la gravedad?', 'Tiene que ver con una manzana...\r\n', 2, 2),
(5, 'Que es el plantón?', 'Se encuentran en el mar', 1, 1),
(6, 'Cual es la gravedad de marte?', 'a', 2, 2),
(7, 'Cual es el animal mas venenoso?', 'Es un animal pequeño', 1, 1),
(8, 'Que es un quark?', 'Física cuántica ', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz_record`
--

CREATE TABLE `quiz_record` (
  `quiz_ID` int(11) NOT NULL,
  `quiz_quest_num` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `quiz_record`
--

INSERT INTO `quiz_record` (`quiz_ID`, `quiz_quest_num`, `answer`, `date`, `user`) VALUES
(1, 5, 0, '2022-06-10', ''),
(2, 5, 0, '2022-06-10', ''),
(3, 5, 0, '2022-06-10', ''),
(4, 5, 0, '2022-06-10', ''),
(5, 5, 0, '2022-06-10', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `resp_ID` int(11) NOT NULL,
  `respuesta` varchar(300) NOT NULL,
  `validador` tinyint(1) NOT NULL COMMENT 'False = incorrecto True = correcto',
  `preg_id_rel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`resp_ID`, `respuesta`, `validador`, `preg_id_rel`) VALUES
(11, 'Ballena', 1, 1),
(12, 'Rana', 0, 1),
(13, 'Fotosintesis', 1, 2),
(14, 'Ciclo del agua', 0, 2),
(15, '9.81', 1, 3),
(16, '10.08', 0, 3),
(17, 'Issac Newton', 1, 4),
(18, 'Nicola Tesla', 0, 4),
(19, 'Animal microscópico', 1, 5),
(20, 'Un Crustáceo ', 0, 5),
(21, 'Rana dardo', 1, 7),
(22, 'Cobra Rey', 0, 7),
(23, 'Particula subatomica', 1, 8),
(24, 'Un neutro', 0, 8),
(25, '3.71', 1, 6),
(26, '5.38', 0, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cagt_ID`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`fech_ID`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`preg_ID`),
  ADD KEY `cag_pre_ID` (`cag_pre_ID`),
  ADD KEY `fech_pre_ID` (`fech_pre_ID`);

--
-- Indices de la tabla `quiz_record`
--
ALTER TABLE `quiz_record`
  ADD PRIMARY KEY (`quiz_ID`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`resp_ID`),
  ADD KEY `preg_id_rel` (`preg_id_rel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cagt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `fech_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `preg_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `quiz_record`
--
ALTER TABLE `quiz_record`
  MODIFY `quiz_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `resp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`cag_pre_ID`) REFERENCES `categorias` (`cagt_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`fech_pre_ID`) REFERENCES `fecha` (`fech_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`preg_id_rel`) REFERENCES `preguntas` (`preg_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
