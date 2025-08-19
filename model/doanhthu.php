<?php
function get_hoadon_ban(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM hoa_don_ban";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Sử dụng fetch() để lấy 1 kết quả
    return $kq; 
}
function get_hoadon_mua(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM hoa_don_mua";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Sử dụng fetch() để lấy 1 kết quả
    return $kq; 
}
function tinh_doanh_thu() {
    $conn = ketnoidb(); // Kết nối CSDL

    $sql = "SELECT SUM(PT_SOTIEN) FROM phieu_thu";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $tong_doanh_thu = $stmt->fetchColumn();
    return $tong_doanh_thu ? $tong_doanh_thu : 0; // Nếu NULL thì trả về 0
}
function tinh_chi_phi() {
    $conn = ketnoidb(); // Kết nối CSDL

    $sql = "SELECT SUM(PC_SOTIEN) FROM phieu_chi";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $tong_chi_phi = $stmt->fetchColumn();
    return $tong_chi_phi ? $tong_chi_phi : 0; // Nếu NULL thì trả về 0
}
function dem_so_hoa_don_ban() {
    $conn = ketnoidb(); // Kết nối database

    $sql = "SELECT COUNT(*) AS tong_hoadonban FROM hoa_don_ban";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['tong_hoadonban'];
}
function dem_so_hoa_don_mua() {
    $conn = ketnoidb(); // Kết nối database

    $sql = "SELECT COUNT(*) AS tong_hoadonmua FROM hoa_don_mua";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['tong_hoadonmua'];
}
function dem_so_kh() {
    $conn = ketnoidb(); // Kết nối database

    $sql = "SELECT COUNT(*) AS tong_kh FROM khach_hang";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['tong_kh'];
}
function dem_so_ncc() {
    $conn = ketnoidb(); // Kết nối database

    $sql = "SELECT COUNT(*) AS tong_ncc FROM nha_cung_cap";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['tong_ncc'];
}
//doanh thu thao tháng
function getYearlyMonthlyRevenue() {
    $conn = ketnoidb();
   
    $sql = "SELECT YEAR(PT_NGAYHOACHTOAN) AS year, MONTH(PT_NGAYHOACHTOAN) AS month, SUM(PT_SOTIEN) AS total_revenue 
            FROM phieu_thu 
            GROUP BY YEAR(PT_NGAYHOACHTOAN), MONTH(PT_NGAYHOACHTOAN) 
            ORDER BY YEAR(PT_NGAYHOACHTOAN), MONTH(PT_NGAYHOACHTOAN)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    
    // Tạo mảng doanh thu cho các năm và tháng (tối đa 12 tháng mỗi năm)
    $yearly_monthly_revenue = [];

    foreach ($kq as $row) {
        $year = $row['year'];
        $month = $row['month'] - 1; // Lưu ý rằng tháng trong cơ sở dữ liệu là 1-12, nhưng mảng PHP bắt đầu từ 0
        $total_revenue = (float)$row['total_revenue'];

        if (!isset($yearly_monthly_revenue[$year])) {
            $yearly_monthly_revenue[$year] = array_fill(0, 12, 0); // Khởi tạo mảng doanh thu cho năm mới
        }

        $yearly_monthly_revenue[$year][$month] = $total_revenue; // Gán doanh thu vào tháng tương ứng của năm
    }

    return $yearly_monthly_revenue; // Trả về doanh thu theo năm và tháng
}
//chi phí theo từng tháng
function getYearlyMonthlyOrders() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Truy vấn lấy số lượng đơn hàng theo năm và tháng
    $sql = "SELECT YEAR(PC_NGAYHOACHTOAN) AS year, MONTH(PC_NGAYHOACHTOAN) AS month, SUM(PC_SOTIEN) AS total_chi
            FROM phieu_chi
            GROUP BY YEAR(PC_NGAYHOACHTOAN), MONTH(PC_NGAYHOACHTOAN)
            ORDER BY YEAR(PC_NGAYHOACHTOAN), MONTH(PC_NGAYHOACHTOAN)";  // Sắp xếp theo năm và tháng

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); 

    // Tạo mảng số lượng đơn hàng cho các năm và tháng (tối đa 12 tháng mỗi năm)
    $yearly_monthly_orders = [];

    // Duyệt qua kết quả và lưu trữ số lượng đơn hàng vào mảng theo năm và tháng
    foreach ($kq as $row) {
        $year = $row['year'];
        $month = $row['month'] - 1; // Lưu ý rằng tháng trong cơ sở dữ liệu là 1-12, nhưng mảng PHP bắt đầu từ 0
        $total_chi = $row['total_chi'];

        // Nếu năm chưa có trong mảng, khởi tạo mảng số lượng đơn hàng cho năm đó
        if (!isset($yearly_monthly_orders[$year])) {
            $yearly_monthly_orders[$year] = array_fill(0, 12, 0); // Khởi tạo mảng số lượng đơn hàng cho năm mới
        }

        // Gán số lượng đơn hàng vào tháng tương ứng của năm
        $yearly_monthly_orders[$year][$month] = $total_chi;
    }

    return $yearly_monthly_orders;  // Trả về số lượng đơn hàng theo năm và tháng
}
//lấy chi tiết sổ kế tóa
function get_chitiet_ketoan($tu, $den) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "
        SELECT 'PHIEU_CHI' AS LOAI, PC_ID AS ID, TKKT_DIENGIAI, PC_NGAYHOACHTOAN AS NGAYHOACHTOAN, PC_NGAYCHUNGTU AS NGAYCHUNGTU, PC_SOTIEN AS SOTIEN 
        FROM phieu_chi p
        JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID
        WHERE PC_NGAYHOACHTOAN BETWEEN :tu AND :den

        UNION ALL

        SELECT 'PHIEU_THU' AS LOAI, PT_ID AS ID, TKKT_DIENGIAI, PT_NGAYHOACHTOAN AS NGAYHOACHTOAN, PT_NGAYCHUNGTU AS NGAYCHUNGTU, PT_SOTIEN AS SOTIEN 
        FROM phieu_thu pt
        JOIN taikhoan_ketoan t ON pt.TKKT_ID = t.TKKT_ID
        WHERE PT_NGAYHOACHTOAN BETWEEN :tu AND :den
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':tu', $tu, PDO::PARAM_STR);
    $stmt->bindValue(':den', $den, PDO::PARAM_STR);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy toàn bộ kết quả
}


?>