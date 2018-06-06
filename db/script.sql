CREATE DATABASE verano;
USE verano;
CREATE TABLE tabla( 
	id INT, 
	nombre VARCHAR(20) 
);
INSERT INTO tabla VALUES ( 1, 'Ricardo' );
INSERT INTO tabla VALUES ( 2, 'Daniel' );
INSERT INTO tabla VALUES ( 3, 'Pepe' );
INSERT INTO tabla VALUES ( 4,'Juan' );
INSERT INTO tabla VALUES ( 5, 'Elias' );

/* AREAS */
CREATE TABLE areas (
	clave VARCHAR(40) PRIMARY KEY, 
	area VARCHAR(200)
);
INSERT INTO areas VALUES ( '1', 'Ciencias de la tierra' );
INSERT INTO areas VALUES ( '2', 'Sistemas y computación' );
INSERT INTO areas VALUES ( '3', 'Ciencias básicas' );
INSERT INTO areas VALUES ( '4', 'Ciencias económicas' );
INSERT INTO areas VALUES ( '5', 'Ciencias administrativas' );

/* CARRERAS */
CREATE TABLE carreras (
	clave VARCHAR(40) PRIMARY KEY,
	carrera VARCHAR(200)
);
INSERT INTO carreras VALUES ( '1', 'Contabilidad' );
INSERT INTO carreras VALUES ( '2', 'Gestión empresarial' );
INSERT INTO carreras VALUES ( '3', 'Ingeniería informatica' );
INSERT INTO carreras VALUES ( '4', 'Ingeniería civil' );
INSERT INTO carreras VALUES ( '5', 'Ingeniería en sistemas computacionales' );

/* SEMESTRES */
CREATE TABLE semestres (
	clave VARCHAR(40) PRIMARY KEY,
	semestre VARCHAR(200)
);
INSERT INTO semestres VALUES ( '1', '1' );
INSERT INTO semestres VALUES ( '2', '2' );
INSERT INTO semestres VALUES ( '3', '3' );
INSERT INTO semestres VALUES ( '4', '4' );
INSERT INTO semestres VALUES ( '5', '5' );
INSERT INTO semestres VALUES ( '6', '6' );
INSERT INTO semestres VALUES ( '7', '7' );
INSERT INTO semestres VALUES ( '8', '8' );
INSERT INTO semestres VALUES ( '9', '9' );
INSERT INTO semestres VALUES ( '10', '10' );
INSERT INTO semestres VALUES ( '11', '11' );
INSERT INTO semestres VALUES ( '12', '12' );

/* MAESTROS */
CREATE TABLE profesores (
	clave VARCHAR(40) PRIMARY KEY,
	nombre VARCHAR(40),
	apellido_paterno VARCHAR(40),
	apellido_materno VARCHAR(40),
	email VARCHAR(360),
	telefono VARCHAR(20),
	status TINYINT,
	clave_area VARCHAR(40)
);
ALTER TABLE profesores ADD CONSTRAINT fk_profesores_areas FOREIGN KEY (clave_area) REFERENCES areas (clave);

/* JEFES DE DEPTO */
CREATE TABLE jefes_departamento (
	clave VARCHAR(40) PRIMARY KEY,
	nombre VARCHAR(40),
	apellido_paterno VARCHAR(40),
	apellido_materno VARCHAR(40),
	email VARCHAR(360),
	telefono VARCHAR(20),
	status TINYINT,
	clave_area VARCHAR(40)
);
ALTER TABLE jefes_departamento ADD CONSTRAINT fk_jefes_areas FOREIGN KEY (clave_area) REFERENCES areas (clave);

/* USUARIOS JEFES DE DEPTO */
CREATE TABLE usuarios_jefes_departamento (
	clave_profesor VARCHAR(40) NOT NULL,
	usuario VARCHAR(45) NOT NULL,
	contrasenia VARCHAR(20) NOT NULL,
	PRIMARY KEY (`clave_profesor`),
	UNIQUE INDEX `idx_unq_usuario` (`usuario` ASC),
	CONSTRAINT `fk_usuarios_jefes_departamento`
	FOREIGN KEY (`clave_profesor`)
	REFERENCES JEFES_DEPARTAMENTO (`clave`)
);

/* COORDINADORES */
CREATE TABLE coordinadores (
	no_control VARCHAR(40) NOT NULL,
	nombre VARCHAR(40) NOT NULL,
	apellido_paterno VARCHAR(40) NOT NULL,
	apellido_materno VARCHAR(40) NOT NULL,
	email VARCHAR(360) NULL,
	telefono VARCHAR(20) NULL,
	PRIMARY KEY (`no_control`)
);

/* USUARIOS DE LOS COORDINADORES */
CREATE TABLE usuarios_coordinadores (
	no_control_coordinador VARCHAR(40) NOT NULL,
	contrasenia VARCHAR(20) NOT NULL,
	PRIMARY KEY (`no_control_coordinador`),
	CONSTRAINT `fk_usuarios_coordinadores`
	FOREIGN KEY (`no_control_coordinador`)
	REFERENCES coordinadores (`no_control`)
);

INSERT INTO coordinadores VALUES ( '1111', 'Coordinador 1111', 'Apellido P 1111', 'Apellido M 1111', 'Email 1111', '4748839');
INSERT INTO usuarios_coordinadores VALUES ( '1111', '1234' );




/* ADMINISTRADOR */
CREATE TABLE admin (
	usuario VARCHAR(40) NOT NULL,
	contrasenia VARCHAR(20) NOT NULL,
	PRIMARY KEY (`usuario`)
);
INSERT INTO admin VALUES ('admin', '1234');



INSERT INTO profesores VALUES ( '1', 'Ruben de Dios', 'Meza', 'Castro', 'ruben@hotmail.com', '7471218435', 1, '1' );
INSERT INTO profesores VALUES ( '2', 'Crispin Geovany', 'Pastor', 'Solache', 'crispin@hotmail.com', '7471001945', 1, '2' );
/*DAR DE BAJA*/
UPDATE profesores SET status = 0 WHERE clave = ''
















/* JEFES Y SUS USUARIOS */
SELECT * FROM jefes_departamento JOIN usuarios_jefes_departamento WHERE clave = '1' AND clave = clave_profesor;
/* USUARIOS PARA EL LOGIN */
SELECT usuario,




CREATE TABLE materias (
 clave VARCHAR(40) NOT NULL PRIMARY KEY,
  materia VARCHAR(200) NOT NULL,
  creditos INT(1) NOT NULL,
  clave_carrera VARCHAR(40) NOT NULL,
  clave_semestre VARCHAR(40) NOT NULL); 
ALTER TABLE materias ADD CONSTRAINT fk_materias_carreras FOREIGN KEY (clave_carrera) REFERENCES carreras (clave);
ALTER TABLE materias ADD CONSTRAINT fk_materias_semestres FOREIGN KEY (clave_semestre) REFERENCES semestres (clave);

/* INSERCION EN MATERIAS */
INSERT INTO materias VALUES( '1', 'español', 5, '1', '1' );
INSERT INTO materias VALUES( '2', 'matematicas', 5, '1', '1' );
INSERT INTO materias VALUES( '3', 'historia', 5, '2', '2' );
INSERT INTO materias VALUES( '4', 'geografia', 5, '2', '3' );
INSERT INTO materias VALUES( '5', 'atlas', 4, '2', '3' );


SELECT materias.clave, materia, creditos, carreras.carrera, semestres.semestre FROM materias JOIN carreras JOIN semestres WHERE clave_semestre = semestres.clave AND clave_carrera = carreras.clave;



SELECT materias.clave, materias.materia, carreras.carrera, materias.creditos, materias.clave_semestre FROM materias JOIN semestres JOIN carreras WHERE materias.clave_carrera = carreras.clave AND materias.clave_semestre = semestres.clave;


/* RETICULA*/
SELECT materias.clave, materias.materia, materias.creditos, materias.clave_semestre FROM materias WHERE clave_carrera = '2';
/*MATERIAS DEL SEMESTRE*/
SELECT materias.clave, materias.materia, materias.creditos FROM materias WHERE clave_carrera = '' AND clave_semestre = '';



SELECT clave, materia FROM materias WHERE clave = 15 AND clave_carrera = 1;












/* MATERIAS SOLICITADAS */
CREATE TABLE materias_solicitadas (
  `id` INT NOT NULL AUTO_INCREMENT,
  `no_control_coordinador` VARCHAR(40) NOT NULL,
  `clave_profesor` VARCHAR(40) NULL,
  `clave_materia` VARCHAR(40) NOT NULL,
  `nombre_materia` VARCHAR(45) NOT NULL,
  `aprobada` TINYINT NOT NULL,
  `anio` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`, `clave_materia`),
  INDEX `fk_MATERIAS_SOLICITADAS_COORDINADORES1_idx` (`no_control_coordinador` ASC),
  INDEX `fk_MATERIAS_SOLICITADAS_PROFESORES1_idx` (`clave_profesor` ASC),
  INDEX `fk_MATERIAS_SOLICITADAS_MATERIAS1_idx` (`clave_materia` ASC),
  CONSTRAINT `fk_MATERIAS_SOLICITADAS_COORDINADORES1`
    FOREIGN KEY (`no_control_coordinador`)
    REFERENCES `COORDINADORES` (`no_control`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MATERIAS_SOLICITADAS_PROFESORES1`
    FOREIGN KEY (`clave_profesor`)
    REFERENCES `PROFESORES` (`clave`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MATERIAS_SOLICITADAS_MATERIAS1`
    FOREIGN KEY (`clave_materia`)
    REFERENCES `MATERIAS` (`clave`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS estudiantes (
  `id_estudiante` INT NOT NULL AUTO_INCREMENT,
  `no_control` VARCHAR(40) NOT NULL,
  `nombre` VARCHAR(40) NOT NULL,
  `apellido_paterno` VARCHAR(40) NOT NULL,
  `apellido_materno` VARCHAR(40) NOT NULL,
  `email` VARCHAR(360) NULL,
  `telefono` VARCHAR(20) NULL,
  PRIMARY KEY (`id_estudiante`, `no_control`));


-- -----------------------------------------------------
/*CREATE TABLE IF NOT EXISTS `lista_materia` (
  `id_materia_solicitada` VARCHAR(40) NOT NULL,
  `no_control_estudiante` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id_materia_solicitada`, `no_control_estudiante`));
  ALTER TABLE lista_materia ADD CONSTRAINT fk_lista_materia FOREIGN KEY(id_materia_solicitada) REFERENCES materias_solicitadas(clave_materia);
  ALTER TABLE lista_materia ADD CONSTRAINT fk_lista_estudiante_s FOREIGN KEY(no_control_estudiante) REFERENCES estudiantes(no_control);*/

CREATE TABLE IF NOT EXISTS `lista_materia` (
  `id_materia_solicitada` INT NOT NULL,
  `clave_materia` VARCHAR(40) NOT NULL,
  `no_control` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id_materia_solicitada`, `clave_materia`, `no_control`),
  INDEX `fk_MATERIAS_SOLICITADAS_has_ESTUDIANTES_ESTUDIANTES4_idx` (`no_control` ASC),
  INDEX `fk_MATERIAS_SOLICITADAS_has_ESTUDIANTES_MATERIAS_SOLICITADA_idx` (`id_materia_solicitada` ASC, `clave_materia` ASC),
  CONSTRAINT `fk_MATERIAS_SOLICITADAS_has_ESTUDIANTES_MATERIAS_SOLICITADAS4`
    FOREIGN KEY (`id_materia_solicitada` , `clave_materia`)
    REFERENCES `materias_solicitadas` (`id` , `clave_materia`));
    --ALTER TABLE lista_materia ADD CONSTRAINT fk_lista_estudiantes_2 FOREIGN KEY (no_control) REFERENCES estudiantes(no_control);

    



INSERT INTO materias_solicitadas VALUES ( NULL, '1111', NULL, '15', 0, 18);
INSERT INTO materias_solicitadas VALUES ( NULL, '123', NULL, '15', 'Materia',  0,'2018');
INSERT INTO materias_solicitadas VALUES ( NULL, '1111', NULL, '15', 0 );




SELECT COUNT(no_control_coordinador) FROM materias_solicitadas WHERE no_control_coordinador = '123' AND anio = '2018';











SELECT materias.clave, materias.materia, carreras.carrera, materias.creditos, materias.clave_semestre FROM materias JOIN semestres JOIN carreras WHERE materias.clave_carrera = carreras.clave AND materias.clave_semestre = semestres.clave;

SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave;






SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = 4;



SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = $id_materia_solicitada GROUP BY lista_materia.no_control




SELECT materias.materia, materias.creditos FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = '$id' GROUP BY materias.materia





SELECT materias.materia, materias.creditos, semestres.semestre 
    FROM lista_materia 
    JOIN materias 
    JOIN semestres 
    WHERE lista_materia.clave_materia = materias.clave 
    AND lista_materia.id_materia_solicitada = 9 
    AND materias.clave_semestre = semestres.clave 
    GROUP BY materias.materia


    SELECT materias_solicitadas.id, materias_solicitadas.nombre_materia, materias.creditos, semestres.semestre, carreras.carrera 
    FROM materias_solicitadas
    JOIN materias 
    JOIN semestres 
    JOIN carreras 
    WHERE materias_solicitadas.clave_materia = materias.clave 
    AND materias.clave_semestre = semestres.clave 
    AND materias.clave_carrera = carreras.clave
    AND materias_solicitadas.id = '10';




    SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = $id_materia GROUP BY lista_materia.no_control ORDER BY lista_materia.no_control



SELECT 
  MATERIAS_SOLICITADAS.id, 
  MATERIAS_SOLICITADAS.no_control_coordinador, 
  MATERIAS_SOLICITADAS.clave_materia, 
  MATERIAS_SOLICITADAS.nombre_materia, 
  MATERIAS_SOLICITADAS.aprobada, 
  MATERIAS_SOLICITADAS.anio, 
  MATERIAS.clave_carrera  
  FROM MATERIAS_SOLICITADAS 
  JOIN MATERIAS 
  WHERE clave_carrera = '0' 
  GROUP BY MATERIAS_SOLICITADAS.id;