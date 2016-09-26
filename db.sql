-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Verzió:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for mvc
DROP DATABASE IF EXISTS `mvc`;
CREATE DATABASE IF NOT EXISTS `mvc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mvc`;


-- Dumping structure for tábla mvc.cv_courses
DROP TABLE IF EXISTS `cv_courses`;
CREATE TABLE IF NOT EXISTS `cv_courses` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `year` varchar(20) NOT NULL,
  `details` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table mvc.cv_courses: ~4 rows (approximately)
/*!40000 ALTER TABLE `cv_courses` DISABLE KEYS */;
INSERT IGNORE INTO `cv_courses` (`id`, `title`, `year`, `details`) VALUES
	(0, 'Photoshop tanfolyam', '2012.', 'Budapest, Ruander Oktatóközpont'),
	(1, 'Webfejlesztő tanfolyam', '2012.', 'Budapest, Ruander Oktatóközpont'),
	(2, 'PHP programozó tanfolyam', '2015. feb', 'Budapest, Ruander Oktatóközpont'),
	(3, 'PHP haladó tanfolyam', '2015. júl', 'Budapest, Ruander Oktatóközpont');
/*!40000 ALTER TABLE `cv_courses` ENABLE KEYS */;


-- Dumping structure for tábla mvc.cv_education
DROP TABLE IF EXISTS `cv_education`;
CREATE TABLE IF NOT EXISTS `cv_education` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `year` varchar(9) NOT NULL,
  `details` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mvc.cv_education: ~3 rows (approximately)
/*!40000 ALTER TABLE `cv_education` DISABLE KEYS */;
INSERT IGNORE INTO `cv_education` (`id`, `title`, `year`, `details`) VALUES
	(0, 'Általános iskola', '1991-1999', 'Pomáz, Mátyás Király Általános Iskola'),
	(1, 'Középiskola', '1999-2004', 'Szentendre, Móricz Zsigmond Gimnázium <br> Informatika tagozat'),
	(2, 'Technikum', '2014-2015', 'Budapest, Ybl Miklós Építőipari Szakképző Iskola <br> Útépítő és -fenntartó technikus (OKJ)');
/*!40000 ALTER TABLE `cv_education` ENABLE KEYS */;


-- Dumping structure for tábla mvc.cv_employment
DROP TABLE IF EXISTS `cv_employment`;
CREATE TABLE IF NOT EXISTS `cv_employment` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `year` varchar(9) NOT NULL,
  `details` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table mvc.cv_employment: ~1 rows (approximately)
/*!40000 ALTER TABLE `cv_employment` DISABLE KEYS */;
INSERT IGNORE INTO `cv_employment` (`id`, `title`, `year`, `details`) VALUES
	(3, 'Bola 95 Útépítő Kft', '2004-2015', 'Ügyintéző, művezető, rendszergazda. Különböző adminisztrációs feladatok ellátása, útépítő csapatok irányítása, a cég néhány számítógépből álló informatikai rendszerének karbantartása.');
/*!40000 ALTER TABLE `cv_employment` ENABLE KEYS */;


-- Dumping structure for tábla mvc.cv_index
DROP TABLE IF EXISTS `cv_index`;
CREATE TABLE IF NOT EXISTS `cv_index` (
  `id` int(3) unsigned NOT NULL,
  `user_id` int(3) unsigned NOT NULL,
  `intro` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mvc.cv_index: ~1 rows (approximately)
/*!40000 ALTER TABLE `cv_index` DISABLE KEYS */;
INSERT IGNORE INTO `cv_index` (`id`, `user_id`, `intro`) VALUES
	(0, 1, '<p>Tisztelt Hölgyem / Uram!</p><p>Kérem tekintse meg bemutató oldalamat, melyet referencia és szakmai tapasztalat hiánya miatt készítettem.</p><p>Ez a három lapból (index, error, cv) álló responsive weboldal MVC design pattern felhasználásával készült. Elkészítéséhez nagyon minimális JavaScriptet illetve jQuery-t is használtam. </p><p>Amennyiben felkeltettem érdeklődését, az alábbi gombokat használva megnézheti önéletrajzomat, illetve letöltheti a \'weboldal\' forráskódját.</p><p>Üdvözlettel: Bodó Barna</p>');
/*!40000 ALTER TABLE `cv_index` ENABLE KEYS */;


-- Dumping structure for tábla mvc.cv_language
DROP TABLE IF EXISTS `cv_language`;
CREATE TABLE IF NOT EXISTS `cv_language` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `year` varchar(9) NOT NULL,
  `details` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table mvc.cv_language: ~1 rows (approximately)
/*!40000 ALTER TABLE `cv_language` DISABLE KEYS */;
INSERT IGNORE INTO `cv_language` (`id`, `title`, `year`, `details`) VALUES
	(0, 'Angol', '2004.', 'Középfokú nyelvvizsga');
/*!40000 ALTER TABLE `cv_language` ENABLE KEYS */;


-- Dumping structure for tábla mvc.cv_letter
DROP TABLE IF EXISTS `cv_letter`;
CREATE TABLE IF NOT EXISTS `cv_letter` (
  `id` int(3) unsigned NOT NULL,
  `user_id` int(3) unsigned NOT NULL,
  `letter` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mvc.cv_letter: ~1 rows (approximately)
/*!40000 ALTER TABLE `cv_letter` DISABLE KEYS */;
INSERT IGNORE INTO `cv_letter` (`id`, `user_id`, `letter`) VALUES
	(0, 1, '<p>Ezúton szeretnék jelentkezni a Programozói Állások Facebook csoportban meghirdetett webfejlesztői állásukra.</p><p>Bár szakirányú végzettséggel és tapasztalattal még nem rendelkezek, de nagyon elszánt vagyok, hogy a közeljövőben a legjobb webfejlesztők csapatának létszámát növelni tudjam.</p><p>Középiskolai tanulmányaim végeztével az útépítéssel foglakozó családi vállalkozásunkban kezdtem el dolgozni, de tavaly otthagytam a céget, mert többre vágytam. Annak ellenére, hogy a Kft jólétet biztosított számomra, úgy éreztem, hogy 31 évesen ideje lenne komolyabban elkezdeni azzal foglalkozni, ami valóban érdekel.</p><p>2015. februárjában elvégeztem egy PHP kezdő tanfolyamot, majd szintén a tavalyi év júliusában egy PHP haladó kurzust is megcsináltam. A haladó tanfolyam után itthon kezdtem el továbbképezni magamat. Online tanfolyamokon, valamint írott tananyagokon keresztül bővítettem tudásomat, amin van még mit csiszolni, de egy dolog hajt, a folyamatos fejlődés. A közelmúltban elvégeztem egy angol nyelvű online Laravel, egy jQuery és egy Bootstrap tanfolyamot. Jelenleg ezek begyakorlásán tevékenykedek.</p><p>Ismerem az objektum orientált programozást (inkább PHP-ban, de minimálisan JavaScriptben is), ismerem az MVC patternt, MySQL-ből mennek a kissé összetettebb lekérdezések valamint responsive oldal készítéséből is van gyakorlatom (ebből kifolyólag HTML5 és CSS3 ismeretekkel is rendelkezek). A grafikai programok közül a Photoshopot ismerem felhasználói szinten.</p><p>A webfejlesztésen kívül szeretek fotózni, kertet építeni és gitározni, bár a tanulás és a család mellett ezekre nem jutott túl sok időm mostanában.</p><p>Köszönöm, hogy végigolvasták az önéletrajzomat és a motivációs levelemet!</p><p>Üdvözlettel: Bodó Barna</p>');
/*!40000 ALTER TABLE `cv_letter` ENABLE KEYS */;


-- Dumping structure for tábla mvc.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `sid` varchar(64) NOT NULL,
  `spass` varchar(64) NOT NULL,
  `stime` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mvc.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT IGNORE INTO `sessions` (`sid`, `spass`, `stime`) VALUES
	('91ceior6jdu5b4dvslp9apc7j0', '4bab7c88f4781a516f335551068def82', 1474895425);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- Dumping structure for tábla mvc.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mvc.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'iworkshop', '$2y$10$bGeQN5B2h8R0UGoda36PE.jXd3eHb8PDED1bpEL533GWsx/ygc/BW');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
