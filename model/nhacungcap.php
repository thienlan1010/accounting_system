<?php
function get_ds_no_ncc(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT c.*, k.NCC_ID, k.NCC_TEN  
            FROM cong_no_tra c
            JOIN hoa_don_mua h ON c.HDM_ID = h.HDM_ID  
            JOIN nha_cung_cap k ON h.NCC_ID = k.NCC_ID"
            ; // Xóa dấu chấm phẩy thừa
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Lấy tất cả các kết quả
    return $kq;
}
//PHIEU CHI
//lấy ds phiếu chi
function get_ds_phieu_chi(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT p.*, t.TKKT_DIENGIAI, n.NCC_ID, n.NCC_TEN
            FROM phieu_chi p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_mua h ON p.HDM_ID = h.HDM_ID  
            JOIN nha_cung_cap n ON h.NCC_ID = n.NCC_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lấy tài khoản kế toán cho ncc
function get_tk_ncc(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM taikhoan_ketoan WHERE TKKT_LOAI='Chi'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lấy all nhà cung cấp
function get_ncc(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM nha_cung_cap";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    return $kq; 
}
//lây tổng hóa đơn mua ncc
function get_tien_no($idhd) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT CNTR_CONNO, CNTR_SOTIENTRA FROM cong_no_tra WHERE HDM_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT); // Bind tham số để tránh SQL Injection
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); // Lấy một dòng dữ liệu
}
//lây tổng hóa đơn bán
function get_tien_nothu($idhd) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT CNT_CONNO, CNT_SOTIENTHU FROM cong_no_thu WHERE HDB_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT); // Bind tham số để tránh SQL Injection
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); // Lấy một dòng dữ liệu
}
//cập nhật công nợ trả
// function updateCongNoTra($idhd, $so_tien_no_moi, $so_tien_thu, $trangthai, $ngay_du_kien_tra){
//     $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

//     $sql = "UPDATE cong_no_tra 
//                 SET CNTR_CONNO = :so_tien_no_moi, CNTR_SOTIENTRA = :so_tien_thu, CNTR_TRANGTHAI = :trangthai, CNTR_DUKIENTRA =:ngay_du_kien_tra
//                 WHERE HDM_ID = :idhd";
//     $stmt = $conn->prepare($sql);
    
//     // Bind các tham số đúng với SQL
//     $stmt->bindParam(':so_tien_no_moi', $so_tien_no_moi, PDO::PARAM_INT);
//     $stmt->bindParam(':so_tien_thu', $so_tien_thu, PDO::PARAM_INT);
//     $stmt->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
//     $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
//     $stmt->bindParam(':ngay_du_kien_tra', $ngay_du_kien_tra);
//     // Thực thi câu lệnh và kiểm tra lỗi
//     $stmt->execute(); // Trả về true/false để kiểm tra kết quả
// }
function updateCongNoTra($idhd, $sotienno, $sotienthu, $trangthai, $ngay_du_kien_tra) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Cập nhật công nợ
    $sql = "UPDATE cong_no_tra 
                SET CNTR_CONNO = :sotienno, CNTR_SOTIENTRA = :sotienthu, CNTR_TRANGTHAI = :trangthai, CNTR_DUKIENTRA = :ngay_du_kien_tra
                WHERE HDM_ID = :idhd";
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
    $sql_check = "SELECT CNTR_CONNO FROM cong_no_tra WHERE HDM_ID = :idhd";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    // Nếu công nợ còn lại là 0, cập nhật trạng thái hóa đơn
    if ($result && $result['CNTR_CONNO'] == 0) {
        $sql_update_hdb = "UPDATE hoa_don_mua 
                           SET HDM_TRANGTHAI = 'Đã thanh toán'
                           WHERE HDM_ID = :idhd";
        $stmt_update_hdb = $conn->prepare($sql_update_hdb);
        $stmt_update_hdb->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        if (!$stmt_update_hdb->execute()) {
            return false; // Nếu câu lệnh cập nhật trạng thái hóa đơn không thành công
        }
    }

    return true; // Nếu tất cả các thao tác thành công
}
//add phiếu chi

function push_phieu_chi($htoan, $ctu, $idhd, $iddg, $sotien, $nguoilap){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    // Câu lệnh INSERT với placeholders
    $sql = "INSERT INTO phieu_chi (HDM_ID, NV_ID, TKKT_ID, PC_NGAYHOACHTOAN, PC_NGAYCHUNGTU, PC_SOTIEN) 
            VALUES (:idhd, :nguoilap, :iddg, :htoan, :ctu, :sotien)";
    
    $stmt = $conn->prepare($sql);
    
    // Bind các tham số
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->bindParam(':nguoilap', $nguoilap, PDO::PARAM_INT);
    $stmt->bindParam(':iddg', $iddg);
    $stmt->bindParam(':htoan', $htoan);
    $stmt->bindParam(':ctu', $ctu);
    $stmt->bindParam(':sotien', $sotien, PDO::PARAM_INT);

    // Thực thi câu lệnh
    return $stmt->execute();
}
//lấy hóa đơn còn trong công nợ trả
function get_hd_in_cntr(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM hoa_don_mua";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // Sử dụng fetch() để lấy 1 kết quả
    return $kq; 
}
//lấy chi tiết phiếu chi
function get_chitiet_phieuchi($idpt){
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, t.TKKT_DIENGIAI, t.TKKT_CO, t.TKKT_NO, 
                   k.NCC_ID, k.NCC_TEN, 
                   n.NV_ID, n.NV_HOTEN
            FROM phieu_chi p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_mua h ON p.HDM_ID = h.HDM_ID  
            JOIN nha_cung_cap k ON h.NCC_ID = k.NCC_ID
            JOIN nhan_vien n ON n.NV_ID = p.NV_ID
            WHERE p.PC_ID = :idpt";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT); // Bind biến ID
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách chi tiết
}
//lây info phiếu chi
function get_info_phieuchi($idpt) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, 
                   t.TKKT_DIENGIAI, t.TKKT_CO, t.TKKT_NO, 
                   k.NCC_ID, k.NCC_TEN
            FROM phieu_chi p  
            JOIN taikhoan_ketoan t ON p.TKKT_ID = t.TKKT_ID  
            JOIN hoa_don_mua h ON p.HDM_ID = h.HDM_ID  
            JOIN nha_cung_cap k ON h.NCC_ID = k.NCC_ID
            WHERE p.PC_ID = :idpt";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT); // Bind biến ID
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Chỉ trả về 1 phiếu thu
}
//lấy số tiền cũ từ phiếu thu
function get_sotien_cu_phieuchi($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PC_SOTIEN FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PC_SOTIEN'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//lấy hoạch toán cũ từ phiếu chi
function get_ht_cu_phieuchi($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PC_NGAYHOACHTOAN FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PC_NGAYHOACHTOAN'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//lấy ngày chứng từ cũ từ phiếu chi
function get_sct_cu_phieuchi($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT PC_NGAYCHUNGTU FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['PC_NGAYCHUNGTU'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//lấy tkkt từ cũ từ phiếu chi
function get_tkkt_cu_phieuchi($idpt) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT TKKT_ID FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['TKKT_ID'] : 0; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
//cộng tiền cũ vào công nợ
function update_tien_cu_pc($so_tien_cu, $idhd) {
    $conn = ketnoidb(); // Kết nối CSDL

    if ($so_tien_cu <= 0) return true; // Không cập nhật nếu không có số tiền cũ

    $sql = "UPDATE cong_no_tra 
            SET CNTR_SOTIENTRA = CNTR_SOTIENTRA - :so_tien_cu, 
                CNTR_CONNO = CNTR_CONNO + :so_tien_cu 
            WHERE HDM_ID = :idhd";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':so_tien_cu', $so_tien_cu, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);

    return $stmt->execute();
}
//cập nhật info vào phiếu thu
function update_phieu_chi($idpt, $htoan, $ctu, $idhd, $iddg, $sotienmoi, $nguoilap){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE phieu_chi 
            SET HDM_ID = :idhd, 
                PC_NGAYHOACHTOAN = :htoan, 
                PC_NGAYCHUNGTU = :ctu, 
                TKKT_ID = :iddg, 
                PC_SOTIEN = :sotienmoi,
                NV_ID =:nguoilap
            WHERE PC_ID = :idpt";
    
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
//thêm lịch sử phiếu thu
function add_lich_su_phieu_chi($idpt, $nguoilap, $so_tien_cu, $sotienmoi, $so_ht_cu, $htoan, $so_ct_cu, $ctu, $so_tkkt_cu, $tkkt_id) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Câu lệnh INSERT với thêm các cột cũ
    $sql = "INSERT INTO lichsu_phieuchi (PC_ID, LSC_MANV, 
                LSC_TRUOC_SUA, LSC_SAU_SUA, 
                LSC_HTOAN_TRUOC, LSC_HTOAN, 
                LSC_CTU_TRUOC, LSC_CTU, 
                TKKT_TRUOC, TKKT_ID) 
            VALUES (:idpt, :nguoilap, 
                :sotien_cu, :sotienmoi, 
                :so_ht_cu, :htoan, 
                :so_ct_cu, :ctu, 
                :so_tkkt_cu, :tkkt_id)";

    $stmt = $conn->prepare($sql);

    // Bind các tham số
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->bindParam(':nguoilap', $nguoilap, PDO::PARAM_INT);
    $stmt->bindParam(':sotien_cu', $so_tien_cu, PDO::PARAM_INT);
    $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
    $stmt->bindParam(':so_ht_cu', $so_ht_cu);
    $stmt->bindParam(':htoan', $htoan);
    $stmt->bindParam(':so_ct_cu', $so_ct_cu);
    $stmt->bindParam(':ctu', $ctu);
    $stmt->bindParam(':so_tkkt_cu', $so_tkkt_cu, PDO::PARAM_INT);
    $stmt->bindParam(':tkkt_id', $tkkt_id, PDO::PARAM_INT);

    // Thực thi câu lệnh
    return $stmt->execute();
}

//cập nhật trừ tiền mới vào công nợ
function update_cong_no_ncc($idhd, $sotienmoi){
    $conn = ketnoidb(); // Kết nối CSDL

    if ($sotienmoi <= 0) return true;

    // Cập nhật số tiền trả và công nợ
    $sql = "UPDATE cong_no_tra 
            SET CNTR_SOTIENTRA = CNTR_SOTIENTRA + :sotienmoi, 
                CNTR_CONNO = CNTR_CONNO - :sotienmoi 
            WHERE HDM_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sotienmoi', $sotienmoi, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();

    // Lấy lại số tiền còn nợ sau khi cập nhật
    $sql_check = "SELECT CNTR_CONNO FROM cong_no_tra WHERE HDM_ID = :idhd";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_check->execute();
    $con_no = $stmt_check->fetchColumn();

    // Cập nhật trạng thái công nợ
    $trangthai = ($con_no > 0) ? 'Còn nợ' : 'Đã thanh toán';

    $sql_update_status = "UPDATE cong_no_tra 
                          SET CNTR_TRANGTHAI = :trangthai 
                          WHERE HDM_ID = :idhd";
    $stmt_status = $conn->prepare($sql_update_status);
    $stmt_status->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
    $stmt_status->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_status->execute();

    // Cập nhật trạng thái hóa đơn mua
    $sql_update_status_hoa_don = "UPDATE hoa_don_mua 
                                  SET HDM_TRANGTHAI = :new_status_hoa_don 
                                  WHERE HDM_ID = :idhd";
    $stmt_update_status_hoa_don = $conn->prepare($sql_update_status_hoa_don);
    $stmt_update_status_hoa_don->bindParam(':new_status_hoa_don', $trangthai, PDO::PARAM_STR);
    $stmt_update_status_hoa_don->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt_update_status_hoa_don->execute();

    return true;
}

//lấy lịch sử phiếu thu
function get_lichsu_phieuchi($lspt){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT l.*, n.NV_HOTEN 
            FROM lichsu_phieuchi l
            JOIN nhan_vien n ON l.LSC_MANV = n.NV_ID
            WHERE l.PC_ID = :lspt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':lspt', $lspt, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); // lấy mảng ds
    return $kq; 
}
//lấy tkkt_id để cập nhật phiếu chi
function get_tkkt_id_from_diengiai($diengiai_id) {
    $conn = ketnoidb(); // Kết nối database
    $sql = "SELECT TKKT_ID FROM taikhoan_ketoan WHERE TKKT_DIENGIAI = :diengiai_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':diengiai_id', $diengiai_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['TKKT_ID'] : null; // Trả về số tiền hoặc 0 nếu không có dữ liệu
}
function get_phieu_chi($idpt) {
    $conn = ketnoidb(); // Kết nối CSDL
    $sql = "SELECT p.*, NCC_TEN, NCC_SDT, NCC_DIACHI 
            FROM phieu_chi p, hoa_don_mua h, nha_cung_cap k 
            WHERE p.HDM_ID = h.HDM_ID AND h.NCC_ID = k.NCC_ID AND PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//xóa phiếu chi
function xoa_phieuchi($idpt) {
    $conn = ketnoidb();

    // Lấy số tiền trong phiếu thu trước khi xóa
    $sql = "SELECT PC_SOTIEN, HDM_ID FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    $stmt->execute();
    $phieu = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$phieu) return false; // Không tìm thấy phiếu thu

    $sotien = $phieu['PC_SOTIEN'];
    $idhd = $phieu['HDM_ID'];

    // Cộng lại số tiền vào công nợ
    $sql = "UPDATE cong_no_tra 
            SET CNTR_CONNO = CNTR_CONNO + :sotien, CNTR_SOTIENTRA = CNTR_SOTIENTRA - :sotien
            WHERE HDM_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sotien', $sotien, PDO::PARAM_INT);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();

    // **Lấy lại công nợ sau khi cập nhật**
    $sql = "SELECT CNTR_CONNO FROM cong_no_tra WHERE HDM_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();
    $con_no = $stmt->fetchColumn();

    // Cập nhật trạng thái công nợ
    $sql = "UPDATE cong_no_tra 
            SET CNTR_TRANGTHAI = CASE 
                WHEN CNTR_CONNO > 0 THEN 'Còn nợ' 
                ELSE 'Đã thanh toán' 
            END 
            WHERE HDM_ID = :idhd";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
    $stmt->execute();

    // Cập nhật trạng thái hóa đơn nếu vẫn còn công nợ
    if ($con_no > 0) {
        $sql = "UPDATE hoa_don_mua SET HDM_TRANGTHAI = 'Còn nợ' WHERE HDM_ID = :idhd";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idhd', $idhd, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Xóa phiếu thu
    $sql = "DELETE FROM phieu_chi WHERE PC_ID = :idpt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idpt', $idpt, PDO::PARAM_INT);
    
    return $stmt->execute();
}
?>