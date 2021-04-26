-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pi3
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pi3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pi3` DEFAULT CHARACTER SET utf8 ;
USE `pi3` ;

-- -----------------------------------------------------
-- Table `pi3`.`genero_filme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`genero_filme` (
  `idgenero_filme` INT NOT NULL AUTO_INCREMENT,
  `desc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idgenero_filme`),
  UNIQUE INDEX `idgenero_filme_UNIQUE` (`idgenero_filme` ASC) VISIBLE,
  UNIQUE INDEX `desc_UNIQUE` (`desc` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`filme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`filme` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(75) NOT NULL,
  `sinopse` TEXT NOT NULL,
  `lancamento` DATE NOT NULL,
  `genero` INT NOT NULL,
  `imagem` TEXT NOT NULL,
  `tipo` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_filme_genero_idx` (`genero` ASC) VISIBLE,
  CONSTRAINT `fk_filme_genero`
    FOREIGN KEY (`genero`)
    REFERENCES `pi3`.`genero_filme` (`idgenero_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`tipo_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`tipo_pessoa` (
  `idtipo_pessoa` INT NOT NULL AUTO_INCREMENT,
  `desc_tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipo_pessoa`),
  UNIQUE INDEX `idtipo_pessoa_UNIQUE` (`idtipo_pessoa` ASC) VISIBLE,
  UNIQUE INDEX `desc_tipo_UNIQUE` (`desc_tipo` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`pessoa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `loc_nasc` VARCHAR(45) NOT NULL,
  `foto` TEXT NOT NULL,
  `tipo` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idator_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_pessoa_tipo_idx` (`tipo` ASC) VISIBLE,
  CONSTRAINT `fk_pessoa_tipo`
    FOREIGN KEY (`tipo`)
    REFERENCES `pi3`.`tipo_pessoa` (`idtipo_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`estudio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`estudio` (
  `idestudio` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `local` VARCHAR(45) NOT NULL,
  `imagem` TEXT NOT NULL,
  PRIMARY KEY (`idestudio`),
  UNIQUE INDEX `idestudio_UNIQUE` (`idestudio` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`status_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`status_conta` (
  `idstatus_conta` INT NOT NULL AUTO_INCREMENT,
  `desc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idstatus_conta`),
  UNIQUE INDEX `idstatus_conta_UNIQUE` (`idstatus_conta` ASC) VISIBLE,
  UNIQUE INDEX `desc_UNIQUE` (`desc` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`usuário`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`usuário` (
  `idusuário` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `img_perfil` TEXT NOT NULL,
  `reputacao` INT NOT NULL,
  `status_conta` INT NOT NULL,
  `tipo_usuario` INT NOT NULL,
  PRIMARY KEY (`idusuário`),
  UNIQUE INDEX `idusuário_UNIQUE` (`idusuário` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `fk_usuario_status_idx` (`status_conta` ASC) VISIBLE,
  INDEX `fk_usuario_tipo_idx` (`tipo_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_status`
    FOREIGN KEY (`status_conta`)
    REFERENCES `pi3`.`status_conta` (`idstatus_conta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo`
    FOREIGN KEY (`tipo_usuario`)
    REFERENCES `pi3`.`tipo_pessoa` (`idtipo_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`resenha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`resenha` (
  `idresenha` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `subtitulo` VARCHAR(100) NOT NULL,
  `pontuacao` INT NOT NULL,
  `autor` INT NOT NULL,
  `conteudo` TEXT NOT NULL,
  `data_pub` DATE NOT NULL,
  `filme` INT NOT NULL,
  PRIMARY KEY (`idresenha`),
  UNIQUE INDEX `idresenha_UNIQUE` (`idresenha` ASC) VISIBLE,
  INDEX `fk_resenha_autor_idx` (`autor` ASC) VISIBLE,
  INDEX `fk_resenha_filme_idx` (`filme` ASC) VISIBLE,
  CONSTRAINT `fk_resenha_autor`
    FOREIGN KEY (`autor`)
    REFERENCES `pi3`.`usuário` (`idusuário`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_resenha_filme`
    FOREIGN KEY (`filme`)
    REFERENCES `pi3`.`filme` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`filme_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`filme_pessoa` (
  `filme` INT NOT NULL,
  `pessoa` INT NOT NULL,
  INDEX `fk_filme_pessoa_filme_idx` (`filme` ASC) VISIBLE,
  INDEX `fk_filme_pessoa_pessoa_idx` (`pessoa` ASC) VISIBLE,
  CONSTRAINT `fk_filme_pessoa_filme`
    FOREIGN KEY (`filme`)
    REFERENCES `pi3`.`filme` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filme_pessoa_pessoa`
    FOREIGN KEY (`pessoa`)
    REFERENCES `pi3`.`pessoa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pi3`.`filme_estudio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pi3`.`filme_estudio` (
  `filme_id` INT NOT NULL,
  `estudio_id` INT NOT NULL,
  PRIMARY KEY (`filme_id`, `estudio_id`),
  INDEX `fk_filme_has_estudio_estudio1_idx` (`estudio_id` ASC) VISIBLE,
  INDEX `fk_filme_has_estudio_filme1_idx` (`filme_id` ASC) VISIBLE,
  CONSTRAINT `fk_filme_has_estudio_filme1`
    FOREIGN KEY (`filme_id`)
    REFERENCES `pi3`.`filme` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filme_has_estudio_estudio1`
    FOREIGN KEY (`estudio_id`)
    REFERENCES `pi3`.`estudio` (`idestudio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
