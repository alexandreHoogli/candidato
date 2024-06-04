-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2024 at 05:24 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixelpagesv3_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ar_form_data`
--

CREATE TABLE `ar_form_data` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `campaign_id` int NOT NULL,
  `form_type` int NOT NULL COMMENT '1 = subscription, 2 = contact form',
  `user_email` varchar(255) NOT NULL,
  `all_details` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autoresponder`
--

CREATE TABLE `autoresponder` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `mkey` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `short_code`, `name`, `symbol`) VALUES
(1, 'USD', 'United States Dollars', ''),
(2, 'EUR', 'Euro', ''),
(3, 'GBP', 'United Kingdom Pounds', ''),
(4, 'DZD', 'Algeria Dinars', ''),
(5, 'ARP', 'Argentina Pesos', ''),
(6, 'AUD', 'Australia Dollars', ''),
(7, 'ATS', 'Austria Schillings', ''),
(8, 'BSD', 'Bahamas Dollars', ''),
(9, 'BBD', 'Barbados Dollars', ''),
(10, 'BEF', 'Belgium Francs', ''),
(11, 'BMD', 'Bermuda Dollars', ''),
(12, 'BRR', 'Brazil Real', ''),
(13, 'BGL', 'Bulgaria Lev', ''),
(14, 'CAD', 'Canada Dollars', ''),
(15, 'CLP', 'Chile Pesos', ''),
(16, 'CNY', 'China Yuan Renmimbi', ''),
(17, 'CYP', 'Cyprus Pounds', ''),
(18, 'CSK', 'Czech Republic Koruna', ''),
(19, 'DKK', 'Denmark Kroner', ''),
(20, 'NLG', 'Netherlands Guilders', ''),
(21, 'XCD', 'Eastern Caribbean Dollars', ''),
(22, 'EGP', 'Egypt Pounds', ''),
(23, 'FJD', 'Fiji Dollars', ''),
(24, 'FIM', 'Finland Markka', ''),
(25, 'FRF', 'France Francs', ''),
(26, 'DEM', 'Germany Deutsche Marks', ''),
(27, 'XAU', 'Gold Ounces', ''),
(28, 'GRD', 'Greece Drachmas', ''),
(29, 'HKD', 'Hong Kong Dollars', ''),
(30, 'HUF', 'Hungary Forint', ''),
(31, 'ISK', 'Iceland Krona', ''),
(32, 'INR', 'India Rupees', ''),
(33, 'IDR', 'Indonesia Rupiah', ''),
(34, 'IEP', 'Ireland Punt', ''),
(35, 'ILS', 'Israel New Shekels', ''),
(36, 'ITL', 'Italy Lira', ''),
(37, 'JMD', 'Jamaica Dollars', ''),
(38, 'JPY', 'Japan Yen', ''),
(39, 'JOD', 'Jordan Dinar', ''),
(40, 'KRW', 'South Korea Won', ''),
(41, 'LBP', 'Lebanon Pounds', ''),
(42, 'LUF', 'Luxembourg Francs', ''),
(43, 'MYR', 'Malaysia Ringgit', ''),
(44, 'MXP', 'Mexico Pesos', ''),
(45, 'NLG', 'Netherlands Guilders', ''),
(46, 'NZD', 'New Zealand Dollars', ''),
(47, 'NOK', 'Norway Kroner', ''),
(48, 'PKR', 'Pakistan Rupees', ''),
(49, 'XPD', 'Palladium Ounces', ''),
(50, 'PHP', 'Philippines Pesos', ''),
(51, 'XPT', 'Platinum Ounces', ''),
(52, 'PLZ', 'Poland Zloty', ''),
(53, 'PTE', 'Portugal Escudo', ''),
(54, 'ROL', 'Romania Leu', ''),
(55, 'RUR', 'Russia Rubles', ''),
(56, 'SAR', 'Saudi Arabia Riyal', ''),
(57, 'XAG', 'Silver Ounces', ''),
(58, 'SGD', 'Singapore Dollars', ''),
(59, 'SKK', 'Slovakia Koruna', ''),
(60, 'ZAR', 'South Africa Rand', ''),
(61, 'KRW', 'South Korea Won', ''),
(62, 'ESP', 'Spain Pesetas', ''),
(63, 'XDR', 'Special Drawing Right (IMF),', ''),
(64, 'SDD', 'Sudan Dinar', ''),
(65, 'SEK', 'Sweden Krona', ''),
(66, 'CHF', 'Switzerland Francs', ''),
(67, 'TWD', 'Taiwan Dollars', ''),
(68, 'THB', 'Thailand Baht', ''),
(69, 'TTD', 'Trinidad and Tobago Dollars', ''),
(70, 'TRL', 'Turkey Lira', ''),
(71, 'VEB', 'Venezuela Bolivar', ''),
(72, 'ZMK', 'Zambia Kwacha', ''),
(73, 'EUR', 'Euro', ''),
(74, 'XCD', 'Eastern Caribbean Dollars', ''),
(75, 'XDR', 'Special Drawing Right (IMF),', ''),
(76, 'XAG', 'Silver Ounces', ''),
(77, 'XAU', 'Gold Ounces', ''),
(78, 'XPD', 'Palladium Ounces', ''),
(79, 'XPT', 'Platinum Ounces', '');

-- --------------------------------------------------------

--
-- Table structure for table `dfy_templates`
--

CREATE TABLE `dfy_templates` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `zip_path` text NOT NULL,
  `zip_name` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `thumbnail_path` text NOT NULL,
  `is_downloadable` int NOT NULL COMMENT '0 = no, 1 = yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dfy_templates`
--

INSERT INTO `dfy_templates` (`id`, `user_id`, `template_name`, `zip_path`, `zip_name`, `date_created`, `date_updated`, `thumbnail_path`, `is_downloadable`) VALUES
(7, 8, 'Crypto Currency', 'uploads/template_zips/extracted_zip/1698499303_Crypto Currency/crypto-currency', 'crypto-currency.zip', '2023-08-10 10:21:50', '2023-12-29 17:04:21', 'uploads/template_zips/template_thumnails/1693304547_thumbnail_7.jpg', 0),
(16, 7, 'Writer', 'uploads/template_zips/extracted_zip/1698388802_Writer/Writer', 'Writer.zip', '2023-08-11 09:54:18', '2023-10-27 06:40:02', 'uploads/template_zips/template_thumnails/1693292304_thumbnail_16.jpg', 0),
(22, 9, 'Game', 'uploads/template_zips/extracted_zip/1698328611_Game/game', 'game.zip', '2023-08-12 04:58:54', '2023-10-26 13:56:52', 'uploads/template_zips/template_thumnails/1695978445_thumbnail_22.jpg', 0),
(29, 10, 'Consulting', 'uploads/template_zips/extracted_zip/1698395536_Consulting/Consulting_html', 'Consulting_html.zip', '2023-08-12 11:29:22', '2023-10-27 14:02:16', 'uploads/template_zips/template_thumnails/1696480607_thumbnail_29.png', 0),
(30, 10, 'Eco-recycling', 'uploads/template_zips/extracted_zip/1699436165_Eco-recycling/Eco-Recycling-html', 'Eco-Recycling-html.zip', '2023-08-12 11:29:45', '2023-11-08 09:36:05', 'uploads/template_zips/template_thumnails/1696481093_thumbnail_30.png', 0),
(34, 8, 'SEO', 'uploads/template_zips/extracted_zip/1698499555_SEO/seo_html', 'seo_html.zip', '2023-08-14 06:43:56', '2023-10-28 18:55:55', 'uploads/template_zips/template_thumnails/1693304566_thumbnail_34.jpg', 0),
(35, 7, 'supportDesk', 'uploads/template_zips/extracted_zip/1698397050_supportDesk/SupportDesk', 'SupportDesk.zip', '2023-08-14 07:21:11', '2023-10-27 14:27:30', 'uploads/template_zips/template_thumnails/1693292175_thumbnail_35.jpg', 0),
(36, 10, 'Auto-Insurance', 'uploads/template_zips/extracted_zip/1699437162_Auto-Insurance/auto-insurance', 'auto-insurance.zip', '2023-08-14 10:02:43', '2023-11-08 09:52:42', 'uploads/template_zips/template_thumnails/1696481112_thumbnail_36.png', 0),
(39, 11, 'Affiliate Marketing', 'uploads/template_zips/extracted_zip/1698389245_Affiliate Marketing/affiliate-marketing', 'affiliate-marketing.zip', '2023-08-14 11:07:03', '2023-10-27 06:47:26', 'uploads/template_zips/template_thumnails/1693291612_thumbnail_39.jpg', 0),
(40, 11, 'App Landing', 'uploads/template_zips/extracted_zip/1698398587_App Landing/app-landing', 'app-landing.zip', '2023-08-14 11:07:33', '2023-10-27 14:53:07', 'uploads/template_zips/template_thumnails/1693291954_thumbnail_40.jpg', 0),
(45, 10, 'Laundry-Service', 'uploads/template_zips/extracted_zip/1698655344_Laundry-Service/laundry', 'laundry.zip', '2023-08-16 06:47:39', '2023-10-30 14:12:24', 'uploads/template_zips/template_thumnails/1696481600_thumbnail_45.png', 0),
(49, 11, 'Freelancer', 'uploads/template_zips/extracted_zip/1695303193_Freelancer/freelancer', 'freelancer.zip', '2023-08-16 07:08:52', '2023-09-21 13:33:13', 'uploads/template_zips/template_thumnails/1695303193_thumbnail_49.png', 0),
(50, 8, 'Kids School', 'uploads/template_zips/extracted_zip/1698669413_Kids School/kids_school', 'kids_school.zip', '2023-08-16 09:56:22', '2023-10-30 18:06:53', 'uploads/template_zips/template_thumnails/1693304580_thumbnail_50.jpg', 0),
(59, 10, 'Transport', 'uploads/template_zips/extracted_zip/1698656409_Transport/Transport', 'Transport.zip', '2023-08-17 12:05:04', '2023-10-30 14:30:09', 'uploads/template_zips/template_thumnails/1696857635_thumbnail_59.png', 0),
(60, 9, 'Musician', 'uploads/template_zips/extracted_zip/1698325366_Musician/musician', 'musician.zip', '2023-08-17 12:11:58', '2023-10-26 13:02:46', 'uploads/template_zips/template_thumnails/1695983721_thumbnail_60.jpg', 0),
(63, 11, 'VR Studio', 'uploads/template_zips/extracted_zip/1698403756_VR Studio/vr-studio', 'vr-studio.zip', '2023-08-17 13:21:03', '2023-10-27 16:19:16', 'uploads/template_zips/template_thumnails/1693292448_thumbnail_63.jpg', 0),
(64, 9, 'Lock Smith', 'uploads/template_zips/extracted_zip/1696316498_Lock Smith/Lock Smith', 'Lock_Smith.zip', '2023-08-18 09:45:16', '2023-10-03 07:01:38', 'uploads/template_zips/template_thumnails/1696308137_thumbnail_64.jpg', 0),
(65, 1, 'astrology', 'uploads/template_zips/extracted_zip/1699426692_astrology/astrologer', 'astrologer.zip', '2023-08-22 06:41:52', '2023-11-08 06:58:12', 'uploads/template_zips/template_thumnails/1696497452_thumbnail_65.jpg', 0),
(66, 9, 'Yoga', 'uploads/template_zips/extracted_zip/1698326228_Yoga/yoga', 'yoga.zip', '2023-08-23 06:20:07', '2023-10-26 13:17:08', 'uploads/template_zips/template_thumnails/1695986527_thumbnail_66.jpg', 0),
(67, 7, 'IT Services', 'uploads/template_zips/extracted_zip/1698400944_IT Services/IT Services', 'IT_Services.zip', '2023-08-23 12:13:46', '2023-10-27 15:32:24', 'uploads/template_zips/template_thumnails/1693292056_thumbnail_67.jpg', 0),
(68, 10, 'Insurance', 'uploads/template_zips/extracted_zip/1699437705_Insurance/insurance', 'insurance.zip', '2023-08-24 09:25:10', '2023-11-08 10:01:45', 'uploads/template_zips/template_thumnails/1696857805_thumbnail_68.png', 0),
(69, 11, 'Business Plan', 'uploads/template_zips/extracted_zip/1692877462_Business Plan/business-plan', 'business-plan.zip', '2023-08-24 11:03:58', '2023-08-29 06:53:46', 'uploads/template_zips/template_thumnails/1693292026_thumbnail_69.jpg', 0),
(71, 11, 'Technical Support', 'uploads/template_zips/extracted_zip/1695304286_Technical Support/technical-support', 'technical-support.zip', '2023-08-25 12:44:43', '2023-09-21 13:51:26', 'uploads/template_zips/template_thumnails/1693292359_thumbnail_71.jpg', 0),
(72, 12, 'pizza-shop', 'uploads/template_zips/extracted_zip/1699427068_pizza-shop/pizza-shop-DONE', 'pizza-shop-DONE.zip', '2023-08-26 05:17:20', '2023-11-08 07:04:28', 'uploads/template_zips/template_thumnails/1699427068_thumbnail_72.png', 0),
(73, 7, 'Bakery', 'uploads/template_zips/extracted_zip/1698403838_Bakery/Bakery', 'Bakery.zip', '2023-08-26 06:18:36', '2023-10-27 16:20:38', 'uploads/template_zips/template_thumnails/1693291726_thumbnail_73.jpg', 0),
(74, 8, 'Swimming', 'uploads/template_zips/extracted_zip/1698645211_Swimming/swimming', 'swimming.zip', '2023-08-26 11:43:22', '2023-10-30 11:23:31', 'uploads/template_zips/template_thumnails/1693304594_thumbnail_74.jpg', 0),
(79, 9, 'Jewelry Store', 'uploads/template_zips/extracted_zip/1698326776_Jewelry Store/jewelry', 'jewelry.zip', '2023-08-26 13:17:39', '2023-10-26 13:26:16', 'uploads/template_zips/template_thumnails/1696050089_thumbnail_79.jpg', 0),
(80, 11, 'Career Guides', 'uploads/template_zips/extracted_zip/1695304527_Career Guides/career-guides', 'career-guides.zip', '2023-08-26 13:31:14', '2023-09-21 13:55:27', 'uploads/template_zips/template_thumnails/1693292132_thumbnail_80.jpg', 0),
(81, 7, 'Social Media', 'uploads/template_zips/extracted_zip/1698404851_Social Media/Social Media', 'Social_Media.zip', '2023-08-28 11:52:15', '2023-10-27 16:37:31', 'uploads/template_zips/template_thumnails/1693291596_thumbnail_81.jpg', 0),
(82, 7, 'Driving school', 'uploads/template_zips/extracted_zip/1698409910_Driving school/Driving School', 'Driving_School.zip', '2023-08-28 11:53:09', '2023-10-27 18:01:50', 'uploads/template_zips/template_thumnails/1693918950_thumbnail_82.jpg', 0),
(83, 12, 'Cyber-Security', 'uploads/template_zips/extracted_zip/1699427131_Cyber-Security/cyber-security', 'cyber-security.zip', '2023-08-28 12:29:46', '2023-11-08 07:05:31', 'uploads/template_zips/template_thumnails/1696498750_thumbnail_83.jpg', 0),
(84, 11, 'E Learning', 'uploads/template_zips/extracted_zip/1695360027_E Learning/e-learning', 'e-learning.zip', '2023-08-29 06:00:13', '2023-09-22 05:20:28', 'uploads/template_zips/template_thumnails/1693290721_thumbnail_84.jpg', 0),
(85, 10, 'plumber', 'uploads/template_zips/extracted_zip/1699438615_plumber/plumber', 'plumber.zip', '2023-08-29 06:18:13', '2023-11-08 10:16:55', 'uploads/template_zips/template_thumnails/1696858062_thumbnail_85.png', 0),
(86, 8, 'Web_agency', 'uploads/template_zips/extracted_zip/1698499169_Web_agency/web_agency', 'web_agency.zip', '2023-08-29 09:43:05', '2023-10-28 18:49:29', 'uploads/template_zips/template_thumnails/1695279386_thumbnail_86.jpg', 0),
(87, 7, 'Hotel Service', 'uploads/template_zips/extracted_zip/1695384561_Hotel Service/Hotel Services', 'Hotel_Services.zip', '2023-08-29 11:55:06', '2023-09-22 12:09:21', 'uploads/template_zips/template_thumnails/1693310106_thumbnail_.png', 0),
(88, 9, 'Spa & Wellness', 'uploads/template_zips/extracted_zip/1696418055_Spa & Wellness/Spa & Wellness', 'Spa_Wellness.zip', '2023-08-29 14:02:43', '2023-10-04 11:14:15', 'uploads/template_zips/template_thumnails/1696053007_thumbnail_88.jpg', 0),
(89, 10, 'Accountant', 'uploads/template_zips/extracted_zip/1699436335_Accountant/accountant', 'accountant.zip', '2023-08-31 05:47:22', '2023-11-08 09:38:55', 'uploads/template_zips/template_thumnails/1693460842_thumbnail_.png', 0),
(90, 12, 'Organic-Food', 'uploads/template_zips/extracted_zip/1699426812_Organic-Food/organic-food', 'organic-food.zip', '2023-08-31 09:17:03', '2023-11-08 07:00:12', 'uploads/template_zips/template_thumnails/1696571975_thumbnail_90.jpg', 0),
(91, 8, 'Restaurant', 'uploads/template_zips/extracted_zip/1698645378_Restaurant/restaurant', 'restaurant.zip', '2023-08-31 11:41:11', '2023-10-30 11:26:18', 'uploads/template_zips/template_thumnails/1695279920_thumbnail_91.jpg', 0),
(92, 11, 'Fast Food', 'uploads/template_zips/extracted_zip/1695360457_Fast Food/fast-food', 'fast-food.zip', '2023-08-31 13:15:49', '2023-09-22 05:27:37', 'uploads/template_zips/template_thumnails/1693487749_thumbnail_.jpg', 0),
(93, 9, 'Real Estate', 'uploads/template_zips/extracted_zip/1696418361_Real Estate/Real Estate', 'Real_Estate.zip', '2023-09-01 12:32:25', '2023-10-04 11:19:21', 'uploads/template_zips/template_thumnails/1696056482_thumbnail_93.jpg', 0),
(94, 8, 'Non-Profit Charity', 'uploads/template_zips/extracted_zip/1698669934_Non-Profit Charity/non_profit_charity', 'non_profit_charity.zip', '2023-09-04 05:56:07', '2023-10-30 18:15:34', 'uploads/template_zips/template_thumnails/1695281079_thumbnail_94.jpg', 0),
(95, 11, 'Lawyer', 'uploads/template_zips/extracted_zip/1696420203_Lawyer/lawyer', 'lawyer.zip', '2023-09-04 06:36:18', '2023-11-30 14:51:15', 'uploads/template_zips/template_thumnails/1693809378_thumbnail_.jpg', 1),
(98, 12, 'Fitness Gym', 'uploads/template_zips/extracted_zip/1699426935_Fitness Gym/fitness-gym', 'fitness-gym.zip', '2023-09-04 11:02:29', '2023-11-08 07:02:16', 'uploads/template_zips/template_thumnails/1696496715_thumbnail_98.jpg', 0),
(99, 7, 'Business Law', 'uploads/template_zips/extracted_zip/1695194391_Business Law/Business Law', 'Business_Law.zip', '2023-09-04 11:20:54', '2023-09-20 07:19:51', 'uploads/template_zips/template_thumnails/1693826823_thumbnail_99.png', 0),
(100, 8, 'Beauty Salon', 'uploads/template_zips/extracted_zip/1698668450_Beauty Salon/beauty_salon', 'beauty_salon.zip', '2023-09-05 09:31:50', '2023-10-30 17:50:50', 'uploads/template_zips/template_thumnails/1695280289_thumbnail_100.jpg', 0),
(101, 11, 'Music Tutoring', 'uploads/template_zips/extracted_zip/1696420365_Music Tutoring/music-tutoring', 'music-tutoring.zip', '2023-09-05 09:33:45', '2023-10-04 11:52:45', 'uploads/template_zips/template_thumnails/1693906425_thumbnail_.png', 0),
(102, 7, 'Architecture Firms', 'uploads/template_zips/extracted_zip/1693916927_Architecture Firms/Architecture Firms', 'Architecture_Firms.zip', '2023-09-05 12:24:21', '2023-09-05 12:28:47', 'uploads/template_zips/template_thumnails/1693916661_thumbnail_.jpg', 0),
(103, 9, 'Photography', 'uploads/template_zips/extracted_zip/1696058453_Photography/Photography', 'Photography.zip', '2023-09-05 14:35:42', '2023-09-30 07:20:53', 'uploads/template_zips/template_thumnails/1696057430_thumbnail_103.jpg', 0),
(104, 12, 'Italian Restaurant', 'uploads/template_zips/extracted_zip/1699427378_Italian Restaurant/italian-restaurant', 'italian-restaurant.zip', '2023-09-06 09:48:43', '2023-11-08 07:09:38', 'uploads/template_zips/template_thumnails/1696502835_thumbnail_104.jpg', 0),
(105, 8, 'Interior Design', 'uploads/template_zips/extracted_zip/1698668918_Interior Design/interior_design', 'interior_design.zip', '2023-09-06 10:14:05', '2023-10-30 17:58:38', 'uploads/template_zips/template_thumnails/1695280896_thumbnail_105.jpg', 0),
(106, 11, 'Car Repair', 'uploads/template_zips/extracted_zip/1696419892_Car Repair/car-repair', 'car-repair.zip', '2023-09-06 11:38:45', '2023-10-04 11:44:52', 'uploads/template_zips/template_thumnails/1694000325_thumbnail_.png', 0),
(107, 7, 'Fitness-Coaching', 'uploads/template_zips/extracted_zip/1695205286_Fitness-Coaching/Fitness Coaching', 'Fitness_Coaching.zip', '2023-09-06 12:46:20', '2023-09-20 10:21:26', 'uploads/template_zips/template_thumnails/1694004380_thumbnail_.jpg', 0),
(108, 12, 'Consultant', 'uploads/template_zips/extracted_zip/1699427416_Consultant/consultant', 'consultant.zip', '2023-09-07 11:56:09', '2023-11-08 07:10:16', 'uploads/template_zips/template_thumnails/1696498231_thumbnail_108.jpg', 0),
(109, 7, 'Security Service', 'uploads/template_zips/extracted_zip/1695726113_Security Service/Security Service', 'Security_Service.zip', '2023-09-08 09:44:21', '2023-09-26 11:01:53', 'uploads/template_zips/template_thumnails/1694167899_thumbnail_109.jpg', 0),
(110, 12, 'Motivational-Speakers', 'uploads/template_zips/extracted_zip/1699427278_Motivational-Speakers/motivational-speakers', 'motivational-speakers.zip', '2023-09-08 10:29:04', '2023-11-08 07:07:58', 'uploads/template_zips/template_thumnails/1699427278_thumbnail_110.png', 0),
(111, 9, 'Fashion', 'uploads/template_zips/extracted_zip/1696062983_Fashion/Fashion', 'Fashion.zip', '2023-09-08 12:45:09', '2023-09-30 08:36:23', 'uploads/template_zips/template_thumnails/1696059312_thumbnail_111.jpg', 0),
(112, 9, 'photographer', 'uploads/template_zips/extracted_zip/1696068041_photographer/photographer', 'photographer.zip', '2023-09-08 12:46:20', '2023-09-30 10:20:07', 'uploads/template_zips/template_thumnails/1696069207_thumbnail_112.jpg', 0),
(114, 9, 'Black Friday', 'uploads/template_zips/extracted_zip/1696068978_Black Friday/Black Friday', 'Black_Friday.zip', '2023-09-12 05:47:17', '2023-09-30 10:16:18', 'uploads/template_zips/template_thumnails/1696068978_thumbnail_114.jpg', 0),
(115, 7, 'Health & Medical Center', 'uploads/template_zips/extracted_zip/1695905943_Health & Medical Center/Health & Medical Center', 'Health_Medical_Center.zip', '2023-09-12 07:32:21', '2023-09-28 12:59:03', 'uploads/template_zips/template_thumnails/1694523893_thumbnail_115.jpg', 0),
(116, 7, 'Human Resources', 'uploads/template_zips/extracted_zip/1695725777_Human Resources/Human Resources', 'Human_Resources.zip', '2023-09-12 12:50:20', '2023-09-26 10:56:17', 'uploads/template_zips/template_thumnails/1694523020_thumbnail_.jpg', 0),
(117, 10, 'Dentist', 'uploads/template_zips/extracted_zip/1699438829_Dentist/Dentist', 'Dentist.zip', '2023-09-13 07:03:58', '2023-11-08 10:20:29', 'uploads/template_zips/template_thumnails/1694594197_thumbnail_117.png', 0),
(118, 10, 'Florist', 'uploads/template_zips/extracted_zip/1699507379_Florist/Florist', 'Florist.zip', '2023-09-13 08:44:56', '2023-11-09 05:22:59', 'uploads/template_zips/template_thumnails/1694594696_thumbnail_.png', 0),
(119, 11, 'Home Cleaning Services', 'uploads/template_zips/extracted_zip/1698410097_Home Cleaning Services/home-cleaning-services', 'home-cleaning-services.zip', '2023-09-13 11:19:11', '2023-10-27 18:04:57', 'uploads/template_zips/template_thumnails/1694603951_thumbnail_.png', 0),
(120, 10, 'HealthCare', 'uploads/template_zips/extracted_zip/1699507304_HealthCare/Healthcare', 'Healthcare.zip', '2023-09-13 12:18:02', '2023-11-09 05:21:44', 'uploads/template_zips/template_thumnails/1694607481_thumbnail_.png', 0),
(121, 7, 'Event Wedding', 'uploads/template_zips/extracted_zip/1695721110_Event Wedding/Event & Wedding', 'Event_Wedding.zip', '2023-09-13 13:33:02', '2023-09-26 09:38:30', 'uploads/template_zips/template_thumnails/1694613160_thumbnail_121.jpg', 0),
(122, 10, 'Petcare', 'uploads/template_zips/extracted_zip/1699509708_Petcare/Petcare', 'Petcare.zip', '2023-09-14 05:28:28', '2023-11-09 06:01:48', 'uploads/template_zips/template_thumnails/1694669308_thumbnail_.png', 0),
(123, 9, 'Travel Agency', 'uploads/template_zips/extracted_zip/1696070403_Travel Agency/Travel Agency', 'Travel_Agency.zip', '2023-09-14 07:34:06', '2023-09-30 10:50:01', 'uploads/template_zips/template_thumnails/1696071001_thumbnail_123.jpg', 0),
(124, 9, 'Digital-Marketing', 'uploads/template_zips/extracted_zip/1696071807_Digital-Marketing/Digital-Marketing', 'Digital-Marketing.zip', '2023-09-14 13:56:38', '2023-09-30 11:08:33', 'uploads/template_zips/template_thumnails/1696072113_thumbnail_124.jpg', 0),
(125, 8, 'Carpenter', 'uploads/template_zips/extracted_zip/1698668688_Carpenter/carpenter', 'carpenter.zip', '2023-09-15 06:45:15', '2023-10-30 17:54:48', 'uploads/template_zips/template_thumnails/1695280671_thumbnail_125.jpg', 0),
(126, 8, 'Marketing Agency', 'uploads/template_zips/extracted_zip/1698669648_Marketing Agency/marketing_agency', 'marketing_agency.zip', '2023-09-18 12:28:44', '2023-10-30 18:10:48', 'uploads/template_zips/template_thumnails/1695040828_thumbnail_126.jpg', 0),
(128, 7, 'Web Security', 'uploads/template_zips/extracted_zip/1695906528_Web Security/Web Security', 'Web_Security.zip', '2023-09-19 05:03:41', '2023-09-28 13:08:48', 'uploads/template_zips/template_thumnails/1695130147_thumbnail_128.jpg', 0),
(129, 9, 'Handmade Crafts', 'uploads/template_zips/extracted_zip/1696073964_Handmade Crafts/Handmade Crafts', 'Handmade_Crafts.zip', '2023-09-19 11:48:47', '2023-09-30 11:39:24', 'uploads/template_zips/template_thumnails/1696073964_thumbnail_129.jpg', 0),
(130, 7, 'Mobile App Development', 'uploads/template_zips/extracted_zip/1695725252_Mobile App Development/Mobile App Development', 'Mobile_App_Development.zip', '2023-09-19 13:10:33', '2023-09-26 10:47:32', 'uploads/template_zips/template_thumnails/1695129773_thumbnail_130.jpg', 0),
(132, 8, 'Cooking Classes', 'uploads/template_zips/extracted_zip/1698647068_Cooking Classes/cooking_classes', 'cooking_classes.zip', '2023-09-21 06:31:45', '2023-10-30 11:54:28', 'uploads/template_zips/template_thumnails/1695281711_thumbnail_132.jpg', 0),
(133, 12, 'Home-repair-renovation', 'uploads/template_zips/extracted_zip/1699426966_Home-repair-renovation/home-repair-renovation', 'home-repair-renovation.zip', '2023-09-21 06:37:40', '2023-11-08 07:02:46', 'uploads/template_zips/template_thumnails/1696501600_thumbnail_133.jpg', 0),
(134, 7, 'Child-Care', 'uploads/template_zips/extracted_zip/1695906044_Child-Care/Child-Care', 'Child-Care.zip', '2023-09-21 13:35:16', '2023-09-28 13:00:44', 'uploads/template_zips/template_thumnails/1695736408_thumbnail_134.jpg', 0),
(135, 7, 'Event Management', 'uploads/template_zips/extracted_zip/1695722846_Event Management/Event Management', 'Event_Management.zip', '2023-09-22 05:34:46', '2023-09-26 10:07:26', 'uploads/template_zips/template_thumnails/1695380005_thumbnail_135.jpg', 0),
(136, 8, 'Blogger', 'uploads/template_zips/extracted_zip/1698489715_Blogger/blogger', 'blogger.zip', '2023-09-22 05:49:59', '2023-10-28 16:11:56', 'uploads/template_zips/template_thumnails/1695377602_thumbnail_136.jpg', 0),
(137, 9, 'Financial Advice', 'uploads/template_zips/extracted_zip/1696077856_Financial Advice/Financial Advice', 'Financial_Advice.zip', '2023-09-22 07:06:35', '2023-09-30 12:44:16', 'uploads/template_zips/template_thumnails/1696077856_thumbnail_137.jpg', 0),
(138, 8, 'Outdoor Adventure', 'uploads/template_zips/extracted_zip/1698647472_Outdoor Adventure/outdoor_adventure', 'outdoor_adventure.zip', '2023-09-23 12:34:58', '2023-10-30 12:01:12', 'uploads/template_zips/template_thumnails/1695472498_thumbnail_.jpg', 0),
(139, 7, 'Dog Training', 'uploads/template_zips/extracted_zip/1695906146_Dog Training/Dog-Training', 'Dog-Training.zip', '2023-09-25 10:14:07', '2023-09-28 13:02:26', 'uploads/template_zips/template_thumnails/1695706986_thumbnail_139.jpg', 0),
(140, 12, 'Industry-Factory', 'uploads/template_zips/extracted_zip/1699427333_Industry-Factory/industry-factory', 'industry-factory.zip', '2023-09-25 11:12:17', '2023-11-08 07:08:53', 'uploads/template_zips/template_thumnails/1696502567_thumbnail_140.jpg', 0),
(141, 8, 'Data Analytics', 'uploads/template_zips/extracted_zip/1698647619_Data Analytics/data_analytics', 'data_analytics.zip', '2023-09-26 06:02:23', '2023-10-30 12:03:39', 'uploads/template_zips/template_thumnails/1695708143_thumbnail_.jpg', 0),
(142, 9, 'News & Media', 'uploads/template_zips/extracted_zip/1696079739_News & Media/News & Media', 'News_Media.zip', '2023-09-26 10:16:45', '2023-09-30 13:15:39', 'uploads/template_zips/template_thumnails/1696079738_thumbnail_142.jpg', 0),
(144, 8, 'Creative Agency', 'uploads/template_zips/extracted_zip/1698655288_Creative Agency/creative_agency', 'creative_agency.zip', '2023-09-26 13:14:34', '2023-10-30 14:11:28', 'uploads/template_zips/template_thumnails/1695734074_thumbnail_.jpg', 0),
(145, 11, 'Business & Corporate', 'uploads/template_zips/extracted_zip/1698411050_Business & Corporate/business-corporate', 'business-corporate.zip', '2023-09-27 11:58:16', '2023-10-27 18:20:50', 'uploads/template_zips/template_thumnails/1695815896_thumbnail_.png', 0),
(146, 7, 'Nature & Wildlife', 'uploads/template_zips/extracted_zip/1696071676_Nature & Wildlife/Nature & Wildlife', 'Nature_Wildlife.zip', '2023-09-27 12:15:22', '2023-09-30 11:01:16', 'uploads/template_zips/template_thumnails/1696071676_thumbnail_146.jpg', 0),
(148, 7, 'Academic', 'uploads/template_zips/extracted_zip/1695993154_Academic/Academic', 'Academic.zip', '2023-09-29 05:21:13', '2023-09-29 13:12:34', 'uploads/template_zips/template_thumnails/1695965277_thumbnail_148.jpg', 0),
(149, 7, 'Deck Refinishing', 'uploads/template_zips/extracted_zip/1695965218_Deck Refinishing/Deck Refinishing', 'Deck_Refinishing.zip', '2023-09-29 05:26:58', '2023-09-29 05:29:27', 'uploads/template_zips/template_thumnails/1695965367_thumbnail_149.jpg', 0),
(150, 10, 'Podcasting', 'uploads/template_zips/extracted_zip/1699507347_Podcasting/Podcasting', 'Podcasting.zip', '2023-09-29 10:32:51', '2023-11-09 05:22:27', 'uploads/template_zips/template_thumnails/1695983571_thumbnail_.png', 0),
(151, 12, 'Email Marketing', 'uploads/template_zips/extracted_zip/1699427162_Email Marketing/email-marketing', 'email-marketing.zip', '2023-09-30 09:55:57', '2023-11-08 07:06:02', 'uploads/template_zips/template_thumnails/1696499035_thumbnail_151.jpg', 0),
(152, 7, 'Music-Production', 'uploads/template_zips/extracted_zip/1696079768_Music-Production/Music-Production', 'Music-Production.zip', '2023-09-30 12:24:20', '2023-09-30 13:26:34', 'uploads/template_zips/template_thumnails/1696080394_thumbnail_152.jpg', 0),
(153, 10, 'Arts and Crafts', 'uploads/template_zips/extracted_zip/1698649998_Arts and Crafts/Arts-crafts', 'Arts-crafts.zip', '2023-09-30 12:25:54', '2023-11-08 09:54:01', 'uploads/template_zips/template_thumnails/1696076754_thumbnail_.png', 0),
(154, 9, 'Automotive', 'uploads/template_zips/extracted_zip/1696080816_Automotive/Automotive', 'Automotive.zip', '2023-09-30 13:27:20', '2023-09-30 13:33:36', 'uploads/template_zips/template_thumnails/1696080440_thumbnail_.jpg', 0),
(156, 11, 'Gardening', 'uploads/template_zips/extracted_zip/1698410602_Gardening/gardening', 'gardening.zip', '2023-10-04 09:22:22', '2023-10-27 18:13:22', 'uploads/template_zips/template_thumnails/1696411342_thumbnail_.png', 0),
(157, 11, 'Dentists', 'uploads/template_zips/extracted_zip/1698413441_Dentists/dentists', 'dentists.zip', '2023-10-04 11:34:55', '2023-10-27 19:00:41', 'uploads/template_zips/template_thumnails/1696419295_thumbnail_.png', 0),
(158, 12, 'Kitchen-store', 'uploads/template_zips/extracted_zip/1698649298_Kitechen-store/kitchen-store', 'kitchen-store.zip', '2023-10-06 05:56:17', '2023-11-01 12:32:45', 'uploads/template_zips/template_thumnails/1696571777_thumbnail_.jpg', 0),
(162, 10, 'Online Course', 'uploads/template_zips/extracted_zip/1699508621_Online Course/Online-courses', 'Online-courses.zip', '2023-10-09 10:18:20', '2023-11-09 05:43:41', 'uploads/template_zips/template_thumnails/1696846700_thumbnail_.png', 1),
(194, 1, 'Webinar Services', 'uploads/template_zips/extracted_zip/1698414236_Webinar Services/webinar-services', 'webinar-services.zip', '2023-12-27 12:06:32', '2023-12-27 12:14:31', 'uploads/template_zips/template_thumnails/1698314608_thumbnail_.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `imagelibrary`
--

CREATE TABLE `imagelibrary` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `url` varchar(150) NOT NULL,
  `title` varchar(100) NOT NULL,
  `source` varchar(10) NOT NULL DEFAULT 'custom'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL COMMENT 'user id',
  `payment_data` text NOT NULL,
  `order_id` text NOT NULL,
  `plan_id` int NOT NULL,
  `payment_status` int NOT NULL COMMENT '1 = completed, 2 = Processing, 3 = rejected',
  `type` int NOT NULL COMMENT '0 = Paypal, 1 = Rpay, 3 = Stripe',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_integration`
--

CREATE TABLE `payment_integration` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(225) NOT NULL,
  `key` int NOT NULL COMMENT '1 - PayPal 2 - Razorpay 3 - Stripe',
  `value` longtext NOT NULL,
  `pay_cred` text NOT NULL,
  `token_data` text NOT NULL,
  `isCreated` datetime NOT NULL,
  `isUpdated` datetime NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans_list`
--

CREATE TABLE `plans_list` (
  `id` int NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int NOT NULL,
  `p_currency` varchar(25) NOT NULL,
  `p_interval` int NOT NULL,
  `p_description` text NOT NULL,
  `p_status` int NOT NULL DEFAULT '1' COMMENT '0 = not active, 1 = active\r\n',
  `p_templates` text NOT NULL,
  `p_sites` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans_list`
--

INSERT INTO `plans_list` (`id`, `p_name`, `p_price`, `p_currency`, `p_interval`, `p_description`, `p_status`, `p_templates`, `p_sites`, `date_created`) VALUES
(4, 'Weekly Plan', 2, 'USD', 7, 'Access to all templates for a week unlimited Campaigns creation, Templates setup and more.', 1, '[\"148\",\"153\",\"156\",\"158\",\"194\"]', 4, '2023-12-25 14:43:01'),
(5, 'Monthly Plan', 129, 'INR', 31, 'Monthly Plan In INR. \r\nFor one month unlimited access to all features.', 1, '[\"135\",\"137\",\"144\",\"146\",\"151\",\"153\",\"157\",\"162\"]', 10, '2023-10-20 06:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `site_analytics`
--

CREATE TABLE `site_analytics` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `site_id` int NOT NULL COMMENT 'user_campaign id',
  `visit_count` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `site_name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_favicon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mandrill_settings` text COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_settings` text COLLATE utf8mb4_general_ci NOT NULL,
  `support_email` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `sortname`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua And Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas The'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CD', 'Congo The Democratic Republic Of The'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)'),
(54, 'HR', 'Croatia (Hrvatska)'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'TP', 'East Timor'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'XA', 'External Territories of Australia'),
(71, 'FK', 'Falkland Islands'),
(72, 'FO', 'Faroe Islands'),
(73, 'FJ', 'Fiji Islands'),
(74, 'FI', 'Finland'),
(75, 'FR', 'France'),
(76, 'GF', 'French Guiana'),
(77, 'PF', 'French Polynesia'),
(78, 'TF', 'French Southern Territories'),
(79, 'GA', 'Gabon'),
(80, 'GM', 'Gambia The'),
(81, 'GE', 'Georgia'),
(82, 'DE', 'Germany'),
(83, 'GH', 'Ghana'),
(84, 'GI', 'Gibraltar'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'XU', 'Guernsey and Alderney'),
(92, 'GN', 'Guinea'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HT', 'Haiti'),
(96, 'HM', 'Heard and McDonald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong S.A.R.'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'JM', 'Jamaica'),
(109, 'JP', 'Japan'),
(110, 'XJ', 'Jersey'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea North'),
(116, 'KR', 'Korea South'),
(117, 'KW', 'Kuwait'),
(118, 'KG', 'Kyrgyzstan'),
(119, 'LA', 'Laos'),
(120, 'LV', 'Latvia'),
(121, 'LB', 'Lebanon'),
(122, 'LS', 'Lesotho'),
(123, 'LR', 'Liberia'),
(124, 'LY', 'Libya'),
(125, 'LI', 'Liechtenstein'),
(126, 'LT', 'Lithuania'),
(127, 'LU', 'Luxembourg'),
(128, 'MO', 'Macau S.A.R.'),
(129, 'MK', 'Macedonia'),
(130, 'MG', 'Madagascar'),
(131, 'MW', 'Malawi'),
(132, 'MY', 'Malaysia'),
(133, 'MV', 'Maldives'),
(134, 'ML', 'Mali'),
(135, 'MT', 'Malta'),
(136, 'XM', 'Man (Isle of)'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'YT', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia'),
(144, 'MD', 'Moldova'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'MS', 'Montserrat'),
(148, 'MA', 'Morocco'),
(149, 'MZ', 'Mozambique'),
(150, 'MM', 'Myanmar'),
(151, 'NA', 'Namibia'),
(152, 'NR', 'Nauru'),
(153, 'NP', 'Nepal'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NL', 'Netherlands The'),
(156, 'NC', 'New Caledonia'),
(157, 'NZ', 'New Zealand'),
(158, 'NI', 'Nicaragua'),
(159, 'NE', 'Niger'),
(160, 'NG', 'Nigeria'),
(161, 'NU', 'Niue'),
(162, 'NF', 'Norfolk Island'),
(163, 'MP', 'Northern Mariana Islands'),
(164, 'NO', 'Norway'),
(165, 'OM', 'Oman'),
(166, 'PK', 'Pakistan'),
(167, 'PW', 'Palau'),
(168, 'PS', 'Palestinian Territory Occupied'),
(169, 'PA', 'Panama'),
(170, 'PG', 'Papua new Guinea'),
(171, 'PY', 'Paraguay'),
(172, 'PE', 'Peru'),
(173, 'PH', 'Philippines'),
(174, 'PN', 'Pitcairn Island'),
(175, 'PL', 'Poland'),
(176, 'PT', 'Portugal'),
(177, 'PR', 'Puerto Rico'),
(178, 'QA', 'Qatar'),
(179, 'RE', 'Reunion'),
(180, 'RO', 'Romania'),
(181, 'RU', 'Russia'),
(182, 'RW', 'Rwanda'),
(183, 'SH', 'Saint Helena'),
(184, 'KN', 'Saint Kitts And Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'PM', 'Saint Pierre and Miquelon'),
(187, 'VC', 'Saint Vincent And The Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'XG', 'Smaller Territories of the UK'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia'),
(204, 'SS', 'South Sudan'),
(205, 'ES', 'Spain'),
(206, 'LK', 'Sri Lanka'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syria'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad And Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks And Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States Minor Outlying Islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State (Holy See)'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (US)'),
(241, 'WF', 'Wallis And Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'YU', 'Yugoslavia'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `u_id` int NOT NULL,
  `u_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `u_email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `u_pic` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `u_password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `u_type` tinyint NOT NULL COMMENT '1-Admin,2-Users,3-Team Member, 4-Client, 5-Reseller, 6-desginer',
  `u_status` tinyint NOT NULL COMMENT '1-Active,2-InActive,3-Suspicious, 4-none-Suspicious',
  `u_plan` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_parent` int NOT NULL,
  `parent_id` int NOT NULL COMMENT 'User id of TeamMember/Client/Reseller account',
  `u_purchaseddate` datetime NOT NULL,
  `u_profile_details` text COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`u_id`, `u_name`, `u_email`, `u_pic`, `u_password`, `u_type`, `u_status`, `u_plan`, `is_parent`, `parent_id`, `u_purchaseddate`, `u_profile_details`) VALUES
(1, 'Admin', 'admin@pixelpages.net', 'uploads/profile_img/profile_17.png', 'e6e061838856bf47e1de730719fb2609', 1, 1, '', 0, 0, '0000-00-00 00:00:00', '{\"ppa_uname\":\"Admin\",\"ppa_number\":null,\"ppa_address\":null,\"ppa_city\":null,\"ppa_state\":null,\"ppa_zipcode\":null,\"ppa_country\":null}'),
(14, 'Demo User', 'user@pixelpages.net', 'uploads/profile_img/profile_14.jpg', 'ba5ef51294fea5cb4eadea5306f3ca3b', 2, 1, '', 0, 0, '2023-10-12 06:44:42', '{\"ppa_uname\":\"Demo User\",\"ppa_number\":\"+91-98765432\",\"ppa_address\":\"21 MT street\",\"ppa_city\":\"Queens\",\"ppa_state\":\"NY\",\"ppa_zipcode\":\"540-263\",\"ppa_country\":\"United States\"}');

-- --------------------------------------------------------

--
-- Table structure for table `user_campaigns`
--

CREATE TABLE `user_campaigns` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `temp_id` int NOT NULL,
  `template_name` varchar(225) NOT NULL,
  `campaign_host_name` varchar(255) NOT NULL,
  `template_thumbnail` varchar(225) NOT NULL,
  `email_setting` text NOT NULL,
  `custom_css` longtext NOT NULL,
  `custom_js` longtext NOT NULL,
  `template_html` longtext NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1',
  `template_settings` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ar_form_data`
--
ALTER TABLE `ar_form_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoresponder`
--
ALTER TABLE `autoresponder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_id` (`user_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dfy_templates`
--
ALTER TABLE `dfy_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagelibrary`
--
ALTER TABLE `imagelibrary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_integration`
--
ALTER TABLE `payment_integration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans_list`
--
ALTER TABLE `plans_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_analytics`
--
ALTER TABLE `site_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_campaigns`
--
ALTER TABLE `user_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ar_form_data`
--
ALTER TABLE `ar_form_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autoresponder`
--
ALTER TABLE `autoresponder`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `dfy_templates`
--
ALTER TABLE `dfy_templates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `imagelibrary`
--
ALTER TABLE `imagelibrary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_integration`
--
ALTER TABLE `payment_integration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans_list`
--
ALTER TABLE `plans_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `site_analytics`
--
ALTER TABLE `site_analytics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_campaigns`
--
ALTER TABLE `user_campaigns`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
