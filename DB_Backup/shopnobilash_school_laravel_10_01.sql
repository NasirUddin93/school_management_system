school_management-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2025 at 03:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopnobilash_school_laravel_10_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_label` varchar(20) NOT NULL COMMENT 'Example: 2024-2025',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Active','Closed') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `year_label`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-2024', '2025-09-03', '2025-09-25', 'Active', NULL, '2025-09-16 23:23:45'),
(2, '2024-2025', '2024-01-15', '2025-09-30', 'Active', '2025-09-15 12:06:30', '2025-09-15 12:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Nasir Uddin', 'nasir93cse@gmail.com', NULL, '$2y$12$M/WEYzrYhmfw7tAnWc713O50U5TpgKqrjaooyiOE8hXIm5RmVJxH.', NULL, '2025-09-13 03:56:40', '2025-09-13 03:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References enrollments table',
  `teacher_assignment_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'References teacher_assignments table',
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent','Late','Excused') NOT NULL DEFAULT 'Present',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `enrollment_id`, `teacher_assignment_id`, `attendance_date`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-09-17', 'Present', 'kfjkgjfk', '2025-09-17 03:38:56', '2025-09-17 03:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `order_number` int(10) UNSIGNED NOT NULL COMMENT 'Order of class, 1 for Play, 2 for Nursery, etc.',
  `description` text DEFAULT NULL COMMENT 'Optional description of the class',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `order_number`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Play', 1, 'Play group class for beginners', NULL, '2025-09-13 05:10:40'),
(2, 'Nursery', 2, 'Nursery class for early learners', NULL, NULL),
(3, 'KG-01', 3, 'Kindergarten level 1', NULL, NULL),
(4, 'KG-02', 4, 'Kindergarten level 2', NULL, NULL),
(5, 'Class-01', 5, 'Primary Class 1', NULL, NULL),
(6, 'Class-02', 6, 'Primary Class 2', NULL, NULL),
(7, 'Class-03', 7, 'Primary Class 3', NULL, NULL),
(8, 'Class-04', 8, 'Primary Class 4', NULL, NULL),
(9, 'Class-05', 9, 'Primary Class 5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References classes table',
  `section_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References sections table',
  `shift_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References shifts table',
  `capacity` int(11) DEFAULT NULL COMMENT 'Maximum number of students in this section',
  `description` text DEFAULT NULL COMMENT 'Additional info about this class-section',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`id`, `class_id`, `section_id`, `shift_id`, `capacity`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 30, 'Play A Section Morning', '2025-09-14 02:50:23', '2025-09-14 02:58:29'),
(3, 2, 1, 1, 20, 'jhjkjkkl', '2025-09-14 07:09:22', '2025-09-16 22:56:41'),
(4, 3, 1, 1, 20, 'dfkjdj', '2025-09-16 22:57:01', '2025-09-16 22:57:01'),
(5, 5, 1, 1, 50, 'ksjkdjsd', '2025-09-16 22:57:33', '2025-09-16 22:57:33'),
(6, 6, 1, 1, 50, 'kjsdkjfk', '2025-09-16 22:57:50', '2025-09-16 22:57:50'),
(7, 7, 1, 1, 50, 'ksjdkjf', '2025-09-16 22:58:07', '2025-09-16 22:58:07'),
(8, 8, 1, 1, 50, 'kjsdkjf', '2025-09-16 22:58:25', '2025-09-16 22:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `class_section_subject`
--

CREATE TABLE `class_section_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `class_section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_section_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References class_sections table',
  `subject_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References subjects table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_section_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2025-09-16 00:59:06', '2025-09-16 00:59:06'),
(3, 3, 5, '2025-09-16 00:59:26', '2025-09-16 00:59:26'),
(4, 1, 2, '2025-09-16 23:08:00', '2025-09-16 23:08:00'),
(5, 1, 5, '2025-09-16 23:08:19', '2025-09-16 23:08:19'),
(6, 1, 6, '2025-09-16 23:08:38', '2025-09-16 23:08:38'),
(7, 3, 4, '2025-09-16 23:10:11', '2025-09-16 23:10:11'),
(8, 3, 2, '2025-09-16 23:10:24', '2025-09-16 23:10:24'),
(9, 3, 6, '2025-09-16 23:10:50', '2025-09-16 23:10:50'),
(10, 3, 7, '2025-09-16 23:11:00', '2025-09-16 23:11:00'),
(11, 4, 4, '2025-09-16 23:12:14', '2025-09-16 23:12:14'),
(12, 4, 2, '2025-09-16 23:12:22', '2025-09-16 23:12:22'),
(13, 4, 6, '2025-09-16 23:12:30', '2025-09-16 23:12:30'),
(14, 4, 8, '2025-09-16 23:12:40', '2025-09-16 23:12:40'),
(15, 4, 5, '2025-09-16 23:13:21', '2025-09-16 23:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References students table',
  `class_section_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References class_sections table',
  `academic_year_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References academic_years table',
  `roll_number` int(11) DEFAULT NULL COMMENT 'Roll number for student in that class',
  `enrollment_date` date DEFAULT NULL COMMENT 'Date of enrollment',
  `status` enum('Active','Completed','Promoted','Transferred','Dropped') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `class_section_id`, `academic_year_id`, `roll_number`, `enrollment_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 101, '2025-09-17', 'Active', '2025-09-16 23:57:11', '2025-09-16 23:57:11'),
(2, 3, 1, 2, 102, '2025-09-17', 'Active', '2025-09-16 23:57:42', '2025-09-16 23:57:42'),
(3, 4, 1, 2, 103, '2025-09-17', 'Active', '2025-09-16 23:58:03', '2025-09-16 23:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Exam name, e.g., Midterm, Final',
  `description` text DEFAULT NULL,
  `exam_date` date NOT NULL COMMENT 'Date of the exam',
  `class_section_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Exam assigned to class-section',
  `subject_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Exam subject',
  `teacher_assignment_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Teacher conducting the exam',
  `status` enum('Scheduled','Completed','Cancelled') NOT NULL DEFAULT 'Scheduled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `description`, `exam_date`, `class_section_id`, `subject_id`, `teacher_assignment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mid-Term', 'in middle of the year', '2025-09-15', 1, 4, NULL, 'Scheduled', '2025-09-15 10:12:38', '2025-09-15 10:12:38'),
(2, 'Final', 'At end of the year', '2025-12-10', 1, 2, NULL, 'Scheduled', '2025-09-15 10:15:35', '2025-09-15 10:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References exams table',
  `enrollment_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References enrollments table (student in class)',
  `subject_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References subjects table',
  `marks_obtained` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT 'Marks obtained by student',
  `total_marks` decimal(5,2) NOT NULL COMMENT 'Total marks for the exam',
  `grade` varchar(5) DEFAULT NULL COMMENT 'Calculated grade like A, B, C, etc.',
  `is_passed` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Pass/Fail status',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_structures`
--

CREATE TABLE `fee_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_type_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References fee_types table',
  `class_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References classes table',
  `section_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Optional reference to sections table',
  `shift_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Optional reference to shifts table',
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Standard fee amount for this structure',
  `effective_date` date NOT NULL COMMENT 'Date when this fee structure becomes active',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_structures`
--

INSERT INTO `fee_structures` (`id`, `fee_type_id`, `class_id`, `section_id`, `shift_id`, `amount`, `effective_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 2, 20000.00, '2025-09-16', 'active', '2025-09-16 02:19:17', '2025-09-16 02:19:17'),
(2, 1, 2, 2, 2, 30000.00, '2025-09-16', 'active', '2025-09-16 02:20:52', '2025-09-16 02:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Type of fee like Tuition Fee, Exam Fee, Late Fine',
  `description` text DEFAULT NULL,
  `recurrence` enum('one_time','monthly','yearly','occasionally') NOT NULL DEFAULT 'one_time' COMMENT 'How often this fee is charged',
  `default_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`, `description`, `recurrence`, `default_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tution Fee', 'Monthly Payable', 'monthly', 1200.00, 'active', '2025-09-15 09:44:00', '2025-09-15 09:44:00'),
(2, 'Admission Fee', 'kjdkjfkd', 'yearly', 10000.00, 'active', '2025-09-15 09:44:30', '2025-09-15 09:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_12_133615_create_admins_table', 1),
(6, '2025_09_13_014953_create_classes_table', 1),
(7, '2025_09_13_030936_create_sections_table', 1),
(8, '2025_09_13_031658_create_shifts_table', 1),
(9, '2025_09_13_032841_create_class_sections_table', 1),
(10, '2025_09_13_040645_create_class_students_table', 1),
(11, '2025_09_13_050210_create_academic_years_table', 2),
(12, '2025_09_13_052142_create_teachers_table', 3),
(13, '2025_09_13_053227_create_subjects_table', 4),
(14, '2025_09_13_065743_create_fee_types_table', 5),
(15, '2025_09_13_081323_create_student_fines_table', 6),
(16, '2025_09_13_073547_create_fee_structures_table', 7),
(17, '2025_09_13_075505_create_student_fees_table', 8),
(18, '2025_09_13_080410_create_payments_table', 9),
(19, '2025_09_13_052753_create_teacher_subject_table', 10),
(20, '2025_09_13_091921_create_class_subjects_table', 11),
(21, '2025_09_13_052911_create_teacher_class_section_table', 12),
(22, '2025_09_13_060139_create_teacher_assignments_table', 13),
(23, '2025_09_13_062646_create_exams_table', 14),
(24, '2025_09_13_045115_create_enrollments_table', 15),
(25, '2025_09_13_063346_create_exam_results_table', 16),
(26, '2025_09_13_061047_create_attendances_table', 17),
(27, '2025_09_17_073028_add_password_to_teachers_table', 18),
(28, '2025_09_13_053942_create_class_section_subject_table', 19),
(29, '2025_09_17_082343_add_profile_picture_to_teachers_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References students table',
  `student_fee_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References student_fees table',
  `amount_paid` decimal(10,2) NOT NULL COMMENT 'Amount paid in this transaction',
  `payment_date` date NOT NULL COMMENT 'Date the payment was made',
  `payment_method` enum('cash','card','mobile_banking','bank_transfer','check','other') NOT NULL DEFAULT 'cash' COMMENT 'Payment method used',
  `transaction_reference` varchar(255) DEFAULT NULL COMMENT 'Receipt number or external transaction ID',
  `status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending' COMMENT 'Payment status',
  `remarks` text DEFAULT NULL COMMENT 'Any extra notes about the payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `student_fee_id`, `amount_paid`, `payment_date`, `payment_method`, `transaction_reference`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 80000.00, '2025-09-17', 'mobile_banking', '3768738438984', 'completed', 'dkjfkdjkfjd', '2025-09-17 03:32:34', '2025-09-17 03:32:34'),
(2, 3, 1, 70000.00, '2025-09-15', 'bank_transfer', '7987988', 'completed', 'jhjkhjhk', '2025-09-17 03:33:26', '2025-09-17 03:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL COMMENT 'Section name like A, B, C',
  `description` text DEFAULT NULL COMMENT 'Optional description about the section',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Section A', '2025-09-13 08:51:09', '2025-09-13 08:51:09'),
(2, 'B', 'Section B', '2025-09-13 08:52:08', '2025-09-13 09:25:42'),
(3, 'C', 'Section c', '2025-09-13 08:52:38', '2025-09-13 08:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Shift name like Morning, Day',
  `start_time` time DEFAULT NULL COMMENT 'Shift start time, optional',
  `end_time` time DEFAULT NULL COMMENT 'Shift end time, optional',
  `description` text DEFAULT NULL COMMENT 'Additional details about the shift',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Morning', NULL, NULL, 'Morning Shift', '2025-09-13 09:53:15', '2025-09-13 09:53:15'),
(2, 'Day', NULL, NULL, 'Day Shift', '2025-09-13 09:54:15', '2025-09-13 09:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_code` varchar(30) NOT NULL COMMENT 'Unique student ID',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive','Transferred') NOT NULL DEFAULT 'Active',
  `class_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_code`, `first_name`, `last_name`, `gender`, `dob`, `guardian_name`, `guardian_phone`, `address`, `admission_date`, `photo`, `status`, `class_section_id`, `created_at`, `updated_at`) VALUES
(1, '25000095', 'Shaham', 'Bin Mamun', 'Male', '2013-09-10', '01707568468', '01707568467', 'jdfjkdj', '2025-09-14', 'students/student_1758088047_4LVfWCzBmz.jpg', 'Active', 1, '2025-09-14 05:00:55', '2025-09-16 23:47:27'),
(2, '25000047', 'Amena', 'Faiza', 'Female', '2020-09-01', '01707568468', '01707568467', 'jkdjkfjd', '2025-09-17', 'students/student_1758088436_JO3CFCRQxQ.jpg', 'Active', 3, '2025-09-16 23:40:17', '2025-09-16 23:53:56'),
(3, '25000048', 'Kazi Mavisha', 'Maryam', 'Female', '2020-09-01', '01707568468', '01707568467', 'kjkdjf', '2025-09-17', 'students/student_1758088131_xq4DXNZJ1j.jpg', 'Active', 1, '2025-09-16 23:48:51', '2025-09-16 23:48:51'),
(4, '25000049', 'Md. Sajid', 'Salman', 'Male', '2020-09-16', '01707568468', '01707568467', 'kdfkdj', '2025-09-17', 'students/student_1758088519_ml7J651QtX.jpg', 'Active', 1, '2025-09-16 23:55:19', '2025-09-16 23:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References students table',
  `fee_structure_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'References fee_structures table',
  `fee_type_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References fee_types table directly for flexibility',
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Base fee amount',
  `late_fine` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Late fine if paid after due date',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Final payable amount including fines',
  `due_date` date NOT NULL COMMENT 'Fee due date',
  `paid_date` date DEFAULT NULL COMMENT 'Actual date fee was paid',
  `status` enum('unpaid','partially_paid','paid','overdue','cancelled') NOT NULL DEFAULT 'unpaid',
  `remarks` text DEFAULT NULL COMMENT 'Additional notes about this fee',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `student_id`, `fee_structure_id`, `fee_type_id`, `amount`, `late_fine`, `total_amount`, `due_date`, `paid_date`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 10000.00, 200.00, 10200.00, '2025-09-16', NULL, 'unpaid', NULL, '2025-09-16 04:55:32', '2025-09-16 04:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_fines`
--

CREATE TABLE `student_fines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References students table',
  `fee_type_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'References fee_types table, optional for categorizing fines',
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Fine amount imposed',
  `fine_date` date NOT NULL COMMENT 'Date when fine was imposed',
  `due_date` date DEFAULT NULL COMMENT 'Due date for paying the fine',
  `reason` varchar(255) DEFAULT NULL COMMENT 'Reason for the fine',
  `status` enum('unpaid','partially_paid','paid','cancelled') NOT NULL DEFAULT 'unpaid' COMMENT 'Fine payment status',
  `remarks` text DEFAULT NULL COMMENT 'Additional notes about the fine',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Subject name',
  `code` varchar(20) DEFAULT NULL COMMENT 'Optional subject code',
  `description` text DEFAULT NULL COMMENT 'Subject description or syllabus',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'English', '102', 'kjdkfjgkjf', 'Active', '2025-09-15 08:36:01', '2025-09-16 23:05:19'),
(4, 'Bangla', '101', 'ksjdkjf', 'Active', '2025-09-15 08:51:59', '2025-09-15 08:52:21'),
(5, 'Mathematics', '103', 'kjkdjkfjd', 'Active', '2025-09-15 08:52:46', '2025-09-16 23:05:31'),
(6, 'Drawing', '104', 'kdjfkjd', 'Active', '2025-09-16 23:06:04', '2025-09-16 23:06:04'),
(7, 'Religion', '105', 'kdjfkdj', 'Active', '2025-09-16 23:09:35', '2025-09-16 23:09:35'),
(8, 'IME', '106', 'kldjfkjd', 'Active', '2025-09-16 23:11:52', '2025-09-16 23:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL COMMENT 'Profile picture path',
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL COMMENT 'e.g., MSc in Math',
  `specialization` varchar(255) DEFAULT NULL COMMENT 'Subject specialization',
  `joining_date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Active or Inactive teacher',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_picture`, `phone`, `gender`, `date_of_birth`, `qualification`, `specialization`, `joining_date`, `address`, `city`, `state`, `zip`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kazi Azimul', 'Faiza', 'info@softnovait.cim', '$2y$12$p5DtKHR6A4hL8NczxxpCX.O.zPrZxqcwdVSbSgx2xoNMs9OuNSWUy', 'teacher_profiles/fZlr40ztNaPY80us511hWyHRTaXx0YJA9rk2UOwx.jpg', '01707568468', 'Male', '2025-09-15', 'M.Sc. in IT', 'IT', '2025-09-17', 'dfdfd', 'Dhaka', 'Dhaka', '1230', 1, '2025-09-17 02:25:29', '2025-09-17 02:36:31'),
(2, 'Md. Mustafizur', 'Rahman', 'info1@softnovait.cim', '$2y$12$4I2JU0l.F1zDNKi08e6rqeMQt1r63e9rY6iPYBZiuXxcBVflocxmq', NULL, '01707568468', 'Male', '2025-09-15', 'M.Sc. in IT', 'IT', '2025-09-17', 'sadsd', 'Dhaka', 'Dhaka', '1230', 1, '2025-09-17 02:41:02', '2025-09-17 02:41:02'),
(3, 'MS. Farzana', 'Afroz', 'info2@softnovait.cim', '$2y$12$4yMi0MFocOqpvJWxIbLCAed8osZatsYgsL9kSCOqc8Eca/H/3CjiS', 'teacher_profiles/jrUseFCduCzaEKLmHPUb1uZWh2bYPf1znxKNMG9r.jpg', '01707568468', 'Female', '2025-09-15', 'M.Sc. in IT', 'IT', '2025-09-17', 'sdfdsf', 'Dhaka', 'Dhaka', '1230', 1, '2025-09-17 02:55:30', '2025-09-17 02:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assignments`
--

CREATE TABLE `teacher_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References teachers table',
  `class_section_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References class_sections table',
  `subject_id` bigint(20) UNSIGNED NOT NULL COMMENT 'References subjects table',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active' COMMENT 'Assignment status',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_assignments`
--

INSERT INTO `teacher_assignments` (`id`, `teacher_id`, `class_section_id`, `subject_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 8, 'Active', '2025-09-17 03:19:47', '2025-09-17 03:26:48'),
(2, 2, 4, 2, 'Active', '2025-09-17 03:20:10', '2025-09-17 03:20:10'),
(3, 3, 3, 6, 'Active', '2025-09-17 03:20:28', '2025-09-17 03:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class_section`
--

CREATE TABLE `teacher_class_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `class_section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_class_section`
--

INSERT INTO `teacher_class_section` (`id`, `teacher_id`, `class_section_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2025-09-17 02:36:31', '2025-09-17 02:36:31'),
(4, 2, 3, '2025-09-17 02:41:02', '2025-09-17 02:41:02'),
(5, 3, 4, '2025-09-17 02:55:30', '2025-09-17 02:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`id`, `teacher_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '2025-09-17 02:36:31', '2025-09-17 02:36:31'),
(4, 2, 4, '2025-09-17 02:41:02', '2025-09-17 02:41:02'),
(5, 3, 5, '2025-09-17 02:55:30', '2025-09-17 02:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `academic_years_year_label_unique` (`year_label`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance` (`enrollment_id`,`teacher_assignment_id`,`attendance_date`),
  ADD KEY `attendances_teacher_assignment_id_foreign` (`teacher_assignment_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_name_unique` (`name`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_section_shift` (`class_id`,`section_id`,`shift_id`),
  ADD KEY `class_sections_section_id_foreign` (`section_id`),
  ADD KEY `class_sections_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `class_section_subject`
--
ALTER TABLE `class_section_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_section_subject_subject_id_class_section_id_unique` (`subject_id`,`class_section_id`),
  ADD KEY `class_section_subject_class_section_id_foreign` (`class_section_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_subject` (`class_section_id`,`subject_id`),
  ADD KEY `class_subjects_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_year` (`student_id`,`academic_year_id`),
  ADD KEY `enrollments_class_section_id_foreign` (`class_section_id`),
  ADD KEY `enrollments_academic_year_id_foreign` (`academic_year_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_subject_exam` (`class_section_id`,`subject_id`,`exam_date`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`),
  ADD KEY `exams_teacher_assignment_id_foreign` (`teacher_assignment_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_exam_result` (`exam_id`,`enrollment_id`,`subject_id`),
  ADD KEY `exam_results_enrollment_id_foreign` (`enrollment_id`),
  ADD KEY `exam_results_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_fee_structure` (`fee_type_id`,`class_id`,`section_id`,`shift_id`,`effective_date`),
  ADD KEY `fee_structures_class_id_foreign` (`class_id`),
  ADD KEY `fee_structures_section_id_foreign` (`section_id`),
  ADD KEY `fee_structures_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_fee_type_name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_student_fee_id_foreign` (`student_fee_id`),
  ADD KEY `payments_student_id_student_fee_id_payment_date_index` (`student_id`,`student_fee_id`,`payment_date`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_name_unique` (`name`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shifts_name_unique` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_code_unique` (`student_code`),
  ADD KEY `students_class_section_id_foreign` (`class_section_id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_fee` (`student_id`,`fee_type_id`,`due_date`),
  ADD KEY `student_fees_fee_structure_id_foreign` (`fee_structure_id`),
  ADD KEY `student_fees_fee_type_id_foreign` (`fee_type_id`);

--
-- Indexes for table `student_fines`
--
ALTER TABLE `student_fines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fines_fee_type_id_foreign` (`fee_type_id`),
  ADD KEY `student_fines_student_id_fee_type_id_fine_date_index` (`student_id`,`fee_type_id`,`fine_date`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_teacher_assignment` (`teacher_id`,`class_section_id`,`subject_id`),
  ADD KEY `teacher_assignments_class_section_id_foreign` (`class_section_id`),
  ADD KEY `teacher_assignments_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `teacher_class_section`
--
ALTER TABLE `teacher_class_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_class_section_teacher_id_class_section_id_unique` (`teacher_id`,`class_section_id`),
  ADD KEY `teacher_class_section_class_section_id_foreign` (`class_section_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_subject_teacher_id_subject_id_unique` (`teacher_id`,`subject_id`),
  ADD KEY `teacher_subject_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class_section_subject`
--
ALTER TABLE `class_section_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_structures`
--
ALTER TABLE `fee_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_fines`
--
ALTER TABLE `student_fines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_class_section`
--
ALTER TABLE `teacher_class_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_teacher_assignment_id_foreign` FOREIGN KEY (`teacher_assignment_id`) REFERENCES `teacher_assignments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD CONSTRAINT `class_sections_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_sections_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_sections_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_section_subject`
--
ALTER TABLE `class_section_subject`
  ADD CONSTRAINT `class_section_subject_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_section_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_teacher_assignment_id_foreign` FOREIGN KEY (`teacher_assignment_id`) REFERENCES `teacher_assignments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_structures`
--
ALTER TABLE `fee_structures`
  ADD CONSTRAINT `fee_structures_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_structures_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_structures_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fee_structures_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_student_fee_id_foreign` FOREIGN KEY (`student_fee_id`) REFERENCES `student_fees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD CONSTRAINT `student_fees_fee_structure_id_foreign` FOREIGN KEY (`fee_structure_id`) REFERENCES `fee_structures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `student_fees_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_fines`
--
ALTER TABLE `student_fines`
  ADD CONSTRAINT `student_fines_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `student_fines_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD CONSTRAINT `teacher_assignments_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_assignments_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_class_section`
--
ALTER TABLE `teacher_class_section`
  ADD CONSTRAINT `teacher_class_section_class_section_id_foreign` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_class_section_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subject_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
