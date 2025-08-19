-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2025 lúc 07:09 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlketoan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bao_cao_tai_chinh`
--

CREATE TABLE `bao_cao_tai_chinh` (
  `BC_ID` int(11) NOT NULL,
  `NV_ID` int(11) NOT NULL,
  `BC_TONGTAISAN` decimal(15,0) NOT NULL,
  `BC_TONGNOPHAITRA` decimal(15,0) NOT NULL,
  `BC_TONGSOVON` decimal(15,0) NOT NULL,
  `BC_TONGDOANHTHU` decimal(15,0) NOT NULL,
  `BC_NGAYLAP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bao_cao_tai_chinh`
--

INSERT INTO `bao_cao_tai_chinh` (`BC_ID`, `NV_ID`, `BC_TONGTAISAN`, `BC_TONGNOPHAITRA`, `BC_TONGSOVON`, `BC_TONGDOANHTHU`, `BC_NGAYLAP`) VALUES
(1, 1, 100000000, 20000000, 80000000, 50000000, '2024-06-30'),
(2, 2, 120000000, 30000000, 90000000, 70000000, '2024-07-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong_no_thu`
--

CREATE TABLE `cong_no_thu` (
  `CNT_ID` int(11) NOT NULL,
  `HDB_ID` int(11) NOT NULL,
  `CNT_TONGTIEN` int(11) NOT NULL DEFAULT 0,
  `CNT_SOTIENTHU` decimal(15,0) NOT NULL,
  `CNT_CONNO` int(11) NOT NULL DEFAULT 0,
  `CNT_NGAYPHATSINH` date NOT NULL,
  `CNT_DUKIENTRA` date NOT NULL,
  `CNT_TRANGTHAI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cong_no_thu`
--

INSERT INTO `cong_no_thu` (`CNT_ID`, `HDB_ID`, `CNT_TONGTIEN`, `CNT_SOTIENTHU`, `CNT_CONNO`, `CNT_NGAYPHATSINH`, `CNT_DUKIENTRA`, `CNT_TRANGTHAI`) VALUES
(7, 1, 5000000, 5000000, 0, '2025-01-27', '2025-04-01', 'Đã thanh toán'),
(8, 3, 12000000, 12000000, 0, '2025-02-01', '2025-04-27', 'Đã thanh toán'),
(9, 2, 7500000, 7500000, 0, '2025-02-20', '2025-03-27', 'Đã thanh toán'),
(10, 5, 15000000, 15000000, 0, '2025-02-03', '2025-04-06', 'Đã thanh toán'),
(11, 7, 5000000, 2000000, 3000000, '2025-03-09', '2025-05-09', 'Còn nợ'),
(12, 9, 7500000, 2000000, 5500000, '2025-03-09', '2025-04-09', 'Còn nợ'),
(13, 11, 7000000, 2000000, 5000000, '2025-03-09', '2025-04-09', 'Còn nợ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong_no_tra`
--

CREATE TABLE `cong_no_tra` (
  `CNTR_ID` int(11) NOT NULL,
  `HDM_ID` int(11) NOT NULL,
  `CNTR_TONGTIEN` decimal(15,0) NOT NULL,
  `CNTR_SOTIENTRA` decimal(15,0) NOT NULL,
  `CNTR_CONNO` decimal(15,0) NOT NULL,
  `CNTR_NGAYPHATSINH` date NOT NULL,
  `CNTR_DUKIENTRA` date NOT NULL,
  `CNTR_TRANGTHAI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cong_no_tra`
--

INSERT INTO `cong_no_tra` (`CNTR_ID`, `HDM_ID`, `CNTR_TONGTIEN`, `CNTR_SOTIENTRA`, `CNTR_CONNO`, `CNTR_NGAYPHATSINH`, `CNTR_DUKIENTRA`, `CNTR_TRANGTHAI`) VALUES
(1, 1, 12000000, 12000000, 0, '2025-02-20', '2025-05-08', 'Đã thanh toán'),
(2, 3, 37000000000, 20000000000, 17000000000, '2025-03-09', '2025-04-09', 'Còn nợ'),
(3, 5, 13000000000, 10000000000, 30000000000, '2025-03-09', '2025-04-09', 'Còn nợ'),
(4, 6, 9000000000, 5000000000, 4000000000, '2025-03-09', '2025-04-09', 'Còn nợ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don_ban`
--

CREATE TABLE `hoa_don_ban` (
  `HDB_ID` int(11) NOT NULL,
  `NV_ID` int(11) NOT NULL,
  `KH_ID` int(11) NOT NULL,
  `HDB_TONGTIEN` decimal(15,0) NOT NULL,
  `HDB_DATHANHTOAN` decimal(15,0) NOT NULL,
  `HDB_LYDOTHU` varchar(100) NOT NULL,
  `HDB_TRANGTHAI` varchar(30) NOT NULL,
  `HDB_MOTA` varchar(100) DEFAULT NULL,
  `HDB_NGAYLAP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don_ban`
--

INSERT INTO `hoa_don_ban` (`HDB_ID`, `NV_ID`, `KH_ID`, `HDB_TONGTIEN`, `HDB_DATHANHTOAN`, `HDB_LYDOTHU`, `HDB_TRANGTHAI`, `HDB_MOTA`, `HDB_NGAYLAP`) VALUES
(1, 1, 1, 5000000, 3000000, 'Diện thoại Samsung A05s', 'Đã thanh toán', 'Mua hàng tháng 6', '2025-01-27'),
(2, 2, 2, 7500000, 7500000, 'Tivi Samsung', 'Đã thanh toán', 'Mua hàng tháng 7', '2025-02-20'),
(3, 2, 3, 12000000, 6000000, 'Mua Laptop Dell', 'Đã thanh toán', 'Mua hàng tháng 8', '2025-02-01'),
(4, 1, 4, 8500000, 8500000, 'Mua Máy giặt LG', 'Đã thanh toán', 'Mua hàng tháng 2', '2025-02-02'),
(5, 1, 5, 15000000, 10000000, 'Mua Smart TV Sony', 'Đã thanh toán', 'Mua hàng tháng 10', '2025-02-03'),
(6, 2, 1, 24000000, 24000000, 'Samsung Z Flip5', 'Đã thanh toán', NULL, '2025-04-01'),
(7, 1, 6, 5000000, 2000000, 'Samsung A12', 'Còn nợ', NULL, '2025-03-09'),
(9, 1, 7, 7500000, 2000000, 'Samsung M51', 'Còn nợ', NULL, '2025-03-09'),
(10, 2, 2, 16000000, 16000000, 'Tủ lạnh Samsung Multidoor', 'Đã thanh toán', NULL, '2025-04-08'),
(11, 2, 1, 7000000, 2000000, 'Máy Lạnh Samsung Inverter', 'Còn nợ', NULL, '2025-03-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don_mua`
--

CREATE TABLE `hoa_don_mua` (
  `HDM_ID` int(11) NOT NULL,
  `NCC_ID` int(11) NOT NULL,
  `HDM_TONGTIEN` decimal(15,0) NOT NULL,
  `HDM_DATHANHTOAN` decimal(15,0) NOT NULL,
  `HDM_LYDO` varchar(1000) NOT NULL,
  `HDM_TRANGTHAI` varchar(30) NOT NULL,
  `HDM_MOTA` mediumtext DEFAULT NULL,
  `HDM_NGAYLAP` date NOT NULL,
  `NV_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don_mua`
--

INSERT INTO `hoa_don_mua` (`HDM_ID`, `NCC_ID`, `HDM_TONGTIEN`, `HDM_DATHANHTOAN`, `HDM_LYDO`, `HDM_TRANGTHAI`, `HDM_MOTA`, `HDM_NGAYLAP`, `NV_ID`) VALUES
(1, 1, 12000000, 8000000, 'Thanh toán linh kiện', 'Đã thanh toán', 'Nhập hàng tháng 6', '2025-02-20', 4),
(2, 2, 9500000, 9500000, 'Thanh toán linh kiện', 'Đã thanh toán', 'Nhập hàng tháng 7', '2025-02-19', 4),
(3, 3, 37000000000, 20000000000, 'Thanh toán chip xử lý', 'Còn nợ', '', '2025-03-09', 4),
(5, 5, 13000000000, 10000000000, 'Thanh toán hệ thống làm lạnh và máy nén', 'Còn nợ', NULL, '2025-03-09', 4),
(6, 4, 9000000000, 5000000000, 'Thanh toán cảm biến camera', 'Còn nợ', NULL, '2025-03-09', 4),
(7, 6, 23000000000, 23000000000, 'Thanh toán chip điều khiển nguồn và cảm biến.', 'Đã thanh toán', NULL, '2025-03-09', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `KH_ID` int(11) NOT NULL,
  `KH_HOTEN` varchar(30) NOT NULL,
  `KH_SDT` varchar(15) NOT NULL,
  `KH_DIACHI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`KH_ID`, `KH_HOTEN`, `KH_SDT`, `KH_DIACHI`) VALUES
(1, 'Phạm Hoàng Nam', '0987654321', '567 Hoàng Văn Thụ, Đà Nẵng'),
(2, 'Ngô Bảo Anh', '0971234567', '789 Trần Hưng Đạo, Cần Thơ'),
(3, 'Trần Minh Khoa', '0905123456', '123 Lê Lợi, Hồ Chí Minh'),
(4, 'Lê Thị Thu Trang', '0916789123', '456 Nguyễn Huệ, Hà Nội'),
(5, 'Đặng Văn Hùng', '0923456789', '789 Lý Thường Kiệt, Hải Phòng'),
(6, 'Trương Minh Trí', '0753023456', '99B An Hòa, Hải Phòng'),
(7, 'Lý Thường Kiệt', '0693258741', '55B Phú Nhuận, Đà Nẳng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsu_phieuchi`
--

CREATE TABLE `lichsu_phieuchi` (
  `LSC_ID` int(11) NOT NULL,
  `PC_ID` int(11) DEFAULT NULL,
  `LSC_MANV` int(11) DEFAULT NULL,
  `LSC_THOIGIAN` datetime DEFAULT current_timestamp(),
  `LSC_TRUOC_SUA` decimal(15,0) DEFAULT NULL,
  `LSC_SAU_SUA` decimal(15,0) DEFAULT NULL,
  `LSC_HTOAN_TRUOC` date DEFAULT NULL,
  `LSC_HTOAN` date DEFAULT NULL,
  `LSC_CTU_TRUOC` date DEFAULT NULL,
  `LSC_CTU` date DEFAULT NULL,
  `TKKT_TRUOC` int(11) NOT NULL,
  `TKKT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsu_phieuchi`
--

INSERT INTO `lichsu_phieuchi` (`LSC_ID`, `PC_ID`, `LSC_MANV`, `LSC_THOIGIAN`, `LSC_TRUOC_SUA`, `LSC_SAU_SUA`, `LSC_HTOAN_TRUOC`, `LSC_HTOAN`, `LSC_CTU_TRUOC`, `LSC_CTU`, `TKKT_TRUOC`, `TKKT_ID`) VALUES
(1, NULL, 3, '2025-03-22 22:48:07', 0, 2000000, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, NULL),
(19, 28, 3, '2025-04-08 16:37:56', 1000000, 500000, '2025-05-08', '2025-05-08', '2025-02-20', '2025-02-08', 11, 11),
(20, 28, 3, '2025-04-08 16:43:58', 500000, 1000000, '2025-05-08', '2025-05-08', '2025-02-20', '2025-02-08', 11, 11),
(21, 28, 3, '2025-04-08 16:44:22', 1000000, 500000, '2025-05-08', '2025-05-08', '2025-02-20', '2025-02-08', 11, 11),
(22, 29, 3, '2025-04-08 16:50:36', 500000, 500000, '2025-05-08', '2025-05-08', '2025-02-20', '2025-05-08', 11, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsu_phieuthu`
--

CREATE TABLE `lichsu_phieuthu` (
  `LST_ID` int(11) NOT NULL,
  `PT_ID` int(11) DEFAULT NULL,
  `LST_MANV` int(11) DEFAULT NULL,
  `LST_THOIGIAN` datetime DEFAULT current_timestamp(),
  `LST_TRUOC_SUA` decimal(15,0) DEFAULT NULL,
  `LST_SAU_SUA` decimal(15,0) DEFAULT NULL,
  `LST_HT_TRUOC` date DEFAULT NULL,
  `LST_HT_SAU` date DEFAULT NULL,
  `LST_CTU_TRUOC` date DEFAULT NULL,
  `LST_CTU` date DEFAULT NULL,
  `TKKT_TRUOC` int(11) NOT NULL,
  `TKKT_SAU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsu_phieuthu`
--

INSERT INTO `lichsu_phieuthu` (`LST_ID`, `PT_ID`, `LST_MANV`, `LST_THOIGIAN`, `LST_TRUOC_SUA`, `LST_SAU_SUA`, `LST_HT_TRUOC`, `LST_HT_SAU`, `LST_CTU_TRUOC`, `LST_CTU`, `TKKT_TRUOC`, `TKKT_SAU`) VALUES
(3, 35, 3, '2025-03-27 18:18:51', 3000000, 4000000, '2025-03-27', '2025-03-27', '0000-00-00', '2025-02-02', 3, 3),
(4, 46, 3, '2025-04-01 17:21:42', 2000000, 1000000, '2025-04-27', '2025-04-27', '0000-00-00', '2025-02-01', 3, 3),
(5, 46, 3, '2025-04-01 17:28:56', 1000000, 1500000, '2025-04-27', '2025-04-27', '0000-00-00', '2025-02-01', 3, 3),
(6, 46, 3, '2025-04-01 17:33:08', 1500000, 1800000, '2025-04-27', '2025-04-27', '0000-00-00', '2025-02-01', 3, 3),
(7, 46, 5, '2025-04-01 21:08:02', 1800000, 2000000, '2025-04-27', '2025-04-27', '2025-02-01', '2025-02-01', 3, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `NV_ID` int(11) NOT NULL,
  `NV_HOTEN` varchar(30) NOT NULL,
  `NV_NAMSINH` date NOT NULL,
  `NV_EMAIL` varchar(30) NOT NULL,
  `NV_SDT` varchar(15) NOT NULL,
  `NV_DIACHI` varchar(50) NOT NULL,
  `NV_CHUCVU` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`NV_ID`, `NV_HOTEN`, `NV_NAMSINH`, `NV_EMAIL`, `NV_SDT`, `NV_DIACHI`, `NV_CHUCVU`) VALUES
(1, 'Nguyễn Hoàng Nam', '2003-09-09', 'nam@gmail.com', '0123456789', 'Quận 7, TP. HCM', 'Bán hàng'),
(2, 'Lê Minh Khôi', '1988-05-14', 'khoi.le@example.com', '0901234567', '123 Lê Lợi, Quận 1, TP.HCM', 'Bán hàng'),
(3, 'Trần Gia Hân', '1992-09-22', 'han.tran@example.com', '0912345678', '45 Nguyễn Trãi, Hà Nội', 'Kế toán'),
(4, 'Lê Hoàng Phong', '2003-09-09', 'phong@gmail.com', '0763472068', 'Quận 4, TP. HCM', 'Nhập kho'),
(5, 'Trần Thế Hào', '2000-04-10', 'hao@gmail.com', '0786820316', 'Quận 1, TP. HCM', 'Kế toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_cung_cap`
--

CREATE TABLE `nha_cung_cap` (
  `NCC_ID` int(11) NOT NULL,
  `NCC_TEN` varchar(100) NOT NULL,
  `NCC_EMAIL` varchar(30) NOT NULL,
  `NCC_SDT` varchar(15) NOT NULL,
  `NCC_DIACHI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nha_cung_cap`
--

INSERT INTO `nha_cung_cap` (`NCC_ID`, `NCC_TEN`, `NCC_EMAIL`, `NCC_SDT`, `NCC_DIACHI`) VALUES
(1, 'BOE Technology', 'contact@anphat.vn', '02887654321', '99 Lý Tự Trọng, TP.HCM'),
(2, 'LG Chem', 'info@thiennam.com', '0241239876', '56 Hoàng Quốc Việt, Hà Nội'),
(3, 'Qualcomm Incorporated', 'quain@gmail.com', '0896542130', 'San Diego, California, Hoa Kỳ'),
(4, 'Công ty công nghiệp Sony', 'sony@gmail.com', '0753021930', 'Minato, Tokyo, Nhật Bản'),
(5, 'Daikin America', 'daikin@gmail.com', '0456542130', 'Nakazaki-Nishi, Nhật Bản'),
(6, 'INFINEON TECHNOLOGIES', 'inf@gmail.com', '0563402298', 'Cầu Giấy, Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_chi`
--

CREATE TABLE `phieu_chi` (
  `PC_ID` int(11) NOT NULL,
  `HDM_ID` int(11) NOT NULL,
  `NV_ID` int(11) NOT NULL,
  `TKKT_ID` int(11) NOT NULL,
  `PC_NGAYHOACHTOAN` date NOT NULL,
  `PC_NGAYCHUNGTU` date NOT NULL,
  `PC_SOTIEN` decimal(15,0) NOT NULL,
  `PC_NOIDUNG` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_chi`
--

INSERT INTO `phieu_chi` (`PC_ID`, `HDM_ID`, `NV_ID`, `TKKT_ID`, `PC_NGAYHOACHTOAN`, `PC_NGAYCHUNGTU`, `PC_SOTIEN`, `PC_NOIDUNG`) VALUES
(2, 2, 3, 11, '2024-07-16', '2024-07-16', 9500000, 'Thanh toán đủ cho nhà cung cấp'),
(22, 3, 3, 11, '2025-04-02', '2025-04-03', 20000000000, ''),
(23, 5, 3, 11, '2025-04-02', '2025-04-02', 10000000000, ''),
(24, 6, 3, 11, '2025-04-02', '2025-04-02', 5000000000, ''),
(26, 1, 3, 11, '2025-04-08', '2025-02-08', 2000000, ''),
(27, 1, 3, 11, '2025-05-08', '2025-01-31', 1000000, ''),
(28, 1, 3, 11, '2025-05-08', '2025-02-08', 500000, ''),
(29, 1, 3, 11, '2025-05-08', '2025-05-08', 500000, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_thu`
--

CREATE TABLE `phieu_thu` (
  `PT_ID` int(11) NOT NULL,
  `TKKT_ID` int(11) NOT NULL,
  `NV_ID` int(11) DEFAULT NULL,
  `HDB_ID` int(11) NOT NULL,
  `PT_NGAYHOACHTOAN` date NOT NULL,
  `PT_NGAYCHUNGTU` date NOT NULL,
  `PT_SOTIEN` decimal(15,0) NOT NULL,
  `PT_NGUOILAP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_thu`
--

INSERT INTO `phieu_thu` (`PT_ID`, `TKKT_ID`, `NV_ID`, `HDB_ID`, `PT_NGAYHOACHTOAN`, `PT_NGAYCHUNGTU`, `PT_SOTIEN`, `PT_NGUOILAP`) VALUES
(18, 3, 1, 1, '2025-01-28', '2025-01-27', 3000000, 3),
(19, 3, 1, 1, '2025-03-01', '2025-02-28', 1000000, 3),
(21, 3, 2, 3, '2025-03-01', '2025-02-01', 6000000, 3),
(30, 3, 3, 2, '2025-03-27', '2025-02-20', 7500000, 0),
(35, 3, 3, 3, '2025-03-27', '2025-02-02', 4000000, 3),
(36, 3, 3, 4, '2025-03-27', '2025-02-02', 8500000, 0),
(46, 3, 3, 3, '2025-04-27', '2025-02-01', 2000000, 5),
(51, 3, 5, 6, '2025-04-01', '2025-04-01', 24000000, 0),
(53, 3, 5, 1, '2025-04-01', '2025-04-01', 1000000, 0),
(54, 3, 3, 5, '2025-02-03', '2025-02-03', 10000000, 0),
(55, 3, 3, 5, '2025-04-06', '2025-04-06', 5000000, 0),
(56, 3, 3, 7, '2025-03-09', '2025-03-09', 2000000, 0),
(57, 3, 3, 9, '2025-03-09', '2025-04-09', 2000000, 0),
(58, 3, 3, 11, '2025-03-09', '2025-04-09', 2000000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan_ketoan`
--

CREATE TABLE `taikhoan_ketoan` (
  `TKKT_ID` int(11) NOT NULL,
  `TKKT_NO` int(11) NOT NULL,
  `TKKT_CO` int(11) NOT NULL,
  `TKKT_DIENGIAI` varchar(100) NOT NULL,
  `TKKT_LOAI` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan_ketoan`
--

INSERT INTO `taikhoan_ketoan` (`TKKT_ID`, `TKKT_NO`, `TKKT_CO`, `TKKT_DIENGIAI`, `TKKT_LOAI`) VALUES
(1, 1111, 344, 'Nhật ký quỹ, ký cuộc', 'Thu'),
(2, 1111, 515, 'Thu lãi tiền gửi ngân hàng', 'Thu'),
(3, 1111, 131, 'Thu tiền khách hàng', 'Thu'),
(4, 1111, 515, 'Thu tiền lãi đầu tư dài hạn', 'Thu'),
(5, 1111, 515, 'Thu tiền lãi đầu tư ngắn hạn', 'Thu'),
(6, 3341, 1111, 'Chi tạm ứng lương cho nhân viên', 'Chi'),
(7, 3341, 1111, 'Chi thanh toán lương cho nhân viên', 'Chi'),
(8, 6417, 1111, 'Chi tiền điện cho bán hàng', 'Chi'),
(9, 6417, 1111, 'Chi tiền điện thoại cho bán hàng', 'Chi'),
(10, 6423, 1111, 'Chi tiền mua văn phòng phẩm', 'Chi'),
(11, 331, 1111, 'Chi trả tiền nhà cung cấp', 'Chi'),
(12, 3411, 1111, 'Chi tiền thanh toán tiền vay', 'Chi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `TK_ID` int(11) NOT NULL,
  `NV_ID` int(11) NOT NULL,
  `TK_TENDANGNHAP` varchar(30) NOT NULL,
  `TK_MATKHAU` char(8) NOT NULL,
  `TK_VAITRO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`TK_ID`, `NV_ID`, `TK_TENDANGNHAP`, `TK_MATKHAU`, `TK_VAITRO`) VALUES
(1, 1, 'hoangnam', 'nam12345', 0),
(2, 2, 'minhkhoi', 'khoi1234', 0),
(3, 3, 'giahan', 'han12345', 0),
(4, 5, 'thehao', 'hao12345', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bao_cao_tai_chinh`
--
ALTER TABLE `bao_cao_tai_chinh`
  ADD PRIMARY KEY (`BC_ID`),
  ADD UNIQUE KEY `BAO_CAO_TAI_CHINH_PK` (`BC_ID`),
  ADD KEY `NV_LAP_BC_FK` (`NV_ID`);

--
-- Chỉ mục cho bảng `cong_no_thu`
--
ALTER TABLE `cong_no_thu`
  ADD PRIMARY KEY (`CNT_ID`),
  ADD UNIQUE KEY `CONG_NO_THU_PK` (`CNT_ID`),
  ADD KEY `HDB_CO_CNT_FK` (`HDB_ID`);

--
-- Chỉ mục cho bảng `cong_no_tra`
--
ALTER TABLE `cong_no_tra`
  ADD PRIMARY KEY (`CNTR_ID`),
  ADD UNIQUE KEY `CONG_NO_TRA_PK` (`CNTR_ID`),
  ADD KEY `HDM_CO_CNTR_FK` (`HDM_ID`);

--
-- Chỉ mục cho bảng `hoa_don_ban`
--
ALTER TABLE `hoa_don_ban`
  ADD PRIMARY KEY (`HDB_ID`),
  ADD UNIQUE KEY `HOA_DON_BAN_PK` (`HDB_ID`),
  ADD KEY `KH_HDB_FK` (`KH_ID`),
  ADD KEY `NV_LAP_HDB_FK` (`NV_ID`);

--
-- Chỉ mục cho bảng `hoa_don_mua`
--
ALTER TABLE `hoa_don_mua`
  ADD PRIMARY KEY (`HDM_ID`),
  ADD UNIQUE KEY `HOA_DON_MUA_PK` (`HDM_ID`),
  ADD KEY `NCC_CO_HDM_FK` (`NCC_ID`),
  ADD KEY `fk_nhanvien` (`NV_ID`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`KH_ID`),
  ADD UNIQUE KEY `KHACH_HANG_PK` (`KH_ID`);

--
-- Chỉ mục cho bảng `lichsu_phieuchi`
--
ALTER TABLE `lichsu_phieuchi`
  ADD PRIMARY KEY (`LSC_ID`),
  ADD KEY `PC_ID` (`PC_ID`),
  ADD KEY `LSC_MANV` (`LSC_MANV`),
  ADD KEY `fk_tkkt_id` (`TKKT_ID`);

--
-- Chỉ mục cho bảng `lichsu_phieuthu`
--
ALTER TABLE `lichsu_phieuthu`
  ADD PRIMARY KEY (`LST_ID`),
  ADD KEY `PT_ID` (`PT_ID`),
  ADD KEY `LS_MANV` (`LST_MANV`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`NV_ID`),
  ADD UNIQUE KEY `NHAN_VIEN_PK` (`NV_ID`);

--
-- Chỉ mục cho bảng `nha_cung_cap`
--
ALTER TABLE `nha_cung_cap`
  ADD PRIMARY KEY (`NCC_ID`),
  ADD UNIQUE KEY `NHA_CUNG_CAP_PK` (`NCC_ID`);

--
-- Chỉ mục cho bảng `phieu_chi`
--
ALTER TABLE `phieu_chi`
  ADD PRIMARY KEY (`PC_ID`),
  ADD UNIQUE KEY `PHIEU_CHI_PK` (`PC_ID`),
  ADD KEY `PC_HDM_FK` (`HDM_ID`),
  ADD KEY `PC_TKKT_FK` (`TKKT_ID`),
  ADD KEY `NV_LAP_PC_FK` (`NV_ID`);

--
-- Chỉ mục cho bảng `phieu_thu`
--
ALTER TABLE `phieu_thu`
  ADD PRIMARY KEY (`PT_ID`),
  ADD UNIQUE KEY `PHIEU_THU_PK` (`PT_ID`),
  ADD KEY `PT_HDB_FK` (`HDB_ID`),
  ADD KEY `NV_LAP_PT_FK` (`NV_ID`),
  ADD KEY `PT_TKKT_FK` (`TKKT_ID`);

--
-- Chỉ mục cho bảng `taikhoan_ketoan`
--
ALTER TABLE `taikhoan_ketoan`
  ADD PRIMARY KEY (`TKKT_ID`),
  ADD UNIQUE KEY `TAIKHOAN_KETOAN_PK` (`TKKT_ID`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`TK_ID`),
  ADD UNIQUE KEY `TAI_KHOAN_PK` (`TK_ID`),
  ADD KEY `TK_KT_FK` (`NV_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bao_cao_tai_chinh`
--
ALTER TABLE `bao_cao_tai_chinh`
  MODIFY `BC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cong_no_thu`
--
ALTER TABLE `cong_no_thu`
  MODIFY `CNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `cong_no_tra`
--
ALTER TABLE `cong_no_tra`
  MODIFY `CNTR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hoa_don_ban`
--
ALTER TABLE `hoa_don_ban`
  MODIFY `HDB_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `hoa_don_mua`
--
ALTER TABLE `hoa_don_mua`
  MODIFY `HDM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `KH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `lichsu_phieuchi`
--
ALTER TABLE `lichsu_phieuchi`
  MODIFY `LSC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `lichsu_phieuthu`
--
ALTER TABLE `lichsu_phieuthu`
  MODIFY `LST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `NV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nha_cung_cap`
--
ALTER TABLE `nha_cung_cap`
  MODIFY `NCC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `phieu_chi`
--
ALTER TABLE `phieu_chi`
  MODIFY `PC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `phieu_thu`
--
ALTER TABLE `phieu_thu`
  MODIFY `PT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `taikhoan_ketoan`
--
ALTER TABLE `taikhoan_ketoan`
  MODIFY `TKKT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `TK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bao_cao_tai_chinh`
--
ALTER TABLE `bao_cao_tai_chinh`
  ADD CONSTRAINT `FK_BAO_CAO__NV_LAP_BC_NHAN_VIE` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`);

--
-- Các ràng buộc cho bảng `cong_no_thu`
--
ALTER TABLE `cong_no_thu`
  ADD CONSTRAINT `FK_CONG_NO__HDB_CO_CN_HOA_DON_` FOREIGN KEY (`HDB_ID`) REFERENCES `hoa_don_ban` (`HDB_ID`);

--
-- Các ràng buộc cho bảng `cong_no_tra`
--
ALTER TABLE `cong_no_tra`
  ADD CONSTRAINT `FK_CONG_NO__HDM_CO_CN_HOA_DON_` FOREIGN KEY (`HDM_ID`) REFERENCES `hoa_don_mua` (`HDM_ID`);

--
-- Các ràng buộc cho bảng `hoa_don_ban`
--
ALTER TABLE `hoa_don_ban`
  ADD CONSTRAINT `FK_HOA_DON__KH_HDB_KHACH_HA` FOREIGN KEY (`KH_ID`) REFERENCES `khach_hang` (`KH_ID`),
  ADD CONSTRAINT `FK_HOA_DON__NV_LAP_HD_NHAN_VIE` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`);

--
-- Các ràng buộc cho bảng `hoa_don_mua`
--
ALTER TABLE `hoa_don_mua`
  ADD CONSTRAINT `FK_HOA_DON__NCC_CO_HD_NHA_CUNG` FOREIGN KEY (`NCC_ID`) REFERENCES `nha_cung_cap` (`NCC_ID`),
  ADD CONSTRAINT `fk_nhanvien` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`);

--
-- Các ràng buộc cho bảng `lichsu_phieuchi`
--
ALTER TABLE `lichsu_phieuchi`
  ADD CONSTRAINT `fk_tkkt_id` FOREIGN KEY (`TKKT_ID`) REFERENCES `taikhoan_ketoan` (`TKKT_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `lichsu_phieuchi_ibfk_1` FOREIGN KEY (`PC_ID`) REFERENCES `phieu_chi` (`PC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lichsu_phieuchi_ibfk_2` FOREIGN KEY (`LSC_MANV`) REFERENCES `nhan_vien` (`NV_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lichsu_phieuthu`
--
ALTER TABLE `lichsu_phieuthu`
  ADD CONSTRAINT `lichsu_phieuthu_ibfk_1` FOREIGN KEY (`PT_ID`) REFERENCES `phieu_thu` (`PT_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `lichsu_phieuthu_ibfk_2` FOREIGN KEY (`LST_MANV`) REFERENCES `nhan_vien` (`NV_ID`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `phieu_chi`
--
ALTER TABLE `phieu_chi`
  ADD CONSTRAINT `FK_PHIEU_CH_NV_LAP_PC_NHAN_VIE` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`),
  ADD CONSTRAINT `FK_PHIEU_CH_PC_HDM_HOA_DON_` FOREIGN KEY (`HDM_ID`) REFERENCES `hoa_don_mua` (`HDM_ID`),
  ADD CONSTRAINT `FK_PHIEU_CH_PC_TKKT_TAIKHOAN` FOREIGN KEY (`TKKT_ID`) REFERENCES `taikhoan_ketoan` (`TKKT_ID`);

--
-- Các ràng buộc cho bảng `phieu_thu`
--
ALTER TABLE `phieu_thu`
  ADD CONSTRAINT `FK_PHIEU_TH_NV_LAP_PT_NHAN_VIE` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`),
  ADD CONSTRAINT `FK_PHIEU_TH_PT_HDB_HOA_DON_` FOREIGN KEY (`HDB_ID`) REFERENCES `hoa_don_ban` (`HDB_ID`),
  ADD CONSTRAINT `FK_PHIEU_TH_PT_TKKT_TAIKHOAN` FOREIGN KEY (`TKKT_ID`) REFERENCES `taikhoan_ketoan` (`TKKT_ID`);

--
-- Các ràng buộc cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD CONSTRAINT `FK_TAI_KHOA_TK_KT_NHAN_VIE` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
