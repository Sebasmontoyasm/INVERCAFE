-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.31 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para invercafe-db
CREATE DATABASE IF NOT EXISTS `invercafe-db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `invercafe-db`;

-- Volcando estructura para tabla invercafe-db.broker
CREATE TABLE IF NOT EXISTS `broker` (
  `BROId` int(11) NOT NULL AUTO_INCREMENT,
  `PAISId` int(11) DEFAULT NULL,
  `BRONombre` varchar(500) DEFAULT NULL,
  `BROContacto` varchar(500) DEFAULT NULL,
  `BROTelefono` varchar(500) DEFAULT NULL,
  `BROEmail` varchar(500) DEFAULT NULL,
  `BROCiudad` varchar(500) DEFAULT NULL,
  `BRODireccion` varchar(500) DEFAULT NULL,
  `BROEstado` int(11) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BROId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.broker: ~4 rows (aproximadamente)
DELETE FROM `broker`;
/*!40000 ALTER TABLE `broker` DISABLE KEYS */;
INSERT INTO `broker` (`BROId`, `PAISId`, `BRONombre`, `BROContacto`, `BROTelefono`, `BROEmail`, `BROCiudad`, `BRODireccion`, `BROEstado`, `createdAt`, `updatedAt`) VALUES
	(1, NULL, 'COFFEE LINK', 'MARCO RUTTIMAN', NULL, NULL, NULL, NULL, 1, '2023-03-02 16:40:39', '2023-03-11 21:31:37'),
	(2, NULL, 'MARIA VICTORIA BARRIGA', 'MARIA VICTORIA BARRIGA', NULL, NULL, NULL, NULL, 1, '2023-03-02 16:40:48', '2023-03-11 21:31:38'),
	(3, NULL, 'MIGUEL SALAZAR', 'MIGUEL SALAZAR', NULL, NULL, NULL, NULL, 1, '2023-03-02 16:40:54', '2023-03-11 21:31:41'),
	(4, NULL, 'AGORA COFFEE', 'CARLOS ALVAREZ', NULL, NULL, NULL, NULL, 1, '2023-03-02 16:41:01', '2023-03-11 21:31:42');
/*!40000 ALTER TABLE `broker` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `CLIEId` int(11) NOT NULL AUTO_INCREMENT,
  `PAISId` int(11) DEFAULT NULL,
  `CLIENombre` varchar(500) DEFAULT NULL,
  `CLIEContacto` varchar(500) DEFAULT NULL,
  `CLIETelefono` varchar(500) DEFAULT NULL,
  `CLIEEmail` varchar(500) DEFAULT NULL,
  `CLIECiudad` varchar(500) DEFAULT NULL,
  `CLIEDireccion` varchar(500) DEFAULT NULL,
  `CLIEEstado` int(11) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CLIEId`),
  KEY `FK_cliente_countries` (`PAISId`),
  CONSTRAINT `FK_cliente_countries` FOREIGN KEY (`PAISId`) REFERENCES `countries` (`PAISId`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.cliente: ~25 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`CLIEId`, `PAISId`, `CLIENombre`, `CLIEContacto`, `CLIETelefono`, `CLIEEmail`, `CLIECiudad`, `CLIEDireccion`, `CLIEEstado`, `createdAt`, `updatedAt`) VALUES
	(1, NULL, 'Agora Coffee M', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:06', '2023-03-11 21:31:04'),
	(2, NULL, 'Aziende Reunite', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:14', '2023-03-02 16:42:14'),
	(3, NULL, 'Balzac Bros', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:21', '2023-03-02 16:42:30'),
	(4, NULL, 'Blaser trading', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:27', '2023-03-02 16:42:29'),
	(5, NULL, 'Coffee resource', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:35', '2023-03-02 16:42:44'),
	(6, NULL, 'G. BIJDENDIJK BV', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:40', '2023-03-02 16:42:43'),
	(7, NULL, 'Coffee source', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:50', '2023-03-02 16:43:11'),
	(8, NULL, 'Guzman', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:42:55', '2023-03-02 16:43:11'),
	(9, NULL, 'Hamburg coffee Company', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:05', '2023-03-02 16:43:10'),
	(10, NULL, 'Ibericafe', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:09', '2023-03-02 16:43:09'),
	(11, NULL, 'ICC', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:18', '2023-03-02 16:43:42'),
	(12, NULL, 'Icona', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:23', '2023-03-02 16:43:43'),
	(13, NULL, 'Integra', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:28', '2023-03-02 16:43:44'),
	(14, NULL, 'Intergrano', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:33', '2023-03-02 16:43:44'),
	(15, NULL, 'Ken gabbay', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:39', '2023-03-02 16:43:45'),
	(16, NULL, 'Maison P. Jobin', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:43:56', '2023-03-02 16:43:56'),
	(17, NULL, 'Mercon', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:04', '2023-03-02 16:44:04'),
	(18, NULL, 'Mitsui Asia', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:14', '2023-03-02 16:44:14'),
	(19, NULL, 'Mitsui USA', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:20', '2023-03-02 16:44:20'),
	(20, NULL, 'Origin coffee traders', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:28', '2023-03-02 16:44:28'),
	(21, NULL, 'Pergamino coffee', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:41', '2023-03-02 16:45:44'),
	(22, NULL, 'Raw Material', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:44', '2023-03-02 16:45:43'),
	(23, NULL, 'Serengeti', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:50', '2023-03-02 16:45:43'),
	(24, NULL, 'Sustainable harvest', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:44:55', '2023-03-02 16:45:42'),
	(25, NULL, 'Top of the crop', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:45:01', '2023-03-02 16:45:41'),
	(26, NULL, 'Tostadores Reunidos', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:45:09', '2023-03-02 16:45:40'),
	(27, NULL, 'Volcafe pte ltd', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:45:39', '2023-03-02 16:45:39'),
	(28, NULL, 'Volcafe USA', NULL, NULL, NULL, NULL, NULL, 1, '2023-03-02 16:45:53', '2023-03-02 16:45:56');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.config
CREATE TABLE IF NOT EXISTS `config` (
  `CFGEmpresa` varchar(50) DEFAULT NULL,
  `CFGEmpresaPrograma` varchar(100) DEFAULT NULL,
  `CFGNombreAplicacion` varchar(50) DEFAULT NULL,
  `CFGEmpresaDir` varchar(50) DEFAULT NULL,
  `CFGEmpresaTel` varchar(50) DEFAULT NULL,
  `CFGEmpresaEmail` varchar(50) DEFAULT NULL,
  `CFGEmpresaFax` varchar(50) DEFAULT NULL,
  `CFGEmpresaWeb` varchar(50) DEFAULT NULL,
  `CFGEmpresaCiudad` varchar(50) DEFAULT NULL,
  `CFPEmpresaDescAplicacion` varchar(500) DEFAULT NULL,
  `CFGEmpresaUploads` varchar(10) DEFAULT NULL,
  `CFGHost` varchar(50) DEFAULT NULL,
  `CFGEmpresaMailAutResp` varchar(50) DEFAULT NULL,
  `CFGEmpresaPwdAutResp` varchar(50) DEFAULT NULL,
  `CFGEmpresaMaskAutResp` varchar(50) DEFAULT NULL,
  `CFGEmpresaSbjAutResp` varchar(50) DEFAULT NULL,
  `CFGEmpresaFirma` varchar(50) DEFAULT NULL,
  `CFGEmpresaPuerto` varchar(50) DEFAULT NULL,
  `CFGEmpresaSMTPSeguro` varchar(50) DEFAULT NULL,
  `CFGEmpresaMailHost` varchar(50) DEFAULT NULL,
  `CFGWSMode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de configuracion del aplicativo';

-- Volcando datos para la tabla invercafe-db.config: ~0 rows (aproximadamente)
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `CONTId` int(11) NOT NULL AUTO_INCREMENT,
  `CONTRefBuyer` varchar(100) DEFAULT NULL,
  `CLIEId` int(11) DEFAULT NULL,
  `USRId` int(11) DEFAULT NULL,
  `BROId` int(11) DEFAULT NULL,
  `TCONId` int(11) DEFAULT NULL,
  `CONTLotesEmbarque` int(11) DEFAULT NULL,
  `CONTLotesBolsa` int(11) DEFAULT NULL,
  `CONTotalUnidades` int(11) DEFAULT NULL,
  `CONTEstado` int(11) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CONTId`),
  KEY `FK_contrato_cliente` (`CLIEId`),
  KEY `FK_contrato_broker` (`BROId`),
  KEY `FK_contrato_usuario` (`USRId`),
  KEY `CONTEstado` (`CONTEstado`),
  KEY `TCONId` (`TCONId`),
  KEY `CONTConsecutivo` (`CONTRefBuyer`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.contrato: ~9 rows (aproximadamente)
DELETE FROM `contrato`;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` (`CONTId`, `CONTRefBuyer`, `CLIEId`, `USRId`, `BROId`, `TCONId`, `CONTLotesEmbarque`, `CONTLotesBolsa`, `CONTotalUnidades`, `CONTEstado`, `createdAt`, `updatedAt`) VALUES
	(1, '123456', 13, 1, 4, 1, 8, 0, 2200, 1, '2023-04-16 21:20:42', '2023-04-16 21:30:55'),
	(2, '9874-r', 8, 1, 4, 2, NULL, 0, NULL, 1, '2023-04-16 21:32:35', '2023-04-16 21:32:35'),
	(3, 'S-8754378', 3, 1, 4, 2, NULL, 0, NULL, 1, '2023-04-16 21:56:31', '2023-04-16 21:56:31'),
	(4, 'S-8754378', 3, 1, 4, 2, NULL, 0, NULL, 1, '2023-04-16 22:01:35', '2023-04-16 22:01:35');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.contratodetalle
CREATE TABLE IF NOT EXISTS `contratodetalle` (
  `DETId` int(11) NOT NULL AUTO_INCREMENT,
  `CONTId` int(11) DEFAULT NULL,
  `DETUnidades` int(11) DEFAULT NULL,
  `DETKilos` int(11) DEFAULT NULL,
  `DETCalidad` int(11) DEFAULT NULL,
  `DETDescEspecial` varchar(500) DEFAULT NULL,
  `DETAsociacion` int(11) DEFAULT NULL,
  `DETCertificacion` int(11) DEFAULT NULL,
  `DETTipoPrecio` varchar(10) DEFAULT NULL,
  `DETUsdLbs` decimal(10,2) DEFAULT NULL,
  `DETAnioEmbarque` int(11) DEFAULT NULL,
  `DETMesEmbarque` int(11) DEFAULT NULL,
  `DETRangoEmbarque` int(11) DEFAULT NULL,
  `DETPosicion` int(11) DEFAULT NULL,
  `DETAnioPosicion` int(11) DEFAULT NULL,
  `DETRequerimientos` int(11) DEFAULT NULL,
  `DETObservaciones` varchar(2000) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`DETId`),
  KEY `FK_contratodetalle_contrato` (`CONTId`),
  KEY `FK_contratodetalle_kilos` (`DETKilos`),
  KEY `FK_contratodetalle_calidad` (`DETCalidad`),
  KEY `FK_contratodetalle_certificacion` (`DETCertificacion`),
  KEY `FK_contratodetalle_mesembarque` (`DETMesEmbarque`),
  KEY `FK_contratodetalle_rangoembarque` (`DETRangoEmbarque`),
  KEY `FK_contratodetalle_posicion` (`DETPosicion`),
  KEY `FK_contratodetalle_requerimientos` (`DETRequerimientos`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.contratodetalle: ~15 rows (aproximadamente)
DELETE FROM `contratodetalle`;
/*!40000 ALTER TABLE `contratodetalle` DISABLE KEYS */;
INSERT INTO `contratodetalle` (`DETId`, `CONTId`, `DETUnidades`, `DETKilos`, `DETCalidad`, `DETDescEspecial`, `DETAsociacion`, `DETCertificacion`, `DETTipoPrecio`, `DETUsdLbs`, `DETAnioEmbarque`, `DETMesEmbarque`, `DETRangoEmbarque`, `DETPosicion`, `DETAnioPosicion`, `DETRequerimientos`, `DETObservaciones`, `createdAt`, `updatedAt`) VALUES
	(1, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:20:42', '2023-04-16 21:30:44'),
	(10, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:26:05', '2023-04-16 21:30:44'),
	(21, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:06', '2023-04-16 21:30:44'),
	(22, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:06', '2023-04-16 21:30:44'),
	(23, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:06', '2023-04-16 21:30:44'),
	(24, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:06', '2023-04-16 21:30:44'),
	(25, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:25', '2023-04-16 21:30:44'),
	(26, 1, 275, 52, 1, '', 73, 22, 'Dif', 50.00, 2023, 42, 36, 13, 2023, 66, 'Observaciones generales', '2023-04-16 21:30:25', '2023-04-16 21:30:44'),
	(32, 4, 500, 52, 9, '', 73, 22, 'Fixed', 330.00, 2023, 42, 36, NULL, NULL, NULL, '', '2023-04-16 22:01:35', '2023-04-16 23:54:01'),
	(33, 4, 500, 56, 2, '', 72, 25, 'Fixed', 380.00, 2023, 42, 36, NULL, NULL, 69, '', '2023-04-16 22:43:45', '2023-04-16 22:43:45'),
	(34, 4, 160, 55, NULL, 'Tostado, Molido Pitalito', 74, NULL, 'Fixed', 269.00, 2023, 42, 36, NULL, NULL, NULL, '', '2023-04-16 22:46:33', '2023-04-16 22:46:33'),
	(35, 4, 300, 54, 8, '', 74, 32, 'Fixed', 550.00, 2023, 42, 36, NULL, NULL, 68, 'Nuevas observaciones', '2023-04-16 23:54:01', '2023-04-16 23:54:01');
/*!40000 ALTER TABLE `contratodetalle` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `PAISId` int(11) NOT NULL AUTO_INCREMENT,
  `continent_code` varchar(3) DEFAULT NULL,
  `continent_name` varchar(50) DEFAULT NULL,
  `country_iso_code` varchar(3) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `geoname_id` varchar(50) DEFAULT NULL,
  `objectId` varchar(50) DEFAULT NULL,
  `PAISEstado` int(11) DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PAISId`) USING BTREE,
  KEY `country_name` (`PAISId`,`country_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.countries: ~246 rows (aproximadamente)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`PAISId`, `continent_code`, `continent_name`, `country_iso_code`, `country_name`, `geoname_id`, `objectId`, `PAISEstado`, `updatedAt`, `createdAt`) VALUES
	(1, 'SA', 'South America', 'CO', 'Colombia', '3686110', 'wmXXCNd1PH', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(2, 'AS', 'Asia', 'AF', 'Afghanistan', '1149361', 'kzwpKPMasw', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(3, 'EU', 'Europe', 'AX', 'Åland', '661882', 'jA4xUN7Q7i', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(4, 'EU', 'Europe', 'AL', 'Albania', '783754', 'kSH5IrECeP', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(5, 'AF', 'Africa', 'DZ', 'Algeria', '2589581', 'fGtnUBhTWy', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(6, 'OC', 'Oceania', 'AS', 'American Samoa', '5880801', 'gi9jUryAvI', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(7, 'EU', 'Europe', 'AD', 'Andorra', '3041565', 'OBmWlhKRFR', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(8, 'AF', 'Africa', 'AO', 'Angola', '3351879', 'oGNxVHCtYq', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(9, 'NA', 'North America', 'AI', 'Anguilla', '3573511', '6asw3cbFNV', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(10, 'AN', 'Antarctica', 'AQ', 'Antarctica', '6697173', '0kNW2MbbhD', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(11, 'NA', 'North America', 'AG', 'Antigua and Barbuda', '3576396', 'fsknOHkRPw', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(12, 'SA', 'South America', 'AR', 'Argentina', '3865483', 'ntwKsNf7vM', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(13, 'AS', 'Asia', 'AM', 'Armenia', '174982', 'D96KVxlh2Y', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(14, 'NA', 'North America', 'AW', 'Aruba', '3577279', '4mToPPk0fs', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(15, 'OC', 'Oceania', 'AU', 'Australia', '2077456', 'udCKDCperb', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(16, 'EU', 'Europe', 'AT', 'Austria', '2782113', 'FC13y6Z9SS', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(17, 'AS', 'Asia', 'AZ', 'Azerbaijan', '587116', 'UyraIPA99M', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(18, 'NA', 'North America', 'BS', 'Bahamas', '3572887', '8dPYl0EjLt', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(19, 'AS', 'Asia', 'BH', 'Bahrain', '290291', 'QeTa0GpFRi', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(20, 'AS', 'Asia', 'BD', 'Bangladesh', '1210997', '9bq72PooVk', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(21, 'NA', 'North America', 'BB', 'Barbados', '3374084', 'lRkyTddp6a', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(22, 'EU', 'Europe', 'BY', 'Belarus', '630336', 'ouLvTFPU1p', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(23, 'EU', 'Europe', 'BE', 'Belgium', '2802361', 'RHZpl3UDlB', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(24, 'NA', 'North America', 'BZ', 'Belize', '3582678', 'T1TIIN013V', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(25, 'AF', 'Africa', 'BJ', 'Benin', '2395170', '32UsUNcFZd', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(26, 'NA', 'North America', 'BM', 'Bermuda', '3573345', 'y0TlcbTman', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(27, 'AS', 'Asia', 'BT', 'Bhutan', '1252634', 'SgfFjRMsSz', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(28, 'SA', 'South America', 'BO', 'Bolivia', '3923057', 'dcGVYbNfuc', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(29, 'NA', 'North America', 'BQ', 'Bonaire', '7626844', 'DgNaQI0rAK', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(30, 'EU', 'Europe', 'BA', 'Bosnia and Herzegovina', '3277605', 'NWTWF1LeSi', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(31, 'AF', 'Africa', 'BW', 'Botswana', '933860', 'idgWTcol8k', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(32, 'SA', 'South America', 'BR', 'Brazil', '3469034', 'CvAY7ECTOU', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(33, 'AS', 'Asia', 'IO', 'British Indian Ocean Territory', '1282588', 'bbvq5qquQ6', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(34, 'NA', 'North America', 'VG', 'British Virgin Islands', '3577718', 'WQYYou1XsE', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(35, 'AS', 'Asia', 'BN', 'Brunei', '1820814', '5KdCmoXkoa', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(36, 'EU', 'Europe', 'BG', 'Bulgaria', '732800', 'ZtnxK93isF', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(37, 'AF', 'Africa', 'BF', 'Burkina Faso', '2361809', 'FZAzQ7JKNe', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(38, 'AF', 'Africa', 'BI', 'Burundi', '433561', '3kIH4wQT89', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(39, 'AS', 'Asia', 'KH', 'Cambodia', '1831722', 'kfc5euEYmg', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(40, 'AF', 'Africa', 'CM', 'Cameroon', '2233387', 'iZ9UlYnvkQ', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(41, 'NA', 'North America', 'CA', 'Canada', '6251999', 'PP8lREpbT2', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(42, 'AF', 'Africa', 'CV', 'Cape Verde', '3374766', 'bxrXbuKnZ4', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(43, 'NA', 'North America', 'KY', 'Cayman Islands', '3580718', '7ySSYqYIHR', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(44, 'AF', 'Africa', 'CF', 'Central African Republic', '239880', 'Qsbo33tzMO', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(45, 'AF', 'Africa', 'TD', 'Chad', '2434508', 'xM5XikkWaF', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(46, 'SA', 'South America', 'CL', 'Chile', '3895114', 'u8gNBXz36w', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(47, 'AS', 'Asia', 'CN', 'China', '1814991', 'SyyqHdHOdp', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(48, 'AS', 'Asia', 'CC', 'Cocos [Keeling] Islands', '1547376', '0po54dOrxg', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(49, 'AF', 'Africa', 'KM', 'Comoros', '921929', '3qVu9lDeYY', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(50, 'AF', 'Africa', 'CD', 'Congo', '203312', 'B95wcuOL6N', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(51, 'OC', 'Oceania', 'CK', 'Cook Islands', '1899402', 'AOMTHMqGhX', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(52, 'NA', 'North America', 'CR', 'Costa Rica', '3624060', 'Kls8UqmAw9', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(53, 'EU', 'Europe', 'HR', 'Croatia', '3202326', 'VcPCDWTk6y', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(54, 'NA', 'North America', 'CU', 'Cuba', '3562981', 'Lk6dvYpSex', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(55, 'NA', 'North America', 'CW', 'Curaçao', '7626836', 'tIV2GuM4IA', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(56, 'EU', 'Europe', 'CY', 'Cyprus', '146669', 'J2duJva9tJ', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(57, 'EU', 'Europe', 'CZ', 'Czech Republic', '3077311', 'lWI6hElLjm', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(58, 'EU', 'Europe', 'DK', 'Denmark', '2623032', 'CW7GhayGtf', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(59, 'AF', 'Africa', 'DJ', 'Djibouti', '223816', 'AcicwYFXpE', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(60, 'NA', 'North America', 'DM', 'Dominica', '3575830', '3yUKLEl26j', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(61, 'NA', 'North America', 'DO', 'Dominican Republic', '3508796', 'avYg40jLGl', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(62, 'OC', 'Oceania', 'TL', 'East Timor', '1966436', 'RdOPClKEZO', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(63, 'SA', 'South America', 'EC', 'Ecuador', '3658394', '15yB0lMVfa', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(64, 'AF', 'Africa', 'EG', 'Egypt', '357994', 'BAqRuVCdvC', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(65, 'NA', 'North America', 'SV', 'El Salvador', '3585968', 'TmrO5oTbPC', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(66, 'AF', 'Africa', 'GQ', 'Equatorial Guinea', '2309096', 'KwWOyIj4AH', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(67, 'AF', 'Africa', 'ER', 'Eritrea', '338010', 'AjVY7xpkfQ', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(68, 'EU', 'Europe', 'ES', 'España', '2510769', 'knFvmmalLB', 1, '2015-03-02 10:36:59', '2014-10-13 15:47:39'),
	(69, 'EU', 'Europe', 'EE', 'Estonia', '453733', 'YPFvrooiK1', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(70, 'AF', 'Africa', 'ET', 'Ethiopia', '337996', 'bwoqfjbv68', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(71, 'SA', 'South America', 'FK', 'Falkland Islands', '3474414', 'QEc44KjEPj', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(72, 'EU', 'Europe', 'FO', 'Faroe Islands', '2622320', '0IZOgwJaMX', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(73, 'OC', 'Oceania', 'FM', 'Federated States of Micronesia', '2081918', 'Ta4AqXKXUi', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(74, 'OC', 'Oceania', 'FJ', 'Fiji', '2205218', 'NNZnm8qVka', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(75, 'EU', 'Europe', 'FI', 'Finland', '660013', '2b8MsKXmOF', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(76, 'EU', 'Europe', 'FR', 'France', '3017382', 'b1k4v2wPAM', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(77, 'SA', 'South America', 'GF', 'French Guiana', '3381670', 'rBVBwOSwEj', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(78, 'OC', 'Oceania', 'PF', 'French Polynesia', '4030656', '3TvtU0GPNl', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(79, 'AN', 'Antarctica', 'TF', 'French Southern Territories', '1546748', 'OolDcuc7gP', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(80, 'AF', 'Africa', 'GA', 'Gabon', '2400553', '71LOD8t9mk', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(81, 'AF', 'Africa', 'GM', 'Gambia', '2413451', 'yisoZRz4XR', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(82, 'AS', 'Asia', 'GE', 'Georgia', '614540', 'AR90HYirHf', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(83, 'EU', 'Europe', 'DE', 'Germany', '2921044', 'xB7rBaGP4p', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(84, 'AF', 'Africa', 'GH', 'Ghana', '2300660', 'YZIZokwREV', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(85, 'EU', 'Europe', 'GI', 'Gibraltar', '2411586', 'i2wn6kuvRU', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(86, 'EU', 'Europe', 'GR', 'Greece', '390903', 'pNlysiOUg3', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(87, 'NA', 'North America', 'GL', 'Greenland', '3425505', 'W3a1ly7AKs', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(88, 'NA', 'North America', 'GD', 'Grenada', '3580239', 'Wtyctv057b', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(89, 'NA', 'North America', 'GP', 'Guadeloupe', '3579143', 'MygKbJZt4H', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(90, 'OC', 'Oceania', 'GU', 'Guam', '4043988', 'ZXDtZaIwxo', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(91, 'NA', 'North America', 'GT', 'Guatemala', '3595528', 'RS6UFUBvzE', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(92, 'EU', 'Europe', 'GG', 'Guernsey', '3042362', 'sboBh2gNvQ', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(93, 'AF', 'Africa', 'GN', 'Guinea', '2420477', 'tGNXRDVVA4', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(94, 'AF', 'Africa', 'GW', 'Guinea-Bissau', '2372248', 'ZQSgruzdTa', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(95, 'SA', 'South America', 'GY', 'Guyana', '3378535', 'J11v1lcTaA', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(96, 'NA', 'North America', 'HT', 'Haiti', '3723988', 'glhRWP41zZ', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(97, 'AS', 'Asia', 'JO', 'Hashemite Kingdom of Jordan', '248816', 'gFDvXJTX9q', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(98, 'NA', 'North America', 'HN', 'Honduras', '3608932', 'hrTLHduenZ', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(99, 'AS', 'Asia', 'HK', 'Hong Kong', '1819730', 'MswrC1LvzH', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(100, 'EU', 'Europe', 'HU', 'Hungary', '719819', 'Qyu1GMH3JD', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(101, 'EU', 'Europe', 'IS', 'Iceland', '2629691', 'FkMcPr8NkN', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(102, 'AS', 'Asia', 'IN', 'India', '1269750', 'xe22a7uTcn', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(103, 'AS', 'Asia', 'ID', 'Indonesia', '1643084', 'baL0g9ceOH', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(104, 'AS', 'Asia', 'IR', 'Iran', '130758', '5wgmpowcpO', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(105, 'AS', 'Asia', 'IQ', 'Iraq', '99237', 'y9mkovRrr3', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(106, 'EU', 'Europe', 'IE', 'Ireland', '2963597', 'u8e49Q6lSz', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(107, 'EU', 'Europe', 'IM', 'Isle of Man', '3042225', '4XFBYbkF7K', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(108, 'AS', 'Asia', 'IL', 'Israel', '294640', 't5ikfQHRYK', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(109, 'EU', 'Europe', 'IT', 'Italy', '3175395', 'KXf2QTdai0', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(110, 'AF', 'Africa', 'CI', 'Ivory Coast', '2287781', 'zne9nvIAOs', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(111, 'NA', 'North America', 'JM', 'Jamaica', '3489940', 'KKoA1XG2W4', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(112, 'AS', 'Asia', 'JP', 'Japan', '1861060', '6EsH80TlWD', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(113, 'EU', 'Europe', 'JE', 'Jersey', '3042142', 'a2dJh3UZU5', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(114, 'AS', 'Asia', 'KZ', 'Kazakhstan', '1522867', 'vz8kNlFtdq', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(115, 'AF', 'Africa', 'KE', 'Kenya', '192950', 'hQMstImsZS', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(116, 'OC', 'Oceania', 'KI', 'Kiribati', '4030945', '1UfmIfq9dl', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(117, 'EU', 'Europe', 'XK', 'Kosovo', '831053', 'QtOKVuO2oN', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(118, 'AS', 'Asia', 'KW', 'Kuwait', '285570', 'oGtph3bkju', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(119, 'AS', 'Asia', 'KG', 'Kyrgyzstan', '1527747', 'natTj5EETL', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(120, 'AS', 'Asia', 'LA', 'Laos', '1655842', 'VUWl89Pzr7', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(121, 'EU', 'Europe', 'LV', 'Latvia', '458258', 'DBRWud2Nuk', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(122, 'AS', 'Asia', 'LB', 'Lebanon', '272103', 'qlG5JmZSGA', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(123, 'AF', 'Africa', 'LS', 'Lesotho', '932692', '2P84urV4mJ', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(124, 'AF', 'Africa', 'LR', 'Liberia', '2275384', 'AoMC5X09Gr', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(125, 'AF', 'Africa', 'LY', 'Libya', '2215636', 'j3ndG6d6gn', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(126, 'EU', 'Europe', 'LI', 'Liechtenstein', '3042058', '0hXzbaF2HR', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(127, 'EU', 'Europe', 'LT', 'Lithuania', '597427', 'twYcioSQub', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(128, 'EU', 'Europe', 'LU', 'Luxembourg', '2960313', 'kqyJ2TB3zk', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(129, 'AS', 'Asia', 'MO', 'Macao', '1821275', 'Zz5KDlkfYu', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(130, 'EU', 'Europe', 'MK', 'Macedonia', '718075', 'g5O1yafEvJ', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(131, 'AF', 'Africa', 'MG', 'Madagascar', '1062947', 'yRXFsCN1C0', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(132, 'AF', 'Africa', 'MW', 'Malawi', '927384', 'zJQUuitLhE', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(133, 'AS', 'Asia', 'MY', 'Malaysia', '1733045', 'QCni0Pfg7o', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(134, 'AS', 'Asia', 'MV', 'Maldives', '1282028', 'sX4vDPiRbk', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(135, 'AF', 'Africa', 'ML', 'Mali', '2453866', 'h6aZVE5IUU', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(136, 'EU', 'Europe', 'MT', 'Malta', '2562770', 'SuArTpaHt0', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(137, 'OC', 'Oceania', 'MH', 'Marshall Islands', '2080185', 'DSSGqGp3fE', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(138, 'NA', 'North America', 'MQ', 'Martinique', '3570311', 'ckg4gwcIrL', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(139, 'AF', 'Africa', 'MR', 'Mauritania', '2378080', 'yLLZEElOBg', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(140, 'AF', 'Africa', 'MU', 'Mauritius', '934292', 'n7ExN0SoVE', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(141, 'AF', 'Africa', 'YT', 'Mayotte', '1024031', 'fCNg85kK4H', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(142, 'NA', 'North America', 'MX', 'Mexico', '3996063', '7dLiEyIAez', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(143, 'EU', 'Europe', 'MC', 'Monaco', '2993457', 'V1xI5D3np2', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(144, 'AS', 'Asia', 'MN', 'Mongolia', '2029969', 'JA4lllEOpS', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(145, 'EU', 'Europe', 'ME', 'Montenegro', '3194884', 'FPj1BEL8QU', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(146, 'NA', 'North America', 'MS', 'Montserrat', '3578097', 'l1vhNK7hOO', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(147, 'AF', 'Africa', 'MA', 'Morocco', '2542007', 'NqXfz79fzR', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(148, 'AF', 'Africa', 'MZ', 'Mozambique', '1036973', 'zUi7StBGDg', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(149, 'AS', 'Asia', 'MM', 'Myanmar [Burma]', '1327865', 'kEjNjdYEgU', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(150, 'AF', 'Africa', 'NA', 'Namibia', '3355338', '4nh0UhL6gW', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(151, 'OC', 'Oceania', 'NR', 'Nauru', '2110425', 'raQpvZVYTC', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(152, 'AS', 'Asia', 'NP', 'Nepal', '1282988', 'DRYHWr5b4B', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(153, 'EU', 'Europe', 'NL', 'Netherlands', '2750405', '94EQ5RHFk6', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(154, 'OC', 'Oceania', 'NC', 'New Caledonia', '2139685', 'hP7ruoOE1r', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(155, 'OC', 'Oceania', 'NZ', 'New Zealand', '2186224', 'M44nrqvvFj', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(156, 'NA', 'North America', 'NI', 'Nicaragua', '3617476', 'aqWCCVWMVm', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(157, 'AF', 'Africa', 'NE', 'Niger', '2440476', 'oG0IxxhS6J', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(158, 'AF', 'Africa', 'NG', 'Nigeria', '2328926', 'NVyDGqNx7P', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(159, 'OC', 'Oceania', 'NU', 'Niue', '4036232', 'LyqtTZid56', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(160, 'OC', 'Oceania', 'NF', 'Norfolk Island', '2155115', 'iV5WTmvEog', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(161, 'AS', 'Asia', 'KP', 'North Korea', '1873107', 'rqHJTzD1ZB', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(162, 'OC', 'Oceania', 'MP', 'Northern Mariana Islands', '4041468', 'm9m2rU9PKq', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(163, 'EU', 'Europe', 'NO', 'Norway', '3144096', 'XLzqr2tC6s', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(164, 'AS', 'Asia', 'OM', 'Oman', '286963', 'Ulfff9lwnJ', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(165, 'AS', 'Asia', 'PK', 'Pakistan', '1168579', 'MnHs9E7d9B', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(166, 'OC', 'Oceania', 'PW', 'Palau', '1559582', 'CdJ9FaCM6G', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(167, 'AS', 'Asia', 'PS', 'Palestine', '6254930', 'NxsafcVvPh', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(168, 'NA', 'North America', 'PA', 'Panama', '3703430', 'ZZtrDs3VF1', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(169, 'OC', 'Oceania', 'PG', 'Papua New Guinea', '2088628', 'eY4JNNEhYc', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(170, 'SA', 'South America', 'PY', 'Paraguay', '3437598', 'rs0aJoT0jl', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(171, 'SA', 'South America', 'PE', 'Peru', '3932488', 'xdx0UxCsv4', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(172, 'AS', 'Asia', 'PH', 'Philippines', '1694008', 'HtWt6NFEir', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(173, 'OC', 'Oceania', 'PN', 'Pitcairn Islands', '4030699', 'YWaIuKAd8r', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(174, 'EU', 'Europe', 'PL', 'Poland', '798544', 'K2N82gpPXu', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(175, 'EU', 'Europe', 'PT', 'Portugal', '2264397', '0hR4ttiYNQ', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(176, 'NA', 'North America', 'PR', 'Puerto Rico', '4566966', 'bXjvp41Xxt', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(177, 'AS', 'Asia', 'QA', 'Qatar', '289688', 'dgN2C8CE0i', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(178, 'AS', 'Asia', 'KR', 'Republic of Korea', '1835841', 'fi2nz1927R', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(179, 'EU', 'Europe', 'MD', 'Republic of Moldova', '617790', 'W4btk3r9r1', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(180, 'AF', 'Africa', 'CG', 'Republic of the Congo', '2260494', 'UnCSpW8PLK', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(181, 'AF', 'Africa', 'RE', 'Réunion', '935317', '7hahMjaQHa', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(182, 'EU', 'Europe', 'RO', 'Romania', '798549', 'sBJcBDNPy5', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(183, 'EU', 'Europe', 'RU', 'Russia', '2017370', 'kAHurlku1C', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(184, 'AF', 'Africa', 'RW', 'Rwanda', '49518', 'XXIENWED44', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(185, 'AF', 'Africa', 'SH', 'Saint Helena', '3370751', 'KZaeadqzbu', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(186, 'NA', 'North America', 'KN', 'Saint Kitts and Nevis', '3575174', 'MMlIUAnZHz', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(187, 'NA', 'North America', 'LC', 'Saint Lucia', '3576468', 'uCjISmwzN3', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(188, 'NA', 'North America', 'MF', 'Saint Martin', '3578421', 'biJ6XJxPV0', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(189, 'NA', 'North America', 'PM', 'Saint Pierre and Miquelon', '3424932', '1QqVL8Gq88', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(190, 'NA', 'North America', 'VC', 'Saint Vincent and the Grenadines', '3577815', 'eMfHeeRQxw', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(191, 'NA', 'North America', 'BL', 'Saint-Barthélemy', '3578476', 'bqqP5euidD', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(192, 'OC', 'Oceania', 'WS', 'Samoa', '4034894', 'ntyaR6Yl4Z', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(193, 'EU', 'Europe', 'SM', 'San Marino', '3168068', 'bmI83mQDZC', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(194, 'AF', 'Africa', 'ST', 'São Tomé and Príncipe', '2410758', 'hvvSytyajg', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(195, 'AS', 'Asia', 'SA', 'Saudi Arabia', '102358', 'WfYNcFDCFk', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(196, 'AF', 'Africa', 'SN', 'Senegal', '2245662', 'ZWmGpGCMcm', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(197, 'EU', 'Europe', 'RS', 'Serbia', '6290252', 'giY5UjSLak', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(198, 'AF', 'Africa', 'SC', 'Seychelles', '241170', '3at6epjGX0', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(199, 'AF', 'Africa', 'SL', 'Sierra Leone', '2403846', '8c4yFxENTu', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(200, 'AS', 'Asia', 'SG', 'Singapore', '1880251', 'nG0pGrONe5', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(201, 'NA', 'North America', 'SX', 'Sint Maarten', '7609695', 'ASVjmoU9xy', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(202, 'EU', 'Europe', 'SK', 'Slovakia', '3057568', 'FkxrnkDzkp', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(203, 'EU', 'Europe', 'SI', 'Slovenia', '3190538', 'p4yhgqX7vc', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(204, 'OC', 'Oceania', 'SB', 'Solomon Islands', '2103350', '4zYIYKSfSE', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(205, 'AF', 'Africa', 'SO', 'Somalia', '51537', 'BuRvnsM9qa', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(206, 'AF', 'Africa', 'ZA', 'South Africa', '953987', 'zAewN9ZGgf', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(207, 'AN', 'Antarctica', 'GS', 'South Georgia and the South Sandwich Islands', '3474415', 'zsrjsUAAPO', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(208, 'AF', 'Africa', 'SS', 'South Sudan', '7909807', '4gq0DikbvG', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(209, 'AS', 'Asia', 'LK', 'Sri Lanka', '1227603', 'fJNjSVFW3K', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(210, 'AF', 'Africa', 'SD', 'Sudan', '366755', 'NSyDY3uUKC', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(211, 'SA', 'South America', 'SR', 'Suriname', '3382998', 'hbSOXxgcVi', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(212, 'EU', 'Europe', 'SJ', 'Svalbard and Jan Mayen', '607072', 'jJOLcwxPGk', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(213, 'AF', 'Africa', 'SZ', 'Swaziland', '934841', 'j4fCPR2giR', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(214, 'EU', 'Europe', 'SE', 'Sweden', '2661886', 'ArjVyKJrCE', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(215, 'EU', 'Europe', 'CH', 'Switzerland', '2658434', 'YUs19bE7uF', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(216, 'AS', 'Asia', 'SY', 'Syria', '163843', 'lXy59FRaB9', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(217, 'AS', 'Asia', 'TW', 'Taiwan', '1668284', 'hiCYzN9mde', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(218, 'AS', 'Asia', 'TJ', 'Tajikistan', '1220409', 'je9NiYunOr', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(219, 'AF', 'Africa', 'TZ', 'Tanzania', '149590', 'wqYE559FGR', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(220, 'AS', 'Asia', 'TH', 'Thailand', '1605651', 'WfZ3dxtffB', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(221, 'AF', 'Africa', 'TG', 'Togo', '2363686', 'fMmnIvoewm', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(222, 'OC', 'Oceania', 'TK', 'Tokelau', '4031074', '2mjt3Bx3w6', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(223, 'OC', 'Oceania', 'TO', 'Tonga', '4032283', '1XibAX9N92', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(224, 'NA', 'North America', 'TT', 'Trinidad and Tobago', '3573591', 'IY8bf9z8T6', 1, '2014-10-13 15:47:45', '2014-10-13 15:47:45'),
	(225, 'AF', 'Africa', 'TN', 'Tunisia', '2464461', 'Jb9KY4vLT0', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(226, 'AS', 'Asia', 'TR', 'Turkey', '298795', 'NHKJivMLpt', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(227, 'AS', 'Asia', 'TM', 'Turkmenistan', '1218197', '68xsCVqvJr', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(228, 'NA', 'North America', 'TC', 'Turks and Caicos Islands', '3576916', 'r2NHpCkWQl', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(229, 'OC', 'Oceania', 'TV', 'Tuvalu', '2110297', 'Wfoii1GI0K', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(230, 'OC', 'Oceania', 'UM', 'U.S. Minor Outlying Islands', '5854968', 'gOkbZXqt2j', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(231, 'NA', 'North America', 'VI', 'U.S. Virgin Islands', '4796775', '2WpwAashn7', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(232, 'AF', 'Africa', 'UG', 'Uganda', '226074', '6Epe4JNdDf', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(233, 'EU', 'Europe', 'UA', 'Ukraine', '690791', 'peiubWjCJv', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(234, 'AS', 'Asia', 'AE', 'United Arab Emirates', '290557', 'Bx4Z00pgn9', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(235, 'EU', 'Europe', 'GB', 'United Kingdom', '2635167', 'C7WBGq5wJ5', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(236, 'NA', 'North America', 'US', 'United States', '6252001', 'wzOf8EbUHB', 1, '2014-10-13 15:47:40', '2014-10-13 15:47:40'),
	(237, 'SA', 'South America', 'UY', 'Uruguay', '3439705', 'isVyrvE5G2', 1, '2014-10-13 15:47:43', '2014-10-13 15:47:43'),
	(238, 'AS', 'Asia', 'UZ', 'Uzbekistan', '1512440', 'WAzutSV4gR', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(239, 'OC', 'Oceania', 'VU', 'Vanuatu', '2134431', 'HbWp6zS7lU', 1, '2014-10-13 15:47:44', '2014-10-13 15:47:44'),
	(240, 'EU', 'Europe', 'VA', 'Vatican City', '3164670', 'OOXzRuPUUh', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(241, 'SA', 'South America', 'VE', 'Venezuela', '3625428', 'VOpLhskmGV', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(242, 'AS', 'Asia', 'VN', 'Vietnam', '1562822', 'EBMXNV34GH', 1, '2014-10-13 15:47:39', '2014-10-13 15:47:39'),
	(243, 'OC', 'Oceania', 'WF', 'Wallis and Futuna', '4034749', 'x7UmIcJQIB', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(244, 'AS', 'Asia', 'YE', 'Yemen', '69543', 'zihnxoSjow', 1, '2014-10-13 15:47:41', '2014-10-13 15:47:41'),
	(245, 'AF', 'Africa', 'ZM', 'Zambia', '895949', 'Y8IXjCYtvy', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42'),
	(246, 'AF', 'Africa', 'ZW', 'Zimbabwe', '878675', '2Wj8pWInvL', 1, '2014-10-13 15:47:42', '2014-10-13 15:47:42');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `ESTEstado` int(11) NOT NULL,
  `ESTDescripcion` varchar(50) NOT NULL,
  `ESTVisible` int(11) DEFAULT NULL,
  `ESTColor` varchar(50) DEFAULT NULL,
  `ESTIcon` varchar(50) DEFAULT NULL,
  `ESTTipificar` int(11) DEFAULT NULL,
  PRIMARY KEY (`ESTEstado`) USING BTREE,
  KEY `ESTDescripcion` (`ESTEstado`,`ESTDescripcion`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='estado de cualquier tupla de la base de dato: 1 Activo, 0 In';

-- Volcando datos para la tabla invercafe-db.estado: ~0 rows (aproximadamente)
DELETE FROM `estado`;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;

-- Volcando estructura para función invercafe-db.get_opciones
DELIMITER //
CREATE FUNCTION `get_opciones`(
	`arrRangos` VARCHAR(200)
) RETURNS varchar(2000) CHARSET utf8
BEGIN
	DECLARE IdRango, contRango INTEGER;	
	DECLARE RangosRow, DescRango VARCHAR(2000);
	DECLARE done BOOLEAN DEFAULT FALSE;
	
	DECLARE c1 CURSOR FOR SELECT OPCId, OPCNombre from opciones where FIND_IN_SET(OPCId,REPLACE(REPLACE(REPLACE(arrRangos,'[',''),']',''),'"',''));
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;						
	
	SET RangosRow = '';
	SET contRango = 0;
	OPEN c1;
		c1_loop: LOOP
		fetch c1 into IdRango, DescRango;
			IF done THEN
				LEAVE c1_loop;
			ELSE
				begin
					if (contRango=0) then
						set RangosRow = DescRango;
					else
						set RangosRow = concat(RangosRow,'|',DescRango);
					end if;
					set contRango = contRango+1;
				end;
			END IF; 
		END LOOP c1_loop;
	CLOSE c1;	

	RETURN RangosRow;
END//
DELIMITER ;

-- Volcando estructura para tabla invercafe-db.opciones
CREATE TABLE IF NOT EXISTS `opciones` (
  `OPCId` int(11) NOT NULL AUTO_INCREMENT,
  `TOPId` int(11) DEFAULT NULL,
  `OPCNombre` varchar(300) DEFAULT NULL,
  `OPCHijo` varchar(50) DEFAULT NULL,
  `OPEstado` int(11) DEFAULT NULL,
  PRIMARY KEY (`OPCId`),
  KEY `FK_opciones_tipoopcion` (`TOPId`),
  CONSTRAINT `FK_opciones_tipoopcion` FOREIGN KEY (`TOPId`) REFERENCES `tipoopcion` (`TOPId`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.opciones: ~70 rows (aproximadamente)
DELETE FROM `opciones`;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` (`OPCId`, `TOPId`, `OPCNombre`, `OPCHijo`, `OPEstado`) VALUES
	(1, 1, 'Ep-10%', '[1,3]', 1),
	(2, 1, 'UGQ', '[1,3]', 1),
	(3, 1, 'Supremo malla 18', '[1,3]', 1),
	(4, 1, 'Supremo malla 17/18', '[1,3]', 1),
	(5, 1, 'Supremo malla 19', '[1,3]', 1),
	(6, 1, 'EP 10% Starbucks AB3', '[1,3]', 1),
	(7, 1, 'Pasilla', '[1,3]', 1),
	(8, 1, 'Excelso fuera de normas', '[1,3]', 1),
	(9, 1, 'Especial', '[2]', 1),
	(10, 2, '-', NULL, 1),
	(11, 2, 'H-march', NULL, 1),
	(12, 2, 'K-may', NULL, 1),
	(13, 2, 'N-july', NULL, 1),
	(14, 2, 'U-sept', NULL, 1),
	(15, 3, 'BUN', NULL, 1),
	(16, 3, 'CAR', NULL, 1),
	(17, 4, 'Rainforest', NULL, 1),
	(18, 4, 'Fair Trade', NULL, 1),
	(19, 4, 'Organic USDA', NULL, 1),
	(20, 4, 'Organic Europa', NULL, 1),
	(21, 4, 'Organic JAS', NULL, 1),
	(22, 4, 'Con Manos de mujer', NULL, 1),
	(23, 4, 'Practices (Starbucks)', NULL, 1),
	(24, 4, 'IGP', NULL, 1),
	(25, 4, 'DO', NULL, 1),
	(26, 4, 'Pico Cristobal', NULL, 1),
	(27, 4, 'Rainforest + Organic USDA', NULL, 1),
	(28, 4, 'Rainforest + Organic Europa', NULL, 1),
	(29, 4, 'Rainforest + Organic JAS', NULL, 1),
	(30, 4, 'Fair Trade + Organic USDA', NULL, 1),
	(31, 4, 'Fair Trade + Organic Europa', NULL, 1),
	(32, 4, 'Fair Trade + Organic JAS', NULL, 1),
	(33, 4, 'Con Manos de mujer + Rainforest', NULL, 1),
	(34, 4, 'Con Manos de mujer + Fair Trade', NULL, 1),
	(35, 4, 'Con Manos de mujer + Rainforest + Fair Trade', NULL, 1),
	(36, 6, '1st half', NULL, 1),
	(37, 6, '2nd half', NULL, 1),
	(38, 6, 'Full', NULL, 1),
	(39, 5, 'Jan', '11', 1),
	(40, 5, 'Feb', '11', 1),
	(41, 5, 'Mar', '12', 1),
	(42, 5, 'Apr', '12', 1),
	(43, 5, 'May', '13', 1),
	(44, 5, 'Jun', '13', 1),
	(45, 5, 'Jul', '14', 1),
	(46, 5, 'Aug', '14', 1),
	(47, 5, 'Sep', '51', 1),
	(48, 5, 'Oct', '51', 1),
	(49, 5, 'Nov', '51', 1),
	(50, 5, 'Dec', '11', 1),
	(51, 2, 'Z-dec', NULL, 1),
	(52, 7, '70 kg', '66', 1),
	(53, 7, '35 kg', '65', 1),
	(54, 7, '24 kg', '68', 1),
	(55, 7, '1000 kg', '67,75', 1),
	(56, 7, '21000 kg', '69', 1),
	(57, 8, '#6', NULL, 1),
	(58, 8, '#7', NULL, 1),
	(59, 8, '#8', NULL, 1),
	(60, 8, '#9', NULL, 1),
	(61, 8, '#10', NULL, 1),
	(62, 8, '24 kg box', NULL, 1),
	(63, 8, 'Big bag 1000 kg', NULL, 1),
	(64, 8, 'Granel', NULL, 1),
	(65, 9, 'Bolsa grainpro/ecotact 35', NULL, 1),
	(66, 9, 'Bolsa grainpro/ecotact 70', NULL, 1),
	(67, 9, 'Big bag', NULL, 1),
	(68, 9, 'Caja 24 Kg', NULL, 1),
	(69, 9, 'Granel', NULL, 1),
	(70, 10, 'ASEPROPAZ', NULL, 1),
	(71, 10, 'EL BOMBO', NULL, 1),
	(72, 10, 'UNICHAPARRAL', NULL, 1),
	(73, 10, 'ALIANZACAFE', NULL, 1),
	(74, 10, 'PALMASAN', NULL, 1),
	(75, 9, 'Big bag/pallet', NULL, 1);
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `PERFId` int(11) NOT NULL AUTO_INCREMENT,
  `PERFDescripcion` varchar(100) DEFAULT NULL,
  `PERFEstado` int(11) DEFAULT NULL COMMENT 'Activo, Inactivo, Eliminado',
  PRIMARY KEY (`PERFId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.perfil: ~2 rows (aproximadamente)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`PERFId`, `PERFDescripcion`, `PERFEstado`) VALUES
	(1, 'Admin', 1),
	(2, 'Comex', 1),
	(3, 'Tesoreria', 1);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para procedimiento invercafe-db.sp_broker_modificarEstado
DELIMITER //
CREATE PROCEDURE `sp_broker_modificarEstado`(
	IN `idBro` INT,
	IN `estado` INT
)
BEGIN
	UPDATE broker
	SET BROEstado = estado
	WHERE BROId = idBro;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_broker_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_broker_seleccionar`()
BEGIN
	SELECT b.*, co.country_name
	FROM broker b
	LEFT JOIN countries co ON (b.PAISId=co.PAISId);
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_broker_seleccionarActivos
DELIMITER //
CREATE PROCEDURE `sp_broker_seleccionarActivos`()
BEGIN
	SELECT *
	FROM broker
	WHERE BROEstado=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_cliente_modificarEstado
DELIMITER //
CREATE PROCEDURE `sp_cliente_modificarEstado`(
	IN `idClie` INT,
	IN `estado` INT
)
BEGIN
	UPDATE cliente
	SET CLIEEstado = estado
	WHERE CLIEId = idClie;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_cliente_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_cliente_seleccionar`()
BEGIN
	SELECT c.*, co.country_name
	FROM cliente c
	LEFT JOIN countries co ON (c.PAISId=co.PAISId);
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_cliente_seleccionarActivos
DELIMITER //
CREATE PROCEDURE `sp_cliente_seleccionarActivos`()
BEGIN
	SELECT *
	FROM cliente
	WHERE CLIEEstado=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_config_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_config_seleccionar`()
BEGIN
	SELECT *
	FROM config;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contratodetalle_eliminar
DELIMITER //
CREATE PROCEDURE `sp_contratodetalle_eliminar`(
	IN `idDet` INT
)
BEGIN
	DELETE 
	FROM contratodetalle 
	WHERE DETId=idDet;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contratodetalle_insertar
DELIMITER //
CREATE PROCEDURE `sp_contratodetalle_insertar`(
	IN `IdDet` INT,
	IN `idCont` INT,
	IN `unid` INT,
	IN `kilos` INT,
	IN `calidad` INT,
	IN `descEspecial` VARCHAR(500),
	IN `asociacion` INT,
	IN `certif` INT,
	IN `usdLbs` DECIMAL(10,2),
	IN `tipoPrecio` VARCHAR(10),
	IN `anio` INT,
	IN `mes` INT,
	IN `rango` INT,
	IN `posicion` INT,
	IN `anioPos` INT,
	IN `requerim` INT,
	IN `observac` VARCHAR(2000)
)
BEGIN
	IF (IdDet IS NULL) THEN
		INSERT INTO contratodetalle (CONTId, DETUnidades, DETKilos, DETCalidad, DETDescEspecial, DETAsociacion, DETCertificacion, DETUsdLbs, DETTipoPrecio, DETAnioEmbarque, DETMesEmbarque, DETRangoEmbarque, DETPosicion, DETAnioPosicion, DETRequerimientos, DETObservaciones)
		VALUES (idCont, unid, kilos, calidad, descEspecial, asociacion, certif, usdLbs, tipoPrecio, anio, mes, rango, posicion, anioPos, requerim, observac);
	ELSE 
		UPDATE contratodetalle
		SET CONTId=idCont, DETUnidades=unid, DETKilos=kilos, DETCalidad=calidad, DETDescEspecial=descEspecial, DETAsociacion=asociacion, DETCertificacion=certif,
			DETUsdLbs=usdLbs, DETTipoPrecio=tipoPrecio, DETAnioEmbarque=anio, DETMesEmbarque=mes, DETRangoEmbarque=rango, DETPosicion=posicion, DETAnioPosicion=anioPos, DETRequerimientos=requerim, DETObservaciones=observac
		WHERE DETId=IdDet;
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contratodetalle_seleccionarXid
DELIMITER //
CREATE PROCEDURE `sp_contratodetalle_seleccionarXid`(
	IN `idContr` INT
)
BEGIN
	SELECT cd.*, get_opciones(DETKilos) AS Kilos, get_opciones(DETCalidad) AS Calidad, get_opciones(DETAsociacion) AS Asociacion, get_opciones(DETCertificacion) AS Certificacion, get_opciones(DETMesEmbarque) AS MesEmbarque, get_opciones(DETRangoEmbarque) AS RangoEmbarque, get_opciones(DETPosicion) AS Posicion, get_opciones(DETRequerimientos) AS Requerimientos
	FROM contratodetalle cd
	WHERE CONTId=idContr;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contrato_actualizarXid
DELIMITER //
CREATE PROCEDURE `sp_contrato_actualizarXid`(
	IN `idCont` INT,
	IN `idUsr` INT,
	IN `idClie` INT,
	IN `idBrok` INT,
	IN `refCliente` VARCHAR(100),
	IN `idTipoCon` INT,
	IN `cantUnidades` INT,
	IN `lotEmbarque` INT,
	IN `lotBolsa` INT,
	IN `idEst` INT
)
BEGIN
	/*Si no existe tupla, hago la insercion, de lo contrario la actualizacion*/
	IF (idCont IS NULL) THEN
		INSERT INTO contrato (CLIEId, BROId, CONTRefBuyer, TCONId, CONTotalUnidades, CONTLotesEmbarque, CONTLotesBolsa, USRId, CONTEstado)
		VALUES (idClie, idBrok, refCliente, idTipoCon, cantUnidades, lotEmbarque, lotBolsa, idUsr, idEst);
		
		SET @CONTId = LAST_INSERT_ID();
	ELSE 
		UPDATE contrato 
		SET CLIEId=idClie, BROId=idBrok, CONTRefBuyer=refCliente, CONTotalUnidades=cantUnidades, CONTLotesEmbarque=lotEmbarque, CONTLotesBolsa=lotBolsa, TCONId=idTipoCon, USRId=idUsr
		WHERE CONTId=idCont;

		SET @CONTId = idCont;
	END IF;
	
	SELECT @CONTId AS idContrato;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contrato_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_contrato_seleccionar`()
BEGIN
	SELECT c.CONTId, CONTRefBuyer, c.CLIEId, c.USRId, c.BROId, tc.TCONNombre AS Modalidad, CantUnidades, EQKilos, CantLotesEmbarcar, 
		if(c.TCONId = 1, CONTLotesBolsa, NULL) AS CONTLotesBolsa, 
		CASE c.TCONId
			WHEN 1 then (CantLotesEmbarcar + CONTLotesBolsa)
			WHEN 2 then NULL
			WHEN 3 then 1
		END AS CantLotesFijar, 		
		CONTEstado, c.createdAt, c.updatedAt, cl.CLIENombre, br.BRONombre, u.Name, u.LastName
	FROM contrato c
	INNER JOIN cliente cl ON (cl.CLIEId=c.CLIEId)
	INNER JOIN tipocontrato tc ON (tc.TCONId=c.TCONId)
	LEFT JOIN usuario u ON (u.USRId=c.USRId)
	LEFT JOIN broker br ON (br.BROId=c.BROId)
	INNER JOIN (
		SELECT CONTId, COUNT(1) AS CantLotesEmbarcar, SUM(DETUnidades) AS CantUnidades, SUM(REPLACE(op.OPCNombre, " kg", "")*DETUnidades) AS EQKilos
		FROM contratodetalle cd
		INNER JOIN opciones op ON (op.OPCId=cd.DETKilos)
		WHERE DETKilos IS NOT NULL
		GROUP BY CONTId
	) a ON (a.CONTId=c.CONTId);
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_contrato_seleccionarXid
DELIMITER //
CREATE PROCEDURE `sp_contrato_seleccionarXid`(
	IN `idContr` INT
)
BEGIN
	SELECT * 
	FROM contrato 
	WHERE CONTId=idContr;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_countries_seleccionarActivos
DELIMITER //
CREATE PROCEDURE `sp_countries_seleccionarActivos`()
BEGIN
	select *
	from countries
	WHERE PAISEstado=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_estado_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_estado_seleccionar`()
BEGIN
	SELECT * FROM estado;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_estado_seleccionarTipificar
DELIMITER //
CREATE PROCEDURE `sp_estado_seleccionarTipificar`()
BEGIN
	SELECT * FROM estado WHERE ESTTipificar=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_estado_seleccionarXsemana
DELIMITER //
CREATE PROCEDURE `sp_estado_seleccionarXsemana`(
	IN `ipsId` INT,
	IN `fecha` VARCHAR(50)
)
BEGIN
	SELECT *, getArrayEstadoCantidad(ipsId, ESTEstado, fecha) AS ARRAYCantidad
	FROM estado;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_opciones_seleccionarXhijos
DELIMITER //
CREATE PROCEDURE `sp_opciones_seleccionarXhijos`(
	IN `tipo` INT,
	IN `idHijo` VARCHAR(50)
)
BEGIN
	SELECT * 
	FROM opciones o
	WHERE o.TOPId=tipo AND JSON_CONTAINS(o.OPCHijo,idHijo,'$') AND OPEstado=1
	ORDER BY o.OPCNombre;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_opciones_seleccionarXtipo
DELIMITER //
CREATE PROCEDURE `sp_opciones_seleccionarXtipo`(
	IN `tipo` INT
)
BEGIN
	SELECT * 
	FROM opciones
	WHERE TOPId=tipo AND OPEstado=1
	ORDER BY OPCNombre;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_perfil_seleccionarActivos
DELIMITER //
CREATE PROCEDURE `sp_perfil_seleccionarActivos`()
BEGIN
	select *
	from perfil
	where PERFEstado=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_seleccionarFechaActual
DELIMITER //
CREATE PROCEDURE `sp_seleccionarFechaActual`()
BEGIN
	SELECT CURRENT_TIMESTAMP() fechaHoraActual;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_tipocontrato_seleccionarActivos
DELIMITER //
CREATE PROCEDURE `sp_tipocontrato_seleccionarActivos`()
BEGIN
	SELECT * FROM tipocontrato WHERE TCONEstado=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_actualizarXid
DELIMITER //
CREATE PROCEDURE `sp_usuario_actualizarXid`(
	IN `idUsr` INT,
	IN `idPerf` INT,
	IN `nameUsr` VARCHAR(50),
	IN `pwd` VARCHAR(50),
	IN `mail` VARCHAR(50),
	IN `nameComplete` VARCHAR(80),
	IN `lastname` VARCHAR(80),
	IN `estado` INT
)
BEGIN
	SET @USRId = NULL;
	
	SELECT USRId INTO @USRId
	FROM usuario
	WHERE UserName=nameUsr;
	
	IF (Pwd IS NULL) THEN
		SET @CampoPasswdIns = '';
		SET @CampoPasswdEdit = '';
		SET @Passwd = '';
	ELSE
		SET @CampoPasswdIns = 'Password, ';
		SET @CampoPasswdEdit = ', Password=';
		SET @Passwd = CONCAT('MD5(CONCAT("',Pwd, '", "_F!u^gPU5`1A`}gH`34]~(NT<")), ');
	END IF;
	
	/*Si no existe tupla, hago la insercion, de lo contrario la actualizacion*/
	IF (@USRId IS NULL) THEN
		SET @Query = CONCAT('INSERT INTO usuario (PERFId, UserName, LastName, Name, Email, ',@CampoPasswdIns,'USREstado)
			VALUES (',idPerf,', "',nameUsr,'", "',lastname,'", "',nameComplete,'", "',mail,'", ',@Passwd,estado,')');
	ELSE 
		SET @Query = CONCAT('UPDATE usuario 
			SET PERFId=',idPerf, ', UserName="',nameUsr, '", LastName="',lastname,'", Name="',nameComplete, '", 
			Email="',mail,'"',@CampoPasswdEdit,@Passwd,', USREstado=',estado,
			' WHERE USRId=',idUsr);
	END IF;
	-- SELECT @QUERY;
	PREPARE smpt FROM @Query;
	-- ejecutamos el Statement
	EXECUTE smpt;
	-- liberamos la memoria
	DEALLOCATE PREPARE smpt;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_compararContrasena
DELIMITER //
CREATE PROCEDURE `sp_usuario_compararContrasena`(
	IN `idUsr` INT,
	IN `PassWd` VARCHAR(50)
)
BEGIN
	SET @idUsuario=NULL;
	SELECT u.USRId INTO @idUsuario
	FROM usuario u
	WHERE USRId = idUsr AND Password=MD5(CONCAT(PassWd, '_F!u^gPU5`1A`}gH`34]~(NT<'));
	
	IF (@idUsuario IS NULL) THEN
		SELECT -1 AS USRId, 'Lo siento. La contraseña actual digitada, no es correcta.' AS Mensaje;
	ELSE
		SELECT @idUsuario AS USRId, 'Se ha modificado su contraseña exitosamente. Puede proceder a cerrar sesión e ingresar con su nueva contraseña.' AS Mensaje;
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_modificarContrasena
DELIMITER //
CREATE PROCEDURE `sp_usuario_modificarContrasena`(
	IN `PassWd` VARCHAR(50),
	IN `UId` INT
)
BEGIN
	SET @strPwd = '_F!u^gPU5`1A`}gH`34]~(NT<';

	UPDATE usuario u
	SET u.Password = MD5(CONCAT(PassWd, @strPwd))
	WHERE u.USRId = UId;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_modificarCredenciales
DELIMITER //
CREATE PROCEDURE `sp_usuario_modificarCredenciales`(
	IN `idUsr` INT,
	IN `uname` VARCHAR(50),
	IN `mail` VARCHAR(50)
)
BEGIN
	UPDATE usuario u
	SET u.UserName = uname, u.Email=mail
	WHERE u.USRId = idUsr;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_modificarEstado
DELIMITER //
CREATE PROCEDURE `sp_usuario_modificarEstado`(
	IN `iUsr` INT,
	IN `estado` INT
)
BEGIN
	UPDATE usuario u
	SET u.USREstado = estado
	WHERE u.USRId = iUsr;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_seleccionar
DELIMITER //
CREATE PROCEDURE `sp_usuario_seleccionar`()
BEGIN
	SELECT u.*, p.PERFDescripcion
	FROM usuario u
	INNER JOIN perfil p ON (p.PERFId=u.PERFId);
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_seleccionarEmail
DELIMITER //
CREATE PROCEDURE `sp_usuario_seleccionarEmail`(
	IN `UserName` VARCHAR(50),
	IN `E_mail` VARCHAR(100)
)
BEGIN
	DECLARE UId varchar(50);
	DECLARE PId int;

	SET UId = NULL;
	SET PId = NULL;
	
	SELECT USRId, PERFId INTO UId, PId
	FROM view_listadousuarios
	WHERE UserName = UserName AND Email = E_mail AND USREstado=1;
	
	/*Contraseña no valida del usuario que existe*/
	IF (UId IS NULL) THEN
		SELECT -1 as USRId, -1 as PERFId, 'Lo siento, el E-Mail ingresado no se encuentra asociado a esta cuenta' as USRMensaje; 
	ELSE
		SELECT UId as USRId, PId as PERFId, 'En este momento se ha enviado un correo electrónico con la información necesaria para el restablecimiento de su contraseña, por favor diríjase a su bandeja de entrada' as USRMensaje; 
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_seleccionarLogin
DELIMITER //
CREATE PROCEDURE `sp_usuario_seleccionarLogin`(
	IN `Uname` varCHAR(50),
	IN `PassWd` varCHAR(50)
)
    COMMENT 'Consulta un Usuario por Nombre de Usuario y contrasena'
BEGIN
	DECLARE UId varchar(50);
	DECLARE PId int;
	DECLARE iPerfil int;
	/* selecciono los nombres de usuario que esten activos con el username enviado */
	SELECT USRId INTO UId
	FROM view_listadousuarios
	WHERE UserName = Uname AND USREstado=1
	LIMIT 1;
	
	IF (UId IS NULL) THEN
		-- USUARIO NO EXISTE
		SELECT -1 as USRId, -1 as RolId, 'Lo siento, Usuario invalido' as USRMensaje;
	ELSE
		SET UId = NULL;
		SET iPerfil = NULL;
		SELECT USRId, PERFId INTO UId, iPerfil
		FROM view_listadousuarios
		WHERE UserName = Uname AND Password = MD5(CONCAT(PassWd, '_F!u^gPU5`1A`}gH`34]~(NT<')) AND USREstado=1;
		/*Contraseña no valida del usuario que existe*/
		IF (UId IS NULL) THEN
			SELECT -2 as USRId, -2 as RolId, 'Lo siento, contraseña incorrecta' as USRMensaje; 
		ELSE
				SELECT UId as USRId, iPerfil as RolId, 'Usuario Válido' as USRMensaje; 
		END IF;
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_usuario_seleccionarXid
DELIMITER //
CREATE PROCEDURE `sp_usuario_seleccionarXid`(
	IN `Pid` INT,
	IN `Uid` INT
)
BEGIN
	SELECT u.*, us.Name, us.LastName
	FROM view_listadousuarios u
	INNER JOIN usuario us ON (u.USRId=us.USRId)
	WHERE u.USRId=Uid AND u.PERFId=Pid;
END//
DELIMITER ;

-- Volcando estructura para tabla invercafe-db.tipocontrato
CREATE TABLE IF NOT EXISTS `tipocontrato` (
  `TCONId` int(11) NOT NULL AUTO_INCREMENT,
  `TCONNombre` varchar(50) DEFAULT NULL,
  `TCONEstado` int(11) DEFAULT NULL,
  PRIMARY KEY (`TCONId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.tipocontrato: 3 rows
DELETE FROM `tipocontrato`;
/*!40000 ALTER TABLE `tipocontrato` DISABLE KEYS */;
INSERT INTO `tipocontrato` (`TCONId`, `TCONNombre`, `TCONEstado`) VALUES
	(1, 'Convencional', 1),
	(2, 'Especial', 1),
	(3, 'Mixto', 1);
/*!40000 ALTER TABLE `tipocontrato` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.tipoopcion
CREATE TABLE IF NOT EXISTS `tipoopcion` (
  `TOPId` int(11) NOT NULL AUTO_INCREMENT,
  `TOPNombre` varchar(50) DEFAULT NULL,
  `TOPEstado` int(11) DEFAULT NULL,
  PRIMARY KEY (`TOPId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.tipoopcion: ~8 rows (aproximadamente)
DELETE FROM `tipoopcion`;
/*!40000 ALTER TABLE `tipoopcion` DISABLE KEYS */;
INSERT INTO `tipoopcion` (`TOPId`, `TOPNombre`, `TOPEstado`) VALUES
	(1, 'Calidad', 1),
	(2, 'Mes fix', 1),
	(3, 'Puerto', 1),
	(4, 'Certificacion', 1),
	(5, 'Mes embarque', 1),
	(6, 'Detalle mes embarque', 1),
	(7, 'Unidad de empaque', 1),
	(8, 'Tipo de Empaque', 1),
	(9, 'Otros requerimientos', 1),
	(10, 'Asociaciones', 1);
/*!40000 ALTER TABLE `tipoopcion` ENABLE KEYS */;

-- Volcando estructura para tabla invercafe-db.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `USRId` int(11) NOT NULL AUTO_INCREMENT,
  `PERFId` int(11) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `LastName` varchar(80) DEFAULT NULL,
  `Name` varchar(80) DEFAULT NULL,
  `Celular` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Direccion` varchar(150) DEFAULT NULL,
  `Documento` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `USREstado` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`USRId`) USING BTREE,
  UNIQUE KEY `IPSId_UserName` (`UserName`),
  KEY `UserName` (`UserName`),
  KEY `Email` (`Email`),
  KEY `USREstado` (`USREstado`),
  KEY `FK_usuario_perfil` (`PERFId`),
  CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`PERFId`) REFERENCES `perfil` (`PERFId`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla invercafe-db.usuario: ~2 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`USRId`, `PERFId`, `UserName`, `LastName`, `Name`, `Celular`, `Email`, `Direccion`, `Documento`, `Password`, `USREstado`, `updatedAt`, `createdAt`) VALUES
	(1, 1, 'fedat', 'Trejos', 'David', NULL, 'fedat04@gmail.com', NULL, NULL, '6bb143359ef8113e975ee5b65c9916b0', 1, '2022-10-08 18:20:41', '2023-02-22 08:01:36'),
	(2, 1, 'andres.trejos', 'Trejos', 'Carlos Andres', NULL, 'andres.trejos@solutions-systems.com', NULL, NULL, '30c066d92280f3a90195981a791df4c7', 0, '2023-03-11 21:20:33', '2023-02-22 08:01:36');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para vista invercafe-db.view_listadousuarios
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_listadousuarios` (
	`USRId` INT(11) NOT NULL,
	`PERFId` INT(11) NOT NULL,
	`UserName` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nameComplete` VARCHAR(161) NULL COLLATE 'utf8_general_ci',
	`Email` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`Password` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`USREstado` INT(11) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista invercafe-db.view_listadousuarios
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_listadousuarios`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_listadousuarios` AS select `u`.`USRId` AS `USRId`,`p`.`PERFId` AS `PERFId`,`u`.`UserName` AS `UserName`,concat(`u`.`Name`,' ',`u`.`LastName`) AS `nameComplete`,`u`.`Email` AS `Email`,`u`.`Password` AS `Password`,`u`.`USREstado` AS `USREstado` from (`usuario` `u` join `perfil` `p` on((`u`.`PERFId` = `p`.`PERFId`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
