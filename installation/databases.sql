
DROP TABLE IF EXISTS `bxc_relaydomains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bxc_relaydomains` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `domain` varchar(256) NOT NULL,
  `serverid` varchar(24) NOT NULL,
  `fromuserid` int(8) NOT NULL,
  `sourceexec` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bxc_relaydomains`
--

LOCK TABLES `bxc_relaydomains` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `bxc_servers`
--

DROP TABLE IF EXISTS `bxc_servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bxc_servers` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `servername` varchar(256) NOT NULL,
  `port` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bxc_servers`
--

LOCK TABLES `bxc_servers` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `bxc_users`
--

DROP TABLE IF EXISTS `bxc_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bxc_users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `token` varchar(128) DEFAULT NULL,
  `rank` varchar(25) NOT NULL,
  `tries` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bxc_users`
--

LOCK TABLES `bxc_users` WRITE;
/*!40000 ALTER TABLE `bxc_users` DISABLE KEYS */;
INSERT INTO `bxc_users` VALUES (1,'admin','$2y$10$6cSIpsJBxGGE5wT.WoG9wO7eHCMBQOm5cP2e.d9KA8w2WysC7mSMy',NULL,'admin',1);
/*!40000 ALTER TABLE `bxc_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'backupmail'
--

--
-- Dumping routines for database 'backupmail'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-24 23:03:14
