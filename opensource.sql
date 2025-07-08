-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2025 a las 03:21:15
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
-- Base de datos: `opensource`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_subtarea`
--

CREATE TABLE `registro_subtarea` (
  `id` int(11) NOT NULL,
  `tarea` int(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` enum('Definido','En proceso','Completada') NOT NULL,
  `estado_actualizado` enum('','Archivada','Eliminada','Vencida') NOT NULL,
  `prioridad` enum('Baja','Normal','Alta','-') NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `responsable` varchar(80) NOT NULL,
  `colaborador` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registro_subtarea`
--

INSERT INTO `registro_subtarea` (`id`, `tarea`, `descripcion`, `estado`, `estado_actualizado`, `prioridad`, `fecha_vencimiento`, `comentario`, `responsable`, `colaborador`) VALUES
(320, 472, 'Veamos', 'En proceso', '', 'Baja', '2025-04-18', 'Dasda', 'rociojazmin@gmail.com', 'candeladiaz@gmail.com'),
(797, 472, 'ESTA ES', 'Definido', '', 'Alta', '2025-05-15', 'Sdfsd', 'rociojazmin@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_tarea`
--

CREATE TABLE `registro_tarea` (
  `id` int(11) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `colaborador` varchar(300) NOT NULL,
  `tema` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `prioridad` enum('Baja','Normal','Alta') NOT NULL,
  `estado` enum('Definido','En proceso','Completada') NOT NULL,
  `estado_actualizado` enum('Archivada','Eliminada','Vencida','') NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_recordatorio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registro_tarea`
--

INSERT INTO `registro_tarea` (`id`, `correo`, `colaborador`, `tema`, `descripcion`, `prioridad`, `estado`, `estado_actualizado`, `fecha_vencimiento`, `fecha_recordatorio`) VALUES
(348, 'candeladiaz@gmail.com', 'candeladiaz@gmail.com', 'SDASD', 'ADASD', 'Baja', 'Completada', 'Archivada', '2025-05-30', '0000-00-00'),
(376, 'rociojazmin@gmail.com', 'candeladiaz@gmail.com, ambarlenceria@gmail.com', 'Ejemplo', 'Sdas', 'Normal', 'En proceso', 'Vencida', '2025-04-04', '2025-04-17'),
(452, 'rociojazmin@gmail.com', '', 'RFRF', 'RFSDFS', 'Baja', 'En proceso', '', '2025-05-30', '2025-05-13'),
(472, 'rociojazmin@gmail.com', 'candeladiaz@gmail.com', 'Carga de datos', 'Ingreso de información al sistema de gestión interna, verificación de datos duplicados y generación de reportes preliminares.', 'Normal', 'En proceso', '', '2025-05-31', '2025-05-13'),
(594, 'rociojazmin@gmail.com', '', 'Organización de archivos', 'Clasificación y digitalización de documentos físicos, creación de carpetas en la nube y actualización del inventario de archivos.', 'Baja', 'Definido', 'Vencida', '2025-05-29', '2025-05-08'),
(608, 'rociojazmin@gmail.com', '', 'El impacto de la inteligencia artificial en la vida cotidiana', 'Redactá un ensayo de entre 800 y 1000 palabras donde analices los beneficios, riesgos y desafíos éticos de la inteligencia artificial. Citá al menos tres fuentes académicas.', 'Baja', 'En proceso', '', '2025-06-20', '2025-05-13'),
(878, 'rociojazmin@gmail.com', '', 'Ejemplo', 'Real', 'Normal', 'Completada', 'Vencida', '2025-05-11', '2025-04-26'),
(912, 'rociojazmin@gmail.com', '', 'Redes sociales', 'Publicación de contenido en Instagram y Facebook, respuesta a comentarios y programación de posteos semanales.', 'Normal', 'Completada', 'Vencida', '2025-05-11', '2025-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuario`
--

CREATE TABLE `registro_usuario` (
  `correo` varchar(50) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `contra` varchar(12) NOT NULL,
  `contra2` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registro_usuario`
--

INSERT INTO `registro_usuario` (`correo`, `nombre`, `apellido`, `contra`, `contra2`) VALUES
('candeladiaz@gmail.com', 'Candela', 'Diaz', '1234567', '1234567'),
('juanperez@gmail.com', 'Juan', 'Perez', '1234567', '1234567'),
('rociojazmin@gmail.com', 'Rocioo', 'Vilchez', '1234567', '1234567');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_subtarea`
--
ALTER TABLE `registro_subtarea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_tarea`
--
ALTER TABLE `registro_tarea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_usuario`
--
ALTER TABLE `registro_usuario`
  ADD PRIMARY KEY (`correo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
