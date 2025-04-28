-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 07:26 PM
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
-- Database: `shoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Adname` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Fname` varchar(50) DEFAULT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Adname`, `Password`, `Email`, `Fname`, `Lname`, `Address`, `Phone`) VALUES
(1, 'admin1', 'pass123', 'admin1@email.com', 'Alice', 'Nguyen', '123 Street, Hanoi', '0909123456'),
(2, 'admin01', 'pass123', 'admin1@example.com', 'John', 'Smith', '123 Main St', '0123456789'),
(3, 'admin02', 'pass124', 'admin2@example.com', 'Jane', 'Doe', '456 Central Ave', '0123456790'),
(4, 'admin03', 'pass125', 'admin3@example.com', 'Alice', 'Brown', '789 Maple Rd', '0123456791'),
(5, 'admin04', 'pass126', 'admin4@example.com', 'Bob', 'Davis', '101 Oak St', '0123456792'),
(6, 'admin05', 'pass127', 'admin5@example.com', 'Carol', 'Wilson', '202 Pine St', '0123456793'),
(7, 'admin06', 'pass128', 'admin6@example.com', 'David', 'Lee', '303 Elm St', '0123456794'),
(8, 'admin07', 'pass129', 'admin7@example.com', 'Eva', 'Taylor', '404 Cedar St', '0123456795'),
(9, 'admin08', 'pass130', 'admin8@example.com', 'Frank', 'Martin', '505 Birch Rd', '0123456796'),
(10, 'admin09', 'pass131', 'admin9@example.com', 'Grace', 'Walker', '606 Spruce Ln', '0123456797'),
(11, 'admin10', 'pass132', 'admin10@example.com', 'Henry', 'Clark', '707 Walnut St', '0123456798');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `MemberID` int(11) DEFAULT NULL,
  `Total_price` decimal(10,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `MemberID`, `Total_price`, `Quantity`, `Date`) VALUES
(1, 1, 2500000.00, 1, '2025-04-01'),
(2, 1, 240.00, 2, '2024-04-01'),
(3, 2, 150.00, 1, '2024-04-02'),
(4, 3, 130.00, 2, '2024-04-03'),
(5, 4, 70.00, 1, '2024-04-04'),
(6, 5, 180.00, 1, '2024-04-05'),
(7, 6, 135.00, 3, '2024-04-06'),
(8, 7, 200.00, 2, '2024-04-07'),
(9, 8, 35.00, 1, '2024-04-08'),
(10, 9, 210.00, 3, '2024-04-09'),
(11, 10, 95.00, 1, '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `cart_shoes`
--

CREATE TABLE `cart_shoes` (
  `CartID` int(11) NOT NULL,
  `ShoesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_shoes`
--

INSERT INTO `cart_shoes` (`CartID`, `ShoesID`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 4),
(5, 5),
(6, 2),
(6, 7),
(6, 8),
(7, 9),
(7, 10),
(8, 8),
(9, 1),
(9, 5),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Name`, `Description`) VALUES
(1, 'Sneakers', 'Giày thể thao'),
(2, 'Boots', 'Giày boot'),
(3, 'Sandals', 'Dép sandal'),
(4, 'Running', 'Giày chạy bộ'),
(5, 'Sneakers', 'Giày sneaker thời trang'),
(6, 'Boots', 'Giày bốt nam/nữ'),
(7, 'Sandals', 'Giày dép sandal'),
(8, 'Formal', 'Giày tây công sở'),
(9, 'Slippers', 'Dép đi trong nhà'),
(10, 'Basketball', 'Giày bóng rổ'),
(11, 'Soccer', 'Giày đá bóng'),
(12, 'Skateboarding', 'Giày trượt ván'),
(13, 'Casual', 'Giày đi hàng ngày');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `Mem_ID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `ShoesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `Mem_ID`, `Rating`, `Date`, `ShoesID`) VALUES
(1, 1, 5, '2025-04-03', 1),
(2, 1, 5, '2024-04-01', 1),
(3, 2, 4, '2024-04-02', 2),
(4, 3, 3, '2024-04-03', 3),
(5, 4, 5, '2024-04-04', 4),
(6, 5, 2, '2024-04-05', 5),
(7, 6, 4, '2024-04-06', 2),
(8, 7, 5, '2024-04-07', 9),
(9, 8, 3, '2024-04-08', 8),
(10, 9, 4, '2024-04-09', 1),
(11, 10, 5, '2024-04-10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `Name`, `Phone`, `Message`, `Status`, `AdminID`) VALUES
(1, 'Khách A', '0909333444', 'Tôi muốn đổi size', 'Chưa xử lý', 1),
(2, 'Nguyễn A', '0911000101', 'Cần hỗ trợ đơn hàng #1', 'Open', 1),
(3, 'Trần B', '0911000102', 'Hỏi về chính sách đổi trả', 'Closed', 2),
(4, 'Lê C', '0911000103', 'Phản hồi về sản phẩm lỗi', 'Open', 3),
(5, 'Phạm D', '0911000104', 'Yêu cầu tư vấn kích cỡ', 'Closed', 4),
(6, 'Hoàng E', '0911000105', 'Phản hồi dịch vụ giao hàng', 'Open', 5),
(7, 'Vũ F', '0911000106', 'Thắc mắc về giá', 'Open', 6),
(8, 'Bùi G', '0911000107', 'Yêu cầu hủy đơn', 'Closed', 7),
(9, 'Đặng H', '0911000108', 'Hỏi về khuyến mãi', 'Open', 8),
(10, 'Hà I', '0911000109', 'Góp ý giao diện website', 'Closed', 9),
(11, 'Phan J', '0911000110', 'Phản hồi trải nghiệm mua hàng', 'Open', 10);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Exp_VIP` date DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Username`, `Password`, `Name`, `Email`, `Phone`, `Exp_VIP`, `AdminID`) VALUES
(1, 'user1', 'userpass', 'Bob Tran', 'bob@email.com', '0909111222', '2025-12-31', 1),
(2, 'user1', 'pwd1', 'Nam Nguyễn', 'nam1@mail.com', '0911000001', '2025-12-31', 1),
(3, 'user2', 'pwd2', 'Linh Trần', 'linh2@mail.com', '0911000002', '2025-12-30', 1),
(4, 'user3', 'pwd3', 'Hùng Phạm', 'hung3@mail.com', '0911000003', '2025-12-29', 2),
(5, 'user4', 'pwd4', 'Mai Lê', 'mai4@mail.com', '0911000004', '2025-12-28', 2),
(6, 'user5', 'pwd5', 'Minh Đỗ', 'minh5@mail.com', '0911000005', '2025-12-27', 3),
(7, 'user6', 'pwd6', 'Thảo Hồ', 'thao6@mail.com', '0911000006', '2025-12-26', 3),
(8, 'user7', 'pwd7', 'Khang Võ', 'khang7@mail.com', '0911000007', '2025-12-25', 4),
(9, 'user8', 'pwd8', 'Yến Bùi', 'yen8@mail.com', '0911000008', '2025-12-24', 4),
(10, 'user9', 'pwd9', 'Quân Đặng', 'quan9@mail.com', '0911000009', '2025-12-23', 5),
(11, 'user10', 'pwd10', 'Hà Vũ', 'ha10@mail.com', '0911000010', '2025-12-22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `DateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `Title`, `Description`, `Content`, `AdminID`, `thumbnail`, `DateCreated`) VALUES
(1, 'Giảm giá mùa hè', 'Ưu đãi lên đến 50%', 'Chi tiết khuyến mãi mùa hè...', 1, 'assets/images/news/news_1_1745860271.jpg', '2024-01-01 10:00:00'),
(2, 'Khuyến mãi hè', 'Giảm giá 20% cho tất cả giày thể thao', 'Chi tiết chương trình khuyến mãi...', 1, 'assets/images/news/news_2_1745860283.jpg', '2024-02-01 10:00:00'),
(3, 'Ra mắt dòng mới', 'Giới thiệu bộ sưu tập thu đông', 'Chi tiết bộ sưu tập thu đông...', 2, 'assets/images/news/news_3_1745860300.jpg', '2024-03-01 10:00:00'),
(4, 'Flash Sale', 'Giảm giá sốc trong 2 giờ', 'Chi tiết flash sale...', 3, 'assets/images/news/news_4_1745860307.jpg', '2024-04-01 10:00:00'),
(5, 'Mở cửa hàng mới', 'Khai trương cửa hàng tại Hà Nội', 'Thông tin cửa hàng mới...', 4, 'assets/images/news/news_5_1745860314.jpg', '2024-05-01 10:00:00'),
(6, 'Giao hàng miễn phí', 'Miễn phí vận chuyển toàn quốc', 'Chi tiết chương trình...', 5, 'assets/images/news/news_6_1745860321.jpg', '2024-06-01 10:00:00'),
(7, 'Đổi trả linh hoạt', 'Chính sách đổi trả 30 ngày', 'Chi tiết chính sách...', 6, 'assets/images/news/news_7_1745860330.jpg', '2024-07-01 10:00:00'),
(8, 'Tặng voucher', 'Nhận voucher 100k cho đơn đầu', 'Chi tiết voucher...', 7, 'assets/images/news/news_8_1745860337.jpg', '2024-08-01 10:00:00'),
(9, 'Bảo hành sản phẩm', 'Chính sách bảo hành 1 năm', 'Thông tin bảo hành...', 8, 'assets/images/news/news_9_1745860353.jpg', '2024-09-01 10:00:00'),
(10, 'Sự kiện offline', 'Tham gia sự kiện offline tại TP.HCM', 'Chi tiết sự kiện...', 9, 'assets/images/news/news_10_1745860345.jpg', '2024-10-01 10:00:00'),
(11, 'Tin tuyển dụng', 'Tuyển dụng nhân viên kinh doanh', 'Thông tin tuyển dụng...', 10, 'assets/images/news/news_11_1745860361.jpg', '2024-11-01 10:00:00'),
(13, 'sadasd', 'dâsd', 'ádasdsa', 1, 'assets/images/news/news_1745851875.png', '2025-04-28 21:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `MemberID` int(11) DEFAULT NULL,
  `Total_price` decimal(10,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Earned_VIP` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `MemberID`, `Total_price`, `Quantity`, `Date`, `Earned_VIP`, `Status`) VALUES
(1, 1, 2500000.00, 1, '2025-04-02', 100000.00, 'Delivered'),
(2, 1, 240.00, 2, '2024-04-11', 10.00, 'Delivered'),
(3, 2, 150.00, 1, '2024-04-12', 0.00, 'Pending'),
(4, 3, 130.00, 2, '2024-04-13', 0.00, 'Cancelled'),
(5, 4, 70.00, 1, '2024-04-14', 5.00, 'Delivered'),
(6, 5, 180.00, 1, '2024-04-15', 8.00, 'Shipped'),
(7, 6, 135.00, 3, '2024-04-16', 12.00, 'Delivered'),
(8, 7, 200.00, 2, '2024-04-17', 0.00, 'Processing'),
(9, 8, 35.00, 1, '2024-04-18', 3.00, 'Delivered'),
(10, 9, 210.00, 3, '2024-04-19', 15.00, 'Shipped'),
(11, 10, 95.00, 1, '2024-04-20', 0.00, 'Pending'),
(12, 1, 240.00, 2, '2024-04-11', 10.00, 'Delivered'),
(13, 2, 150.00, 1, '2024-04-12', 0.00, 'Pending'),
(14, 3, 130.00, 2, '2024-04-13', 0.00, 'Cancelled'),
(15, 4, 70.00, 1, '2024-04-14', 5.00, 'Delivered'),
(16, 5, 180.00, 1, '2024-04-15', 8.00, 'Shipped'),
(17, 6, 135.00, 3, '2024-04-16', 12.00, 'Delivered'),
(18, 7, 200.00, 2, '2024-04-17', 0.00, 'Processing'),
(19, 8, 35.00, 1, '2024-04-18', 3.00, 'Delivered'),
(20, 9, 210.00, 3, '2024-04-19', 15.00, 'Shipped'),
(21, 10, 95.00, 1, '2024-04-20', 0.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_shoes`
--

CREATE TABLE `order_shoes` (
  `OrderID` int(11) NOT NULL,
  `ShoesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_shoes`
--

INSERT INTO `order_shoes` (`OrderID`, `ShoesID`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 4),
(5, 5),
(6, 2),
(6, 8),
(7, 9),
(7, 10),
(8, 8),
(9, 1),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `ShoesID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `DateCreate` date DEFAULT NULL,
  `DateUpdate` date DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `shoes_size` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`ShoesID`, `Name`, `Price`, `Stock`, `Description`, `DateCreate`, `DateUpdate`, `Image`, `CategoryID`, `shoes_size`) VALUES
(1, 'Nike Air Max', 2500000.00, 100, 'Giày chạy bộ cao cấp', '2025-01-01', '2025-03-01', 'nike.jpg', 1, 38.00),
(2, 'Dr. Martens', 3000000.00, 50, 'Giày boot thời trang', '2025-02-01', '2025-03-15', 'drmartens.jpg', 2, 39.00),
(3, 'Nike Air Zoom', 120.00, 50, 'Giày chạy bộ cao cấp', '2024-01-01', '2024-03-01', 'nike_air.png', 1, 40.00),
(4, 'Adidas Ultraboost', 150.00, 30, 'Giày thể thao Adidas', '2024-02-01', '2024-04-01', 'ultraboost.png', 1, 41.00),
(5, 'Converse Classic', 60.00, 40, 'Giày cổ điển Converse', '2024-01-15', '2024-03-10', 'converse.png', 2, 42.00),
(6, 'Vans Old Skool', 70.00, 35, 'Giày Vans thời trang', '2024-02-10', '2024-04-12', 'vans_old.png', 2, 43.00),
(7, 'Timberland Boots', 180.00, 20, 'Giày bốt cao cấp', '2024-01-25', '2024-04-05', 'timberland.png', 3, 44.00),
(8, 'Nike Sandals', 40.00, 25, 'Dép sandal Nike', '2024-03-01', '2024-03-20', 'nike_sandal.png', 4, 45.00),
(9, 'Oxford Shoes', 90.00, 15, 'Giày tây nam lịch sự', '2024-01-18', '2024-02-25', 'oxford.png', 5, 46.00),
(10, 'Adidas Slides', 35.00, 60, 'Dép đi trong nhà Adidas', '2024-02-22', '2024-03-30', 'slides.png', 6, 47.00),
(11, 'Jordan 1', 200.00, 10, 'Giày bóng rổ Jordan', '2024-01-05', '2024-04-10', 'jordan1.png', 7, 48.00),
(12, 'Nike Tiempo', 95.00, 12, 'Giày đá bóng Nike Tiempo', '2024-02-14', '2024-03-28', 'tiempo.png', 8, 49.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `cart_shoes`
--
ALTER TABLE `cart_shoes`
  ADD PRIMARY KEY (`CartID`,`ShoesID`),
  ADD KEY `ShoesID` (`ShoesID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `Mem_ID` (`Mem_ID`),
  ADD KEY `ShoesID` (`ShoesID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `order_shoes`
--
ALTER TABLE `order_shoes`
  ADD PRIMARY KEY (`OrderID`,`ShoesID`),
  ADD KEY `ShoesID` (`ShoesID`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`ShoesID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `ShoesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `cart_shoes`
--
ALTER TABLE `cart_shoes`
  ADD CONSTRAINT `cart_shoes_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
  ADD CONSTRAINT `cart_shoes_ibfk_2` FOREIGN KEY (`ShoesID`) REFERENCES `shoes` (`ShoesID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Mem_ID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`ShoesID`) REFERENCES `shoes` (`ShoesID`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `order_shoes`
--
ALTER TABLE `order_shoes`
  ADD CONSTRAINT `order_shoes_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  ADD CONSTRAINT `order_shoes_ibfk_2` FOREIGN KEY (`ShoesID`) REFERENCES `shoes` (`ShoesID`);

--
-- Constraints for table `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `shoes_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
