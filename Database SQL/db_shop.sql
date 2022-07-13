 -- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2021 at 05:09 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `p_qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(56, 'Touch Screen Laptops'),
(55, 'Non-Touch Screen'),
(54, 'Macbooks'),
(52, 'Traditional Laptops'),
(51, 'Gaming Laptops');

-- --------------------------------------------------------

--
-- Table structure for table `locationw`
--

DROP TABLE IF EXISTS `locationw`;
CREATE TABLE IF NOT EXISTS `locationw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locationw`
--

INSERT INTO `locationw` (`id`, `name`, `street`, `city`, `phone`, `email`, `description`) VALUES
(2, 'umaar', 'Ullamco corporis at ', 'Ut voluptas natus ex', 21, 'kowamoca@mailinator.com', 'Quis recusandae Cul');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `shipping_address`, `total_price`, `status`) VALUES
(40, '57-10', 10, 'pewshwe', 450000, 1),
(42, '60-7', 16, 'Mardan Moqam CHock street no 12 House no 109', 343000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `p_name` varchar(500) NOT NULL,
  `p_description` varchar(5000) NOT NULL,
  `p_discount` int(200) NOT NULL,
  `p_price` int(100) NOT NULL,
  `quantity` int(199) NOT NULL,
  `p_colour` varchar(30) NOT NULL,
  `images` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time_stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `p_name`, `p_description`, `p_discount`, `p_price`, `quantity`, `p_colour`, `images`, `status`, `time_stamp`) VALUES
(59, 55, 32, 'HP 15-DW3024NIA Laptop - 11th Gen Intel Core i3, 4GB, 256GB SSD, Jet black', '&lt;ul&gt;\r\n	&lt;li&gt;11.6&amp;quot; HD LED Display (1366x768)&lt;/li&gt;\r\n	&lt;li&gt;Intel&amp;reg; Celeron&amp;reg; Processor N3050 - 6th generation&lt;/li&gt;\r\n	&lt;li&gt;Turbo Boost upto 3.3 GHz&lt;/li&gt;\r\n	&lt;li&gt;2GB DDR3 RAM&lt;/li&gt;\r\n	&lt;li&gt;32GB SSD&lt;/li&gt;\r\n	&lt;li&gt;Windows&amp;reg; 8 &amp;amp; 10 (Activated)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;For such an inexpensive laptop, the HP Stream 11 sure does pack a punch in terms of its outstanding appearance, enhanced battery life and amazing storage. This low cost laptop has been advertised as a Chromebook-like device that offers low-power online use that is paired with the outstanding performance of Windows 8.&lt;/p&gt;\r\n\r\n&lt;h3&gt;&lt;strong&gt;Basic features of HP Stream 11&lt;/strong&gt;&lt;/h3&gt;\r\n\r\n&lt;p&gt;Extremely cost-efficient, the laptops are cloud-friendly and come with a Microsoft Office 365 subscription and about 1TB of online storage for a year. The laptop features a low-resolution 11.6-inch display and has plenty of other features to boast of as well. For instance, it runs on an Intel Celeron processor, which, when paired with 2GB of RAM and 32GB of solid state drive, guarantees to deliver the best possible performance. If you think that you are running out of space on the laptop, you can go ahead and add another 16 or 32GB of space to your laptop through the included SD card slot.&lt;/p&gt;', 45000, 21999, 77, 'Black', '../../uploads/img_6139eabfd0bc2.jpeg,../../uploads/img_6139eabfd37bd.jpeg,../../uploads/img_6139eabfd3c4e.jpeg,../../uploads/img_6139eabfd4225.jpeg,../../uploads/img_6139eabfd458d.jpeg', 1, '2021-09-09 16:06:39'),
(58, 55, 32, 'HP Stream 11 11.6 Display - IntelÂ® CeleronÂ® Processor N3050 - 6th generation - 2GB RAM - 32GB SSD - WindowsÂ® 8 &amp; 10', '&lt;ul&gt;\r\n	&lt;li&gt;11.6&amp;quot; HD LED Display (1366x768)&lt;/li&gt;\r\n	&lt;li&gt;Intel&amp;reg; Celeron&amp;reg; Processor N3050 - 6th generation&lt;/li&gt;\r\n	&lt;li&gt;Turbo Boost upto 3.3 GHz&lt;/li&gt;\r\n	&lt;li&gt;2GB DDR3 RAM&lt;/li&gt;\r\n	&lt;li&gt;32GB SSD&lt;/li&gt;\r\n	&lt;li&gt;Windows&amp;reg; 8 &amp;amp; 10 (Activated)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;For such an inexpensive laptop, the HP Stream 11 sure does pack a punch in terms of its outstanding appearance, enhanced battery life and amazing storage. This low cost laptop has been advertised as a Chromebook-like device that offers low-power online use that is paired with the outstanding performance of Windows 8.&lt;/p&gt;\r\n\r\n&lt;h3&gt;&lt;strong&gt;Basic features of HP Stream 11&lt;/strong&gt;&lt;/h3&gt;\r\n\r\n&lt;p&gt;Extremely cost-efficient, the laptops are cloud-friendly and come with a Microsoft Office 365 subscription and about 1TB of online storage for a year. The laptop features a low-resolution 11.6-inch display and has plenty of other features to boast of as well. For instance, it runs on an Intel Celeron processor, which, when paired with 2GB of RAM and 32GB of solid state drive, guarantees to deliver the best possible performance. If you think that you are running out of space on the laptop, you can go ahead and add another 16 or 32GB of space to your laptop through the included SD card slot.&lt;/p&gt;', 70000, 59999, 100, 'Multicolor', '../../uploads/img_6139ea449982e.jpeg,../../uploads/img_6139ea4499bf5.jpeg,../../uploads/img_6139ea4499f52.jpeg,../../uploads/img_6139ea449e61b.jpeg,../../uploads/img_6139ea449ea48.jpeg', 1, '2021-09-09 16:04:36'),
(60, 52, 37, 'HP Envy X360 13M-BD0033DX 11th Gen Core i7, 8GB, 512GB NVMe M.2 SSD, 13.3â€³ FHD Touch, W10', '&lt;ul&gt;\r\n	&lt;li&gt;11th Generation Intel Core i7-1165G7&lt;/li&gt;\r\n	&lt;li&gt;8GB DDR4, 512GB NVMe M.2 SSD&lt;/li&gt;\r\n	&lt;li&gt;13.3&amp;Prime; FHD IPS Touch Screen, FPR&lt;/li&gt;\r\n	&lt;li&gt;13.3&amp;Prime; diagonal, FHD (1920 x 1080), multitouch-enabled, IPS.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Experience peace of mind, no matter where your day takes you. Light, powerful, and with smart security features &amp;ndash; the HP ENVY 13&amp;Prime; Laptop is built to empower life on-the-go.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;11th Generation Intel Core i7-1165G7&lt;/li&gt;\r\n	&lt;li&gt;8GB DDR4, 512GB NVMe M.2 SSD&lt;/li&gt;\r\n	&lt;li&gt;13.3&amp;Prime; FHD IPS Touch Screen, FPR&lt;/li&gt;\r\n	&lt;li&gt;13.3&amp;Prime; diagonal, FHD (1920 x 1080), multitouch-enabled, IPS.&lt;/li&gt;\r\n&lt;/ul&gt;', 59999, 49000, 200, 'Blue', '../../uploads/img_6139eb125eb3c.jpeg,../../uploads/img_6139eb1260f6b.jpeg,../../uploads/img_6139eb126158a.jpeg,../../uploads/img_6139eb1261e4f.jpeg,../../uploads/img_6139eb12620d8.jpeg', 1, '2021-09-09 16:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `review_stars` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `comments`, `review_stars`, `created_at`) VALUES
(19, 16, 60, 'comment', 5, '2021-09-09 11:44:47'),
(18, 16, 60, 'thid id reviewe', 4, '2021-09-09 11:40:07'),
(17, 10, 58, 'this isfmsdf', 2, '2021-09-09 11:38:55'),
(16, 10, 57, 'this is', 3, '2021-09-09 11:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sub_cat_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `sub_cat_name`) VALUES
(36, 52, 'Dell'),
(35, 54, 'Apple latest version'),
(29, 56, 'Hp'),
(30, 56, 'Haier'),
(31, 55, 'Dell'),
(32, 55, 'Hp'),
(33, 55, 'Haier'),
(34, 54, 'Apple'),
(28, 56, 'Dell'),
(37, 52, 'Hp'),
(38, 52, 'Haier'),
(39, 51, 'Dell'),
(41, 51, 'Hp'),
(42, 51, 'Haier'),
(43, 55, 'Dell');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `address`, `city`, `country`, `phone`, `password`, `role`) VALUES
(15, 'farooq', 'farooq', 'farooq@gmail.com', 'Charsadda', 'peshwar', 'pakistan', '02940343', '1234', 1),
(10, 'Umar FarooQ', 'umar123', 'umar@gmail.com', 'hayatabad', 'pesahwar', 'pakistan', '11122333', '123', 1),
(16, 'Nimra Noor', 'nimra123', 'nimra@gmail.com', 'Mardan Moqam CHock street no 12 House no 109', '', '', '0234784984', '12345', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
