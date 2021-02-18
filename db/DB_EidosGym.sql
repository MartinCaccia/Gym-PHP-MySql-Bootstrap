ALTER TABLE auth_user RENAME Persons;
commit;

ALTER TABLE Persons MODIFY id int NOT NULL AUTO_INCREMENT;
ALTER TABLE Persons ADD LastName varchar(50) NOT NULL;
ALTER TABLE Persons ADD UserPicProfile varchar(250);
ALTER TABLE Persons ADD Address varchar(50) NOT NULL;
ALTER TABLE Persons ADD CellPhone varchar(50);
ALTER TABLE Persons ADD LinePhone varchar(50);
ALTER TABLE Persons ADD EmergencyPhone varchar(50);
ALTER TABLE Persons ADD EmergencyContactPerson varchar(50);
ALTER TABLE Persons ADD EmergencyKinship varchar(50);
ALTER TABLE Persons ADD Email varchar(100);
ALTER TABLE Persons ADD BirthDate date NOT NULL;
ALTER TABLE Persons ADD Dni int NOT NULL;
ALTER TABLE Persons ADD Age int NOT NULL;
ALTER TABLE Persons ADD activo int NOT NULL default 1;

UPDATE `dbgym`.`persons` SET `sex`='1' WHERE `id`='1';
UPDATE `dbgym`.`persons` SET `sex`='1' WHERE `id`='2';
commit;

ALTER TABLE Persons MODIFY Sex int NOT NULL; -- 1: Male, 2: Female
ALTER TABLE Persons ADD Height int NOT NULL; -- En centimetros 180 por ejemplo
ALTER TABLE Persons ADD Weight_id int not null; -- En kgr.
-- Injuries  igual que objetivos, la lesion/es actual queda determinada por el registro que no tiene fecha de fin.
-- Problems  igual que objetivos, el problema/s actual queda determinada por el registro que no tiene fecha de fin.
-- Friends   igual que objetivos
-- Diet      igual que objetivos, la dieta actual queda determinada por el registro que no tiene fecha de fin.
-- Ocupacion igual que objetivos, la ocupacion actual queda determinada por el registro que no tiene fecha de fin.
ALTER TABLE Persons ADD observations varchar(250);
ALTER TABLE Persons ADD SleepHours int NOT NULL;
ALTER TABLE Persons ADD EstudiosMedicos_id int;
-- Campos de auditoria:
ALTER TABLE Persons ADD cuser varchar(20) NOT NULL;
ALTER TABLE Persons ADD cdate date NOT NULL;
ALTER TABLE Persons ADD muser varchar(20);
ALTER TABLE Persons ADD mdate date;
CREATE INDEX Dni_index ON Persons (Dni);

ALTER TABLE mem_types ADD activo int NOT NULL default 1;

CREATE TABLE IF NOT EXISTS `Weight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Peso` int NOT NULL,  
  `Fecha` date NOT NULL,
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX weight_index (Dni_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Injuries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Desc` varchar(250) NOT NULL,
  `Localizacion` varchar(50),
  PRIMARY KEY (`id`),
  INDEX Injuries_index (Dni_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Ocupacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250),
  `Fecha_desde` date NOT NULL,
  `Fecha_hasta` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Ocupaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Ocupacion_id` int NOT NULL,
  `Detalle` varchar(250),
  `Fecha_desde` date NOT NULL,
  `Fecha_hasta` date,
  PRIMARY KEY (`id`),
  INDEX Ocupaciones_index (Dni_id),
  INDEX Ocupacion_index (Ocupacion_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni),
  FOREIGN KEY (Ocupacion_id)
        REFERENCES Ocupacion(id)        
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ObjetivosPrim` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ObjetivosSec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Objetivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `ObjPrim_id` int NOT NULL,
  `ObjSec_id` int,
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX Objetivos_index (Dni_id),
  INDEX ObjPrim_index (ObjPrim_id),
  INDEX ObjSec_index (ObjSec_id),  
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni),
  FOREIGN KEY (ObjPrim_id)
        REFERENCES ObjetivosPrim(id),    
  FOREIGN KEY (ObjSec_id)
        REFERENCES ObjetivosSec(id)        
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `DeporteActividad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `FrecuenciaDeportiva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Tipo` int NOT NULL, -- 1: Semanal, 2: Mensual
  `Cant` int NOT NULL, -- Cantidad de veces
  `Dias` int, -- 1: Lunes, 2: Martes, 7: Domingo
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX FrecDep_index (Dni_id)  
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ExperienciaDeportiva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `DeporteActividad_id` int NOT NULL,
  `Frecuencia_id` int,
  `Fecha_desde` date NOT NULL,
  `Fecha_hasta` date,
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX ExpDep_index (Dni_id),
  INDEX DepActiv_index (DeporteActividad_id),
  INDEX Frec_index (Frecuencia_id),  
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni),
  FOREIGN KEY (DeporteActividad_id)
        REFERENCES DeporteActividad(id),    
  FOREIGN KEY (Frecuencia_id)
        REFERENCES FrecuenciaDeportiva(id)         
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Cuotas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Mes` int NOT NULL, -- 1: Enero, 2: Febrero, 12: Diciembre
  `Anio` int NOT NULL, -- YYYY: 2017, 2018
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX Cuotas_index (Dni_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Ejercicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Ficha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Ejercicio_id` int NOT NULL, 
  `Series` int NOT NULL, 
  `Repeticiones` int NOT NULL,
  `Activo` int, -- 1: Activo, 0: Inactivo
  `Kilaje_id` int,
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX Ficha_index (Dni_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Dieta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Desc` varchar(250) NOT NULL,
  `Detalle` varchar(450) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Dietas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Dieta_id` int NOT NULL, 
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX Dietas_index (Dni_id),
  INDEX Dieta_index (Dieta_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni),
  FOREIGN KEY (Dieta_id)
        REFERENCES Dieta(id)        
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Amigos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `Amigo_id` int NOT NULL, 
  `Detalle` varchar(250),
  PRIMARY KEY (`id`),
  INDEX Amigos_index (Dni_id),
  INDEX Amigo_index (Amigo_id),
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni),
  FOREIGN KEY (Amigo_id)
        REFERENCES Persons(Dni)        
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `EstudiosMedicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Dni_id` int NOT NULL,
  `TipoEstudio` int NOT NULL, -- 1: Electrocardiograma, 2: Radiografia, 3: Blabla
  `Estudio` varchar(250),
  `Fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  INDEX EstudiosMedicos_index (Dni_id),  
  FOREIGN KEY (Dni_id)
        REFERENCES Persons(Dni)       
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;




