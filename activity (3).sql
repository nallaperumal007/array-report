-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 06:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `information`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `ins` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ins`)),
  `out` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`out`)),
  `drs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`drs`)),
  `total` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`total`)),
  `ins_details` longtext NOT NULL,
  `out_details` longtext NOT NULL,
  `drs_details` longtext NOT NULL,
  `pod_details` longtext NOT NULL,
  `activity_sl_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `ins`, `out`, `drs`, `total`, `ins_details`, `out_details`, `drs_details`, `pod_details`, `activity_sl_no`) VALUES
(1, '[{\"order\":100,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:12:34\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"1\",\"ins_ewayno\":\"2\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-18-ABC-1234\",\"ins_vno\":\"1234\",\"activity_sl_no\":1},\r\n      {\"order\":200,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:14:21\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"0.00\",\"ins_ewayno\":\"0\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-18-ABC-1234\",\"ins_vno\":\"1234\",\"activity_sl_no\":4}]\r\n\r\n', '\r\n[{\"order\":300,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:12:34\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"1\",\"ins_ewayno\":\"2\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-18-ABC-1234\",\"ins_vno\":\"1234\",\"activity_sl_no\":2},\r\n      {\"order\":400,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:14:21\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"6\",\"ins_ewayno\":\"5\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"2\",\"ins_vol_wgt\":\"3\",\"ins_truck\":\"AA-22-DDD-8888\",\"ins_vno\":\"8888\",\"activity_sl_no\":5}]\r\n', '\r\n[{\"order\":500,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:12:34\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"1\",\"ins_ewayno\":\"2\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-18-ABC-1234\",\"ins_vno\":\"1234\",\"activity_sl_no\":2},\r\n      {\"order\":600,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-25\",\"ins_time\":\"22:14:21\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"6\",\"ins_ewayno\":\"5\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"2\",\"ins_vol_wgt\":\"3\",\"ins_truck\":\"AA-22-DDD-8888\",\"ins_vno\":\"8888\",\"activity_sl_no\":6}]\r\n', '{\"ins\": \"[{\\\"order\\\":1,\\\"rcd_sts\\\":\\\"Y\\\",\\\"ins_date\\\":\\\"2024-09-27\\\",\\\"ins_time\\\":\\\"22:33:21\\\",\\\"ins_branch\\\":\\\"BLRAPX\\\",\\\"ins_by\\\":\\\"GMSPE18\\\",\\\"ins_eway_amt\\\":\\\"8\\\",\\\"ins_ewayno\\\":\\\"5\\\",\\\"ins_ro\\\":\\\"BLRRO\\\",\\\"ins_pcs\\\":\\\"1\\\",\\\"ins_wgt\\\":\\\"25.000\\\",\\\"ins_vol_wgt\\\":\\\"0.000\\\",\\\"ins_truck\\\":\\\"KA-12-GH-123\\\",\\\"ins_vno\\\":\\\"123\\\",\\\"activity_sl_no\\\":1},{\\\"order\\\":2,\\\"rcd_sts\\\":\\\"Y\\\",\\\"ins_date\\\":\\\"2024-09-27\\\",\\\"ins_time\\\":\\\"22:39:26\\\",\\\"ins_branch\\\":\\\"BLRAPX\\\",\\\"ins_by\\\":\\\"GMSPE18\\\",\\\"ins_eway_amt\\\":\\\"0.00\\\",\\\"ins_ewayno\\\":\\\"0\\\",\\\"ins_ro\\\":\\\"BLRRO\\\",\\\"ins_pcs\\\":1,\\\"ins_wgt\\\":\\\"25.000\\\",\\\"ins_vol_wgt\\\":\\\"0.000\\\",\\\"ins_truck\\\":\\\"KA-18-ABC-1234\\\",\\\"ins_vno\\\":\\\"1234\\\",\\\"activity_sl_no\\\":3}]\", \"out\": \"[{\\\"order\\\":1,\\\"mani_sts\\\":\\\"Y\\\",\\\"out_ewayno\\\":\\\"0\\\",\\\"out_eway_amt\\\":\\\"0.00\\\",\\\"out_truck\\\":\\\"SD-34-DSD-3434\\\",\\\"pmf_branch\\\":\\\"BLRRO\\\",\\\"pmf_ro\\\":\\\"BLRAPX\\\",\\\"pmf_type\\\":\\\"R\\\",\\\"pmf_date\\\":\\\"2024-09-27\\\",\\\"out_vno\\\":\\\"3434\\\",\\\"pmf_by\\\":\\\"GMSPE18\\\",\\\"pmf_time\\\":\\\"22:40\\\",\\\"out_mode\\\":\\\"SF\\\",\\\"pmf_no\\\":\\\"BLRAPX_OPMF_0015\\\",\\\"pmf_autono\\\":15,\\\"activity_sl_no\\\":2},{\\\"order\\\":2,\\\"mani_sts\\\":\\\"Y\\\",\\\"out_ewayno\\\":\\\"0\\\",\\\"out_eway_amt\\\":\\\"0.00\\\",\\\"out_truck\\\":\\\"SD-34-DSD-3434\\\",\\\"pmf_branch\\\":\\\"BLRRO\\\",\\\"pmf_ro\\\":\\\"BLRAPX\\\",\\\"pmf_type\\\":\\\"R\\\",\\\"pmf_date\\\":\\\"2024-09-27\\\",\\\"out_vno\\\":\\\"3434\\\",\\\"pmf_by\\\":\\\"GMSPE18\\\",\\\"pmf_time\\\":\\\"22:40\\\",\\\"out_mode\\\":\\\"SF\\\",\\\"pmf_no\\\":\\\"BLRAPX_OPMF_0015\\\",\\\"pmf_autono\\\":1,\\\"activity_sl_no\\\":4}]\", \"drs\": \"[{\\\"order\\\":1,\\\"dly_type\\\":\\\"DA\\\",\\\"drs_date\\\":\\\"2024-09-27\\\",\\\"emp_id\\\":\\\"AMDDA18\\\",\\\"drs_no\\\":\\\"BLRAPX_DRS_0002\\\",\\\"drs_autono\\\":2,\\\"drs_sts\\\":\\\"Y\\\",\\\"drs_branch\\\":\\\"BLRAPX\\\",\\\"drs_ro\\\":\\\"BLRRO\\\",\\\"drs_type\\\":\\\"R\\\",\\\"drs_agent_code\\\":\\\"AMDDA18\\\",\\\"drs_agent_name\\\":\\\"drs-karbon-utl(AMDDA18)\\\",\\\"drs_ewayno\\\":\\\"0\\\",\\\"drs_eway_amt\\\":\\\"0.00\\\",\\\"drs_done_emp\\\":\\\"AMDDA18\\\",\\\"drs_prep_by\\\":\\\"AMDDA18\\\",\\\"drs_truck\\\":\\\"KA-12-KA-1234\\\",\\\"drs_time\\\":\\\"2024-09-27 22:40:58\\\",\\\"drs_update_status\\\":null,\\\"activity_sl_no\\\":5},{\\\"order\\\":2,\\\"dly_type\\\":\\\"DA\\\",\\\"drs_date\\\":\\\"2024-09-29\\\",\\\"emp_id\\\":\\\"AMDDA18\\\",\\\"drs_no\\\":\\\"BLRAPX_DRS_0003\\\",\\\"drs_autono\\\":3,\\\"drs_sts\\\":\\\"Y\\\",\\\"drs_branch\\\":\\\"BLRAPX\\\",\\\"drs_ro\\\":\\\"BLRRO\\\",\\\"drs_type\\\":\\\"R\\\",\\\"drs_agent_code\\\":\\\"AMDDA18\\\",\\\"drs_agent_name\\\":\\\"drs-karbon-utl(AMDDA18)\\\",\\\"drs_ewayno\\\":\\\"0\\\",\\\"drs_eway_amt\\\":\\\"0.00\\\",\\\"drs_done_emp\\\":\\\"AMDDA18\\\",\\\"drs_prep_by\\\":\\\"AMDDA18\\\",\\\"drs_truck\\\":\\\"KA-12-KA-1234\\\",\\\"drs_time\\\":\\\"2024-09-29 16:01:40\\\",\\\"drs_update_status\\\":null,\\\"activity_sl_no\\\":6}]\", \"pod\": \"[{\\\"order\\\":1,\\\"drs_order_no\\\":\\\"1\\\",\\\"drs_no\\\":\\\"BLRAPX_DRS_0002\\\",\\\"dly_sts\\\":\\\"N\\\",\\\"dly_code\\\":\\\"DCN\\\",\\\"dly_reason\\\":\\\"\\\",\\\"dly_time\\\":\\\"19:17\\\",\\\"dly_to_name\\\":\\\"vicky\\\",\\\"dly_to_mobile\\\":\\\"78\\\",\\\"dly_remarks\\\":\\\"e\\\",\\\"dly_date\\\":\\\"2024-09-10\\\",\\\"activity_sl_no\\\":10},{\\\"order\\\":2,\\\"drs_order_no\\\":\\\"2\\\",\\\"drs_no\\\":\\\"BLRAPX_DRS_0003\\\",\\\"dly_sts\\\":\\\"D\\\",\\\"dly_code\\\":\\\"DLD\\\",\\\"dly_reason\\\":\\\"DELIVERED\\\",\\\"dly_time\\\":\\\"19:16\\\",\\\"dly_to_name\\\":\\\"sunil\\\",\\\"dly_to_mobile\\\":\\\"3434\\\",\\\"dly_remarks\\\":\\\"test\\\",\\\"dly_date\\\":\\\"2024-09-17\\\",\\\"activity_sl_no\\\":11}]\"}', '[{\"order\":1,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-27\",\"ins_time\":\"22:33:21\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"8\",\"ins_ewayno\":\"5\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":\"1\",\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-12-GH-123\",\"ins_vno\":\"123\",\"activity_sl_no\":1},{\"order\":2,\"rcd_sts\":\"Y\",\"ins_date\":\"2024-09-27\",\"ins_time\":\"22:39:26\",\"ins_branch\":\"BLRAPX\",\"ins_by\":\"GMSPE18\",\"ins_eway_amt\":\"0.00\",\"ins_ewayno\":\"0\",\"ins_ro\":\"BLRRO\",\"ins_pcs\":1,\"ins_wgt\":\"25.000\",\"ins_vol_wgt\":\"0.000\",\"ins_truck\":\"KA-18-ABC-1234\",\"ins_vno\":\"1234\",\"activity_sl_no\":3}]', '[{\"order\":1,\"mani_sts\":\"Y\",\"out_ewayno\":\"0\",\"out_eway_amt\":\"0.00\",\"out_truck\":\"SD-34-DSD-3434\",\"pmf_branch\":\"BLRRO\",\"pmf_ro\":\"BLRAPX\",\"pmf_type\":\"R\",\"pmf_date\":\"2024-09-27\",\"out_vno\":\"3434\",\"pmf_by\":\"GMSPE18\",\"pmf_time\":\"22:40\",\"out_mode\":\"SF\",\"pmf_no\":\"BLRAPX_OPMF_0015\",\"pmf_autono\":15,\"activity_sl_no\":2},{\"order\":2,\"mani_sts\":\"Y\",\"out_ewayno\":\"0\",\"out_eway_amt\":\"0.00\",\"out_truck\":\"SD-34-DSD-3434\",\"pmf_branch\":\"BLRRO\",\"pmf_ro\":\"BLRAPX\",\"pmf_type\":\"R\",\"pmf_date\":\"2024-09-27\",\"out_vno\":\"3434\",\"pmf_by\":\"GMSPE18\",\"pmf_time\":\"22:40\",\"out_mode\":\"SF\",\"pmf_no\":\"BLRAPX_OPMF_0015\",\"pmf_autono\":1,\"activity_sl_no\":4}]', '[{\"order\":1,\"dly_type\":\"DA\",\"drs_date\":\"2024-09-27\",\"emp_id\":\"AMDDA18\",\"drs_no\":\"BLRAPX_DRS_0002\",\"drs_autono\":2,\"drs_sts\":\"Y\",\"drs_branch\":\"BLRAPX\",\"drs_ro\":\"BLRRO\",\"drs_type\":\"R\",\"drs_agent_code\":\"AMDDA18\",\"drs_agent_name\":\"drs-karbon-utl(AMDDA18)\",\"drs_ewayno\":\"0\",\"drs_eway_amt\":\"0.00\",\"drs_done_emp\":\"AMDDA18\",\"drs_prep_by\":\"AMDDA18\",\"drs_truck\":\"KA-12-KA-1234\",\"drs_time\":\"2024-09-27 22:40:58\",\"drs_update_status\":null,\"activity_sl_no\":5},{\"order\":2,\"dly_type\":\"DA\",\"drs_date\":\"2024-09-29\",\"emp_id\":\"AMDDA18\",\"drs_no\":\"BLRAPX_DRS_0003\",\"drs_autono\":3,\"drs_sts\":\"Y\",\"drs_branch\":\"BLRAPX\",\"drs_ro\":\"BLRRO\",\"drs_type\":\"R\",\"drs_agent_code\":\"AMDDA18\",\"drs_agent_name\":\"drs-karbon-utl(AMDDA18)\",\"drs_ewayno\":\"0\",\"drs_eway_amt\":\"0.00\",\"drs_done_emp\":\"AMDDA18\",\"drs_prep_by\":\"AMDDA18\",\"drs_truck\":\"KA-12-KA-1234\",\"drs_time\":\"2024-09-29 16:01:40\",\"drs_update_status\":null,\"activity_sl_no\":6}]', '[{\"order\":1,\"drs_order_no\":\"1\",\"drs_no\":\"BLRAPX_DRS_0002\",\"dly_sts\":\"N\",\"dly_code\":\"DCN\",\"dly_reason\":\"\",\"dly_time\":\"19:17\",\"dly_to_name\":\"vicky\",\"dly_to_mobile\":\"78\",\"dly_remarks\":\"e\",\"dly_date\":\"2024-09-10\",\"activity_sl_no\":10},{\"order\":2,\"drs_order_no\":\"2\",\"drs_no\":\"BLRAPX_DRS_0003\",\"dly_sts\":\"D\",\"dly_code\":\"DLD\",\"dly_reason\":\"DELIVERED\",\"dly_time\":\"19:16\",\"dly_to_name\":\"sunil\",\"dly_to_mobile\":\"3434\",\"dly_remarks\":\"test\",\"dly_date\":\"2024-09-17\",\"activity_sl_no\":11}]', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
