-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 فبراير 2019 الساعة 13:46
-- إصدار الخادم: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gp`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(14) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`Admin_id`, `UserName`, `Password`, `Phone`, `FullName`, `Email`) VALUES
(1, 'ali', 'ali123', '01112233158', 'على محمد محمود', 'ali@gmail.com'),
(2, 'فتحي', 'فتحي123', '01012233146', 'فتحى محمد على', 'asd@gmail.com'),
(3, 'علي محمد', 'ali123', '01155433543', 'علي محمد احمد', 'ali@gmail.com');

-- --------------------------------------------------------

--
-- بنية الجدول `centers`
--

CREATE TABLE `centers` (
  `C_id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `govern_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `centers`
--

INSERT INTO `centers` (`C_id`, `Name`, `govern_id`) VALUES
(1, 'اسيوط', 1),
(2, 'ديروط', 1),
(3, 'القوصية', 1),
(4, 'ابنوب', 1),
(5, 'منفلوط', 1),
(6, 'ابو تيج', 1),
(7, 'الغنايم', 1),
(8, 'ساحل سليم', 1),
(9, 'البدارى', 1),
(10, 'صدفا', 1),
(11, 'الفتح', 1),
(12, 'سوهاج', 2),
(13, 'اخميم', 2),
(14, 'دار السلام', 2),
(15, 'طما', 2),
(16, 'طهطا', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `complaints`
--

CREATE TABLE `complaints` (
  `cid` int(11) NOT NULL,
  `U_id` int(14) NOT NULL,
  `Complain` varchar(1500) NOT NULL,
  `service` varchar(250) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `complaints`
--

INSERT INTO `complaints` (`cid`, `U_id`, `Complain`, `service`, `type`, `date`, `status`) VALUES
(1, 3, 'ارتفاع فاتورة الكهرباء', '', 'bad_service', '2019-02-03 19:10:12', 0),
(2, 3, 'انقطاع الكهرباء كل يومين', 'electricity', 'service_failure', '2019-02-04 00:35:03', 0),
(3, 4, 'انقطاع المياء فترة كبيرة كل 3 ايام', 'water', 'service_failure', '2019-02-05 23:24:59', 0),
(4, 4, 'انقطاع المياء كل يوم', 'water', 'service_failure', '2019-02-06 14:39:44', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `districts`
--

CREATE TABLE `districts` (
  `D_id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `govern_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `districts`
--

INSERT INTO `districts` (`D_id`, `Name`, `govern_id`, `center_id`) VALUES
(1, 'حى السادات', 1, 1),
(2, 'منطقة مصنع سيد', 1, 1),
(3, 'حى المخبو الالى', 2, 12),
(4, 'منطقة الزهراء', 2, 12);

-- --------------------------------------------------------

--
-- بنية الجدول `govern`
--

CREATE TABLE `govern` (
  `G_id` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `govern`
--

INSERT INTO `govern` (`G_id`, `Name`) VALUES
(1, 'اسيوط'),
(2, 'سوهاج');

-- --------------------------------------------------------

--
-- بنية الجدول `invoice`
--

CREATE TABLE `invoice` (
  `inv_Id` int(11) NOT NULL,
  `Month` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `U_id` int(14) NOT NULL,
  `service` varchar(255) NOT NULL,
  `invoice_admin` int(14) NOT NULL,
  `meter_reading` int(11) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `Paid` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `invoice`
--

INSERT INTO `invoice` (`inv_Id`, `Month`, `Date`, `U_id`, `service`, `invoice_admin`, `meter_reading`, `cost`, `Paid`) VALUES
(6, '3', '2019-02-02 10:36:13', 1, 'e', 1, 122, '27.94', 1),
(15, '3', '2019-02-02 11:40:44', 2, 'e', 1, 66, '10.02', 0),
(16, '1', '2019-02-02 11:40:54', 1, 'w', 1, 1765, '2382.75', 1),
(17, '6', '2019-02-02 11:41:08', 2, 'g', 1, 333, '127.15', 0),
(18, '5', '2019-02-13 00:00:00', 4, 'w', 1, 45, '1000', 0),
(19, '5', '2019-02-07 00:00:00', 4, 'g', 1, 454, '100', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `Latitude` varchar(12) NOT NULL,
  `Longitude` varchar(12) NOT NULL,
  `company_name` varchar(80) DEFAULT NULL,
  `service` varchar(20) DEFAULT NULL,
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `location`
--

INSERT INTO `location` (`id`, `name`, `Latitude`, `Longitude`, `company_name`, `service`, `url`) VALUES
(1, '	ديروط', '30.8145514', '27.5496148', 'شركة مصر الوسطى لتوزيع الكهرباء بديروط\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+%D8%A8%D8%AF%D9%8A%D8%B1%D9%88%D8%B7%E2%80%AD/@27.5496148,30.8145514,18z/data=!4m12!1m6!3m5!1s0x1444de0f8fd5d181:0xe5cea6fceb2878e3!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSDYqNiv2YrYsdmI2Lc!8m2!3d27.549484!4d30.813441!3m4!1s0x1444de0f8fd5d181:0xe5cea6fceb2878e3!8m2!3d27.549484!4d30.813441'),
(2, 'قوصية', '30.8225102', '27.4424671', 'شركة مصر الوسطى لتوزيع الكهرباء بالقوصية\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%A7%D9%84%D9%82%D9%88%D8%B5%D9%8A%D8%A9%E2%80%AD/@27.4424671,30.8225102,18z/data=!4m12!1m6!3m5!1s0x1444e3e60b3e5fd7:0xc904c3f7052ff44!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINin2YTZgtmI2LXZitip!8m2!3d27.442341!4d30.821432!3m4!1s0x1444e3e60b3e5fd7:0xc904c3f7052ff44!8m2!3d27.442341!4d30.821432'),
(3, '	أبنوب', '31.1527658', '27.2641446', 'شركة مصر الوسطى لتوزيع الكهرباء ابنوب\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%A7%D8%A8%D9%86%D9%88%D8%A8%E2%80%AD/@27.2641446,31.1527658,19z/data=!4m12!1m6!3m5!1s0x14450e6b39be5d7f:0x2b94b7c77ec18b8a!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINin2KjZhtmI2Kg!8m2!3d27.264122!4d31.152165!3m4!1s0x14450e6b39be5d7f:0x2b94b7c77ec18b8a!8m2!3d27.264122!4d31.152165'),
(4, '	منفلوط', '30.9700507', '27.3133874', 'شركة مصر الوسطى لتوزيع الكهرباء منفلوط\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D9%85%D9%86%D9%81%D9%84%D9%88%D8%B7%E2%80%AD/@27.3133874,30.9700507,21z/data=!4m5!3m4!1s0x0:0x59c55ccabf32327e!8m2!3d27.313324!4d30.969928'),
(5, '	أبو تيج', '31.3163123', '27.0537679', 'شركة مصر الوسطى لتوزيع الكهرباء ابوتيج\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%A7%D8%A8%D9%88+%D8%AA%D9%8A%D8%AC%E2%80%AD/@27.0537679,31.3163123,19z/data=!4m5!3m4!1s0x0:0xa2cb45def874280e!8m2!3d27.0536354!4d31.3157894'),
(6, '	الغنايم', '31.3271991', '26.8728449', 'شركة مصر الوسطى لتوزيع الكهرباء الغنايم\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%A7%D9%84%D8%BA%D9%86%D8%A7%D9%8A%D9%85%E2%80%AD/@26.8728449,31.3271991,19z/data=!4m5!3m4!1s0x14459719e60edcb7:0x4b9532bccda22390!8m2!3d26.872705!4d31.326668'),
(7, 'ساحل سليم', '31.3412712', '27.0578174', 'شركة مصر الوسطى لتوزيع الكهرباء ساحل سليم\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%B3%D8%A7%D8%AD%D9%84+%D8%B3%D9%84%D9%8A%D9%85%E2%80%AD/@27.0578174,31.3412712,20z/data=!4m12!1m6!3m5!1s0x14459e10493b44df:0x3a998e9df5795c5d!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINiz2KfYrdmEINiz2YTZitmF!8m2!3d27.057732!4d31.341003!3m4!1s0x14459e10493b44df:0x3a998e9df5795c5d!8m2!3d27.057732!4d31.341003'),
(8, '	البداري', '31.408477', '26.9981963', 'شركة مصر الوسطى لتوزيع الكهرباء البدارى\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%A7%D9%84%D8%A8%D8%AF%D8%A7%D8%B1%D9%89%E2%80%AD/@26.9981963,31.408477,19z/data=!4m12!1m6!3m5!1s0x14459cf10459be01:0xaf0cc61a0a9a449b!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINin2YTYqNiv2KfYsdmJ!8m2!3d26.998078!4d31.407954!3m4!1s0x14459cf10459be01:0xaf0cc61a0a9a449b!8m2!3d26.998078!4d31.407954'),
(9, '	صدفا', '31.3791533', '26.9650874', 'شركة مصر الوسطى لتوزيع الكهرباء صدفا\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%B5%D8%AF%D9%81%D8%A7%E2%80%AD/@26.9650874,31.3791533,18z/data=!4m12!1m6!3m5!1s0x14459b92c745f333:0x758b63c1cf4181e8!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINi12K_Zgdin!8m2!3d26.964932!4d31.378059!3m4!1s0x14459b92c745f333:0x758b63c1cf4181e8!8m2!3d26.964932!4d31.378059'),
(10, 'غرب اسيوط', '31.1778889', '27.1681892', 'شركة مصر الوسطى لتوزيع الكهرباء غرب اسيوط\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%BA%D8%B1%D8%A8+%D8%A7%D8%B3%D9%8A%D9%88%D8%B7%E2%80%AD/@27.1681892,31.1778889,20z/data=!4m5!3m4!1s0x14450bdbefcf366f:0x25bbd81557ebd879!8m2!3d27.168092!4d31.177622'),
(11, 'شمال اسيوط', '31.2034355', '27.1786488', 'شركة مصر الوسطى لتوزيع الكهرباء شمال اسيوط\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%B4%D9%85%D8%A7%D9%84+%D8%A7%D8%B3%D9%8A%D9%88%D8%B7%E2%80%AD/@27.1786488,31.2034355,14z/data=!4m12!1m6!3m5!1s0x14450beedb7c6049:0x19f7495137a68294!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINi02YXYp9mEINin2LPZitmI2Lc!8m2!3d27.1783117!4d31.1859257!3m4!1s0x14450beedb7c6049:0x19f7495137a68294!8m2!3d27.1783117!4d31.1859257'),
(12, 'اسيوط', '31.2053132', '27.1729806', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد\n', 'w', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D9%8A%D8%A7%D9%87+%D8%A7%D9%84%D8%B4%D8%B1%D8%A8+%D9%88%D8%A7%D9%84%D8%B5%D8%B1%D9%81+%D8%A7%D9%84%D8%B5%D8%AD%D9%8A+%D8%A8%D8%A3%D8%B3%D9%8A%D9%88%D8%B7+%D9%88%D8%A7%D9%84%D9%88%D8%A7%D8%AF%D9%8A+%D8%A7%D9%84%D8%AC%D8%AF%D9%8A%D8%AF%E2%80%AD/@27.1729806,31.2053132,17z/data=!4m12!1m6!3m5!1s0x14450b972d0fb135:0xcfbbd00ecfc7e476!2z2LTYsdmD2Kkg2YXZitin2Ycg2KfZhNi02LHYqCDZiNin2YTYtdix2YEg2KfZhNi12K3ZiiDYqNij2LPZitmI2Lcg2YjYp9mE2YjYp9iv2Yog2KfZhNis2K_Zitiv!8m2!3d27.1729758!4d31.2031245!3m4!1s0x14450b972d0fb135:0xcfbbd00ecfc7e476!8m2!3d27.1729758!4d31.2031245'),
(13, 'أبو تيج', '31.3276882', '27.0438707', 'محطة مياة الشرب والصرف الصحي بابوتبج\n', 'w', 'https://www.google.com/maps/place/%D9%85%D8%AD%D8%B7%D8%A9+%D9%85%D9%8A%D8%A7%D8%A9+%D8%A7%D9%84%D8%B4%D8%B1%D8%A8+%D9%88%D8%A7%D9%84%D8%B5%D8%B1%D9%81+%D8%A7%D9%84%D8%B5%D8%AD%D9%8A+%D8%A8%D8%A7%D8%A8%D9%88%D8%AA%D8%A8%D8%AC%E2%80%AD/@27.0438707,31.3276882,14.89z/data=!4m8!1m2!2m1!1z2LTYsdmD2Kkg2YXYp9ihICDYp9io2YjYqtmK2Kw!3m4!1s0x14459e5cd152b64b:0x9fd9865b5b60d022!8m2!3d27.041625!4d31.328069'),
(14, 'ساحل سليم', '31.3412927', '27.0578407', 'شركة مصر الوسطى لتوزيع الكهرباء - ساحل سليم\n', 'e', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%85%D8%B5%D8%B1+%D8%A7%D9%84%D9%88%D8%B3%D8%B7%D9%89+%D9%84%D8%AA%D9%88%D8%B2%D9%8A%D8%B9+%D8%A7%D9%84%D9%83%D9%87%D8%B1%D8%A8%D8%A7%D8%A1+-+%D8%B3%D8%A7%D8%AD%D9%84+%D8%B3%D9%84%D9%8A%D9%85%E2%80%AD/@27.0578407,31.3412927,19z/data=!4m12!1m6!3m5!1s0x14459e10493b44df:0x3a998e9df5795c5d!2z2LTYsdmD2Kkg2YXYtdixINin2YTZiNiz2LfZiSDZhNiq2YjYstmK2Lkg2KfZhNmD2YfYsdio2KfYoSAtINiz2KfYrdmEINiz2YTZitmF!8m2!3d27.057732!4d31.341003!3m4!1s0x14459e10493b44df:0x3a998e9df5795c5d!8m2!3d27.057732!4d31.341003'),
(15, 'اسيوط', '31.1793903', '27.1875332', 'شركة النيل لتسويق البترول - بترونيل\n', 'g', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D8%A7%D9%84%D9%86%D9%8A%D9%84+%D9%84%D8%AA%D8%B3%D9%88%D9%8A%D9%82+%D8%A7%D9%84%D8%A8%D8%AA%D8%B1%D9%88%D9%84+-+%D8%A8%D8%AA%D8%B1%D9%88%D9%86%D9%8A%D9%84%E2%80%AD/@27.1875332,31.1793903,21z/data=!4m12!1m6!3m5!1s0x14450bfbae7425bf:0x7db07f8bdbf06992!2z2LTYsdmD2Kkg2KfZhNmG2YrZhCDZhNiq2LPZiNmK2YIg2KfZhNio2KrYsdmI2YQgLSDYqNiq2LHZiNmG2YrZhA!8m2!3d27.1874602!4d31.1792569!3m4!1s0x14450bfbae7425bf:0x7db07f8bdbf06992!8m2!3d27.1874602!4d31.1792569'),
(16, 'اسيوط', '31.1759939', '27.1973233', 'شركة وادي النيل للغاز\n', 'g', 'https://www.google.com/maps/place/%D8%B4%D8%B1%D9%83%D8%A9+%D9%88%D8%A7%D8%AF%D9%8A+%D8%A7%D9%84%D9%86%D9%8A%D9%84+%D9%84%D9%84%D8%BA%D8%A7%D8%B2%E2%80%AD/@27.1973233,31.1759939,21z/data=!4m5!3m4!1s0x14450c00c68864fb:0xf0c4c6474d8c5e6e!8m2!3d27.197267!4d31.1758618');

-- --------------------------------------------------------

--
-- بنية الجدول `location3`
--

CREATE TABLE `location3` (
  `ID` int(14) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lat` varchar(260) NOT NULL,
  `longt` varchar(255) NOT NULL,
  `service` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `location3`
--

INSERT INTO `location3` (`ID`, `name`, `lat`, `longt`, `service`, `company_name`) VALUES
(1, 'ديروط', '30.8145514', '27.5496148', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء بديروط'),
(2, 'ديروط', '31.1793903', '27.1875332', 'g', 'شركة النيل لتسويق البترول - بترونيل'),
(3, 'ديروط', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(4, 'قوصية', '30.8225102', '27.4424671', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء بالقوصية'),
(5, 'قوصية', '31.1793903', '27.1875332', 'g', 'شركة النيل لتسويق البترول - بترونيل'),
(6, 'قوصية', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(7, 'أبنوب', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(8, 'أبنوب', '31.1527658', '27.2641446', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء ابنوب'),
(9, 'أبنوب', '31.1793903', '27.1875332', 'g', 'شركة النيل لتسويق البترول - بترونيل'),
(10, 'منفلوط', '30.9700507', '27.3133874', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء منفلوط'),
(11, 'منفلوط', '31.1793903', '27.1875332', 'g', 'شركة النيل لتسويق البترول - بترونيل'),
(12, 'منفلوط', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(13, 'أبو تيج', '31.3163123', '27.0537679', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء ابوتيج'),
(14, 'أبو تيج', '31.328081', '27.0417084', 'w', 'محطة مياة الشرب والصرف الصحي بابوتبج'),
(15, 'أبو تيج', '31.1793903', '27.1875332', 'g', 'شركة النيل لتسويق البترول - بترونيل'),
(16, 'الغنايم', '31.3271991', '26.8728449', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء الغنايم'),
(17, 'الغنايم', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(18, 'الغنايم', '31.1759939', '27.1973233', 'g', 'شركة وادي النيل للغاز'),
(19, 'ساحل سليم', '31.3412712', '27.0578174', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء ساحل سليم'),
(20, 'ساحل سليم', '31.3412927', '27.0578407', 'w', 'محطة مياة الشرب والصرف الصحي بساحل سليم'),
(21, 'ساحل سليم', '31.1759939', '27.1973233', 'g', 'شركة وادي النيل للغاز'),
(22, 'البداري', '31.408477', '26.9981963', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء البدارى'),
(23, 'البداري', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(24, 'البداري', '31.1759939', '27.1973233', 'g', 'شركة وادي النيل للغاز'),
(25, 'صدفا', '31.1778889', '27.1681892', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء صدفا'),
(26, 'صدفا', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(27, 'صدفا', '31.1759939', '27.1973233', 'g', 'شركة وادي النيل للغاز'),
(28, 'اسيوط', '31.1778889', '27.1681892', 'e', 'شركة مصر الوسطى لتوزيع الكهرباء اسيوط'),
(29, 'اسيوط', '31.2053132', '27.1729806', 'w', 'شركة مياه الشرب والصرف الصحي بأسيوط والوادي الجديد'),
(30, 'اسيوط', '31.1759939', '27.1973233', 'g', 'شركة وادي النيل للغاز'),
(31, 'سوهاج', '31.6951421', '26.5658588', 'e', 'شركة مصر العليا لتوزيع الكهرباء - سوهاج'),
(32, 'سوهاج', '31.6926747', '26.5685264', 'w', 'شركه مياه الشرب و الصرف الصحي'),
(33, 'سوهاج', '31.6952048', '26.5564525', 'g', 'مصر للبترول'),
(34, 'دار السلام', '32.0533705', '26.2776488', 'e', 'شركة مصر العليا لتوزيع الكهرباء - دار السلام'),
(35, 'دار السلام', '32.011819', '26.2496493', 'w', 'محطة مياه دار السلام'),
(36, 'دار السلام', '31.6952048', '26.5564525', 'g', 'مصر للبترول'),
(37, 'طهطا', '31.4995346', '26.7699079', 'e', 'شركة الكهرباء فرع طهطا'),
(38, 'طهطا', '31.4994146', '26.7707369', 'w', 'شركة المياه'),
(39, 'طهطا', '31.6952048', '26.5564525', 'g', 'مصر للبترول');

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `Not_Id` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `U_ID` int(14) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` int(14) NOT NULL,
  `not_Admin` int(14) NOT NULL,
  `type` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `stop_sub`
--

CREATE TABLE `stop_sub` (
  `ID` int(11) NOT NULL,
  `U_ID` int(14) NOT NULL,
  `service` varchar(255) NOT NULL,
  `stop_date` date NOT NULL,
  `Duration` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `sub`
--

CREATE TABLE `sub` (
  `s_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `ID` int(14) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(260) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `Phone` varchar(250) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Govern` varchar(255) NOT NULL,
  `Center` varchar(255) NOT NULL,
  `District` varchar(255) NOT NULL,
  `address` varchar(300) NOT NULL,
  `Electricity` tinyint(1) NOT NULL,
  `Water` tinyint(1) NOT NULL,
  `Gas` tinyint(1) NOT NULL,
  `ERate` int(14) NOT NULL DEFAULT '0' COMMENT 'value between 0 and 5',
  `WRate` int(14) NOT NULL DEFAULT '0',
  `GRate` int(14) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`ID`, `UserName`, `Password`, `FullName`, `social_id`, `Phone`, `Email`, `Govern`, `Center`, `District`, `address`, `Electricity`, `Water`, `Gas`, `ERate`, `WRate`, `GRate`) VALUES
(1, 'ali', 'ali123', 'احمد محمد احمد محمد', '29707071276458', '01553399456', 'ali@gmail.com', 'اسيوط', 'اسيوط', 'حى السادات', '', 1, 1, 1, 0, 0, 0),
(2, 'wael', 'wael11', 'وائل محمد', '29787871276422', '11', 'wael@gmail.com', 'اسيوط', 'اسيوط', 'الزهراء', '', 6, 4, 8, 5, 5, 8),
(3, 'ahmed', 'ahmed333', 'احمد حسن على', '27087878276433', '012354654', 'ahmed@gmail.com', 'اسيوط', 'اسيوط', 'حى السادات', 'ش.المعز', 1, 1, 1, 0, 0, 0),
(4, 'خالد', 'khaled999', 'خالد علي', '23707071276489', '123', 'khaled@m.com', 'اسيوط', 'ديروط', 'none', '', 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `vbank`
--

CREATE TABLE `vbank` (
  `cid` int(11) NOT NULL,
  `c_num` varchar(255) NOT NULL,
  `exdate` varchar(255) NOT NULL,
  `cvc` varchar(255) NOT NULL,
  `c_owner` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `vbank`
--

INSERT INTO `vbank` (`cid`, `c_num`, `exdate`, `cvc`, `c_owner`, `count`) VALUES
(1, '54554778236548', '3/2019', '357', 'ahmed', '37000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `ddd` (`UserName`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`C_id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD KEY `govern_id` (`govern_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `U_id` (`U_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`D_id`),
  ADD KEY `govern_id` (`govern_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `govern`
--
ALTER TABLE `govern`
  ADD PRIMARY KEY (`G_id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_Id`),
  ADD KEY `U_id` (`U_id`),
  ADD KEY `invoice_admin` (`invoice_admin`);

--
-- Indexes for table `location3`
--
ALTER TABLE `location3`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`Not_Id`),
  ADD KEY `U_ID` (`U_ID`),
  ADD KEY `not_Admin` (`not_Admin`);

--
-- Indexes for table `stop_sub`
--
ALTER TABLE `stop_sub`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `jh` (`social_id`),
  ADD UNIQUE KEY `hghg` (`UserName`);

--
-- Indexes for table `vbank`
--
ALTER TABLE `vbank`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `D_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `govern`
--
ALTER TABLE `govern`
  MODIFY `G_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `location3`
--
ALTER TABLE `location3`
  MODIFY `ID` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `Not_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stop_sub`
--
ALTER TABLE `stop_sub`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub`
--
ALTER TABLE `sub`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vbank`
--
ALTER TABLE `vbank`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_ibfk_1` FOREIGN KEY (`govern_id`) REFERENCES `govern` (`G_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`U_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `districts_ibfk_2` FOREIGN KEY (`govern_id`) REFERENCES `govern` (`G_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`U_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`invoice_admin`) REFERENCES `admin` (`Admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`not_Admin`) REFERENCES `admin` (`Admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `stop_sub`
--
ALTER TABLE `stop_sub`
  ADD CONSTRAINT `stop_sub_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `sub`
--
ALTER TABLE `sub`
  ADD CONSTRAINT `sub_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
