-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dibimbing-shop
CREATE DATABASE IF NOT EXISTS `dibimbing-shop` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `dibimbing-shop`;

-- Dumping structure for table dibimbing-shop.about_us
CREATE TABLE IF NOT EXISTS `about_us` (
  `about_id` int(10) NOT NULL AUTO_INCREMENT,
  `about_heading` text NOT NULL,
  `about_short_desc` text NOT NULL,
  `about_desc` text NOT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.about_us: ~0 rows (approximately)
INSERT INTO `about_us` (`about_id`, `about_heading`, `about_short_desc`, `about_desc`) VALUES
	(1, 'About Us - Our Story', '\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,\r\n', 'Rhone was the collective vision of a small group of weekday warriors. For years, we were frustrated by the lack of activewear designed for men and wanted something better. With that in mind, we set out to design premium apparel that is made for motion and engineered to endure.\r\n\r\nAdvanced materials and state of the art technology are combined with heritage craftsmanship to create a new standard in activewear. Every product tells a story of premium performance, reminding its wearer to push themselves physically without having to sacrifice comfort and style.\r\n\r\nBeyond our product offering, Rhone is founded on principles of progress and integrity. Just as we aim to become better as a company, we invite men everywhere to raise the bar and join us as we move Forever Forward.');

-- Dumping structure for table dibimbing-shop.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_country` text NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  `admin_about` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.admins: ~0 rows (approximately)
INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`, `admin_contact`, `admin_country`, `admin_job`, `admin_about`) VALUES
	(2, 'Administrator', 'fahmi@cakrawala.ac.id', 'admindibimbing', 'user-profile-min.png', '7777775500', 'Indonesia', 'Front-End Developer', '   Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical   ');

-- Dumping structure for table dibimbing-shop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `type` text NOT NULL,
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.cart: ~2 rows (approximately)
INSERT INTO `cart` (`p_id`, `ip_add`, `qty`, `p_price`, `type`) VALUES
	(17, '::1', 1, '12000000', 'Brand New'),
	(1, '::1', 1, '12000000', 'Brand New');

-- Dumping structure for table dibimbing-shop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  `cat_top` text NOT NULL,
  `cat_image` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.categories: ~3 rows (approximately)
INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_top`, `cat_image`) VALUES
	(6, 'Handphone', 'no', 'hp.png'),
	(10, 'Laptop', '', 'laptop.png'),
	(11, 'Personal Computer', 'no', 'PC.png'),
	(12, 'Tablet', 'yes', 'Tablet.png');

-- Dumping structure for table dibimbing-shop.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_limit` int(100) NOT NULL,
  `coupon_used` int(100) NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.coupons: ~0 rows (approximately)
INSERT INTO `coupons` (`coupon_id`, `product_id`, `coupon_title`, `coupon_price`, `coupon_code`, `coupon_limit`, `coupon_used`) VALUES
	(7, 17, 'test', '10000', '123', 1, 1);

-- Dumping structure for table dibimbing-shop.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_confirm_code` text NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.customers: ~4 rows (approximately)
INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`, `customer_confirm_code`) VALUES
	(10, 'mi', 'fahmi@cakrawala.ac.id', '123', '123', '123', '123', '123', '', '192.168.50.168', '1737477381'),
	(11, 'fahmi', 'rezafahmialviandy@gmail.com', 'NT5Bbhtc', '', '', '', '', '', '', '971651286'),
	(12, 'reza fahmi alviand', 'korezsyndicate5@gmail.com', '9xy3XYFd', 'Indonesia', 'South Jakarta', '085894610828', 'Jl. Kemang Timur No.1, RT.14/RW.8, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510', 'Screenshot_22-10-2024_195515_logo.com.jpeg', '', '1102591972'),
	(14, 'Faiq', 'faiq@dibimbing.id', 'DE0eiNj2', '', '', '', '', '', '', '1105510085'),
	(15, 'regi', 'regi@gmail.com', 'regi', '', '', '', '', 'newsCover_2023_7_27_1690442617847-p3oo3l.jpeg', '', '1576032216');

-- Dumping structure for table dibimbing-shop.customer_orders
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(50) NOT NULL DEFAULT '',
  `due_amount` varchar(50) NOT NULL DEFAULT '',
  `invoice_no` int(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `type` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.customer_orders: ~17 rows (approximately)
INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `qty`, `type`, `order_date`, `order_status`) VALUES
	(1, '15', '5000000', 1095483926, 1, 'Brand New', '2025-04-29 09:04:26', 'Complete'),
	(2, '15', '12000000', 1702040232, 1, 'Brand New', '2025-04-29 08:47:57', 'Complete'),
	(3, '15', '24000000', 353029044, 2, 'Brand New', '2025-04-29 05:07:32', 'pending'),
	(4, '15', '5000000', 884970563, 1, 'Brand New', '2025-04-29 09:12:10', 'Complete'),
	(5, '15', '12000000', 2098853808, 1, 'Brand New', '2025-04-29 05:26:46', 'Complete'),
	(6, '15', '5000000', 527499177, 1, 'Brand New', '2025-04-29 05:14:19', 'Complete'),
	(7, '15', '5000000', 315602116, 1, 'Brand New', '2025-04-29 08:57:25', 'Complete'),
	(8, '15', '12000000', 315602116, 1, 'Brand New', '2025-04-29 08:57:54', 'Complete'),
	(9, '15', '5000000', 1146843173, 1, 'Brand New', '2025-04-29 08:52:42', 'Complete'),
	(10, '15', '5000000', 1513107139, 1, 'Brand New', '2025-04-29 07:01:45', 'Complete'),
	(11, '15', '5000000', 58015310, 1, 'Brand New', '2025-04-29 07:01:19', 'Complete'),
	(12, '15', '5000000', 630020942, 1, 'Brand New', '2025-04-29 07:00:47', 'Complete'),
	(13, '15', '12000000', 1271947711, 1, 'Brand New', '2025-04-29 06:59:16', 'Complete'),
	(14, '15', '12000000', 1106147207, 1, 'Brand New', '2025-04-29 08:49:54', 'Complete'),
	(15, '15', '7500000', 1655372190, 1, 'Brand New', '2025-05-23 04:24:38', 'pending'),
	(16, '15', '22500000', 1655372190, 3, 'Brand New', '2025-05-23 04:24:38', 'pending'),
	(17, '15', '12000000', 384586711, 1, 'Brand New', '2025-05-23 04:25:27', 'pending');

-- Dumping structure for table dibimbing-shop.enquiry_types
CREATE TABLE IF NOT EXISTS `enquiry_types` (
  `enquiry_id` int(10) NOT NULL AUTO_INCREMENT,
  `enquiry_title` varchar(255) NOT NULL,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.enquiry_types: ~3 rows (approximately)
INSERT INTO `enquiry_types` (`enquiry_id`, `enquiry_title`) VALUES
	(1, 'Order and Delivery Support'),
	(2, 'Technical Support'),
	(3, 'Price Concern');

-- Dumping structure for table dibimbing-shop.manufacturers
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(10) NOT NULL AUTO_INCREMENT,
  `manufacturer_title` text NOT NULL,
  `manufacturer_image` text NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.manufacturers: ~6 rows (approximately)
INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_title`, `manufacturer_image`) VALUES
	(9, 'Lenovo', 'pngwing.com (4).png'),
	(10, 'Apple', 'pngwing.com (6).png'),
	(11, 'Oppo', 'pngwing.com.png'),
	(12, 'Vivo', 'pngwing.com (3).png'),
	(13, 'Hp', 'pngwing.com (2).png'),
	(14, 'Asus', 'pngwing.com (1).png'),
	(15, 'Xiaomi', 'Xiaomi.png');

-- Dumping structure for table dibimbing-shop.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `payment_date` text NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.payments: ~17 rows (approximately)
INSERT INTO `payments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `ref_no`, `code`, `payment_date`) VALUES
	(14, 527499177, 0, 'Bank Code', 123, 123, '2025-04-29 12:11:47'),
	(15, 2098853808, 0, 'UBL/Omni', 123, 123, '2025-04-29 12:10:40'),
	(16, 1271947711, 0, 'Bank Code', 123, 123, '2025-04-29 13:59:05'),
	(17, 1271947711, 0, 'Bank Code', 123, 123, '2025-04-29 13:59:05'),
	(18, 630020942, 0, 'Bank Code', 123, 123, '2025-04-29 13:57:57'),
	(19, 630020942, 0, 'Bank Code', 123, 123, '2025-04-29 13:57:57'),
	(20, 58015310, 0, 'Bank Code', 123, 123, '2025-04-29 13:56:20'),
	(21, 58015310, 0, 'Bank Code', 123, 123, '2025-04-29 13:56:20'),
	(22, 1513107139, 0, 'Bank Code', 123, 123, '2025-04-29 12:30:38'),
	(23, 1702040232, 0, 'Bank Code', 123, 123, '2025-04-29 12:05:50'),
	(24, 1106147207, 0, 'Bank Code', 123, 123, '2025-04-29 14:26:30'),
	(25, 1702040232, 0, 'Bank Code', 123, 123, '2025-04-29 12:05:50'),
	(26, 1146843173, 0, 'Bank Code', 123, 123, '2025-04-29 12:28:49'),
	(27, 315602116, 5000000, 'Bank Code', 123, 123, '2025-04-29'),
	(28, 315602116, 12000000, 'UBL/Omni', 123, 123, '2025-04-29'),
	(29, 1106147207, 0, 'Bank Code', 123, 123, ''),
	(30, 1095483926, 5000000, 'UBL/Omni', 123, 123, '2025-04-24'),
	(31, 884970563, 5000000, 'UBL/Omni', 123, 123, '2025-04-29');

-- Dumping structure for table dibimbing-shop.pending_orders
CREATE TABLE IF NOT EXISTS `pending_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `invoice_no` varchar(50) NOT NULL DEFAULT '',
  `product_id` text NOT NULL,
  `qty` int(10) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.pending_orders: ~17 rows (approximately)
INSERT INTO `pending_orders` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `type`, `order_status`) VALUES
	(12, 15, '1095483926', '18', 1, 'Brand New', 'Complete'),
	(13, 15, '1702040232', '17', 1, 'Brand New', 'Complete'),
	(14, 15, '353029044', '17', 2, 'Brand New', 'Complete'),
	(15, 15, '884970563', '18', 1, 'Brand New', 'pending'),
	(16, 15, '2098853808', '17', 1, 'Brand New', 'pending'),
	(17, 15, '527499177', '18', 1, 'Brand New', 'pending'),
	(18, 15, '315602116', '18', 1, 'Brand New', 'pending'),
	(19, 15, '315602116', '17', 1, 'Brand New', 'pending'),
	(20, 15, '1146843173', '18', 1, 'Brand New', 'pending'),
	(21, 15, '1513107139', '18', 1, 'Brand New', 'pending'),
	(22, 15, '58015310', '18', 1, 'Brand New', 'pending'),
	(23, 15, '630020942', '18', 1, 'Brand New', 'pending'),
	(24, 15, '1271947711', '17', 1, 'Brand New', 'pending'),
	(25, 15, '1106147207', '17', 1, 'Brand New', 'pending'),
	(26, 15, '1655372190', '4', 1, 'Brand New', 'pending'),
	(27, 15, '1655372190', '11', 3, 'Brand New', 'pending'),
	(28, 15, '384586711', '3', 1, 'Brand New', 'pending');

-- Dumping structure for table dibimbing-shop.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_cat_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `manufacturer_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `product_url` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_psp_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_features` text NOT NULL,
  `product_video` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_label` text NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.products: ~3 rows (approximately)
INSERT INTO `products` (`product_id`, `p_cat_id`, `cat_id`, `manufacturer_id`, `date`, `product_title`, `product_url`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_psp_price`, `product_desc`, `product_features`, `product_video`, `product_keywords`, `product_label`, `status`) VALUES
	(3, 6, 6, 11, '2025-05-21 08:43:58', ' OPPO Find N5 - Foldable Handphone', 'oppo-find-n5', '97959bb1-f9bd-4ea4-9f40-615a3963a5fb.jpg.webp', 'ff5d729d-1dbf-465a-a497-5c1f55733477.jpg', '3160c922-d38b-47a3-9a47-3206f1305203.jpg', 12000000, 12000000, '', '', '', 'oppo-find-n5', 'Oppo Find N5', 'product'),
	(10, 6, 6, 12, '2025-05-21 10:02:55', 'vivo V50 5G Rounded-edge Design', 'vivo-v50', '4683e613838c4a9e8b0c0c955ce1575e~.jpeg.jpg', '19670cb2032347ebae0ba78373dd2979~.jpeg.jpg', 'd1f89617733b4aba9040dcc57ed7afb0~.jpeg.jpg', 5000000, 5000000, '', '', '', 'vivo-v50', 'Vivo V50', 'product'),
	(11, 6, 6, 15, '2025-05-21 10:03:46', 'Poco F7 Pro - Snapdragon 8 Gen 3', 'poco-f7-pro', '2d96d3dd-615a-4d90-8dab-c402c183fe72.jpg.webp', '1d785021-c94d-47c8-aff3-8cc0e82ade74.jpg', 'a07e3f75-ee2e-4465-925c-f695f0c79b99.jpg', 7500000, 7500000, '', '', '', 'poco-f7-pro', 'Poco F7 Pro', 'product');

-- Dumping structure for table dibimbing-shop.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `p_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_cat_title` text NOT NULL,
  `p_cat_top` text NOT NULL,
  `p_cat_image` text NOT NULL,
  PRIMARY KEY (`p_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.product_categories: ~0 rows (approximately)

-- Dumping structure for table dibimbing-shop.store
CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(10) NOT NULL AUTO_INCREMENT,
  `store_title` varchar(255) NOT NULL,
  `store_image` varchar(255) NOT NULL,
  `store_desc` text NOT NULL,
  `store_button` varchar(255) NOT NULL,
  `store_url` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.store: ~3 rows (approximately)
INSERT INTO `store` (`store_id`, `store_title`, `store_image`, `store_desc`, `store_button`, `store_url`) VALUES
	(4, 'London Store', '1.jpg', '\r\n\r\n<p style="text-align: center;"><strong>180-182 RECENTS STREET, LONDON, W1B 5BT</strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut libero erat, aliquet eget mauris ut, dictum sagittis libero. Nam at dui dapibus, semper dolor ac, malesuada mi. Duis quis lobortis arcu. Vivamus sed sodales orci, non varius dolor.</p>\r\n\r\n', 'View Map', 'https://maps.app.goo.gl/ZWbW9PUSUW6UB76h6'),
	(5, 'New York Store', '4.jpg', '\r\n\r\n<p style="text-align: center;"><strong>109 COLUMBUS CIRCLE, NEW YORK, NY10023</strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut libero erat, aliquet eget mauris ut, dictum sagittis libero. Nam at dui dapibus, semper dolor ac, malesuada mi. Duis quis lobortis arcu. Vivamus sed sodales orci, non varius dolor.</p>\r\n\r\n', 'View Map', 'https://maps.app.goo.gl/Qaf19853MnStcSbw9'),
	(6, 'Paris Store', '3.jpg', '\r\n\r\n<p style="text-align: center;"><strong>2133 RUE SAINT-HONORE, 75001 PARIS </strong></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut libero erat, aliquet eget mauris ut, dictum sagittis libero. Nam at dui dapibus, semper dolor ac, malesuada mi. Duis quis lobortis arcu. Vivamus sed sodales orci, non varius dolor.</p>\r\n\r\n', 'View Map', 'https://maps.app.goo.gl/CxiVRwgfSQdP5HRN6');

-- Dumping structure for table dibimbing-shop.terms
CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` int(10) NOT NULL AUTO_INCREMENT,
  `term_title` varchar(100) NOT NULL,
  `term_link` varchar(100) NOT NULL,
  `term_desc` text NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.terms: ~3 rows (approximately)
INSERT INTO `terms` (`term_id`, `term_title`, `term_link`, `term_desc`) VALUES
	(1, 'Rules And Regulations', 'rules', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.&nbsp;</p>'),
	(2, 'Refund Policy', 'link2', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on'),
	(3, 'Pricing and Promotions Policy', 'link3', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on');

-- Dumping structure for table dibimbing-shop.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlist_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dibimbing-shop.wishlist: ~6 rows (approximately)
INSERT INTO `wishlist` (`wishlist_id`, `customer_id`, `product_id`) VALUES
	(2, 2, 8),
	(3, 5, 13),
	(4, 3, 13),
	(5, 6, 15),
	(6, 14, 16),
	(8, 15, 17);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
