-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2013 a las 06:51:37
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `catalogo`
--
DROP DATABASE IF EXISTS `catalogo`;

CREATE DATABASE IF NOT EXISTS `catalogo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `catalogo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `cat_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `cat_nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_nombre`) VALUES
(1, 'Teléfonos Celulares'),
(2, 'Televisores'),
(3, 'Sistemas de Audio y Video'),
(4, 'GPS'),
(5, 'Tablet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `mrc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mrc_nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`mrc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`mrc_id`, `mrc_nombre`) VALUES
(1, 'Samsung'),
(2, 'Apple'),
(3, 'HTC'),
(4, 'Sony'),
(5, 'Bose'),
(6, 'Garmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `prd_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `prd_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `prd_descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `prd_precio` int(5) NOT NULL,
  `prd_envio` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `prd_stock` int(10) unsigned NOT NULL,
  `prd_salida` tinyint(4) NOT NULL,
  `prd_alta` date NOT NULL,
  `prd_foto` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'sin-foto.jpg',
  `cat_id` int(2) unsigned NOT NULL,
  `mrc_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`prd_id`),
  KEY `fk_prd_marcas_idx` (`mrc_id`),
  KEY `fk_prd_categorias_idx` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prd_id`, `prd_nombre`, `prd_descripcion`, `prd_precio`, `prd_envio`, `prd_stock`, `prd_salida`, `prd_alta`, `prd_foto`, `cat_id`, `mrc_id`) VALUES
(1, 'Iphone 4s 16gb', 'Teléfono celular Apple iPhone 4S de 16GB. Wifi, 3g, Gps, cámara de 8mp, pantalla HD (retina display) de 3.5 pulgadas.\r\nLibre de fábrica.\r\nIOS 5, procesador A5 dual core, doble cámara, sistema de control por voz Siri.', 4499, 'No', 21, 0, '2012-01-05', 'iphone4s.jpg', 1, 2),
(2, 'Samsung Galaxy S2', 'Teléfono celular 3g, Wifi, Android 2.3 Dual Core 1.2ghz, 16gb, Pantalla 4.27 pulgadas Super Amoled Plus.', 2650, 'No', 8, 24, '2012-01-07', 'galaxy-s2.jpg', 1, 1),
(3, 'Samsung Galaxy S', 'Teléfono celular con procesador ARM Cortex-A8 de 1 GHz, pantalla de 4 pulgadas con tecnología Super Clear LCD, 4Gb, cámara de 5 MP, Wifi, 3g.', 1600, 'Sí', 3, 24, '2012-01-10', 'galaxy-s1.jpg', 1, 1),
(4, 'HTC INSPIRE 4g', 'Teléfono celular con procesador Qualcomm de 1Ghz, 36gb, Gps, Wifi, 3g, pantalla SUPER LCD 4.3 pulgadas, Android 2.2 Froyo con HTC Sense.', 3026, 'No', 14, 72, '2012-01-10', 'htc-inspire.jpg', 1, 3),
(5, 'Televisor Led Samsung Un55c9000 ', 'Televidor Led de 55 pulgadas, 3D, resolución: 1920 x 1080, Full HD, Anynet+ (HDMI-CEC), Internet@TV, Skype on Samsung TV, Ethernet (LAN) x 1, WiFi Adaptor Support', 25900, 'Sí', 15, 48, '2012-01-16', 'samsung-Un55c9000.jpg', 2, 1),
(6, 'Televisor Led Samsung Un40c7000', 'Televidor Led de 40 pulgadas, 3D, resolución: 1920 x 1080, Full HD, Anynet+ (HDMI-CEC), Internet@TV, Skype on Samsung TV, Ethernet (LAN) x 1, WiFi Adaptor Support', 11100, 'Sí', 10, 24, '2012-01-16', 'samsung-Un40c7000.jpg', 2, 1),
(7, 'Televisor LED Sony Bravia KDL-46EX715', 'Televisor LED Sony 46 pulgadas, Full HD 1080p, BRAVIA Engine 3, Motionflow 120Hz, Wireless LAN Ready, Reproductor USB.', 10799, 'Sí', 5, 0, '2012-01-25', 'Sony-Bravia-KDL-46EX715.jpg', 2, 4),
(8, 'Apple Tv 2', 'Apple Tv2 Hdmi Wi-fi Wireless C/ Apple Remote, procesador A4 de 1GHz, Airplay Mirroring, Photo Stream, compatible con iCloud.\r\nControlá tu multimedia con al Apple Remote o desde tu iPhone, iPad o iPod.', 850, 'No', 20, 0, '2012-01-30', 'appleTV1.jpg', 3, 2),
(9, 'Apple Tv', 'Apple Tv2 Hdmi Wi-fi Wireless C/ Apple Remote, procesador Intel Pentium M de 1GHz, Airplay Mirroring, Photo Stream, compatible con iCloud.\r\nControlá tu multimedia con al Apple Remote o desde tu iPhone, iPad o iPod.', 450, 'Sí', 14, 72, '2012-01-30', 'appleTV2.jpg', 3, 2),
(10, 'Bose Sounddock 10', 'Sistema De Musica Digital Bose Sounddock 10 Para Ipod/iphone. DockStation.\r\nCompatible con las nuevas líneas de iPhone y de iPod. Bluetooth. Salida de video a un televisor o monitor.', 4500, 'Sí', 9, 0, '2012-01-30', 'Bose-SoundDockr-10.jpg', 3, 5),
(11, 'Garmin Nuvi 1490t', 'Gps Garmin Nuvi 1490t. Pantalla Lcd de 5 pulgadas,  Bluetooth, 4Gb internos de memoria, admite tarjetas de memoria microSD.  ', 1100, 'No', 5, 48, '2012-02-01', 'garmin.jpg', 4, 6),
(12, 'iPad 2 de 32GB Wifi', 'iPad 2 de 32 GB: pantalla de led retroiluminada de 9.7 pulgadas, \r\nWifi, Bluetooth, doble cámara; frontal y trasera.\r\nIOS 5, procesador A5 dual core.\r\nMultitouch. Airplay Mirroring, compatible con iCloud, Facetime, Airprint ', 3650, 'Sí', 20, 24, '2012-02-01', 'iPad2.jpg', 5, 2),
(13, 'Samsung Galaxy Tab', 'Samsung Galaxy Tab de 16gb, pantalla de 10 pulgadas, Wifi, procesador NVIDIA Tegra 2 Dual Core 1Ghz, doble cámara.', 3450, 'No', 15, 24, '2012-02-08', 'galaxy-tab.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_id` int(1) NOT NULL AUTO_INCREMENT,
  `usu_usuario` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usu_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usu_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usu_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_usuario` (`usu_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_usuario`, `usu_password`, `usu_nombre`, `usu_email`) VALUES
(1, 'admin', 'admin', 'Administrador del Sistema', 'admin@sistema.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prd_categorias` FOREIGN KEY (`cat_id`) REFERENCES `categorias` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prd_marcas` FOREIGN KEY (`mrc_id`) REFERENCES `marcas` (`mrc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
