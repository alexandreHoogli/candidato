-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04/06/2024 às 13:58
-- Versão do servidor: 10.6.17-MariaDB-cll-lve
-- Versão do PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenciavtec_pages`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ar_form_data`
--

CREATE TABLE `ar_form_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `form_type` int(11) NOT NULL COMMENT '1 = subscription, 2 = contact form',
  `user_email` varchar(255) NOT NULL,
  `all_details` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `ar_form_data`
--

INSERT INTO `ar_form_data` (`id`, `user_id`, `campaign_id`, `form_type`, `user_email`, `all_details`, `date_added`) VALUES
(1, 19, 9, 2, 'rafaelhoogli@gmail.com', '{\"pp_name\":\"Rafael Hoogli\",\"pp_email\":\"rafaelhoogli@gmail.com\",\"pp_subject\":\"teste\",\"pp_message\":\"Apenas um teste\",\"auth_code\":\"9\"}', '2024-05-14 11:38:27'),
(2, 19, 12, 2, 'rafaelhoogli@gmail.com', '{\"pp_name\":\"teste hoogli\",\"pp_email\":\"rafaelhoogli@gmail.com\",\"pp_subject\":\"teste\",\"pp_message\":\"Ol\\u00e1 mundo\",\"auth_code\":\"12\"}', '2024-05-31 13:40:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autoresponder`
--

CREATE TABLE `autoresponder` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mkey` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `currencies`
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
-- Estrutura para tabela `dfy_templates`
--

CREATE TABLE `dfy_templates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `zip_path` text NOT NULL,
  `zip_name` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `thumbnail_path` text NOT NULL,
  `is_downloadable` int(11) NOT NULL COMMENT '0 = no, 1 = yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `dfy_templates`
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
(115, 7, 'Health & Medical Center', 'uploads/template_zips/extracted_zip/1695905943_Health & Medical Center/Health & Medical Center', 'Health_Medical_Center.zip', '2023-09-12 07:32:21', '2024-05-03 11:41:48', 'uploads/template_zips/template_thumnails/1694523893_thumbnail_115.jpg', 1),
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
(157, 11, 'Dentists', 'uploads/template_zips/extracted_zip/1698413441_Dentists/dentists', 'dentists.zip', '2023-10-04 11:34:55', '2024-04-25 15:15:05', 'uploads/template_zips/template_thumnails/1696419295_thumbnail_.png', 1),
(158, 12, 'Kitchen-store', 'uploads/template_zips/extracted_zip/1698649298_Kitechen-store/kitchen-store', 'kitchen-store.zip', '2023-10-06 05:56:17', '2023-11-01 12:32:45', 'uploads/template_zips/template_thumnails/1696571777_thumbnail_.jpg', 0),
(162, 10, 'Online Course', 'uploads/template_zips/extracted_zip/1699508621_Online Course/Online-courses', 'Online-courses.zip', '2023-10-09 10:18:20', '2023-11-09 05:43:41', 'uploads/template_zips/template_thumnails/1696846700_thumbnail_.png', 1),
(194, 1, 'Webinar Services', 'uploads/template_zips/extracted_zip/1698414236_Webinar Services/webinar-services', 'webinar-services.zip', '2023-12-27 12:06:32', '2024-06-03 15:55:36', 'uploads/template_zips/template_thumnails/1698314608_thumbnail_.png', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagelibrary`
--

CREATE TABLE `imagelibrary` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `url` varchar(150) NOT NULL,
  `title` varchar(100) NOT NULL,
  `source` varchar(10) NOT NULL DEFAULT 'custom'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `imagelibrary`
--

INSERT INTO `imagelibrary` (`id`, `uid`, `url`, `title`, `source`) VALUES
(1, 1, '65b7e3063c1cc_1.jpg', '65b7e3063c1cc_1.jpg', 'pixabay'),
(2, 1, '65b7e3091e266_1.jpg', '65b7e3091e266_1.jpg', 'pixabay'),
(3, 14, 'fd42480074_14.jpg', 'caminhao-de-reboque-com-carro-na-garantia-na-estrada-entrega-automatica-de-reboque-e-acidente-caminh', 'custom'),
(4, 1, '65d66a59d3cb4_1.jpg', '65d66a59d3cb4_1.jpg', 'pixabay'),
(5, 1, '65d66a614f903_1.jpg', '65d66a614f903_1.jpg', 'pixabay'),
(6, 1, '65d66a63d40fe_1.jpg', '65d66a63d40fe_1.jpg', 'pixabay'),
(7, 1, '65d66a683465d_1.jpg', '65d66a683465d_1.jpg', 'pixabay'),
(8, 1, '65d66a6a7de12_1.jpg', '65d66a6a7de12_1.jpg', 'pixabay'),
(9, 1, '65d66a6b229aa_1.jpg', '65d66a6b229aa_1.jpg', 'pixabay'),
(10, 1, '65d66a6c058f9_1.jpg', '65d66a6c058f9_1.jpg', 'pixabay'),
(11, 1, '65d66a6cee7c3_1.jpg', '65d66a6cee7c3_1.jpg', 'pixabay'),
(12, 1, '65d66a6e251d8_1.jpg', '65d66a6e251d8_1.jpg', 'pixabay'),
(13, 1, '65d66da779775_1.jpg', '65d66da779775_1.jpg', 'pixabay'),
(14, 1, '65d66da959535_1.jpg', '65d66da959535_1.jpg', 'pixabay'),
(15, 1, '65d66daa7c7ea_1.jpg', '65d66daa7c7ea_1.jpg', 'pixabay'),
(16, 1, '65d66dab6c4c9_1.jpg', '65d66dab6c4c9_1.jpg', 'pixabay'),
(17, 1, '65d66dac12fd3_1.jpg', '65d66dac12fd3_1.jpg', 'pixabay'),
(18, 1, '65d66dad82d59_1.jpg', '65d66dad82d59_1.jpg', 'pixabay'),
(19, 1, '65d66dd3a990a_1.jpg', '65d66dd3a990a_1.jpg', 'pixabay'),
(20, 1, '65d66dd7799a0_1.jpg', '65d66dd7799a0_1.jpg', 'pixabay'),
(21, 1, '65d66ddbdf557_1.jpg', '65d66ddbdf557_1.jpg', 'pixabay'),
(22, 1, '93c180bf35_1.jpg', 'IMG_4969.jpg', 'custom'),
(23, 1, '65d9531c7c80a_1.jpg', '65d9531c7c80a_1.jpg', 'pixabay'),
(24, 1, '4369624f64_1.png', 'LOGO A.png', 'custom'),
(25, 1, '65de53696d6e7_1.jpg', '65de53696d6e7_1.jpg', 'pixabay'),
(26, 1, '65de536b56b2e_1.jpg', '65de536b56b2e_1.jpg', 'pixabay'),
(27, 1, '65de536c3171d_1.jpg', '65de536c3171d_1.jpg', 'pixabay'),
(28, 1, '65de5371e7ea0_1.jpg', '65de5371e7ea0_1.jpg', 'pixabay'),
(29, 1, '65de5e310c5d8_1.jpg', '65de5e310c5d8_1.jpg', 'pixabay'),
(30, 1, '65de5e3717f3d_1.jpg', '65de5e3717f3d_1.jpg', 'pixabay'),
(31, 1, '65de5e3b27bad_1.jpg', '65de5e3b27bad_1.jpg', 'pixabay'),
(32, 1, '65de5e3c8013d_1.jpg', '65de5e3c8013d_1.jpg', 'pixabay'),
(33, 1, '65de5e42501fd_1.jpg', '65de5e42501fd_1.jpg', 'pixabay'),
(34, 1, '65de5e460a36a_1.jpg', '65de5e460a36a_1.jpg', 'pixabay'),
(35, 1, '65de5e4728473_1.jpg', '65de5e4728473_1.jpg', 'pixabay'),
(36, 1, '65de5e4e28035_1.jpg', '65de5e4e28035_1.jpg', 'pixabay'),
(37, 1, '65de5e5862dda_1.jpg', '65de5e5862dda_1.jpg', 'pixabay'),
(38, 1, 'd9f7ecd367_1.png', 'logo hoogli.png', 'custom'),
(39, 1, '65eb90a630924_1.jpg', '65eb90a630924_1.jpg', 'pixabay'),
(40, 1, '65eb90a7ba965_1.jpg', '65eb90a7ba965_1.jpg', 'pixabay'),
(41, 1, '45f5463fa8_1.jpg', '24-horas-de-servico.jpg', 'custom'),
(42, 1, '65f1fb6194b3a_1.jpg', '65f1fb6194b3a_1.jpg', 'pixabay'),
(43, 1, 'c4470f79aa_1.jpeg', 'WhatsApp Image 2024-04-16 at 10.34.20.jpeg', 'custom'),
(44, 1, 'eaa8b3ea25_1.webp', 'foto.webp', 'custom'),
(45, 1, '550593030f_1.webp', 'logo.webp', 'custom'),
(46, 1, 'c213deeccc_1.webp', 'banner1.webp', 'custom'),
(47, 1, 'dcec07c271_1.webp', 'icone1.1.webp', 'custom'),
(48, 1, 'a2c73aef2d_1.webp', 'icone1.2.webp', 'custom'),
(49, 1, '2d8c59555a_1.webp', 'icone1.3.webp', 'custom'),
(50, 1, '7208f4a889_1.webp', 'icone1.4.webp', 'custom'),
(51, 1, '7101c9cffd_1.webp', 'foto1.webp', 'custom'),
(52, 1, 'f6fad1ac58_1.webp', 'topico.webp', 'custom'),
(53, 1, 'bdec5a9324_1.webp', 'topico.webp', 'custom'),
(54, 1, '09ff7ade5b_1.webp', 'topico.webp', 'custom'),
(55, 1, 'dde5f29e85_1.webp', 'topico.webp', 'custom'),
(56, 1, '2619f60648_1.webp', 'nossojeitode fazer1.webp', 'custom'),
(57, 1, 'ab98bc349b_1.webp', 'nossojeitode fazer2.webp', 'custom'),
(58, 1, '991faf62b4_1.webp', 'nossojeitode fazer3.webp', 'custom'),
(59, 1, '2533c12555_1.webp', 'nossojeitode fazer4.webp', 'custom'),
(60, 1, '4af00ed03e_1.webp', 'nossojeitode fazer5.webp', 'custom'),
(61, 1, 'b088327fa7_1.webp', 'nossojeitode fazer6.webp', 'custom'),
(62, 1, '40fef33824_1.webp', 'icone2.1.webp', 'custom'),
(63, 1, '7509b8d9cf_1.webp', 'icone2.2.webp', 'custom'),
(64, 1, '14451f1f48_1.webp', 'icone2.3.webp', 'custom'),
(65, 1, 'fa2ba2e946_1.webp', 'icone2.4.webp', 'custom'),
(66, 1, '5cdde002e2_1.webp', 'especialistas1.webp', 'custom'),
(67, 1, 'ed24c5414c_1.webp', 'especialistas2.webp', 'custom'),
(68, 1, 'e59cf1d01d_1.webp', 'bannerfinal.webp', 'custom'),
(69, 1, 'fd3811d58b_1.webp', 'bannerhome.webp', 'custom'),
(70, 1, 'ca1bd5c446_1.webp', 'bannerfim.webp', 'custom'),
(71, 1, '31c1ebf61e_1.webp', 'foto11.webp', 'custom'),
(72, 1, 'b5a169ceb2_1.webp', 'bannerinicial.webp', 'custom'),
(73, 1, '70ba1e4a15_1.png', 'logo hoogli.png', 'custom'),
(74, 1, '662196856bf7c_1.jpg', '662196856bf7c_1.jpg', 'pixabay'),
(75, 1, '66219686c1a20_1.jpg', '66219686c1a20_1.jpg', 'pixabay'),
(76, 1, '662196877f717_1.jpg', '662196877f717_1.jpg', 'pixabay'),
(77, 1, '662196884e68e_1.jpg', '662196884e68e_1.jpg', 'pixabay'),
(78, 1, 'eac25c7110_1.webp', 'bf.webp', 'custom'),
(79, 1, 'f2ea4ba1bd_1.webp', 'bf (1).webp', 'custom'),
(80, 1, 'a4fdcd627a_1.webp', 'bf (2).webp', 'custom'),
(81, 1, '0ae7e58908_1.webp', 'i15.webp', 'custom'),
(82, 1, '13d9459932_1.webp', 'i16.webp', 'custom'),
(83, 1, '8528a4e664_1.webp', 'i17.webp', 'custom'),
(84, 1, 'ac93dd621a_1.png', '123440283_189576079322980_7656670631206660883_n.png', 'custom'),
(85, 1, '1290b2467d_1.png', '123440283_189576079322980_7656670631206660883_n.png', 'custom'),
(86, 1, '70485118b7_1.jpg', 'CityProblem65d6001e2b47420240221.jpg', 'custom'),
(87, 19, 'c0b24fec7a_19.webp', 'Icone 1.5.webp', 'custom'),
(88, 19, 'bc321fc0ae_19.webp', 'Icone 1.6.webp', 'custom'),
(89, 19, 'f11d21fdf3_19.webp', 'Icone 1.7.webp', 'custom'),
(90, 19, 'b4c457da28_19.webp', 'Banner Final.webp', 'custom'),
(91, 19, '7ff4a26350_19.webp', 'con1.webp', 'custom'),
(92, 19, '46e2b728db_19.webp', 'con1.webp', 'custom'),
(93, 19, '8bf3ea8714_19.webp', 'con2.webp', 'custom'),
(94, 19, 'c96ea5466b_19.webp', 'con3.webp', 'custom'),
(95, 19, 'fa91297308_19.webp', 'con4.webp', 'custom'),
(96, 19, '772640c849_19.webp', 'con5.webp', 'custom'),
(97, 19, '12a4fb9e62_19.webp', 'con6.webp', 'custom'),
(98, 19, '90fbb838b4_19.webp', 'con7.webp', 'custom'),
(99, 19, '2113cb94e9_19.webp', 'con8.webp', 'custom'),
(100, 19, 'bdee57709f_19.webp', 'con9.webp', 'custom'),
(101, 19, 'f7c9ee17d0_19.webp', 'con10.webp', 'custom'),
(102, 19, 'e2873048fa_19.webp', 'con11.webp', 'custom'),
(103, 19, 'a007545ded_19.webp', 'con9.webp', 'custom'),
(104, 19, 'bf73d25617_19.webp', 'con10.webp', 'custom'),
(105, 19, 'ff3d819fb7_19.webp', 'con11.webp', 'custom'),
(106, 19, 'c6bb679aa5_19.webp', 'con12.webp', 'custom'),
(107, 19, 'c488c3484d_19.webp', 'con13.webp', 'custom'),
(108, 19, '2413d2411d_19.webp', 'con14.webp', 'custom'),
(109, 19, '39fc22d64b_19.webp', 'con15.webp', 'custom'),
(110, 19, 'ced1c16ab7_19.webp', 'con16.webp', 'custom'),
(111, 19, 'd2960c0932_19.webp', 'con17.webp', 'custom'),
(112, 19, '49766e824b_19.webp', 'con18.webp', 'custom'),
(113, 19, 'ed5ef64517_19.webp', 'con19.webp', 'custom'),
(114, 19, '29266ebb48_19.webp', 'con20.webp', 'custom'),
(115, 19, '386c0caa0c_19.webp', 'con21.webp', 'custom'),
(116, 19, 'b88c6bb254_19.webp', 'con22.webp', 'custom'),
(117, 19, 'bc81b0eb2b_19.webp', 'con23.webp', 'custom'),
(118, 19, '05b6b40aed_19.webp', 'con24.webp', 'custom'),
(119, 19, '997905a4b3_19.webp', 'con25.webp', 'custom'),
(120, 19, 'bcd679b216_19.webp', 'con26.webp', 'custom'),
(121, 19, '898c819a50_19.webp', 'con27.webp', 'custom'),
(122, 19, 'ffc8446f4f_19.webp', 'con28.webp', 'custom'),
(123, 19, '6b206f1200_19.webp', 'con29.webp', 'custom'),
(124, 19, 'c9d711300f_19.webp', 'con30.webp', 'custom'),
(125, 19, '9e30365594_19.webp', 'con31.webp', 'custom'),
(126, 19, '5d14bf07aa_19.webp', 'con32.webp', 'custom'),
(127, 19, '8072940bed_19.webp', 'con33.webp', 'custom'),
(128, 19, '6836935aa9_19.webp', 'con34.webp', 'custom'),
(129, 19, '81934631bd_19.webp', 'con35.webp', 'custom'),
(130, 19, '5d0c449cf0_19.webp', 'con36.webp', 'custom'),
(131, 19, 'f9e18d732e_19.webp', 'con37.webp', 'custom'),
(132, 19, '8fc5c03cd2_19.webp', 'con38.webp', 'custom'),
(133, 19, 'f8562c45aa_19.webp', 'con39.webp', 'custom'),
(134, 19, '47680840a8_19.webp', 'con40.webp', 'custom'),
(135, 19, '2cd3eebe41_19.webp', 'con41.webp', 'custom'),
(136, 19, '3f0f80df8c_19.webp', 'con42.webp', 'custom'),
(137, 19, 'b554a6043c_19.webp', 'con43.webp', 'custom'),
(138, 19, 'bf44976354_19.webp', 'evolua.webp', 'custom'),
(139, 19, 'd304687086_19.webp', 'logo rodape? Evolua.webp', 'custom'),
(140, 19, '30b8edc89d_19.webp', 'banner1.webp', 'custom'),
(141, 19, 'd4a1def0f4_19.webp', 'foto1.webp', 'custom'),
(142, 19, '0c348092c1_19.webp', 'topico.webp', 'custom'),
(143, 19, '660957de30_19.webp', 'topico.webp', 'custom'),
(144, 19, 'cc2e685e20_19.webp', 'topico.webp', 'custom'),
(145, 19, 'ab2e014852_19.webp', 'topico.webp', 'custom'),
(146, 19, 'a82e385912_19.webp', 'topico.webp', 'custom'),
(147, 19, '035d4f44fd_19.webp', 'topico.webp', 'custom'),
(148, 19, '44f5f06e92_19.webp', 'topico.webp', 'custom'),
(149, 19, 'f582b81082_19.webp', 'banner2.webp', 'custom'),
(150, 19, '7f8eafb23f_19.webp', 'logop.webp', 'custom'),
(151, 19, '9c9ea7638d_19.webp', 'logob.webp', 'custom'),
(152, 19, '5184c602eb_19.webp', 'topico.webp', 'custom'),
(153, 19, '8bc89d585d_19.webp', 'redon1.webp', 'custom'),
(154, 19, 'f111e77ea3_19.webp', 'redon2.webp', 'custom'),
(155, 19, '83a6afaddc_19.webp', 'redon3.webp', 'custom'),
(156, 19, 'f1545b83ab_19.webp', 'redon4.webp', 'custom'),
(157, 19, 'fa82f065a4_19.webp', 'banner3.webp', 'custom'),
(158, 19, 'a1098745a8_19.webp', 'banner2.webp', 'custom'),
(159, 19, 'f42feae3ac_19.webp', 'banner3.webp', 'custom'),
(160, 19, 'b0e8b2c59c_19.webp', 'icones1.webp', 'custom'),
(161, 19, 'cbb72d776f_19.webp', 'icones2.webp', 'custom'),
(162, 19, '8e02e774d3_19.webp', 'icones3.webp', 'custom'),
(163, 19, 'bd3cd6785d_19.webp', 'icones4.webp', 'custom'),
(164, 19, '4a5bf7a4ca_19.webp', 'icones5.webp', 'custom'),
(165, 19, '304847c8f2_19.webp', 'icones6.webp', 'custom'),
(166, 19, '715106c645_19.webp', 'iconev1.webp', 'custom'),
(167, 19, '04e121f22d_19.webp', 'iconev2.webp', 'custom'),
(168, 19, '9592121ac6_19.webp', 'iconev3.webp', 'custom'),
(169, 19, '75805038b0_19.webp', 'iconev4.webp', 'custom'),
(170, 19, '5fb84bf9d6_19.webp', 'iconei1.webp', 'custom'),
(171, 19, '7458948c37_19.webp', 'iconei2.webp', 'custom'),
(172, 19, '652f3f5c17_19.webp', 'iconei3.webp', 'custom'),
(173, 19, '454c0c4d5b_19.webp', 'bannerfim.webp', 'custom'),
(174, 19, 'f9bffb6432_19.png', 'logob.png', 'custom'),
(175, 19, '6ebed7e480_19.png', 'logop.png', 'custom'),
(176, 19, '2f20091cd4_19.webp', 'fot1.webp', 'custom'),
(177, 19, '989ba646d5_19.webp', 'banner2.webp', 'custom'),
(178, 19, 'edb8e815f6_19.webp', 'fot1.webp', 'custom'),
(179, 19, '919f310a5e_19.png', 'logop.png', 'custom'),
(180, 19, '8a63bc671b_19.png', 'logob.png', 'custom'),
(181, 19, '4eeb7e9b89_19.webp', 'b22.webp', 'custom'),
(182, 19, 'f8ec0db014_19.webp', 'teste.webp', 'custom'),
(183, 1, '02cf86a2bc_1.jpeg', '1642616515895.jpeg', 'custom'),
(184, 1, '95876bf645_1.jpg', 'Hoogli-Logo.jpg', 'custom'),
(185, 1, '95dca40f39_1.png', 'logo hoogli.png', 'custom'),
(186, 1, '9349ffc90d_1.jpg', 'detalhes L.jpg', 'custom');

-- --------------------------------------------------------

--
-- Estrutura para tabela `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL COMMENT 'user id',
  `payment_data` text NOT NULL,
  `order_id` text NOT NULL,
  `plan_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL COMMENT '1 = completed, 2 = Processing, 3 = rejected',
  `type` int(11) NOT NULL COMMENT '0 = Paypal, 1 = Rpay, 3 = Stripe',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `payment_info`
--

INSERT INTO `payment_info` (`id`, `customer_id`, `payment_data`, `order_id`, `plan_id`, `payment_status`, `type`, `created_on`, `updated_on`, `status`) VALUES
(1, 14, 'Admin', 'NA', 5, 1, 4, '2024-01-26 17:44:33', '2024-01-26 17:44:33', 1),
(2, 0, 'Admin', 'NA', 5, 1, 4, '2024-02-21 13:00:24', '2024-02-21 13:00:24', 1),
(3, 0, 'Admin', 'NA', 5, 1, 4, '2024-02-21 13:00:29', '2024-02-21 13:00:29', 1),
(4, 14, 'Admin', 'NA', 11, 1, 4, '2024-03-11 17:31:14', '2024-03-11 17:31:14', 1),
(5, 14, 'Admin', 'NA', 5, 1, 4, '2024-03-11 17:46:18', '2024-03-11 17:46:18', 1),
(6, 14, 'Admin', 'NA', 11, 1, 4, '2024-03-27 15:25:47', '2024-03-27 15:25:47', 1),
(7, 14, 'Admin', 'NA', 5, 1, 4, '2024-04-17 09:29:37', '2024-04-17 09:29:37', 1),
(8, 14, 'Admin', 'NA', 11, 1, 4, '2024-04-17 09:29:46', '2024-04-17 09:29:46', 1),
(9, 19, 'Admin', 'NA', 11, 1, 4, '2024-04-22 08:33:54', '2024-04-22 08:33:54', 1),
(10, 19, 'Admin', 'NA', 11, 1, 4, '2024-05-31 13:12:14', '2024-05-31 13:12:14', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `payment_integration`
--

CREATE TABLE `payment_integration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `key` int(11) NOT NULL COMMENT '1 - PayPal 2 - Razorpay 3 - Stripe',
  `value` longtext NOT NULL,
  `pay_cred` text NOT NULL,
  `token_data` text NOT NULL,
  `isCreated` datetime NOT NULL,
  `isUpdated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `payment_integration`
--

INSERT INTO `payment_integration` (`id`, `user_id`, `title`, `key`, `value`, `pay_cred`, `token_data`, `isCreated`, `isUpdated`, `status`) VALUES
(1, 1, '', 3, '{\"stripe_publishKey\":\"pk_live_51NAtWFIAN6RXgJECOvQ2IvrVeZusJ3gjMimfeJ1Dnh8IXejYqYzEXRbMPkxfsczvcctWVVKnCS2DkviuGpFai4M400rERr0FJn\",\"stripe_secretkey\":\"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\",\"stripe_currency\":\"BRR\"}', '', '', '2024-03-11 18:24:32', '2024-03-11 18:24:32', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `plans_list`
--

CREATE TABLE `plans_list` (
  `id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_currency` varchar(25) NOT NULL,
  `p_interval` int(11) NOT NULL,
  `p_description` text NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = not active, 1 = active\r\n',
  `p_templates` text NOT NULL,
  `p_sites` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `plans_list`
--

INSERT INTO `plans_list` (`id`, `p_name`, `p_price`, `p_currency`, `p_interval`, `p_description`, `p_status`, `p_templates`, `p_sites`, `date_created`) VALUES
(4, 'Weekly Plan', 2, 'USD', 7, 'Access to all templates for a week unlimited Campaigns creation, Templates setup and more.', 1, '[\"148\",\"153\",\"156\",\"158\",\"194\"]', 4, '2023-12-25 14:43:01'),
(5, 'Monthly Plan', 129, 'INR', 31, 'Monthly Plan In INR. \r\nFor one month unlimited access to all features.', 1, '[\"135\",\"137\",\"144\",\"146\",\"151\",\"153\",\"157\",\"162\"]', 10, '2023-10-20 06:50:38'),
(11, 'Agência parceira', 299, 'BRR', 31, 'Agência parceira', 1, '[\"115\",\"120\",\"157\",\"162\",\"194\"]', 5, '2024-03-11 17:30:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_analytics`
--

CREATE TABLE `site_analytics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL COMMENT 'user_campaign id',
  `visit_count` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `site_analytics`
--

INSERT INTO `site_analytics` (`id`, `user_id`, `site_id`, `visit_count`, `date`) VALUES
(4, 14, 6, 1, '2024-04-18'),
(5, 14, 6, 2, '2024-04-19'),
(7, 19, 9, 3, '2024-04-22'),
(8, 19, 9, 3, '2024-04-25'),
(9, 19, 9, 1, '2024-04-26'),
(10, 14, 6, 1, '2024-05-02'),
(11, 19, 9, 1, '2024-05-02'),
(12, 19, 9, 6, '2024-05-03'),
(13, 19, 11, 1, '2024-05-03'),
(14, 19, 11, 1, '2024-05-07'),
(15, 19, 11, 2, '2024-05-08'),
(16, 19, 11, 2, '2024-05-10'),
(17, 19, 9, 4, '2024-05-13'),
(18, 19, 9, 1, '2024-05-14'),
(19, 19, 9, 1, '2024-05-16'),
(20, 19, 9, 1, '2024-05-31'),
(21, 19, 12, 1, '2024-05-31'),
(22, 19, 9, 1, '2024-06-04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(25) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `mandrill_settings` text NOT NULL,
  `smtp_settings` text NOT NULL,
  `support_email` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `site_settings`
--

INSERT INTO `site_settings` (`id`, `user_id`, `site_name`, `site_logo`, `site_favicon`, `mandrill_settings`, `smtp_settings`, `support_email`, `date_updated`) VALUES
(1, 1, 'Hoogli Pages', 'assets/images/0562f16318_1.jpg', 'assets/images/bc00d255f3_1.png', '', '', 'admin@hoogli.com.br', '2024-02-23 10:52:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tbl_countries`
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
-- Estrutura para tabela `usertbl`
--

CREATE TABLE `usertbl` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pic` text NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_type` tinyint(4) NOT NULL COMMENT '1-Admin,2-Users,3-Team Member, 4-Client, 5-Reseller, 6-desginer',
  `u_status` tinyint(4) NOT NULL COMMENT '1-Active,2-InActive,3-Suspicious, 4-none-Suspicious',
  `u_plan` text NOT NULL,
  `is_parent` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'User id of TeamMember/Client/Reseller account',
  `u_purchaseddate` datetime NOT NULL,
  `u_profile_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `usertbl`
--

INSERT INTO `usertbl` (`u_id`, `u_name`, `u_email`, `u_pic`, `u_password`, `u_type`, `u_status`, `u_plan`, `is_parent`, `parent_id`, `u_purchaseddate`, `u_profile_details`) VALUES
(1, 'Admin', 'admin@hoogli.com.br', 'uploads/profile_img/profile_11.jpg', 'e6e061838856bf47e1de730719fb2609', 1, 1, '', 0, 0, '0000-00-00 00:00:00', '{\"ppa_uname\":\"Admin\",\"ppa_number\":null,\"ppa_address\":null,\"ppa_city\":null,\"ppa_state\":null,\"ppa_zipcode\":null,\"ppa_country\":null}'),
(14, 'Demo User', 'user@hoogli.com.br', 'uploads/profile_img/profile_14.jpg', 'e6e061838856bf47e1de730719fb2609', 2, 1, '', 0, 0, '2023-10-12 06:44:42', '{\"ppa_uname\":\"Demo User\",\"ppa_number\":\"+91-98765432\",\"ppa_address\":\"21 MT street\",\"ppa_city\":\"Queens\",\"ppa_state\":\"NY\",\"ppa_zipcode\":\"540-263\",\"ppa_country\":\"Brazil\"}'),
(19, 'evolua', 'veladorisz@gmail.com', '', '134b56ed1b01d1588d36b26790e00aff', 2, 1, '', 0, 0, '2024-04-22 08:33:54', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_campaigns`
--

CREATE TABLE `user_campaigns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `template_name` varchar(225) NOT NULL,
  `campaign_host_name` varchar(255) NOT NULL,
  `template_thumbnail` varchar(225) NOT NULL,
  `email_setting` text NOT NULL,
  `custom_css` longtext NOT NULL,
  `custom_js` longtext NOT NULL,
  `template_html` longtext NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `template_settings` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `user_campaigns`
--

INSERT INTO `user_campaigns` (`id`, `user_id`, `temp_id`, `template_name`, `campaign_host_name`, `template_thumbnail`, `email_setting`, `custom_css`, `custom_js`, `template_html`, `created_date`, `status`, `template_settings`) VALUES
(6, 14, 162, 'Online Course', 'teste', 'uploads/template_zips/template_thumnails/1696846700_thumbnail_.png', '', '', '', '/uploads/sites/user_14/1713357050.html', '2024-04-17 09:30:50', 1, ''),
(9, 19, 157, 'evolua', 'evolua', 'uploads/template_zips/template_thumnails/1696419295_thumbnail_.png', '', '', '', '/uploads/sites/user_19/1713786504.html', '2024-04-22 08:48:24', 1, ''),
(11, 19, 115, 'Balmee', 'balmee', 'uploads/template_zips/template_thumnails/1694523893_thumbnail_115.jpg', '{\"auto_email\":{\"confirmation\":\"NO\",\"welcome\":\"NO\"},\"autoresponder\":{\"visible\":\"NO\",\"name\":\"\",\"list\":\"\"}}', '', '', '/uploads/sites/user_19/1714747441.html', '2024-05-03 11:44:01', 1, ''),
(12, 19, 157, 'Dentists', '', 'uploads/template_zips/template_thumnails/1696419295_thumbnail_.png', '', '', '', '/uploads/sites/user_19/1717172981.html', '2024-05-31 13:29:41', 1, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ar_form_data`
--
ALTER TABLE `ar_form_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `autoresponder`
--
ALTER TABLE `autoresponder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_id` (`user_id`);

--
-- Índices de tabela `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dfy_templates`
--
ALTER TABLE `dfy_templates`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagelibrary`
--
ALTER TABLE `imagelibrary`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payment_integration`
--
ALTER TABLE `payment_integration`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `plans_list`
--
ALTER TABLE `plans_list`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `site_analytics`
--
ALTER TABLE `site_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`u_id`);

--
-- Índices de tabela `user_campaigns`
--
ALTER TABLE `user_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ar_form_data`
--
ALTER TABLE `ar_form_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `autoresponder`
--
ALTER TABLE `autoresponder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `dfy_templates`
--
ALTER TABLE `dfy_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de tabela `imagelibrary`
--
ALTER TABLE `imagelibrary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de tabela `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `payment_integration`
--
ALTER TABLE `payment_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `plans_list`
--
ALTER TABLE `plans_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `site_analytics`
--
ALTER TABLE `site_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de tabela `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `user_campaigns`
--
ALTER TABLE `user_campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
