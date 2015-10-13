-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2015 年 10 月 13 日 16:29
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `blocks`
--

INSERT INTO `blocks` (`id`, `shop_id`, `floor_id`, `block_id`, `x-coordinate`, `y-coordinate`, `can_pass`, `name`, `comment`, `color`, `created`, `modified`) VALUES
(1, 2, 1, NULL, 1, 1, 0, '本', 'テストコメント', NULL, NULL, NULL),
(2, 2, 1, NULL, 1, 2, 0, '本', 'テストコメント', NULL, NULL, NULL),
(3, 2, 1, NULL, 2, 2, 0, '本', 'テストコメント', NULL, NULL, NULL),
(4, 2, 1, NULL, 3, 2, 0, '本', 'テストコメント', NULL, NULL, NULL),
(5, 2, 1, NULL, 2, 1, 0, '味', 'テストコメント', NULL, NULL, NULL),
(6, 2, 1, NULL, 3, 1, 0, '本', 'テストコメント', NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `floors`
--

INSERT INTO `floors` (`id`, `shop_id`, `name`, `created`, `modified`) VALUES
(1, 2, 'イオン内原1階', NULL, NULL),
(2, 2, 'イオン内原2階', NULL, NULL),
(3, 50, 'イオン東根1階', NULL, NULL);

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
  `category` varchar(20) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `name`, `postal_code`, `prefecture`, `street_address`, `category`, `comment`, `created`, `modified`) VALUES
(1, 'イオンつくば店', '321-1111', '茨城県', 'つくば市天王台', '大型デパート', 'なんでもうっている', NULL, NULL),
(2, 'イオン 内原', '213-1212', '茨城県', '水戸市内原', 'デパート', 'でかい！', '2015-08-26 10:12:05', '2015-08-26 10:12:05'),
(50, 'イオン東根店', '999-3720', '山口県', '東根市 さくらんぼ駅前三丁目', '大型デパート', '駅前です', '2015-08-27 13:29:50', '2015-08-27 13:29:50'),
(57, 'イーアスつくば', '305-0817', '茨城県', 'つくば市 研究学園５丁目１９番', 'デパート', 'すべてのあなたに、良い明日を。"をコンセプトにお客さまの暮らしを豊かにするモノ・コト・サービスをご提供します。', '2015-08-30 17:08:23', '2015-08-30 17:08:23'),
(58, 'テスト', 'where', '茨城県', 'd', 'sdfs', 's', '2015-10-09 15:27:09', '2015-10-09 15:27:09');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
