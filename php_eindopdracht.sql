-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2024 at 10:34 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_eindopdracht`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `email`, `password`, `password_token`, `datetime`) VALUES
(1, 'kaas@kaas.nl', '$2y$10$BG1XTQDMKX6ucdBOnY2AQubZdw99.Jyz/f5ozjpiyKpkFZWSyU2G6', NULL, '2023-11-15 09:30:47'),
(2, 'hallo@hallo.nl', '$2y$10$HPjmm1hhog2Wd7Y9Oj7A7e6Ez1XZHhBSs192Yw5mgINLJVS920mAq', NULL, '2023-11-15 09:38:35'),
(3, 'Nike@site.nl', '$2y$10$8UWbAOge8Z4m05IsmdSJS./FVXdjz3LiOl9zgwcfay.Os6lofZip.', NULL, '2023-11-15 09:43:19'),
(4, 'rowan@rowan.nl', '$2y$10$tGYAd6O8cvFyOvwGSbqkDe440VRzeqXo13WJDt.EqQkMPy3YDgN3q', NULL, '2023-11-15 10:01:33'),
(5, 'glu@glu.nl', '$2y$10$ZKUNartpwcrdjdIqBUH9qeai20wxXwVpR92/N4ZLPEVn/bYr.n5..', NULL, '2023-11-15 10:12:48'),
(6, 'glu@glu.nl', '$2y$10$oiVFdg2mATJRwe4jtL6MAuBBmwzF.ibHOsoy4R28DJU8U2XXs/0ui', NULL, '2023-11-15 10:13:12'),
(7, 'erik@erik.nl', '$2y$10$h/qNoQ3xBJ.4M6LxEIg1guPuiMCqMvlh1vru0ipmK1Jl6Md2HG7lK', NULL, '2023-11-15 10:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `image_uuid` varchar(255) NOT NULL,
  `project_about` text NOT NULL,
  `project_link` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL,
  `project_about_long` text NOT NULL,
  `type_project` varchar(50) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_image`, `image_uuid`, `project_about`, `project_link`, `github_link`, `project_about_long`, `type_project`, `year`) VALUES
(1, 'dummy project 1', '../assets/images/655dc06b61936.jpg', '655dc06b61936', 'dummy project 1', 'seanneerings.nl/dummy', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project long 1', 'php', '2020'),
(2, 'dummy project 2', '../assets/images/655dc07948fa4.jpg', '655dc07948fa4', 'dummy project 2', 'seanneerings.nl/dummyproject', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project 2 long', 'react', '2021'),
(3, 'dummy project 3', 'dummy_project_3', '0', 'dummy project 3', 'seanneerings.nl/dummyproject', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project 3 long', 'php', '2022'),
(4, 'dummy project 4', 'dummy_project_4', '0', 'dummy project 4', 'seanneerings.nl/dummyproject', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project 4 long', 'javascript', '2023'),
(5, 'dummy project 5', 'dummy_project_5', '0', 'dummy project 5', 'seanneerings.nl/dummyproject', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project 5 long', 'react', '2021'),
(6, 'dummy project 6', 'dummy_project_6', '0', 'dummy project 6', 'seanneerings.nl/dummyproject', 'https://github.com/SeanNeerings/Php_eindopdracht', 'dummy project 6 long', 'Vue', '2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
