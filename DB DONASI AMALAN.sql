-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table x.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.cache: ~0 rows (approximately)

-- Dumping structure for table x.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.cache_locks: ~0 rows (approximately)

-- Dumping structure for table x.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classes_name_unique` (`name`),
  KEY `classes_user_id_foreign` (`user_id`),
  CONSTRAINT `classes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.classes: ~0 rows (approximately)
INSERT INTO `classes` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'KELAS C IPA', 7, '2025-09-25 00:30:01', '2025-09-25 00:30:01');

-- Dumping structure for table x.enrollment_members
CREATE TABLE IF NOT EXISTS `enrollment_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_enrollment_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enrollment_members_project_enrollment_id_foreign` (`project_enrollment_id`),
  KEY `enrollment_members_user_id_foreign` (`user_id`),
  CONSTRAINT `enrollment_members_project_enrollment_id_foreign` FOREIGN KEY (`project_enrollment_id`) REFERENCES `project_enrollments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollment_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.enrollment_members: ~0 rows (approximately)

-- Dumping structure for table x.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table x.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.jobs: ~0 rows (approximately)

-- Dumping structure for table x.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.job_batches: ~0 rows (approximately)

-- Dumping structure for table x.lms_bookmarks
CREATE TABLE IF NOT EXISTS `lms_bookmarks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `lms_material_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_bookmarks_user_id_lms_material_id_unique` (`user_id`,`lms_material_id`),
  KEY `lms_bookmarks_lms_material_id_foreign` (`lms_material_id`),
  CONSTRAINT `lms_bookmarks_lms_material_id_foreign` FOREIGN KEY (`lms_material_id`) REFERENCES `lms_materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lms_bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.lms_bookmarks: ~2 rows (approximately)
INSERT INTO `lms_bookmarks` (`id`, `user_id`, `lms_material_id`, `created_at`, `updated_at`) VALUES
	(7, 9, 25, '2025-09-25 03:46:15', '2025-09-25 03:46:15'),
	(8, 9, 5, '2025-09-25 03:46:20', '2025-09-25 03:46:20');

-- Dumping structure for table x.lms_contents
CREATE TABLE IF NOT EXISTS `lms_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lms_material_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('file','video_link','quiz') COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_or_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_contents_lms_material_id_foreign` (`lms_material_id`),
  KEY `lms_contents_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `lms_contents_lms_material_id_foreign` FOREIGN KEY (`lms_material_id`) REFERENCES `lms_materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lms_contents_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.lms_contents: ~0 rows (approximately)
INSERT INTO `lms_contents` (`id`, `lms_material_id`, `quiz_id`, `title`, `description`, `type`, `path_or_url`, `order_column`, `created_at`, `updated_at`) VALUES
	(1, 26, NULL, 'MATERI 1', 'BAB 1', 'file', 'lms_contents/Ol7UvSW9wesQt2d8CkHICHLpygQJ5gnAVwA1tkje.pdf', 0, '2025-09-25 01:15:13', '2025-09-25 01:15:13');

-- Dumping structure for table x.lms_materials
CREATE TABLE IF NOT EXISTS `lms_materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_column` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_materials_user_id_foreign` (`user_id`),
  KEY `lms_materials_subject_id_foreign` (`subject_id`),
  CONSTRAINT `lms_materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lms_materials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.lms_materials: ~3 rows (approximately)
INSERT INTO `lms_materials` (`id`, `user_id`, `subject_id`, `title`, `description`, `order_column`, `created_at`, `updated_at`) VALUES
	(1, 6, 2, 'PEMBELAJARAN', 'UNTUK MAKALAH', 0, '2025-09-23 17:25:16', '2025-09-23 17:25:16'),
	(5, 6, 1, 'PEMBELAJARAN', 'UNTUK MAKALAH', 0, '2025-09-23 17:25:25', '2025-09-24 10:38:23'),
	(25, 6, 1, 'dd', 'dd', 0, '2025-09-24 12:38:49', '2025-09-24 12:38:49'),
	(26, 6, 1, 'PEMBANGUNAN', 'TENTANG INDONESIA BERKEMAJUAN', 0, '2025-09-25 01:15:12', '2025-09-25 01:15:12');

-- Dumping structure for table x.lms_progress
CREATE TABLE IF NOT EXISTS `lms_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `lms_content_id` bigint unsigned NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_progress_user_id_lms_content_id_unique` (`user_id`,`lms_content_id`),
  KEY `lms_progress_lms_content_id_foreign` (`lms_content_id`),
  CONSTRAINT `lms_progress_lms_content_id_foreign` FOREIGN KEY (`lms_content_id`) REFERENCES `lms_contents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lms_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.lms_progress: ~0 rows (approximately)
INSERT INTO `lms_progress` (`id`, `user_id`, `lms_content_id`, `is_completed`, `created_at`, `updated_at`) VALUES
	(1, 9, 1, 0, '2025-09-25 03:55:51', '2025-09-25 03:55:51');

-- Dumping structure for table x.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_08_16_114642_create_roles_table', 1),
	(5, '2025_08_16_114754_create_classes_table', 1),
	(6, '2025_08_16_114822_add_role_and_class_columns_to_users_table', 1),
	(7, '2025_08_16_144436_add_username_column_to_users_table', 1),
	(8, '2025_08_16_150254_make_email_column_nullable_in_users_table', 1),
	(9, '2025_08_17_122456_create_sdgs_table', 1),
	(10, '2025_08_17_133643_create_projects_table', 1),
	(11, '2025_08_17_134119_create_project_sdg_table', 1),
	(12, '2025_08_20_200301_create_subjects_table', 1),
	(13, '2025_08_20_200350_change_subject_to_foreign_key_in_projects_table', 1),
	(14, '2025_08_23_071606_create_lms_materials_table', 1),
	(15, '2025_08_23_071607_create_lms_contents_table', 1),
	(16, '2025_08_25_014700_create_rubrics_table', 1),
	(17, '2025_08_25_041936_create_project_enrollments_table', 1),
	(18, '2025_08_25_045707_create_enrollment_members_table', 1),
	(19, '2025_08_25_074547_add_status_to_users_table', 1),
	(20, '2025_08_25_094654_add_user_id_to_enrollment_members_table', 1),
	(21, '2025_08_25_125225_create_project_submissions_table', 1),
	(22, '2025_08_25_130025_add_submitted_status_to_project_enrollments_table', 1),
	(23, '2025_08_25_140058_create_project_rubrics_table', 1),
	(24, '2025_08_25_140059_create_project_grades_table', 1),
	(25, '2025_08_25_140059_create_project_rubric_items_table', 1),
	(26, '2025_08_25_140059_create_sdg_rubrics_table', 1),
	(27, '2025_08_25_140060_create_sdg_rubric_items_table', 1),
	(28, '2025_09_05_143339_create_rubric_item_grades_table', 1),
	(29, '2025_09_05_153505_modify_status_enum_in_project_enrollments_table', 1),
	(30, '2025_09_05_181954_create_lms_progress_table', 1),
	(31, '2025_09_05_190230_create_lms_bookmarks_table', 1),
	(32, '2025_09_05_192920_create_quizzes_table', 1),
	(33, '2025_09_05_192921_create_question_options_table', 1),
	(34, '2025_09_05_192921_create_questions_table', 1),
	(35, '2025_09_05_195001_add_image_to_questions_table', 1),
	(36, '2025_09_06_201407_create_quiz_attempts_table', 1),
	(37, '2025_09_06_201408_create_quiz_answers_table', 1),
	(38, '2025_09_06_204652_add_quiz_settings_to_quizzes_table', 1),
	(39, '2025_09_06_210824_add_start_time_to_quiz_attempts_table', 1),
	(40, '2025_09_13_094215_add_quiz_integration_to_lms_contents_table', 1),
	(41, '2025_09_14_025935_make_path_or_url_nullable_in_lms_contents_table', 1),
	(42, '2025_09_16_150232_make_score_nullable_in_quiz_attempts_table', 1),
	(43, '2025_09_16_160523_make_option_id_nullable_in_quiz_answers_table', 1),
	(44, '2025_09_16_235138_add_is_completed_to_lms_progress_table', 1),
	(45, '2025_09_17_001957_make_reason_to_join_nullable_in_project_enrollments_table', 1),
	(46, '2025_09_17_011046_add_status_to_project_submissions_table', 1);

-- Dumping structure for table x.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table x.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_user_id_foreign` (`user_id`),
  KEY `projects_subject_id_foreign` (`subject_id`),
  CONSTRAINT `projects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.projects: ~0 rows (approximately)
INSERT INTO `projects` (`id`, `user_id`, `subject_id`, `title`, `description`, `attachment_path`, `deadline`, `created_at`, `updated_at`) VALUES
	(1, 6, 2, 'SSS', 'ODODOD', NULL, NULL, '2025-09-23 17:41:32', '2025-09-26 07:47:36'),
	(2, 6, 2, 'TES', 'TES TES', 'project_attachments/spllqc0qQs2fGAFAxlWyM4qbIHg7dALsJjt2L1kw.pdf', NULL, '2025-09-25 04:40:55', '2025-09-26 07:47:25');

-- Dumping structure for table x.project_enrollments
CREATE TABLE IF NOT EXISTS `project_enrollments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_to_join` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected','submitted','revision_needed','graded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_enrollments_project_id_foreign` (`project_id`),
  KEY `project_enrollments_user_id_foreign` (`user_id`),
  CONSTRAINT `project_enrollments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_enrollments: ~0 rows (approximately)

-- Dumping structure for table x.project_grades
CREATE TABLE IF NOT EXISTS `project_grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_enrollment_id` bigint unsigned NOT NULL,
  `score` int DEFAULT NULL,
  `feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_grades_project_enrollment_id_foreign` (`project_enrollment_id`),
  CONSTRAINT `project_grades_project_enrollment_id_foreign` FOREIGN KEY (`project_enrollment_id`) REFERENCES `project_enrollments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_grades: ~0 rows (approximately)

-- Dumping structure for table x.project_rubrics
CREATE TABLE IF NOT EXISTS `project_rubrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_rubrics_project_id_foreign` (`project_id`),
  CONSTRAINT `project_rubrics_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_rubrics: ~0 rows (approximately)
INSERT INTO `project_rubrics` (`id`, `project_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2025-09-26 08:05:39', '2025-09-26 08:05:39');

-- Dumping structure for table x.project_rubric_items
CREATE TABLE IF NOT EXISTS `project_rubric_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_rubric_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_rubric_items_project_rubric_id_foreign` (`project_rubric_id`),
  CONSTRAINT `project_rubric_items_project_rubric_id_foreign` FOREIGN KEY (`project_rubric_id`) REFERENCES `project_rubrics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_rubric_items: ~0 rows (approximately)
INSERT INTO `project_rubric_items` (`id`, `project_rubric_id`, `name`, `weight`, `created_at`, `updated_at`) VALUES
	(1, 1, 'SS', 100, '2025-09-26 08:05:39', '2025-09-26 08:05:39');

-- Dumping structure for table x.project_sdg
CREATE TABLE IF NOT EXISTS `project_sdg` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `sdg_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_sdg_project_id_foreign` (`project_id`),
  KEY `project_sdg_sdg_id_foreign` (`sdg_id`),
  CONSTRAINT `project_sdg_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_sdg_sdg_id_foreign` FOREIGN KEY (`sdg_id`) REFERENCES `sdgs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_sdg: ~0 rows (approximately)
INSERT INTO `project_sdg` (`id`, `project_id`, `sdg_id`, `created_at`, `updated_at`) VALUES
	(3, 2, 3, NULL, NULL),
	(4, 2, 7, NULL, NULL),
	(5, 1, 3, NULL, NULL),
	(6, 1, 6, NULL, NULL),
	(7, 1, 7, NULL, NULL),
	(8, 1, 10, NULL, NULL);

-- Dumping structure for table x.project_submissions
CREATE TABLE IF NOT EXISTS `project_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_enrollment_id` bigint unsigned NOT NULL,
  `final_submission_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_submission_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  PRIMARY KEY (`id`),
  KEY `project_submissions_project_enrollment_id_foreign` (`project_enrollment_id`),
  CONSTRAINT `project_submissions_project_enrollment_id_foreign` FOREIGN KEY (`project_enrollment_id`) REFERENCES `project_enrollments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.project_submissions: ~0 rows (approximately)

-- Dumping structure for table x.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.questions: ~0 rows (approximately)

-- Dumping structure for table x.question_options
CREATE TABLE IF NOT EXISTS `question_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `option_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_options_question_id_foreign` (`question_id`),
  CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.question_options: ~0 rows (approximately)

-- Dumping structure for table x.quizzes
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `lms_material_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `duration` int unsigned DEFAULT NULL,
  `shuffle_questions` tinyint(1) NOT NULL DEFAULT '0',
  `show_correct_answers` tinyint(1) NOT NULL DEFAULT '1',
  `allow_multiple_attempts` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizzes_user_id_foreign` (`user_id`),
  KEY `quizzes_lms_material_id_foreign` (`lms_material_id`),
  CONSTRAINT `quizzes_lms_material_id_foreign` FOREIGN KEY (`lms_material_id`) REFERENCES `lms_materials` (`id`) ON DELETE SET NULL,
  CONSTRAINT `quizzes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.quizzes: ~0 rows (approximately)

-- Dumping structure for table x.quiz_answers
CREATE TABLE IF NOT EXISTS `quiz_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_attempt_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `question_option_id` bigint unsigned DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_answers_quiz_attempt_id_foreign` (`quiz_attempt_id`),
  KEY `quiz_answers_question_id_foreign` (`question_id`),
  KEY `quiz_answers_question_option_id_foreign` (`question_option_id`),
  CONSTRAINT `quiz_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_answers_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_answers_quiz_attempt_id_foreign` FOREIGN KEY (`quiz_attempt_id`) REFERENCES `quiz_attempts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.quiz_answers: ~0 rows (approximately)

-- Dumping structure for table x.quiz_attempts
CREATE TABLE IF NOT EXISTS `quiz_attempts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned NOT NULL,
  `started_at` timestamp NOT NULL,
  `score` int unsigned DEFAULT NULL,
  `total_questions` int NOT NULL,
  `correct_answers` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_attempts_user_id_foreign` (`user_id`),
  KEY `quiz_attempts_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `quiz_attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.quiz_attempts: ~0 rows (approximately)

-- Dumping structure for table x.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2025-09-21 12:51:44', '2025-09-21 12:51:44'),
	(2, 'guru', '2025-09-21 12:51:44', '2025-09-21 12:51:44'),
	(3, 'siswa', '2025-09-21 12:51:44', '2025-09-21 12:51:44'),
	(4, 'kepsek', '2025-09-21 12:51:44', '2025-09-21 12:51:44');

-- Dumping structure for table x.rubrics
CREATE TABLE IF NOT EXISTS `rubrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `type` enum('project','sdg') COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int NOT NULL,
  `criteria` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rubrics_project_id_foreign` (`project_id`),
  CONSTRAINT `rubrics_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.rubrics: ~0 rows (approximately)

-- Dumping structure for table x.rubric_item_grades
CREATE TABLE IF NOT EXISTS `rubric_item_grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_grade_id` bigint unsigned NOT NULL,
  `gradable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradable_id` bigint unsigned NOT NULL,
  `score` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rubric_item_grades_project_grade_id_foreign` (`project_grade_id`),
  KEY `rubric_item_grades_gradable_type_gradable_id_index` (`gradable_type`,`gradable_id`),
  CONSTRAINT `rubric_item_grades_project_grade_id_foreign` FOREIGN KEY (`project_grade_id`) REFERENCES `project_grades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.rubric_item_grades: ~0 rows (approximately)

-- Dumping structure for table x.sdgs
CREATE TABLE IF NOT EXISTS `sdgs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.sdgs: ~9 rows (approximately)
INSERT INTO `sdgs` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(3, 'SDG 1', NULL, '2025-09-25 05:18:24', '2025-09-25 05:18:24'),
	(4, 'SDG 2', NULL, '2025-09-25 05:18:34', '2025-09-25 05:18:34'),
	(5, 'SDG 3', NULL, '2025-09-25 05:18:41', '2025-09-25 05:18:41'),
	(6, 'SDG 4', NULL, '2025-09-25 05:18:48', '2025-09-25 05:18:48'),
	(7, 'SDG 5', NULL, '2025-09-25 05:19:09', '2025-09-25 05:19:09'),
	(8, 'SDG 6', NULL, '2025-09-25 05:19:21', '2025-09-25 05:19:21'),
	(9, 'SDG 7', NULL, '2025-09-25 05:19:30', '2025-09-25 05:19:30'),
	(10, 'SDG 8', NULL, '2025-09-25 05:19:38', '2025-09-25 05:19:38'),
	(11, 'SDG 9', NULL, '2025-09-25 05:19:49', '2025-09-25 05:19:49'),
	(12, 'SDG 10', NULL, '2025-09-25 05:20:15', '2025-09-25 05:20:15');

-- Dumping structure for table x.sdg_rubrics
CREATE TABLE IF NOT EXISTS `sdg_rubrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `sdg_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sdg_rubrics_project_id_foreign` (`project_id`),
  KEY `sdg_rubrics_sdg_id_foreign` (`sdg_id`),
  CONSTRAINT `sdg_rubrics_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sdg_rubrics_sdg_id_foreign` FOREIGN KEY (`sdg_id`) REFERENCES `sdgs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.sdg_rubrics: ~0 rows (approximately)
INSERT INTO `sdg_rubrics` (`id`, `project_id`, `sdg_id`, `created_at`, `updated_at`) VALUES
	(3, 2, 7, '2025-09-26 08:08:51', '2025-09-26 08:08:51');

-- Dumping structure for table x.sdg_rubric_items
CREATE TABLE IF NOT EXISTS `sdg_rubric_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sdg_rubric_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sdg_rubric_items_sdg_rubric_id_foreign` (`sdg_rubric_id`),
  CONSTRAINT `sdg_rubric_items_sdg_rubric_id_foreign` FOREIGN KEY (`sdg_rubric_id`) REFERENCES `sdg_rubrics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.sdg_rubric_items: ~0 rows (approximately)
INSERT INTO `sdg_rubric_items` (`id`, `sdg_rubric_id`, `name`, `weight`, `created_at`, `updated_at`) VALUES
	(3, 3, 's', 100, '2025-09-26 08:08:51', '2025-09-26 08:08:51');

-- Dumping structure for table x.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('wg6KjCQWPqGd6xPXCXZwJODLVVQQhPDVjF4QaYpz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUThtdThsQk9lUEF0OUN5dHA4cGZkSXlEUDIyWDIzODZIendHN0VZRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1758909766);

-- Dumping structure for table x.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subjects_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.subjects: ~4 rows (approximately)
INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'IPS', '2025-09-22 16:22:27', '2025-09-22 16:22:27'),
	(2, 'B INDO', '2025-09-22 16:27:12', '2025-09-22 16:27:12'),
	(3, 'MTK', '2025-09-22 16:29:18', '2025-09-22 16:29:18');

-- Dumping structure for table x.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role_id` bigint unsigned DEFAULT NULL,
  `class_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_class_id_foreign` (`class_id`),
  CONSTRAINT `users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table x.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `status`, `role_id`, `class_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'wawan', 'wawan', 'admin@example.com', NULL, '$2y$12$jnD80BEJXCKc8RDuy9NkE.on9SmvmnbyCl.PA2Wqrtx.4Ul9/R0Rm', 'active', NULL, NULL, NULL, '2025-09-20 04:13:16', '2025-09-20 04:13:16'),
	(5, 'Picci', 'picci_admin', 'picci@gmail.com', NULL, '$2y$12$EH/4OOZ6x7WXUZ4GJV9bcOTo8P1/kkJEXyjUhfEDeMaZDtPvAcU/K', 'active', 1, NULL, NULL, '2025-09-21 12:54:42', '2025-09-21 12:54:42'),
	(6, 'Picci Guru', 'picci_guru', 'picci.guru@example.com', NULL, '$2y$12$sbi32bVroQ/Obw.bGkqAfuJNomRdw.BpV9yuzoKecziw1nJdQZumy', 'active', 2, NULL, NULL, '2025-09-23 16:27:51', '2025-09-23 16:27:51'),
	(7, 'Wawan_guru', 'WAWANUNTAN', 'wawanhola90@gmail.com', NULL, '$2y$12$GZN3rXJQQ02tipTWJJkmLOYGVSjZ7lsznV75RPbtMkoO9ykXJxhYC', 'active', 2, NULL, NULL, '2025-09-24 13:35:02', '2025-09-24 13:35:02'),
	(8, 'picci_kepsek', 'picci_kepsek', NULL, NULL, '$2y$12$LZxtG.w1ypHP7upvCCZG5OJyoGqIu5OHrW9zIBlUVVbRk4VrVb7kK', 'active', 4, NULL, NULL, '2025-09-25 00:57:21', '2025-09-25 04:25:38'),
	(9, 'picci_siswa', 'picci_siswa', NULL, NULL, '$2y$12$MSNIcSiWyNswyUbZM2DCGOVOz1tHryeDc7iC7ikQ19DsC2P7GUZiS', 'active', 3, 1, NULL, '2025-09-25 01:18:14', '2025-09-25 01:57:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
