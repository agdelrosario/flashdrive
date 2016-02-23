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

/*Table structure for table `drivers` */

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `idnum` int(7) NOT NULL,
  `idcolor` varchar(7) NOT NULL,
  `surname` varchar(15) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `midname` varchar(15) DEFAULT NULL,
  `street` varchar(15) DEFAULT NULL,
  `barangay` varchar(15) DEFAULT NULL,
  `municipality` varchar(15) DEFAULT NULL,
  `province` varchar(15) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `pob` varchar(60) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `civil` varchar(10) DEFAULT NULL,
  `jeep` varchar(10) DEFAULT NULL,
  `spouse_sname` varchar(15) DEFAULT NULL,
  `spouse_fname` varchar(25) DEFAULT NULL,
  `spouse_mname` varchar(15) DEFAULT NULL,
  `spouse_occ` varchar(25) DEFAULT NULL,
  `spouse_contact` varchar(40) DEFAULT NULL,
  `children` int(3) DEFAULT NULL,
  `emer_sname` varchar(15) DEFAULT NULL,
  `emer_fname` varchar(25) DEFAULT NULL,
  `emer_mname` varchar(15) DEFAULT NULL,
  `emer_address` varchar(60) DEFAULT NULL,
  `emer_contact` varchar(40) DEFAULT NULL,
  `license` varchar(20) DEFAULT NULL,
  `license_place` varchar(60) DEFAULT NULL,
  `license_exp` DATE DEFAULT NULL,
  `plate_number` varchar(20) DEFAULT NULL,
  `sticker_number` varchar(20) DEFAULT NULL,
  `franchise_exp` DATE DEFAULT NULL,
  `contact` varchar(40) DEFAULT NULL,
  `operator` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idnum`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `drivers` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `logged` varchar(10) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `verified` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `violations` */

DROP TABLE IF EXISTS `violations`;

CREATE TABLE `violations` (
	`idno` int(7) NOT NULL,
	`surname` varchar(25) NOT NULL,
	`firstname` varchar(25) NOT NULL,
	`middlename` varchar(25) NOT NULL,
	`num` int (7) NOT NULL,
	`violation` varchar(25) NOT NULL,
	`officer` varchar(75) NOT NULL,
	`date` DATE NOT NULL,
	FOREIGN KEY (`idno`) REFERENCES drivers(`idnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `current_id`;

CREATE TABLE `current_id` (
	`idno` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ids`;

CREATE TABLE `ids` (
	`fromrecord` int(7) NOT NULL,
	`idno` int(7) NOT NULL,
	`color` varchar(7) NOT NULL,
	FOREIGN KEY (`fromrecord`) REFERENCES drivers(`idnum`),
	PRIMARY KEY (`idno`)
	
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`username`,`password`, `role`, `logged`, `ip`, `email`, `verified`, `code`) values ('admin','128ci-ovcca','administrator','false','0.0.0.0', 'ovccauplb@yahoo.com', 'true', 'admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
