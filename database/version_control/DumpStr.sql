-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: irchadv3
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accountants`
--

DROP TABLE IF EXISTS `accountants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accountants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `e-mail` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `adherent_sessions`
--

DROP TABLE IF EXISTS `adherent_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adherent_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `sort` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `observation` varchar(512) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_session_idx` (`id_session`),
  KEY `id_member_idx` (`id_member`),
  KEY `id_project_idx` (`id_projet`),
  CONSTRAINT `id_member` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`),
  CONSTRAINT `id_project` FOREIGN KEY (`id_projet`) REFERENCES `projects_applications` (`id`),
  CONSTRAINT `id_session` FOREIGN KEY (`id_session`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formations`
--

DROP TABLE IF EXISTS `formations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `domaine` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funding_externes`
--

DROP TABLE IF EXISTS `funding_externes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funding_externes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funding_organism` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_prise_charge_ext` datetime DEFAULT NULL,
  `status_ext` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `observation_ext` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_projet` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `montant` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet_fk` (`id_projet`),
  CONSTRAINT `id_projet_fk` FOREIGN KEY (`id_projet`) REFERENCES `projects_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funding_indhs`
--

DROP TABLE IF EXISTS `funding_indhs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funding_indhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_projet` int(11) DEFAULT NULL,
  `status_cpdh` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status_cpde` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ready_cpdh` tinyint(1) DEFAULT '0',
  `ready_cpde` tinyint(1) DEFAULT '0',
  `sent_cpdh` tinyint(1) DEFAULT '0',
  `sent_cpde` tinyint(1) DEFAULT '0',
  `status_indh` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_prise_charge` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `montant` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `observation_cpde` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `observation_cpdh` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projet_id` (`id_projet`),
  CONSTRAINT `projet_id` FOREIGN KEY (`id_projet`) REFERENCES `projects_applications` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incorporation_progresses`
--

DROP TABLE IF EXISTS `incorporation_progresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incorporation_progresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_incorporation` int(11) DEFAULT NULL,
  `id_step` int(11) DEFAULT NULL,
  `sort` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `observation` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_step` (`id_step`),
  KEY `id_incorporation` (`id_incorporation`),
  CONSTRAINT `id_incorporation` FOREIGN KEY (`id_incorporation`) REFERENCES `incorporations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `id_step` FOREIGN KEY (`id_step`) REFERENCES `incorporation_steps` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incorporation_steps`
--

DROP TABLE IF EXISTS `incorporation_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incorporation_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `form_jurdique` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `sub_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incorporations`
--

DROP TABLE IF EXISTS `incorporations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incorporations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_juridique` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_projet` int(11) DEFAULT NULL,
  `title` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `ICE` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet` (`id_projet`),
  CONSTRAINT `id_projet` FOREIGN KEY (`id_projet`) REFERENCES `projects_applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_number` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'En cours d''examen',
  `password` varchar(145) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `gender` enum('Homme','Femme') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(265) DEFAULT NULL,
  `township_id` int(11) DEFAULT NULL,
  `degrees` json DEFAULT NULL,
  `professional_experience` json DEFAULT NULL,
  `reduced_mobility` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `rejected-reason` varchar(465) DEFAULT NULL,
  `state_help` json DEFAULT NULL,
  `state_help_type` varchar(45) DEFAULT NULL,
  `otherquestions` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `member_township_idx` (`township_id`),
  CONSTRAINT `member_township` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2053 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_application_members`
--

DROP TABLE IF EXISTS `project_application_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_application_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_application_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `is_op` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_application_id_idx` (`project_application_id`),
  KEY `member_id_idx` (`member_id`),
  CONSTRAINT `member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `project_application_id` FOREIGN KEY (`project_application_id`) REFERENCES `projects_applications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_histories`
--

DROP TABLE IF EXISTS `project_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `id_projet` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`id_projet`),
  CONSTRAINT `project_id` FOREIGN KEY (`id_projet`) REFERENCES `projects_applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects_applications`
--

DROP TABLE IF EXISTS `projects_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `township_id` int(11) NOT NULL,
  `sheet_id` int(11) DEFAULT NULL,
  `title` varchar(165) NOT NULL,
  `description` varchar(465) DEFAULT NULL,
  `market_type` varchar(165) DEFAULT NULL,
  `business_model` json DEFAULT NULL,
  `financial_data` json DEFAULT NULL,
  `company` json DEFAULT NULL,
  `training_needs` json DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Nouveau',
  `progress` varchar(45) DEFAULT NULL,
  `training` varchar(45) DEFAULT NULL,
  `incorporation` varchar(45) DEFAULT NULL,
  `funding` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `rejected_reason` varchar(465) DEFAULT NULL,
  `montant_est` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_application_member_idx` (`member_id`),
  KEY `project_application_category_idx` (`category_id`),
  KEY `project_application_township_idx` (`township_id`),
  KEY `project_application_sheet_idx` (`sheet_id`),
  KEY `project_application_creator_idx` (`created_by`),
  KEY `project_application_updator_idx` (`updated_by`),
  CONSTRAINT `project_application_category` FOREIGN KEY (`category_id`) REFERENCES `projects_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_application_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `project_application_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_application_sheet` FOREIGN KEY (`sheet_id`) REFERENCES `projects_sheets` (`id`),
  CONSTRAINT `project_application_township` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_application_updator` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=800 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects_categories`
--

DROP TABLE IF EXISTS `projects_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects_sheets`
--

DROP TABLE IF EXISTS `projects_sheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `title` varchar(165) NOT NULL,
  `description` varchar(565) NOT NULL,
  `market_type` varchar(45) NOT NULL,
  `holder_profile` varchar(65) NOT NULL,
  `surface` int(11) NOT NULL,
  `equipment` varchar(265) DEFAULT NULL,
  `production_value` int(11) NOT NULL,
  `production_unit` varchar(45) NOT NULL,
  `production_duration` varchar(45) NOT NULL,
  `turnover` int(11) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `total_investment` int(11) NOT NULL,
  `strengths` json DEFAULT NULL,
  `weaknesses` json DEFAULT NULL,
  `financing_modes` json NOT NULL,
  `investment_program` json NOT NULL,
  `partnerships` varchar(265) DEFAULT NULL,
  `contacts` varchar(265) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_sheet_category_idx` (`category_id`),
  KEY `project_sheet_township_idx` (`township_id`),
  CONSTRAINT `project_sheet_category` FOREIGN KEY (`category_id`) REFERENCES `projects_categories` (`id`),
  CONSTRAINT `project_sheet_township` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_formation` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8mb4_bin DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sort` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `observation` varchar(512) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_inscrit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formation` (`id_formation`),
  CONSTRAINT `id_formation` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `townships`
--

DROP TABLE IF EXISTS `townships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `townships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(65) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `role` varchar(65) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-18 13:09:36
