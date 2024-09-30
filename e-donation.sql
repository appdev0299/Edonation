-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 11:39 AM
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
-- Database: `e-donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `donat`
--

CREATE TABLE `donat` (
  `id` int(11) NOT NULL,
  `payerAccountName` varchar(255) NOT NULL,
  `billPaymentRef2` varchar(255) NOT NULL,
  `billPaymentRef1` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `subอ.` varchar(100) DEFAULT NULL,
  `อ.` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT NULL,
  `cc_email` tinyint(1) DEFAULT NULL,
  `project_number` varchar(10) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `status_donat` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donat_user`
--

CREATE TABLE `donat_user` (
  `id` int(11) NOT NULL,
  `billPaymentRef1` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `subอ.` varchar(100) DEFAULT NULL,
  `อ.` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `gift` tinyint(1) DEFAULT NULL,
  `cc_email` tinyint(1) DEFAULT NULL,
  `project_number` varchar(10) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `status_donat` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donat_user`
--

INSERT INTO `donat_user` (`id`, `billPaymentRef1`, `type`, `email`, `phone`, `amount`, `address`, `subอ.`, `อ.`, `province`, `gift`, `cc_email`, `project_number`, `project_name`, `status_donat`, `created_at`) VALUES
(320, '671212050000320', 'ศิษย์เก่า', 'cstandbrooke0@usatoday.com', '1234567890', 1000.00, '', '', '', '', 0, 1, '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'online', '2024-09-26 08:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `json_donat`
--

CREATE TABLE `json_donat` (
  `id` int(11) NOT NULL,
  `billPaymentRef1` varchar(255) DEFAULT NULL,
  `billPaymentRef2` varchar(255) DEFAULT NULL,
  `payeeProxyId` varchar(255) DEFAULT NULL,
  `payeeProxyType` varchar(255) DEFAULT NULL,
  `payeeAccountNumber` varchar(255) DEFAULT NULL,
  `payeeName` varchar(255) DEFAULT NULL,
  `payerAccountNumber` varchar(255) DEFAULT NULL,
  `payerAccountName` varchar(255) DEFAULT NULL,
  `payerName` varchar(255) DEFAULT NULL,
  `sendingBankCode` varchar(255) DEFAULT NULL,
  `receivingBankCode` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  `transactionDateandTime` varchar(255) DEFAULT NULL,
  `currencyCode` varchar(255) DEFAULT NULL,
  `channelCode` varchar(255) DEFAULT NULL,
  `transactionType` varchar(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `json_donat`
--

INSERT INTO `json_donat` (`id`, `billPaymentRef1`, `billPaymentRef2`, `payeeProxyId`, `payeeProxyType`, `payeeAccountNumber`, `payeeName`, `payerAccountNumber`, `payerAccountName`, `payerName`, `sendingBankCode`, `receivingBankCode`, `amount`, `transactionId`, `transactionDateandTime`, `currencyCode`, `channelCode`, `transactionType`, `date`, `dateCreate`) VALUES
(23, '671212050000320', '1500701252395', '099400258783792', 'BILLERID', '5663044095', 'FACULTY OF NURSING CMU', '5662488652', 'พัชรพล ปิงยศ', 'พัชรพล ปิงยศ', '014', '014', 1000.00, '53a2d569b8d5418a96c77507393d4b9a', '2024-09-26T09:39:56.597+07:00', '764', 'PMH', 'Domestic Transfers', '2024-09-26', '2024-09-26 08:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_number` varchar(10) NOT NULL COMMENT 'เลขโครงการ',
  `project_name` varchar(255) NOT NULL COMMENT 'ชื่อโครงการ',
  `project_description` varchar(255) NOT NULL COMMENT 'ชื่อแสดงในใบเสร็จ',
  `project_details` text NOT NULL COMMENT 'รายละเอียดโครงการแสดงหน้าเว็บ',
  `project_tex` varchar(255) NOT NULL COMMENT 'ลดหย่อน',
  `img_file` varchar(255) NOT NULL COMMENT 'รูปโครงการ',
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_number`, `project_name`, `project_description`, `project_details`, `project_tex`, `img_file`, `dateCreate`) VALUES
(1, '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ แต่ละปีมีนักศึกษาที่อยู่ระหว่างการศึกษาทุกระดับมากกว่า 1,500 คน คณะฯ ตระหนักถึงความสำคัญของการให้โอกาสทางการศึกษา และมุ่งหวังที่จะสนับสนุนและส่งเสริมให้นักศึกษาได้มีโอกาสเรียนรู้จนสำเร็จการศึกษาภายในระยะเวลาที่กำหนดไว้ในหลักสูตร โครงการนี้จัดตั้งขึ้นเพื่อมอบทุนการศึกษาแก่นักศึกษาพยาบาลทุกระดับที่ขาดแคลน ทุนทรัพย์ ให้สามารถจ่ายค่าธรรมเนียมการศึกษา ค่าที่พักอาศัย และค่าใช้จ่ายในการดำรงชีพ ซึ่งจะช่วยให้นักศึกษาได้ใช้เวลาในการศึกษาเล่าเรียนอย่างเต็มศักยภาพ รวมทั้งเป็นรางวัลสำหรับนักศึกษาผู้ที่มีผลการเรียนและผลการฝึกปฏิบัติยอดเยี่ยม  ดังนั้นเมื่อสำเร็จการศึกษา นักศึกษาจะได้นำความรู้และทักษะทางการพยาบาลมาช่วยเหลือดูแลผู้ป่วย ครอบครัว และสังคมต่อไป', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า', '', '2024-09-17 02:08:13'),
(2, '121206', 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'คณะพยาบาลศาสตร์ มช. เปิดดำเนินการจัดการเรียนการสอนและได้ผลิตบัณฑิตคณะพยาบาลศาสตร์ ออกไปรับใช้สังคมทั้งไทยและต่างประเทศมามากกว่า 60 ปี ปัจจุบันคณะพยาบาลศาสตร์ มีอาคารเรียนทั้งหมด 4 อาคาร ในการดำเนินการตามพันธกิจของคณะฯ จำเป็นต้องมีการพัฒนาปรับปรุงห้องเรียน อาคารเรียน อาคารสถานที่ และสภาพแวดล้อมภูมิทัศน์อย่างต่อเนื่อง เพื่อให้อาคารสถานที่และสิ่งแวดล้อม สะอาด ร่มรื่น สวยงาม ปลอดภัย และมีบรรยากาศเอื้ออำนวยต่อการเรียนการสอนของอาจารย์ นักศึกษา บุคลากร และผู้รับบริการทุกกลุ่มมีความพึงพอใจ ', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า', '', '2024-09-17 02:22:56'),
(3, '121207', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ ของพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ ของพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ ที่ไม่ได้มุ่งหวังแค่การรักษาพยาบาลประชาชนเมื่อเจ็บป่วยเท่านั้น แต่มุ่งหวังให้ประชาชนมีสุขภาวะกายและจิตที่ดี ผ่านกระบวนการสร้างเสริมสุขภาพ ป้องกันโรค รักษาโรค และฟื้นฟูสภาพ คณะฯ ตระหนักถึงความยากลำบาก และความไม่เท่าเทียมกันของประชาชนในกลุ่มและพื้นที่ต่างๆ ที่ยังมีช่องว่างในการเข้าถึงบริการสาธารณสุขขั้นพื้นฐานที่มีคุณภาพ ดังนั้นคณะฯมีความมุ่งมั่นตั้งใจที่จะช่วยเหลือผู้ยากไร้ ผู้ด้อยโอกาสในสังคม ผู้ที่ขาดโอกาสในการเข้าถึงบริการสาธารณสุข ตลอดจนผู้ที่ขาดโอกาสด้านการศึกษาในสังคม โดยการรวบรวมเงินบริจาคเพื่อแบ่งปันเอื้ออาทร ช่วยเหลือซึ่งกันและกัน', 'บริจาคเพื่อลดหย่อนภาษี 1 เท่า', '', '2024-09-17 02:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `amount`, `img_file`) VALUES
(1, 'ชั้นที่ 1 ปฐมติเรกคุณาภรณ์', 'บริจาค 30,000,000 บาทขั้นไป', '1.jpg'),
(2, 'ชั้นที่ 2 ทุติยดิเรกคุณภรณ์', 'บริจาค 14,000,000 บาทขึ้นไป', '2.jpg'),
(3, 'ชั้นที่ 3 ตติยดิเรกคุณาภรณ์', 'บริจาค 6,000,000 บาทขั้นไป', '3.jpg'),
(4, 'ชั้นที่ 4 จตุตถติเรกคุณาภรณ์', 'บริจาค 1,500,000 บาทขั้นไป', '4.jpg'),
(5, 'ชั้นที่ 5 เบจมดิเรกคุณาภรณ์', 'บริจาค 500,000 บาทขั้นไป', '5.jpg'),
(6, 'ชั้นที่ 6 เหรียญทองแดงดิเรกคุณาภรณ์', 'บริจาค 200,000 บาทขั้นไป', '6.jpg'),
(7, 'ชั้นที่ 7 เหรียญเงินดิเรกคุณาภรณ์', 'บริจาค 100,000 บาทขั้นไป', '7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_donat`
--

CREATE TABLE `service_donat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_donat`
--

INSERT INTO `service_donat` (`id`, `name`, `amount`, `img_file`) VALUES
(1, 'Griptok', '1,000 - 3,000 บาท', 'a.jpg'),
(2, 'จานรองแก้วเซรามิค', '3,000 - 10,000 บาท', 'b.jpg'),
(3, 'กระเป๋าถือกันน้ำ', '10,000 - 50,000 บาท', 'd.jpg'),
(4, 'ขวดน้ำเก็บความร้อน-เย็น', '50,000 - 100,000', 'e.jpg'),
(5, 'เข็มกลัดที่ระลึก คณะพยาบาลศาสตร์ มช.', '100,000 - 1,000,000 บาท', 'f.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donat`
--
ALTER TABLE `donat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donat_user`
--
ALTER TABLE `donat_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `json_donat`
--
ALTER TABLE `json_donat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_donat`
--
ALTER TABLE `service_donat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donat`
--
ALTER TABLE `donat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1817;

--
-- AUTO_INCREMENT for table `donat_user`
--
ALTER TABLE `donat_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `json_donat`
--
ALTER TABLE `json_donat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_donat`
--
ALTER TABLE `service_donat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
