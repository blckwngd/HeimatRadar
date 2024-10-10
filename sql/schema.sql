-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 10. Okt 2024 um 20:33
-- Server-Version: 8.0.32
-- PHP-Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `HeimatRadar`
--

CREATE TABLE `HeimatRadar` (
  `id` int NOT NULL,
  `name` varchar(256) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'Unbekannt',
  `strasse` varchar(256) CHARACTER SET utf8mb3 NOT NULL DEFAULT 'Unbekannt',
  `hausnummer` varchar(12) CHARACTER SET utf8mb3 NOT NULL,
  `telefon` varchar(64) CHARACTER SET utf8mb3 NOT NULL DEFAULT '-',
  `email` varchar(128) CHARACTER SET utf8mb3 NOT NULL DEFAULT '-',
  `teilnahme` varchar(16) CHARACTER SET utf8mb3 NOT NULL DEFAULT '0',
  `datenschutz` varchar(16) CHARACTER SET utf8mb3 NOT NULL DEFAULT '0',
  `anzahl` int NOT NULL DEFAULT '1',
  `angebot` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `kommentar` varchar(2048) CHARACTER SET utf8mb3 DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `wannErstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wannValidiert` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `HeimatRadar`
--
ALTER TABLE `HeimatRadar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `HeimatRadar`
--
ALTER TABLE `HeimatRadar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
