/*
SQLyog Community- MySQL GUI v8.21 
MySQL - 5.5.8 : Database - flashdrive
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`flashdrive` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `flashdrive`;

DROP TABLE IF EXISTS `violations`;

CREATE TABLE `violations` (
	`surname` varchar(25) NOT NULL,
	`firstname` varchar(25) NOT NULL,
	`middlename` varchar(25) NOT NULL,
	`violation` varchar(25) NOT NULL,
	`officer` varchar(75) NOT NULL,
	`date` varchar(9) NOT NULL,
	CONSTRAINT `violations_surname` FOREIGN KEY(`surname`) REFERENCES drivers(`surname`) ON DELETE CASCADE,
	CONSTRAINT `violations_fname` FOREIGN KEY(`firstname`) REFERENCES drivers(`firstname`) ON DELETE CASCADE,
	CONSTRAINT `violations_mname` FOREIGN KEY(`middlename`) REFERENCES drivers(`midname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `drivers` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`username`,`password`) values ('test','1234');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;