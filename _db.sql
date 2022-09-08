/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 5.0.51b-community-nt-log : Database - number_book
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`number_book` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `number_book`;

/*Table structure for table `index_number` */

DROP TABLE IF EXISTS `index_number`;

CREATE TABLE `index_number` (
  `idindex_number` varchar(12) collate utf8_bin NOT NULL COMMENT '11หลัก\n- 4 หลัก แรกปี\n- 2 หลัก ถัดมา เดือน\n- 2 หลัก ถัดมา วัน\n- 3 สุดท้าย เลขลำดับที่ต่อวัน',
  `index_number` varchar(45) collate utf8_bin default NULL COMMENT 'เลขที่หนังสือ',
  `date_inbook` date default NULL COMMENT 'วันรับเอกสาร',
  `date_number` date default NULL COMMENT 'วันออกเลขหนังสือ',
  `appm_section_id` int(11) default NULL COMMENT 'รหัสหน่วยงาน',
  `in_to` varchar(100) collate utf8_bin default NULL COMMENT 'ส่งถึง(เรียน)',
  `in_subject` varchar(200) collate utf8_bin default NULL COMMENT 'ชื่อหัวข้อ',
  `in_type` varchar(2) collate utf8_bin default NULL COMMENT 'ประเภท \n1= ภายใน\n2 = นอก',
  `pdf_file` varchar(100) collate utf8_bin default NULL COMMENT 'ชื่อไฟล์ที่อัพโหลด',
  `username_req` varchar(100) collate utf8_bin default NULL COMMENT 'user ผู้ขอเลขหนังสือ',
  `comment` mediumtext collate utf8_bin,
  `tel` varchar(45) collate utf8_bin default NULL COMMENT 'เบอร์โทร\n',
  `status` varchar(1) collate utf8_bin default '1' COMMENT 'สถานะ 0=ไม่ใช้งาน 1=ใช้งาน',
  `medcode` varchar(7) collate utf8_bin default NULL COMMENT 'med code 7 หลัก *ผู้เพิ่ม',
  PRIMARY KEY  (`idindex_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `log_file` */

DROP TABLE IF EXISTS `log_file`;

CREATE TABLE `log_file` (
  `index_number_idindex_number` int(11) NOT NULL,
  `date` datetime default NULL COMMENT 'วัน',
  `medcode` varchar(45) collate utf8_bin default NULL,
  `log_type` varchar(2) collate utf8_bin default NULL COMMENT 'ประเภท\n1 = อัพโหลด\n2 = แก้ไข',
  KEY `fk_log_file_index_number_idx` (`index_number_idindex_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
