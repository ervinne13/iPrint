-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema iPrint
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iPrint
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iPrint` DEFAULT CHARACTER SET utf8 ;
USE `iPrint` ;

-- -----------------------------------------------------
-- Table `iPrint`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`roles` (
  `code` VARCHAR(36) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`code`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_code` VARCHAR(36) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_roles1_idx` (`role_code` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_code`)
    REFERENCES `iPrint`.`roles` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`shops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`shops` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_owner_user_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(36) NOT NULL,
  `location_lat` VARCHAR(255) NULL,
  `location_long` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_shops_users1_idx` (`shop_owner_user_id` ASC),
  CONSTRAINT `fk_shops_users1`
    FOREIGN KEY (`shop_owner_user_id`)
    REFERENCES `iPrint`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_price` DOUBLE NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`uom`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`uom` (
  `code` VARCHAR(36) NOT NULL,
  `name` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`code`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`product_uom`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`product_uom` (
  `product_id` INT UNSIGNED NOT NULL,
  `uom_code` VARCHAR(36) NOT NULL,
  `price_per_uom` DOUBLE NOT NULL DEFAULT 1,
  PRIMARY KEY (`product_id`, `uom_code`),
  INDEX `fk_uom_has_products_products1_idx` (`product_id` ASC),
  INDEX `fk_uom_has_products_uom_idx` (`uom_code` ASC),
  CONSTRAINT `fk_uom_has_products_uom`
    FOREIGN KEY (`uom_code`)
    REFERENCES `iPrint`.`uom` (`code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uom_has_products_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `iPrint`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`job_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`job_orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` INT UNSIGNED NOT NULL,
  `requested_by_user_id` INT UNSIGNED NOT NULL,
  `status` VARCHAR(36) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_job_orders_shops1_idx` (`shop_id` ASC),
  INDEX `fk_job_orders_users1_idx` (`requested_by_user_id` ASC),
  CONSTRAINT `fk_job_orders_shops1`
    FOREIGN KEY (`shop_id`)
    REFERENCES `iPrint`.`shops` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_orders_users1`
    FOREIGN KEY (`requested_by_user_id`)
    REFERENCES `iPrint`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iPrint`.`job_order_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iPrint`.`job_order_products` (
  `job_order_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`job_order_id`, `product_id`),
  INDEX `fk_job_orders_has_products_products1_idx` (`product_id` ASC),
  INDEX `fk_job_orders_has_products_job_orders1_idx` (`job_order_id` ASC),
  CONSTRAINT `fk_job_orders_has_products_job_orders1`
    FOREIGN KEY (`job_order_id`)
    REFERENCES `iPrint`.`job_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_orders_has_products_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `iPrint`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `iPrint`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `iPrint`;
INSERT INTO `iPrint`.`roles` (`code`, `name`) VALUES ('ADMIN', 'Administrator');
INSERT INTO `iPrint`.`roles` (`code`, `name`) VALUES ('USER', 'User');
INSERT INTO `iPrint`.`roles` (`code`, `name`) VALUES ('STORE', 'Store Owner / Manager');

COMMIT;


-- -----------------------------------------------------
-- Data for table `iPrint`.`uom`
-- -----------------------------------------------------
START TRANSACTION;
USE `iPrint`;
INSERT INTO `iPrint`.`uom` (`code`, `name`) VALUES ('PC', 'Piece');
INSERT INTO `iPrint`.`uom` (`code`, `name`) VALUES ('UNIT', 'Unit');
INSERT INTO `iPrint`.`uom` (`code`, `name`) VALUES ('BOX', 'Box');

COMMIT;

