SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `upea_matriculacion` DEFAULT CHARACTER SET utf8 ;
USE `upea_matriculacion` ;

-- -----------------------------------------------------
-- Table `upea_matriculacion`.`banco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`banco` (
  `CodBanco` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NOT NULL,
  `Cuenta` VARCHAR(15) NOT NULL,
  `Activo` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`CodBanco`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`carrera`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`carrera` (
  `CodCarrera` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` CHAR(50) NOT NULL,
  PRIMARY KEY (`CodCarrera`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`pais`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`pais` (
  `CodPais` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` CHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodPais`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`persona`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`persona` (
  `CodPersona` INT(11) NOT NULL AUTO_INCREMENT ,
  `Paterno` VARCHAR(20) NULL DEFAULT '' ,
  `Materno` VARCHAR(20) NULL DEFAULT '' ,
  `Nombres` VARCHAR(30) NOT NULL ,
  `Genero` VARCHAR(1) NULL DEFAULT NULL ,
  `FechaNac` DATE NULL DEFAULT NULL ,
  `LugarNac` VARCHAR(50) NULL DEFAULT NULL ,
  `TipoId` VARCHAR(1) NULL DEFAULT 'C' ,
  `CI` VARCHAR(10) NULL DEFAULT NULL ,
  `Expedido` VARCHAR(3) NULL DEFAULT '1' ,
  `CodPais` INT(11) NULL DEFAULT '11' ,
  `EstadoCivil` TINYINT(4) NULL DEFAULT '0' ,
  `Domicilio` VARCHAR(50) NULL DEFAULT NULL ,
  `Telefono` VARCHAR(8) NULL DEFAULT NULL ,
  `Celular` VARCHAR(8) NULL DEFAULT NULL ,
  `Correo` VARCHAR(60) NULL DEFAULT NULL ,
  `TelUrgencia` VARCHAR(20) NULL DEFAULT NULL ,
  `Obs` VARCHAR(255) NULL DEFAULT NULL ,
  `FechaAlta` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`CodPersona`) ,
  INDEX `fk_persona_1_idx` (`CodPais` ASC) ,
  CONSTRAINT `fk_persona_1`
    FOREIGN KEY (`CodPais` )
    REFERENCES `upea_matriculacion`.`pais` (`CodPais` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`estudiante`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`estudiante` (
  `CodPersona` INT(11) NOT NULL ,
  `RegUniversitario` int ,
  `Anexo` tinyInt default 0 ,
  `DocIngreso` tinyInt ,
  `Categoria` VARCHAR(4),
  PRIMARY KEY (`CodPersona`) ,
  INDEX `fk_estudiante_1_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_estudiante_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`estudiante_carrera`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`estudiante_carrera` (
  `CodEstudianteCarrera` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodPersona` INT(11) NOT NULL ,
  `CodCarrera` INT(11) NOT NULL ,
  `AnioIngreso` VARCHAR(4) NULL DEFAULT '' ,
  `AnioEgreso` VARCHAR(4) NULL DEFAULT '' ,
  `NumArchivo` VARCHAR(12) NULL DEFAULT '0' ,
  `Modalidad` VARCHAR(1) NULL DEFAULT 'N' ,
  `Activo` VARCHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`CodEstudianteCarrera`) ,
  INDEX `fk_estudiante_carrera_1_idx` (`CodPersona` ASC) ,
  INDEX `fk_estudiante_carrera_2_idx` (`CodCarrera` ASC) ,
  CONSTRAINT `fk_estudiante_carrera_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`estudiante` (`CodPersona` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_estudiante_carrera_2`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`matricula`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`matricula` (
  `CodMatricula` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodEstudianteCarrera` INT(11) NOT NULL ,
  `Matricula` INT(11) NULL DEFAULT NULL ,
  `Fecha` DATE NULL DEFAULT NULL ,
  `Gestion` VARCHAR(4) NULL DEFAULT NULL ,
  `Fuente` VARCHAR(3) NULL DEFAULT 'ra' ,
  `CodSubsede` INT NULL DEFAULT NULL,
  `Anulada` VARCHAR(1) NULL DEFAULT 'N' ,
  PRIMARY KEY (`CodMatricula`) ,
  INDEX `fk_matricula_1_idx` (`CodEstudianteCarrera` ASC) ,
  INDEX `fk_matricula_2_idx` (`CodSubsede` ASC) ,
  CONSTRAINT `fk_matricula_1`
    FOREIGN KEY (`CodEstudianteCarrera` )
    REFERENCES `upea_matriculacion`.`estudiante_carrera` (`CodEstudianteCarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_2`
    FOREIGN KEY (`CodSubsede` )
    REFERENCES `upea_matriculacion`.`subsede` (`CodSubsede` )
    ON DELETE SET NULL
    ON UPDATE SET NULL
)ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`deposito_bancario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`deposito_bancario` (
  `CodDeposito` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodMatricula` INT(11) NOT NULL ,
  `TipoMatricula` VARCHAR(2) NOT NULL ,
  `CodBanco` INT(11) NULL DEFAULT NULL ,  
  `DepMatricula` DECIMAL(9,2) NULL DEFAULT '0.00' ,
  `FechaDeposito` DATE NULL DEFAULT NULL ,
  `NumDeposito` CHAR(10) NULL DEFAULT '0' ,
  PRIMARY KEY (`CodDeposito`) ,
  INDEX `fk_deposito_bancario_1_idx` (`CodMatricula` ASC) ,
  INDEX `fk_deposito_bancario_2_idx` (`CodBanco` ASC) ,
  CONSTRAINT `fk_deposito_bancario_1`
    FOREIGN KEY (`CodMatricula` )
    REFERENCES `upea_matriculacion`.`matricula` (`CodMatricula` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_deposito_bancario_2`
    FOREIGN KEY (`CodBanco` )
    REFERENCES `upea_matriculacion`.`banco` (`CodBanco` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)	
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`requisito`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`requisito` (
  `CodRequisito` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NULL DEFAULT NULL ,
  `Vigencia` INT(11) NULL DEFAULT NULL ,
  `Precio` DECIMAL(9,2) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodRequisito`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`estudiante_requisito`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`estudiante_requisito` (
  `CodPersona` INT(11) NOT NULL ,
  `CodRequisito` INT(11) NOT NULL ,
  `FechaPresentacion` DATE NOT NULL ,
  INDEX `fk_estudiante_requisito_1_idx` (`CodRequisito` ASC) ,
  INDEX `fk_estudiante_requisito_2_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_estudiante_requisito_1`
    FOREIGN KEY (`CodRequisito` )
    REFERENCES `upea_matriculacion`.`requisito` (`CodRequisito` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudiante_requisito_2`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`estudiante` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`grado_academico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`grado_academico` (
  `CodGradoAcademico` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NOT NULL ,
  `NombreCorto` VARCHAR(10) NULL DEFAULT NULL ,
  `Precedencia` TINYINT(4) NULL DEFAULT NULL ,
  `TipoGrado` VARCHAR(3) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodGradoAcademico`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`postgraduante`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`postgraduante` (
  `CodPersona` INT(11) NOT NULL ,
  PRIMARY KEY (`CodPersona`) ,
  INDEX `fk_postgraduante_1_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_postgraduante_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`estudio_postgrado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`estudio_postgrado` (
  `CodEstudioPostgrado` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodPersona` INT(11) NOT NULL ,
  `CodGradoAcademico` INT(11) NOT NULL ,
  `UnidadAcademica` VARCHAR(60) NULL DEFAULT NULL ,
  `Duracion` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodEstudioPostgrado`) ,
  INDEX `fk_estudio_postgrado_1_idx` (`CodGradoAcademico` ASC) ,
  INDEX `fk_estudio_postgrado_2_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_estudio_postgrado_1`
    FOREIGN KEY (`CodGradoAcademico` )
    REFERENCES `upea_matriculacion`.`grado_academico` (`CodGradoAcademico` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudio_postgrado_2`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`postgraduante` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`idioma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`idioma` (
  `CodIdioma` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(20) NOT NULL ,
  `TipoIdioma` VARCHAR(1) NOT NULL ,
  PRIMARY KEY (`CodIdioma`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`inscripcion_preuniversitario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`inscripcion_preuniversitario` (
  `CodInscripcionPreuniversitario` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodCarrera` INT(11) NOT NULL ,
  `Gestion` VARCHAR(4) NOT NULL ,
  `Fecha` DATE NOT NULL ,
  `TipoInscripcion` INT(11) NOT NULL ,
  PRIMARY KEY (`CodInscripcionPreuniversitario`) ,
  INDEX `fk_inscripcion_preuniversitario_1_idx` (`CodCarrera` ASC) ,
  CONSTRAINT `fk_inscripcion_preuniversitario_1`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`programa_postgrado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`programa_postgrado` (
  `CodProgramaPostgrado` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`CodProgramaPostgrado`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`unidad_academica`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`unidad_academica` (
  `CodUnidadAcademica` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(100) NOT NULL ,
  `Dependencia` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodUnidadAcademica`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`planificacion_postgrado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`planificacion_postgrado` (
  `CodPlanificacionPostgrado` INT NOT NULL AUTO_INCREMENT,
  `CodUnidadAcademica` INT(11) NOT NULL ,
  `CodProgramaPostgrado` INT(11) NOT NULL ,
  `Gestion` VARCHAR(45) NULL ,
  `Precio` VARCHAR(45) NULL ,
  PRIMARY KEY (`CodPlanificacionPostgrado`) ,
  INDEX `fk_planificacion_postgrado_programa_postgrado1_idx` (`CodProgramaPostgrado` ASC) ,
  INDEX `fk_planificacion_postgrado_unidad_academica1_idx` (`CodUnidadAcademica` ASC) ,
  CONSTRAINT `fk_planificacion_postgrado_programa_postgrado1`
    FOREIGN KEY (`CodProgramaPostgrado` )
    REFERENCES `upea_matriculacion`.`programa_postgrado` (`CodProgramaPostgrado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_planificacion_postgrado_unidad_academica1`
    FOREIGN KEY (`CodUnidadAcademica` )
    REFERENCES `upea_matriculacion`.`unidad_academica` (`CodUnidadAcademica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`matricula_postgrado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`matricula_postgrado` (
  `CodMatriculaPostgrado` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodPersona` INT(11) NOT NULL ,
  `CodPlanificacionPostgrado` INT(11) NOT NULL ,
  `Matricula` INT(11) NULL DEFAULT NULL ,
  `Fecha` DATE NULL DEFAULT NULL ,
  PRIMARY KEY (`CodMatriculaPostgrado`) ,
  INDEX `fk_matricula_postgrado_1_idx` (`CodPersona` ASC) ,
  INDEX `fk_matricula_postgrado_2_idx` (`CodPlanificacionPostgrado` ASC ) ,
  CONSTRAINT `fk_matricula_postgrado_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`postgraduante` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_postgrado_2`
    FOREIGN KEY (`CodPlanificacionPostgrado`)
    REFERENCES `upea_matriculacion`.`planificacion_postgrado` (`CodPlanificacionPostgrado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`persona_idioma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`persona_idioma` (
  `CodPersona` INT(11) NOT NULL ,
  `CodIdioma` INT(11) NOT NULL ,
  PRIMARY KEY (`CodPersona`, `CodIdioma`) ,
  INDEX `fk_persona_idioma_1_idx` (`CodPersona`) ,
  INDEX `fk_persona_idioma_2_idx` (`CodIdioma` ASC) ,
  CONSTRAINT `fk_persona_idioma_1`
    FOREIGN KEY (`CodPersona`)
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_idioma_2`
    FOREIGN KEY (`CodIdioma` )
    REFERENCES `upea_matriculacion`.`idioma` (`CodIdioma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`universidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`universidad` (
  `CodUniversidad` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` CHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodUniversidad`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE `subsede` (
  `CodSubsede` int(11) NOT NULL PRIMARY KEY auto_increment,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE `subsede_carrera` (
  `CodSubsede` INT NOT NULL,
  `CodCarrera` INT  NOT NULL,
  PRIMARY KEY (CodSubsede, CodCarrera),
  INDEX `fk_subsede_idx_1` (`CodCarrera` ASC),
  INDEX `fk_subsede_idx_2` (`CodSubsede` ASC),
  CONSTRAINT `fk_subsede_1`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subsede_2`
    FOREIGN KEY (`CodSubsede` )
    REFERENCES `upea_matriculacion`.`subsede` (`CodSubsede` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=INNODB  DEFAULT CHARSET=utf8 ;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`preuniversitario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`preuniversitario` (
  `CodPersona` INT(11) NOT NULL ,
  `CodUniversidad` INT(11) NULL DEFAULT NULL ,
  `Colegio` VARCHAR(40) NULL DEFAULT '' ,
  `AnioEgreso` VARCHAR(4) NULL DEFAULT '' ,
  `TipoColegio` TINYINT(4) NULL DEFAULT 0 ,
  `NumTitulo` VARCHAR(10) NULL DEFAULT '' ,
  `AnioTitulo` VARCHAR(4) NULL DEFAULT '' ,
  `Localidad` VARCHAR(30) NULL DEFAULT '' ,
  `CodPais` int not null,
  `CodCarrera` int not null,
  `CodSubsede` int null default null,
  PRIMARY KEY (`CodPersona`) ,
  INDEX `fk_preuniversitario_1_idx` (`CodPersona` ASC) ,
  INDEX `fk_preuniversitario_2_idx` (`CodUniversidad` ASC) ,
  INDEX `fk_preuniversitario_3_idx` (`CodCarrera` ASC) ,
  INDEX `fk_preuniversitario_4_idx` (`CodSubsede` ASC) ,
  CONSTRAINT `fk_preuniversitario_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_preuniversitario_2`
    FOREIGN KEY (`CodUniversidad` )
    REFERENCES `upea_matriculacion`.`universidad` (`CodUniversidad` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_preuniversitario_3`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_preuniversitario_4`
    FOREIGN KEY (`CodSubsede` )
    REFERENCES `upea_matriculacion`.`subsede` (`CodSubsede` )
    ON DELETE SET NULL
    ON UPDATE SET NULL
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`prorroga`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`prorroga` (
  `CodProrroga` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodMatricula` INT(11) NULL DEFAULT NULL ,
  `CodRequisito` INT(11) NULL DEFAULT NULL ,
  `Numero` VARCHAR(12) NULL DEFAULT NULL ,
  `FechaEmision` DATE NOT NULL ,
  `Precio` DECIMAL(9,2) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodProrroga`) ,
  INDEX `fk_prorroga_1_idx` (`CodRequisito` ASC) ,
  INDEX `fk_prorroga_2_idx` (`CodMatricula` ASC) ,
  CONSTRAINT `fk_prorroga_1`
    FOREIGN KEY (`CodRequisito` )
    REFERENCES `upea_matriculacion`.`requisito` (`CodRequisito` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prorroga_2`
    FOREIGN KEY (`CodMatricula` )
    REFERENCES `upea_matriculacion`.`matricula` (`CodMatricula` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`zona`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`zona` (
  `CodZona` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NOT NULL,
  `Ciudad` VARCHAR(3) NULL DEFAULT NULL ,
  `Distrito` VARCHAR(2) NULL DEFAULT NULL ,
  PRIMARY KEY (`CodZona`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`socio_economico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`socio_economico` (
  `CodPersona` INT(11) NOT NULL ,
  `CodZona` INT(11) NULL DEFAULT '-1' ,
  `Gestion` VARCHAR(4) NOT NULL ,
  `Vivienda` TINYINT(4) NULL DEFAULT NULL ,
  `Caracteristicas` TINYINT(4) NULL DEFAULT NULL ,
  `Trabaja` TINYINT(4) NULL DEFAULT NULL ,
  `Trabajo` TINYINT(4) NULL DEFAULT NULL ,
  `Jornada` TINYINT(4) NULL DEFAULT NULL ,
  INDEX `fk_socio_economico_1_idx` (`CodPersona` ASC) ,
  INDEX `fk_socio_economico_2_idx` (`CodZona` ASC) ,
  CONSTRAINT `fk_socio_economico_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_socio_economico_2`
    FOREIGN KEY (`CodZona` )
    REFERENCES `upea_matriculacion`.`zona` (`CodZona` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`usuario` (
  `CodUsuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `CodPersona` INT(11) NOT NULL ,
  `NombreUsuario` VARCHAR(15) NOT NULL ,
  `Clave` VARCHAR(128) NOT NULL ,
  `CodPerfil` INT NOT NULL,
  `Activo` VARCHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`CodUsuario`) ,
  INDEX `fk_usuario_1_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_usuario_1`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  INDEX `fk_usuario_2_idx` (`CodPerfil` ASC) ,
  CONSTRAINT `fk_usuario_2`
    FOREIGN KEY (`CodPerfil` )
    REFERENCES `upea_matriculacion`.`perfil` (`CodPerfil` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `upea_matriculacion`.`valores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`valores` (
  `Codigo` CHAR(20) NOT NULL ,
  `Numero` INT(11) NULL DEFAULT '0' ,
  `Cadena` CHAR(100) NULL DEFAULT '' ,
  PRIMARY KEY (`Codigo`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

create table `upea_matriculacion`.`cupo_matricula` (
   CodCupo INTEGER NOT NULL PRIMARY KEY auto_increment,
   CodPersona int not null,
   Gestion VARCHAR(4),
   Fecha  date,
   Desde int,
   Hasta int
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE `perfil` (
  `CodPerfil` int(11) NOT NULL auto_increment,
  `Perfil` varchar(40) NOT NULL,
  `Administrador` varchar(1) NOT NULL default 'N',
  `Llave` varchar(100) NOT NULL,
  PRIMARY KEY  (`CodPerfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE `habilitacion` (
  `CodHabilitacion` int(11) NOT NULL auto_increment,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `CodCarrera` int(11) NOT NULL,
  `DesdeNombre` varchar(10) NOT NULL,
  `HastaNombre` varchar(10) NOT NULL,
  PRIMARY KEY  (`CodHabilitacion`),
  INDEX `fk_habilitacion_idx` (`CodCarrera` ASC) ,
  CONSTRAINT `fk_habilitacion`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE CASCADE
    ON UPDATE CASCADE 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`auditoria` (
  `CodAuditoria` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `CodUsuario` int NOT NULL,
  `CodPersona` int NOT NULL,
  `Fecha` datetime NOT NULL,
  `Operacion` varchar(1) NOT NULL,
  `Consulta` text NOT NULL,
  INDEX `fk_auditoria_1_idx` (`CodUsuario` ASC) ,
  CONSTRAINT `fk_auditoria_1`
    FOREIGN KEY (`CodUsuario` )
    REFERENCES `upea_matriculacion`.`usuario` (`CodUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  INDEX `fk_auditoria_2_idx` (`CodPersona` ASC) ,
  CONSTRAINT `fk_auditoria_2`
    FOREIGN KEY (`CodPersona` )
    REFERENCES `upea_matriculacion`.`persona` (`CodPersona` )
    ON DELETE CASCADE
    ON UPDATE CASCADE     
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE  TABLE IF NOT EXISTS `upea_matriculacion`.`usuario_carrera` (
  `CodUsuarioCarrera` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `CodUsuario` INT(11) NOT NULL ,
  `CodCarrera` INT(11) NOT NULL ,
  INDEX `fk_usuario_carrera_1_idx` (`CodUsuario` ASC) ,
  INDEX `fk_usuario_carrera_2_idx` (`CodCarrera` ASC) ,
  CONSTRAINT `fk_usuario_carrera_1`
    FOREIGN KEY (`CodUsuario` )
    REFERENCES `upea_matriculacion`.`usuario` (`CodUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_carrera_2`
    FOREIGN KEY (`CodCarrera` )
    REFERENCES `upea_matriculacion`.`carrera` (`CodCarrera` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB
DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
