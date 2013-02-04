/*
SQLyog Community v8.7 RC
MySQL - 5.1.41 : Database - upea_matriculacion
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`upea_matriculacion` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `upea_matriculacion`;

/*Data for the table `banco` */

insert  into `banco`(`CodBanco`,`Nombre`,`Cuenta`,`Activo`) values (1,'Banco Unión','110000004313083','S');

/*Data for the table `carrera` */

insert  into `carrera`(`codCarrera`,`Nombre`) values (11,'Administración de Empresas'),(12,'Arquitectura'),(13,'Ciencias de la Educación'),(14,'Ciencias del Desarrollo'),(15,'Comunicación Social'),(16,'Contaduría Pública'),(17,'Derecho'),(18,'Economía'),(19,'Enfermería'),(20,'Ingeniería Agronómica'),(21,'Ingeniería Civil'),(22,'Ingeniería de Sistemas'),(23,'Ingeniería Electrónica'),(24,'Lingüística'),(25,'Medicina'),(26,'Odontología'),(27,'Sociología'),(28,'Trabajo social'),(29,'Medicina Veterinaria y Zootecnia'),(30,'Ing. en Produccion Empresarial'),(31,'Ingenieria de gas y petroquimica'),(32,'Historia'),(33,'Ciencias Políticas'),(34,'Ingeniería Textil'),(35,'Gestión de Turismo y Hotelería'),(36,'Nutrición y Dietética'),(37,'Ingeniería Ambiental'),(38,'Educación Parvularia'),(39,'Artes Plásticas'),(40,'Psicología'),(41,'Ciencias Físicas y Energías Alternativas'),(42,'Ingeniería Eléctrica'),(43,'Ingeniería Autotrónica'),(44,'Comercio Internacional'),(45,'Zootecnia e Industria Pecuaria');

/*Data for the table `grado_academico` */

insert  into `grado_academico`(`CodGradoAcademico`,`Nombre`,`NombreCorto`,`Precedencia`,`TipoGrado`) values (1,'Técnico medio','Tec.',1,'GRA'),(2,'Técnico superior','Tec.Sup.',2,'GRA'),(3,'Bachiller','Bach.',3,'GRA'),(4,'Licenciatura','Lic.',4,'GRA'),(5,'Diplomado','Dip.',5,'POS'),(6,'Especialidad','Esp.',6,'POS'),(7,'Maestria','Mgstr.',7,'POS'),(8,'Doctorado','Ph.D.',8,'POS');

/*Data for the table `idioma` */

insert  into `idioma`(`CodIdioma`,`Nombre`,`TipoIdioma`) values (1,'Inglés','X'),(2,'Francés','X'),(3,'Alemán','X'),(4,'Aymara','O'),(5,'Quechua','O'),(6,'Guarani','O'),(7,'Ruso - Ucranian','X');

/*Data for the table `pais` */

insert  into `pais`(`codPais`,`Nombre`) values (11,'Bolivia'),(12,'Perú'),(13,'Argentina'),(14,'Brasil'),(15,'Panamá'),(16,'Rusia');

/*Data for the table `unidad_academica` */

insert  into `unidad_academica`(`CodUnidadAcademica`,`Nombre`,`Dependencia`) values (1,'CEFORPI','Vicerectorado UPEA');

/*Data for the table `universidad` */

insert  into `universidad`(`CodUniversidad`,`Nombre`) values (11,'Universidad Pública de El Alto'),(12,'Universidad Mayor de San Andrés'),(13,'Universidad Técnica de Oruro'),(14,'Universidad Tomás Frias'),(15,'Universidad Nacional de Siglo XX'),(16,'Universidad San Francisco Xavier'),(17,'Universidad Mayor de San Simón'),(18,'Universidad Gabriel René Moreno'),(19,'Universidad Amazónica de Pando'),(20,'Universidad Juan Misael Saracho'),(21,'Universidad Técnica del Beni'),
(22,'SEDUCA'), (99,'SIN TITULO DE BACHILLER');

/*Data for the table `zona` */

insert  into `zona`(`CodZona`,`Nombre`,`Ciudad`,`Distrito`) values (1,'Ciudad Satélite, Villa Dolores','EA','1'),(2,'Villa Santiago II, Senkata','EA','1'),(3,'Villa Adela, Cosmos 79, 1ro de Mayo','EA','1'),(4,'Rio Seco, Los Andes','EA','1'),(5,'Zona Brazil, 16 de Febrero, Estrellas de Belen','EA','1'),(6,'Viacha y Provincias aledañas','EA','1'),(7,'Ferropetrol, Zona 16 de Julio, Villa Esperanza','EA','1'),(8,'La Paz: Sur, Sopocachi, Prado, Miraflores','LP','1'),(9,'La Paz: Central, San Pedro, Tembladerani','LP','1'),(10,'La Paz: Garita, Cementerio, Said Vita','LP','1');

-- 
-- Volcar la base de datos para la tabla `perfil`
-- 

INSERT INTO `perfil` (Perfil, Administrador, Llave) VALUES ('Administrador', 'S', '111111111111111111111111111111111111111');

INSERT INTO `perfil` (Perfil, Administrador, Llave) VALUES ('Kardixta', 'N',      '111111111000000000000000000000000000000');


-- Volcar la base de datos para la tabla `usuario`
-- 
INSERT INTO `persona` (CodPersona, Paterno, Nombres, Genero) VALUES (1, 'Paez', 'Luis', 'M');
INSERT INTO `persona` (CodPersona, Paterno, Nombres, Genero) VALUES (2, 'Choque', 'Heval', 'M');
INSERT INTO `usuario` (CodPersona, NombreUsuario, Clave, CodPerfil, Activo) VALUES (1, 'luis', '123', 1, 'S');
INSERT INTO `usuario` (CodPersona, NombreUsuario, Clave, CodPerfil, Activo) VALUES (2, 'heval', '321', 1, 'S');

/*Data for the table `subsede` */

insert  into `subsede`(`CodSubsede`,`Nombre`) values (1,'Chaguaya'),(2,'Qurpa'),(3,'Achacachi'),(4,'Viacha');

/*Data for the table `subsede_carrera` */

insert  into `subsede_carrera`(`CodSubsede`,`CodCarrera`) values (1,13),(2,13);

insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('CODIGOPAIS','11','');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('DELIMITADOR','0','|');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('DEPURACION','3','');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('GESTION','2013','');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('LINEA1','0','Universidad Pública de El Alto');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('LINEA2','0','Dirección de Registros y Admisiones');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('LINEA3','0','Sistema de matriculación');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('MATRICULAEXTRANJERO','50000','');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('MATRICULANACIONAL','2200','');
insert into `valores` (`Codigo`, `Numero`, `Cadena`) values('BANCO','1','');

insert into `requisito` (`CodRequisito`, `Nombre`, `Vigencia`, `Precio`) values('1','Titulo de bachiller',NULL,NULL);
insert into `requisito` (`CodRequisito`, `Nombre`, `Vigencia`, `Precio`) values('2','Fotocopia de CI',NULL,NULL);
insert into `requisito` (`CodRequisito`, `Nombre`, `Vigencia`, `Precio`) values('3','Certificado de nacimiento',NULL,NULL);
insert into `requisito` (`CodRequisito`, `Nombre`, `Vigencia`, `Precio`) values('4','Fotografias',NULL,NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
