-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 11:29 PM
-- Server version: 11.4.0-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentacar`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `driver_license` int(10) NOT NULL,
  `birth_date` date NOT NULL,
  `role_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `driver_license`, `birth_date`, `role_id`) VALUES
(1, 'Keith ', 'Johnson', 'keith.johnson@gmail.com', '', '(508) 839-9757', 14785266, '1994-05-14', 2),
(3, 'Sara ', 'James', 'sara.james@gmail.com', '', '973-810-3610', 17785266, '1980-03-18', 2),
(4, 'Philip ', 'Rogers', 'philip.rogers@gmail.com', '', ' 865-755-3635', 24785266, '1977-11-28', 2),
(5, 'Maria ', 'Perry', 'maria.perry@gmail.com', 'e4baedb51d8bfdd71f48c54340b988ae', '336-557-7172', 14789896, '1999-01-27', 1),
(6, 'Ilija', 'Antanasijevic', 'ilija0125@gmail.com', '', 'none', 0, '2003-01-25', 1),
(7, 'Iksa', 'Antanasijevic', 'ilija@gmail.com', 'e4baedb51d8bfdd71f48c54340b988aepsw', '147-888-9696', 52148545, '2004-04-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `job_type` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `avatar_src` varchar(255) NOT NULL,
  `boss` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `job_type`, `address`, `email`, `phone`, `avatar_src`, `boss`) VALUES
(1, 'Walter', 'Butler', 'Seller', '9323 Washington St\r\nRomulus', 'walter.butler@gmail.com', '(734) 992-3455', 'team-1.jpg', 3),
(2, 'Ann ', 'Jenkins', 'Manager', 'Homestead Liberty, North Carolina', 'ann.jenkins@gmail.com', '(336) 565-4994', 'team-2.jpg', 3),
(3, 'Kevin ', 'Baker', 'Boss', '20 Rosenwald Rd Society', 'kevin.baker@gmail.com', '(843) 378-0301', 'team-3.jpg', NULL),
(4, 'Richard ', 'Russell', 'Software Developer', 'W Hudson St Long Beach NY', 'richard.russell@gmail.com', '(509) 279-0704', 'team-4.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `img_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `active`, `img_id`) VALUES
(1, 1, 20),
(2, 1, 21),
(3, 1, 22),
(4, 1, 23),
(5, 1, 24),
(6, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(255) NOT NULL,
  `img_src` varchar(100) NOT NULL,
  `alt` varchar(70) NOT NULL,
  `date_add` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_src`, `alt`, `date_add`) VALUES
(1, 'test.jpg', 'test', '2024-03-28'),
(2, 'test.jpg', 'test.jpg', '2024-03-28'),
(3, 'test.jpg', 'test.jpg', '2024-03-28'),
(4, 'test.jpg', 'test.jpg', '2024-03-28'),
(5, 'test.jpg', 'test.jpg', '2024-03-28'),
(6, 'test.jpg', 'test.jpg', '2024-03-28'),
(7, '6605e97735de8.png', 'Merecedes C Class', '2024-03-28'),
(8, '6605e997e0374.png', 'Mercedes CLS 63', '2024-03-28'),
(9, '6605e9d301173.png', 'BMW m4 Coupe', '2024-03-28'),
(10, '6605ea391daba.png', 'Audi R8', '2024-03-28'),
(11, '6605ea58b3b48.png', 'Audi V13 Tuning', '2024-03-28'),
(12, '6605ea9537cfd.png', 'Mercedes AMG GLC', '2024-03-28'),
(13, '6605eaba66a72.png', 'BMW X6', '2024-03-28'),
(14, '6605eadea4a45.png', 'Merecedes C Class', '2024-03-28'),
(15, '6605eb09ebe33.png', 'Audi R8', '2024-03-28'),
(16, '6605eb6de5d17.png', 'Jaguar XJ', '2024-03-28'),
(17, '6605ebbc7bce9.png', 'Mercedes-Benz AMG', '2024-03-28'),
(18, '6605ebff91307.png', 'Volkswagen Phideon', '2024-03-28'),
(19, '6605ec22d62ba.png', 'BMW M2', '2024-03-28'),
(20, 'gallery-1.jpg', 'gallery1', '2024-03-28'),
(21, 'gallery-2.jpg', 'gallery2', '2024-03-28'),
(22, 'gallery-3.jpg', 'gallery3', '2024-03-28'),
(23, 'gallery-4.jpg', 'gallery4', '2024-03-28'),
(24, 'gallery-5.jpg', 'gallery5', '2024-03-28'),
(25, 'gallery-6.jpg', 'gallery6', '2024-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mess_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(255) NOT NULL,
  `model_name` varchar(150) NOT NULL,
  `img_src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`, `img_src`) VALUES
(2, 'Mercedes', 'vendor-3.png'),
(3, 'BMW', 'vendor-7.png'),
(4, 'Nissan', 'vendor-6.png'),
(5, 'Jaguar', 'vendor-8.png'),
(6, 'Volkswagen ', 'vendor-1.png'),
(7, 'Audi', 'vendor-4.png'),
(8, 'Mercedes-Benz', '6605eb99b30ca.png');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id_nav` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(70) NOT NULL,
  `subname` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id_nav`, `name`, `path`, `subname`) VALUES
(1, 'Home', 'index.php', NULL),
(2, 'About', 'about.php', NULL),
(3, 'Service', 'service.php', NULL),
(4, 'Cars', '#', NULL),
(5, 'Pages', '#', NULL),
(6, 'The Team', 'team.php', 5),
(7, 'Testimonial', 'testimonial.php', 5),
(8, 'Contact', 'contact.php', NULL),
(9, 'Car Listing', 'car.php', 4),
(10, 'Car Booking', 'booking.php', 4);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `price`, `date`) VALUES
(1, 99.00, '2023-03-06'),
(2, 80.00, '2023-03-06'),
(3, 60.00, '2023-03-06'),
(4, 70.99, '2023-03-06'),
(5, 55.00, '2024-03-28'),
(6, 70.00, '2024-03-28'),
(7, 150.00, '2024-03-28'),
(8, 90.00, '2024-03-28'),
(9, 30.00, '2024-03-28'),
(10, 40.00, '2024-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime NOT NULL,
  `total_days` int(20) NOT NULL,
  `vehicle_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `price`, `total_price`, `message`, `start_date`, `end_date`, `total_days`, `vehicle_id`) VALUES
(1, 7, 30.00, 30.00, NULL, '2024-03-29 23:17:00', '2024-03-30 23:17:00', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviews_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `vehicle_id` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `avatar_src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviews_id`, `customer_id`, `vehicle_id`, `comment`, `active`, `date`, `avatar_src`) VALUES
(5, 5, 19, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ips', 0, '2024-03-28 23:20:54', 'testimonial-2.jpg'),
(6, 1, 13, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ips', 0, '2024-03-28 23:22:26', 'testimonial-3.jpg'),
(7, 4, 17, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ips', 0, '2024-03-28 23:23:17', 'testimonial-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(255) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(255) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `model_year` date NOT NULL,
  `gearshift` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `consuption` int(20) NOT NULL,
  `licencse_plate` varchar(100) NOT NULL,
  `model_id` int(255) NOT NULL,
  `price_id` int(255) NOT NULL,
  `img_id` int(255) DEFAULT NULL,
  `date_add` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`, `model_year`, `gearshift`, `description`, `consuption`, `licencse_plate`, `model_id`, `price_id`, `img_id`, `date_add`) VALUES
(7, 'Merecedes C Class', '2022-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 10, '65655892', 2, 2, 7, '2024-03-28'),
(8, 'Mercedes CLS 63', '2020-01-01', 'Manual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 20, '2658976', 2, 5, 8, '2024-03-28'),
(9, 'BMW m4 Coupe', '2019-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 20, '56872513', 3, 6, 9, '2024-03-28'),
(10, 'Audi R8', '2021-01-01', 'Manual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 25, '57475654', 7, 2, 10, '2024-03-28'),
(11, 'Audi V13 Tuning', '2019-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 40, '263595841', 7, 7, 11, '2024-03-28'),
(12, 'Mercedes AMG GLC', '2015-01-01', 'Manual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 25, '48745248', 2, 5, 12, '2024-03-28'),
(13, 'BMW X6', '2020-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 15, '65456559', 3, 6, 13, '2024-03-28'),
(14, 'Merecedes C Class', '2022-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 20, '69554565', 2, 8, 14, '2024-03-28'),
(15, 'Audi R8', '2021-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 25, '656589524', 7, 3, 15, '2024-03-28'),
(16, 'Jaguar XJ', '2013-01-01', 'Manual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 10, '6589787', 5, 9, 16, '2024-03-28'),
(17, 'Mercedes-Benz AMG', '2017-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 22, '56748765', 8, 3, 17, '2024-03-28'),
(18, 'Volkswagen Phideon', '2020-01-01', 'Manual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 15, '787855621', 6, 10, 18, '2024-03-28'),
(19, 'BMW M2', '2021-01-01', 'Automatic', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 30, '658787612', 3, 3, 19, '2024-03-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `emaiL_uniqu` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `driver_license` (`driver_license`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `boss` (`boss`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id_nav`),
  ADD KEY `subname` (`subname`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservation_id` (`reservation_id`,`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviews_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `gearshift_id` (`gearshift`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `price_id` (`price_id`),
  ADD KEY `img_id_FK` (`img_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mess_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id_nav` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviews_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`boss`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`);

--
-- Constraints for table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `navigation_ibfk_1` FOREIGN KEY (`subname`) REFERENCES `navigation` (`id_nav`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `model` (`model_id`),
  ADD CONSTRAINT `vehicle_ibfk_3` FOREIGN KEY (`price_id`) REFERENCES `price` (`price_id`),
  ADD CONSTRAINT `vehicle_ibfk_4` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
