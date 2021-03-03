-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 17, 2021 alle 14:00
-- Versione del server: 8.0.21
-- Versione PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenzia_immobiliare`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annessi`
--

DROP TABLE IF EXISTS `annessi`;
CREATE TABLE IF NOT EXISTS `annessi` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `codI` char(9) NOT NULL,
  `tipo` varchar(32) NOT NULL,
  `num` int NOT NULL,
  PRIMARY KEY (`ID`,`codI`),
  KEY `codI` (`codI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `immobili`
--

DROP TABLE IF EXISTS `immobili`;
CREATE TABLE IF NOT EXISTS `immobili` (
  `codI` char(9) NOT NULL,
  `Tipo` varchar(32) NOT NULL,
  `m_quadri` int NOT NULL,
  `stanze` int NOT NULL,
  `dataCost` date NOT NULL,
  `prezzo` double DEFAULT NULL,
  PRIMARY KEY (`codI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `proprietari`
--

DROP TABLE IF EXISTS `proprietari`;
CREATE TABLE IF NOT EXISTS `proprietari` (
  `codP` char(7) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `dataNascita` date NOT NULL,
  PRIMARY KEY (`codP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `proprietà`
--

DROP TABLE IF EXISTS `proprietà`;
CREATE TABLE IF NOT EXISTS `proprietà` (
  `Immobile` char(9) NOT NULL,
  `Proprietario` char(7) NOT NULL,
  PRIMARY KEY (`Immobile`,`Proprietario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `annessi`
--
ALTER TABLE `annessi`
  ADD CONSTRAINT `annessi_ibfk_1` FOREIGN KEY (`codI`) REFERENCES `immobili` (`codI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
