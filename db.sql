/*
SQLyog Community v12.5.0 (64 bit)
MySQL - 10.4.19-MariaDB : Database - schoolboard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`schoolboard` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `schoolboard`;

/*Table structure for table `boards` */

DROP TABLE IF EXISTS `boards`;

CREATE TABLE `boards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `boards` */

insert  into `boards`(`id`,`name`) values 
(1,'CSM'),
(2,'CSMB');

/*Table structure for table `grades` */

DROP TABLE IF EXISTS `grades`;

CREATE TABLE `grades` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) NOT NULL,
  `board_id` int(11) NOT NULL,
  `grade1` float DEFAULT -1,
  `grade2` float DEFAULT -1,
  `grade3` float DEFAULT -1,
  `grade4` float DEFAULT -1,
  PRIMARY KEY (`student_id`),
  KEY `board_id_constraint` (`board_id`),
  CONSTRAINT `board_id_constraint` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `grades` */

insert  into `grades`(`student_id`,`student_name`,`board_id`,`grade1`,`grade2`,`grade3`,`grade4`) values 
(1,'student1',1,9,8,-1,-1),
(2,'student2',2,8,8,8,7),
(3,'student3',2,7,8,9,-1),
(4,'student4',1,6,4,8,7),
(5,'student5',2,7,8,5,6);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
