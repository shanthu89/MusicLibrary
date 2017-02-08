CREATE DATABASE  IF NOT EXISTS `dbproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbproject`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: dbproject
-- ------------------------------------------------------
-- Server version	5.6.27-log

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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `userID` int(11) DEFAULT NULL,
  `SongID` int(11) DEFAULT NULL,
  `played_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `userID_history_idx` (`userID`),
  KEY `SongID_history_idx` (`SongID`),
  CONSTRAINT `fk_SongID_history` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_userID_history` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1000,3,'2015-12-12 08:58:45'),(1000,7,'2015-12-12 08:58:45'),(1003,3,'2015-12-12 08:58:45'),(1004,4,'2015-12-12 08:58:45'),(1006,3,'2015-12-12 08:58:45'),(1008,6,'2015-12-12 08:58:45'),(1009,7,'2015-12-12 08:58:45'),(1002,3,'2015-12-12 08:58:45'),(1002,13,'2015-12-12 08:58:45'),(1002,13,'2015-12-12 08:58:45'),(1002,10,'2015-12-12 08:58:45'),(1002,3,'2015-12-12 08:58:45'),(1002,10,'2015-12-12 08:58:45'),(1002,7,'2015-12-12 08:58:45'),(1002,7,'2015-12-12 08:58:45'),(1002,10,'2015-12-12 08:58:45'),(1002,13,'2015-12-12 09:05:56'),(1002,7,'2015-12-12 09:15:00'),(1002,38,'2015-12-12 09:15:07'),(1002,12,'2015-12-12 10:27:09'),(1002,70,'2015-12-12 10:27:40'),(1002,187,'2015-12-13 03:34:41'),(1002,177,'2015-12-13 03:34:48'),(1005,7,'2015-12-13 08:37:18'),(1000,64,'2015-12-14 22:06:38'),(1000,59,'2015-12-14 22:06:41'),(1000,68,'2015-12-14 22:06:44'),(1000,10,'2015-12-14 23:12:25');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `userID` int(11) DEFAULT NULL,
  `SongID` int(11) DEFAULT NULL,
  UNIQUE KEY `songID_UserId_idx` (`userID`,`SongID`),
  KEY `SongID_idx` (`SongID`),
  KEY `useid_idx` (`userID`),
  CONSTRAINT `fk_SongID_like` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_userID_like` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (1000,10),(1000,16),(1002,4),(1002,5),(1002,6),(1003,3),(1004,4),(1005,3),(1005,4),(1006,3),(1008,6),(1009,7);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist` (
  `playlist_ID` int(11) DEFAULT NULL,
  `SongID` int(11) DEFAULT NULL,
  UNIQUE KEY `pl_id_user_id_indx` (`playlist_ID`,`SongID`),
  KEY `playlistID_playlist_idx` (`playlist_ID`),
  KEY `songID_playlist_idx` (`SongID`),
  CONSTRAINT `fk_playlistID_playlist` FOREIGN KEY (`playlist_ID`) REFERENCES `playlist_info` (`playlist_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_songID_playlist` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES (43,4),(43,7),(45,5),(45,8),(45,51),(46,51),(47,7),(47,10),(48,7),(49,1),(50,10);
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbproject`.`playlist_AFTER_DELETE` AFTER DELETE ON `playlist` FOR EACH ROW
BEGIN
DELETE FROM playlist_info where playlist_ID NOT IN (select distinct playlist_ID from playlist);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `playlist_info`
--

DROP TABLE IF EXISTS `playlist_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist_info` (
  `playlist_ID` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(255) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`playlist_ID`),
  KEY `user_id_idx` (`userID`),
  CONSTRAINT `fk_userID_playlist_info` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_info`
--

LOCK TABLES `playlist_info` WRITE;
/*!40000 ALTER TABLE `playlist_info` DISABLE KEYS */;
INSERT INTO `playlist_info` VALUES (43,'test',1009),(45,'mypl',1000),(46,'testpl',1000),(47,'jim_pl',1001),(48,'mypl_1',1005),(49,'blair_pl',1017),(50,'blair_pl_2',1017),(54,'testpl',1000);
/*!40000 ALTER TABLE `playlist_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbproject`.`playlist_info_AFTER_INSERT` AFTER INSERT ON `playlist_info` FOR EACH ROW
BEGIN
  UPDATE user SET num_of_playlists = num_of_playlists + 1 WHERE userID = NEW.userID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbproject`.`playlist_info_AFTER_DELETE` AFTER DELETE ON `playlist_info` FOR EACH ROW
BEGIN
  UPDATE user SET num_of_playlists = num_of_playlists - 1 WHERE userID = OLD.userID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `song` (
  `SongID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Album` varchar(255) DEFAULT NULL,
  `Artist` varchar(255) DEFAULT NULL,
  `Composer` varchar(255) DEFAULT NULL,
  `Genre` varchar(255) DEFAULT NULL,
  `Filepath` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`SongID`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `song`
--

LOCK TABLES `song` WRITE;
/*!40000 ALTER TABLE `song` DISABLE KEYS */;
INSERT INTO `song` VALUES (1,'Malargal Kaetaen','OK Kanmani','Chitra','A.R.Rahman','semi classical','Music/OK_Kanamani'),(2,'Mental Manadhil','OK Kanmani','Priyanka','A.R.Rahman','Romance','Music/OK_Kanmani'),(3,'Ulagil yentha Kathal',' Nadodigal','Hariharan','Sundhar C Babu','folk','music/Ulagil yentha kathal.mp3'),(4,'Rojappu Ada Vanthathu',' Nadodigal','Hariharan ','Sundhar C Babu','romance','music/Rojappu Ada Vanthathu.mp3'),(5,'Nagumo Nagumo',' Agni Natchathiram','Janaki','Ilayaraja','folk','music/Nagumo Nagumo.mp3'),(6,'Sambho Jagadam',' Arunaachalam','Hariharan','Chitra ','pop','music/Sambho Jagadam.mp3'),(7,'Kannum Kannum Nokia',' Nadodigal','Shankar Mahadevan','Sundhar C Babu','music','music/Kannum Kannum Nokia.mp3'),(8,'Kannum Kannum Nokia',' Anniyan',' Leslie Lewis',' Andrea Jeremiah & Vasundhara Das','Hindustani',' Harris Jayaraj'),(9,'Thalai Magane',' Jodha Akbhar','Ranjith','A.R.Rahman','carnatic','music/Tahlai Magane.mp3'),(10,'Thalaivaa',' Arunaachalam',' S.P.B',' Deva','Rock',' Arunaachalam/THALAI MAGANE.mp3'),(11,'Oh Sukumari',' Anniyan',' Shankar Mahadevan & Harini',' Harris Jayaraj','Pop',' Anniyan/Oh Sukumari Harris Jeyaraj.mp3'),(12,'Mukkala',' Kaadhalan',' Mano',' Swarnalatha','Classical',' A.R.Rahman'),(13,'Kannalanae',' Bombay',' Chitra ',' A.R.Rahman','Melody',' Bombay/Kannalanae.MP3'),(14,'Injee Idu Palage',' Dhevar Magan',' Janaki',' Ilayaraja','Romantic',' Dhevar Magan/injee idupalagee-female.MP3'),(15,'Clash of Titans -The War Story',' Pudhupettai',' Instrumental',' Yuvan Shankar Raja','Jazz',' Pudhupettai/Tamilmp3world.Com - The_War_Story.mp3'),(16,'01- Thiru Thiruda - Sujata',' Five Stat','Srinivas',' Sujata','HipPop','ThirudaThirudi/song.mp3'),(17,'Mathadu Mathadu.mp3',' Arunaachalam',' S.P.B',' Chitra','Hindustani',' Deva'),(18,'Maasaru Ponne Varuga.mp3',' Dhevar Magan',' Swarnalatha',' Minmini','Folk',' Ilayaraja'),(19,'Jeans Theme',' Jeans',' Unknown',' A.R.Rahman','Rock',' Jeans/Jeans Theme.mp3'),(20,'Oru Naalil',' Pudhupettai',' Yuvan Shankar Raja',' Yuvan Shankar Raja','Pop',' Pudhupettai/Tamilmp3world.Com - Oru_Naalil.mp3'),(21,'Machi Open The Bottle',' Mangatha',' Mano',' Premgi Amaran','Classical',' Tippu'),(22,'Ninaikindra Paathaiyil',' Aathmaa',' Janaki',' Ilayaraja','Melody',' Aathmaa/1993 Aathma Ninaikindra Paathaiyil Ilayaraja.mp3'),(23,'En Swasa Katrae',' En Swaasa Kaatre',' M. G. Sreekumar',' Chitra','Romantic',' A.R.Rahman'),(24,'Mankatha Theme Music',' Mangatha',' Yuvan Shankar Raja',' Yuvan Shankar Raja','Jazz',' Mangatha/Mankatha Theme Music.mp3'),(25,'05- Rayile - Unni Krishnan',' Five Stat',' Unni Krishnan',' Parasuram Radha','HipPop',' Anuraadha Sriram'),(26,'Oru Thuli',' En Swaasa Kaatre',' M. G. Sreekumar',' A.R.Rahman','Hindustani',' En Swaasa Kaatre/Oru Thuli.mp3'),(27,'America Endraalum',' Santhosh Subramaniam',' Pushpavanam Kandasaamy',' Manicka Vinayagam','Folk',' Priya'),(28,'Ada Uchanthalai',' Chinna Thambi',' Mano',' Ilayaraja','HipPop',' Chinna Thambi/ada_0001.mp3'),(29,'Ruk Jaa',' Bombay',' Sujatha',' Noel James','Hindustani',' Srinivas'),(30,'Vaanam Thottu Ponna',' Dhevar Magan',' S.P.B',' Ilayaraja','Folk',' Dhevar Magan/vaanam thottu poonaa.MP3'),(31,'Povoma Oorkolam',' Chinna Thambi',' S.P.B',' swarnalatha','Rock',' Ilayaraja'),(32,'Kadhal Sadugudu!',' Alaipayuthe',' S.P. Charan',' Naveen','Pop',' A.R.Rahman'),(33,'Mehangal Ennai Thotu',' Amarkalam',' S.P.B',' Bharadhwaj','Classical',' Amarkalam/Mehangal Ennai Thotu.mp3'),(34,'Girl Friend',' Boys',' Karthik',' Tippu','Melody',' Timmy'),(35,'Uyire Uyire',' Bombay',' Hariharan',' Chitra ','Romantic',' A.R.Rahman'),(36,'Thaakkuthe Kan Thakkuthe',' Baana Kaathadi',' Yuvan Shankar Raja',' Yuvan','Jazz',' Baana Kaathadi/1 - Thaakkuthe Kan Thakkuthe.Mp3'),(37,'Boom Boom',' Boys',' Adnan Sami',' Sadhana Sargam','HipPop',' A.R.Rahman'),(38,'Thottu Thottu Ennai',' Kaadhal',' Haricharan',' Harini Sudhakar ','Hindustani',' Joshwa Sridhar'),(39,'Yakka Yakka',' Nadodigal',' Chandran',' Senthil Dass','Pop',' Srilekha '),(40,'Thirakkaadha',' En Swaasa Kaatre',' P. Unni Krishnan',' Chitra','Classical',' A.R.Rahman'),(41,'Kannale Kaadhal Kavidhai Male',' Aathmaa',' Jesudas',' Ilayaraja','Melody',' Aathmaa/1993 Aathma Kannale Kaadhal Kavidhai Male Ilayaraja.mp3'),(42,'Nayagara',' En Swaasa Kaatre',' Palghat Sreeram',' Harini','Romantic',' Anupama'),(43,'Love Theme',' Santhosh Subramaniam',' Instrumental',' Devi Sri Prasad','Jazz',' Santhosh Subramaniam/Love Theme.mp3'),(44,'Yellae Lama',' 7 Aum Arivu',' Vijay Prakash',' Karthik','HipPop',' Shruti Hassan'),(45,'Khwaja Mere Khwaja(instrumental)',' Jodha Akbhar',' Unknown',' A.R.Rahman','Hindustani',' Jodha Akbhar/Khwaja Mere Khwaja (Instrumental) - www.uyirvani.com.mp3'),(46,'Mangalyam',' Alaipayuthe',' Srinivas',' Clinton','Folk',' A.R.Rahman'),(47,'Vilayaadu Mankatha (Extended Dance Mix)',' Mankatha',' Premgi Amaren',' Yuvan Shankar Raja','HipPop',' Mankatha/Vilayadu Mangatha (Extended Dance Mix).mp3'),(48,'Pul Pesum Poo Pesum',' Pudhupettai',' Vijay Yesudas',' Tanvi Shah','Hindustani',' Yuvan Shankar Raja'),(49,'Aadungada',' Nadodigal',' Velmurugan  ',' Sundhar C Babu','Folk',' Nadodigal/Aadungada - D.Velmurugan.mp3'),(50,'Kannale Kaadhal Kavidhai Duet',' Aathmaa',' Jesudas',' Janaki','Rock',' Ilayaraja'),(51,'Idhayam Idam Maariyadhe',' Jodha Akbhar',' Chitra',' Karthik ','Pop',' A.R.Rahman'),(52,'Kuchi Kuchi',' Bombay',' Hariharan',' Swarnalatha ','Classical',' A.R.Rahman'),(53,'Oru Poongavanam',' Agni Natchathiram',' Janaki',' Ilayaraja','Melody',' Agni Natchathiram/Oru Poongavanam Ilayaraja.mp3'),(54,'Adadaa Adadaa Adadaa',' Santhosh Subramaniam',' Siddharth Narayan',' Devi Sri Prasad','Romantic',' Santhosh Subramaniam/Adada Adada Adada.mp3'),(55,'Kannamoochi Enada',' Kandukonden Kandukonden',' K. S. Chithra',' A.R.Rahman','Jazz',' Kandukonden Kandukonden/Kannaamoochi Yenadaa.mp3'),(56,'Ivanthan En Kana',' Kaadhal',' Sunitha Sarathy ',' Joshwa Sridhar','HipPop',' Kaadhal/IVAN_THAN.MP3'),(57,'Kaadhal Yen Kaadhal',' Mayakkam Enna',' Dhanush',' Selvaraghavan','Hindustani',' G.V'),(58,'Nee Engae',' Chinna Thambi',' Swarnalatha',' Ilayaraja','Jazz',' Chinna Thambi/nee_enge.mp3'),(59,'Annathey Aaduran',' Aboorva Sakotharargal',' S.P.B',' Ilayaraja','HipPop',' Aboorva Sakotharargal/Annathey Aadurar - S.P.B. & Chorus.mp3'),(60,'Inji Idupazhagi',' Dhevar Magan',' Kamal Haasan',' S. Janaki','Hindustani',' Ilayaraja'),(61,'Night Life - Varriya',' Pudhupettai',' Narayan',' Naveen Mathav','Pop',' Ranjith'),(62,'Yaaro Yarukkul Inku',' Chennai 600028',' S.P.B. Charan',' Venkat Prabhu','Classical',' Yuvan'),(63,'03- Engirundu - Vandayada',' Five Stat',' Sandhana Bala ',' Parasuram Radha','Melody',' Anuraadha Sriram'),(64,'Uyire Uyire Piriyaadhey',' Santhosh Subramaniam',' Sagar',' Devi Sri Prasad','Romantic',' Santhosh Subramaniam/Uyire Uyire Piriyadhey.mp3'),(65,'Nerrupu Vayinil',' Pudhupettai',' Kamal Haasan',' Yuvan Shankar Raja','Jazz',' Pudhupettai/Tamilmp3world.Com - Nerrupu_Vayinil.mp3'),(66,'Sollaayoh_-_Sri_Kumar.mp3',' Moga Mul',' Sreekumar',' Ilayaraja','HipPop',' Moga Mul/Sollaayoh_-_Sri_Kumar.mp3'),(67,'Rathiri Nerathu',' Anjali',' S.P.B',' Ilayaraja','Hindustani',' Anjali/1990 Anjali Rathiri Nerathu Ilayaraja.mp3'),(68,'Oh! Oh! Ennanamo',' Chennai 600028',' Anoushka',' Yuvan','Folk',' Chennai 600028/Oh Oh Ennanamo.mp3'),(69,'Suttum Vizhi',' Kandukonden Kandukonden',' Hariharan',' A.R.Rahman','HipPop',' Kandukonden Kandukonden/SuttumVizhi.mp3'),(70,'Theme Music.mp3',' Arunaachalam',' Unknown',' Deva','Hindustani',' Arunaachalam/THEME MUSIC.mp3'),(71,'Innum Enna Thozha',' 7 Aum Arivu',' Balram',' Naresh Iyer','Folk',' Suchith Sureesan'),(72,'Kannai Katti Kollaadhe',' Iruvar',' Hariharan',' A.R.Rahman','Rock',' Iruvar/Kanni katti kollaadhe.mp3'),(73,'Vaanam Namakku',' Anjali',' Karthik Raja',' Yuvan Shankar Raja','Pop',' Bhavatharini'),(74,'Raja Rajathi Raja',' Agni Natchathiram',' Ilayaraja',' Ilayaraja','Classical',' Agni Natchathiram/Raja Rajathi Raja Ilayaraja.mp3'),(75,'The Rise of Damo (Mandarin)',' 7 Aum Arivu',' Hao Wang',' Harris Jayaraj','Melody',' 7 Aum Arivu/06 The Rise of Damo (Mandarin).mp3'),(76,'Narumugaiye',' Iruvar',' Unnikrishnan',' Bombay Jayashree','Romantic',' A.R.Rahman'),(77,'Aayirathil Naan',' Iruvar',' Mano',' A.R.Rahman','Jazz',' Iruvar/Aayirathil Naan.mp3'),(78,'Aracha Santhanam',' Chinna Thambi',' S.P.B',' Ilayaraja','HipPop',' Chinna Thambi/1991 Chinna Tambi Aracha Santhanam Ilayaraja.mp3'),(79,'Adhanda Idhanda.mp3',' Arunaachalam',' S.P.B',' Deva','HipPop',' Arunaachalam/ADHANDA IDHANDA.mp3'),(80,'Pettairap',' Kaadhalan',' Suresh Peters',' Theni Kunjarammal','HipPop',' Shahul Hameed'),(81,'The Pain of love',' Nadodigal',' Hariharan ',' Sundhar C Babu','HipPop',' Nadodigal/The Pain Of Love -Hariharan.mp3'),(82,'Mun Andhi',' 7 Aum Arivu',' Karthik',' Megha','HipPop',' Harris Jayaraj'),(83,'Vaza Vaikkum - S.p.b. & S.janaky.mp3',' Aboorva sakotharargal',' S.p.b',' Janaki','Melody',' Ilayaraja'),(84,'Pudhupettai Main Theme',' Pudhupettai',' Instrumental',' Yuvan Shankar Raja','HipPop',' Pudhupettai/Tamilmp3world.Com - Main_Theme_SMK.mp3'),(85,'Mukundha Mukundha',' Dasavatharam',' Kamal Haasan',' Sadhana Sargam','Folk',' Himesh Reshammiya'),(86,'04- Engalukku - Instrumental',' Five Stat',' Unknown',' Parasuram Radha','HipPop',' Anuraadha Sriram'),(87,'Evano Oruvan',' Alaipayuthe',' Swarnalatha',' A.R.Rahman','HipPop',' Alaipayuthe/evano oruvan!.mp3'),(88,'Unnodu Vazhatha',' Amarkalam',' Chitra',' Bharadhwaj','Jazz',' Amarkalam/Unnodu Vazhatha.mp3'),(89,'02- Sunday - Karthik','mathangi','nitish','jayshree','Country','arsit'),(90,'Adangkaka',' Anniyan',' K.K',' Jassie Gift','Hard Rock',' Shreya Ghoshal'),(91,'Orvasi',' Kaadhalan',' A.R.Rahman',' Suresh Peters','Jazz',' Shahul Hameed'),(92,'Narumugaiyea',' Iruvar',' Unnikrishnan',' Bombay Jayashree','Country',' A.R.Rahman'),(93,'Khwaja Mere Khwaja',' Jodha Akbhar',' A.R.Rahman ',' A.R.Rahman','Blues',' Jodha Akbhar/Khwaja Mere Khwaja - www.uyirvani.com.mp3'),(94,'Jumbalakkaa',' En Swaasa Kaatre',' Rafee',' A.R.Rahman','Rock',' En Swaasa Kaatre/Jumbalakka.mp3'),(95,'Iravu Nilavu',' Anjali',' Janaki',' Karthik Raja','Country',' Yuvan Shankar Raja'),(96,'Un Parvaimele Pattal',' Chennai 600028',' Vijay Yesudas',' Yuvan','Classical',' Chennai 600028/Un Parvaimele.mp3'),(97,'Saroja Saman Nikalo',' Chennai 600028',' Shankar Mahadevan',' Premji Amaran','Hindustani',' Yuvan'),(98,'Vegam Vegam',' Anjali',' Usha Uthup',' Ilayaraja','Melody',' Anjali/1990 Anjali Vegam Vegam Ilayaraja.mp3'),(99,'Balle Lakka',' Mangatha',' Karthik',' Vijay Jesudas','Romantic',' Anusha Dhayanidhi'),(100,'Singam Ondru.mp3',' Arunaachalam',' Malaysia Vasudevan ',' Deva','Country',' Arunaachalam/SINGAM ONDRU.mp3'),(101,'Vaalibathin Kadhalukku',' Aboorva sakotharargal',' S.p.b',' Ilayaraja','Jazz',' Aboorva sakotharargal/VAALIBATHIN KADHALUKKU _ ABOORVA SAGOTHARARGAL.mp3'),(102,'Unnai Nenachen',' Aboorva Sakotharargal',' S.P.B',' Ilayaraja','Melody',' Aboorva Sakotharargal/Unnai Nenachen - S.P.B..mp3'),(103,'Pachchai Nirame!',' Alaipayuthe',' Hariharan',' Clinton','Country',' A.R.Rahman'),(104,'Ale Ale',' Boys',' Karthik',' Chitra Sivaraman','Jazz',' A.R.Rahman'),(105,'Kaadhal Yannai',' Anniyan',' Nakul',' Nelwyn & G. V. Prakash Kumar','Hindustani',' Harris Jayaraj'),(106,'Yamma Yamma',' 7 Aum Arivu',' SP Balasubrahmanyam',' Shwetha Mohan','Country',' Harris Jayaraj'),(107,'Kuyila Pudichu',' Chinna Thambi',' S.P.B',' Ilayaraja','Country',' Chinna Thambi/1991 Chinna Tambi Kuyila Pudichu Ilayaraja.mp3'),(108,'Columbus Columbus',' Jeans',' A. R. Rahman',' A.R.Rahman','Country',' Jeans/KOLAMBUS.mp3'),(109,'Mulumathy',' Jodha Akbhar',' Srinivas ',' A.R.Rahman','Blues',' Jodha Akbhar/Mulumathy- www.uyirvani.com.mp3'),(110,'Mayakkam Enna Theme',' Mayakkam Enna',' Unknown',' G.V','Romantic',' Mayakkam Enna/04 Mayakkam Enna Theme.mp3'),(111,'Ullara Poondhu',' Baana Kaathadi',' Roshini',' Yuvan','Jazz',' Baana Kaathadi/5 - Ullara Poondhu.Mp3'),(112,'Kaadhal - Beat',' Kaadhal',' Haricharan ',' Joshwa Sridhar','HipPop',' Kaadhal/KADHAL__BEAT.MP3'),(113,'Nenja_Guruna_-_Arunmozhi.mp3',' Moga Mul',' Arun Mozhi',' Ilayaraja','Hindustani',' Moga Mul/Nenja_Guruna_-_Arunmozhi.mp3'),(114,'Kiru Kiru Kirukkira',' Kaadhal',' Karthik',' Shalini Singh ','Jazz',' Joshwa Sridhar'),(115,'Eppadi Irundha',' Santhosh Subramaniam',' Tippu and Gopika Poornima',' Devi Sri Prasad','HipPop',' Santhosh Subramaniam/Yeppadi Irundha Yem Manasu.mp3'),(116,'Naan Sonnadhum Mazhai Vandhucha',' Mayakkam Enna',' Naresh Iyer',' Saindhavi','Hindustani',' G.V'),(117,'Oh Sanam Remix',' Dasavatharam',' Himesh Reshammiya',' Mahalakshmi Iyer','Pop',' Himesh Reshammiya'),(118,'Anjali Anjali',' Anjali',' Karthik Raja',' Yuvan Shankar Raja','Classical',' Bhavatharini'),(119,'07- Engalukku - Devan',' Kanika',' Five Stat',' Devan','Melody',' Kanika'),(120,'Mahaganapathy',' Amarkalam',' Bharathwaj ',' Bharadhwaj','Romantic',' Amarkalam/Mahaganapathy.mp3'),(121,'Iyengaaru Veetu Azhage',' Anniyan',' Hariharan',' Harini','Jazz',' Harris Jayaraj'),(122,'Sangeetha.mp3',' Moga Mul',' Yesudas ',' Ilayaraja','HipPop',' Moga Mul/Sangeetha.mp3'),(123,'Sollaiyo Vaaithirundhu',' Moga Mul',' Sreekumar',' Ilayaraja','Hindustani',' Moga Mul/Mogamul_Sollaiyo_SMK.mp3'),(124,'Sambho siva sambho',' Nadodigal',' Shankar Mahadevan ',' Sundhar C Babu','Folk',' Nadodigal/Sambho Siva Sambho - Shankar Mahadevan.mp3'),(125,'Oru Naalil Vazhkai',' Pudhupettai',' Yuvan Shankar Raja',' Yuvan Shankar Raja','HipPop',' Pudhupettai/Tamilmp3world.Com - Oru_Naalil Mix.mp3'),(126,'Endrendrum Endrendrum',' Alaipayuthe',' Srinivas',' Clinton','Hindustani',' Pravin'),(127,'Voda Voda Voda',' Mayakkam Enna',' Dhanush',' G.V','Folk',' Mayakkam Enna/03 Voda Voda Voda.mp3'),(128,'Yaaro Yarukkul Inku',' Chennai 600028',' S.P.B',' Chitra','Rock',' Yuvan'),(129,'Kannaamoochi Yenada Duet',' Kandukonden Kandukonden',' K. S. Chithra',' K. J. Yesudas','Pop',' A.R.Rahman'),(130,'Inthiraiyo',' Kaadhalan',' Sunandha',' Kalyani Menon','Classical',' Minmini'),(131,'Oh Sanam- F',' Dasavatharam',' Kamal Haasan',' Mahalakshmi Iyer','Jazz',' Himesh Reshammiya'),(132,'Valibathin Kaadhalukku',' Aboorva Sakotharargal',' S.P.B',' Janaki','HipPop',' Ilayaraja'),(133,'Something',' Anjali',' Karthik Raja',' Yuvan Shankar Raja','Hindustani',' Bhavatharini'),(134,'Antha Arabi',' Bombay',' A.R.Rahman',' A.R.Rahman','Jazz',' Bombay/Antha arabikadaloram.MP3'),(135,'Errani',' Kaadhalan',' S.P.Balasubramanyam',' S. Janaki','HipPop',' A.R.Rahman'),(136,'Paavum Pudikku',' Kaadhal',' Karthik',' Shalini Singh','Hindustani',' Tippu '),(137,'Enakke Enakkaaa',' Jeans',' Unnikrishnan',' Pallavi','Pop',' A.R.Rahman'),(138,'Manu Mohana',' Jodha Akbhar',' Sadhana Sargam ',' A.R.Rahman','Classical',' Jodha Akbhar/Mann Mohanaa.mp3'),(139,'Unnodu Naan',' Iruvar',' Arvind Swamy',' A.R.Rahman','Melody',' Iruvar/Unnodu Naan.mp3'),(140,'Vaa Vaa Anbe Anbe',' Agni Natchathiram',' K. J. Yesudas',' K. S. Chitra','Romantic',' Ilayaraja'),(141,'06- Five Star - a Sriram',' Subha Mudgal',' Five Stat',' Anuradha Sriram','Jazz',' Subha Mudgal'),(142,'Alai Payuthey',' Alaipayuthe',' Kalyani',' Harini','HipPop',' Swarnalatha'),(143,'Poovukku Enna',' Bombay',' Noel James',' Anupama ','Hindustani',' A.R.Rahman'),(144,'September Madham',' Alaipayuthe',' Hariharan',' Swarnalatha','Folk',' A.R.Rahman'),(145,'Nee Naan',' Mankatha',' S. P. Charan & Bhavatharani',' Yuvan Shankar Raja','HipPop',' Mankatha/Nee Naan.mp3'),(146,'Sonthakuralil Pada',' Amarkalam',' Shalini',' Bharadhwaj','Hindustani',' Amarkalam/Sonthakuralil Pada.mp3'),(147,'Natpukullae Oru',' Chennai 600028',' Yuvan Shankar Raja',' Yuvan','Folk',' Chennai 600028/Natpukkulae Oru.mp3'),(148,'Nanbane',' Mangatha',' Madhusree',' Yuvan Shankar Raja','Rock',' Yuvan Shankar Raja'),(149,'Velaku Vepom',' Aathmaa',' Janaki',' Ilayaraja','Pop',' Aathmaa/Velaku Vepom.mp3'),(150,'Pootri Paadadi',' Dhevar Magan',' Ilaiyaraaja',' Mano','Classical',' Ilayaraja'),(151,'Dating',' Boys',' Blaaze',' Vasundhara Das','Jazz',' A.R.Rahman'),(152,'Konjum Mainakkale',' Kandukonden Kandukonden',' Sadhana Sargam',' A.R.Rahman','HipPop',' Kandukonden Kandukonden/Konjum Mainakalae.mp3'),(153,'Unakkena Iruppaen',' Kaadhal',' Haricharan ',' Joshwa Sridhar','Hindustani',' Kaadhal/UNNAKENA_IRUPEN.MP3'),(154,'Selling Dope -The Begining',' Pudhupettai',' Instrumental',' Yuvan Shankar Raja','Jazz',' Pudhupettai/Tamilmp3world.Com - Selling_Dope.mp3'),(156,'Paithiyam Pidikudhu',' Baana Kaathadi',' Karthik',' Yuvan','Hindustani',' Baana Kaathadi/2 - Paithiyam Pidikudhu.Mp3'),(157,'Pura Koondu Pola',' Kaadhal',' Suresh Peters',' Harish Raghavendhra','Pop',' Tippu'),(158,'Kadalikkum',' Kaadhalan',' S.P.Balasubramanyam',' Udit Narayan','Classical',' Pallavi'),(159,'Raja Kaiya Vecha',' Aboorva Sakotharargal',' Kamal',' Manorama','Melody',' Ilayaraja'),(160,'Yenna Solla Pogirai',' Kandukonden Kandukonden',' Shankar Mahadevan',' A.R.Rahman','Romantic',' Kandukonden Kandukonden/Yenna Solla Pogiraai.mp3'),(161,'Hello Mister',' Iruvar',' Harini',' Rajagopal','Jazz',' A.R.Rahman'),(162,'Kuppathu Rajakkal',' Baana Kaathadi',' Hariharan',' Rahul Nambiar','HipPop',' Sathyan'),(163,'Thoongatha Vizhigal',' Agni Natchathiram',' K. J. Yesudas',' S. Janaki','Hindustani',' Ilayaraja'),(164,'Kallai Mattum Kandaal',' Dasavatharam',' Hariharan',' Himesh Reshammiya','Folk',' Dasavatharam/Kallai_Mattum_Kandal_Dasavatharam.mp3'),(165,'Ithu Annai Boomi',' Bombay',' Sujatha',' Noel James','HipPop',' Srinivas'),(166,'Kannodu Kanbathellam..',' Jeans',' Nithyasree Mahadevan',' A.R.Rahman','Hindustani',' Jeans/Kannodu Kaanbadhellam.MP3'),(167,'World Cup Jejikka',' Chennai 600028',' Yuvan Shankar Raja',' Yuvan','Folk',' Chennai 600028/World Cup Jeji.mp3'),(168,'Sollaayoh Vaai Thiranthu',' Moga Mul',' Janaki',' Ilayaraja','Rock',' Moga Mul/MogaMull-SollaayohVaaiThiranthu.mp3'),(169,'Oh Ringa Ringa',' 7 Aum Arivu',' Roshan',' Jerry John','Pop',' Benny'),(170,'Kamalam Paatha Kamalam - Kjj.m',' Moga Mul',' Yesudas ',' Ilayaraja','Classical',' Moga Mul/Kamalam Paadha Kamalam.mp3'),(171,'Katru Kudhirayile',' Kaadhalan',' Sujatha',' A.R.Rahman','Jazz',' Kaadhalan/KATRU.mp3'),(172,'Maro Maro',' Boys',' Karthik',' Kunal Ganjawala','HipPop',' George'),(173,'Anbe Anbe ...',' Jeans',' Hariharan',' Anuradha Sriram','Hindustani',' A.R.Rahman'),(174,'Theendai Theendai',' En Swaasa Kaatre',' S.P.B',' Chitra','Jazz',' A.R.Rahman'),(175,'Athisiyame...',' Jeans',' Unnikrishnan',' Sujatha Mohan','HipPop',' A.R.Rahman'),(176,'Snegethane',' Alaipayuthe',' Srinivas',' Sadhana Sargam','Hindustani',' A.R.Rahman'),(177,'Puthiyathu Piranthathu',' Dhevar Magan',' Malaysia Vasudevan',' Ilayaraja','Pop',' Dhevar Magan/puthiyathu piranthathu.MP3'),(178,'Azeem-o-shan',' Jodha Akbhar',' Bonnie Chakraborty',' Mohammad Aslam ','Classical',' A.R.Rahman'),(179,'Vaada Bin Laada',' Mankatha',' Krish & Suchitra',' Yuvan Shankar Raja','Melody',' Mankatha/Vaada Bin Laada.mp3'),(180,'Ennavale',' Kaadhalan',' P. Unnikrishnan',' A.R.Rahman','Romantic',' Kaadhalan/Ennavale Adi Ennavale.mp3'),(181,'Engae Enathu Kavithai',' Kandukonden Kandukonden',' K. S. Chithra',' Srinivas','Jazz',' A.R.Rahman'),(182,'En Seithayo Vidhiyeh',' Amarkalam',' Bharathwaj',' Bharadhwaj','HipPop',' Amarkalam/En Seithayo Vidhiyeh.mp3'),(183,'En Nenjil',' Baana Kaathadi',' Sadhana Sargam',' Yuvan','Hindustani',' Baana Kaathadi/4 - En Nenjil.Mp3'),(184,'Ninnukori Varnam',' Idhayathai Thirudathe',' K. S. Chitra',' Ilayaraja','Folk',' Idhayathai Thirudathe/Varnam Ilayaraja.mp3'),(185,'Ennenna Seidhom Ingae',' Mayakkam Enna',' Harish Raghavendra',' G.V','HipPop',' Mayakkam Enna/05 Ennenna Seidhom Ingae.mp3'),(186,'Vazhkaiyai Josinkida',' Chennai 600028',' Ranjith',' Tippu','Hindustani',' Premji Amaran'),(187,'Kolayilae',' Kaadhalan',' P. Jayachandran',' A.R.Rahman','Folk',' Kaadhalan/KOLAYILAE.mp3'),(188,'Secret of Success',' Boys',' Lucky Ali',' Clinton Cerejo','Rock',' Blaaze'),(189,'Our Story - Enga Area',' Pudhupettai',' Dhanush',' Premji Amaran','Pop',' Yuvan Shankar Raja'),(191,'Going thru Emotions - Prelude',' Pudhupettai',' Instrumental',' Yuvan Shankar Raja','Jazz',' Pudhupettai/Tamilmp3world.Com - Going_Thru_Emotions.mp3'),(192,'Kaa Karuppanukkum',' Dasavatharam',' Shalini Singh',' Himesh Reshammiya','HipPop',' Dasavatharam/Kaa_Karuppanukkum_Dasavatharam.mp3'),(194,'Pudhu Mapillaiku',' Aboorva Sakotharargal',' S.P.B',' S.P.Sailaja','Jazz',' Ilayaraja'),(195,'Yaro Yarodi',' Alaipayuthe',' Mahalaxmi Iyer',' Vaishali','HipPop',' Richa'),(197,'Vilayadu Mangatha',' Mangatha',' Yuvan Shankar Raja',' Ranjith','Pop',' Sucharita'),(200,'Manamagale.mp3',' Dhevar Magan',' Swarnalatha',' Minmini','Romantic',' Ilayaraja'),(202,'Pirai Thedum',' Mayakkam Enna',' Saindhavi',' GV Prakash Kumar','HipPop',' G.V'),(204,'Mazhai vara poguthae','Yennai arinthaal','Pooja','Harris Jayaraj','romance','Music/Yennai arithaal/');
/*!40000 ALTER TABLE `song` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `num_of_playlists` int(11) DEFAULT '0',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1028 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','admin','admin',0),(1000,'Sam','1234','Sam','Charles',3),(1001,'Jim','1234','Jim','Jones',1),(1002,'Rob','1234','Rob','Douglas',0),(1003,'Bob','1234','Bob','Bully',0),(1004,'Dheepak','1234','Dheepak','Chidambaram',0),(1005,'scott','1234','scott','smith',1),(1006,'william','1234','william','henry',0),(1007,'charles','1234','charles','maston',0),(1008,'barnes','1234','barnes','nobell',0),(1009,'thames','1234','thames','newas',1),(1010,'roger','1234','roger','mcglashan',0),(1011,'james','1234','james','bond',0),(1012,'minu','1234','minu','priya',0),(1013,'maya','1234','maya','vj',0),(1014,'sona','1234','sona','siva',0),(1015,'matt','1234','matt','walter',0),(1016,'serena','1234','serena','william',0),(1017,'blair','1234','blair','john',2),(1018,'nate','1234','nate','archibald',0),(1019,'chuck','1234','chuck','bass',0),(1020,'dan','1234','dan','humphrey',0),(1021,'lilly','1234','lilly','bass',0),(1022,'rufus','1234','rufus','james',0),(1023,'dorota','1234','dorota','vanya',0),(1024,'vanessa','1234','vanessa','abraham',0),(1027,'testuser','test','test','user',0);
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

-- Dump completed on 2015-12-14 23:01:15
