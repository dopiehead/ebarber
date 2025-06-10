-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2025 at 10:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebarber`
--

-- --------------------------------------------------------

--
-- Table structure for table `barber_comment`
--

CREATE TABLE `barber_comment` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `barber_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barber_comment`
--

INSERT INTO `barber_comment` (`id`, `sender_email`, `sender_name`, `comment`, `barber_id`, `date`) VALUES
(1, 'john@example.com', 'John Doe', 'Great haircut, will come again!', 1, 'Mon, May 20, 2025 10:30AM'),
(2, 'sarah@example.com', 'Sarah Lee', 'Loved the service and friendly staff!', 2, 'Tue, May 21, 2025 11:00AM'),
(3, 'mike@example.com', 'Mike Ross', 'Barber was professional and skilled.', 3, 'Wed, May 22, 2025 09:45AM'),
(4, 'anna@example.com', 'Anna Kim', 'The ambiance was great. Highly recommended.', 4, 'Thu, May 23, 2025 02:15PM'),
(5, 'james@example.com', 'James Smith', 'Fast and clean cut. 5 stars!', 5, 'Fri, May 24, 2025 12:00PM'),
(6, 'emily@example.com', 'Emily Zhang', 'Not bad, but could be better.', 6, 'Sat, May 25, 2025 01:30PM'),
(7, 'david@example.com', 'David Brown', 'Superb attention to detail.', 7, 'Sun, May 26, 2025 04:20PM'),
(8, 'lucy@example.com', 'Lucy White', 'My kids loved their new haircuts!', 8, 'Mon, May 27, 2025 10:00AM');

-- --------------------------------------------------------

--
-- Table structure for table `barber_request`
--

CREATE TABLE `barber_request` (
  `id` int(11) NOT NULL,
  `barber_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `number_of_people_barber` int(11) NOT NULL,
  `barber_style` varchar(255) NOT NULL,
  `user_preference` enum('home_service','shop_owner') NOT NULL,
  `location` text NOT NULL,
  `pending` tinyint(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barber_request`
--

INSERT INTO `barber_request` (`id`, `barber_id`, `customer_id`, `number_of_people_barber`, `barber_style`, `user_preference`, `location`, `pending`, `date`) VALUES
(1, 3, 1, 1, 'The Executive', 'home_service', 'Lagos', 0, '2025-06-01'),
(2, 5, 3, 2, 'Golden Fade', 'shop_owner', 'Abuja', 1, '2025-06-01'),
(3, 7, 4, 3, 'Waves & Fade', 'home_service', 'Kano', 0, '2025-06-01'),
(4, 8, 6, 1, 'Classic Edge', 'shop_owner', 'Port Harcourt', 0, '2025-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `client_review`
--

CREATE TABLE `client_review` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_review`
--

INSERT INTO `client_review` (`id`, `client_id`, `client_name`, `comment`, `date`) VALUES
(1, 0, 'Alice Johnson', 'Great service and fast delivery!', '2025-05-01'),
(2, 0, 'Michael Smith', 'Very satisfied with the support team.', '2025-05-05'),
(3, 0, 'Sophia Lee', 'High quality products at fair prices.', '2025-05-10'),
(4, 0, 'James Brown', 'I had a wonderful experience. Highly recommended!', '2025-05-15'),
(5, 0, 'Emma Davis', 'User-friendly website and excellent customer care.', '2025-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `mykey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `mykey`) VALUES
(1, 'pk_test_7580449c6abedcd79dae9c1c08ff9058c6618351');

-- --------------------------------------------------------

--
-- Table structure for table `member_message`
--

CREATE TABLE `member_message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `compose` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `compose` text NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `has_read` tinyint(11) NOT NULL,
  `is_sender_deleted` tinyint(11) NOT NULL,
  `is_receiver_deleted` tinyint(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_email`, `name`, `subject`, `compose`, `receiver_email`, `has_read`, `is_sender_deleted`, `is_receiver_deleted`, `date`) VALUES
(1, 'niyialabi10@gmail.com', 'Neeyo', 'Meeting Follow-up', 'Just checking in on the meeting notes.', 'ngnimitech@gmail.com', 0, 0, 0, '2025-05-26 16:24:47'),
(2, 'niyialabi10@gmail.com', 'Neeyo', 'Project Update', 'Here is the latest update on the project.', 'ngnimitech@gmail.com', 0, 0, 0, '2025-05-26 16:24:47'),
(3, 'niyialabi10@gmail.com', 'Neeyo', 'Code Review', 'Can you review the code by Friday?', 'ngnimitech@gmail.com', 0, 0, 0, '2025-05-26 16:24:47'),
(4, 'niyialabi10@gmail.com', 'Neeyo', 'Lunch?', 'Are you free for lunch tomorrow?', 'ngnimitech@gmail.com', 0, 0, 0, '2025-05-26 16:24:47'),
(5, 'niyialabi10@gmail.com', 'Neeyo', 'Thanks', 'Thanks for your quick response.', 'ngnimitech@gmail.com', 1, 0, 0, '2025-05-26 16:24:47'),
(6, '', '', 'barber', 'hello', 'niyialabi10@gmail.com', 0, 0, 0, '2025-05-27 07:29:32'),
(7, '', '', 'barber', 'guy', 'niyialabi10@gmail.com', 0, 0, 0, '2025-05-27 07:29:54'),
(8, '', '', 'barber', 'hello', 'niyialabi10@gmail.com', 0, 0, 0, '2025-05-27 08:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `mykeys`
--

CREATE TABLE `mykeys` (
  `id` int(11) NOT NULL,
  `mykey` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picx`
--

CREATE TABLE `picx` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `pictures` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picx`
--

INSERT INTO `picx` (`id`, `sid`, `pictures`) VALUES
(1, 1, 'uploads/more/showroom1.png,uploads/more/showroom2.png,uploads/more/showroom3.png,uploads/more/showroom4.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `poster_type` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_details` text NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_location` varchar(11) NOT NULL,
  `product_address` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `gift_picks` tinyint(11) NOT NULL,
  `sold` tinyint(11) NOT NULL,
  `product_views` int(11) NOT NULL,
  `product_likes` int(11) NOT NULL,
  `product_rating` int(11) NOT NULL,
  `product_discount` int(11) NOT NULL,
  `featured_product` tinyint(11) NOT NULL,
  `product_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `poster_id`, `poster_type`, `product_name`, `product_price`, `product_image`, `product_details`, `product_category`, `product_location`, `product_address`, `product_color`, `quantity_sold`, `product_quantity`, `gift_picks`, `sold`, `product_views`, `product_likes`, `product_rating`, `product_discount`, `featured_product`, `product_date`) VALUES
(1, 1, 'restaurant', 'burger', '500', 'assets/images/products/double_cheese_burger.png', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'pastries', 'lagos', 'ikeja gra', '', 0, 10, 0, 0, 1, 0, 0, 10, 0, '2025-1-10 11:15AM'),
(2, 1, 'restaurant', 'jollof rice', '700', 'assets/images/products/jollof.jpeg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'party', 'lagos', 'ikeja gra', '', 0, 40, 0, 0, 9, 0, 0, 0, 0, '2025-1-10 11:15AM'),
(3, 1, 'restaurant', 'cake', '500', 'assets/images/products/cake.jpeg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'pastries', 'lagos', 'ikeja gra', '', 0, 12, 0, 0, 10, 0, 0, 0, 0, '2025-1-10 11:15AM'),
(4, 1, 'restaurant', 'fried rice', '1000', 'assets/images/products/fried_rice.jpeg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'party', 'lagos', 'ikeja gra', '', 0, 3, 0, 0, 5, 0, 0, 5, 0, '2025-1-10 11:15AM'),
(5, 1, 'restaurant', 'lasagne', '400', 'assets/images/products/lasagne.jpeg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'pastries', 'lagos', 'ikeja gra', '', 0, 10, 0, 0, 8, 0, 0, 0, 0, '2025-1-10 11:15AM'),
(6, 3, 'event planner', 'doughnuts', '550', 'assets/images/products/two-delicious-donuts-flying-transparent-background.jpg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'pastries', 'lagos', 'ikeja gra', '', 0, 13, 0, 0, 10, 0, 0, 10, 0, '2025-1-10 11:15AM'),
(7, 2, 'store', 'sausage roll', '800', 'assets/images/products/sausage_roll.jpg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'pastries', 'lagos', 'ikeja gra', '', 0, 15, 0, 0, 9, 0, 0, 0, 0, '2025-1-10 11:15AM'),
(8, 2, 'store', 'vegetable bag', '600', 'assets/images/products/bag_with_vegetables.jpg', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta blanditiis unde, ut laudantium placeat beatae ratione veniam nihil dolore repudiandae accusamus error assumenda odit aperiam quis doloribus cumque laborum minima.', 'beverages', 'lagos', 'ikeja gra', '', 0, 8, 0, 0, 10, 0, 0, 20, 0, '2025-1-10 11:15AM');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `reference` text NOT NULL,
  `duration` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `pending` tinyint(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `sender_id`, `message`, `recipient_id`, `pending`, `date`) VALUES
(1, 1, 'notification from admin', 1, 0, 'jan 5, 2020');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_bio` text NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_location` varchar(100) DEFAULT NULL,
  `lga` varchar(100) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_rating` decimal(3,2) DEFAULT 0.00,
  `user_gender` enum('male','female','other') DEFAULT 'other',
  `user_likes` int(11) DEFAULT 0,
  `user_shares` int(11) DEFAULT 0,
  `user_fee` decimal(10,2) DEFAULT 0.00,
  `user_preference` text DEFAULT NULL,
  `user_services` varchar(255) NOT NULL,
  `vkey` text NOT NULL,
  `verified` tinyint(11) NOT NULL,
  `payment_status` tinyint(11) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_name`, `user_email`, `user_password`, `user_type`, `user_image`, `user_dob`, `user_bio`, `user_phone`, `user_location`, `lga`, `user_address`, `user_rating`, `user_gender`, `user_likes`, `user_shares`, `user_fee`, `user_preference`, `user_services`, `vkey`, `verified`, `payment_status`, `date_added`) VALUES
(1, 'John Doe', 'john@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'customer', '', '1990-12-27', '', '08012345678', 'Lagos', 'Ikeja', '12B Allen Avenue', 4.50, 'male', 10, 5, 5000.00, 'shop', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123john', 1, 1, '2025-05-28 12:49:27'),
(2, 'Jane Smith', 'jane@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'admin', NULL, '1988-03-15', '', '08087654321', 'Abuja', 'Gwarinpa', '34 Palm Street', 4.80, 'female', 25, 15, 7000.00, 'home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123jane', 1, 0, '2025-05-28 12:49:27'),
(3, 'Michael Lee', 'michael@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'barber', '', '1995-06-10', '', '08123456789', 'Port Harcourt', 'Obio-Akpor', '22 Oil Road', 3.90, 'male', 7, 2, 2500.00, 'home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123michael', 1, 0, '2025-05-28 12:49:27'),
(4, 'Fatima Bello', 'fatima@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'customer', '', '1992-11-23', '', '08011122233', 'Kano', 'Nassarawa', '7 Emir Street', 4.60, 'female', 12, 4, 3000.00, 'shop,home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123fatima', 1, 0, '2025-05-28 12:49:27'),
(5, 'Samuel Okoro', 'samuel@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'barber', 'profiles/img_6839cfa3e6839.jpg', '1994-07-01', '', '08199887766', 'Enugu', 'Nsukka', '9 Green Villa', 4.10, 'male', 8, 3, 4000.00, 'home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123samuel', 1, 1, '2025-05-28 12:49:27'),
(6, 'Ngozi Uche', 'ngozi@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'customer', 'profiles/899e571fa9e5dc8f8d5af695dfc750b5.png', '1993-05-05', '', '08044455566', 'Owerri', 'Orlu', '21 Hope Avenue', 4.30, 'female', 19, 6, 4500.00, 'shop,home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123ngozi', 1, 0, '2025-05-28 12:49:27'),
(7, 'Tunde Ade', 'tunde@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'barber', '', '1987-09-19', '', '08112233445', 'Ibadan', 'Ibadan North', '16 Cocoa House', 3.70, 'male', 5, 1, 3200.00, 'home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123tunde', 1, 0, '2025-05-28 12:49:27'),
(8, 'Amina Yusuf', 'amina@example.com', '$2y$10$HGiVDPgxxDNG.l49vYKXBe8ZLHEbVC.lk0VTmsn3ey9DQt42JMfcW', 'barber', '', '1991-01-30', '', '08066677788', 'Jos', 'Jos South', '4 Plateau Close', 4.90, 'female', 30, 20, 8000.00, 'shop,home_service', 'The Executive, The Fresh Prince, Gentleman\'s Fade, Boss Cut, Waves & Fade, Streetline Design, Classic Edge, Golden Fade', 'abc123amina', 1, 0, '2025-05-28 12:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `verify_seller`
--

CREATE TABLE `verify_seller` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `valid_id` int(11) NOT NULL,
  `verified` tinyint(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_src` varchar(255) NOT NULL,
  `video_details` text NOT NULL,
  `video_views` int(255) NOT NULL,
  `video_likes` varchar(11) NOT NULL,
  `uploaded_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_src`, `video_details`, `video_views`, `video_likes`, `uploaded_date`) VALUES
(1, 'assets/videos/12405214_1080_1920_30fps.mp4', 'lorem ipsum', 5, '5', 'feb 24, 2025'),
(2, 'assets/videos/13035868_2160_3840_30fps.mp4', 'lorem ipsum', 20, '2', 'feb 24, 2025'),
(3, 'assets/videos/13097021_1080_1920_30fps.mp4', 'lorem ipsum', 0, '3', 'feb 24, 2025'),
(4, 'assets/videos/13103149_2160_3840_30fps.mp4', 'lorem ipsum', 6, '4', 'feb 24, 2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barber_comment`
--
ALTER TABLE `barber_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barber_request`
--
ALTER TABLE `barber_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_review`
--
ALTER TABLE `client_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_message`
--
ALTER TABLE `member_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mykeys`
--
ALTER TABLE `mykeys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picx`
--
ALTER TABLE `picx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `verify_seller`
--
ALTER TABLE `verify_seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barber_comment`
--
ALTER TABLE `barber_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barber_request`
--
ALTER TABLE `barber_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_review`
--
ALTER TABLE `client_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member_message`
--
ALTER TABLE `member_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mykeys`
--
ALTER TABLE `mykeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `picx`
--
ALTER TABLE `picx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `verify_seller`
--
ALTER TABLE `verify_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
