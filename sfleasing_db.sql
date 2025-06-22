-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 08:36 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfleasing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `body_type`
--

CREATE TABLE `body_type` (
  `id` int(11) NOT NULL,
  `body_type` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `booking_no` varchar(255) NOT NULL,
  `delivery_address1` text NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_remark` varchar(255) NOT NULL,
  `delivery_postcode` varchar(255) NOT NULL,
  `delivery_address2` varchar(255) NOT NULL,
  `deli_phone` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `driving_license_front` varchar(255) NOT NULL,
  `driving_license_back` varchar(255) NOT NULL,
  `national_id_front` varchar(255) NOT NULL,
  `national_id_back` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `billing_address1` text NOT NULL,
  `billing_address2` text NOT NULL,
  `billing_phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `billing_postcode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `check_status` int(11) NOT NULL,
  `confirm_status` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `reference_date` datetime NOT NULL,
  `confirm_date` date NOT NULL,
  `subscription_price` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_amt` varchar(255) NOT NULL,
  `price_status` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_photo` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `id` int(11) NOT NULL,
  `rental_price` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `car_package` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `tnc` varchar(255) NOT NULL,
  `engine_type` varchar(255) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `features` varchar(255) NOT NULL,
  `seat_qty` int(11) NOT NULL,
  `door` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `body_type` varchar(255) NOT NULL,
  `consumption` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `car_design` varchar(255) NOT NULL,
  `title_status` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `price_status` varchar(255) NOT NULL,
  `post_by` varchar(255) NOT NULL,
  `document` text NOT NULL,
  `purchase_date` date NOT NULL,
  `registration_date` date NOT NULL,
  `available_date` date NOT NULL,
  `show_status` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_package`
--

CREATE TABLE `car_package` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `best` varchar(255) NOT NULL,
  `best_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `id` int(11) NOT NULL,
  `duration_id` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`id`, `duration_id`, `duration`) VALUES
(1, 1, '1 Month'),
(2, 3, '3 Months'),
(3, 6, '6 Months'),
(4, 12, '12 Months'),
(5, 24, '24 Months'),
(6, 48, '48 Months');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `id` int(11) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `how_works`
--

CREATE TABLE `how_works` (
  `id` int(11) NOT NULL,
  `step` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `invoice_name` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `total_amt` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `promotion_text` text NOT NULL,
  `description` text NOT NULL,
  `detail` text NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `cmy_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `interesting_option` varchar(255) NOT NULL,
  `qty_of_cars` int(100) NOT NULL,
  `business_register_no` varchar(255) NOT NULL,
  `office_no` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `cmy_name`, `phone`, `email`, `password`, `address`, `interesting_option`, `qty_of_cars`, `business_register_no`, `office_no`, `file`, `profile`, `message`, `role`, `status`, `created_date`) VALUES
(1, 'May Zin', 'Oo', '', '9478578222', 'admin@gmail.com', '$2y$10$xX1RWhxvAwPljzphcHTffe7s8kJ3TLyx3bX6e1ui1Q07lW72SkwS6', '', '', 0, '', '', '', '', '', 'admin', 2, '2022-09-08 00:00:00'),
(3, 'Steve', 'White', '', '45698555', 'mayzinoo1625@gmail.com', '$2y$10$uEXngg1HLcigqY7lx8XqyO.gkyIZGnGfVcVFgh1HXNauofQCEQjq6', '', '', 0, '', '', '', '', '', 'dealer', 1, '2022-08-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_photos`
--

CREATE TABLE `vehicle_photos` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body_type`
--
ALTER TABLE `body_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_package`
--
ALTER TABLE `car_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_works`
--
ALTER TABLE `how_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_photos`
--
ALTER TABLE `vehicle_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_type`
--
ALTER TABLE `body_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_details`
--
ALTER TABLE `car_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_package`
--
ALTER TABLE `car_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `how_works`
--
ALTER TABLE `how_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_photos`
--
ALTER TABLE `vehicle_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
