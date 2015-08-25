-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2015 年 8 月 25 日 12:49
-- サーバのバージョン： 5.5.38-log
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop_area_wiki`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `blocks`
--

CREATE TABLE `blocks` (
`id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `block_id` int(11) DEFAULT NULL,
  `x-coordinate` int(11) NOT NULL,
  `y-coordinate` int(11) NOT NULL,
  `can_pass` tinyint(1) DEFAULT '0',
  `name` varchar(60) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `floors`
--

CREATE TABLE `floors` (
`id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
`id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `prefecture` varchar(8) NOT NULL,
  `street_address` varchar(100) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
