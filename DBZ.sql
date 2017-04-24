-- MySQL dump 10.15  Distrib 10.0.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.28-MariaDB

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
-- Table structure for table `appears`
--

DROP TABLE IF EXISTS `appears`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appears` (
  `appears_id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) DEFAULT NULL,
  `saga_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`appears_id`),
  KEY `character_id_idx` (`character_id`),
  KEY `saga_id_idx` (`saga_id`),
  CONSTRAINT `character_id` FOREIGN KEY (`character_id`) REFERENCES `characters` (`character_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `saga_id` FOREIGN KEY (`saga_id`) REFERENCES `saga` (`saga_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appears`
--

LOCK TABLES `appears` WRITE;
/*!40000 ALTER TABLE `appears` DISABLE KEYS */;
INSERT INTO `appears` VALUES (1,3,1),(2,3,2),(3,3,3),(4,3,4),(5,3,5),(6,3,6),(7,3,7),(8,3,8),(9,3,9),(10,3,10),(11,3,11),(13,3,12),(14,3,13),(15,5,1),(16,5,2),(17,5,3),(18,5,4),(19,5,5),(20,5,6),(21,5,7),(22,5,8),(23,5,9),(24,5,10),(25,5,11),(26,5,12),(27,5,13),(28,5,13),(29,6,3),(30,6,4),(31,6,5),(32,6,6),(33,6,7),(34,6,8),(35,6,9),(36,6,10),(37,6,11),(38,6,12),(39,7,4),(40,7,5),(41,7,6),(42,7,7),(43,7,8),(44,7,9),(45,7,10),(46,7,11),(47,7,12),(48,7,13),(49,8,5),(50,8,6),(51,9,7),(52,10,9),(53,10,8),(54,10,8);
/*!40000 ALTER TABLE `appears` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attacks`
--

DROP TABLE IF EXISTS `attacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attacks` (
  `attack_id` int(11) NOT NULL AUTO_INCREMENT,
  `attack_name` varchar(45) DEFAULT NULL,
  `damage` int(11) DEFAULT NULL,
  `char_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`attack_id`),
  KEY `char_id_idx` (`char_id`),
  CONSTRAINT `char_id` FOREIGN KEY (`char_id`) REFERENCES `characters` (`character_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attacks`
--

LOCK TABLES `attacks` WRITE;
/*!40000 ALTER TABLE `attacks` DISABLE KEYS */;
INSERT INTO `attacks` VALUES (1,'Kamehameha',500,3),(2,'Kamehameha',500,5),(3,'Kamehameha',500,7),(4,'Flurry Kick',250,6),(5,'Flurry Kick',250,3),(6,'Spirit Bomb',450,3),(7,'Spirit Bomb',400,6),(8,'Spirit Bomb',400,7),(9,'Solar Flare',280,3),(10,'Solar Flare',280,5),(11,'Kamehameha',450,9),(12,'Solar Flare',275,9),(13,'Flurry Kick',280,10),(14,'Kamehameha',515,10),(15,'Spirit Bomb',410,10),(16,'Spirit Bomb',410,8),(17,'Flurry Kick',280,8);
/*!40000 ALTER TABLE `attacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `characters` (
  `character_id` int(11) NOT NULL AUTO_INCREMENT,
  `character_name` varchar(45) DEFAULT NULL,
  `character_desc` varchar(60) DEFAULT NULL,
  `character_pic` text,
  PRIMARY KEY (`character_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters`
--

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` VALUES (3,'Goku','Protagonist. Super Saiyan. Dad to Gohan. Savior of planet Ea','http://vignette2.wikia.nocookie.net/dragonball/images/5/5b/Gokusteppingoutofaspaceship.jpg/revision/latest?cb=20150325220848'),(5,'Vegeta','2nd protagonist. Goku\'s frenemy. Super Saiyan','http://vignette1.wikia.nocookie.net/dragonball/images/f/f3/VegetaVsPuiPuiNV.png/revision/latest?cb=20150402013608'),(6,'Piccolo','Namekian. Gokus ally. Gohans mentor','http://vignette3.wikia.nocookie.net/dragonball/images/1/1d/PiccoloVsAndroid17..png/revision/latest?cb=20100510165604'),(7,'Gohan','Super Saiyan. Gokus son.Z-fighter','http://vignette1.wikia.nocookie.net/dragonball/images/d/d9/Ultimate_Gohan_full.png/revision/latest?cb=20170106131532http://vignette1.wikia.nocookie.net/dragonball/images/d/d9/Ultimate_Gohan_full.png/revision/latest?cb=20170106131532'),(8,'Frieza','Super powerful villain. Fights Super Saiyan Goku on planet N','http://vignette2.wikia.nocookie.net/dragonball/images/4/4a/FriezaFinalFormNV..png/revision/latest?cb=20100504171239'),(9,'Cell','Super powerful villain. Fights Z-fights and absorbs androids','http://vignette3.wikia.nocookie.net/dragonball/images/0/0d/CellPerfectNVVsGoku.png/revision/latest?cb=20100506142507'),(10,'Buu','Ultimate super villain. Has the power to absorb people','http://vignette1.wikia.nocookie.net/dragonball/images/a/a6/MajinBuuKidDebutNV.png/revision/latest?cb=20150325220800');
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`login_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=553 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (423,'2017-04-13 20:53:28',NULL,'198.18.3.206','fail',''),(424,'2017-04-13 20:53:28',NULL,'198.18.3.206','fail',''),(425,'2017-04-13 20:53:29',NULL,'198.18.3.206','fail',''),(426,'2017-04-13 20:53:29',NULL,'198.18.3.206','fail',''),(427,'2017-04-13 20:53:29',NULL,'198.18.3.206','fail',''),(428,'2017-04-13 20:53:30',NULL,'198.18.3.206','fail',''),(429,'2017-04-13 20:53:30',NULL,'198.18.3.206','fail',''),(430,'2017-04-13 20:53:30',NULL,'198.18.3.206','fail',''),(431,'2017-04-13 20:53:31',NULL,'198.18.3.206','fail',''),(432,'2017-04-13 20:53:34',4,'198.18.3.206','pass','hello'),(433,'2017-04-13 20:54:45',NULL,'198.18.3.206','fail',''),(434,'2017-04-13 20:54:45',NULL,'198.18.3.206','fail',''),(435,'2017-04-13 20:54:46',NULL,'198.18.3.206','fail',''),(436,'2017-04-13 20:54:50',4,'198.18.3.206','pass','hello'),(437,'2017-04-13 20:55:04',NULL,'198.18.3.206','fail',''),(438,'2017-04-13 20:55:04',NULL,'198.18.3.206','fail',''),(439,'2017-04-13 20:55:04',NULL,'198.18.3.206','fail',''),(440,'2017-04-13 20:55:05',NULL,'198.18.3.206','fail',''),(441,'2017-04-13 20:55:05',NULL,'198.18.3.206','fail',''),(442,'2017-04-13 20:55:05',NULL,'198.18.3.206','fail',''),(443,'2017-04-13 20:55:05',NULL,'198.18.3.206','fail',''),(444,'2017-04-13 20:55:05',NULL,'198.18.3.206','fail',''),(445,'2017-04-13 20:55:06',NULL,'198.18.3.206','fail',''),(446,'2017-04-13 20:55:06',NULL,'198.18.3.206','fail',''),(447,'2017-04-13 20:55:06',NULL,'198.18.3.206','fail',''),(448,'2017-04-13 20:55:09',4,'198.18.3.206','pass','hello'),(449,'2017-04-13 20:56:52',NULL,'198.18.3.206','fail',''),(450,'2017-04-13 20:56:52',NULL,'198.18.3.206','fail',''),(451,'2017-04-13 20:56:52',NULL,'198.18.3.206','fail',''),(452,'2017-04-13 20:56:53',NULL,'198.18.3.206','fail',''),(453,'2017-04-13 20:56:53',NULL,'198.18.3.206','fail',''),(454,'2017-04-13 20:56:53',NULL,'198.18.3.206','fail',''),(455,'2017-04-13 20:56:53',NULL,'198.18.3.206','fail',''),(456,'2017-04-13 20:56:54',NULL,'198.18.3.206','fail',''),(457,'2017-04-13 20:56:57',4,'198.18.3.206','pass','hello'),(458,'2017-04-13 21:07:34',NULL,'198.18.3.206','fail',''),(459,'2017-04-13 21:07:35',NULL,'198.18.3.206','fail',''),(460,'2017-04-13 21:07:35',NULL,'198.18.3.206','fail',''),(461,'2017-04-13 21:07:35',NULL,'198.18.3.206','fail',''),(462,'2017-04-13 21:07:36',NULL,'198.18.3.206','fail',''),(463,'2017-04-13 21:07:36',NULL,'198.18.3.206','fail',''),(464,'2017-04-13 21:07:36',NULL,'198.18.3.206','fail',''),(465,'2017-04-13 21:07:36',NULL,'198.18.3.206','fail',''),(466,'2017-04-13 21:07:37',NULL,'198.18.3.206','fail',''),(467,'2017-04-13 21:07:40',4,'198.18.3.206','pass','hello'),(468,'2017-04-14 10:43:09',4,'198.18.3.206','pass','hello'),(469,'2017-04-14 18:14:19',4,'198.18.3.206','pass','hello'),(470,'2017-04-14 18:17:04',NULL,'198.18.3.206','fail',''),(471,'2017-04-14 18:17:05',NULL,'198.18.3.206','fail',''),(472,'2017-04-14 18:17:05',NULL,'198.18.3.206','fail',''),(473,'2017-04-14 18:17:05',NULL,'198.18.3.206','fail',''),(474,'2017-04-14 18:17:06',NULL,'198.18.3.206','fail',''),(475,'2017-04-14 18:17:06',NULL,'198.18.3.206','fail',''),(476,'2017-04-14 18:17:06',NULL,'198.18.3.206','fail',''),(477,'2017-04-14 18:17:06',NULL,'198.18.3.206','fail',''),(478,'2017-04-14 18:17:06',NULL,'198.18.3.206','fail',''),(479,'2017-04-14 18:17:07',NULL,'198.18.3.206','fail',''),(480,'2017-04-14 18:17:13',4,'198.18.3.206','pass','hello'),(481,'2017-04-14 18:17:18',NULL,'198.18.3.206','fail',''),(482,'2017-04-14 18:17:19',NULL,'198.18.3.206','fail',''),(483,'2017-04-14 18:17:19',NULL,'198.18.3.206','fail',''),(484,'2017-04-14 18:17:19',NULL,'198.18.3.206','fail',''),(485,'2017-04-14 18:17:19',NULL,'198.18.3.206','fail',''),(486,'2017-04-14 18:17:19',NULL,'198.18.3.206','fail',''),(487,'2017-04-14 18:17:20',NULL,'198.18.3.206','fail',''),(488,'2017-04-14 18:17:20',NULL,'198.18.3.206','fail',''),(489,'2017-04-14 18:17:20',NULL,'198.18.3.206','fail',''),(490,'2017-04-14 18:17:20',NULL,'198.18.3.206','fail',''),(491,'2017-04-14 18:17:23',4,'198.18.3.206','pass','hello'),(492,'2017-04-14 18:19:25',NULL,'198.18.3.206','fail',''),(493,'2017-04-14 18:19:26',NULL,'198.18.3.206','fail',''),(494,'2017-04-14 18:19:26',NULL,'198.18.3.206','fail',''),(495,'2017-04-14 18:19:26',NULL,'198.18.3.206','fail',''),(496,'2017-04-14 18:19:26',NULL,'198.18.3.206','fail',''),(497,'2017-04-14 18:19:27',NULL,'198.18.3.206','fail',''),(498,'2017-04-14 18:19:27',NULL,'198.18.3.206','fail',''),(499,'2017-04-14 18:19:27',NULL,'198.18.3.206','fail',''),(500,'2017-04-14 18:19:27',NULL,'198.18.3.206','fail',''),(501,'2017-04-14 18:19:27',NULL,'198.18.3.206','fail',''),(502,'2017-04-14 18:19:31',4,'198.18.3.206','pass','hello'),(503,'2017-04-14 18:20:25',NULL,'198.18.3.206','fail',''),(504,'2017-04-14 18:20:25',NULL,'198.18.3.206','fail',''),(505,'2017-04-14 18:20:25',NULL,'198.18.3.206','fail',''),(506,'2017-04-14 18:20:25',NULL,'198.18.3.206','fail',''),(507,'2017-04-14 18:20:25',NULL,'198.18.3.206','fail',''),(508,'2017-04-14 18:20:26',NULL,'198.18.3.206','fail',''),(509,'2017-04-14 18:20:26',NULL,'198.18.3.206','fail',''),(510,'2017-04-14 18:20:26',NULL,'198.18.3.206','fail',''),(511,'2017-04-14 18:20:26',NULL,'198.18.3.206','fail',''),(512,'2017-04-14 18:20:29',4,'198.18.3.206','fail','hello'),(513,'2017-04-14 18:26:30',1,'198.18.3.206','pass','admin'),(514,'2017-04-16 13:53:07',1,'198.18.6.2','pass','admin'),(515,'2017-04-16 21:29:25',4,'198.18.6.2','pass','hello'),(516,'2017-04-19 00:34:15',1,'198.18.0.26','fail','admin'),(517,'2017-04-19 00:34:39',9,'198.18.0.26','pass','DWIGHT'),(518,'2017-04-20 17:19:18',4,'198.18.3.206','pass','hello'),(519,'2017-04-20 17:23:55',4,'198.18.3.206','pass','hello'),(520,'2017-04-20 17:27:34',4,'198.18.3.206','pass','hello'),(521,'2017-04-20 17:30:18',4,'198.18.3.206','pass','hello'),(522,'2017-04-20 17:31:48',4,'198.18.3.206','pass','hello'),(523,'2017-04-20 17:35:28',4,'198.18.3.206','pass','hello'),(524,'2017-04-20 17:46:34',4,'198.18.3.206','pass','hello'),(525,'2017-04-20 17:47:43',4,'198.18.3.206','pass','hello'),(526,'2017-04-20 17:48:32',4,'198.18.3.206','pass','hello'),(527,'2017-04-20 17:49:32',4,'198.18.3.206','pass','hello'),(528,'2017-04-20 17:53:56',4,'198.18.3.206','pass','hello'),(529,'2017-04-20 17:54:49',4,'198.18.3.206','pass','hello'),(530,'2017-04-20 17:55:23',4,'198.18.3.206','pass','hello'),(531,'2017-04-20 18:04:19',4,'198.18.3.206','pass','hello'),(532,'2017-04-20 18:05:02',4,'198.18.3.206','pass','hello'),(533,'2017-04-20 18:06:11',4,'198.18.3.206','pass','hello'),(534,'2017-04-20 18:11:50',4,'198.18.3.206','pass','hello'),(535,'2017-04-20 18:48:35',4,'198.18.3.206','pass','hello'),(536,'2017-04-20 18:51:21',4,'198.18.3.206','pass','hello'),(537,'2017-04-20 19:01:31',4,'198.18.3.206','pass','hello'),(538,'2017-04-20 19:05:12',4,'198.18.3.206','pass','hello'),(539,'2017-04-20 19:05:39',4,'198.18.3.206','pass','hello'),(540,'2017-04-20 19:06:48',4,'198.18.3.206','pass','hello'),(541,'2017-04-20 19:13:20',4,'198.18.3.206','pass','hello'),(542,'2017-04-20 20:40:10',4,'198.18.3.206','pass','hello'),(543,'2017-04-20 20:41:34',4,'198.18.3.206','pass','hello'),(544,'2017-04-21 00:10:37',4,'198.18.3.206','pass','hello'),(545,'2017-04-21 12:54:52',4,'198.18.3.206','pass','hello'),(546,'2017-04-23 16:46:22',4,'198.18.3.206','pass','hello'),(547,'2017-04-23 16:46:29',4,'198.18.3.206','pass','hello'),(548,'2017-04-23 16:46:38',1,'198.18.3.206','pass','admin'),(549,'2017-04-23 16:46:46',4,'198.18.3.206','pass','hello'),(550,'2017-04-23 16:47:38',4,'198.18.3.206','pass','hello'),(551,'2017-04-23 19:12:32',4,'198.18.3.206','pass','hello'),(552,'2017-04-23 19:34:37',4,'198.18.3.206','pass','hello');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ques`
--

DROP TABLE IF EXISTS `ques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) DEFAULT NULL,
  `correct` varchar(100) DEFAULT NULL,
  `wrong1` varchar(100) DEFAULT NULL,
  `wrong2` varchar(100) DEFAULT NULL,
  `wrong3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ques`
--

LOCK TABLES `ques` WRITE;
/*!40000 ALTER TABLE `ques` DISABLE KEYS */;
INSERT INTO `ques` VALUES (1,'Who is Vegetas wife','Bulma','chi chi','android 18','Goku'),(2,'Who trained Goku after he died for the first time?','KingKai','Mr.Popo','Master Roshi','Supreme Kai'),(3,'Who is Majin Buus creator?','Bibidi','Nappa','Majin Vegeta','Babidi'),(4,'What is the Saiyan name of Goku','Kakarot','Broly','Chibi Trunks','Vegeta'),(5,'Who was Yamchas girlfriend','Bulma','Chi-Chi','Pan','Bulla');
/*!40000 ALTER TABLE `ques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saga`
--

DROP TABLE IF EXISTS `saga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saga` (
  `saga_id` int(11) NOT NULL AUTO_INCREMENT,
  `saga_name` varchar(45) DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`saga_id`),
  KEY `series_id_idx` (`series_id`),
  CONSTRAINT `series_id` FOREIGN KEY (`series_id`) REFERENCES `series` (`series_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saga`
--

LOCK TABLES `saga` WRITE;
/*!40000 ALTER TABLE `saga` DISABLE KEYS */;
INSERT INTO `saga` VALUES (1,'Son Goku\'s Boyhood Arc',1),(2,'Red Riboon Army Arc',1),(3,'Great Demon King Piccolo Arc',1),(4,'Saiyan Arc',2),(5,'Frieza Arc',2),(6,'Frieza-Androids Arc',2),(7,'Androids-Cell Arc',2),(8,'Majin Buu Arc',2),(9,'The Ending Arc',2),(10,'Baby Arc',3),(11,'Shaow Dragons Arc',3),(12,'Gods of Universe Arc',4),(13,'Zen-Oh Arc',4);
/*!40000 ALTER TABLE `saga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `series_id` int(11) NOT NULL AUTO_INCREMENT,
  `series_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`series_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'DRAGON BALL'),(2,'DRAGON BALL Z'),(3,'DRAGON BALL GT'),(4,'DRAGON BALL SUPER');
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `user_score` int(11) DEFAULT NULL,
  `user_pass` varchar(60) DEFAULT NULL,
  `user_salt` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin',NULL,'681aa65342ade38795131be438b0eb27d5afa498454f5d5dab781f318de5','2080099674'),(2,'Sam',NULL,'434368515319f53a36ab10552357ee14fa97171d66f6c5e708ff48206b61','483180189'),(3,'goku',500,'0ef43d6c883bfa80a4c2a26123fbb3d2083528549c8b5af77d2cb895e1d5','1787491275'),(4,'hello',410,'2632614027c51e544fbde800c96bb1fe9650d1cee03965c216cdb0661599','1382458590'),(5,'cow',-300,'13ede4ff28bc38c05c40c07cc581be9c2b4dcf164aa939511198510fdbe0','8352898'),(6,'maitri',NULL,'a5bf296b83655e04a7cacf153d7973ac8123bf45e36e259850724e723100','980963008'),(8,'hi',NULL,'cff3ecf350f6a5ba162ce5633421aea197ba2c3da3bc096880bab20684b1','1433177107'),(9,'dwight',500,'944b1488ee29e20162dc58938f213deb3910830c942e6130d8eef67d11e5','1501691860');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `white`
--

DROP TABLE IF EXISTS `white`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `white` (
  `id` int(11) NOT NULL,
  `white_ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `white`
--

LOCK TABLES `white` WRITE;
/*!40000 ALTER TABLE `white` DISABLE KEYS */;
INSERT INTO `white` VALUES (0,'198.18.3.206');
/*!40000 ALTER TABLE `white` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-24 10:54:46
