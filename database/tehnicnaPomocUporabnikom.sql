-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: mysql.lrk.si    Database: blaz_b1
-- ------------------------------------------------------
-- Server version	5.1.69

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
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ticketid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `privilegelvl` int(11) DEFAULT NULL,
  PRIMARY KEY (`messageid`),
  KEY `fk_chat_idx` (`ticketid`),
  CONSTRAINT `fk_ticket` FOREIGN KEY (`ticketid`) REFERENCES `ticket` (`ticketid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (39,'teÅ¾ava ni pri nas. nam lahko date veÄ podatkov?',39,'2013-12-21 19:42:28','Identity ninja',2),(41,'Sedaj bom jaz vse zrihtal :P ',39,'2013-12-21 20:12:28','Gigi De Augustino',3),(47,'ZaÄasno smo vam izkljuÄili streÅ¾nik. Posodobiti jo boste morali sami....',78,'2013-12-22 18:02:37','Identity ninja',2),(48,'Kvoto imate poveÄano na 10gb.',76,'2013-12-22 18:02:58','Identity ninja',2),(49,'Super, lahko zakljuÄimo!',76,'2013-12-22 18:04:51','Janez Novak',1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `ticketid` int(11) NOT NULL AUTO_INCREMENT,
  `problem` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `adminid` int(11) DEFAULT NULL,
  `state` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `fk_user_idx` (`userid`),
  CONSTRAINT `fk_user` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (39,'TV','2013-12-21','Televizija','Tezava po resetu tvja','031 777-777',3,6,2,'3'),(74,'TeÅ¾ava z internetom','2013-12-20','Internetna povezava','Strela mi je skurila modem. ÄŒeprav ga resetiram se ne priÅ¾ge nobena luÄka. Kaj naj storim?','031 772-079',2,1,NULL,'1'),(75,'TeÅ¾ava z mojo novo Å¾eno','2013-12-02','Varnostni incident','Moja Å¾ena mi je pojedla vse kolaÄiÄe. Sedaj mi ne odpre nobene spletne strani veÄ...','031 772-079',2,1,NULL,'1'),(76,'Polna kvota','2013-12-22','E-PoÅ¡ta','PoÅ¡tni odjemalec mi javlja, da imam polno kvoto. Mi jo lahko poveÄate?','031 772-079',2,1,5,'4'),(78,'Joomla polna virusov','2013-12-22','Virtualni streÅ¾niki','Mi lahko prosim posodobite joomlo, saj je povsem okuzena...','031 772-079',2,1,5,'3'),(79,'Poln poÅ¡tni predal','2013-12-22','E-PoÅ¡ta','Fantje  ji poÅ¡iljajo toliko poÅ¡te, da ima povsem poln predal. Smo ji poveÄali kvoto.','031 772-079',2,8,5,'4');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `privilegelvl` int(11) DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Janez Novak','janez.novak@email.si','janez',1,'031772079','xxx'),(2,'Gigi De Augustino','gigi@gigi.si','gigi',3,'031772079','xxx'),(3,'Alberto Komputador','a@komputador.si','alberto',3,'031772079','xxx'),(4,'Rolando Wirelez','r@wirelez.si','rolando',3,'031772079','xxx'),(5,'Identity ninja','ninja','ninja',2,'031772079','xxx'),(6,'Testko Testic','test@test.si','test',1,'031772079','xxx'),(7,'Kaja','kaja@kaja.si','kaja',1,'031772079','xxx'),(8,'Katja','katja@katja.si','katja',1,'031772079','xxx'),(9,'Mirko','mirko@siol.net','mirko',1,'031772079','xxx');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-22  9:15:22
