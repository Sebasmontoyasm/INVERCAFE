-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.0.3-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para invercafe-db
CREATE DATABASE IF NOT EXISTS `invercafe-db` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci */;
USE `invercafe-db`;

-- Volcando estructura para procedimiento invercafe-db.sp_broker_actualizarXid
DELIMITER //
CREATE PROCEDURE `sp_broker_actualizarXid`(
	IN `inBROId` INT,
	IN `inPAISId` INT,
	IN `inBRONombre` VARCHAR(255),
	IN `inBROContacto` VARCHAR(255),
	IN `inBROTelefono` VARCHAR(255),
	IN `inBROCiudad` VARCHAR(255),
	IN `inBROEmail` VARCHAR(255),
	IN `inBRODireccion` VARCHAR(255)
)
BEGIN 
 	IF inBROId = 0 THEN
		INSERT INTO broker (PAISId,BRONombre,BROContacto,BROTelefono,BROCiudad,BROEmail,BRODireccion,BROEstado) VALUES 
						(inPAISId,inBRONombre,inBROContacto,inBROTelefono,inBROCiudad,inBROEmail,inBRODireccion,1);
	ELSE
		UPDATE broker
		SET 
			PAISId = inPAISId,
			BRONombre = inBRONombre,
			BROContacto = inBROContacto,
			BROTelefono = inBROTelefono,
			BROCiudad = inBROCiudad,
			BROEmail = inBROEmail,
			BRODireccion = inBRODireccion
		WHERE BROId = inBROId;
	END IF;
END//
DELIMITER ;

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

-- Volcando estructura para procedimiento invercafe-db.sp_broker_seleccionarXid
DELIMITER //
CREATE PROCEDURE `sp_broker_seleccionarXid`(IN inBROId INT)
BEGIN
	SELECT b.*, co.country_name
	FROM broker AS b
	INNER JOIN countries AS co ON co.PAISId = b.PAISId
	WHERE b.BROId = inBROId;
END//
DELIMITER ;

-- Volcando estructura para procedimiento invercafe-db.sp_cliente_actualizarXid
DELIMITER //
CREATE PROCEDURE `sp_cliente_actualizarXid`(
	IN `inCLIEId` INT,
	IN `inPAISId` INT,
	IN `inCLIENombre` VARCHAR(255),
	IN `inCLIEContacto` VARCHAR(255),
	IN `inCLIETelefono` VARCHAR(255),
	IN `inCLIECiudad` VARCHAR(255),
	IN `inCLIEEmail` VARCHAR(255),
	IN `inCLIEDireccion` VARCHAR(255)
)
BEGIN
	IF inCLIEId = 0 THEN
		INSERT INTO cliente (PAISId,CLIENombre,CLIEContacto,CLIETelefono,CLIECiudad,CLIEEmail,CLIEDireccion,CLIEEstado) VALUES 
						(inPAISId,inCLIENombre,inCLIEContacto,inCLIETelefono,inCLIECiudad,inCLIEEmail,inCLIEDireccion,1);
	ELSE
		UPDATE cliente
		SET 	PAISId = inPAISId,
				CLIENombre = inCLIENombre,
				CLIEContacto = inCLIEContacto,
				CLIETelefono = inCLIETelefono,
				CLIECiudad = inCLIECiudad,
				CLIEEmail = inCLIEEmail,
				CLIEDireccion = inCLIEDireccion
		WHERE CLIEId = inCLIEId;
	END IF;
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

-- Volcando estructura para procedimiento invercafe-db.sp_cliente_seleccionarXid
DELIMITER //
CREATE PROCEDURE `sp_cliente_seleccionarXid`(
	IN `CLNId` INT
)
BEGIN
		SELECT c.*, co.country_name
    	FROM cliente c
	 	INNER JOIN countries co 
	 	ON (co.PAISId = c.PAISId)
	 	WHERE c.CLIEId = CLNId;
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
