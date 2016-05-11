-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 11, 2016 at 05:09 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hamsterusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `image_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `lastname`, `firstname`, `birthdate`, `image_file`, `image_name`) VALUES
(1, 'Manapyzz', 'manapyzz', 'manapyzz@gmail.com', 'manapyzz@gmail.com', 1, '3b011va4is00w4owooso0w0c44cc880', '$2y$13$3b011va4is00w4owooso0u85Pa7xRoWsqE6cs8MrzGmAhGFty0kby', '2016-05-11 16:47:22', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'PICARD', 'Alexandre', '1995-07-06', '/Users/AlexPMac/OneDriveBusiness/Web Developer/Cours/Web development/AllGitHubProjects/HamsterHubProject/HamsterHubProject/app/../web/assets/images//defaultImage.png', 'Default Image'),
(2, 'Lulus', 'lulus', 'lulus@gmail.com', 'lulus@gmail.com', 1, 'sk0m2b57vbkckwgs8wgc444g04gww8o', '$2y$13$sk0m2b57vbkckwgs8wgc4uyMsa7RayNyjEwHzz2pGKk6f.pNgWrmW', '2016-05-11 17:05:15', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'MAILLY', 'Antoine', '1994-06-14', '/Users/AlexPMac/OneDriveBusiness/Web Developer/Cours/Web development/AllGitHubProjects/HamsterHubProject/HamsterHubProject/app/../web/assets/images//defaultImage.png', 'Default Image'),
(3, 'Bloublou', 'bloublou', 'bloublou@bloblo.com', 'bloublou@bloblo.com', 1, 'grn5xrm60bccgssskw8kksos40w84sk', '$2y$13$grn5xrm60bccgssskw8kkeYCEV0/oMAvuyxDkGeG/p9kLNCq/eFyu', '2016-05-11 16:47:00', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'PICARD', 'Alexandre', '1924-11-03', '/Users/AlexPMac/OneDriveBusiness/Web Developer/Cours/Web development/AllGitHubProjects/HamsterHubProject/HamsterHubProject/app/../web/assets/images//defaultImage.png', 'Default Image');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;