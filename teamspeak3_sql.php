CREATE TABLE `teamspeak3_servers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `port` int(10) NOT NULL,
  `qport` int(10) NOT NULL,
  `password` varchar(255) NOT NULL default '', 
  `zone` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;