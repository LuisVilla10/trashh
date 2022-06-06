-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2021 a las 05:41:26
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
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `causa`, `solucion`, `tiempoConsumido`) VALUES
('bitac-614b8a86be117', 'Codigo estaba incorrecto', 'Corregir el codigo', 5);

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nombre`, `correo`, `password`, `rfc`) VALUES
('cliente1', 'cliente1@gmail.com', '1234', 'rfc1234'),
('cliente2', 'cliente2@gmail.com', '1234', 'rfc567'),
('cliente3', 'cliente3@gmail.com', '1234', 'rfc8910'),
('cliente4', 'cliente4@gmail.com', '1234', 'rfc101112'),
('cliente5', 'cliente5@gmail.com', '1234', 'rfc131415'),
('cliente6', 'cliente6@gmail.com', '1234', 'rfc161718');

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `correo`, `password`, `esDirector`) VALUES
(8,  'admin', 'admin@admin.com', '1234', 1),
(9,  'empleado1', 'empleado1@gmail.com', '1234', 0),
(10, 'empleado2', 'empleado2@gmail.com', '1234', 0),
(12, 'empleado3', 'empleado3@gmail.com', '1234', 0),
(13, 'empleado4', 'empleado4@gmail.com', '1234', 0),
(15, 'empleado5', 'empleado5@gmail.com', '1234', 0),
(16, 'empleado6', 'empleado6@gmail.com', '1234', 0),
(18, 'empleado7', 'empleado7@gmail.com', '1234', 0);

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`contenido`, `fecha`, `id`) VALUES
('Contenido de la nota', '21-10-2021', 'nota-61561afd098b1');

--
-- Volcado de datos para la tabla `escribenota`
--

INSERT INTO `escribenota` (`correo`, `id`) VALUES
('admin@admin.com', 'nota-61561afd098b1');

--
-- Volcado de datos para la tabla `fallo`
--

INSERT INTO `fallo` (`descripcion`, `fecha`, `id`, `status`) VALUES
('value', 'value', 'fallo-615004c569a90', 'notificado'),
('sfsasdaf ', '2021-08-30', 'fallo-615094b0bfa86', 'notificado'),
('Prueba final ', '2021-09-15', 'fallo-615204dc0867e', 'notificado'),
('asdfasdf', '2021-08-30', 'fallo-615205982c942', 'notificado'),
('asdfasdf', '2021-08-30', 'fallo-615205d61b417', 'notificado'),
('asdfasdf', '2021-08-30', 'fallo-615205e4a6da9', 'notificado'),
('Estaba abriendo el trabado', '2021-09-16', 'fallo-6152506a164c3', 'notificado'),
('value', 'value', 'fallo-6152532b05ed0', 'notificado'),
('value', 'value', 'fallo-6152533585d35', 'notificado'),
('value', 'value', 'fallo-6152537cbdd35', 'notificado'),
('value', 'value', 'fallo-615261589f365', 'notificado'),
('value', 'value', 'fallo-615261771b889', 'notificado'),
('JcskvoOh', '2021-10-01', 'fallo-61579856a7004', 'notificado'),
('Entre a admin pero cargo como cliente', '2021-09-17', 'fallo-61579ddf14120', 'notificado'),
('122222', '2021-09-29', 'fallo-6157bf59e93dc', 'notificado'),
('zfasfdsa ', '2021-09-29', 'fallo-6157bfb76d820', 'notificado'),
('zfasfdsa ', '2021-09-29', 'fallo-6157bff765ddb', 'notificado'),
('value', 'value', 'fallo-6157c05643fb0', 'notificado'),
('value', 'value', 'fallo-6157c07c2ef38', 'notificado'),
('value', 'value', 'fallo-6157c08b0545c', 'notificado'),
('value', 'value', 'fallo-6157c0964fef8', 'notificado'),
('zfasfdsa ', '2021-09-29', 'fallo-6157c09dd1bdc', 'notificado'),
('asdfa q2341 1', '2021-09-28', 'fallo-6157c0c09168e', 'notificado'),
('asdf ', '2021-09-27', 'fallo-6157c2a267344', 'notificado'),
('dfghd', '2021-09-27', 'fallo-6157c2b0e64c3', 'notificado'),
('asf a', '2021-09-28', 'fallo-6157c31ac7d0d', 'notificado'),
('1231231 ', '2021-09-27', 'fallo-6157c50adbd93', 'notificado'),
('qweqwer', '2021-09-27', 'fallo-6157c514c918a', 'notificado'),
('asdgfa wgsdgsdg', '2021-09-27', 'fallo-6157c53207373', 'notificado'),
('qwrq 12313', '2021-09-14', 'fallo-6157c6807e5db', 'notificado'),
('dfgasf a', '2021-09-27', 'fallo-6157c6c5bce88', 'notificado'),
('Probando interfaz', '2021-10-01', 'fallo-6157c6f9e09d2', 'notificado'),
('value', 'value', 'fallo-6157cc07bb860', 'notificado'),
('value', 'value', 'fallo-6157cccbb63c3', 'notificado');

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`nombre`, `status`, `id`, `fechaDeContratacion`) VALUES
('proyecto a', 'en diseño', 'proy-2342tggssbafsd5', '1-09-2021'),
('proyecto x', 'en desarrollo', 'proy-614b6212c4eda', '05-06-2000'),
('Prueba', 'en diseño', 'proy-615613e4053b3', '21-02-2069'),
('proyecto d', 'en diseño', 'proy-65768asdfgafsd5', '20-09-2021'),
('proyecto c', 'implementado', 'proy-a16843213468', '20-09-2021'),
('proyecto b', 'en pruebas', 'proy-asdfasfd546', '20-09-2021');

--
-- Volcado de datos para la tabla `contrata`
--

INSERT INTO `contrata` (`correo`, `id`) VALUES
('cliente2@gmail.com', 'proy-65768asdfgafsd5'),
('cliente2@gmail.com', 'proy-a16843213468'),
('cliente3@gmail.com', 'proy-615613e4053b3'),
('cliente3@gmail.com', 'proy-asdfasfd546'),
('cliente4@gmail.com', 'proy-2342tggssbafsd5'),
('cliente6@gmail.com', 'proy-614b6212c4eda');

--
-- Volcado de datos para la tabla `tieneasignado`
--

INSERT INTO `tieneasignado` (`correo`, `id`) VALUES
('admin@admin.com', 'fallo-615004c569a90'),
('admin@admin.com', 'fallo-615094b0bfa86'),
('admin@admin.com', 'fallo-615205982c942'),
('admin@admin.com', 'fallo-615261589f365'),
('empleado6@gmail.com', 'fallo-6152537cbdd35'),
('empleado6@gmail.com', 'fallo-615261589f365'),
('empleado6@gmail.com', 'fallo-615261771b889');

--
-- Volcado de datos para la tabla `tienefallo`
--

INSERT INTO `tienefallo` (`id_proyecto`, `id_fallo`) VALUES
('proy-614b6212c4eda', 'fallo-615004c569a90'),
('proy-614b6212c4eda', 'fallo-615094b0bfa86'),
('proy-614b6212c4eda', 'fallo-615204dc0867e'),
('proy-614b6212c4eda', 'fallo-615205982c942'),
('proy-614b6212c4eda', 'fallo-615205d61b417'),
('proy-614b6212c4eda', 'fallo-615205e4a6da9'),
('proy-614b6212c4eda', 'fallo-6152506a164c3'),
('proy-614b6212c4eda', 'fallo-6152532b05ed0'),
('proy-614b6212c4eda', 'fallo-6152533585d35'),
('proy-614b6212c4eda', 'fallo-6152537cbdd35'),
('proy-614b6212c4eda', 'fallo-615261589f365'),
('proy-614b6212c4eda', 'fallo-615261771b889'),
('proy-614b6212c4eda', 'fallo-61579856a7004'),
('proy-614b6212c4eda', 'fallo-61579ddf14120'),
('proy-614b6212c4eda', 'fallo-6157bf59e93dc'),
('proy-614b6212c4eda', 'fallo-6157bfb76d820'),
('proy-614b6212c4eda', 'fallo-6157bff765ddb'),
('proy-614b6212c4eda', 'fallo-6157c09dd1bdc'),
('proy-614b6212c4eda', 'fallo-6157c0c09168e'),
('proy-614b6212c4eda', 'fallo-6157c2a267344'),
('proy-614b6212c4eda', 'fallo-6157c2b0e64c3'),
('proy-614b6212c4eda', 'fallo-6157c31ac7d0d'),
('proy-614b6212c4eda', 'fallo-6157c50adbd93'),
('proy-614b6212c4eda', 'fallo-6157c514c918a'),
('proy-614b6212c4eda', 'fallo-6157c53207373'),
('proy-614b6212c4eda', 'fallo-6157c6807e5db'),
('proy-614b6212c4eda', 'fallo-6157c6c5bce88'),
('proy-614b6212c4eda', 'fallo-6157c6f9e09d2'),
('proy-65768asdfgafsd5', 'fallo-615261589f365'),
('proy-a16843213468', 'fallo-615261771b889'),
('proy-asdfasfd546', 'fallo-6157c05643fb0'),
('proy-asdfasfd546', 'fallo-6157c07c2ef38'),
('proy-asdfasfd546', 'fallo-6157c08b0545c'),
('proy-asdfasfd546', 'fallo-6157c0964fef8'),
('proy-asdfasfd546', 'fallo-6157cc07bb860'),
('proy-asdfasfd546', 'fallo-6157cccbb63c3');

--
-- Volcado de datos para la tabla `tienenota`
--

INSERT INTO `tienenota` (`id_nota`, `id_fallo`) VALUES
('nota-61561afd098b1', 'fallo-615004c569a90');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
