-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-02-2023 a las 22:58:06
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_veterinaria`
--
CREATE DATABASE IF NOT EXISTS `db_veterinaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `db_veterinaria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del cliente',
  `nombres` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'nombres del cliente',
  `apellidos` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'apellidos del cliente',
  `telefono` varchar(9) COLLATE utf8_bin NOT NULL COMMENT 'telefono del cliente',
  `email` varchar(200) COLLATE utf8_bin NOT NULL COMMENT 'email cliente',
  `dui` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'dui cliente',
  `direccion` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'direccion del cliente',
  `status` tinyint(4) DEFAULT '1' COMMENT 'estado del registro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `telefono`, `email`, `dui`, `direccion`, `status`) VALUES
(1, 'Juan Carlos', 'Moreno Hernández', '7333-2222', 'juan@gmail.com', '34343433-1', 'Santa Rosa de Lima, La Unión', 1),
(2, 'Ángel Daniel', 'Herrera Benitez', '8998-9898', 'william@gmail.com', '34343433-4', 'Prueba', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

DROP TABLE IF EXISTS `mascotas`;
CREATE TABLE IF NOT EXISTS `mascotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la tabla mascota',
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Nombre de la mascota',
  `tipo` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Tipo ave, mamifero etc',
  `raza` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Raza de la mascota',
  `especie` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Especie de la mascota',
  `fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento',
  `status` tinyint(4) DEFAULT '1' COMMENT 'esatdo del registro',
  PRIMARY KEY (`id`),
  KEY `fk_id_cliente_mascota_idx` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `id_cliente`, `nombre`, `tipo`, `raza`, `especie`, `fecha_nacimiento`, `status`) VALUES
(1, 1, 'Boby', 'Mamiferos', 'Pastor Aleman', 'Perro', '2022-02-08', 1),
(2, 1, 'Rony', 'Retiles', 'Boa', 'Serpiente', '2020-01-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicamento` varchar(100) COLLATE utf8_bin NOT NULL,
  `proveedor` varchar(100) COLLATE utf8_bin NOT NULL,
  `modos_aplicacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fecha_vencimiento` date NOT NULL,
  `dosis` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `medicamento`, `proveedor`, `modos_aplicacion`, `fecha_vencimiento`, `dosis`, `status`) VALUES
(1, 'Viatminas', 'Laboratorios X', 'Aplicar en forma de inyecciones', '2025-01-22', '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la tabla usuario',
  `username` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'nombre del usuario',
  `email` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'correo del usuario',
  `password` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'password del usuario',
  `status` tinyint(4) DEFAULT '1' COMMENT 'Estado del registro activo o inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'Admin Veterinaria', 'admin@admin.com', 'c93ccd78b2076528346216b3b2f701e6', 1),
(2, 'Hernández', 'hernandez@gmail.com', '4739928f184e1811444cec1308725973', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `fk_id_cliente_mascota` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
