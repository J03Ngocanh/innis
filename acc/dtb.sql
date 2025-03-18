-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 09:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtb`
--

-- --------------------------------------------------------

--
-- Table structure for table `danhmucsp`
--

CREATE TABLE `danhmucsp` (
  `id_danhmuc` int(10) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL,
  `id_loai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incrementtable`
--

CREATE TABLE `incrementtable` (
  `TableName` varchar(50) NOT NULL,
  `CurrentValue` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incrementtable`
--

INSERT INTO `incrementtable` (`TableName`, `CurrentValue`) VALUES
('khachhang', 1),
('SanPham', 1);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` varchar(50) NOT NULL,
  `tenkhachhang` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sdt` varchar(15) NOT NULL,
  `ngaysinh` datetime DEFAULT NULL,
  `id_rank` int(3) NOT NULL,
  `verification_code` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `tenkhachhang`, `email`, `sdt`, `ngaysinh`, `id_rank`, `verification_code`) VALUES
('KH0001', 'evfrv', 'ngoanh@gmail.com', '0937482367', NULL, 1, NULL);

--
-- Triggers `khachhang`
--
DELIMITER $$
CREATE TRIGGER `before_insert_khachhang` BEFORE INSERT ON `khachhang` FOR EACH ROW BEGIN
    DECLARE next_value INT;

    -- Kiểm tra xem bảng IncrementTable đã có dữ liệu cho khachhang chưa
    IF (SELECT COUNT(*) FROM IncrementTable WHERE TableName = 'khachhang') = 0 THEN
        -- Nếu chưa có, thêm mới với giá trị bắt đầu là 0
        INSERT INTO IncrementTable (TableName, CurrentValue) VALUES ('khachhang', 0);
    END IF;

    -- Lấy giá trị hiện tại từ IncrementTable
    SELECT CurrentValue INTO next_value FROM IncrementTable WHERE TableName = 'khachhang' FOR UPDATE;

    -- Sinh mã khách hàng tự động (VD: KH0001, KH0002, ...)
    SET NEW.id = CONCAT('KH', LPAD(next_value + 1, 4, '0'));

    -- Cập nhật giá trị trong IncrementTable
    UPDATE IncrementTable SET CurrentValue = next_value + 1 WHERE TableName = 'khachhang';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `id_loaisp` int(10) NOT NULL,
  `tenloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`id_loaisp`, `tenloai`) VALUES
(1, 'Chăm sóc da mặt'),
(2, 'Make up'),
(3, 'Chăm sóc tóc và cơ thể');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `Manhanvien` int(50) NOT NULL,
  `Tennhanvien` int(50) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `nhanvien`
--
DELIMITER $$
CREATE TRIGGER `before_insert_nhanvien` BEFORE INSERT ON `nhanvien` FOR EACH ROW BEGIN
    DECLARE next_value INT;

    -- Kiểm tra xem bảng IncrementTable đã có dữ liệu cho nhanvien chưa
    IF (SELECT COUNT(*) FROM IncrementTable WHERE TableName = 'nhanvien') = 0 THEN
        -- Nếu chưa có, thêm mới với giá trị bắt đầu là 0
        INSERT INTO IncrementTable (TableName, CurrentValue) VALUES ('nhanvien', 0);
    END IF;

    -- Lấy giá trị hiện tại từ IncrementTable
    SELECT CurrentValue INTO next_value FROM IncrementTable WHERE TableName = 'nhanvien' FOR UPDATE;

    -- Sinh mã nhân viên tự động (VD: NV0001, NV0002, ...)
    SET NEW.Manhanvien = CONCAT('NV', LPAD(next_value + 1, 4, '0'));

    -- Cập nhật giá trị trong IncrementTable
    UPDATE IncrementTable SET CurrentValue = next_value + 1 WHERE TableName = 'nhanvien';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id_rank` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Min_point` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id_rank`, `name`, `Min_point`) VALUES
(1, 'Member', 300),
(2, 'Silver', 800),
(3, 'Gold', 1500),
(4, 'Diamond', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masanpham` varchar(50) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `tensanpham` varchar(500) NOT NULL,
  `mota` text DEFAULT NULL,
  `giagoc` int(10) DEFAULT NULL,
  `rate` int(5) DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `hinhanh1` varchar(100) DEFAULT NULL,
  `hinhanh2` varchar(100) DEFAULT NULL,
  `hinhanh3` varchar(100) DEFAULT NULL,
  `hinhanh4` varchar(100) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `ngay_them` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masanpham`, `id_danhmuc`, `tensanpham`, `mota`, `giagoc`, `rate`, `hinhanh`, `hinhanh1`, `hinhanh2`, `hinhanh3`, `hinhanh4`, `soluong`, `ngay_them`) VALUES
('SP001', 1, 'dvdv', 'dvfv', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `sanpham`
--
DELIMITER $$
CREATE TRIGGER `before_insert_sanpham` BEFORE INSERT ON `sanpham` FOR EACH ROW BEGIN
    DECLARE next_value INT;

    -- Kiểm tra xem bảng SanPham đã có trong IncrementTable chưa
    IF (SELECT COUNT(*) FROM IncrementTable WHERE TableName = 'SanPham') = 0 THEN
        -- Nếu chưa có, thêm mới với giá trị bắt đầu là 0
        INSERT INTO IncrementTable (TableName, CurrentValue) VALUES ('SanPham', 0);
    END IF;

    -- Lấy giá trị hiện tại từ IncrementTable
    SELECT CurrentValue INTO next_value FROM IncrementTable WHERE TableName = 'SanPham' FOR UPDATE;

    -- Sinh mã tự động (VD: SP001, SP002, ...)
    SET NEW.masanpham = CONCAT('SP', LPAD(next_value + 1, 3, '0'));

    -- Cập nhật giá trị trong IncrementTable
    UPDATE IncrementTable SET CurrentValue = next_value + 1 WHERE TableName = 'SanPham';
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhmucsp`
--
ALTER TABLE `danhmucsp`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Indexes for table `incrementtable`
--
ALTER TABLE `incrementtable`
  ADD PRIMARY KEY (`TableName`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sdt` (`sdt`) USING BTREE;

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`id_loaisp`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`Manhanvien`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id_rank`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masanpham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhmucsp`
--
ALTER TABLE `danhmucsp`
  MODIFY `id_danhmuc` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `id_loaisp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id_rank` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
