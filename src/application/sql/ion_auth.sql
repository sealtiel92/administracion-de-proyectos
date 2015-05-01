SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

CREATE TABLE IF NOT EXISTS `mydb`.`producto` (
  `idproducto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idproducto`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `cantidad` INT NULL,
  PRIMARY KEY (`idventa`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `activation_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_time` INT(11) UNSIGNED NULL DEFAULT NULL,
  `remember_code` VARCHAR(40) NULL DEFAULT NULL,
  `created_on` INT(11) UNSIGNED NOT NULL,
  `last_login` INT(11) UNSIGNED NULL DEFAULT NULL,
  `active` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`pedido` (
  `idpedido` INT NOT NULL AUTO_INCREMENT,
  `cantidad` INT NULL,
  `fechaInicial` DATE NULL,
  `fechaEntrega` DATE NULL,
  `idventa` INT NOT NULL,
  `idusers` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`idpedido`, `idventa`, `idusers`),
  INDEX `fk_pedido_venta1_idx` (`idventa` ASC),
  INDEX `fk_pedido_users1_idx` (`idusers` ASC),
  CONSTRAINT `fk_pedido_venta1`
    FOREIGN KEY (`idventa`)
    REFERENCES `mydb`.`venta` (`idventa`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fk_pedido_users1`
    FOREIGN KEY (`idusers`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`groups` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `activation_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_time` INT(11) UNSIGNED NULL DEFAULT NULL,
  `remember_code` VARCHAR(40) NULL DEFAULT NULL,
  `created_on` INT(11) UNSIGNED NOT NULL,
  `last_login` INT(11) UNSIGNED NULL DEFAULT NULL,
  `active` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`users_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_groups_users1_idx` (`user_id` ASC),
  INDEX `fk_users_groups_groups1_idx` (`group_id` ASC),
  UNIQUE INDEX `uc_users_groups` (`user_id` ASC, `group_id` ASC),
  CONSTRAINT `fk_users_groups_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE cascade,
  CONSTRAINT `fk_users_groups_groups1`
    FOREIGN KEY (`group_id`)
    REFERENCES `mydb`.`groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE cascade)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`login_attempts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `login` VARCHAR(100) NOT NULL,
  `time` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`detalle` (
  `idproducto` INT NOT NULL,
  `tipo` VARCHAR(45) NULL,
  `talla` VARCHAR(45) NULL,
  `marca` VARCHAR(45) NULL,
  `cantidad` INT NULL,
  `color` VARCHAR(45) NULL,
  INDEX `fk_detalle_producto1_idx` (`idproducto` ASC),
  CONSTRAINT `fk_detalle_producto1`
    FOREIGN KEY (`idproducto`)
    REFERENCES `mydb`.`producto` (`idproducto`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`utiliza` (
  `idpedido` INT NOT NULL,
  `idproducto` INT NOT NULL,
  PRIMARY KEY (`idpedido`, `idproducto`),
  INDEX `fk_pedido_has_producto_producto1_idx` (`idproducto` ASC),
  INDEX `fk_pedido_has_producto_pedido1_idx` (`idpedido` ASC),
  CONSTRAINT `fk_pedido_has_producto_pedido1`
    FOREIGN KEY (`idpedido`)
    REFERENCES `mydb`.`pedido` (`idpedido`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fk_pedido_has_producto_producto1`
    FOREIGN KEY (`idproducto`)
    REFERENCES `mydb`.`producto` (`idproducto`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
