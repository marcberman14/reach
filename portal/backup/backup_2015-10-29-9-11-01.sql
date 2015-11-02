-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: reach
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB-1~trusty-log

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `streetnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `streetname` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `homenumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `worknumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `staffnumber` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `jobdepartment` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `jobposition` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `monashmail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alternativeemail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `altcontactnum` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `user_id` (`user_id`),
  KEY `adminId` (`adminId`),
  CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,98,'1991-05-29','21','Yellowwood Road','Randpark Ridge Ext14','Johannesburg','South Africa','2162','0832865231','0114354075','0114354076','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075'),(1,100,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075'),(1,101,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075'),(1,102,'1991-05-29','48','Luise Street','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','kmmol4@student.monash.edu','0114354075'),(1,107,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `backup_id` int(64) NOT NULL AUTO_INCREMENT,
  `backup_date` datetime NOT NULL,
  `backup_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES (10,'2015-10-27 08:03:29','/var/www/html/portal/backup/backup_2015-10-27-13-03-29.sql'),(11,'2015-10-27 08:43:16','/var/www/html/portal/backup/backup_2015-10-27-13-43-16.sql'),(12,'2015-10-27 08:44:20','/var/www/html/portal/backup/backup_2015-10-27-13-44-20.sql'),(13,'2015-10-27 08:52:20','/var/www/html/portal/backup/backup_2015-10-27-13-52-20.sql'),(14,'2015-10-27 08:55:48','/var/www/html/portal/backup/backup_2015-10-27-13-55-48.sql'),(15,'2015-10-27 14:04:53','/var/www/html/portal/backup/backup_2015-10-27-14-04-53.sql'),(16,'2015-10-27 17:04:40','/var/www/html/portal/backup/backup_2015-10-27-17-04-40.sql'),(17,'2015-10-28 22:20:31','/var/www/html/portal/backup/backup_2015-10-28-22-20-31.sql'),(18,'2015-10-29 09:02:24','/var/www/html/portal/backup/backup_2015-10-29-9-02-24.sql'),(19,'2015-10-29 09:02:40','/var/www/html/portal/backup/backup_2015-10-29-9-02-40.sql'),(20,'2015-10-29 09:03:52','/var/www/html/portal/backup/backup_2015-10-29-9-03-52.sql'),(21,'2015-10-29 09:04:59','/var/www/html/portal/backup/backup_2015-10-29-9-04-59.sql'),(22,'2015-10-29 09:09:15','/var/www/html/portal/backup/backup_2015-10-29-9-09-15.sql'),(23,'2015-10-29 09:11:01','/var/www/html/portal/backup/backup_2015-10-29-9-11-01.sql');
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrolment`
--

DROP TABLE IF EXISTS `enrolment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrolment` (
  `enrol_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_enrolled` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`enrol_id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `enrolment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrolment_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrolment`
--

LOCK TABLES `enrolment` WRITE;
/*!40000 ALTER TABLE `enrolment` DISABLE KEYS */;
INSERT INTO `enrolment` VALUES (6,'2015-10-28 14:53:02',11,81),(7,'2015-10-28 21:29:22',13,82),(8,'2015-10-28 21:29:43',13,83),(9,'2015-10-28 21:30:16',13,79),(10,'2015-10-28 21:30:41',13,81),(11,'2015-10-28 21:33:29',8,81),(12,'2015-10-28 22:59:52',8,79),(13,'2015-10-28 23:15:30',13,84);
/*!40000 ALTER TABLE `enrolment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `lesson_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lesson_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lesson_description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lesson_concpet` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lesson_material` varchar(1000) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `lesson_content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lesson_video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` VALUES (5,0,'Routers','Routers','Learn about routers','Routers','Router textbook','',''),(6,0,'TCP/IP','Network Basics','Networking','System Architecture','Wireshark','','');
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson_assets`
--

DROP TABLE IF EXISTS `lesson_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson_assets` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `lesson_assets_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_assets`
--

LOCK TABLES `lesson_assets` WRITE;
/*!40000 ALTER TABLE `lesson_assets` DISABLE KEYS */;
INSERT INTO `lesson_assets` VALUES (28,5,'video','https://www.youtube.com/embed/TjbDTz40jDk','Router'),(29,5,'pdf','332af4e62c01a733c5c5a45d1f99022cd70400508adb649da800af95332dbf42caba5e2bb081bd9823a15ea0ef5262cf7b69524a71300b493a5cea5a0b7a01d5.pdf','FIT2003_Assignment_1_2014 S2.pdf');
/*!40000 ALTER TABLE `lesson_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `members_login_attempts_fk` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` VALUES (99,'1446105688'),(99,'1446105705');
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `active` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilepicurl` varchar(2083) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(512) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `permission_group_members_fk` (`permission_id`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  CONSTRAINT `permission_group_members_fk` FOREIGN KEY (`permission_id`) REFERENCES `permission_group` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (98,4,'Marc','Berman','marc@bermanz.co.za','46a1dc5ca9e468bbe25f40560a557b44fd6f24fbb17da7a79cd3999d80b15a6383c5828a9f9fbe233ae6dd2397d34b39c8312f9aac3e0102936a70b67d89e18c','f6664a7d22fb7888020dfeeca5855c8b82b6a58bd55d896aba8c5dd037f3c434e5e4a0c8135ffb0d8ea5e1e19f77ec45aa17d61e61f6a635e7de0d866ab02dfc','active','3831e995bb8be22dd01cc788502e61440f7157ab34db7643bbdd9959b237bcd3fe711c2c121f423586ad3e53d1a254d63dcff854ad1acdadd812bd0618e76128.jpg','3e4786efb666dc9d39b0e5e6bf8d33375c9891d00dc741f82c871fc82e464eed9d44520c32dde2e167ff30ec767bfd79af0a91fb9b6aa5efe9f1d7d0f86d6b43','Male','2015-10-29 07:57:16'),(99,2,'Keo','Ramz','keo@gmail.com','7a61e30694d9c7b67966d4bb7f2227bb35f01ffd7d8ef8d85aac438104af73e55f97f394ed3830b6c038bc9924a9c5141e4c8c1ad330e217c24c3a3df11c33a0','c5e6678c5bbb999df876da4b5dfdc354793705375b0bfd17fad6338ba176d3348ea22d99ffdcf07d31c4356dad32a0dc7466aa29f844046350681f57115a6648','active','default.png','20c803da370a2021505c7b6a941be04e53f2f1b8061128158a8305f8ee9372c67d609ee3aa816965c5d4f6df0c0909a8a76a2d8127ed8be211c520724f102cb0','Male','2015-10-29 02:03:48'),(100,2,'Suhasini','Manuel','suhasini.naomi@gmail.com','ec8a82be25fb2429308c02701cc98121121c5f7292b659d08b48697a644066c1d7d3b888620b8eea974f8399d39bf1e28957f4113bbb3b068506a5413c21332c','e50618d5ee15408ffc7a494c2fab07def9b5dfd08beeb62985ae2a2ad044ecacb8275edbc2c2c3f5a6f50cfde59e4bdc979c5d9065d3f15825ea3d729ea907ba','active','4d9cf45c8880dea2392b52036cdf5075b327977ead4be201aedba6995d1faafc40a5b2bb15548cf3f4f6086e2a2b93573011841ea9094f4850209d28358511ec.jpg','0a203df80804853672f12e4716e578df5bd99592dae711992fb821283d5bfef2bd615437428e6babbdb4601fe83faabe2e04b5e879d33a81713c997137a88383','Male','2015-10-29 07:49:20'),(101,4,'Byron','Polley','b_b0t@live.com','a3b7547274d57c25d415d441a431dcd199e4a7fa84f54d72ad3a6a86bb41e54f8cad4eeecd63bdbb886e19b54e76545a7a6a6a1fd8a7f17b7b9d406378b45d93','3e210d07c2449abb5d5e935f5b7a1232454a3e13293b29fd1c7c99a39c28863e6893549fd5a45d808d4a959901df655d5a79d923b287d947522332f4bf6d0d26','active','default.png','f76e23f50ffa3ff60184c4de95fa881806ef45a3ee06681251f2a2eded7cc4fedfdb64ed71cd35776d15110cd7f5191842b91935cb61cac69a1fa974838a37ae','Male','2015-10-27 16:39:35'),(102,3,'Kutlwano','Molete','kutlwanokm@gmail.com','ab5936446f184a972b4e75a7b8bd398e95fbb8595a6f9553748ea10920a12f5cf306042c5ba3a248b6c8ad5e9a2896b778d252fe0e5698d2cc9d8257a2a32331','80feb864426364fdb5d53bc4f71a4a575b5deba6dd2b830a3882433a128732065b4870cb99d8adb6061459d100d621a5aad754b22a2eaace32aa1fbf5826ef09','active','b675438f99bf41abac46ad6f949e44fd2af5608a3153a1d3c4404841e8fb7d776a24aa33947155a97943058972a34cb2e45abc5fbf9db6ed958d182a01731b4b.jpg','2d803cc14cc4b02334cc6cda913fa001e57745b82e0d57bc9a816489899f2e9c097ccafe1fe346084447f4e2fae2c91030fb982d3fe052972ce5366750a6184f','male','2015-10-29 00:59:13'),(103,3,'Marc','Berman','mcber5@student.monash.edu','d8cb5857fe73a1a635115dc139f35f926b6c33f3f5ddc0e58d6acdc85b8396b338490d534790048960a8e4cdcc84d3357d4572e4f8729b6b1f995598e0bc0cd0','5aeabeabc0c04da0f83fd8b3228128dd3368ef369ab18be109726ac3708a1ef8ba3916736d3006e4f63a8ca257f7c32ef59e0be6779dc4bdeae9b2c8ea7f52ef','active','default.png','e6bfbffa9ba52df6ffe71806b7b55b834f7cd001ff1e6092227bc90ee9a76aa644ef7dc2c3926fb6b5c38fbec8b7263068678a9d58a39ee1a7ecf959bd08eb96','Male','2015-10-27 13:44:15'),(107,1,'Tumisang','Maboa','tumiemaboa@gmail.com','a58c113c077d35bfacd072db737c0121a4658411678a4d84e24f41e9d9862b833e958712676e9825977d8988eb2b50082bf9c7a605882950aab661bf73c783ad','ad80feb7a703c1c261c0fea718ea0a427ac25e5966154c6b581c5e55e8f5c12ce292fcaa9f4ff392a4e0205bc79b5d1785715635a8fee1e1436b206625cb45d8','active','default.png','8799263071de9a55706bad4c57b5f4f076d7798e670f00e3a573d5e276b38cd22016221b680cc6487a59e6b515a0887cd93d27d91522a9124d62b4255812d1ba','male','2015-10-29 02:08:09'),(110,2,'John','Doe','johndoe@email.com','a2b654587318e01092f3e3c5f8ff030b6058cff350d2b88b294531cd3839b1622327a1036bb7da4a8254e81099c02140ade8cdfc2c51de9f0b3eee60203a4857','2913e4972b1463efed95c7b63cc2bb6919059cb5a528b43baa3f22160d4a1a311dd098d3011698b6ac1e8c4f09ff1a4c7722e49b5a86097aacd6cbf07560b4e2','inactive','default.png','237297b19b6d3e989faf5276ddde2a8b4456953a9b582cdffbc7364fbd72d169c61d07962a47099a7dfd8fc2cb8c87922256ea41f05ba9cf52ca97f2de4eca12','male','2015-10-29 00:57:12'),(111,1,'collins','kabali','collinskabali02@gmail.com','b45822419c6ef9c072b5539f411150943487a580764909c9f36dc09758c6521f9f16cf29da76df60b0176a225e90988268db51cb69309dd98b11de24a1867350','882b6b783cf90806a4af38acd589942379f5afd5dc3618a6172a06471d712ef47d5cf52c81e60eba8270619b03609076834d9843b84cb2be2a3cedd5ca37b43c','active','default.png','799b08c5eb7706da2a854d741cd9934b51572f4a6415e842144cfb56c14c1b94ee5284a77240a9766526218754f31ebd01615809eb7c6b2fdfcf4f3781e0ffe1','male','2015-10-29 07:58:17');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_list`
--

DROP TABLE IF EXISTS `pages_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages_list` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `directory` varchar(2083) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pageheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pagetitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permission_id` int(11) NOT NULL,
  `page_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_description` varchar(2000) NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `pages_list_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission_group` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_list`
--

LOCK TABLES `pages_list` WRITE;
/*!40000 ALTER TABLE `pages_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_group`
--

DROP TABLE IF EXISTS `permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_group` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_group`
--

LOCK TABLES `permission_group` WRITE;
/*!40000 ALTER TABLE `permission_group` DISABLE KEYS */;
INSERT INTO `permission_group` VALUES (1,'Student'),(2,'Tutor'),(3,'Teacher'),(4,'Administrator');
/*!40000 ALTER TABLE `permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correctanswer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wronganswer1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wronganswer2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wronganswer3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `test_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `test_id` (`test_id`),
  KEY `correctanswer` (`correctanswer`),
  KEY `question` (`question`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (25,'What does IP stand for?','Inernet Protocol','Insignificant Planet','Important People','I Passed',56),(26,'What am I doing now?','Typing','Nothing','Watching','Nothing again',56),(27,'Who is you talking to?','yourself','Me','her','him',56),(28,'What?','Nothing','Huh','Oh','Yeah',56),(30,'Are you?','dead','blind','bored','scared',56),(34,'The weather is','Sunny','Rain','Cloudy','Red',57),(36,'What is 1+1','2','4','5','4568456545645654564',61),(37,'What is the time now','3:00am','4:00am','6:00am','5:00am',64),(38,'What is a dove','Bird','Soap','Body Lotion','Shampoo',64);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `grade` int(100) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  CONSTRAINT `result_ibfk1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_ibfk2` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result`
--

LOCK TABLES `result` WRITE;
/*!40000 ALTER TABLE `result` DISABLE KEYS */;
INSERT INTO `result` VALUES (28,107,56,10),(36,100,57,0),(37,107,61,12),(38,107,56,10),(39,107,57,10),(40,100,56,20),(41,98,56,20);
/*!40000 ALTER TABLE `result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `studentId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `streetnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `streetname` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `homenumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cellnumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alternativenumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parentnumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `schoolname` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grade` int(2) NOT NULL,
  PRIMARY KEY (`studentId`),
  UNIQUE KEY `userId` (`userId`) USING BTREE,
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `members` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (8,99,'144','Peter Rd','Ruimsig','Johannesburg','South Africa','1740','0793186245','0793186245','0793186245','0793186245','1993-07-23','Cornerstone College',10),(9,101,'1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','0114354075','1991-05-29','Parktown',12),(10,102,'48','Luise Streey','Linmeyer','Johannesburg','South Africa','2740','0793186245','0793186245','0793186245','0793186245','1993-07-23','That school over there',10),(11,98,'21','Yellowwood Road','Randpark Ridge Ext14','Johannesburg','South Africa','1745','0117948476','0613440964','0836354494','0113456748','1993-07-23','Trinity House High School',10),(12,107,'21','Yellowwood Road','Randpark Ridge Ext14','Johannesburg','South Africa','1745','0117948476','0613440964','0836354494','0731285273','1993-07-23','0793186245',10),(13,100,'21','Yellowwood Road','Randpark Ridge Ext14','Johannesburg','South Africa','1745','0117948476','0613440964','0836354494','0731285273','1993-07-23','0793186245',10),(14,110,'12','sdkfmn','dfa','fads','South Africa','2190','45235','23452345','23452','23452','1991-05-29','sdfg',11);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentsubject`
--

DROP TABLE IF EXISTS `studentsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentsubject` (
  `stusubjectid` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stusubjectname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`stusubjectid`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `studentsubject_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentsubject`
--

LOCK TABLES `studentsubject` WRITE;
/*!40000 ALTER TABLE `studentsubject` DISABLE KEYS */;
INSERT INTO `studentsubject` VALUES (24,99,'Math Core'),(25,99,'Life Orientation'),(26,99,'English'),(27,99,'Biology'),(28,99,'Afrikaans'),(29,99,'Physical Sciences'),(30,99,'Computer Sciences'),(31,99,'Accounting'),(32,99,'Visual Art'),(33,101,'Math Core'),(34,101,'Life Orientation'),(35,101,'English'),(36,101,'Biology'),(37,101,'Afrikaans'),(38,101,'Physical Sciences'),(39,110,'Math Core');
/*!40000 ALTER TABLE `studentsubject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjectlesson`
--

DROP TABLE IF EXISTS `subjectlesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjectlesson` (
  `subless_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  PRIMARY KEY (`subless_id`),
  KEY `subject_id` (`subject_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `subjectlesson_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subjectlesson_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjectlesson`
--

LOCK TABLES `subjectlesson` WRITE;
/*!40000 ALTER TABLE `subjectlesson` DISABLE KEYS */;
INSERT INTO `subjectlesson` VALUES (5,81,5),(6,81,6);
/*!40000 ALTER TABLE `subjectlesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `subject_id` int(50) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_grade` varchar(20) NOT NULL,
  `subject_description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_category` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (79,'Marc Test','testing updated','11','This is a sparta mission ','Cheeese'),(81,'FIT4040','Networks','10','TCP and IP','IT'),(82,'FIT 3048','IE','12','Lots of Work','IT'),(83,'FIT2012','IT Professional Practice','10','The final presentation for Semester 2 will be held on Thursday 29 October 2015 in the School of IT Fishbowl (meeting room). You should therefore only need to connect your teamâs presentation laptop to the projector in order to set up in the venue.\r\n\r\nThe first presentation will start at 9:00, and presentations will take place according to the schedule provided below. Please DO NOT BE LATE for your sessions.\r\n\r\nEach team will have 20 minutes ONLY to present their ENTIRE systems for the YEAR. Thereafter, 5 minutes will be allocated for questions. If your group takes longer than 20 minutes, you will be asked to stop presenting. You will be allowed a maximum of 5 minutes to set up before starting your presentation.\r\n\r\nPlease note that the final presentation mark will be based on youâre the quality of the presentation as well as the quality of the solutions presented. The marking rubric is included in this document for your reference. ','Information Technology'),(84,'FIT1234','Example Subject','10','This is just an example','LOL'),(85,'FIT1234','Example Subject','10','This is an Example','I.E'),(86,'AQW 1223','School Subject','12','This lesson contains trig and algebra','Matric');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `takentest`
--

DROP TABLE IF EXISTS `takentest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `takentest` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `question_id` int(100) NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `test_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `takentest`
--

LOCK TABLES `takentest` WRITE;
/*!40000 ALTER TABLE `takentest` DISABLE KEYS */;
INSERT INTO `takentest` VALUES (160,23,'Gold',55,100),(161,29,'Monash',55,100),(162,31,'Exam',55,100),(163,25,'I Passed',56,107),(164,26,'Nothing',56,107),(165,27,'Me',56,107),(166,28,'Nothing',56,107),(167,30,'scared',56,107),(168,35,'2555545885548556',58,100),(169,35,'2555545885548556',58,100),(170,25,'Inernet Protocol',56,107),(171,26,'Nothing',56,107),(172,27,'her',56,107),(173,28,'Nothing',56,107),(174,30,'bored',56,107),(175,23,'Blue',55,100),(176,29,'Monash',55,100),(177,31,'Test',55,100),(178,23,'Blue',55,100),(179,29,'Monash',55,100),(180,31,'Test',55,100),(181,23,'Blue',55,100),(182,29,'Monash',55,100),(183,31,'Test',55,100),(184,23,'Blue',55,100),(185,29,'Monash',55,100),(186,31,'Test',55,100),(187,34,'Rain',57,100),(188,36,'2',61,107),(189,25,'Important People',56,107),(190,26,'Nothing',56,107),(191,27,'her',56,107),(192,28,'Oh',56,107),(193,30,'bored',56,107),(194,34,'Sunny',57,107),(195,25,'Inernet Protocol',56,100),(196,26,'Watching',56,100),(197,27,'him',56,100),(198,28,'Nothing',56,100),(199,30,'bored',56,100),(200,25,'Inernet Protocol',56,98),(201,26,'Watching',56,98),(202,27,'yourself',56,98),(203,28,'Huh',56,98),(204,30,'blind',56,98);
/*!40000 ALTER TABLE `takentest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `teacherId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `schoolemployed` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teachinggrade` varchar(5) NOT NULL,
  `yearsexperience` varchar(6) NOT NULL,
  `cellnumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alternativenumber` varchar(15) NOT NULL,
  `personalemail` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `schooladdress` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `schoolcontact` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `streetnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `streetname` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subjectstaught` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacherId`),
  UNIQUE KEY `userId_2` (`userId`),
  KEY `userId` (`userId`),
  CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `members` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (8,102,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','South Africa','2162','12'),(9,98,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','South Africa','2162','12'),(10,103,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','Aland Islands','2162','Maths'),(11,107,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','Aland Islands','2162','Maths'),(12,100,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','Aland Islands','2162','Maths');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `test_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `test_marks` int(255) NOT NULL,
  `subject_id` int(50) NOT NULL,
  PRIMARY KEY (`test_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `test_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (56,'IP','Internet Protocol',50,81),(57,'Test 1','This is a hard Test...get ready',10,82),(61,'Subject Test','Test for Subject',12,79),(64,'Test 2','Test is hard',12,82),(65,'Test 10','Test for all',10,79);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor` (
  `tutor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `cellnumber` varchar(20) NOT NULL,
  `alternativenumber` varchar(20) NOT NULL,
  `streetnumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `streetname` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `countryresidence` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `studyarea` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `studyyear` varchar(4) NOT NULL,
  `studentnumber` varchar(10) NOT NULL,
  `personalemail` varchar(100) NOT NULL,
  `gender` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `monashemail` varchar(50) NOT NULL,
  PRIMARY KEY (`tutor_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,100,'1999-02-18','0755541285','0852247563','12','CR Swart','Randburg','Johannesburg','South Africa','2169','India','South Africa','Bachelor of Computer and Information Sciences','3','23126892','suhasini.naomi@gmail.com','Female','snman3@student.monash'),(16,101,'1991-05-29','0832865231','0114354075','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','3','23228806','bapol1@student.monash.edu','','bapol1@student.monash.edu'),(17,102,'1992-12-02','0765950950','0766960960','48','Luise Steret','Linmeyer','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','5','25214446','kutlwanokm@gmail.com','','kmmol4@student.monash.edu'),(18,98,'1991-05-29','0832865231','0114354075','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','South african','South Africa','','3','23228806','bapol1@student.monash.edu','','bapol1@student.monash.edu'),(19,107,'1991-05-29','0832865231','0114354075','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','3','23228806','bapol1@student.monash.edu','','bapol1@student.monash.edu');
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutorsubject`
--

DROP TABLE IF EXISTS `tutorsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutorsubject` (
  `tutorsubject_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`tutorsubject_id`),
  KEY `tutor_id` (`tutor_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `tutorsubject_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorsubject_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutorsubject`
--

LOCK TABLES `tutorsubject` WRITE;
/*!40000 ALTER TABLE `tutorsubject` DISABLE KEYS */;
INSERT INTO `tutorsubject` VALUES (61,1,79),(62,1,81),(63,17,82),(64,17,83),(66,1,84),(67,1,86);
/*!40000 ALTER TABLE `tutorsubject` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-29 10:11:01
