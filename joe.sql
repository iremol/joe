-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: joe
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

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
-- Current Database: `joe`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `joe` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `joe`;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `vaccountno` varchar(10) NOT NULL,
  `vbankname` varchar(255) NOT NULL,
  `vusername` varchar(255) NOT NULL,
  PRIMARY KEY (`vaccountno`),
  KEY `account_referral_fk` (`vusername`),
  CONSTRAINT `account_referral_fk` FOREIGN KEY (`vusername`) REFERENCES `referral` (`vusername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('0000000000','GtBank','test@test.com'),('0098446126','Access','Dayo'),('0123456789','GtBank','iremol@gmail.com'),('0789445323','Access','Titi'),('0938902892','Access','Jide'),('0967813678','Access','Tolu'),('2222222222','GTBank','test11'),('3333333333','Firstbank','test12'),('4444444444','fidelity','test13'),('6666666666','fidelity','test14'),('9012164572','Access','Dada'),('9809173643','Access','segun');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biodata`
--

DROP TABLE IF EXISTS `biodata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biodata` (
  `ibdid` bigint(20) NOT NULL AUTO_INCREMENT,
  `vfirstname` varchar(255) NOT NULL,
  `vothername` varchar(255) DEFAULT NULL,
  `vlastname` varchar(255) NOT NULL,
  `ddob` date NOT NULL,
  `vemail` varchar(255) NOT NULL,
  `vcity` varchar(50) NOT NULL,
  `vphoneno` varchar(11) NOT NULL,
  `vcountry` varchar(100) NOT NULL,
  `vusername` varchar(255) NOT NULL,
  PRIMARY KEY (`ibdid`),
  KEY `biodata_referral_fk` (`vusername`),
  CONSTRAINT `biodata_referral_fk` FOREIGN KEY (`vusername`) REFERENCES `referral` (`vusername`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biodata`
--

LOCK TABLES `biodata` WRITE;
/*!40000 ALTER TABLE `biodata` DISABLE KEYS */;
INSERT INTO `biodata` VALUES (2,'Test','Joseph','Test','1984-12-09','iremol@gmail.com','Akure','08098765432','NIgeria','iremol@gmail.com'),(3,'test','test','test','1987-07-06','test@test.com','test','07000000000','test','test@test.com'),(5,'test11','test11','test11','1987-07-06','test11','test11','09099999999','test11','test11'),(6,'test12','test12','test12','1987-07-06','test12','test12','09090094094','test12','test12'),(7,'test13','test13','test13','1987-07-06','test13','test13','90439492390','test13','test13'),(8,'test15','test15','test15','1987-07-06','test14','test14','99999999999','test14','test14'),(9,'Ade','Dayo','O','1990-09-15','Dayo','Lagos','08034072481','Nigeria','Dayo'),(10,'Adeola','Tolu','k','1998-07-11','Tolu','lagos','08034072481','Nigeria','Tolu'),(11,'Titi','Dayo','L','1934-10-23','Titi','Lagos','08034072481','Nigeria','Titi'),(12,'Babatunde','Jide',']','1990-09-15','Jide','Lagos','08034072481','Nigeria','Jide'),(13,'DAda','Dare','k','1934-10-23','Dada','Lagos','08034072481','Nigeria','Dada'),(14,'segun','sola','G','1945-07-25','segun','Lagos','08034072481','Nigeria','segun');
/*!40000 ALTER TABLE `biodata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus`
--

DROP TABLE IF EXISTS `bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonus` (
  `irid` smallint(6) NOT NULL AUTO_INCREMENT,
  `fdonation` float NOT NULL,
  `fpercentage` float NOT NULL,
  `irefcount` int(11) NOT NULL,
  `total` float NOT NULL,
  `vdesc` varchar(100) DEFAULT NULL,
  `vstage` varchar(10) NOT NULL,
  PRIMARY KEY (`irid`),
  KEY `bonus_stage_fk` (`vstage`),
  CONSTRAINT `bonus_stage_fk` FOREIGN KEY (`vstage`) REFERENCES `stage` (`vstage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus`
--

LOCK TABLES `bonus` WRITE;
/*!40000 ALTER TABLE `bonus` DISABLE KEYS */;
INSERT INTO `bonus` VALUES (1,3000,20,6,9600,'FEEDER Matrix Bonus','FEEDER'),(2,5000,30,6,9000,'FEEDER Activation Bonus','FEEDER');
/*!40000 ALTER TABLE `bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral`
--

DROP TABLE IF EXISTS `referral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral` (
  `vusername` varchar(255) NOT NULL,
  `vsusername` varchar(255) NOT NULL,
  `vstage` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`vusername`),
  KEY `referral_sponsor_fk` (`vsusername`),
  KEY `referral_stage_fk` (`vstage`),
  CONSTRAINT `referral_sponsor_fk` FOREIGN KEY (`vsusername`) REFERENCES `referral` (`vusername`),
  CONSTRAINT `referral_stage_fk` FOREIGN KEY (`vstage`) REFERENCES `stage` (`vstage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral`
--

LOCK TABLES `referral` WRITE;
/*!40000 ALTER TABLE `referral` DISABLE KEYS */;
INSERT INTO `referral` VALUES ('admin','admin',NULL),('Dada','test12','FEEDER'),('Dayo','grace','FEEDER'),('grace','joevic','FEEDER'),('iremol@gmail.com','joevic','FEEDER'),('Jide','love','FEEDER'),('joe','admin',NULL),('joevic','test4',NULL),('love','joevic','FEEDER'),('peace','joe','FEEDER'),('peter','joevic','FEEDER'),('segun','test12','FEEDER'),('test10','test9','FEEDER'),('test11','test4','FEEDER'),('test12','test11','FEEDER'),('test13','test11','FEEDER'),('test14','test13','FEEDER'),('test4','admin',NULL),('test5','admin',NULL),('test6','admin',NULL),('test7','test4',NULL),('test8','test4',NULL),('test9','test5','FEEDER'),('test@test.com','joevic','FEEDER'),('Titi','love','FEEDER'),('Tolu','grace','FEEDER');
/*!40000 ALTER TABLE `referral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage` (
  `vstage` varchar(10) NOT NULL,
  PRIMARY KEY (`vstage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage`
--

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` VALUES ('BRONZE'),('DIAMOND'),('FEEDER'),('GOLD'),('SILVER');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `vusername` varchar(150) NOT NULL,
  `vpassword` varchar(150) NOT NULL,
  `vprincipal` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`vusername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','$2y$10$s7PtMOBgWWPxrup58AKtr.mt0urVypGaYBykdINJPR4yynNjzmv12','AdminPrincipal'),('Dada','$2y$10$TB/dtPqVS.mzdQ5ixcAX3.B.AgR4S9Es2nTgbmCXRtwMV077le4J6','UserPrincipal'),('Dayo','$2y$10$oBtZE8sVbcKWKbxU7pf9YuFjefnNKEQ45RZ89/V8yIxQNpGcy1Jc.','UserPrincipal'),('grace','$2y$10$5q43e8NC7b8GX7lDlqIacOJPjicvIgk0UwJg9FYGCVNUxTM3WvR1q','UserPrincipal'),('iremol@gmail.com','$2y$10$5RlO261QwmatQvIKPRBxWeJVNa/6H3xOhhDgC4b6ow1j2SKu/1d5O','UserPrincipal'),('Jide','$2y$10$PuXKEW80tA6bRTpMS6bLIeYc4wpXWwO1MGQ8g0Zphh9X8.xne9n9G','UserPrincipal'),('joevic','$2y$10$oMHSw9FIgQrksiVP2UaWDe79OQkbKTgfynu4VfUFNRin/YFDCCGTG','UserPrincipal'),('john','$2y$10$pSJGPdOUf12q4x5saVe32OhgojV6e4kME8C6LTg4XHogabTWkHZTy','UserPrincipal'),('love','$2y$10$W781P7re33kjksR3Q0Jky.MQ3oP.6hE1wgwNqY20cE4qbqGSuzRK2','UserPrincipal'),('peace','$2y$10$Kq8c/dSYHZDvQXmaOFciAuaNA6Yeo6IHceZ9zRpLhM.604n3o01xS','UserPrincipal'),('peter','$2y$10$Hdswnb2dvlL8pilfTZ7n4OZgNKWjXICQDAsdlrBEjRq8bQCJ7o3sq','UserPrincipal'),('segun','$2y$10$XVzCJY1x4z7o5J4edxxEceRcYW/HtrOErEW/bOjQylAdFLEs/0.pi','UserPrincipal'),('test','$2y$10$6F7URbhFGSvw7m8AZWl.AeIx3J.HeVj0dESJlA/gwUUTYRGGvqS4K','UserPrincipal'),('test1','$2y$10$KGvAWCNSpXWYezQkhfhvUuRehR9V8QgxKtBr.wAFGeg3g.FhsndQK','UserPrincipal'),('test10','$2y$10$6my0wT/n3QsSSEEBXmM7nO9S3DHnfo0L8SvRUZcv1Q/jCoWvHOBca','UserPrincipal'),('test11','$2y$10$qqAXv4v/O7FdhZUANzTPxOSGBNwgAl5LtxwfD4oS5yS0/4IeyaUje','UserPrincipal'),('test12','$2y$10$Jyi6q1/WFJ/TV7EGu3t6duCd4yiteNj5C8CpFyWQqVCeCw9odl5xq','UserPrincipal'),('test13','$2y$10$MFiHvV4RdaKEL/6tNndFNeBKca2AtcN0Uw50C.QAowoAeED9dZmZ2','UserPrincipal'),('test14','$2y$10$WThdJCdn3ld3f8QPh4.ke.6daUZ623cuBwgjrdrhfxKA6iNimhVGC','UserPrincipal'),('test2','$2y$10$ddXeimGS0.iD9RjDv5u7XO.8Su/fnD4fblT/v7Kr88g4.T/Zhx02i','UserPrincipal'),('test3','$2y$10$p2MssXqfhcQPYlwXFUk1BucUXD2w5sIj8wOxi7vadmXI/h5PAAg1e','UserPrincipal'),('test4','$2y$10$rPWZcoWC20gXUkOhqLkGEOuAt8uQan9sSn8NUuFs3uf2XqbPwXTDq','UserPrincipal'),('test9','$2y$10$VC7JxO/uY7WTVJV.nC1ZT.6oeXQO8em.M47GDU4Hm3rTY/xtuqXki','UserPrincipal'),('test@test.com','$2y$10$g9l7wj/wl2kL8tzgk8c1eeJBKqQaWLrrjoRMxOwKt7usHe.S7IYiG','UserPrincipal'),('Titi','$2y$10$5sHcDRYBMwWXMnnEL5uheOBtKxDO9QqXzF1/H46LMakID6dy0BpGe','UserPrincipal'),('Tolu','$2y$10$E5NN/VPsRFPm.w1WDx7.vOW8UgfuddVe3JJu.72hsfge5Dj0Sw5Ay','UserPrincipal');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-09 16:04:34
