<?php
//kết nối csdl
function ketnoidb() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlketoan";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Thiết lập chế độ lỗi PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "thành công";
        return $conn;
    } catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
       
    }

}
//kiểm tra đăng nhập
function check_login($name, $pass){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM tai_khoan WHERE TK_TENDANGNHAP ='".$name."' AND TK_MATKHAU='".$pass."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; // 0 là user, 1 là admin
}

//lấy danh sách khách hàng còn thiếu nợ
function customer_no(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT c.*, k.KH_ID, k.KH_HOTEN  
            FROM cong_no_thu c
            JOIN hoa_don_ban h ON c.HDB_ID = h.HDB_ID  
            JOIN khach_hang k ON h.KH_ID = k.KH_ID"
            ; // Xóa dấu chấm phẩy thừa
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Lấy tất cả các kết quả
    return $kq; 
}


//lấy diễn giải công nợ cho phiếu thu
function get_tk(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM taikhoan_ketoan WHERE TKKT_LOAI='Thu'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
/**lấy all khách hàng */
function get_customer(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM khach_hang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lấy tổng tiền của hóa đơn 
function get_total($soct) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT HDB_TONGTIEN FROM hoa_don_ban WHERE HDB_ID = :soct AND HDB_TRANGTHAI = 'Chưa thanh toán hết'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':soct', $soct, PDO::PARAM_INT); // Bind tham số để tránh SQL Injection
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetch(); // Sử dụng fetch() để lấy 1 kết quả
    return $kq['HDB_TONGTIEN'] ?? 0; 
}

//lấy số tiền còn nợ
function get_cong_no($idhd) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT CNT_CONNO FROM cong_no_thu WHERE HDB_ID = $idhd";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq['HDB_TONGTIEN'] ?? 0; 
}
//cập nhật công nợ cho khách hàng nợ
// function updateCongNo($idhd, $sotienno, $sotienthu, $trangthai, $ngay_du_kien_tra) {
//     $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

//     $sql = "UPDATE cong_no_thu 
//                 SET CNT_CONNO = :sotienno, CNT_SOTIENTHU = :sotienthu, CNT_TRANGTHAI = :trangthai, CNT_DUKIENTRA =:ngay_du_kien_tra
//                 WHERE HDB_ID = :idhd";
//     $stmt = $conn->prepare($sql);
    
//     // Bind các tham số đúng với SQL
//     $stmt->bindParam(':sotienno', $sotienno, PDO::PARAM_INT);
//     $stmt->bindParam(':sotienthu', $sotienthu, PDO::PARAM_INT);
//     $stmt->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
//     $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
//     $stmt->bindParam(':ngay_du_kien_tra', $ngay_du_kien_tra);
//     // Thực thi câu lệnh và kiểm tra lỗi
//     $stmt->execute(); // Trả về true/false để kiểm tra kết quả
    
// }
function updateCongNo($idhd, $sotienno, $sotienthu, $trangthai, $ngay_du_kien_tra) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Cập nhật công nợ
    $sql = "UPDATE cong_no_thu 
                SET CNT_CONNO = :sotienno, CNT_SOTIENTHU = :sotienthu, CNT_TRANGTHAI = :trangthai, CNT_DUKIENTRA = :ngay_du_kien_tra
                WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    
    // Bind các tham số đúng với SQL
    $stmt->bindParam(':sotienno', $sotienno, PDO::PARAM_INT);
    $stmt->bindParam(':sotienthu', $sotienthu, PDO::PARAM_INT);
    $stmt->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->bindParam(':ngay_du_kien_tra', $ngay_du_kien_tra, PDO::PARAM_STR);
    
    // Thực thi câu lệnh và kiểm tra lỗi
    if (!$stmt->execute()) {
        return false; // Nếu câu lệnh không thực thi thành công
    }

    // Kiểm tra công nợ sau khi cập nhật
    $sql_check = "SELECT CNT_CONNO FROM cong_no_thu WHERE HDB_ID = :idhd";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    // Nếu công nợ còn lại là 0, cập nhật trạng thái hóa đơn
    if ($result && $result['CNT_CONNO'] == 0) {
        $sql_update_hdb = "UPDATE hoa_don_ban 
                           SET HDB_TRANGTHAI = 'Đã thanh toán'
                           WHERE HDB_ID = :idhd";
        $stmt_update_hdb = $conn->prepare($sql_update_hdb);
        $stmt_update_hdb->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        if (!$stmt_update_hdb->execute()) {
            return false; // Nếu câu lệnh cập nhật trạng thái hóa đơn không thành công
        }
    }

    return true; // Nếu tất cả các thao tác thành công
}

//cập nhật cho khách hàng hết nợ
function hetCongNo($idhd, $conno=0, $tranhthai="Đã thanh toán") {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE cong_no_thu SET CNT_CONNO = :conno, CNT_TRANGTHAI = :trangthai WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    // Bind các tham số
    $stmt->bindParam(':conno', $conno, PDO::PARAM_INT);
    $stmt->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    // Thực thi câu lệnh
    $stmt->execute();
}
//thêm khách hàng vào công nợ
function push_phieu_thu($htoan, $ctu, $idhd, $iddg, $sotien, $idnv) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Câu lệnh INSERT với placeholders
    $sql = "INSERT INTO phieu_thu (TKKT_ID, HDB_ID, PT_NGAYHOACHTOAN, PT_NGAYCHUNGTU, PT_SOTIEN, NV_ID) 
            VALUES (:iddg, :idhd, :htoan, :ctu, :sotien, :idnv)";
    
    $stmt = $conn->prepare($sql);
    
    // Bind các tham số
    $stmt->bindParam(':iddg', $iddg, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->bindParam(':htoan', $htoan);
    $stmt->bindParam(':ctu', $ctu);
    $stmt->bindParam(':sotien', $sotien, PDO::PARAM_INT);
    $stmt->bindParam(':idnv', $idnv, PDO::PARAM_INT);

    // Thực thi câu lệnh
    return $stmt->execute();
}
//thêm công nơ nếu hóa đơn đó thiếu nợ
function addCongNo($idhd, $ctu, $tong_tien, $sotien, $so_tien_no_moi, $ngay_du_kien_tra, $trangthai) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Câu lệnh INSERT
    $sql = "INSERT INTO cong_no_thu(HDB_ID, CNT_TONGTIEN, CNT_SOTIENTHU, CNT_CONNO, CNT_NGAYPHATSINH, CNT_DUKIENTRA, CNT_TRANGTHAI) 
            VALUES (:idhd, :tong_tien, :sotien, :so_tien_no_moi, :ctu, :ngay_du_kien_tra, :trangthai)";

    $stmt = $conn->prepare($sql);

    // Bind các tham số
    $stmt->bindValue(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->bindValue(':tong_tien', $tong_tien, PDO::PARAM_INT);
    $stmt->bindValue(':sotien', $sotien, PDO::PARAM_INT);
    $stmt->bindValue(':so_tien_no_moi', $so_tien_no_moi, PDO::PARAM_INT);
    $stmt->bindValue(':ctu', $ctu, PDO::PARAM_STR);
    $stmt->bindValue(':ngay_du_kien_tra', $ngay_du_kien_tra, PDO::PARAM_STR);
    $stmt->bindValue(':trangthai', $trangthai, PDO::PARAM_STR);

    // Thực thi câu lệnh
    return $stmt->execute();
}

//lấy all ds phiếu thu
function get_ds_phieuthu(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT p.*, t.TKKT_DIENGIAI, k.KH_ID, k.KH_HOTEN  
            FROM phieu_thu p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_ban h ON p.HDB_ID = h.HDB_ID  
            JOIN khach_hang k ON h.KH_ID = k.KH_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lấy chi tiết phiếu thu
function get_chitiet_phieuthu($idpt){
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, t.TKKT_DIENGIAI, t.TKKT_CO, t.TKKT_NO, 
                   k.KH_ID, k.KH_HOTEN, 
                   n.NV_ID, n.NV_HOTEN
            FROM phieu_thu p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_ban h ON p.HDB_ID = h.HDB_ID  
            JOIN khach_hang k ON h.KH_ID = k.KH_ID
            JOIN nhan_vien n ON n.NV_ID = p.NV_ID
            WHERE p.PT_ID = :idpt";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT); // Bind biến ID
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách chi tiết
}
//lây info phiếu thu
function get_info_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, 
                   t.TKKT_DIENGIAI, t.TKKT_CO, t.TKKT_NO, 
                   k.KH_ID, k.KH_HOTEN
            FROM phieu_thu p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_ban h ON p.HDB_ID = h.HDB_ID  
            JOIN khach_hang k ON h.KH_ID = k.KH_ID
            WHERE p.PT_ID = :idpt";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT); // Bind biến ID
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Chỉ trả về 1 phiếu thu
}
//lấy số tiền cũ từ phiếu thu
function get_sotien_cu_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PT_SOTIEN FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PT_SOTIEN'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}

//cộng tiền cũ vào công nợ
function update_tien_cu($so_tien_cu, $idhd) {
    $conn = ketnoidb(); // Kết nối CSDL

    if ($so_tien_cu <= 0) return true; // Không cập nhật nếu không có số tiền cũ

    $sql = "UPDATE cong_no_thu 
            SET CNT_SOTIENTHU = CNT_SOTIENTHU - :so_tien_cu, 
                CNT_CONNO = CNT_CONNO + :so_tien_cu 
            WHERE HDB_ID = :idhd";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':so_tien_cu', $so_tien_cu, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);

    return $stmt->execute();
}
//cập nhật info vào phiếu thu
function update_phieu_thu($idpt, $htoan, $ctu, $idhd, $iddg, $sotienmoi, $nguoilap){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE phieu_thu 
            SET HDB_ID = :idhd, 
                PT_NGAYHOACHTOAN = :htoan, 
                PT_NGAYCHUNGTU = :ctu, 
                TKKT_ID = :iddg, 
                PT_SOTIEN = :sotienmoi,
                PT_NGUOILAP =:nguoilap
            WHERE PT_ID = :idpt";
    
    $stmt = $conn->prepare($sql);

    // Bind các tham số
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->bindParam(':htoan', $htoan);
    $stmt->bindParam(':ctu', $ctu);
    $stmt->bindParam(':iddg', $iddg);
    $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
    $stmt->bindParam(':nguoilap', $nguoilap, PDO::PARAM_INT);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);

    // Thực thi câu lệnh
    return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
}
//cập nhật trừ tiền mới vào công nợ
// function update_cong_no($idhd, $sotienmoi){
//     $conn = ketnoidb(); // Kết nối CSDL

//     if ($sotienmoi <= 0) return true; // Không cập nhật nếu số tiền mới <= 0

//     $sql = "UPDATE cong_no_thu 
//             SET CNT_SOTIENTHU = CNT_SOTIENTHU + :sotienmoi, 
//                 CNT_CONNO = CNT_CONNO - :sotienmoi 
//             WHERE HDB_ID = :idhd";

//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
//     $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);

//     return $stmt->execute();

//     //lấy CNT_CONNO > 0 thì CNT_TRANGTHAI = 'Còn nợ' ngược lại = 0 thì CNT_TRANGTHAI = 'Đã thanh toán'
// }
function update_cong_no($idhd, $sotienmoi){
    $conn = ketnoidb(); // Kết nối CSDL

    if ($sotienmoi <= 0) return true; // Không cập nhật nếu số tiền mới <= 0

    // Cập nhật số tiền vào công nợ
    $sql = "UPDATE cong_no_thu 
            SET CNT_SOTIENTHU = CNT_SOTIENTHU + :sotienmoi, 
                CNT_CONNO = CNT_CONNO - :sotienmoi 
            WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    
    // Thực thi câu lệnh cập nhật số tiền
    $stmt->execute();

    // Lấy giá trị CNT_CONNO sau khi cập nhật
    $sql_check = "SELECT CNT_CONNO FROM cong_no_thu WHERE HDB_ID = :idhd";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra CNT_CONNO và cập nhật trạng thái công nợ
    if ($result) {
        $new_status_cong_no = ($result['CNT_CONNO'] > 0) ? 'Còn nợ' : 'Đã thanh toán';
        
        // Cập nhật trạng thái công nợ
        $sql_update_status_cong_no = "UPDATE cong_no_thu 
                                      SET CNT_TRANGTHAI = :new_status_cong_no 
                                      WHERE HDB_ID = :idhd";
        $stmt_update_status_cong_no = $conn->prepare($sql_update_status_cong_no);
        $stmt_update_status_cong_no->bindParam(':new_status_cong_no', $new_status_cong_no, PDO::PARAM_STR);
        $stmt_update_status_cong_no->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        $stmt_update_status_cong_no->execute();

        // Cập nhật trạng thái hóa đơn bán
        $new_status_hoa_don = ($result['CNT_CONNO'] > 0) ? 'Còn nợ' : 'Đã thanh toán';

        $sql_update_status_hoa_don = "UPDATE hoa_don_ban 
                                      SET HDB_TRANGTHAI = :new_status_hoa_don 
                                      WHERE HDB_ID = :idhd";
        $stmt_update_status_hoa_don = $conn->prepare($sql_update_status_hoa_don);
        $stmt_update_status_hoa_don->bindParam(':new_status_hoa_don', $new_status_hoa_don, PDO::PARAM_STR);
        $stmt_update_status_hoa_don->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        $stmt_update_status_hoa_don->execute();
    }

    return true; // Trả về true nếu mọi thao tác thành công
}

//thêm lịch sử phiếu thu
function add_lich_su_phieu_thu($idpt, $nguoilap, $so_tien_cu, $sotienmoi, $so_ht_cu, $htoan, $so_ct_cu, $ctu, $so_tkkt_cu, $iddg){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    $sql = "INSERT INTO lichsu_phieuthu (PT_ID, LST_MANV, 
                LST_TRUOC_SUA, LST_SAU_SUA, 
                LST_HT_TRUOC, LST_HT_SAU, 
                LST_CTU_TRUOC, LST_CTU, 
                TKKT_TRUOC, TKKT_SAU) 
            VALUES (:idpt, :nguoilap, 
                :sotien_cu, :sotienmoi, 
                :so_ht_cu, :htoan, 
                :so_ct_cu, :ctu, 
                :so_tkkt_cu, :tkkt_id)";

    $stmt = $conn->prepare($sql);

    // Bind các tham số đúng với SQL
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->bindParam(':nguoilap', $nguoilap, PDO::PARAM_INT);
    $stmt->bindParam(':sotien_cu', $so_tien_cu, PDO::PARAM_INT);
    $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
    $stmt->bindParam(':so_ht_cu', $so_ht_cu);
    $stmt->bindParam(':htoan', $htoan);
    $stmt->bindParam(':so_ct_cu', $so_ct_cu);
    $stmt->bindParam(':ctu', $ctu);
    $stmt->bindParam(':so_tkkt_cu', $so_tkkt_cu, PDO::PARAM_INT);
    $stmt->bindParam(':tkkt_id', $iddg, PDO::PARAM_INT); // Đã sửa lỗi

    // Thực thi câu lệnh
    return $stmt->execute();
}

//lấy lịch sử phiếu thu
// function get_lichsu_phieuthu($lspt){
//     $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
//     $sql = "SELECT * FROM lichsu_phieuthu WHERE PT_ID = :lspt";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':lspt', $lspt, PDO::PARAM_INT);
//     $stmt->execute();
//     $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $kq = $stmt->fetchAll(); // lấy mảng ds
//     return $kq; 
// }
// Lấy lịch sử phiếu thu kèm tên nhân viên
function get_lichsu_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối CSDL

    $sql = "SELECT l.*, n.NV_HOTEN 
            FROM lichsu_phieuthu l
            JOIN nhan_vien n ON l.LST_MANV = n.NV_ID
            WHERE l.PT_ID = :idpt";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Lấy danh sách lịch sử
    return $kq;
}

//lấy thông tin nhân viên
function get_ten_nv($idpt){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT NV_HOTEN 
            FROM lichsu_phieuthu l, nhan_vien n 
            WHERE l.LST_MANV = n.NV_ID 
            AND PT_ID=:idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lấy hóa đơn còn trong công nợ thu
function get_hd_in_cnthu(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM hoa_don_ban";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Sử dụng fetch() để lấy 1 kết quả
    return $kq; 
}
//lấy hoạch toán cũ từ phiếu chi
function get_ht_cu_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PT_NGAYHOACHTOAN FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PT_NGAYHOACHTOAN'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//lấy ngày chứng từ cũ từ phiếu thu
function get_sct_cu_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PT_NGAYCHUNGTU FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PT_NGAYCHUNGTU'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//lấy tkkt từ cũ từ phiếu chi
function get_tkkt_cu_phieuthu($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT TKKT_ID FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['TKKT_ID'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//cập nhật phiếu thu nếu trả hết nợ
function update_hdb($idhd){
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "UPDATE hoa_don_ban SET HDB_TRANGTHAI = 'Đã thanh toán' WHERE HDB_ID =:idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    return $stmt->execute();
}
//xóa phiếu thu
// function xoa_phieu_thu($idpt){
//     $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
//         $sql = "DELETE FROM phieu_thu WHERE PT_ID=".$idpt;
//         // use exec() because no results are returned
//         $conn->exec($sql);
// }
function xoa_phieuthu($idpt) {
    $conn = ketnoidb();

    // Lấy số tiền trong phiếu thu trước khi xóa
    $sql = "SELECT PT_SOTIEN, HDB_ID FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $phieu = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$phieu) return false; // Không tìm thấy phiếu thu

    $sotien = $phieu['PT_SOTIEN'];
    $idhd = $phieu['HDB_ID'];

    // Cộng lại số tiền vào công nợ
    $sql = "UPDATE cong_no_thu 
            SET CNT_CONNO = CNT_CONNO + :sotien, CNT_SOTIENTHU = CNT_SOTIENTHU - :sotien
            WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sotien', $sotien, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();

    // **Lấy lại công nợ sau khi cập nhật**
    $sql = "SELECT CNT_CONNO FROM cong_no_thu WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();
    $con_no = $stmt->fetchColumn();

    // Cập nhật trạng thái công nợ
    $sql = "UPDATE cong_no_thu 
            SET CNT_TRANGTHAI = CASE 
                WHEN CNT_CONNO > 0 THEN 'Còn nợ' 
                ELSE 'Đã thanh toán' 
            END 
            WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();

    // Cập nhật trạng thái hóa đơn nếu vẫn còn công nợ
    if ($con_no > 0) {
        $sql = "UPDATE hoa_don_ban SET HDB_TRANGTHAI = 'Còn nợ' WHERE HDB_ID = :idhd";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Xóa phiếu thu
    $sql = "DELETE FROM phieu_thu WHERE PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    
    return $stmt->execute();
}

//lấy phiếu thu theo id
function get_phieu_thu($idpt) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, KH_HOTEN, KH_SDT, KH_DIACHI 
            FROM phieu_thu p, hoa_don_ban h, khach_hang k 
            WHERE p.HDB_ID = h.HDB_ID AND h.KH_ID = k.KH_ID AND PT_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
