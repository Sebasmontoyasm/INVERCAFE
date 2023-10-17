DELIMITER //
CREATE PROCEDURE sp_broker_actualizarXid(
    inBROId INT,
    inPAISId INT,
    inBRONombre VARCHAR(255),
    inBROContacto VARCHAR(255),
    inBROTelefono VARCHAR(255),
    inBROCiudad VARCHAR(255),
    inBRODireccion VARCHAR(255)
)
BEGIN
    UPDATE broker
    SET 
        PAISId = inPAISId,
        BRONombre = inBRONombre,
        BROContacto = inBROContacto,
        BROTelefono = inBROTelefono,
        BROCiudad = inBROCiudad,
        BRODireccion = inBRODireccion
    WHERE BROId = inBROId;
END;
//
DELIMITER ;
