-- Creator: Herzig Melvyn.
-- Version: 24.05.2018.
-- Environment: Created for MySQL.
-- Script made for: Create the database for web site Trip Planner

-- --------------------------------------
-- Drop the schema if he already exists.
-- Create the schema.
-- --------------------------------------
-- DROP SCHEMA IF EXISTS `tripplanne_db`;
CREATE SCHEMA `tripplanne_db`;
USE `tripplanne_db`;

-- ---------------------------
-- Create the User table.
-- ---------------------------
DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
    `idUser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Nickname` VARCHAR(20) NOT NULL,
    `Email` VARCHAR(45) NOT NULL,
    `Password` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`idUser`),
    UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC)
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;

-- ---------------------------
-- Create the Trip table.
-- ---------------------------
DROP TABLE IF EXISTS `Trip`;
CREATE TABLE IF NOT EXISTS `Trip` (
    `idTrip` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fkUser_Organizer` INT UNSIGNED NOT NULL,
    `Title` VARCHAR(45) NOT NULL,
    `Destination` VARCHAR(45) NOT NULL,
    `Private` TINYINT(1) NOT NULL DEFAULT 1,
    `Password` VARCHAR(60) NULL,
    `Image` TINYINT(1) NOT NULL DEFAULT 0,
    `Creation` DATE NOT NULL,
    `Date_Start` DATE NOT NULL,
    `Date_End` DATE NOT NULL,
    PRIMARY KEY (`idTrip`),
    UNIQUE INDEX `idTrip_UNIQUE` (`idTrip` ASC),
    INDEX `fk_User_Organizer_Id` (`fkUser_Organizer` ASC),
    CONSTRAINT `fk_Trip_User`
    FOREIGN KEY (`fkUser_Organizer`)
    REFERENCES `User` (`idUser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------
-- Create the Transport type table.
-- --------------------------------
DROP TABLE IF EXISTS `Transport_Type`;
CREATE TABLE IF NOT EXISTS `Transport_Type` (
    `idTransport_Type` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Type` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idTransport_Type`),
    UNIQUE INDEX `idTransport_Type_UNIQUE` (`idTransport_Type` ASC)
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO Transport_Type (Type)
VALUES ("Avion"),
("Bateau"),
("Bus"),
("Marche"),
("Métro"),
("Train"),
("Tram"),
("Voiture"),
("Vélo"),
("Autre");

-- ---------------------------
-- Create the Transport table.
-- ---------------------------
DROP TABLE IF EXISTS `Transport`;
CREATE TABLE IF NOT EXISTS `Transport` (
    `idTransport` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fkTrip` INT UNSIGNED NOT NULL,
    `fkTransport_Type` TINYINT UNSIGNED NOT NULL,
    `Place_Start` VARCHAR(45) NOT NULL,
    `Place_End` VARCHAR(45) NOT NULL,
    `Day_Start` DATE NOT NULL,
    `Day_End` DATE NOT NULL,
    `Time_Start` TIME NULL,
    `Time_End` TIME NULL,
    `Price` FLOAT(10,2) UNSIGNED NOT NULL DEFAULT 0,
    `Link` VARCHAR(255) NULL,
    `Code` VARCHAR(45) NULL,
    `Note` VARCHAR(280) NULL,
    `Image` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`idTransport`),
    INDEX `fk_Transport_Trip_Id` (`fkTrip` ASC),
    CONSTRAINT `fk_Transport_Trip`
    FOREIGN KEY (`fkTrip`)
    REFERENCES `Trip` (`idTrip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    CONSTRAINT `fk_Transport_Transport_Type`
    FOREIGN KEY (`fkTransport_Type`)
    REFERENCES `Transport_Type` (`idTransport_Type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------
-- Create the Lodging type table.
-- --------------------------------
DROP TABLE IF EXISTS `Lodging_Type`;
CREATE TABLE IF NOT EXISTS `Lodging_Type` (
    `idLodging_Type` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Type` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idLodging_Type`)
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;


INSERT INTO Lodging_Type (Type)
VALUES("Appartement"),
("Auberge de jeunesse"),
("Camping"),
("Hôtel"),
("Maison"),
("Cabane"),
("Autre");

-- ---------------------------
-- Create the Lodging table.
-- ---------------------------
DROP TABLE IF EXISTS `Lodging`;
CREATE TABLE IF NOT EXISTS `Lodging`(
    `idLodging` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fkLodging_Type` TINYINT UNSIGNED NOT NULL,
    `fkTrip` INT UNSIGNED NOT NULL,
    `Address` VARCHAR(45) NOT NULL,
    `Day_Start` DATE NOT NULL,
    `Day_End` DATE NOT NULL,
    `Price` FLOAT(10,2) NOT NULL DEFAULT 0,
    `Code` VARCHAR(45) NULL,
    `Link` VARCHAR(255) NULL,
    `Note` VARCHAR(280) NULL,
    `Image` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`idLodging`),
    INDEX `fk_Lodging_Trip_Id` (`fkTrip` ASC),
    CONSTRAINT `fk_Lodging_Lodging_Type`
    FOREIGN KEY (`fkLodging_Type`)
    REFERENCES `Lodging_Type` (`idLodging_Type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Lodging_Trip`
    FOREIGN KEY (`fkTrip`)
    REFERENCES `Trip` (`idTrip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;


-- ---------------------------
-- Create the Activity table
-- ---------------------------
DROP TABLE IF EXISTS `Activity`;
CREATE TABLE IF NOT EXISTS `Activity` (
    `idActivity` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fkTrip` INT UNSIGNED NOT NULL,
    `Description` VARCHAR(45) NOT NULL,
    `Price` FLOAT(10,2) UNSIGNED NOT NULL DEFAULT 0,
    `Date` DATE NULL,
    `Link` VARCHAR(255) NULL,
    `Note` VARCHAR(280) NULL,
    `Image` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`idActivity`),
    INDEX `fk_Activity_Trip_Id` (`fkTrip` ASC),
    CONSTRAINT `fk_Activity_Trip`
    FOREIGN KEY (`fkTrip`)
    REFERENCES `Trip` (`idTrip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;


-- ---------------------------
-- Create the prerequisites table
-- ---------------------------
DROP TABLE IF EXISTS `Prerequisite`;
CREATE TABLE IF NOT EXISTS `Prerequisite` (
    `idPrerequisite` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(45) NOT NULL,
    `Quantity` SMALLINT UNSIGNED NULL,
    `fkTrip` INT UNSIGNED NOT NULL,
    `Ready` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`idPrerequisite`),
    INDEX `fk_Item_Trip_Id` (`fkTrip` ASC),
    CONSTRAINT `fk_Item_Trip`
    FOREIGN KEY (`fkTrip`)
    REFERENCES `Trip` (`idTrip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;


-- ---------------------------
-- Create the Participant table
-- ---------------------------
DROP TABLE IF EXISTS `Participant`;
CREATE TABLE IF NOT EXISTS `Participant` (
    `fkTrip` INT UNSIGNED NOT NULL,
    `fkUser` INT UNSIGNED NOT NULL,
    `Waiting` TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (`fkTrip`, `fkUser`),
    INDEX `fk_Participant_User_Id` (`fkUser` ASC),
    INDEX `fk_Participant_Trip_Id` (`fkTrip` ASC),
    CONSTRAINT `fk_Participant_Trip`
    FOREIGN KEY (`fkTrip`)
    REFERENCES `Trip` (`idTrip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    CONSTRAINT `fk_Participant_User`
    FOREIGN KEY (`fkUser`)
    REFERENCES `User` (`idUser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE = InnoDB  DEFAULT CHARSET=utf8;

