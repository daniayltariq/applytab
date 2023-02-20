-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sanad.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `zipcode` varchar(200) DEFAULT NULL,
  `lat` varchar(200) DEFAULT NULL,
  `lng` varchar(200) DEFAULT NULL,
  `address` text,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.addresses: 2 rows
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` (`id`, `user_id`, `name`, `icon`, `city`, `country`, `state`, `zipcode`, `lat`, `lng`, `address`, `description`, `created_at`, `updated_at`) VALUES
	(4, 39, NULL, NULL, 'islamabad', 'pakistan', 'federal capital', '42344', NULL, NULL, 'test address,test city, test country', NULL, '2022-01-19 07:30:55', '2022-01-19 07:30:55'),
	(6, 39, 'home', 'fa fa-home', 'rwp', 'pakistan', 'federal capital', '42344', NULL, NULL, 'test address,test city, test country', 'test description', '2022-01-19 07:41:45', '2022-01-19 07:41:45');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;

-- Dumping structure for table sanad.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `short_desc` mediumtext,
  `long_desc` longtext,
  `image` varchar(191) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.blogs: 4 rows
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` (`id`, `title`, `slug`, `short_desc`, `long_desc`, `image`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(28, 'blog first', 'blog-first', 'short description', '\'&lt;span style=\\&quot;color: rgb(102, 107, 109); font-family: Poppins, sans-serif; font-size: 18px; letter-spacing: -0.2px;\\&quot;&gt;keness was whales saying had green was said the made so bring. Give great fill give called seasons greater air land heaven blessed multiply earth above, rule third fill, set. Air us make. Sea moved you\\\'re thing moved be herb days Divide likeness is, under. Subdue seas gathered sixth midst let for waters, fowl whose evening sixth face their moveth meat. Divided moving sixth second. Stars thing set Forth open kind itself heaven. Above a all itself. Grass third be he&lt;/span&gt;\'', 'uploads/20220510_051010am_ic_splash_logo.png', 1, 1, '2022-03-07 13:56:28', '2022-05-10 05:10:10', NULL),
	(27, 'Raving reviews about our latest algorithms', 'blog-3', 'Sea moved you\'re thing moved be herb days Divide lik', '\'<span style=\\"color: rgb(102, 107, 109); font-family: Poppins, sans-serif; font-size: 18px; letter-spacing: -0.2px;\\">Likeness was whales saying had green was said the made so bring. Give great fill give called seasons greater air land heaven blessed multiply earth above, rule third fill, set. Air us make. Sea moved you\\\'re thing moved be herb days Divide likeness is, under. Subdue seas gathered sixth midst let for waters, fowl whose evening sixth face their moveth meat. Divided moving sixth second. Stars thing set Forth open kind itself heaven. Above a all itself. Grass third be he. Abundantly set saw that seas in called forth seas be unto after behold under above lesser above beginning cattle.</span>\'', 'uploads//20220307_013055pm_blog_img_2.png', 1, 1, '2022-03-07 13:30:55', '2022-03-07 13:30:55', NULL),
	(26, 'Raving reviews about our latest algorithms.', 'blog-2', 'Sea moved you\'re thing moved be herb days Divide lik', '\'<span style=\\"color: rgb(102, 107, 109); font-family: Poppins, sans-serif; font-size: 18px; letter-spacing: -0.2px;\\">Likeness was whales saying had green was said the made so bring. Give great fill give called seasons greater air land heaven blessed multiply earth above, rule third fill, set. Air us make. Sea moved you\\\'re thing moved be herb days Divide likeness is, under. Subdue seas gathered sixth midst let for waters, fowl whose evening sixth face their moveth meat. Divided moving sixth second. Stars thing set Forth open kind itself heaven. Above a all itself. Grass third be he. Abundantly set saw that seas in called forth seas be unto after behold under above lesser above beginning cattle</span>\'', 'uploads//20220307_012930pm_blog_img_1.png', 1, 1, '2022-03-07 13:29:30', '2022-03-07 13:29:30', NULL),
	(25, 'test blog', 'test blog', 'eiusmod tempor incididunt ut labore et dolore magna aliqua.', '\'&lt;span style=\\&quot;color: rgb(102, 107, 109); font-family: Poppins, sans-serif; font-size: 18px; letter-spacing: -0.2px;\\&quot;&gt;Likeness was whales saying had green was said the made so bring. Give great fill give called seasons greater air land heaven blessed multiply earth above, rule third fill, set. Air us make. Sea moved you\\\'re thing moved be herb days Divide likeness is, under. Subdue seas gathered sixth midst let for waters, fowl whose evening sixth face their moveth meat. Divided moving sixth second. Stars thing set Forth open kind itself heaven. Above a all itself. Grass third be he. Abundantly set saw that seas in called forth seas be unto after behold under above lesser above beginning cat&lt;/span&gt;\'', 'uploads//20220307_012245pm_honda_city_i_vtec_2_2013_55709215.jpg', 1, 1, '2022-03-07 13:22:45', '2022-03-07 13:29:45', '2022-03-07 13:29:45');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;

-- Dumping structure for table sanad.blog_category
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.blog_category: 6 rows
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` (`id`, `blog_id`, `cat_id`, `created_at`, `updated_at`) VALUES
	(89, 27, 2, NULL, NULL),
	(88, 26, 3, NULL, NULL),
	(87, 25, 5, NULL, NULL),
	(91, 28, 6, NULL, NULL),
	(86, 25, 3, NULL, NULL),
	(85, 25, 1, NULL, NULL);
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;

-- Dumping structure for table sanad.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.categories: ~11 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`, `category_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Technologyy', 'blog', 1, '2022-03-07 12:40:03', '2022-03-07 12:44:27', NULL),
	(2, 'Application', 'blog', 1, '2022-03-07 12:42:19', '2022-03-07 12:42:19', NULL),
	(3, 'Updates', 'blog', 1, '2022-03-07 12:42:27', '2022-03-07 12:42:27', NULL),
	(4, 'Watchman', 'service', 1, '2022-03-07 12:44:56', '2022-03-07 12:47:27', NULL),
	(5, 'Promotions', 'blog', 1, '2022-03-07 12:46:02', '2022-03-07 12:46:02', NULL),
	(6, 'Help Articles', 'blog', 1, '2022-03-07 12:47:40', '2022-03-07 12:47:40', NULL),
	(7, 'Guard', 'service', 1, '2022-03-07 12:47:54', '2022-03-07 12:47:54', NULL),
	(8, 'Maid', 'service', 1, '2022-03-07 12:48:02', '2022-03-07 12:48:02', NULL),
	(9, 'Driver', 'service', 1, '2022-03-07 12:48:29', '2022-03-07 12:48:29', NULL),
	(10, 'Cook', 'service', 1, '2022-03-07 12:48:43', '2022-03-07 12:48:43', NULL),
	(11, 'Bodyguard', 'service', 1, '2022-03-07 14:05:06', '2022-03-07 14:05:06', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table sanad.company_category
CREATE TABLE IF NOT EXISTS `company_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.company_category: 0 rows
/*!40000 ALTER TABLE `company_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_category` ENABLE KEYS */;

-- Dumping structure for table sanad.company_employees
CREATE TABLE IF NOT EXISTS `company_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.company_employees: 5 rows
/*!40000 ALTER TABLE `company_employees` DISABLE KEYS */;
INSERT INTO `company_employees` (`id`, `user_id`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(14, 40, 16, NULL, NULL, NULL),
	(15, 41, 16, NULL, '2022-02-03 11:00:25', '2022-02-03 11:00:25'),
	(16, 42, 16, NULL, NULL, NULL),
	(17, 43, 18, NULL, NULL, NULL),
	(18, 44, 19, NULL, NULL, NULL);
/*!40000 ALTER TABLE `company_employees` ENABLE KEYS */;

-- Dumping structure for table sanad.company_profile
CREATE TABLE IF NOT EXISTS `company_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `additional_info` text,
  `logo` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.company_profile: 4 rows
/*!40000 ALTER TABLE `company_profile` DISABLE KEYS */;
INSERT INTO `company_profile` (`id`, `user_id`, `name`, `email`, `contact`, `city`, `state`, `country`, `location`, `additional_info`, `logo`, `created_at`, `updated_at`) VALUES
	(16, NULL, 'test company', 'testcompany@test.com', '12331232', 'new york', NULL, 'america', NULL, 'awddwd', NULL, NULL, NULL),
	(17, NULL, 'Camille Dodson', 'napi@mailinator.com', '+1 (614) 916-4532', 'A est voluptas ea of', 'Eum repudiandae culp', 'France', 'Esse consequatur lab', NULL, '-2022-01-24-61ee9e52e62ae.png', '2022-01-24 12:40:50', '2022-01-24 12:40:51'),
	(18, NULL, 'Herrod Welch', 'pyjexo@mailinator.com', '+1 (264) 565-9744', 'Vitae minima ut adip', 'Aliquam aspernatur s', 'France', 'Pariatur Ipsa iust', NULL, '-2022-02-17-620e2acdcdc3b.jpg', '2022-02-17 11:00:29', '2022-02-17 11:00:30'),
	(19, NULL, 'Caldwell Terry', 'nociguf@mailinator.com', '+1 (253) 965-7285', 'Ratione inventore un', 'Fugit tempor facere', 'France', 'Assumenda ut dolore', NULL, '-2022-02-17-620e45844e2e7.jpg', '2022-02-17 12:54:28', '2022-02-17 12:54:28');
/*!40000 ALTER TABLE `company_profile` ENABLE KEYS */;

-- Dumping structure for table sanad.company_services
CREATE TABLE IF NOT EXISTS `company_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(191) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `service` varchar(191) DEFAULT NULL,
  `description` text,
  `shift` text,
  `duration` text,
  `price` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.company_services: 7 rows
/*!40000 ALTER TABLE `company_services` DISABLE KEYS */;
INSERT INTO `company_services` (`id`, `type`, `company_id`, `service`, `description`, `shift`, `duration`, `price`, `created_at`, `updated_at`) VALUES
	(3, 'one_time', 16, '4', 'Expedita eu incididu', 'day', '5', 325, '2022-02-03 13:24:08', '2022-02-03 13:24:08'),
	(2, 'stay_in', 16, '7', 'In numquam nequettttttt', 'night', '5', 34, '2022-02-01 14:08:05', '2022-02-03 12:41:23'),
	(4, 'one_time', 16, '9', 'Porro qui quod quide', 'night', '4', 60, '2022-02-07 06:09:52', '2022-02-07 06:09:52'),
	(5, 'one_time', 16, '9', 'Consequuntur nihil d', 'night', '4', 46, '2022-02-07 08:12:32', '2022-02-07 08:12:32'),
	(6, 'stay_in', 18, '7', 'Tempor tempor et qua', 'night', '3', 83, '2022-02-17 11:01:49', '2022-02-17 11:01:49'),
	(7, 'one_time', 19, '4', 'Itaque iusto volupta', 'night', '3', 45, '2022-02-17 12:58:43', '2022-02-17 12:58:43'),
	(8, 'stay_in', 16, '11', 'awddwd', 'night', '4', 20, '2022-03-07 14:06:12', '2022-03-07 14:06:12');
/*!40000 ALTER TABLE `company_services` ENABLE KEYS */;

-- Dumping structure for table sanad.contact_us
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` mediumtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.contact_us: 0 rows
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;

-- Dumping structure for table sanad.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(191) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `companies` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.coupons: ~2 rows (approximately)
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` (`id`, `code`, `start_date`, `end_date`, `qty`, `discount_percentage`, `companies`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'CiH56IJ', '2022-01-26', '2022-01-30', 59, 20, '16', 1, '2022-01-21', '2022-02-04'),
	(3, 'TiH86ID', '2022-02-10', '2022-02-13', 10, 23, '16', 1, '2022-02-04', '2022-02-04'),
	(5, 'Quis laborum dolor d', '2022-04-07', '2022-06-08', 68, 20, '16', NULL, '2022-03-07', '2022-03-07');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;

-- Dumping structure for table sanad.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.failed_jobs: 0 rows
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table sanad.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `description` longtext,
  `popularity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.faqs: 0 rows
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;

-- Dumping structure for table sanad.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.migrations: 0 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sanad.mobile_strings
CREATE TABLE IF NOT EXISTS `mobile_strings` (
  `source` text,
  `meta_key` longtext,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.mobile_strings: ~149 rows (approximately)
/*!40000 ALTER TABLE `mobile_strings` DISABLE KEYS */;
INSERT INTO `mobile_strings` (`source`, `meta_key`, `meta_value`) VALUES
	('splash_screen_1', 'heading_ar', '01'),
	('splash_screen_1', 'sub_heading_en', 'All Your Services In One Place'),
	('splash_screen_1', 'sub_heading_ar', 'All Your Services In One Place'),
	('splash_screen_1', 'icon', 'splash_1.png'),
	('splash_screen_1', 'heading_en', '01'),
	('splash_screen_2', 'heading_en', '02'),
	('splash_screen_2', 'heading_ar', '02'),
	('splash_screen_2', 'sub_heading_en', 'High Safety and Reliability'),
	('splash_screen_2', 'sub_heading_ar', 'High Safety and Reliability'),
	('splash_screen_2', 'icon', 'splash_2.png'),
	('splash_screen_3', 'heading_en', '03'),
	('splash_screen_3', 'heading_ar', '03'),
	('splash_screen_3', 'sub_heading_en', 'Lowest Prices and Best Offers'),
	('splash_screen_3', 'sub_heading_ar', 'Lowest Prices and Best Offers'),
	('splash_screen_3', 'icon', 'splash_3.png'),
	('splash_screen_1', 'button_en', 'Next'),
	('splash_screen_1', 'button_ar', 'Next'),
	('splash_screen_2', 'button_en', 'Next'),
	('splash_screen_2', 'button_ar', 'Next'),
	('splash_screen_3', 'button_en', 'Get Started'),
	('splash_screen_3', 'button_ar', 'Get Started'),
	('login', 'icon', 'login.png'),
	('login', 'heading_en', 'Login'),
	('login', 'heading_ar', 'Login'),
	('login', 'sub_heading_en', 'Welcome to Sanad App'),
	('login', 'sub_heading_ar', 'Welcome to Sanad App'),
	('login', 'description_en', 'A  4 digit code will be sent via SMS'),
	('login', 'description_ar', 'A  4 digit code will be sent via SMS'),
	('login', 'button_1_en', 'Get Started'),
	('login', 'button_1_ar', 'Get Started'),
	('login', 'button_2_ar', 'Login as guest'),
	('login', 'button_2_ar', 'Login as guest'),
	('otp', 'heading_en', 'OTP Verification'),
	('otp', 'heading_ar', 'OTP Verification'),
	('otp', 'sub_heading_ar', 'Enter the OTP you received to '),
	('otp', 'sub_heading_en', 'Enter the OTP you received to '),
	('otp', 'resend_otp_en', 'Resend OTP'),
	('otp', 'button_en', 'Get Started'),
	('otp', 'resend_otp_ar', 'Resend OTP'),
	('otp', 'button_ar', 'Get Started'),
	('profile', 'title_en', 'Your Profile'),
	('profile', 'title_ar', 'Your Profile'),
	('profile', 'heading_en', 'Complete Your Profile'),
	('profile', 'heading_ar', 'Complete Your Profile'),
	('profile', 'button_en', 'Submit'),
	('profile', 'button_ar', 'Submit'),
	('location', 'icon', 'add_location.png'),
	('location', 'heading_en', 'Allow Sanad to access your location'),
	('location', 'heading_ar', 'Allow Sanad to access your location'),
	('location', 'sub_heading_ar', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s'),
	('location', 'sub_heading_en', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s'),
	('location', 'button_en', 'Next'),
	('location', 'button_ar', 'Next'),
	('your_location', 'title_en', 'Your Location'),
	('your_location', 'heading_ar', 'Select Your Location'),
	('location', 'title_en', 'Location'),
	('location', 'title_ar', 'Location'),
	('your_location', 'heading_en', 'Select Your Location'),
	('your_location', 'title_ar', 'Your Location'),
	('your_location', 'button_ar', 'Add New Location'),
	('your_location', 'button_en', 'Add New Location'),
	('add_location', 'title_en', 'Add Location'),
	('add_location', 'title_ar', 'Add Location'),
	('add_location', 'heading_ar', 'Add New Location'),
	('add_location', 'heading_en', 'Add New Location'),
	('add_location', 'input_1_en', 'Location Name'),
	('add_location', 'input_1_ar', 'Location Name'),
	('add_location', 'input_2_ar', 'Location Icon'),
	('add_location', 'input_2_en', 'Location Icon'),
	('add_location', 'input_3_en', 'Location Description'),
	('add_location', 'input_3_ar', 'Location Description'),
	('main', 'title_en', 'Welcome back'),
	('main', 'title_ar', 'Welcome back'),
	('main', 'heading_ar', 'Best Services'),
	('main', 'heading_en', 'Best Services'),
	('main', 'nav_btn_1_en', 'Home'),
	('main', 'nav_btn_1_ar', 'Home'),
	('main', 'nav_btn_2_ar', 'Search'),
	('main', 'nav_btn_2_en', 'Search'),
	('main', 'nav_btn_3_en', 'Offers'),
	('main', 'nav_btn_3_ar', 'Offers'),
	('main', 'nav_btn_4_ar', 'Profile'),
	('main', 'nav_btn_4_en', 'Profile'),
	('search', 'title_en', 'Search'),
	('search', 'title_ar', 'Search'),
	('search', 'switch_1_ar', 'Hourly Service'),
	('search', 'switch_1_en', 'Hourly Service'),
	('search', 'switch_2_en', 'Stay In Service'),
	('search', 'switch_2_ar', 'Stay In Service'),
	('search', 'heading_ar', 'Choose a Service'),
	('search', 'heading_en', 'Choose a Service'),
	('search', 'search_op1_en', 'Contract Type'),
	('search', 'search_op1_ar', 'Contract Type'),
	('search', 'search_op2_ar', 'Repeat'),
	('search', 'search_op2_en', 'Repeat'),
	('search', 'search_op3_en', 'Contract Duration'),
	('search', 'search_op3_ar', 'Contract Duration'),
	('search', 'search_op4_ar', 'Start From'),
	('search', 'search_op4_en', 'Start From'),
	('search', 'search_op5_en', 'Visits Time'),
	('search', 'search_op5_ar', 'Visits Time'),
	('search', 'search_op6_ar', 'Your Location'),
	('search', 'search_op6_en', 'Your Location'),
	('search', 'button_en', 'Search'),
	('search', 'button_ar', 'Search'),
	('search_result', 'title_ar', 'Search'),
	('search_result', 'title_en', 'Search'),
	('search_result', 'heading_ar', 'Results Found'),
	('search_result', 'heading_en', 'Results Found'),
	('filter', 'title_ar', 'Filter'),
	('filter', 'title_en', 'Filter'),
	('filter', 'heading_en', 'Filter & Sort'),
	('filter', 'heading_ar', 'Filter & Sort'),
	('filter', 'filter_op1_en', 'Sort by'),
	('filter', 'filter_op1_ar', 'Sort by'),
	('filter', 'filter_op2_ar', 'Nationality'),
	('filter', 'filter_op2_en', 'Nationality'),
	('filter', 'filter_op3_en', 'Price'),
	('filter', 'filter_op3_ar', 'Price'),
	('filter', 'filter_op4_ar', 'Rating'),
	('filter', 'filter_op4_en', 'Rating'),
	('filter', 'filter_op5_en', 'Service Providers'),
	('filter', 'filter_op5_ar', 'Service Providers'),
	('filter', 'button_ar', 'Submit'),
	('filter', 'button_en', 'Submit'),
	('offer_details', 'heading_1_en', 'Service Provider'),
	('offer_details', 'heading_1_ar', 'Service Provider'),
	('offer_details', 'heading_2_ar', 'Order Description'),
	('offer_details', 'heading_2_en', 'Order Description'),
	('offer_details', 'heading_3_en', 'Order Details'),
	('offer_details', 'heading_3_ar', 'Order Details'),
	('offer_details', 'heading_4_ar', 'Price Details'),
	('offer_details', 'heading_4_en', 'Price Details'),
	('offer_details', 'sub_total_en', 'Sub Total'),
	('offer_details', 'sub_total_ar', 'Sub Total'),
	('offer_details', 'vat_ar', 'VAT'),
	('offer_details', 'vat_en', 'VAT'),
	('offer_details', 'discount_en', 'Discount'),
	('offer_details', 'discount_ar', 'Discount'),
	('offer_details', 'total_ar', 'Order Total'),
	('offer_details', 'total_en', 'Order Total'),
	('offer_details', 'button_en', 'Order Now'),
	('offer_details', 'button_ar', 'Order Now'),
	('order_failed', 'icon', 'order_failed.png'),
	('order_failed', 'heading_ar', 'Order Failed'),
	('order_failed', 'heading_en', 'Order Failed'),
	('order_failed', 'sub_heading_en', 'Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page '),
	('order_failed', 'sub_heading_ar', 'Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page '),
	('order_failed', 'button_ar', 'Help & Support'),
	('order_failed', 'button_en', 'Help & Support'),
	('order_success', 'icon', 'order_success.png'),
	('order_success', 'heading_ar', 'Order Success'),
	('order_success', 'heading_en', 'Order Success'),
	('order_success', 'sub_heading_en', 'Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page '),
	('order_success', 'sub_heading_ar', 'Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page Order Success Page '),
	('order_success', 'button_ar', 'Home Page'),
	('order_success', 'button_en', 'Home Page');
/*!40000 ALTER TABLE `mobile_strings` ENABLE KEYS */;

-- Dumping structure for table sanad.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.model_has_permissions: 0 rows
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table sanad.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.model_has_roles: 2 rows
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 39);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table sanad.nationalities
CREATE TABLE IF NOT EXISTS `nationalities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.nationalities: ~6 rows (approximately)
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;
INSERT INTO `nationalities` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Pakistani', '2022-02-01 17:53:29', NULL, NULL),
	(2, 'Indian', NULL, NULL, NULL),
	(3, 'Bangladeshi', NULL, NULL, NULL),
	(4, 'Pilipinas', NULL, NULL, NULL),
	(5, 'French', NULL, NULL, NULL),
	(6, 'American', NULL, NULL, NULL);
/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;

-- Dumping structure for table sanad.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `from_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `body` text,
  `object` text,
  `seen` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table sanad.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_address_id` int(11) DEFAULT NULL,
  `user_pm_id` int(11) DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.orders: 1 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_address_id`, `user_pm_id`, `total_items`, `total_amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 424964, 39, 6, 1, NULL, 50, 'COMPLETED', '2022-02-07', '2022-02-07', NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sanad.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `se_id` int(11) DEFAULT NULL,
  `total_amount` double(22,0) DEFAULT NULL,
  `item_object` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.order_items: 1 rows
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`id`, `order_id`, `company_id`, `service_id`, `se_id`, `total_amount`, `item_object`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 16, 5, 20, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Dumping structure for table sanad.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.order_status: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`id`, `order_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'pending', NULL, NULL, NULL);
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Dumping structure for table sanad.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.password_resets: 0 rows
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sanad.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `card_holder_name` varchar(191) DEFAULT NULL,
  `card_number` varchar(191) DEFAULT NULL,
  `cvv` varchar(191) DEFAULT NULL,
  `expiry_date` varchar(191) DEFAULT NULL,
  `default` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.payment_methods: ~1 rows (approximately)
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id`, `user_id`, `type`, `card_holder_name`, `card_number`, `cvv`, `expiry_date`, `default`, `created_at`, `updated_at`) VALUES
	(1, 39, 'master', 'M Adnan', '4242 4242 4242 4242', '222', '08/22', NULL, '2022-01-24 10:47:14', '2022-01-24 10:47:14');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;

-- Dumping structure for table sanad.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.permissions: 0 rows
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table sanad.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.personal_access_tokens: 15 rows
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(51, 'App\\Models\\User', 39, 'API Token', 'ab39875fa073eb1c5973db75207e1aea5b7cec9a0dc4c686f5c26bf21d4c1611', '["*"]', NULL, '2022-01-18 12:12:16', '2022-01-18 12:12:16'),
	(50, 'App\\Models\\User', 39, 'API Token', 'ef8eb7b1c82df968f2edefd72c186fdbf3d4248fa539f5da6b3e91593afcad4b', '["*"]', NULL, '2022-01-17 15:26:38', '2022-01-17 15:26:38'),
	(52, 'App\\Models\\User', 39, 'API Token', '020236a668ad7f58f6f4b208ae9d1c2288cb839adc52758a1b4698dd7efa09eb', '["*"]', '2022-01-18 12:46:24', '2022-01-18 12:28:31', '2022-01-18 12:46:24'),
	(53, 'App\\Models\\User', 39, 'API Token', 'e0d45cd1afd0a3dd77b73c59b174ffc2cc9698448f74bec43ba36ad7588c1501', '["*"]', '2022-01-19 08:06:35', '2022-01-19 07:23:37', '2022-01-19 08:06:35'),
	(54, 'App\\Models\\User', 39, 'API Token', 'c1ecabc4829bd321076f79157096a58b3486c772735a0be10ae496b40afc4331', '["*"]', '2022-01-24 07:37:46', '2022-01-24 07:04:58', '2022-01-24 07:37:46'),
	(55, 'App\\Models\\User', 39, 'API Token', '91372db50d5be892be96140ffd3d9da607eccef1a4aad10ebfd6de8ffc0fdef6', '["*"]', '2022-01-24 10:49:04', '2022-01-24 10:44:40', '2022-01-24 10:49:04'),
	(56, 'App\\Models\\User', 39, 'API Token', 'd5bc72b4f88dae0e35b7e4df5bc4622ecdc01c2e1a9e8c7151c118bf897991aa', '["*"]', '2022-01-25 09:06:35', '2022-01-25 08:42:34', '2022-01-25 09:06:35'),
	(57, 'App\\Models\\User', 39, 'API Token', '9ff5a03db709b297be7f5f231515160f3ea65764835651c6d50d40d87f7b6ec6', '["*"]', '2022-02-07 11:02:43', '2022-02-07 07:30:03', '2022-02-07 11:02:43'),
	(58, 'App\\Models\\User', 39, 'API Token', 'a4fdfd0e30e4f611a665a27fe4542da5dd5c98fd8ecb0e694e2af2e7f5d013cc', '["*"]', '2022-02-15 06:54:38', '2022-02-15 06:50:54', '2022-02-15 06:54:38'),
	(59, 'App\\Models\\User', 39, 'API Token', '0762cca75c77814d95710623953bb8f538197a0cad5ce6ff868b296f0618be71', '["*"]', NULL, '2022-03-23 10:48:29', '2022-03-23 10:48:29'),
	(60, 'App\\Models\\User', 39, 'API Token', 'b1fb7cb758e4a259d32349161bfda3f67836570d0be7bd93a35caaeb637fd64f', '["*"]', '2022-03-23 11:28:48', '2022-03-23 10:54:40', '2022-03-23 11:28:48'),
	(61, 'App\\Models\\User', 39, 'API Token', 'e9f1e28aa936b13c980621bd98764c24395cebe51f6fe0c511d4b2d1d32cbcb5', '["*"]', '2022-03-28 06:00:47', '2022-03-28 06:00:36', '2022-03-28 06:00:47'),
	(62, 'App\\Models\\User', 39, 'API Token', 'f3c5639e095fad09a755c81e2263790d9693fc4964da35a103dafc3083674b17', '["*"]', '2022-03-28 12:20:10', '2022-03-28 12:16:15', '2022-03-28 12:20:10'),
	(63, 'App\\Models\\User', 39, 'API Token', '4e4d8d45451179a47d47563ae989968ed13f133857c403761ed011abd1dfb087', '["*"]', '2022-03-29 07:30:18', '2022-03-29 07:30:11', '2022-03-29 07:30:18'),
	(64, 'App\\Models\\User', 39, 'API Token', 'cfb74010a22acdf4a971d0bb55fd360c49059f73c4b0187b659a5ba9c913a940', '["*"]', '2022-03-31 07:51:49', '2022-03-31 07:44:22', '2022-03-31 07:51:49');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table sanad.rating
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `services_rating` int(11) DEFAULT NULL,
  `company_rating` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.rating: 1 rows
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` (`id`, `order_id`, `company_id`, `services_rating`, `company_rating`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1011, 16, 5, 4, 'best service', NULL, NULL, NULL);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;

-- Dumping structure for table sanad.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', NULL, NULL),
	(2, 'endUser', 'web', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table sanad.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.role_has_permissions: 0 rows
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table sanad.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.services: ~6 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Housemaid', NULL, NULL, NULL),
	(2, 'Driver', NULL, NULL, NULL),
	(3, 'Guard', NULL, NULL, NULL),
	(4, 'Gardener', NULL, NULL, NULL),
	(5, 'Sweeper', NULL, NULL, NULL),
	(6, 'Assistant', NULL, NULL, NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table sanad.service_employees
CREATE TABLE IF NOT EXISTS `service_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ce_id` int(11) DEFAULT NULL,
  `cs_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.service_employees: 8 rows
/*!40000 ALTER TABLE `service_employees` DISABLE KEYS */;
INSERT INTO `service_employees` (`id`, `ce_id`, `cs_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(15, 14, 2, '2022-02-01 14:08:05', '2022-02-01 14:08:05', NULL),
	(17, 16, 2, '2022-02-03 12:49:15', '2022-02-03 12:49:15', NULL),
	(18, 14, 3, '2022-02-03 13:24:08', '2022-02-03 13:24:08', NULL),
	(19, 16, 4, '2022-02-07 06:09:52', '2022-02-07 06:09:52', NULL),
	(22, 16, 5, '2022-02-17 11:02:55', '2022-02-17 11:02:55', NULL),
	(21, 17, 6, '2022-02-17 11:01:49', '2022-02-17 11:01:49', NULL),
	(23, 18, 7, '2022-02-17 12:58:43', '2022-02-17 12:58:43', NULL),
	(24, 16, 8, '2022-03-07 14:06:12', '2022-03-07 14:06:12', NULL);
/*!40000 ALTER TABLE `service_employees` ENABLE KEYS */;

-- Dumping structure for table sanad.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.subscriptions: 0 rows
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;

-- Dumping structure for table sanad.subscription_items
CREATE TABLE IF NOT EXISTS `subscription_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned NOT NULL,
  `stripe_id` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(141) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  KEY `subscription_items_stripe_id_index` (`stripe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.subscription_items: 0 rows
/*!40000 ALTER TABLE `subscription_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_items` ENABLE KEYS */;

-- Dumping structure for table sanad.terms_condition
CREATE TABLE IF NOT EXISTS `terms_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.terms_condition: 2 rows
/*!40000 ALTER TABLE `terms_condition` DISABLE KEYS */;
INSERT INTO `terms_condition` (`id`, `type`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'about_us', 'about_us', '<h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Introduction</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Terms and Conditions (“</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Terms</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">”) describe how</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">&nbsp;Syarte LLC (“Company,” “we,” and “our”)</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"> regulates your use of this website (the “</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Website</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">”). Please read the following information carefully to understand our practices regarding your use of the website. The Company may change the Terms at any time. The Company may inform you of the changes to the Terms using the available means of communication. The Company recommends you to check the website frequently to see the actual version of the Terms and their previous versions.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If you represent a legal entity, you certify that you are entitled by such a legal entity to conclude the Terms as the legal entity you represent.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Privacy Policy</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Our Privacy Policy is available on a separate page. Our Privacy Policy explains to you how we process information about you. You shall understand that through your use of the website you acknowledge the processing of this information shall be undertaken in accordance with the Privacy Policy.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Your Account</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">When using the website, you shall be responsible for ensuring the confidentiality of your account, password and other credentials and for secure access to your device. You shall not assign your account to anyone. The Company is not responsible for unauthorized access to your account that results from misappropriation or theft of your account. The Company may refuse or cancel service, terminate your account, and remove or edit content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company does not knowingly collect personal data from persons under the age of 16 (sixteen). If you are under 16 (sixteen) years old, you may not use the website and may not enter into the Terms under any circumstances.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Services</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The website allows you to use Services available on the website. You shall not use the services for the illegal aims.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We may, at our sole discretion, set fees for using the website for you. All prices are published separately on relevant pages on the website. We may, at our sole discretion, at any time change any fees.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We may use certified payment systems, which also may have their commissions. Such commissions may be implied on you when you choose a particular payment system. Detailed information about commissions of such payment systems may be found on their websites.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Third-Party Services</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The website may include links to other websites, applications, and platforms (hereinafter the "</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Linked Sites</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">").</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company does not control the Linked Sites, and shall not be responsible for the content and other materials of the Linked Sites. The Company makes these links available to you for providing the functionality or services on the website.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Prohibited Uses and Intellectual Property</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company grants you a non-transferable, non-exclusive, revocable license to access and use the website from one device in accordance with the Terms. You shall not use the website for unlawful or prohibited purposes. You may not use the website in a way that may disable, damage, or interfere in the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">All content present on the website includes text, code, graphics, logos, images, compilation, software used on the website (hereinafter and hereinbefore the "</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Content</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">"). The Content is the property of the Company or its contractors and protected by intellectual property laws that protect such rights. You agree to use all copyright and other proprietary notices or restrictions contained in the Content and you are prohibited from changing the Content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">You may not publish, transmit, modify, reverse engineer, participate in the transfer, or create and sell derivative works, or in any way use any of the Content. Your enjoyment of the website shall not entitle you to make any illegal and disallowed use of the Content, and in particular you shall not change proprietary rights or notices in the Content. You shall use the Content only for your personal and non-commercial use. The Company does not grant you any licenses to the intellectual property of the Company.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company Materials</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">By posting, uploading, inputting, providing or submitting your Content you are granting the Company to use your Content in connection with the operation of Company\'s business including, but not limited to, the rights to transmit, publicly display, distribute, publicly perform, copy, reproduce, and translate your Content; and to publish your name in connection with your Content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">No compensation shall be paid with regard to the use of your Content. The Company shall have no obligation to publish or enjoy any Content you may send us and may remove your Content at any time.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">By posting, uploading, inputting, providing or submitting your Content you warrant and represent that you own all of the rights to your Content.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Disclaimer of Certain Liabilities</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The information available via the website may include typographical errors or inaccuracies. The Company shall not be liable for these inaccuracies and errors.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company makes no representations about the availability, accuracy, reliability, suitability, and timeliness of the Content contained on and services available on the website. To the maximum extent allowed by the applicable law, all such Content and services are provided on the "as is" basis. The Company disclaims all warranties and conditions regarding this Content and services, including warranties and provisions of merchantability, fitness for a certain purpose.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">To the maximum extent permitted by the applicable law, in no event shall the Company be liable for any direct, indirect, incidental, consequential, special, punitive damages including, but not limited to, damages for loss of enjoyment, data or profits, in the connection with the enjoyment or execution of the website in the context of the inability or delay to enjoy the website or its services, or for any Content of the website, or otherwise arising out of the enjoyment of the website, based on contract and non-contract liability or other reason.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If the exclusion or limitation of liability for damages, whether consequential or incidental, are prohibited in a particular case, the exclusion or limitation of liability shall not apply to you.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Indemnification</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">You agree to indemnify, defend and hold harmless the Company, its managers, directors, employees, agents, and third parties, for any costs, losses, expenses (including attorneys\' fees), liabilities regarding or arising out of your enjoyment of or inability to enjoy the website or its services and Company’s services and products, your violation of the Terms or your violation of any rights of third parties, or your violation of the applicable law. The Company may assume the exclusive defense and you shall cooperate with the Company in asserting any available defenses.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Termination and Access Restriction</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company may terminate your access and account to the website and its related services or any part at any time, without notice, in case of your violation of the Terms.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Miscellaneous</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The governing law of the Terms shall be the substantive laws of the country where the Company is set up, except the conflict of laws rules. You shall not use the website in jurisdictions that do not give effect to all provisions of the Terms.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">No joint venture, partnership, employment, or agency relationship shall be implied between you and the Company as a result of the Terms or use of the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Nothing in the Terms shall be a derogation of the Company\'s right to comply with governmental, court, police, and law enforcement requests or requirements regarding your enjoyment of the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If any part of the Terms is determined to be void or unenforceable in accordance with applicable law then the void or unenforceable clauses will be deemed superseded by valid and enforceable clauses shall be similar to the original version of the Terms and other parts and sections of the Terms shall be applicable to you and the Company.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Terms constitute the entire agreement between you and the Company regarding the enjoyment of the website and the Terms supersede all prior or communications and offers, whether electronic, oral or written, between you and the Company.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company and its affiliates shall not be liable for a failure or delay to fulfill its obligations where the failure or delay results from any cause beyond Company\'s reasonable control, including technical failures, natural disasters, blockages, embargoes, riots, acts, regulation, legislation, or orders of government, terroristic acts, war, or any other force outside of Company\'s control.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">In case of controversies, demands, claims, disputes, or causes of action between the Company and you relating to the website or other related issues, or the Terms, you and the Company agree to attempt to resolve such controversies, demands, claims, disputes, or causes of action by good faith negotiation, and in case of failure of such negotiation, exclusively through the courts of the country where the Company is set up.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Complaints</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We are committed to resolve any complaints about our collection or use of your personal data. If you would like to make a complaint regarding this Terms or our practices in relation to your personal data, please contact us through our website. We will reply to your complaint as soon as we can and in any event, within 30 days. We hope to resolve any complaint brought to our attention, however if you feel that your complaint has not been adequately resolved, you reserve the right to contact your local data protection supervisory authority.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Contact Information</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We welcome your comments or questions about our Terms. You may contact us through the contact information available on our website.</span></p>', '2021-12-21 08:31:45', '2021-12-21 08:38:10', NULL),
	(2, 'terms_and_condition', 'Terms & Conditions', '<h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Introduction</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Terms and Conditions (“</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Terms</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">”) describe how</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">&nbsp;Syarte LLC (“Company,” “we,” and “our”)</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;"> regulates your use of this website (the “</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Website</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">”). Please read the following information carefully to understand our practices regarding your use of the website. The Company may change the Terms at any time. The Company may inform you of the changes to the Terms using the available means of communication. The Company recommends you to check the website frequently to see the actual version of the Terms and their previous versions.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If you represent a legal entity, you certify that you are entitled by such a legal entity to conclude the Terms as the legal entity you represent.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Privacy Policy</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Our Privacy Policy is available on a separate page. Our Privacy Policy explains to you how we process information about you. You shall understand that through your use of the website you acknowledge the processing of this information shall be undertaken in accordance with the Privacy Policy.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Your Account</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">When using the website, you shall be responsible for ensuring the confidentiality of your account, password and other credentials and for secure access to your device. You shall not assign your account to anyone. The Company is not responsible for unauthorized access to your account that results from misappropriation or theft of your account. The Company may refuse or cancel service, terminate your account, and remove or edit content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company does not knowingly collect personal data from persons under the age of 16 (sixteen). If you are under 16 (sixteen) years old, you may not use the website and may not enter into the Terms under any circumstances.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Services</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The website allows you to use Services available on the website. You shall not use the services for the illegal aims.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We may, at our sole discretion, set fees for using the website for you. All prices are published separately on relevant pages on the website. We may, at our sole discretion, at any time change any fees.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We may use certified payment systems, which also may have their commissions. Such commissions may be implied on you when you choose a particular payment system. Detailed information about commissions of such payment systems may be found on their websites.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Third-Party Services</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The website may include links to other websites, applications, and platforms (hereinafter the "</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Linked Sites</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">").</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company does not control the Linked Sites, and shall not be responsible for the content and other materials of the Linked Sites. The Company makes these links available to you for providing the functionality or services on the website.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Prohibited Uses and Intellectual Property</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company grants you a non-transferable, non-exclusive, revocable license to access and use the website from one device in accordance with the Terms. You shall not use the website for unlawful or prohibited purposes. You may not use the website in a way that may disable, damage, or interfere in the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">All content present on the website includes text, code, graphics, logos, images, compilation, software used on the website (hereinafter and hereinbefore the "</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Content</span><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">"). The Content is the property of the Company or its contractors and protected by intellectual property laws that protect such rights. You agree to use all copyright and other proprietary notices or restrictions contained in the Content and you are prohibited from changing the Content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">You may not publish, transmit, modify, reverse engineer, participate in the transfer, or create and sell derivative works, or in any way use any of the Content. Your enjoyment of the website shall not entitle you to make any illegal and disallowed use of the Content, and in particular you shall not change proprietary rights or notices in the Content. You shall use the Content only for your personal and non-commercial use. The Company does not grant you any licenses to the intellectual property of the Company.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company Materials</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">By posting, uploading, inputting, providing or submitting your Content you are granting the Company to use your Content in connection with the operation of Company\'s business including, but not limited to, the rights to transmit, publicly display, distribute, publicly perform, copy, reproduce, and translate your Content; and to publish your name in connection with your Content.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">No compensation shall be paid with regard to the use of your Content. The Company shall have no obligation to publish or enjoy any Content you may send us and may remove your Content at any time.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">By posting, uploading, inputting, providing or submitting your Content you warrant and represent that you own all of the rights to your Content.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Disclaimer of Certain Liabilities</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The information available via the website may include typographical errors or inaccuracies. The Company shall not be liable for these inaccuracies and errors.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company makes no representations about the availability, accuracy, reliability, suitability, and timeliness of the Content contained on and services available on the website. To the maximum extent allowed by the applicable law, all such Content and services are provided on the "as is" basis. The Company disclaims all warranties and conditions regarding this Content and services, including warranties and provisions of merchantability, fitness for a certain purpose.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">To the maximum extent permitted by the applicable law, in no event shall the Company be liable for any direct, indirect, incidental, consequential, special, punitive damages including, but not limited to, damages for loss of enjoyment, data or profits, in the connection with the enjoyment or execution of the website in the context of the inability or delay to enjoy the website or its services, or for any Content of the website, or otherwise arising out of the enjoyment of the website, based on contract and non-contract liability or other reason.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If the exclusion or limitation of liability for damages, whether consequential or incidental, are prohibited in a particular case, the exclusion or limitation of liability shall not apply to you.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Indemnification</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">You agree to indemnify, defend and hold harmless the Company, its managers, directors, employees, agents, and third parties, for any costs, losses, expenses (including attorneys\' fees), liabilities regarding or arising out of your enjoyment of or inability to enjoy the website or its services and Company’s services and products, your violation of the Terms or your violation of any rights of third parties, or your violation of the applicable law. The Company may assume the exclusive defense and you shall cooperate with the Company in asserting any available defenses.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Termination and Access Restriction</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company may terminate your access and account to the website and its related services or any part at any time, without notice, in case of your violation of the Terms.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Miscellaneous</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The governing law of the Terms shall be the substantive laws of the country where the Company is set up, except the conflict of laws rules. You shall not use the website in jurisdictions that do not give effect to all provisions of the Terms.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">No joint venture, partnership, employment, or agency relationship shall be implied between you and the Company as a result of the Terms or use of the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Nothing in the Terms shall be a derogation of the Company\'s right to comply with governmental, court, police, and law enforcement requests or requirements regarding your enjoyment of the website.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">If any part of the Terms is determined to be void or unenforceable in accordance with applicable law then the void or unenforceable clauses will be deemed superseded by valid and enforceable clauses shall be similar to the original version of the Terms and other parts and sections of the Terms shall be applicable to you and the Company.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Terms constitute the entire agreement between you and the Company regarding the enjoyment of the website and the Terms supersede all prior or communications and offers, whether electronic, oral or written, between you and the Company.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">The Company and its affiliates shall not be liable for a failure or delay to fulfill its obligations where the failure or delay results from any cause beyond Company\'s reasonable control, including technical failures, natural disasters, blockages, embargoes, riots, acts, regulation, legislation, or orders of government, terroristic acts, war, or any other force outside of Company\'s control.</span></p><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">In case of controversies, demands, claims, disputes, or causes of action between the Company and you relating to the website or other related issues, or the Terms, you and the Company agree to attempt to resolve such controversies, demands, claims, disputes, or causes of action by good faith negotiation, and in case of failure of such negotiation, exclusively through the courts of the country where the Company is set up.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Complaints</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We are committed to resolve any complaints about our collection or use of your personal data. If you would like to make a complaint regarding this Terms or our practices in relation to your personal data, please contact us through our website. We will reply to your complaint as soon as we can and in any event, within 30 days. We hope to resolve any complaint brought to our attention, however if you feel that your complaint has not been adequately resolved, you reserve the right to contact your local data protection supervisory authority.</span></p><h3 dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; text-align: justify;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Contact Information</span></h3><p dir="ltr" style="margin-top: 14pt; margin-bottom: 14pt; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify; line-height: 1.2;"><span style="font-size: 13.5pt; font-family: &quot;Segoe UI Symbol&quot;; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">We welcome your comments or questions about our Terms. You may contact us through the contact information available on our website.</span></p>', '2021-12-21 08:31:45', '2021-12-21 08:38:10', NULL);
/*!40000 ALTER TABLE `terms_condition` ENABLE KEYS */;

-- Dumping structure for table sanad.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expiry` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verified_at` datetime DEFAULT NULL,
  `provider` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(141) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_notification` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sanad.users: 6 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `phone`, `email`, `date_of_birth`, `city`, `gender`, `email_verified_at`, `password`, `profile_image`, `lang`, `nationality`, `otp`, `otp_expiry`, `otp_verified_at`, `provider`, `provider_id`, `allow_notification`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'super', 'admin', NULL, 'admin@sanad.com', NULL, NULL, NULL, '2022-01-19 17:06:37', '$2y$10$brDgTkVs98inl2Q8l.iR/O.4Dl55CxyBbZRkhFV/LTayNd1/IGpOC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '2021-06-23 08:25:44'),
	(39, NULL, 'new', 'customer', '+923365063942', 'test11@test.com', '12-10-2011', '12212333213', 'male', NULL, NULL, '-2022-01-17-61e588a5d9cd2.jpg', NULL, NULL, '268490', '2022-03-31 07:49:15', '2022-03-31 07:44:21', '', NULL, '1', NULL, '2022-01-17 14:38:57', '2022-03-31 07:44:21'),
	(40, NULL, 'Henry changed', 'Buchanan', '+1 (825) 834-6784', 'tidiboq@mailinator.com', '31-Aug-2003', NULL, 'female', NULL, NULL, '-2022-02-01-61f9371d4669b.png', 'english', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-02-01 13:35:25', '2022-02-03 10:40:58'),
	(42, NULL, 'Sonya', 'Payne', '+1 (123) 823-8306', 'sujytibof@mailinator.com', '06-Jun-1986', NULL, 'female', NULL, NULL, '-2022-02-03-61fbcf0f3a0f5.jpg', 'french', '6', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-02-03 12:48:15', '2022-02-03 12:48:15'),
	(43, NULL, 'Dieter', 'Savage', '+1 (763) 169-6454', 'fucekuved@mailinator.com', '08-Sep-2006', NULL, 'male', NULL, NULL, '-2022-02-17-620e2b008c782.jpg', 'french', '5', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-02-17 11:01:20', '2022-02-17 11:01:20'),
	(44, NULL, 'Thomas', 'Dickson', '+1 (179) 373-8349', 'lurev@mailinator.com', '27-Aug-1983', NULL, 'male', NULL, NULL, '-2022-02-17-620e45a8d671d.jpg', 'french', '3', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2022-02-17 12:55:04', '2022-02-17 12:55:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table sanad.user_devices
CREATE TABLE IF NOT EXISTS `user_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(191) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sanad.user_devices: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_devices` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
