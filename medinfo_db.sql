-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               8.0.30 - MySQL Community Server - GPL
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Zrzut struktury bazy danych medinfo
CREATE DATABASE IF NOT EXISTS `medinfo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `medinfo`;

-- Zrzut struktury tabela medinfo.address
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voivodeship` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_number` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_number` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.address: ~5 rows (około)
INSERT INTO `address` (`id`, `country`, `voivodeship`, `city`, `zip_code`, `street`, `building_number`, `apartment_number`) VALUES
	(1, 'Polska', 'Zachodniopomorskie', 'Szczecin', '71-610', 'Stanislawa Dubois', '27', '5'),
	(2, 'Polska', 'Zachodniopomorskie', 'Police', '72-009', 'Odrzanska', '13', NULL),
	(3, 'Polska', 'Zachodniopomorskie', 'Szczecin', '71-899', 'Monte Cassino', '17A', '9'),
	(4, 'Polska', 'Zachodniopomorskie', 'Kobylanka', '73-110', 'Bukowa', '14', '2'),
	(6, 'Polska', 'Zachodniopomorskie', 'Kołobrzeg', '11-111', 'Morska', '2', '3');

-- Zrzut struktury tabela medinfo.appointment
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_patient_id` int NOT NULL,
  `has_happened` tinyint(1) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `id_dialysis_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FE38F844F2D87AF3` (`id_dialysis_id`),
  KEY `IDX_FE38F844CE0312AE` (`id_patient_id`),
  CONSTRAINT `FK_FE38F844CE0312AE` FOREIGN KEY (`id_patient_id`) REFERENCES `patitent` (`id`),
  CONSTRAINT `FK_FE38F844F2D87AF3` FOREIGN KEY (`id_dialysis_id`) REFERENCES `dialysis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.appointment: ~4 rows (około)
INSERT INTO `appointment` (`id`, `id_patient_id`, `has_happened`, `start`, `end`, `id_dialysis_id`) VALUES
	(1, 1, 1, '2023-03-27 07:35:43', '2023-03-27 11:40:11', 1),
	(2, 2, 1, '2023-02-01 10:18:31', '2023-02-01 12:18:00', 2),
	(3, 3, 1, '2023-02-03 07:24:50', '2023-02-03 10:25:09', 3),
	(7, 1, 0, '2023-04-19 10:30:00', '2023-04-19 13:30:00', 6);

-- Zrzut struktury tabela medinfo.dialysis
CREATE TABLE IF NOT EXISTS `dialysis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `weight_before` decimal(7,2) DEFAULT NULL,
  `weight_after` decimal(7,2) DEFAULT NULL,
  `blood_pressure_before` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_pressure_after` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pressure_during` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ultrafiltration` decimal(5,2) DEFAULT NULL,
  `glycemia` int NOT NULL,
  `additional_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.dialysis: ~4 rows (około)
INSERT INTO `dialysis` (`id`, `weight_before`, `weight_after`, `blood_pressure_before`, `blood_pressure_after`, `pressure_during`, `ultrafiltration`, `glycemia`, `additional_info`) VALUES
	(1, 89.70, 88.00, '131/78', '161/92', '199/100', 1.70, 81, 'W trakcie zabiegu wzrost ciśnienia tętniczego krwi, podano leki hipotensyjne na zlecenie lekarskie ze skutkiem. Reszta zabiegu bez powikań.'),
	(2, 57.30, 57.00, '111/58', '120/71', '82/51', 0.30, 101, 'W trakcie HD spadek ciśnienia tętniczego krwi, chorą ułożono w pozycji Trelendenburga i podano leki hipertensyjne wg zleceń lekarza. Po podaniu leków poprawa samopoczucia pacjentki, parametry życiowe w granicach normy.'),
	(3, 115.30, 111.20, '168/82', '182/101', '203/114', 4.00, 94, 'Wysoka początkowa wartość ciśnienia tętniczego krwi, pacjent przyjął swoje leki na nadciśnienie. Zgłasza dolegliwości bólowe lewej kończnyny dolnej, podano leki przeciwbólowe według zleceń.'),
	(6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'mjhhm');

-- Zrzut struktury tabela medinfo.doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.doctrine_migration_versions: ~14 rows (około)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20221201144327', '2022-12-01 14:45:12', 1817),
	('DoctrineMigrations\\Version20221202192110', '2022-12-02 19:21:20', 388),
	('DoctrineMigrations\\Version20230329191531', '2023-03-29 19:15:46', 972),
	('DoctrineMigrations\\Version20230329192437', '2023-03-29 19:24:43', 1416),
	('DoctrineMigrations\\Version20230329193835', '2023-03-29 19:38:41', 725),
	('DoctrineMigrations\\Version20230329195018', '2023-03-29 19:50:52', 392),
	('DoctrineMigrations\\Version20230329201728', '2023-03-29 20:17:36', 345),
	('DoctrineMigrations\\Version20230329202045', '2023-03-29 20:20:52', 814),
	('DoctrineMigrations\\Version20230329202438', '2023-03-29 20:24:52', 139),
	('DoctrineMigrations\\Version20230329202620', '2023-03-29 20:26:25', 257),
	('DoctrineMigrations\\Version20230329204205', '2023-03-29 20:42:15', 478),
	('DoctrineMigrations\\Version20230329204809', '2023-03-29 20:48:14', 399),
	('DoctrineMigrations\\Version20230401183859', '2023-04-01 18:39:09', 837),
	('DoctrineMigrations\\Version20230402192924', '2023-04-02 19:29:39', 491);

-- Zrzut struktury tabela medinfo.last_pharmacy_supply_check
CREATE TABLE IF NOT EXISTS `last_pharmacy_supply_check` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_controller_id` int NOT NULL,
  `last_supply_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7532FC4E48F9762E` (`id_controller_id`),
  CONSTRAINT `FK_7532FC4E48F9762E` FOREIGN KEY (`id_controller_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.last_pharmacy_supply_check: ~3 rows (około)
INSERT INTO `last_pharmacy_supply_check` (`id`, `id_controller_id`, `last_supply_date`) VALUES
	(1, 1, '2023-04-01'),
	(2, 1, '2023-03-20'),
	(3, 13, '2023-02-21');

-- Zrzut struktury tabela medinfo.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dose` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dialysis_id` int NOT NULL,
  `fk_medicine_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_885F06BCF2D87AF3` (`id_dialysis_id`),
  KEY `IDX_885F06BC468BB83E` (`fk_medicine_id`),
  CONSTRAINT `FK_885F06BC468BB83E` FOREIGN KEY (`fk_medicine_id`) REFERENCES `pharmacy_supply` (`id`),
  CONSTRAINT `FK_885F06BCF2D87AF3` FOREIGN KEY (`id_dialysis_id`) REFERENCES `dialysis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.medicines: ~15 rows (około)
INSERT INTO `medicines` (`id`, `dose`, `additional_info`, `id_dialysis_id`, `fk_medicine_id`) VALUES
	(1, '2', NULL, 1, 1),
	(2, '0.5', NULL, 1, 6),
	(3, '2', NULL, 1, 10),
	(4, '1', 'CVC', 1, 15),
	(5, '1', NULL, 2, 2),
	(6, '1', NULL, 2, 6),
	(7, '1', NULL, 2, 12),
	(8, '1', NULL, 2, 13),
	(9, '0.2', NULL, 1, 16),
	(10, '0.2', NULL, 2, 16),
	(11, '3', NULL, 3, 2),
	(12, '1', NULL, 3, 8),
	(13, '1', NULL, 3, 7),
	(14, '1', NULL, 3, 15),
	(15, '0.4', NULL, 3, 16);

-- Zrzut struktury tabela medinfo.messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.messenger_messages: ~0 rows (około)

-- Zrzut struktury tabela medinfo.patitent
CREATE TABLE IF NOT EXISTS `patitent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_address_id` int DEFAULT NULL,
  `pesel` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dialing_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_dialing_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone_number` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E6759E4F503D2FA2` (`id_address_id`),
  CONSTRAINT `FK_E6759E4F503D2FA2` FOREIGN KEY (`id_address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.patitent: ~3 rows (około)
INSERT INTO `patitent` (`id`, `id_address_id`, `pesel`, `document_number`, `document_name`, `first_name`, `second_name`, `last_name`, `sex`, `dialing_code`, `phone_number`, `contact_dialing_code`, `contact_phone_number`, `additional_info`) VALUES
	(1, 2, '62110978912', NULL, NULL, 'Grzegorz', NULL, 'Wichura', 'M', '48', '987654321', NULL, '369852147', 'Uczulenie na pyralginę.'),
	(2, 3, '78042365432', NULL, NULL, 'Joanna', NULL, 'Podmuch', 'K', '48', '456123789', '48', '123098567', NULL),
	(3, 3, '56052734096', NULL, NULL, 'Wiktor', NULL, 'Podmuch', 'M', NULL, '345236835', NULL, '123629296', NULL);

-- Zrzut struktury tabela medinfo.pharmacy_supply
CREATE TABLE IF NOT EXISTS `pharmacy_supply` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `international_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `exp_date` date NOT NULL,
  `drug_list_n` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.pharmacy_supply: ~16 rows (około)
INSERT INTO `pharmacy_supply` (`id`, `name`, `international_name`, `description`, `quantity`, `exp_date`, `drug_list_n`) VALUES
	(1, 'Binocrit 1000', 'Erytropoetyna', 'Erytropoetyna 1000j.m./amp.', 243, '2024-05-10', 0),
	(2, 'Binocrit 3000', 'Erytropoetyna', 'Erytropoetyna 3000j.m./amp.', 194, '2024-03-10', 0),
	(3, 'Morphini Sulfas', 'Morfina', 'Morfina 5mg/5ml', 6, '2023-10-04', 1),
	(4, 'Midanium', 'Midazolam', 'Midazolam 5mg/ml', 13, '2024-01-14', 1),
	(5, 'Relanium', 'Diazepam', 'Diazepam 5mg/4ml', 4, '2024-01-07', 1),
	(6, 'Diafer', 'Derizomaltoza żelaza III', 'Fe 3+ 100mg/2ml', 185, '2024-07-15', 0),
	(7, 'Poltram', 'Tramadol', 'Tramadol 50mg/1ml', 49, '2023-10-20', 1),
	(8, 'Paracetamol 1g', 'Paracetamol', 'Paracetamol Kabi 1g/100ml', 21, '2023-06-29', 0),
	(9, 'Paracetamol 500mg', 'Paracetamol', 'Paracetamol 500mg/tab.', 69, '2023-09-01', 0),
	(10, 'Nitrendypina 10mg', 'Nitrendypina', 'Nitrendypina 10mg/tab.', 104, '2023-11-13', 0),
	(11, 'Captopril 12,5mg', 'Kaptopryl', 'Captopril 12,5mg/tab.', 42, '2023-06-01', 0),
	(12, 'Natrium Chloratum 10%', 'Chlorek sodu', 'NaCl 100mg/ml', 73, '2023-09-13', 0),
	(13, 'Glucosum Teva 40%', 'Glukoza', 'Glukoza 400mg/ml', 19, '2023-09-09', 0),
	(14, 'Ketonal 100mg', 'Ketoprofen', 'Ketonal 100mg/2ml', 53, '2024-03-31', 0),
	(15, 'Citra-Lock 30%', 'Cytrynian sodu', 'Citra-Lock 30%/5ml', 104, '2023-07-11', 0),
	(16, 'Heparinum WZF', 'Heparyna', 'Heparinum WZF 5000j.m/ml', 176, '2024-04-28', 0);

-- Zrzut struktury tabela medinfo.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_password_change` date NOT NULL,
  `first_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `id_address_id` int DEFAULT NULL,
  `licensure_number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D649503D2FA2` (`id_address_id`),
  CONSTRAINT `FK_8D93D649503D2FA2` FOREIGN KEY (`id_address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Zrzucanie danych dla tabeli medinfo.user: ~7 rows (około)
INSERT INTO `user` (`id`, `username`, `roles`, `password`, `last_password_change`, `first_name`, `second_name`, `last_name`, `is_active`, `id_address_id`, `licensure_number`) VALUES
	(1, 'JaNo1243', '["ROLE_USER"]', '$2y$13$VDGrt7bjvTmbAo5eJGl/2u1gzy0X0KFEZCQFQfMfkc1/BrlrJepzO', '2022-12-02', 'Janina', 'Bożena', 'Nowak', 1, 1, '1234567P'),
	(2, 'Admin12', '["ROLE_ADMIN"]', '$2y$13$CSUSUezSZ8s5REvM/TuIa.exaHHaT6n0iqddaBWbq6sLNW1nSR2hW', '2022-11-02', 'Admin', NULL, 'Admin', 1, NULL, '0000001P'),
	(3, 'SuperAdmin12', '["ROLE_SUPERADMIN"]', '$2y$13$NC/HYDUjIgVewqwWc0p7Del9iw8dCNIXzGysbocpir/3HUBxYr4ki', '2022-11-02', 'SuperAdmin', NULL, 'Administrator', 1, 6, '0000000P'),
	(12, 'Testowy', '["ROLE_USER"]', '$2y$13$U5JOGRRW6C.TiOu2Bhr...GTxM3u0hu4zOkeuQu3px2aTEW2jd6ee', '2022-12-03', 'Test', 'Test2', 'TestNazwisko', 0, NULL, '0000002P'),
	(13, 'KeBo2135', '["ROLE_USER"]', '$2y$13$X8TSyRkBYYzsGtFITNsmkOIstQcmtTqkwl/nPki/HCMg9.VvL6ZdG', '2022-11-18', 'Kevin', NULL, 'Bonik', 1, 4, '7654321P'),
	(14, 'LeDo67', '["ROLE_DOCTOR"]', '$2y$13$.h09DdgWuJzG4r624R0JcONJVZpgeRzo06R.3pVajgOjBsCllEebK', '2023-01-09', 'Lech', 'Paweł', 'Dobrzański', 1, 1, '5425740'),
	(15, 'jajestemgodzien', '["ROLE_USER"]', '$2y$13$0TDlS2KtjKuXG4klh4FeFek1Ci2dVCobqZDEb0Xc.V7EUjXUBzO9a', '2023-04-11', 'Test', 'Test2', 'TestNazwisko', 0, NULL, '1224567P');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
