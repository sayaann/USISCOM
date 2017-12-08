SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `USISCOM` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `USISCOM` ;

-- -----------------------------------------------------
-- Table `USISCOM`.`Artículo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `USISCOM`.`Artículo` (
  `idArtículo` INT NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(45) NULL ,
  `Descripción` VARCHAR(45) NULL ,
  `Precio` DOUBLE NULL ,
  `Unidades` INT NULL ,
  `Imagen` VARCHAR(45) NULL ,
  PRIMARY KEY (`idArtículo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `USISCOM`.`Pedido`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `USISCOM`.`Pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT ,
  `Nombre_cliente` VARCHAR(45) NULL ,
  `Institucion_cliente` VARCHAR(45) NULL ,
  `Fecha` DATE NULL ,
  `Costo` DOUBLE NULL ,
  PRIMARY KEY (`idPedido`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `USISCOM`.`Pedido_Artículo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `USISCOM`.`Pedido_Artículo` (
  `idArtículo` INT NOT NULL ,
  `idPedido` INT NOT NULL ,
  `Cantidad` DOUBLE NULL ,
  INDEX `idPedido_idx` (`idPedido` ASC) ,
  CONSTRAINT `idArtículo`
    FOREIGN KEY (`idArtículo` )
    REFERENCES `USISCOM`.`Artículo` (`idArtículo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `idPedido`
    FOREIGN KEY (`idPedido` )
    REFERENCES `USISCOM`.`Pedido` (`idPedido` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `USISCOM`.`Venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `USISCOM`.`Venta` (
  `idVenta` INT NOT NULL ,
  `Fecha_inicio` DATE NULL ,
  `Fecha_fin` DATE NULL ,
  `Repartidor` VARCHAR(45) NULL ,
  `Estatus` INT NULL ,
  `idPedido` INT NULL ,
  PRIMARY KEY (`idVenta`) ,
  INDEX `idPedido_idx` (`idPedido` ASC) ,
  CONSTRAINT `idPedido`
    FOREIGN KEY (`idPedido` )
    REFERENCES `USISCOM`.`Pedido` (`idPedido` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `USISCOM` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
