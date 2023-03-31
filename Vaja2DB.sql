SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;


--
-- Zbirka podatkov: `vaja1`
--
CREATE DATABASE IF NOT EXISTS `vaja1` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci*/;
USE `vaja1`;

-- --------------------------------------------------------

--
-- Struktura tabele `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

/*INSERT INTO 'ads' (`id`, `title`, `description`, `user_id`, `date`, `views`, `expiration`) VALUES
	(NULL, 'Title', 'Bla bla bla.', 1, NULL, NULL, '2023-03-16 12:00:00');*/
--
-- Struktura tabele `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_slovenian_ci NOT NULL,
  `password` text COLLATE utf8_slovenian_ci NOT NULL,
  `email` text COLLATE UTF8_SLOVENIAN_CI,
  `firstname` text COLLATE UTF8_SLOVENIAN_CI,
  `surname` text COLLATE UTF8_SLOVENIAN_CI,
  `address` text COLLATE UTF8_SLOVENIAN_CI,
  `post` text COLLATE UTF8_SLOVENIAN_CI,
  `phone` text COLLATE UTF8_SLOVENIAN_CI,
  `gender` text COLLATE UTF8_SLOVENIAN_CI,
  `birthday` text COLLATE UTF8_SLOVENIAN_CI,
  `isAdmin` text COLLATE UTF8_SLOVENIAN_CI,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
COMMIT;

/*INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `surname`, `address`, `post`, `phone`, `gender`, `birthday`) VALUES
	(, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_slovenian_ci NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=UTF8_SLOVENIAN_CI;

-- --------------------------------------------------------

INSERT INTO `categories` (`id`, `name`, `parentid`, `groupid`) VALUES
	(1, 'Work', 0, 1),
	(2, 'School', 0, 2),
	(3, 'Home', 0, 3);
	
-- --------------------------------------------------------
	
CREATE TABLE IF NOT EXISTS `ad_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`fk_ads` INT(11) NOT NULL,
	`fk_categories` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=UTF8_SLOVENIAN_CI;

-- --------------------------------------------------------

/*INSERT INTO `ad_category` (`id`, `fk_ads`, `fk_categories`) VALUES
	(1, 0, 1);*/

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text COLLATE utf8_slovenian_ci,
  `adid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

/*INSERT INTO `images` (`id`, `file`, `adid`) VALUES
	(1, 'img.png', 0);*/

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `comments`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(23) COLLATE utf8_slovenian_ci NOT NULL,
  `content` text COLLATE utf8_slovenian_ci NOT NULL,
  `adid` VARCHAR(23) COLLATE utf8_slovenian_ci NOT NULL,
  `ip` VARCHAR(45) NOT NULL,
<<<<<<< HEAD
=======
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_slovenian_ci,
  `nickname` text COLLATE utf8_slovenian_ci,
  `date` datetime DEFAULT NULL,
  `email` text COLLATE utf8_slovenian_ci,
  `adid` int(11) NOT NULL,
  `ip` text COLLATE utf8_slovenian_ci,
>>>>>>> 90c4629 (Pozabo commit)
=======
>>>>>>> db3e403 (Problem z mergom 2)
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=UTF8_SLOVENIAN_CI;

