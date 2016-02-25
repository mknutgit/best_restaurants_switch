--
-- Database: `best_restaurants`
--
CREATE DATABASE IF NOT EXISTS `best_restaurants` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `best_restaurants`;

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `type`) VALUES
(12, 'Mer-I-Can'),
(13, 'Thai'),
(14, 'Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `website` varchar(55) DEFAULT NULL,
  `location` varchar(101) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cuisine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `website`, `location`, `phone`, `cuisine_id`) VALUES
(12, 'andy', 'no apostrophes', 'www.joses.com', '3rd', '43333333', 12),
(13, 'pete', 'sfsad', 'sdfsd', 'sdfs', '432432', 12),
(14, 'h', 'h', 'h', 'h', '12', 12),
(15, 'u', 'u', 'u', 'u', '1', 12),
(16, 'u', 'u', 'u', 'u', '1', 12),
(17, 'i', 'i', 'i', 'i', 'i', 12),
(18, 'hunan pro', 'sweet momos', 'www.gotrumpsasshole.com', '3rd', '44444444', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
