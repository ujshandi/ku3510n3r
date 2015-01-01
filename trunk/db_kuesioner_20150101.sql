-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: minerba_kuesioner
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni` (
  `alumni_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(30) DEFAULT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `alamat` text,
  `email` varchar(25) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `alamat_kantor` text,
  `telepon_kantor` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `klasifikasi_perusahaan` varchar(50) DEFAULT NULL,
  `riwayat_pendidikan` text,
  `pendidikan_ln` text,
  `pendidikan_khusus` text,
  `riwayat_jabatan` text,
  `riwayat_diklat_minerba` text,
  PRIMARY KEY (`alumni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (1,'DT3686','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'DT3355','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'DT4242','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'DT4243','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'DT4244','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'DT4245','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'DT4246','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'DT4116','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'DT4117','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'DT4118','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diklat`
--

DROP TABLE IF EXISTS `diklat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diklat` (
  `diklat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `kategori_kuesioner` enum('ya','tidak') DEFAULT NULL COMMENT 'apakah nanti data diklat muncul di daftar diklat pada saat membuat pertanyaan kuesioner F5',
  `jenis_diklat` smallint(1) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  PRIMARY KEY (`diklat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diklat`
--

LOCK TABLES `diklat` WRITE;
/*!40000 ALTER TABLE `diklat` DISABLE KEYS */;
INSERT INTO `diklat` VALUES (3,'tes 2015','ya',1,2015);
/*!40000 ALTER TABLE `diklat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instansi`
--

DROP TABLE IF EXISTS `instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instansi` (
  `instansi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`instansi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansi`
--

LOCK TABLES `instansi` WRITE;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` VALUES (1,'PT Puting Beliung'),(2,'PT Angin Ribut'),(3,'PT. Cuaca Cerah');
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_diklat`
--

DROP TABLE IF EXISTS `jenis_diklat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_diklat` (
  `jenis_id` smallint(6) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`jenis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_diklat`
--

LOCK TABLES `jenis_diklat` WRITE;
/*!40000 ALTER TABLE `jenis_diklat` DISABLE KEYS */;
INSERT INTO `jenis_diklat` VALUES (1,'Diklat Teknis'),(2,'Diklat Terstruktur'),(3,'Diklat Prajabatan');
/*!40000 ALTER TABLE `jenis_diklat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuesioner`
--

DROP TABLE IF EXISTS `kuesioner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuesioner` (
  `kuesioner_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_buat` date DEFAULT NULL,
  `tema` varchar(255) DEFAULT NULL,
  `periode_awal` date DEFAULT NULL,
  `periode_akhir` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuesioner`
--

LOCK TABLES `kuesioner` WRITE;
/*!40000 ALTER TABLE `kuesioner` DISABLE KEYS */;
INSERT INTO `kuesioner` VALUES (1,'2014-11-11','Analisis Kebutuhan Diklat Untuk Industri Pertambangan','2014-11-11','2015-11-11',NULL);
/*!40000 ALTER TABLE `kuesioner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuesioner_jawaban`
--

DROP TABLE IF EXISTS `kuesioner_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuesioner_jawaban` (
  `tanya_id` bigint(20) NOT NULL DEFAULT '0',
  `responden_id` bigint(20) NOT NULL DEFAULT '0',
  `jawaban` text,
  PRIMARY KEY (`tanya_id`,`responden_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuesioner_jawaban`
--

LOCK TABLES `kuesioner_jawaban` WRITE;
/*!40000 ALTER TABLE `kuesioner_jawaban` DISABLE KEYS */;
INSERT INTO `kuesioner_jawaban` VALUES (1,1,'ya'),(2,1,'tidak'),(3,1,'karena sesuatu ');
/*!40000 ALTER TABLE `kuesioner_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuesioner_pertanyaan`
--

DROP TABLE IF EXISTS `kuesioner_pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuesioner_pertanyaan` (
  `tanya_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kuesioner_id` int(11) DEFAULT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL COMMENT 'Pertanyaan tambahan terkait dengan opsi jawaban, utk pertanyaan jika parent_id nya is not null maka setelah pertanyaan langsung tambahkan editbox',
  PRIMARY KEY (`tanya_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuesioner_pertanyaan`
--

LOCK TABLES `kuesioner_pertanyaan` WRITE;
/*!40000 ALTER TABLE `kuesioner_pertanyaan` DISABLE KEYS */;
INSERT INTO `kuesioner_pertanyaan` VALUES (1,1,'Apakah Visi-Misi lembaga cukup jelas bagi Anda ?',1,NULL),(2,1,'Apakah Visi-Misi tersebut Anda komunikasikan pada bawahan Anda ?',1,NULL),(3,1,'Jika Tidak, sebutkan mengapa ?',1,2),(4,1,'tes',1,1);
/*!40000 ALTER TABLE `kuesioner_pertanyaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuesioner_responden`
--

DROP TABLE IF EXISTS `kuesioner_responden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuesioner_responden` (
  `kuesioner_id` int(11) NOT NULL DEFAULT '0',
  `responden_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kuesioner_id`,`responden_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuesioner_responden`
--

LOCK TABLES `kuesioner_responden` WRITE;
/*!40000 ALTER TABLE `kuesioner_responden` DISABLE KEYS */;
/*!40000 ALTER TABLE `kuesioner_responden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_log` (
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `user_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login_time`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_log`
--

LOCK TABLES `login_log` WRITE;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
INSERT INTO `login_log` VALUES ('2014-06-26 04:25:56','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-26 04:31:30','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-26 10:51:47','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-27 12:48:44','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-29 07:36:12','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-29 11:05:43','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-30 03:29:47','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-30 10:56:31','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-06-30 11:54:58','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-01 11:59:58','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-01 12:45:16','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-17 05:31:01','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-21 11:10:57','0.0.0.0','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-22 13:24:13','127.0.0.1','id=1;name=superadmin;e1=-1;e2=-1'),('2014-07-25 14:23:56','127.0.0.1','id=1;name=superadmin;e1=-1;e2=-1');
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `menu_group` varchar(30) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_parent` smallint(6) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `hide` smallint(6) DEFAULT NULL,
  `policy` varchar(50) DEFAULT '',
  `icon` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'MASTER','MASTER',NULL,'#',0,'','fa-archive'),(2,'MASTER','Diklat',1,'rujukan/diklat',0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;',NULL),(3,'MASTER','Instansi',1,'rujukan/instansi',0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;',NULL),(4,'MASTER','Alumni',1,'rujukan/alumni',0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;',NULL),(5,'MASTER','Responden',1,'rujukan/responden',0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;',NULL),(6,'MASTER','Pertanyaan',1,'rujukan/pertanyaan',0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;',NULL),(20,'KUESIONER','KUESIONER',NULL,NULL,0,'','fa-tasks'),(21,'KUESIONER','Model Kuesioner',20,'kuesioner/model_kuesioner',0,'',NULL),(22,'KUESIONER','Model Jawaban',20,'kuesioner/model_jawaban',0,'VIEW;APPROVAL;AUTOTAB;PRINT;EXCEL;',NULL),(23,'KUESIONER','Register',20,'kueseioner/register',0,'VIEW;APPROVAL;AUTOTAB;PRINT;EXCEL;',NULL),(250,'REPORT','Laporan',NULL,'#',0,'','fa-bar-chart-o'),(251,'REPORT','Lap. SPB Yang Ditolak',250,'report/rpt_spb_ditolak',0,'VIEW;PRINT;EXCEL;',NULL),(300,'ADMIN','Admin',NULL,'#',0,'','fa-gears'),(301,'ADMIN','Grup Pengguna',300,'admin/group_user',1,'ADD;EDIT;VIEW;PRINT;AUTOTAB;',NULL),(302,'ADMIN','Pengguna',300,'admin/user',0,'ADD;EDIT;VIEW;PRINT;AUTOTAB;',NULL),(303,'ADMIN','Hak Pengguna',300,'admin/user_access',0,'EDIT;AUTOTAB;',NULL),(350,'UTILITY','Utility',NULL,'#',1,'',NULL),(355,'UTILITY','System Log',350,'#',0,'',NULL),(361,'UTILITY','Login Log',355,'utility/login_log',0,'VIEW;PRINT;AUTOTAB;',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_jawaban`
--

DROP TABLE IF EXISTS `model_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_jawaban` (
  `model_jawab_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `tipe` enum('radio','text','check') DEFAULT NULL,
  `singkatan` varchar(10) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `value` varchar(30) DEFAULT NULL,
  `hide` smallint(6) DEFAULT '0',
  PRIMARY KEY (`model_jawab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_jawaban`
--

LOCK TABLES `model_jawaban` WRITE;
/*!40000 ALTER TABLE `model_jawaban` DISABLE KEYS */;
INSERT INTO `model_jawaban` VALUES (1,'Ya/Tidak',NULL,'Jawaban',NULL,NULL,0),(2,'Ya','radio','Ya',1,'ya',0),(3,'Tidak','radio','Tidak',1,'tidak',0),(4,'Setuju/Tidak',NULL,'Pilihan Ja',NULL,NULL,0),(5,'Sangat Tidak Setuju','radio','STS',4,'sts',0),(6,'Tidak Setuju','radio','TS',4,'ts',0),(7,'Netral','radio','N',4,'n',0),(8,'Setuju','radio','S',4,'s',0),(9,'Sangat Setuju','radio','SS',4,'ss',0),(10,'Tupoksi',NULL,'Tupoksi Sd',NULL,NULL,0),(11,'Ya','radio','Ya',10,'ya',0),(12,'Tidak','radio','Tdk',10,'tidak',0),(13,'Dilakukan',NULL,'Dilakukan',NULL,NULL,0),(14,'Ya','radio','Ya',13,'ya',0),(15,'Tidak','radio','Tdk',13,'tidak',0),(16,'DIF',NULL,'DIF',NULL,NULL,0),(17,'Sulit/Tidak',NULL,'Sulit',16,NULL,0),(18,'Sulit','radio','S',17,NULL,0),(19,'Tidak Sulit','radio','TS',17,NULL,0),(20,'Penting/Tidak',NULL,'Penting',16,NULL,0),(21,'Sangat Penting','radio','SP',20,NULL,0),(22,'Penting','radio','P',20,NULL,0),(23,'Kurang Penting','radio','KP',20,NULL,0),(24,'Sering/Tidak',NULL,'Sering',16,NULL,0),(25,'Harian','radio','H',24,NULL,0),(26,'Mingguan','radio','M',24,NULL,0),(27,'Bulanan','radio','B',24,NULL,0),(28,'Kemampuan',NULL,'Tingkat Ke',NULL,NULL,0),(29,'Satu','radio','1',28,NULL,0),(30,'Dua','radio','2',28,NULL,0),(31,'Tiga','radio','3',28,NULL,0),(32,'Empat','radio','4',28,NULL,0),(33,'Lima','radio','5',28,NULL,0),(34,'Pelatihan',NULL,'Pelatihan ',NULL,NULL,0),(35,'Atasan','radio','Atasan',34,NULL,0),(36,'Ybs','radio','Ybs',34,NULL,0),(37,'Bawahan','radio','Bawahan',34,NULL,0),(38,'Saran Diklat',NULL,'Saran Dikl',NULL,NULL,0),(39,'Bidang Pekerjaan','text','Bidang/Bag',38,NULL,0),(40,'Keahlian','text','Kompetensi',38,NULL,0),(41,'Nama Diklat','text','Nama Dikla',38,NULL,0),(42,'Alasan Diklat','text','Alasan Per',38,NULL,0),(43,'Target Peserta','text','Target/Pes',38,NULL,0);
/*!40000 ALTER TABLE `model_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_kuesioner`
--

DROP TABLE IF EXISTS `model_kuesioner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_kuesioner` (
  `model_kuesioner_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `singkatan` varchar(10) DEFAULT NULL,
  `petunjuk` text,
  `hide` smallint(6) DEFAULT '0',
  PRIMARY KEY (`model_kuesioner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_kuesioner`
--

LOCK TABLES `model_kuesioner` WRITE;
/*!40000 ALTER TABLE `model_kuesioner` DISABLE KEYS */;
INSERT INTO `model_kuesioner` VALUES (1,'Visi Misi','F1',NULL,0),(2,'Target','F2',NULL,0),(3,'Motivasi Kerja','F3','Berilah Tanda Silang pada pilihan jawaban yang Anda anggap paling tepat.',0),(4,'Lingkungan Kerja','F4',NULL,0),(5,'Kompetensi','F5',NULL,0),(6,'Saran Diklat','F6',NULL,0);
/*!40000 ALTER TABLE `model_kuesioner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_kuesioner_jawaban`
--

DROP TABLE IF EXISTS `model_kuesioner_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_kuesioner_jawaban` (
  `model_kuesioner_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_jawab_id` int(11) NOT NULL,
  `bobot` double DEFAULT '0',
  `model_perhitungan` enum('sum','count') DEFAULT NULL,
  PRIMARY KEY (`model_kuesioner_id`,`model_jawab_id`),
  KEY `FK_model_kuesioner_jawaban_jawaban` (`model_jawab_id`),
  CONSTRAINT `model_kuesioner_jawaban_ibfk_2` FOREIGN KEY (`model_jawab_id`) REFERENCES `model_jawaban` (`model_jawab_id`) ON DELETE CASCADE,
  CONSTRAINT `model_kuesioner_jawaban_ibfk_1` FOREIGN KEY (`model_kuesioner_id`) REFERENCES `model_kuesioner` (`model_kuesioner_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_kuesioner_jawaban`
--

LOCK TABLES `model_kuesioner_jawaban` WRITE;
/*!40000 ALTER TABLE `model_kuesioner_jawaban` DISABLE KEYS */;
INSERT INTO `model_kuesioner_jawaban` VALUES (1,2,0,'count'),(1,3,0,'count');
/*!40000 ALTER TABLE `model_kuesioner_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pertanyaan` (
  `pertanyaan_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanya` text,
  `tanya_tambahan1` text,
  `tanya_tambahan2` text,
  PRIMARY KEY (`pertanyaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan`
--

LOCK TABLES `pertanyaan` WRITE;
/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` VALUES (1,'Apakah Visi-Misi lembaga cukup jelas bagi Anda ?','',''),(2,'Apakah Visi-Misi tersebut Anda komunikasikan pada bawahan Anda ?','',''),(3,'Apakah menurut Anda bawahan Anda memahami Visi Misi Tersebut','Jika Tidak, sebutkan mengapa ?','');
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responden`
--

DROP TABLE IF EXISTS `responden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responden` (
  `responden_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `instansi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`responden_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responden`
--

LOCK TABLES `responden` WRITE;
/*!40000 ALTER TABLE `responden` DISABLE KEYS */;
INSERT INTO `responden` VALUES (1,'aa@ff.com','Anda',2),(2,'kiki@gmail.com','kiki',1);
/*!40000 ALTER TABLE `responden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bidang`
--

DROP TABLE IF EXISTS `tbl_bidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_bidang` (
  `bidang_id` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bidang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bidang`
--

LOCK TABLES `tbl_bidang` WRITE;
/*!40000 ALTER TABLE `tbl_bidang` DISABLE KEYS */;
INSERT INTO `tbl_bidang` VALUES (1,'Bidang Tata Usaha'),(2,'Bidang Program dan Kerjasama'),(3,'Bidang Penyelenggara dan Evaluasi'),(4,'Bidang Standar Sarana dan Prasarana');
/*!40000 ALTER TABLE `tbl_bidang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_access`
--

DROP TABLE IF EXISTS `tbl_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_access` (
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `level_id` smallint(6) NOT NULL DEFAULT '0',
  `group_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`level_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_access`
--

LOCK TABLES `tbl_group_access` WRITE;
/*!40000 ALTER TABLE `tbl_group_access` DISABLE KEYS */;
INSERT INTO `tbl_group_access` VALUES (1,3,1,''),(2,3,1,'VIEW;PRINT;EXCEL;'),(3,3,1,'VIEW;PRINT;EXCEL;'),(4,3,1,'VIEW;PRINT;EXCEL;'),(6,3,1,'VIEW;PRINT;EXCEL;'),(7,3,1,'VIEW;PRINT;EXCEL;'),(30,3,1,''),(31,3,1,'VIEW;PRINT;EXCEL;'),(32,3,1,'VIEW;'),(33,3,1,''),(34,3,1,'VIEW;PRINT;EXCEL;'),(35,3,1,'VIEW;'),(36,3,1,''),(50,3,1,''),(51,3,1,'VIEW;PRINT;EXCEL;'),(52,3,1,'VIEW;'),(53,3,1,''),(100,3,1,''),(101,3,1,''),(102,3,1,'VIEW;PRINT;EXCEL;'),(103,3,1,'VIEW;PRINT;EXCEL;'),(104,3,1,''),(105,3,1,'VIEW;'),(106,3,1,''),(107,3,1,''),(108,3,1,''),(109,3,1,''),(150,3,1,''),(151,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,3,1,'VIEW;'),(153,3,1,''),(200,3,1,''),(201,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,3,1,'VIEW;'),(203,3,1,''),(250,3,1,''),(251,3,1,''),(252,3,1,'VIEW;PRINT;EXCEL;'),(253,3,1,'VIEW;'),(254,3,1,''),(255,3,1,''),(256,3,1,'VIEW;PRINT;EXCEL;'),(257,3,1,'VIEW;'),(258,3,1,''),(260,3,1,''),(261,3,1,'VIEW;PRINT;EXCEL;'),(262,3,1,'VIEW;'),(263,3,1,''),(265,3,1,''),(266,3,1,'VIEW;PRINT;EXCEL;'),(267,3,1,'VIEW;'),(268,3,1,''),(270,3,1,''),(271,3,1,'VIEW;PRINT;EXCEL;'),(272,3,1,'VIEW;'),(273,3,1,''),(274,3,1,'VIEW;PRINT;EXCEL;'),(300,3,1,''),(302,3,1,''),(303,3,1,''),(350,3,1,''),(351,3,1,''),(352,3,1,''),(353,3,1,''),(355,3,1,''),(356,3,1,''),(357,3,1,''),(358,3,1,''),(359,3,1,''),(360,3,1,''),(1,4,1,''),(2,4,1,'VIEW;PRINT;'),(3,4,1,'VIEW;PRINT;'),(4,4,1,'VIEW;PRINT;'),(6,4,1,'VIEW;PRINT;'),(7,4,1,'VIEW;PRINT;'),(30,4,1,''),(31,4,1,'VIEW;PRINT;'),(32,4,1,'VIEW;PRINT;'),(33,4,1,''),(34,4,1,'VIEW;PRINT;'),(35,4,1,'VIEW;PRINT;'),(36,4,1,''),(50,4,1,''),(51,4,1,'VIEW;PRINT;'),(52,4,1,'VIEW;PRINT;'),(53,4,1,''),(100,4,1,''),(101,4,1,''),(102,4,1,'VIEW;PRINT;'),(103,4,1,''),(104,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(105,4,1,'VIEW;PRINT;'),(106,4,1,''),(107,4,1,''),(108,4,1,''),(109,4,1,''),(150,4,1,''),(151,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(152,4,1,'VIEW;PRINT;'),(153,4,1,''),(200,4,1,''),(201,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(202,4,1,'VIEW;PRINT;'),(203,4,1,''),(250,4,1,''),(251,4,1,''),(252,4,1,'VIEW;PRINT;'),(253,4,1,'VIEW;PRINT;'),(254,4,1,''),(255,4,1,''),(256,4,1,'VIEW;PRINT;'),(257,4,1,'VIEW;PRINT;'),(258,4,1,''),(260,4,1,''),(261,4,1,'VIEW;PRINT;EXCEL;'),(262,4,1,'VIEW;'),(263,4,1,''),(265,4,1,''),(266,4,1,'VIEW;PRINT;'),(267,4,1,'VIEW;PRINT;'),(268,4,1,''),(270,4,1,''),(271,4,1,'VIEW;PRINT;'),(272,4,1,'VIEW;PRINT;'),(273,4,1,''),(274,4,1,''),(300,4,1,''),(302,4,1,''),(303,4,1,''),(350,4,1,''),(351,4,1,''),(352,4,1,''),(353,4,1,''),(355,4,1,''),(356,4,1,''),(357,4,1,''),(358,4,1,''),(359,4,1,''),(360,4,1,''),(1,3,2,''),(2,3,2,'VIEW;PRINT;EXCEL;'),(3,3,2,'VIEW;PRINT;EXCEL;'),(4,3,2,'VIEW;PRINT;EXCEL;'),(6,3,2,'VIEW;PRINT;EXCEL;'),(7,3,2,'VIEW;PRINT;EXCEL;'),(30,3,2,''),(31,3,2,''),(32,3,2,'VIEW;PRINT;EXCEL;'),(33,3,2,'VIEW;'),(34,3,2,''),(35,3,2,'VIEW;PRINT;EXCEL;'),(36,3,2,'VIEW;'),(50,3,2,''),(51,3,2,''),(52,3,2,'VIEW;PRINT;EXCEL;'),(53,3,2,'VIEW;'),(100,3,2,''),(101,3,2,''),(102,3,2,''),(103,3,2,''),(104,3,2,''),(105,3,2,'VIEW;PRINT;EXCEL;'),(106,3,2,'VIEW;PRINT;EXCEL;'),(107,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(108,3,2,'VIEW;'),(109,3,2,'VIEW;'),(150,3,2,''),(151,3,2,''),(152,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,3,2,'VIEW;'),(200,3,2,''),(201,3,2,''),(202,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,3,2,'VIEW;'),(250,3,2,''),(251,3,2,''),(252,3,2,''),(253,3,2,'VIEW;PRINT;EXCEL;'),(254,3,2,'VIEW;'),(255,3,2,''),(256,3,2,''),(257,3,2,'VIEW;PRINT;EXCEL;'),(258,3,2,'VIEW;'),(260,3,2,''),(261,3,2,''),(262,3,2,'VIEW;PRINT;EXCEL;'),(263,3,2,'VIEW;'),(265,3,2,''),(266,3,2,''),(267,3,2,'VIEW;PRINT;EXCEL;'),(268,3,2,'VIEW;'),(270,3,2,''),(271,3,2,''),(272,3,2,'VIEW;PRINT;EXCEL;'),(273,3,2,'VIEW;'),(274,3,2,'VIEW;PRINT;EXCEL;'),(300,3,2,''),(302,3,2,''),(303,3,2,''),(350,3,2,''),(351,3,2,''),(352,3,2,''),(353,3,2,''),(355,3,2,''),(356,3,2,''),(357,3,2,''),(358,3,2,''),(359,3,2,''),(360,3,2,''),(1,4,2,''),(2,4,2,'VIEW;PRINT;EXCEL;'),(3,4,2,'VIEW;PRINT;EXCEL;'),(4,4,2,'VIEW;PRINT;EXCEL;'),(6,4,2,'VIEW;PRINT;EXCEL;'),(7,4,2,'VIEW;PRINT;EXCEL;'),(30,4,2,''),(31,4,2,''),(32,4,2,'VIEW;PRINT;EXCEL;'),(33,4,2,'VIEW;'),(34,4,2,''),(35,4,2,'VIEW;PRINT;EXCEL;'),(36,4,2,'VIEW;'),(50,4,2,''),(51,4,2,''),(52,4,2,'VIEW;PRINT;EXCEL;'),(53,4,2,'VIEW;'),(100,4,2,''),(101,4,2,''),(102,4,2,''),(103,4,2,''),(104,4,2,''),(105,4,2,'VIEW;'),(106,4,2,'VIEW;PRINT;EXCEL;'),(107,4,2,''),(108,4,2,'VIEW;'),(109,4,2,''),(150,4,2,''),(151,4,2,''),(152,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,4,2,'VIEW;'),(200,4,2,''),(201,4,2,''),(202,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,4,2,'VIEW;'),(250,4,2,''),(251,4,2,''),(252,4,2,''),(253,4,2,'VIEW;PRINT;EXCEL;'),(254,4,2,'VIEW;'),(255,4,2,''),(256,4,2,''),(257,4,2,'VIEW;PRINT;EXCEL;'),(258,4,2,'VIEW;'),(260,4,2,''),(261,4,2,''),(262,4,2,'VIEW;PRINT;EXCEL;'),(263,4,2,'VIEW;'),(265,4,2,''),(266,4,2,''),(267,4,2,'VIEW;PRINT;EXCEL;'),(268,4,2,'VIEW;'),(270,4,2,''),(271,4,2,''),(272,4,2,'VIEW;PRINT;EXCEL;'),(273,4,2,'VIEW;'),(274,4,2,'VIEW;PRINT;EXCEL;'),(300,4,2,''),(302,4,2,''),(303,4,2,''),(350,4,2,''),(351,4,2,''),(352,4,2,''),(353,4,2,''),(355,4,2,''),(356,4,2,''),(357,4,2,''),(358,4,2,''),(359,4,2,''),(360,4,2,''),(1,3,3,''),(2,3,3,'VIEW;PRINT;EXCEL;'),(3,3,3,'VIEW;PRINT;EXCEL;'),(4,3,3,'VIEW;PRINT;EXCEL;'),(6,3,3,'VIEW;PRINT;EXCEL;'),(7,3,3,'VIEW;PRINT;EXCEL;'),(30,3,3,''),(31,3,3,''),(32,3,3,''),(33,3,3,'VIEW;PRINT;EXCEL;'),(34,3,3,''),(35,3,3,''),(36,3,3,'VIEW;PRINT;EXCEL;'),(50,3,3,''),(51,3,3,''),(52,3,3,''),(53,3,3,'VIEW;PRINT;EXCEL;'),(100,3,3,''),(101,3,3,''),(102,3,3,''),(103,3,3,''),(104,3,3,''),(105,3,3,''),(106,3,3,''),(107,3,3,''),(108,3,3,'VIEW;'),(109,3,3,'VIEW;PRINT;EXCEL;'),(150,3,3,''),(151,3,3,''),(152,3,3,''),(153,3,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,3,3,''),(201,3,3,''),(202,3,3,''),(203,3,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,3,3,''),(251,3,3,''),(252,3,3,''),(253,3,3,''),(254,3,3,'VIEW;PRINT;EXCEL;'),(255,3,3,''),(256,3,3,''),(257,3,3,''),(258,3,3,'VIEW;PRINT;EXCEL;'),(260,3,3,''),(261,3,3,''),(262,3,3,''),(263,3,3,'VIEW;PRINT;EXCEL;'),(265,3,3,''),(266,3,3,''),(267,3,3,''),(268,3,3,'VIEW;PRINT;EXCEL;'),(270,3,3,''),(271,3,3,''),(272,3,3,''),(273,3,3,'VIEW;PRINT;EXCEL;'),(274,3,3,'VIEW;PRINT;EXCEL;'),(300,3,3,''),(302,3,3,''),(303,3,3,''),(350,3,3,''),(351,3,3,''),(352,3,3,''),(353,3,3,''),(355,3,3,''),(356,3,3,''),(357,3,3,''),(358,3,3,''),(359,3,3,''),(360,3,3,''),(1,4,3,''),(2,4,3,'VIEW;PRINT;EXCEL;'),(3,4,3,'VIEW;PRINT;EXCEL;'),(4,4,3,'VIEW;PRINT;EXCEL;'),(6,4,3,'VIEW;PRINT;EXCEL;'),(7,4,3,'VIEW;PRINT;EXCEL;'),(30,4,3,''),(31,4,3,''),(32,4,3,''),(33,4,3,'VIEW;PRINT;EXCEL;IMPORT;'),(34,4,3,''),(35,4,3,''),(36,4,3,'VIEW;PRINT;EXCEL;IMPORT;'),(50,4,3,''),(51,4,3,''),(52,4,3,''),(53,4,3,'VIEW;PRINT;EXCEL;'),(100,4,3,''),(101,4,3,''),(102,4,3,''),(103,4,3,''),(104,4,3,''),(105,4,3,''),(106,4,3,''),(107,4,3,''),(108,4,3,'VIEW;PRINT;EXCEL;'),(109,4,3,''),(150,4,3,''),(151,4,3,''),(152,4,3,''),(153,4,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,4,3,''),(201,4,3,''),(202,4,3,''),(203,4,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,4,3,''),(251,4,3,''),(252,4,3,''),(253,4,3,''),(254,4,3,'VIEW;PRINT;EXCEL;'),(255,4,3,''),(256,4,3,''),(257,4,3,''),(258,4,3,'VIEW;PRINT;EXCEL;'),(260,4,3,''),(261,4,3,''),(262,4,3,''),(263,4,3,'VIEW;PRINT;EXCEL;'),(265,4,3,''),(266,4,3,''),(267,4,3,''),(268,4,3,'VIEW;PRINT;EXCEL;'),(270,4,3,''),(271,4,3,''),(272,4,3,''),(273,4,3,'VIEW;PRINT;EXCEL;'),(274,4,3,'VIEW;PRINT;EXCEL;'),(300,4,3,''),(302,4,3,''),(303,4,3,''),(350,4,3,''),(351,4,3,''),(352,4,3,''),(353,4,3,''),(355,4,3,''),(356,4,3,''),(357,4,3,''),(358,4,3,''),(359,4,3,''),(360,4,3,''),(0,4,1,''),(0,3,1,''),(0,3,2,''),(0,4,2,''),(0,3,3,''),(0,4,3,''),(1,2,3,''),(2,2,3,'VIEW;PRINT;EXCEL;'),(3,2,3,'VIEW;PRINT;EXCEL;'),(4,2,3,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(6,2,3,'VIEW;PRINT;EXCEL;'),(7,2,3,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(30,2,3,''),(31,2,3,'VIEW;PRINT;EXCEL;'),(32,2,3,'VIEW;PRINT;EXCEL;'),(33,2,3,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(34,2,3,'VIEW;PRINT;EXCEL;'),(35,2,3,'VIEW;PRINT;EXCEL;'),(36,2,3,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(50,2,3,''),(51,2,3,''),(52,2,3,'VIEW;PRINT;EXCEL;'),(53,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(100,2,3,''),(102,2,3,''),(103,2,3,''),(105,2,3,'VIEW;PRINT;EXCEL;'),(106,2,3,''),(108,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(109,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(150,2,3,''),(151,2,3,''),(152,2,3,''),(153,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,3,''),(201,2,3,''),(202,2,3,''),(203,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,3,''),(252,2,3,''),(253,2,3,''),(254,2,3,'VIEW;PRINT;EXCEL;'),(256,2,3,''),(257,2,3,''),(258,2,3,'VIEW;PRINT;EXCEL;'),(261,2,3,''),(262,2,3,''),(263,2,3,''),(266,2,3,''),(267,2,3,''),(268,2,3,'VIEW;PRINT;EXCEL;'),(271,2,3,''),(272,2,3,''),(273,2,3,'VIEW;PRINT;EXCEL;'),(274,2,3,''),(300,2,3,''),(302,2,3,''),(303,2,3,''),(350,2,3,''),(351,2,3,''),(352,2,3,''),(353,2,3,''),(356,2,3,''),(357,2,3,''),(358,2,3,''),(359,2,3,''),(360,2,3,''),(0,2,3,''),(1,2,1,''),(2,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(3,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(4,2,1,'VIEW;PRINT;EXCEL;'),(6,2,1,'VIEW;PRINT;EXCEL;'),(7,2,1,'VIEW;PRINT;EXCEL;'),(30,2,1,''),(31,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(32,2,1,'VIEW;PRINT;EXCEL;'),(33,2,1,'VIEW;PRINT;EXCEL;'),(34,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(35,2,1,'VIEW;PRINT;EXCEL;'),(36,2,1,'VIEW;PRINT;EXCEL;'),(50,2,1,''),(51,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(52,2,1,'VIEW;PRINT;EXCEL;'),(53,2,1,'VIEW;PRINT;EXCEL;'),(100,2,1,''),(102,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(103,2,1,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(105,2,1,'VIEW;PRINT;EXCEL;'),(106,2,1,'VIEW;PRINT;EXCEL;'),(108,2,1,'VIEW;PRINT;EXCEL;'),(109,2,1,'VIEW;PRINT;EXCEL;'),(150,2,1,''),(151,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,1,''),(201,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,1,''),(252,2,1,'VIEW;PRINT;EXCEL;'),(253,2,1,'VIEW;PRINT;EXCEL;'),(254,2,1,'VIEW;PRINT;EXCEL;'),(256,2,1,'VIEW;PRINT;EXCEL;'),(257,2,1,'VIEW;PRINT;EXCEL;'),(258,2,1,'VIEW;PRINT;EXCEL;'),(261,2,1,'VIEW;PRINT;EXCEL;'),(262,2,1,'VIEW;PRINT;EXCEL;'),(263,2,1,'VIEW;PRINT;EXCEL;'),(266,2,1,'VIEW;PRINT;EXCEL;'),(267,2,1,'VIEW;PRINT;EXCEL;'),(268,2,1,'VIEW;PRINT;EXCEL;'),(271,2,1,'VIEW;PRINT;EXCEL;'),(272,2,1,'VIEW;PRINT;EXCEL;'),(273,2,1,'VIEW;PRINT;EXCEL;'),(274,2,1,'VIEW;PRINT;EXCEL;'),(300,2,1,''),(302,2,1,'VIEW;ADD;EDIT;PRINT;'),(303,2,1,'EDIT;'),(350,2,1,''),(351,2,1,'PROSES;'),(352,2,1,'PROSES;'),(353,2,1,'PROSES;'),(356,2,1,'VIEW;PRINT;'),(357,2,1,'VIEW;PRINT;'),(358,2,1,'VIEW;PRINT;'),(359,2,1,'VIEW;PRINT;'),(360,2,1,'VIEW;PRINT;'),(0,2,1,''),(1,2,2,''),(2,2,2,'EXCEL;'),(3,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;AUTOTAB;'),(4,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;AUTOTAB;'),(6,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(7,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;'),(30,2,2,''),(31,2,2,'VIEW;PRINT;EXCEL;'),(32,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;IMPORT;'),(33,2,2,'VIEW;PRINT;EXCEL;'),(34,2,2,'VIEW;PRINT;EXCEL;'),(35,2,2,'VIEW;ADD;EDIT;PRINT;EXCEL;IMPORT;'),(36,2,2,'VIEW;PRINT;EXCEL;'),(50,2,2,''),(51,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(52,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(53,2,2,'VIEW;ADD;DELETE;PRINT;EXCEL;'),(100,2,2,''),(102,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(103,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(105,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(106,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(108,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(109,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(150,2,2,''),(151,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,2,''),(201,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,2,''),(252,2,2,'VIEW;PRINT;EXCEL;'),(253,2,2,'VIEW;PRINT;EXCEL;'),(254,2,2,'VIEW;PRINT;EXCEL;'),(256,2,2,'VIEW;PRINT;EXCEL;'),(257,2,2,'VIEW;PRINT;EXCEL;'),(258,2,2,'VIEW;PRINT;EXCEL;'),(261,2,2,'VIEW;PRINT;EXCEL;'),(262,2,2,'VIEW;PRINT;EXCEL;'),(263,2,2,'VIEW;PRINT;EXCEL;'),(266,2,2,'VIEW;PRINT;EXCEL;'),(267,2,2,'VIEW;PRINT;EXCEL;'),(268,2,2,'VIEW;PRINT;EXCEL;'),(271,2,2,'VIEW;PRINT;EXCEL;'),(272,2,2,'VIEW;PRINT;EXCEL;'),(273,2,2,'VIEW;PRINT;EXCEL;'),(274,2,2,'VIEW;PRINT;EXCEL;'),(300,2,2,''),(302,2,2,'VIEW;ADD;EDIT;PRINT;'),(303,2,2,'EDIT;'),(350,2,2,''),(351,2,2,'PROSES;'),(352,2,2,'PROSES;'),(353,2,2,'PROSES;'),(356,2,2,'VIEW;PRINT;'),(357,2,2,'VIEW;PRINT;'),(358,2,2,'VIEW;PRINT;'),(359,2,2,'VIEW;PRINT;'),(360,2,2,'VIEW;PRINT;'),(0,2,2,''),(120,2,2,''),(122,2,2,''),(123,2,2,''),(125,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,2,2,''),(128,2,2,'VIEW;'),(290,2,2,''),(291,2,2,''),(292,2,2,'VIEW;'),(293,2,2,''),(294,2,2,'VIEW;'),(400,2,2,''),(401,2,2,''),(402,2,2,''),(404,2,2,''),(405,2,2,''),(406,2,2,''),(407,2,2,''),(408,2,2,''),(409,2,2,''),(120,4,1,''),(122,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(123,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(125,4,1,'VIEW;'),(126,4,1,'VIEW;'),(127,4,1,'VIEW;'),(128,4,1,'VIEW;'),(290,4,1,''),(291,4,1,'VIEW;'),(292,4,1,'VIEW;'),(293,4,1,'VIEW;'),(294,4,1,'VIEW;'),(400,4,1,''),(401,4,1,''),(402,4,1,''),(404,4,1,''),(405,4,1,''),(406,4,1,''),(407,4,1,''),(408,4,1,''),(409,4,1,''),(120,2,1,''),(122,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(123,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(125,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,2,1,'VIEW;'),(128,2,1,'VIEW;'),(290,2,1,''),(291,2,1,'VIEW;'),(292,2,1,'VIEW;'),(293,2,1,'VIEW;'),(294,2,1,'VIEW;'),(400,2,1,''),(401,2,1,'VIEW;'),(402,2,1,'VIEW;DELETE;'),(404,2,1,'VIEW;'),(405,2,1,'VIEW;DELETE;'),(406,2,1,'VIEW;DELETE;'),(407,2,1,'VIEW;DELETE;'),(408,2,1,'VIEW;'),(409,2,1,'VIEW;DELETE;'),(123,3,3,''),(122,3,3,''),(120,3,3,''),(120,2,3,''),(122,2,3,''),(123,2,3,''),(125,2,3,''),(126,2,3,''),(127,2,3,''),(128,2,3,''),(290,2,3,''),(291,2,3,''),(292,2,3,''),(293,2,3,''),(294,2,3,''),(400,2,3,''),(401,2,3,''),(402,2,3,''),(404,2,3,''),(405,2,3,''),(406,2,3,''),(407,2,3,''),(408,2,3,''),(409,2,3,''),(120,3,1,''),(122,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(123,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(125,3,1,'VIEW;'),(126,3,1,'VIEW;'),(127,3,1,'VIEW;'),(128,3,1,'VIEW;'),(290,3,1,''),(291,3,1,'VIEW;'),(292,3,1,'VIEW;'),(293,3,1,'VIEW;'),(294,3,1,'VIEW;'),(400,3,1,''),(401,3,1,''),(402,3,1,''),(404,3,1,''),(405,3,1,''),(406,3,1,''),(407,3,1,''),(408,3,1,''),(409,3,1,''),(120,3,2,''),(122,3,2,''),(123,3,2,''),(125,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,3,2,''),(128,3,2,'VIEW;'),(290,3,2,''),(291,3,2,''),(292,3,2,'VIEW;'),(293,3,2,''),(294,3,2,'VIEW;'),(400,3,2,''),(401,3,2,''),(402,3,2,''),(404,3,2,''),(405,3,2,''),(406,3,2,''),(407,3,2,''),(408,3,2,''),(409,3,2,''),(120,4,2,''),(122,4,2,''),(123,4,2,''),(125,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,4,2,''),(128,4,2,'VIEW;'),(290,4,2,''),(291,4,2,''),(292,4,2,'VIEW;'),(293,4,2,''),(294,4,2,'VIEW;'),(400,4,2,''),(401,4,2,''),(402,4,2,''),(404,4,2,''),(405,4,2,''),(406,4,2,''),(407,4,2,''),(408,4,2,''),(409,4,2,''),(125,3,3,''),(126,3,3,''),(127,3,3,''),(128,3,3,''),(290,3,3,''),(291,3,3,''),(292,3,3,''),(293,3,3,''),(294,3,3,''),(400,3,3,''),(401,3,3,''),(402,3,3,''),(404,3,3,''),(405,3,3,''),(406,3,3,''),(407,3,3,''),(408,3,3,''),(409,3,3,''),(120,4,3,''),(122,4,3,''),(123,4,3,''),(125,4,3,''),(126,4,3,''),(127,4,3,''),(128,4,3,''),(290,4,3,''),(291,4,3,''),(292,4,3,''),(293,4,3,''),(294,4,3,''),(400,4,3,''),(401,4,3,''),(402,4,3,''),(404,4,3,''),(405,4,3,''),(406,4,3,''),(407,4,3,''),(408,4,3,''),(409,4,3,''),(1,5,1,''),(2,5,1,'VIEW;'),(3,5,1,'VIEW;'),(4,5,1,''),(6,5,1,''),(30,5,1,''),(31,5,1,'VIEW;'),(32,5,1,'VIEW;'),(33,5,1,''),(34,5,1,'VIEW;'),(35,5,1,'VIEW;'),(36,5,1,''),(50,5,1,''),(51,5,1,'VIEW;'),(52,5,1,'VIEW;'),(53,5,1,''),(100,5,1,''),(102,5,1,'VIEW;'),(103,5,1,'VIEW;'),(105,5,1,'VIEW;'),(106,5,1,'VIEW;'),(108,5,1,''),(109,5,1,''),(120,5,1,''),(122,5,1,''),(123,5,1,''),(125,5,1,''),(126,5,1,''),(127,5,1,'VIEW;'),(128,5,1,'VIEW;'),(150,5,1,''),(151,5,1,'VIEW;'),(152,5,1,'VIEW;'),(153,5,1,''),(200,5,1,''),(201,5,1,'VIEW;'),(202,5,1,'VIEW;'),(203,5,1,''),(250,5,1,''),(252,5,1,'VIEW;'),(253,5,1,'VIEW;'),(254,5,1,''),(256,5,1,'VIEW;'),(257,5,1,'VIEW;'),(258,5,1,''),(266,5,1,'VIEW;'),(267,5,1,'VIEW;'),(268,5,1,''),(271,5,1,'VIEW;'),(272,5,1,'VIEW;'),(273,5,1,''),(274,5,1,''),(290,5,1,''),(291,5,1,'VIEW;'),(292,5,1,'VIEW;'),(293,5,1,'VIEW;'),(294,5,1,'VIEW;'),(300,5,1,''),(302,5,1,''),(303,5,1,''),(350,5,1,''),(351,5,1,''),(352,5,1,''),(353,5,1,''),(356,5,1,''),(357,5,1,''),(359,5,1,''),(400,5,1,''),(401,5,1,''),(402,5,1,''),(404,5,1,''),(405,5,1,''),(406,5,1,''),(407,5,1,''),(408,5,1,''),(409,5,1,''),(0,5,1,''),(1,5,2,''),(2,5,2,'VIEW;'),(3,5,2,'VIEW;'),(4,5,2,'VIEW;'),(6,5,2,''),(30,5,2,''),(31,5,2,''),(32,5,2,'VIEW;'),(33,5,2,'VIEW;'),(34,5,2,''),(35,5,2,'VIEW;'),(36,5,2,'VIEW;'),(50,5,2,''),(51,5,2,''),(52,5,2,'VIEW;'),(53,5,2,'VIEW;'),(100,5,2,''),(102,5,2,''),(103,5,2,''),(105,5,2,'VIEW;'),(106,5,2,'VIEW;'),(108,5,2,'VIEW;'),(109,5,2,'VIEW;'),(120,5,2,''),(122,5,2,''),(123,5,2,''),(125,5,2,'VIEW;'),(126,5,2,'VIEW;'),(127,5,2,''),(128,5,2,'VIEW;'),(150,5,2,''),(151,5,2,''),(152,5,2,'VIEW;'),(153,5,2,'VIEW;'),(200,5,2,''),(201,5,2,''),(202,5,2,'VIEW;'),(203,5,2,'VIEW;'),(250,5,2,''),(252,5,2,''),(253,5,2,'VIEW;'),(254,5,2,'VIEW;'),(256,5,2,''),(257,5,2,'VIEW;'),(258,5,2,'VIEW;'),(266,5,2,''),(267,5,2,'VIEW;'),(268,5,2,''),(271,5,2,''),(272,5,2,'VIEW;'),(273,5,2,''),(274,5,2,''),(290,5,2,''),(291,5,2,''),(292,5,2,'VIEW;'),(293,5,2,''),(294,5,2,'VIEW;'),(300,5,2,''),(302,5,2,''),(303,5,2,''),(350,5,2,''),(351,5,2,''),(352,5,2,''),(353,5,2,''),(356,5,2,''),(357,5,2,''),(359,5,2,''),(400,5,2,''),(401,5,2,''),(402,5,2,''),(404,5,2,''),(405,5,2,''),(406,5,2,''),(407,5,2,''),(408,5,2,''),(409,5,2,''),(0,5,2,''),(1,5,3,''),(2,5,3,''),(3,5,3,''),(4,5,3,'VIEW;'),(6,5,3,''),(30,5,3,''),(31,5,3,''),(32,5,3,''),(33,5,3,'VIEW;'),(34,5,3,''),(35,5,3,''),(36,5,3,'VIEW;'),(50,5,3,''),(51,5,3,''),(52,5,3,''),(53,5,3,'VIEW;'),(100,5,3,''),(102,5,3,''),(103,5,3,''),(105,5,3,''),(106,5,3,''),(108,5,3,'VIEW;'),(109,5,3,'VIEW;'),(120,5,3,''),(122,5,3,''),(123,5,3,''),(125,5,3,''),(126,5,3,''),(127,5,3,''),(128,5,3,''),(150,5,3,''),(151,5,3,''),(152,5,3,''),(153,5,3,'VIEW;'),(200,5,3,''),(201,5,3,''),(202,5,3,''),(203,5,3,'VIEW;'),(250,5,3,''),(252,5,3,''),(253,5,3,''),(254,5,3,'VIEW;'),(256,5,3,''),(257,5,3,''),(258,5,3,'VIEW;'),(266,5,3,''),(267,5,3,''),(268,5,3,'VIEW;'),(271,5,3,''),(272,5,3,''),(273,5,3,'VIEW;'),(274,5,3,''),(290,5,3,''),(291,5,3,''),(292,5,3,''),(293,5,3,''),(294,5,3,''),(300,5,3,''),(302,5,3,''),(303,5,3,''),(350,5,3,''),(351,5,3,''),(352,5,3,''),(353,5,3,''),(356,5,3,''),(357,5,3,''),(359,5,3,''),(400,5,3,''),(401,5,3,''),(402,5,3,''),(404,5,3,''),(405,5,3,''),(406,5,3,''),(407,5,3,''),(408,5,3,''),(409,5,3,''),(0,5,3,''),(7,5,3,'VIEW;');
/*!40000 ALTER TABLE `tbl_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_level`
--

DROP TABLE IF EXISTS `tbl_group_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_level` (
  `level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_level`
--

LOCK TABLES `tbl_group_level` WRITE;
/*!40000 ALTER TABLE `tbl_group_level` DISABLE KEYS */;
INSERT INTO `tbl_group_level` VALUES (1,'Superadmin',100),(2,'Administrator',90),(3,'Pimpinan',80),(4,'Staf/Operator',10),(5,'Guest',5);
/*!40000 ALTER TABLE `tbl_group_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_user`
--

DROP TABLE IF EXISTS `tbl_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_user` (
  `group_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `app_type` enum('KL','E1','E2') DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_user`
--

LOCK TABLES `tbl_group_user` WRITE;
/*!40000 ALTER TABLE `tbl_group_user` DISABLE KEYS */;
INSERT INTO `tbl_group_user` VALUES (1,'Tingkat Kementerian','KL',9),(2,'Tingkat Eselon 1','E1',8),(3,'Tingkat Eselon 2','E2',7),(7,'SuperAdmin',NULL,100);
/*!40000 ALTER TABLE `tbl_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_konstanta`
--

DROP TABLE IF EXISTS `tbl_konstanta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_konstanta` (
  `id` smallint(6) NOT NULL,
  `kategori_bahan` smallint(6) DEFAULT NULL,
  `kategori_non_bahan` smallint(6) DEFAULT NULL,
  `kategori_sppd` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_konstanta`
--

LOCK TABLES `tbl_konstanta` WRITE;
/*!40000 ALTER TABLE `tbl_konstanta` DISABLE KEYS */;
INSERT INTO `tbl_konstanta` VALUES (1,1,2,3);
/*!40000 ALTER TABLE `tbl_konstanta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `group_id` smallint(6) DEFAULT NULL,
  `app_type` enum('KL','E1','E2') DEFAULT NULL,
  `unit_kerja_e1` varchar(30) DEFAULT NULL,
  `unit_kerja_e2` varchar(30) DEFAULT NULL,
  `level_id` smallint(6) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_group` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'superadmin','Super Administrator','9e5f2d82d260ca202e6a62c1be4c0cc4',7,NULL,'-1','-1',1,NULL,'1;2014-06-11 11:13:48');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_access`
--

DROP TABLE IF EXISTS `tbl_user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_access` (
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `user_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_access`
--

LOCK TABLES `tbl_user_access` WRITE;
/*!40000 ALTER TABLE `tbl_user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_access` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-01 19:28:41
