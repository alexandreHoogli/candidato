-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 07:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

--
-- Table update for table `plans_list`
--

ALTER TABLE `plans_list`
ADD `p_templates` text NOT NULL DEFAULT '[]',
ADD `p_sites` int NOT NULL;

--
-- Table update for table `site_settings`
--

ALTER TABLE `site_settings`
ADD `mandrill_settings` text COLLATE utf8mb4_general_ci NOT NULL,
ADD `smtp_settings` text COLLATE utf8mb4_general_ci NOT NULL,
ADD `support_email` text COLLATE utf8mb4_general_ci NOT NULL,
ADD `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
