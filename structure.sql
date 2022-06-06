-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2021 a las 05:40:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tisupport`
--
DROP DATABASE IF EXISTS `tisupport`;
CREATE DATABASE `tisupport` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tisupport`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` varchar(500) NOT NULL,
  `causa` varchar(50) DEFAULT NULL,
  `solucion` varchar(50) DEFAULT NULL,
  `tiempoConsumido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `bitacora`
--
DELIMITER $$
CREATE TRIGGER `deleteBitacora` BEFORE DELETE ON `bitacora` FOR EACH ROW BEGIN
	delete from tieneBitacora where id_bitacora = old.id;
        delete from escribeBitacora where id = old.id;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateBitacora` BEFORE UPDATE ON `bitacora` FOR EACH ROW BEGIN
	update  tieneBitacora set id_bitacora = new.id where id_bitacora = old.id;
        update escribeBitacora set id=new.id where id = old.id;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `deleteCliente` BEFORE DELETE ON `cliente` FOR EACH ROW BEGIN
	delete from contrata where correo = old.correo;

    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateCliente` BEFORE UPDATE ON `cliente` FOR EACH ROW BEGIN
	update  contrata set correo= new.correo where correo= old.correo;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrata`
--

CREATE TABLE `contrata` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `correo` varchar(100) DEFAULT NULL,
  `pass` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `esDirector` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `empleado`
--
DELIMITER $$
CREATE TRIGGER `deleteEmpleado` BEFORE DELETE ON `empleado` FOR EACH ROW BEGIN
	delete from asignado where correo= old.correo;
        delete from escribeNota where correo = old.correo;
	delete from escribeBitacora where correo = old.correo;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateEmpleado` BEFORE UPDATE ON `empleado` FOR EACH ROW BEGIN
	update  tieneAsignado set correo = new.correo where correo= old.correo;
        update escribeNota set correo=new.correo where correo = old.correo;
	update escribeBitacora set correo=new.correo where correo = old.correo;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escribebitacora`
--

CREATE TABLE `escribebitacora` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escribenota`
--

CREATE TABLE `escribenota` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fallo`
--

CREATE TABLE `fallo` (
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `fallo`
--
DELIMITER $$
CREATE TRIGGER `deleteFallo` BEFORE DELETE ON `fallo` FOR EACH ROW BEGIN
	delete from tieneFallo where id_fallo = old.id;
        delete from tieneAsignado where id = old.id;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateFallo` BEFORE UPDATE ON `fallo` FOR EACH ROW BEGIN
	update  tieneFallo set id_fallo = new.id where id_fallo= old.id;
        update tieneAsignado set id=new.id where id = old.id;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `contenido` varchar(500) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `nota`
--
DELIMITER $$
CREATE TRIGGER `deleteNota` BEFORE DELETE ON `nota` FOR EACH ROW BEGIN
	delete from tieneNota where id_nota = old.id;
        delete from escribeNota where id = old.id;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateNota` BEFORE UPDATE ON `nota` FOR EACH ROW BEGIN
	update  tieneNota set id_nota = new.id where id_nota= old.id;
        update escribeNota set id=new.id where id = old.id;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `nombre` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  `fechaDeContratacion` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `proyecto`
--
DELIMITER $$
CREATE TRIGGER `deleteProyecto` BEFORE DELETE ON `proyecto` FOR EACH ROW BEGIN
		delete from tieneFallo where id_proyecto = old.id;
        delete from contrata where id = old.id;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateProyecto` BEFORE UPDATE ON `proyecto` FOR EACH ROW BEGIN
	update  contrata set id= new.id where id= old.id;
        update tieneFallo set id_proyecto=new.id where id_proyecto = old.id;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tieneasignado`
--

CREATE TABLE `tieneasignado` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienebitacora`
--

CREATE TABLE `tienebitacora` (
  `id_bitacora` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienefallo`
--

CREATE TABLE `tienefallo` (
  `id_proyecto` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienenota`
--

CREATE TABLE `tienenota` (
  `id_nota` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `contrata`
--
ALTER TABLE `contrata`
  ADD PRIMARY KEY (`correo`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escribebitacora`
--
ALTER TABLE `escribebitacora`
  ADD PRIMARY KEY (`correo`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `escribenota`
--
ALTER TABLE `escribenota`
  ADD PRIMARY KEY (`correo`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `fallo`
--
ALTER TABLE `fallo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tieneasignado`
--
ALTER TABLE `tieneasignado`
  ADD PRIMARY KEY (`correo`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `tienebitacora`
--
ALTER TABLE `tienebitacora`
  ADD PRIMARY KEY (`id_bitacora`,`id_fallo`),
  ADD KEY `id_fallo` (`id_fallo`);

--
-- Indices de la tabla `tienefallo`
--
ALTER TABLE `tienefallo`
  ADD PRIMARY KEY (`id_proyecto`,`id_fallo`),
  ADD KEY `id_fallo` (`id_fallo`);

--
-- Indices de la tabla `tienenota`
--
ALTER TABLE `tienenota`
  ADD PRIMARY KEY (`id_nota`,`id_fallo`),
  ADD KEY `id_fallo` (`id_fallo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contrata`
--
ALTER TABLE `contrata`
  ADD CONSTRAINT `contrata_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `cliente` (`correo`),
  ADD CONSTRAINT `contrata_ibfk_2` FOREIGN KEY (`id`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `escribebitacora`
--
ALTER TABLE `escribebitacora`
  ADD CONSTRAINT `escribebitacora_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bitacora` (`id`);

--
-- Filtros para la tabla `escribenota`
--
ALTER TABLE `escribenota`
  ADD CONSTRAINT `escribenota_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nota` (`id`);

--
-- Filtros para la tabla `tieneasignado`
--
ALTER TABLE `tieneasignado`
  ADD CONSTRAINT `tieneasignado_ibfk_1` FOREIGN KEY (`id`) REFERENCES `fallo` (`id`);

--
-- Filtros para la tabla `tienebitacora`
--
ALTER TABLE `tienebitacora`
  ADD CONSTRAINT `tienebitacora_ibfk_1` FOREIGN KEY (`id_bitacora`) REFERENCES `bitacora` (`id`),
  ADD CONSTRAINT `tienebitacora_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`);

--
-- Filtros para la tabla `tienefallo`
--
ALTER TABLE `tienefallo`
  ADD CONSTRAINT `tienefallo_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`),
  ADD CONSTRAINT `tienefallo_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`);

--
-- Filtros para la tabla `tienenota`
--
ALTER TABLE `tienenota`
  ADD CONSTRAINT `tienenota_ibfk_1` FOREIGN KEY (`id_nota`) REFERENCES `nota` (`id`),
  ADD CONSTRAINT `tienenota_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
