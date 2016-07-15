-- MySQL dump 10.10
--
-- Host: localhost    Database: db_rssmailer
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` int(5) NOT NULL auto_increment,
  `guid` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--


/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
LOCK TABLES `subscriptions` WRITE;
INSERT INTO `subscriptions` VALUES (12,'180649','ereke_enu@mail.ru','2016-07-07 11:34:48'),(13,'180649','ye.karakulov@kamaloil.kz','2016-07-07 11:36:34'),(14,'180649','qwe@mail.ru','2016-07-07 11:39:51'),(15,'180649','ereke_enu@mail.ru','2016-07-07 11:41:02'),(16,'180649','test@mail.ru','2016-07-07 11:56:37'),(17,'180649','test1@mail.ru','2016-07-07 11:57:04'),(18,'180649','ereke_enu@mail.ru','2016-07-07 11:59:56');
UNLOCK TABLES;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--


/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'ereke_enu@mail.ru','123456','2016-07-08 10:36:28');
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `rss` varchar(100) NOT NULL,
  `userId` int(5) NOT NULL,
  `guid` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widgets`
--


/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
LOCK TABLES `widgets` WRITE;
INSERT INTO `widgets` VALUES (10,'http://kazakh-tv.kz/rss-ru.xml',1,'ad11c78d7509dac830d6989471af7441');
UNLOCK TABLES;
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

