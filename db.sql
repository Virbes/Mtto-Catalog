DROP DATABASE IF EXISTS AdminT;

CREATE DATABASE IF NOT EXISTS AdminT
CHARACTER SET = 'utf8'
COLLATE = 'utf8_spanish_ci';

USE AdminT;

CREATE TABLE cCatalog(
	CvCatal INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    DsCatal VARCHAR(30), 
    NmFisCat VARCHAR(30), 
    NmColCv VARCHAR(30), 
    NmColDs VARCHAR(30)
) ENGINE = InnoDb;

-- < ------------------------------------ CATALOGOS -------------------------------------------- > --
CREATE TABLE cTipPerson (CvTipPerson INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsTipPerson VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cNombre    (CvNombre    INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsNombre    VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cApellido  (CvApellido  INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsApellido  VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cGenero    (CvGenero    INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsGenero    VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cEstado    (CvEstado    INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsEstado    VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cMunicipio (CvMunicipio INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsMunicipio VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cColonia   (CvColonia   INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsColonia   VARCHAR(30)) Engine = InnoDB;
CREATE TABLE cCalle     (CvCalle     INT PRIMARY KEY AUTO_INCREMENT NOT NULL,  DsCalle     VARCHAR(30)) Engine = InnoDB;
-- < -------------------------------------------------------------------------------------------------- > --


-- TABLA de Datos Personales
CREATE TABLE mPersona(
	CvPerson INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
    
	CvTipPerson INT, 
    
    Curp VARCHAR(20),
    Rfc VARCHAR(20),
    Email VARCHAR(30),
    CvNombre INT, 
    CvApePat INT, 
    CvApeMat INT, 
    FecNac DATE,
    CvGenero INT, 
    Telefono VARCHAR(15),

    CvEstado INT,
    CvMunicipio INT,
    CvColonia INT,
    CvCalle INT,
    Numero VARCHAR(10), 
    Cp INT,    
    
    FOREIGN KEY (CvTipPerson) REFERENCES cTipPerson(CvTipPerson),
    
    FOREIGN KEY (CvNombre) REFERENCES cNombre(CvNombre),
    FOREIGN KEY (CvApePat) REFERENCES cApellido(CvApellido),
    FOREIGN KEY (CvApeMat) REFERENCES cApellido(CvApellido),
    FOREIGN KEY (CvGenero) REFERENCES cGenero(CvGenero),
    
    FOREIGN KEY (CvEstado) REFERENCES cEstado(CvEstado),
    FOREIGN KEY (CvMunicipio) REFERENCES cMunicipio(CvMunicipio),
    FOREIGN KEY (CvColonia) REFERENCES cColonia(CvColonia),
    FOREIGN KEY (CvCalle) REFERENCES cCalle(CvCalle)
)Engine = InnoDB;

CREATE TABLE Users (
	CvUser    INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
	CvPerson  INT  		   NOT NULL,
	Login 	  VARCHAR(30)  NOT NULL,
	Password  VARCHAR(100) NOT NULL,
	FecIni    DATE         NOT NULL,
	FecFin    DATE         NOT NULL,
	EdoCta    BOOLEAN      NOT NULL, 
    
    FOREIGN KEY (CvPerson) REFERENCES mPersona(CvPerson)
)ENGINE = InnoDB;



-- < -------------------------------------------------------------------------------------------------- > --

INSERT INTO cCatalog(DsCatal, NmFisCat, NmColCv, NmColDs) VALUES 
('Tipo de Persona', 'cTipPerson', 'CvTipPerson', 'DsTipPerson'),

('Nombre', 'cNombre', 'CvNombre', 'DsNombre'),
('Apellido', 'cApellido', 'CvApellido', 'DsApellido'),
('Género', 'cGenero', 'CvGenero', 'DsGenero'),

('Estado', 'cEstado', 'CvEstado', 'DsEstado'),
('Municipio', 'cMunicipio', 'CvMunicipio', 'DsMunicipio'),
('Colonia', 'cColonia', 'CvColonia', 'DsColonia'),
('Calle', 'cCalle', 'CvCalle', 'DsCalle');

INSERT INTO cTipPerson(DsTipPerson) VALUES ('Usuario'),     ('Cliente'),            ('Proveedor');

INSERT INTO cNombre(DsNombre)       VALUES ('Francisco'),   ('Mario'),              ('Pedro');
INSERT INTO cApellido(DsApellido)   VALUES ('Virbes'),      ('Tomas'),              ('Alcoles');
INSERT INTO cGenero(DsGenero)       VALUES ('Masculino'),   ('Femenino');

INSERT INTO cEstado(DsEstado)       VALUES ('Chiapas'),     ('Jalisco'),            ('Nuevo León');
INSERT INTO cMunicipio(DsMunicipio) VALUES ('Comitán'),     ('Margaritas'),         ('Trinitaria');
INSERT INTO cColonia(DsColonia)     VALUES ('Linda Vista'), ('Cerrito Concepción'), ('Cedro');
INSERT INTO cCalle(DsCalle)         VALUES ('Arenal'),      ('Laguna Esmeralda'),   ('Miguel Aleman');

INSERT INTO mPersona(CvTipPerson, Curp, Rfc, Email, CvNombre, CvApePat, CvApeMat, FecNac, CvGenero, Telefono, CvEstado, CvMunicipio, CvColonia, CvCalle, Numero, Cp) VALUES
(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    
INSERT INTO Users() VALUES(0, 1, 'admin', '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S', '', '', true);