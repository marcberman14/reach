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
INSERT INTO `administrator` VALUES (1,98,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','SouthAfrica','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075'),(1,101,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','SouthAfrica','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075'),(1,102,'1991-05-29','1','Fransch Hoek Drive','Oakdene','Johannesburg','SouthAfrica','2190','0114354075','0832865231','0114354075','232288','IT','DBA','bapol1@student.monash.edu','byronpolley@me.com','0114354075');
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
  `backup_date` date NOT NULL,
  `backup_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_assets`
--

LOCK TABLES `lesson_assets` WRITE;
/*!40000 ALTER TABLE `lesson_assets` DISABLE KEYS */;
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
  CONSTRAINT `permission_group_members_fk` FOREIGN KEY (`permission_id`) REFERENCES `permission_group` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (98,2,'Marc','Berman','marc@bermanz.co.za','628df050a5a090f822c75651d0b5c4f871a67503f52439812e25e2475c6b73ad1715736dc6c762751dd393775219d269aa38ea6e5a596efed1423e9342f26bbc','7f7543068c334b83af61b6bf86eb5f0d368d32231efca2fb7dab1b51dd4225cf18226e26f4d5aeebcb2df4499b1d06f07653a71c1a3ff8067bee6287486816de','active','9c8502708ca247fdd89eda2354c8e074555a013b23c88692288d9d64e0c345a791dc64a8c92d237823f4a2a48da9b106545d506b33ec22b5dd9238f2ef6aa72a.png','3e4786efb666dc9d39b0e5e6bf8d33375c9891d00dc741f82c871fc82e464eed9d44520c32dde2e167ff30ec767bfd79af0a91fb9b6aa5efe9f1d7d0f86d6b43','Female','2015-10-26 22:58:23'),(99,1,'Keo','Ramz','keo@gmail.com','7a61e30694d9c7b67966d4bb7f2227bb35f01ffd7d8ef8d85aac438104af73e55f97f394ed3830b6c038bc9924a9c5141e4c8c1ad330e217c24c3a3df11c33a0','c5e6678c5bbb999df876da4b5dfdc354793705375b0bfd17fad6338ba176d3348ea22d99ffdcf07d31c4356dad32a0dc7466aa29f844046350681f57115a6648','active','default.png','20c803da370a2021505c7b6a941be04e53f2f1b8061128158a8305f8ee9372c67d609ee3aa816965c5d4f6df0c0909a8a76a2d8127ed8be211c520724f102cb0','Male','2015-10-25 19:36:50'),(100,2,'Suhasini','Manuel','suhasini.naomi@gmail.com','ec8a82be25fb2429308c02701cc98121121c5f7292b659d08b48697a644066c1d7d3b888620b8eea974f8399d39bf1e28957f4113bbb3b068506a5413c21332c','e50618d5ee15408ffc7a494c2fab07def9b5dfd08beeb62985ae2a2ad044ecacb8275edbc2c2c3f5a6f50cfde59e4bdc979c5d9065d3f15825ea3d729ea907ba','active','4d9cf45c8880dea2392b52036cdf5075b327977ead4be201aedba6995d1faafc40a5b2bb15548cf3f4f6086e2a2b93573011841ea9094f4850209d28358511ec.jpg','0a203df80804853672f12e4716e578df5bd99592dae711992fb821283d5bfef2bd615437428e6babbdb4601fe83faabe2e04b5e879d33a81713c997137a88383','Male','2015-10-25 19:38:12'),(101,4,'Byron','Polley','b_b0t@live.com','a3b7547274d57c25d415d441a431dcd199e4a7fa84f54d72ad3a6a86bb41e54f8cad4eeecd63bdbb886e19b54e76545a7a6a6a1fd8a7f17b7b9d406378b45d93','3e210d07c2449abb5d5e935f5b7a1232454a3e13293b29fd1c7c99a39c28863e6893549fd5a45d808d4a959901df655d5a79d923b287d947522332f4bf6d0d26','active','default.png','f76e23f50ffa3ff60184c4de95fa881806ef45a3ee06681251f2a2eded7cc4fedfdb64ed71cd35776d15110cd7f5191842b91935cb61cac69a1fa974838a37ae','male','2015-10-18 12:30:55'),(102,2,'Kutlwano','Molete','kutlwanokm@gmail.com','fa70aaf2e6012a62b447bc127a72d22c49bdd235cb9150dd098c3302287ea2fcb9301123bad6ffaf83d890dd0fb8db802946c93a8f0e62591738da33d674b38b','483bd9e79a1b4e961b3c115136ed219fd181f07933223f48c0bb984981210b3d47f6a74131cd0133b71dab109d36c3277074de1e56dd6a6ea5766d1a9a5127af','active','b675438f99bf41abac46ad6f949e44fd2af5608a3153a1d3c4404841e8fb7d776a24aa33947155a97943058972a34cb2e45abc5fbf9db6ed958d182a01731b4b.jpg','2d803cc14cc4b02334cc6cda913fa001e57745b82e0d57bc9a816489899f2e9c097ccafe1fe346084447f4e2fae2c91030fb982d3fe052972ce5366750a6184f','male','2015-10-22 12:04:20'),(103,3,'Marc','Berman','mcber5@student.monash.edu','d8cb5857fe73a1a635115dc139f35f926b6c33f3f5ddc0e58d6acdc85b8396b338490d534790048960a8e4cdcc84d3357d4572e4f8729b6b1f995598e0bc0cd0','5aeabeabc0c04da0f83fd8b3228128dd3368ef369ab18be109726ac3708a1ef8ba3916736d3006e4f63a8ca257f7c32ef59e0be6779dc4bdeae9b2c8ea7f52ef','noprofile','default.png','e6bfbffa9ba52df6ffe71806b7b55b834f7cd001ff1e6092227bc90ee9a76aa644ef7dc2c3926fb6b5c38fbec8b7263068678a9d58a39ee1a7ecf959bd08eb96','Female','2015-10-26 23:18:33');
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
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (21,'What are you working on right now?','Tests','Nothing','Lessons','Questions',54),(22,'One?','number','integer','decimal','natural',54),(23,'What is the colour of the sky','Blue','Red','Orange','Gold',55),(24,'How are you?','Good','Better','Best','Alive',54),(25,'What does IP stand for?','Inernet Protocol','Insignificant Planet','Important People','I Passed',56),(26,'What am I doing now?','Typing','Nothing','Watching','Nothing again',56),(27,'Who is you talking to?','yourself','Me','her','him',56),(28,'What?','Nothing','Huh','Oh','Yeah',56),(29,'Reach','Monash','UJ','Wits','UP',55),(30,'Are you?','dead','blind','bored','scared',56);
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
  `question_id` int(11) NOT NULL,
  `grade` int(100) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `result_ibfk1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_ibfk2` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `result_ibfk3` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result`
--

LOCK TABLES `result` WRITE;
/*!40000 ALTER TABLE `result` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (8,99,'144','Peter Rd','Ruimsig','Johannesburg','South Africa','1740','0793186245','0793186245','0793186245','0793186245','1993-07-23','Cornerstone College',10),(9,101,'1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','0114354075','0832865231','0114354075','0114354075','1991-05-29','Parktown',12),(10,102,'144','Peter Rd','Ruimsig','Johannesburg','South Africa','1740','0793186245','0793186245','0793186245','0793186245','1993-07-23','0793186245',10),(11,98,'144','Peter Rd','Ruimsig','Johannesburg','South Africa','1740','0793186245','0793186245','0793186245','0793186245','1993-07-23','Cornerstone College',10);
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentsubject`
--

LOCK TABLES `studentsubject` WRITE;
/*!40000 ALTER TABLE `studentsubject` DISABLE KEYS */;
INSERT INTO `studentsubject` VALUES (24,99,'Math Core'),(25,99,'Life Orientation'),(26,99,'English'),(27,99,'Biology'),(28,99,'Afrikaans'),(29,99,'Physical Sciences'),(30,99,'Computer Sciences'),(31,99,'Accounting'),(32,99,'Visual Art'),(33,101,'Math Core'),(34,101,'Life Orientation'),(35,101,'English'),(36,101,'Biology'),(37,101,'Afrikaans'),(38,101,'Physical Sciences');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjectlesson`
--

LOCK TABLES `subjectlesson` WRITE;
/*!40000 ALTER TABLE `subjectlesson` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (79,'Marc Test','testing updated','12','This is a sparta mission ','Cheeese'),(81,'FIT4040','Networks','11','TCP and IP','IT');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (8,102,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','South Africa','2162','12'),(9,98,'Trinity House High School','12','7','0613440964','0836354494','marccolinber@gmail.com','1992-10-14','14 Kenoppiesdoring Randpark Ridge Ext 14','0117944532','21','Yellowwood','Randpark Ridge Ext 14','Johannesburg','South Africa','2162','12');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (54,'Work','Please do not delete me from the database',100,79),(55,'Just a test','Nothing much but testing',50,79),(56,'IP','Internet Protocol',50,81);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,100,'1999-02-18','0755541285','0852247563','12','CR Swart','Randburg','Johannesburg','South Africa','2169','Indian','South Africa','Bachelor of Computer and Information Sciences','3','23126892','suhasini.naomi@gmail.com','Female','snman3@student.monash'),(16,101,'1991-05-29','0832865231','0114354075','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','3','23228806','bapol1@student.monash.edu','','bapol1@student.monash.edu'),(17,102,'1992-12-02','0765950950','0766960960','48','Luise Steret','Linmeyer','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','3','25214446','kutlwanokm@gmail.com','','kmmol4@student.monash.edu'),(18,98,'1991-05-29','0832865231','0114354075','1','Fransch Hoek Drive','Oakdene','Johannesburg','South Africa','2190','South african','South Africa','Bachelor-Computer & Info Sciences','3','23228806','bapol1@student.monash.edu','','bapol1@student.monash.edu');
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutorsubject`
--

LOCK TABLES `tutorsubject` WRITE;
/*!40000 ALTER TABLE `tutorsubject` DISABLE KEYS */;
INSERT INTO `tutorsubject` VALUES (61,1,79),(62,1,81);
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

-- Dump completed on 2015-10-26 20:11:37
