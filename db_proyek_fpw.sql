/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - db_proyek_fpw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_proyek_fpw` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_proyek_fpw`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('active','banned') DEFAULT 'active',
  `role` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`status`,`role`) values 
(2,'asd','$2y$10$1X5UhmQlwc3C8X840lAuLuMJgX3O373PAwCv7/AEK4eRjfrRCeQgS','steven2@dummy.com','active','admin'),
(3,'scrub','$2y$10$IPqtHDOpo8wqRx4my5ahPuhnB369FPQzTm/VoGwkSK46kSHRjCmgG','scrub@gmail.cum','active','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
