-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema graduacion
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema graduacion
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `graduacion` DEFAULT CHARACTER SET utf8 ;
USE `graduacion` ;

-- -----------------------------------------------------
-- Table `graduacion`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`rol` (
  `idRol` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NOT NULL,
  `descripción` TEXT(500) NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`personal` (
  `idPersonal` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `dirección` VARCHAR(45) NOT NULL,
  `teléfono` VARCHAR(45) NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idPersonal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`usuario` (
  `idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `contra` VARCHAR(80) NULL,
  `fechaRegistro` TIMESTAMP(6) NULL DEFAULT current_timestamp(6),
  `estado` TINYINT NOT NULL,
  `idRol` INT UNSIGNED NOT NULL,
  `idPersonal` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuario_Rol1_idx` (`idRol` ASC),
  INDEX `fk_usuario_personal1_idx` (`idPersonal` ASC),
  CONSTRAINT `fk_Usuario_Rol1`
    FOREIGN KEY (`idRol`)
    REFERENCES `graduacion`.`rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_personal1`
    FOREIGN KEY (`idPersonal`)
    REFERENCES `graduacion`.`personal` (`idPersonal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`diseño`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`diseño` (
  `idDiseño` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripción` TEXT(500) NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idDiseño`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`color` (
  `idColor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `color` VARCHAR(45) NOT NULL,
  `descripción` TEXT(500) NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idColor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`productos` (
  `idProducto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idDiseño` INT NOT NULL,
  `idColor` INT UNSIGNED NOT NULL,
  `imagen` VARCHAR(100) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `cantidad` INT NOT NULL,
  `descripción` TEXT(500) NULL,
  `idUsuario` INT UNSIGNED NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idProducto`),
  INDEX `fk_Producto_Usuario1_idx` (`idUsuario` ASC),
  INDEX `fk_Producto_Diseño1_idx` (`idDiseño` ASC),
  INDEX `fk_producto_color1_idx` (`idColor` ASC),
  CONSTRAINT `fk_Producto_Usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `graduacion`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_Diseño1`
    FOREIGN KEY (`idDiseño`)
    REFERENCES `graduacion`.`diseño` (`idDiseño`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_color1`
    FOREIGN KEY (`idColor`)
    REFERENCES `graduacion`.`color` (`idColor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`tipoHilos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`tipoHilos` (
  `idTipoHilo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTipoHilo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`hilos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`hilos` (
  `idHilo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idColor` INT UNSIGNED NOT NULL,
  `código` VARCHAR(45) NOT NULL,
  `idTipoHilo` INT UNSIGNED NOT NULL,
  `cantidad` INT NOT NULL DEFAULT 0,
  `descripción` TEXT(500) NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idHilo`),
  INDEX `fk_hilos_color1_idx` (`idColor` ASC),
  INDEX `fk_hilos_tipoHilos1_idx` (`idTipoHilo` ASC),
  CONSTRAINT `fk_hilos_color1`
    FOREIGN KEY (`idColor`)
    REFERENCES `graduacion`.`color` (`idColor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hilos_tipoHilos1`
    FOREIGN KEY (`idTipoHilo`)
    REFERENCES `graduacion`.`tipoHilos` (`idTipoHilo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`telas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`telas` (
  `idTela` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idColor` INT UNSIGNED NOT NULL,
  `cantidad` INT NOT NULL,
  `descripción` TEXT(500) NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTela`),
  INDEX `fk_telas_color1_idx` (`idColor` ASC),
  CONSTRAINT `fk_telas_color1`
    FOREIGN KEY (`idColor`)
    REFERENCES `graduacion`.`color` (`idColor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`actProd`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`actProd` (
  `idActProd` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idProducto` INT UNSIGNED NOT NULL,
  `tipo` CHAR(1) NOT NULL,
  `ingreso` INT NULL,
  `egreso` INT NULL,
  `precio` DECIMAL(10) NULL,
  `fechaActualización` TIMESTAMP(6) NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`idActProd`),
  INDEX `fk_agregarProd_producto1_idx` (`idProducto` ASC),
  CONSTRAINT `fk_agregarProd_producto1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `graduacion`.`productos` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`actHilos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`actHilos` (
  `idActHilo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idHilo` INT UNSIGNED NOT NULL,
  `tipo` CHAR(1) NOT NULL,
  `ingreso` INT NULL,
  `egreso` INT NULL,
  `fechaActualización` TIMESTAMP(6) NULL DEFAULT current_timestamp(6),
  `idUsuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idActHilo`),
  INDEX `fk_actHilos_usuario1_idx` (`idUsuario` ASC),
  INDEX `fk_actHilos_hilos1_idx` (`idHilo` ASC),
  CONSTRAINT `fk_actHilos_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `graduacion`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actHilos_hilos1`
    FOREIGN KEY (`idHilo`)
    REFERENCES `graduacion`.`hilos` (`idHilo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`actTelas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`actTelas` (
  `idActTela` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idTela` INT UNSIGNED NOT NULL,
  `tipo` CHAR(1) NOT NULL,
  `ingreso` INT NULL,
  `egreso` INT NULL,
  `fechaActualización` TIMESTAMP(6) NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`idActTela`),
  INDEX `fk_actTelas_telas1_idx` (`idTela` ASC),
  CONSTRAINT `fk_actTelas_telas1`
    FOREIGN KEY (`idTela`)
    REFERENCES `graduacion`.`telas` (`idTela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`modulo` (
  `idModulo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `título` VARCHAR(45) NULL,
  `descripción` VARCHAR(45) NULL,
  `estado` INT(1) NULL,
  PRIMARY KEY (`idModulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `graduacion`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `graduacion`.`permisos` (
  `idPermisos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idRol` INT UNSIGNED NOT NULL,
  `idModulo` INT UNSIGNED NOT NULL,
  `insertar` INT(1) NOT NULL,
  `consultar` INT(1) NOT NULL,
  `actualizar` INT(1) NOT NULL,
  `eliminar` INT(1) NOT NULL,
  PRIMARY KEY (`idPermisos`),
  INDEX `fk_permisos_rol1_idx` (`idRol` ASC),
  INDEX `fk_permisos_modulo1_idx` (`idModulo` ASC),
  CONSTRAINT `fk_permisos_rol1`
    FOREIGN KEY (`idRol`)
    REFERENCES `graduacion`.`rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_modulo1`
    FOREIGN KEY (`idModulo`)
    REFERENCES `graduacion`.`modulo` (`idModulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `graduacion` ;

-- -----------------------------------------------------
-- procedure agregarPersonal
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarPersonal(_nombre varchar( 45), _apellido varchar( 20),  _teléfono varchar( 8), _dirección varchar( 45))
begin
	insert into personal(idPersonal, nombre, apellido, teléfono, dirección) 
    values
	(null, _nombre, _apellido, _teléfono, _dirección);
	select 1, 'success' as respuesta, 'Personal guardado' as mensaje;

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarDiseño
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarDiseño(_nombre varchar ( 45), _descripción text( 500), _idUsuario int)
begin
	insert into diseño(idDiseño, nombre, descripción, idUsuario)
    values
    (null, _nombre, _descripción, _idUsuario);
    select 1, 'success' as respuesta, 'Diseño guardado' as mensaje;
    
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarProducto
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarProducto(_idDiseño int, _idColor int, _precio decimal( 10), _cantidad int, _descripción text( 500), _idUsuario int)
begin
	insert into producto(idProducto, idDiseño, idColor, precio, cantidad, descripción, idUsuario)
    values
    (null, _idDiseño, _idColor, _precio, _cantidad, _descripción, _idUsuario);
    select 1, 'success' as respuesta, 'Producto agregado' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarColor
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarColor(_color varchar( 45), _descripción text( 500), _idUsuario int)
begin
	insert into color(idColor, color, descripción, idUsuario)
    values
    (null, _color, _descripción, _idUsuario);
    select 1, 'success' as respuesta, 'Color guardado' as mensaje;
    
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarHilos
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarHilos(_idColor int, _código varchar( 45), _idTipoHilos int, _cantidad int, _descripción text( 500), _idUsuario int)
begin
	insert into hilos(idHilos, idColor, código, idTipoHilos, cantidad, descripción, idUsuario)
    values
    (null, _idColor, _código, _idTipoHilos, _cantidad, _descripción, _idUsuario);
    select 1, 'success' as respuesta, 'Hilo agregado correctamente' as mensaje;

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarTelas
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarTelas(_idColor int, _cantidad int, _descripción text( 500), _idUsuario int)
begin
	insert into telas(idTelas, idColor, cantidad, descripción, idUsuario)
    values
    (null, _idColor, _cantidad, _descripción, _idUsuario);
    select 1, 'success' as respuesta, 'Tela agregada Correctamente' as mensaje;

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure actualizarProducto
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
-- para actualizar productos
create procedure actualizarProducto(_idDeProducto int, _cantidad int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actProd(idActProd, idDeProducto, cantidad, fechaActualización, idUsuario) 
    values
	(null, _idDeProducto, _cantidad, now(), _idUsuario);
	select 1, 'success' as respuesta, 'actualizacion de producto guardada' as mensaje;

end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure actualizarHilos
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure actualizarHilos(_idDeHilos int, _cantidad int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actHilos(idActHilos, idDeHilos, cantidad, fechaActualización, idUsuario)
    values
    (null, _idDeHilos, _cantidad, now(), _idUsuario);
    select 1, 'success' as respuesta, 'actualización de hilos guardada' as mensaje;
    
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure actualizarTelas
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure actualizarTelas(_idDeTelas int, _cantidad int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actTelas(idActTelas, idDeTelas, cantidad, fechaActualización, idUsuario)
    values
    (null, _idDeTelas, _cantidad, now(), _idUsuario);
    select 1, 'success' as respuesta, 'actualización de hilos guardada' as mensaje;
    
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sumarProducto
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
-- para actualizar productos
create procedure sumarProducto(_idProducto int, _tipo char( 1), _ingreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actProd(idActProd, idProducto, tipo, ingreso, egreso, precio, fechaActualización, idUsuario) 
    values
	(null, _idProducto, _tipo, _ingreso, null, null, now(), _idUsuario);
	select 1, 'success' as respuesta, 'actualizacion de producto guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sumarHilos
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure sumarHilos(_idHilos int, _tipo char(1), _ingreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actHilos(idActHilos, idHilos, tipo, ingreso, egreso, fechaActualización, idUsuario)
    values
    (null, _idHilos, _tipo, _ingreso, null, _fechaActualización, _idUsuario);
    select 1, 'success' as respuesta, 'suma de hilos guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sumarTelas
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure sumarTelas(_idTelas int, _tipo char(1), _ingreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actTelas(idActTelas, idTelas, tipo, ingreso, egreso, fechaActualización, idUsuario)
    values
    (null, _idTelas, _tipo, _ingreso, null, _fechaActualización, _idUsuario);
    select 1, 'success' as respuesta, 'suma de telas guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure agregarTipoHilos
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure agregarTipoHilos(_tipo varchar( 45))
begin
	insert into tipoHilos(idTipoHilos, tipo)
    values
    (null, _tipo);
    select 1, 'success' as respuesta, 'Tipo de hilo agregado' as mensaje;
    
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure restarProducto
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure restarProducto(_idProducto int, _tipo char(1), _egreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actProd(idActProd, idProducto, tipo, ingreso, egreso, precio, fechaActualización, idUsuario)
    values
    (null, _idProducto, _tipo, null, _egreso, null, now(), _idUsuario);
    select 1, 'success' as respuesta, 'resta de productos guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure restarHilos
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure restarHilos(_idHilos int, _tipo char(1), _egreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actHilos(idActHilos, idHilos, tipo, ingreso, egreso, fechaActualización, idUsuario)
    values
    (null, _idHilos, _tipo, null, _egreso, _fechaActualización, _idUsuario);
    select 1, 'success' as respuesta, 'resta de hilos guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure restarTelas
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure restarTelas(_idTelas int, _tipo char(1), _egreso int, _fechaActualización timestamp( 6), _idUsuario int)
begin
	insert into actTelas(idActTelas, idTelas, tipo, ingreso, egreso, fechaActualización, idUsuario)
    values
    (null, _idTelas, _tipo, null, _egreso, _fechaActualización, _idUsuario);
    select 1, 'success' as respuesta, 'resta de telas guardada' as mensaje;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure actualizarPrecios
-- -----------------------------------------------------

DELIMITER $$
USE `graduacion`$$
create procedure actualizarPrecios(_idProducto int, _tipo char(1), _precio decimal( 10), _fechaActualización timestamp( 6), _idUsuario int)
begin
    insert into actProd(idActProd, idProducto, tipo, ingreso, egreso, precio, fechaActualización, idUsuario)
    values
    (null, _idProducto, _tipo, null, null, _precio, now(), _idUsuario);
    select 1, 'success' as respuesta, 'precio actualizado' as mensaje;
end$$

DELIMITER ;
USE `graduacion`;

DELIMITER $$
USE `graduacion`$$
CREATE DEFINER = CURRENT_USER TRIGGER `graduacion`.`actProd_AFTER_INSERT` AFTER INSERT ON `actProd` FOR EACH ROW
BEGIN
	if(new.tipo = '1') then
		update producto set cantidad = cantidad + new.ingreso where idProducto = new.idProducto;
	end if;
	if(new.tipo = '2') then
		update producto set cantidad = cantidad - new.egreso where idProducto = new.idProducto;
	end if;
	if(new.tipo = '3') then
		update producto set precio = new.precio where idProducto = new.idProducto;
	end if;
END$$

USE `graduacion`$$
CREATE DEFINER = CURRENT_USER TRIGGER `graduacion`.`actHilos_AFTER_INSERT` AFTER INSERT ON `actHilos` FOR EACH ROW
BEGIN
	if(new.tipo = '1') then
		update hilos set cantidad = cantidad + new.ingreso where idHilos = new.idHilo;
    end if;
    if(new.tipo = '2') then
		update hilos set cantidad = cantidad - new.egreso where idHilos = new.idHilo;
    end if;
END$$

USE `graduacion`$$
CREATE DEFINER = `root`@`127.0.0.1` TRIGGER `graduacion`.`actTelas_AFTER_INSERT` AFTER INSERT ON `actTelas` FOR EACH ROW
BEGIN
	if(new.tipo = '1') then
		update telas set cantidad = cantidad + new.ingreso where idTela = new.idTela;
	end if;
    if(new.tipo = '2') then
		update telas set cantidad = cantidad - new.egreso where idTela = new.idTela;
	end if;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `graduacion`.`rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`rol` (`idRol`, `rol`, `descripción`, `estado`) VALUES (1, 'Administrador', 'Control total del sistema', 1);
INSERT INTO `graduacion`.`rol` (`idRol`, `rol`, `descripción`, `estado`) VALUES (2, 'Moderador', 'Acceo restringido a usuarios y permisos', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`personal`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`personal` (`idPersonal`, `nombre`, `apellido`, `dirección`, `teléfono`, `status`) VALUES (1, 'Pedro', 'Say', 'Totonicapán', '12345678', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`usuario` (`idUsuario`, `usuario`, `contra`, `fechaRegistro`, `estado`, `idRol`, `idPersonal`) VALUES (1, 'adminPedro', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', '2008-05-31 20:06:50', 1, 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`diseño`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`diseño` (`idDiseño`, `nombre`, `descripción`, `status`) VALUES (1, 'Colibrí', 'Diseño', 1);
INSERT INTO `graduacion`.`diseño` (`idDiseño`, `nombre`, `descripción`, `status`) VALUES (2, 'Cuello V', 'Diseño', 1);
INSERT INTO `graduacion`.`diseño` (`idDiseño`, `nombre`, `descripción`, `status`) VALUES (3, 'Cuello cuadrado', 'Diseño', 1);
INSERT INTO `graduacion`.`diseño` (`idDiseño`, `nombre`, `descripción`, `status`) VALUES (4, 'Palomitas', 'Diseño', 1);
INSERT INTO `graduacion`.`diseño` (`idDiseño`, `nombre`, `descripción`, `status`) VALUES (5, 'Rosas nudo', 'Diseño', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`color`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (1, 'Blanco', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (2, 'Negro', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (3, 'Café', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (4, 'Verde', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (5, 'Amarillo', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (6, 'Azul', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (7, 'Rojo', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (8, 'Celeste', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (9, 'Naranja', 'Color', 1);
INSERT INTO `graduacion`.`color` (`idColor`, `color`, `descripción`, `status`) VALUES (10, 'Fusia', 'Color', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`tipoHilos`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`tipoHilos` (`idTipoHilo`, `tipo`, `status`) VALUES (1, 'Poliester', DEFAULT);
INSERT INTO `graduacion`.`tipoHilos` (`idTipoHilo`, `tipo`, `status`) VALUES (2, 'Lana', DEFAULT);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`hilos`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`hilos` (`idHilo`, `idColor`, `código`, `idTipoHilo`, `cantidad`, `descripción`, `status`) VALUES (1, 1, '7876', 1, 15, 'Hilos', 1);
INSERT INTO `graduacion`.`hilos` (`idHilo`, `idColor`, `código`, `idTipoHilo`, `cantidad`, `descripción`, `status`) VALUES (2, 2, '99787', 1, 10, 'Hilos', 1);
INSERT INTO `graduacion`.`hilos` (`idHilo`, `idColor`, `código`, `idTipoHilo`, `cantidad`, `descripción`, `status`) VALUES (3, 3, '2332', 1, 25, 'Hilos', 1);
INSERT INTO `graduacion`.`hilos` (`idHilo`, `idColor`, `código`, `idTipoHilo`, `cantidad`, `descripción`, `status`) VALUES (4, 1, '543', 2, 12, 'Hilos', 1);
INSERT INTO `graduacion`.`hilos` (`idHilo`, `idColor`, `código`, `idTipoHilo`, `cantidad`, `descripción`, `status`) VALUES (5, 3, '9877', 2, 34, 'Hilos', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`telas`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`telas` (`idTela`, `idColor`, `cantidad`, `descripción`, `status`) VALUES (1, 10, 24, 'Telas', DEFAULT);
INSERT INTO `graduacion`.`telas` (`idTela`, `idColor`, `cantidad`, `descripción`, `status`) VALUES (2, 6, 8, 'Telas', DEFAULT);
INSERT INTO `graduacion`.`telas` (`idTela`, `idColor`, `cantidad`, `descripción`, `status`) VALUES (3, 2, 7, 'Telas', DEFAULT);
INSERT INTO `graduacion`.`telas` (`idTela`, `idColor`, `cantidad`, `descripción`, `status`) VALUES (4, 9, 23, 'Telas', DEFAULT);
INSERT INTO `graduacion`.`telas` (`idTela`, `idColor`, `cantidad`, `descripción`, `status`) VALUES (5, 4, 2, 'Telas', DEFAULT);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`modulo`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`modulo` (`idModulo`, `título`, `descripción`, `estado`) VALUES (1, 'Principal', 'Vista principal del sistema', 1);
INSERT INTO `graduacion`.`modulo` (`idModulo`, `título`, `descripción`, `estado`) VALUES (2, 'Usuarios', 'Usuarios, personal, permisos, roles', 1);
INSERT INTO `graduacion`.`modulo` (`idModulo`, `título`, `descripción`, `estado`) VALUES (3, 'Materiales', 'acceso a telas, hilos', 1);
INSERT INTO `graduacion`.`modulo` (`idModulo`, `título`, `descripción`, `estado`) VALUES (4, 'Productos', 'ingreso de productos', 1);
INSERT INTO `graduacion`.`modulo` (`idModulo`, `título`, `descripción`, `estado`) VALUES (5, 'Complementos', 'diseños, telas, colores,', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `graduacion`.`permisos`
-- -----------------------------------------------------
START TRANSACTION;
USE `graduacion`;
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (1, 1, 1, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (2, 1, 2, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (3, 1, 3, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (4, 1, 4, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (5, 1, 5, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (6, 2, 1, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (7, 2, 2, 0, 0, 0, 0);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (8, 2, 3, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (9, 2, 4, 1, 1, 1, 1);
INSERT INTO `graduacion`.`permisos` (`idPermisos`, `idRol`, `idModulo`, `insertar`, `consultar`, `actualizar`, `eliminar`) VALUES (10, 2, 5, 1, 1, 1, 1);

COMMIT;

