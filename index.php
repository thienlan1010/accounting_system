<?php
   session_start();
   ob_start();//chuyển trang
   include "model/thuvien.php";
   include "model/nhacungcap.php";
   include "model/doanhthu.php";


   ketnoidb();



if(isset($_GET['act'])){//nếu tồn tại biên này thì kiểm tra
    $act=$_GET['act'];

switch ($act) {
    case 'login':
        $txt = "";
        if(isset($_POST["dangnhap"]) && isset($_POST["dangnhap"])){
            $name = $_POST["username"];
            $pass = $_POST["password"];

            $kq = check_login($name, $pass);//trả về ALL info

            //lấy thông tin người đăng nhập
            if (!empty($kq)) { // Nếu tài khoản tồn tại
                $role = $kq[0]['TK_VAITRO']; // Lấy role của tài khoản

                if ($role == 1) { // Nếu là admin
                    $_SESSION['ROLE'] = $role;
                    $_SESSION['id_admin'] = $kq[0]['TK_ID'];
                    $_SESSION['name_admin'] = $kq[0]['TK_TENDANGNHAP'];
                    header('Location: index.php?act=admin');
                    exit();
                } else { // Nếu là user bình thường
                    $_SESSION['ROLE'] = $role;
                    $_SESSION['iduser'] = $kq[0]['TK_ID'];
                    $_SESSION['username'] = $kq[0]['TK_TENDANGNHAP'];
                    $_SESSION['id_nv'] = $kq[0]['NV_ID']; // Mã nhân viên (hoặc khách hàng)
                    
                    header('Location: index.php?act=ketoan'); // Chuyển hướng qua index.php để gọi case 'ketoan'
                    exit();
                }
            } else {       
                $txt = "Tên đăng nhập hoặc mật khẩu không hợp lệ!";
 
            }
        }

        include "view/header.php";
        include "view/home.php";
        include "view/footer.php";
        break;  

    case 'ketoan':
        $total = tinh_doanh_thu();
        $total_chi = tinh_chi_phi();
        $total_hdb = dem_so_hoa_don_ban();
        $total_hdm = dem_so_hoa_don_mua();
        $total_kh = dem_so_kh();
        $total_ncc = dem_so_ncc();
        $yearly_monthly_revenue = getYearlyMonthlyRevenue();
        $yearly_monthly_orders = getYearlyMonthlyOrders();
        include "ketoan/ketoan.php";
        break;
            //thoát đăng nhập
    case 'thoat':
        include "view/header.php";
        unset($_SESSION['ROLE']);
        unset($_SESSION['iduser']);
        unset($_SESSION['username']);
        header('location: index.php');
        include "view/footer.php";
        break;
    case 'CusDebt':
        $kq=customer_no();
        include "ketoan/CusDebt.php";
        break;
    case 'phieuthu':
        //lấy all danh sách tài khoảng nợ, có
        $kq=get_tk();
        $kh= get_customer();
        $hdb = get_hd_in_cnthu();//all hóa đơn bán
        include "ketoan/phieuthu.php";
        break;
    case 'dsphieuthu':
        $sdpt = get_ds_phieuthu();
        include "ketoan/dsphieuthu.php";
        break;
    case 'chitiet-pt':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $ctpt=get_chitiet_phieuthu($_GET['id']);
        }
        include "ketoan/detail_phieuthu.php";
        break;
    // case 'xuly-phieuthu':
    //     if (isset($_POST["savethu"])){
    //         //$idkh = $_POST["doituong"];
    //         // $idnv = $_POST["nhanvien"];
    //         $htoan = $_POST["ngay_hachtoan"];
    //         $ctu = $_POST["ngay_chungtu"];//này là mã hóa đơn 
    //         $idhd = $_POST["hoadon"];
    //         $iddg = $_POST["diengiai_id"];
    //         $sotien = $_POST["so_tien"];
        
    //         //lấy tiền còn nợ trong công nợ ra
    //         $tien_in_cn = get_tien_nothu($idhd);
    //         if($tien_in_cn){
    //         // kiểm trả số tiền nhập vào có lớn hơn số tiền trả ko
    //         if ($tien_in_cn['CNT_CONNO'] > 0) {
    //             // Đây là hóa đơn đang nợ, cần kiểm tra số tiền thu
    //             if ($sotien > (int)$tien_in_cn['CNT_CONNO']) {
    //                 echo "<script>
    //                         alert('Lỗi: Số tiền thu không được vượt quá số tiền nợ!');
    //                         window.history.back();
    //                       </script>";
    //                 exit();
    //             }
    //         //trừ tiền trong công nợ = tiền nợ - tiền trả
            
    //             $so_tien_no_moi = (int)$tien_in_cn['CNT_CONNO'] - $sotien;
    //             $so_tien_thu = (int)$tien_in_cn['CNT_SOTIENTHU'] + $sotien;
            
    //         $trangthai = ($so_tien_no_moi == 0) ? "Đã thanh toán" : "Còn nợ";
    //         //kiểm tra xem trong ds công nợ có hóa đơn đó ko thì mới trừ được -> tránh lỗi ko có mã hóa đơn
    //         //cập nhật ngày trả tiền tiếp theo
    //         if ($so_tien_no_moi == 0) {
    //             $ngay_du_kien_tra = $htoan; // Giữ nguyên ngày thanh toán nếu trả hết nợ
    //         } else {
    //             $ngay_du_kien_tra = date('Y-m-d', strtotime($htoan . ' +1 month')); // Cộng thêm 1 tháng nếu còn nợ
    //         }            
    //         updateCongNo($idhd, $so_tien_no_moi, $so_tien_thu, $trangthai, $ngay_du_kien_tra);
    //     }
    
    //         //add phiếu chi                        
    //         $nguoilap = $_SESSION['id_nv'];
    //         // Đẩy dữ liệu phiếu chi vào hệ thống
    //         push_phieu_thu($htoan, $ctu, $idhd, $iddg, $sotien, $nguoilap);
    //         // Hiển thị alert thành công rồi reload trang
    //         echo "<script>
    //                 alert('Thêm phiếu thu thành công!');
    //                 window.location.href = 'index.php?act=phieuchi';
    //             </script>";
    //         exit();     
    
    // }else{
    //     //add phiếu chi                        
    //     $nguoilap = $_SESSION['id_nv'];
    //     // Đẩy dữ liệu phiếu chi vào hệ thống
    //     push_phieu_thu($htoan, $ctu, $idhd, $iddg, $sotien, $nguoilap);
    //     // Hiển thị alert thành công rồi reload trang
    //     echo "<script>
    //             alert('Thêm phiếu thu thành công!');
    //             window.location.href = 'index.php?act=phieuchi';
    //         </script>";
    //     exit();     
    // }
    //     }
    //         include "ketoan/phieuthu.php";
    //         break;
            
    case 'xuly-phieuthu':
        if (isset($_POST["savethu"])) {
            $htoan = $_POST["ngay_hachtoan"];
            $ctu = $_POST["ngay_chungtu"]; // Mã hóa đơn
            $idhd = $_POST["hoadon"];
            $iddg = $_POST["diengiai_id"];
            $sotien = $_POST["so_tien"];
            $nguoilap = $_SESSION['id_nv']; // Người lập phiếu
    
            // Lấy công nợ của hóa đơn
            $tien_in_cn = get_tien_nothu($idhd);
    
            if ($tien_in_cn) { // Nếu hóa đơn có công nợ
                $conno = (int)$tien_in_cn['CNT_CONNO'];
    
                if ($conno > 0) {
                    // Kiểm tra số tiền thu có lớn hơn số tiền nợ không
                    if ($sotien > $conno) {
                        echo "<script>
                                alert('Lỗi: Số tiền thu không được lớn hơn số tiền nợ!');
                                window.history.back();
                              </script>";
                        exit();
                    }
    
                    // Trừ tiền trong công nợ
                    $so_tien_no_moi = $conno - $sotien;
                    $so_tien_thu = (int)$tien_in_cn['CNT_SOTIENTHU'] + $sotien;
                    $trangthai = ($so_tien_no_moi == 0) ? "Đã thanh toán" : "Còn nợ";
                    $ngay_du_kien_tra = ($so_tien_no_moi == 0) ? $htoan : date('Y-m-d', strtotime($htoan . ' +1 month'));
    
                    // Cập nhật công nợ
                    updateCongNo($idhd, $so_tien_no_moi, $so_tien_thu, $trangthai, $ngay_du_kien_tra);
                    //sau khi cập nhật thành công, nếu đã trả hết nợ thì cập nhật trạng thái hóa đơn lại là đã cập nhật
                    
                }
            }
            $nguoilap = $_SESSION['id_nv'];
            // Nếu qua bước kiểm tra trên mà không bị chặn, thì mới lập phiếu thu
            push_phieu_thu($htoan, $ctu, $idhd, $iddg, $sotien, $nguoilap);
    
            echo "<script>
                    alert('Thêm phiếu thu thành công!');
                    window.location.href = 'index.php?act=phieuthu';
                  </script>";
            exit();
        }
    
        include "ketoan/phieuthu.php";
        break;
    
    case 'suaphieuthu':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $thucu=get_info_phieuthu($_GET['id']);//lấy all info của phiếu thu có mã $id
        }
        $kq=get_tk();
        $kh= get_customer();
        $hdb = get_hd_in_cnthu();
        include "ketoan/sua_phieuthu.php";
        break;
    case 'edit-receipt':
        if (isset($_POST["luulai"])) {
            //info sau khi đã sửa
            $idpt = $_POST["pt_id"];
            //$idkh = $_POST["doituong"];
            $htoan = $_POST["ngay_hachtoan"];
            $ctu = $_POST["ngay_chungtu"];
            $idhd = $_POST["hoadon"];
            $iddg = $_POST["diengiai_id"];
            $sotienmoi = $_POST["so_tien"];
            //lấy số tiền cũ đã lưu từ phiếu thu trước
            //lấy số tiền cũ đã lưu từ phiếu thu trước
            $so_tien_cu = get_sotien_cu_phieuthu($idpt);
            //lấy hoạch toán lưu từ trước
            $so_ht_cu = get_ht_cu_phieuthu($idpt);
            //lấy chứng từ lưu từ trước
            $so_ct_cu = get_sct_cu_phieuthu($idpt);
            //lấy tkkt lưu từ trước
            $so_tkkt_cu = get_tkkt_cu_phieuthu($idpt);
            //cộng số tiền cũ vào công nợ
            update_tien_cu($so_tien_cu, $idhd);
            //cập nhật lại số tiền mới vào phiếu thu
            $nguoilap = $_SESSION['id_nv'];
            //lấy tkkt_id
            //$tkkt_id = get_tkkt_id_from_diengiai($iddg);

            if(update_phieu_thu($idpt, $htoan, $ctu, $idhd, $iddg, $sotienmoi, $nguoilap)){
                add_lich_su_phieu_thu($idpt, $nguoilap, $so_tien_cu, $sotienmoi, $so_ht_cu, $htoan, $so_ct_cu, $ctu, $so_tkkt_cu, $iddg);
                //cập nhật trừ lại số tiền mới từ công nợ
                update_cong_no($idhd, $sotienmoi);
                echo "<script>
                        alert('Sửa phiếu thu thành công!');
                        window.location.href = 'index.php?act=dsphieuthu';
                    </script>";
                exit();
            }else {
                echo "<script>
                        alert('Lỗi! Không thể cập nhật phiếu thu.');
                        </script>";
            }

        }
            break;
    case 'lichsu-pt':
        //lấy lịch sử phiếu thu
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $lspt=get_lichsu_phieuthu($_GET['id']);//lấy all info của phiếu thu có mã $id
            $tennv = get_ten_nv($_GET['id']);
        }
        include "ketoan/lichsu_pt.php";
        break; 
    case 'xoa_pt':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            xoa_phieuthu($_GET['id']);
        }
        include "ketoan/dsphieuthu.php";
        break;

    case 'in-phieuthu':
        if (isset($_GET['id'])) {
            $idpt = $_GET['id'];
            $phieu = get_phieu_thu($idpt);
        
            if (!$phieu) {
                echo "Không tìm thấy phiếu thu.";
                exit();
            }
        } else {
            echo "Thiếu mã phiếu thu.";
            exit();
        }
        include "ketoan/inphieuthu.php";
        break;
    case 'chon_pt':
        if (isset($_GET['id'])) {
            $kqluachon = $_GET['id'];
        }
        include "ketoan/luachon_pt.php";
        break;
    case 'debttosupplier':
        $no_ncc = get_ds_no_ncc();
        include "ketoan/debsupplier.php";
        break;
    //PHIẾU CHI
    case 'dsphieuchi':
        //lấy ds phiếu chi
        $dspc = get_ds_phieu_chi();
        include "ketoan/ds_phieuchi.php";
        break;
    case 'phieuchi':
        $tk=get_tk_ncc();//tài khoản kế toán
        $ncc= get_ncc();//ds nhà cung cấp
        $hd = get_hd_in_cntr();
        include "ketoan/phieuchi.php";
        break;
    case 'xuly-phieuchi':
        if (isset($_POST["savechi"])) {
            //$idncc = $_POST["doituong"];
            // $idnv = $_POST["nhanvien"];
            $htoan = $_POST["ngay_hachtoan"];
            $ctu = $_POST["ngay_chungtu"]; 
            $idhd = $_POST["hoadon"];//này là mã hóa đơn => đúng thì nó la id của phiếu 
            $iddg = $_POST["diengiai_id"];
            $sotien = $_POST["so_tien"];//tiền trả
            // Debug xem giá trị có lấy được không
            
            //lấy tiền còn nợ trong công nợ ra
            $tien_in_cn = get_tien_no($idhd);
            //nếu hóa đơn có công nợ
            if($tien_in_cn){
                $conno = (int)$tien_in_cn['CNTR_CONNO'];

                //kiểm tra số tiền chi có lơn hơn số tiền thiếu không
                if($conno > 0){
                    if($sotien > $conno){
                        echo "<script>
                                alert('Lỗi: Số tiền chi không được lớn hơn số tiền nợ!');
                                window.history.back();
                              </script>";
                        exit();
                    }
                    //trừ tiền trong công nợ
                    $so_tien_no_moi = $conno - $sotien;
                    $so_tien_thu = (int)$tien_in_cn['CNTR_SOTIENTRA'] + $sotien;
                    $trangthai = ($so_tien_no_moi == 0) ? "Đã thanh toán" : "Còn nợ";
                    $ngay_du_kien_tra = ($so_tien_no_moi == 0) ? $htoan : date('Y-m-d', strtotime($htoan . ' +1 month'));
                    //cập nhật công nợ, nếu hết nợ cập nhật luôn hóa đơn
                    updateCongNoTra($idhd, $so_tien_no_moi, $so_tien_thu, $trangthai, $ngay_du_kien_tra);

                }
            }
            $nguoilap = $_SESSION['id_nv']; 
            // Nếu qua bước kiểm tra trên mà không bị chặn, thì mới lập phiếu chi
            push_phieu_chi($htoan, $ctu, $idhd, $iddg, $sotien, $nguoilap);
            echo "<script>
                    alert('Thêm phiếu chi thành công!');
                    window.location.href = 'index.php?act=phieuchi';
                </script>";
            exit(); 
        }
        include "ketoan/phieuchi.php";
        break;
    case 'chitiet-pc':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $det_pc = get_chitiet_phieuchi($_GET['id']);
        }
        include "ketoan/detail_phieuchi.php";
        break;
    case 'suaphieuchi':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $thucu=get_info_phieuchi($_GET['id']);//lấy all info của phiếu thu có mã $id
        }
        $tk=get_tk_ncc();//tài khoản kế toán
        $ncc= get_ncc();//ds nhà cung cấp
        $hd = get_hd_in_cntr();//all háo đơn mua
        include "ketoan/sua_phieuchi.php";
        break;
    case 'sua_phieuchi':
        if (isset($_POST["suachi"])) {
            //info sau khi đã sửa
            $idpt = $_POST["pc_id"];
            $idkh = $_POST["doituong"];
            $htoan = $_POST["ngay_hachtoan"];
            $ctu = $_POST["ngay_chungtu"];
            $idhd = $_POST["hoadon"];
            $iddg = $_POST["diengiai_id"];
            $sotienmoi = $_POST["so_tien"];
            //lấy số tiền cũ đã lưu từ phiếu thu trước
            $so_tien_cu = get_sotien_cu_phieuchi($idpt);
            //lấy hoạch toán lưu từ trước
            $so_ht_cu = get_ht_cu_phieuchi($idpt);
            //lấy chứng từ lưu từ trước
            $so_ct_cu = get_sct_cu_phieuchi($idpt);
            //lấy tkkt lưu từ trước
            $so_tkkt_cu = get_tkkt_cu_phieuchi($idpt);
            //cộng số tiền cũ vào công nợ
            update_tien_cu_pc($so_tien_cu, $idhd);
            //cập nhật lại số tiền mới vào phiếu thu
            $nguoilap = $_SESSION['id_nv'];
            //lấy tkkt_id
            //$tkkt_id = get_tkkt_id_from_diengiai($iddg);

            if(update_phieu_chi($idpt, $htoan, $ctu, $idhd, $iddg, $sotienmoi, $nguoilap)){
                add_lich_su_phieu_chi($idpt, $nguoilap, $so_tien_cu, $sotienmoi,$so_ht_cu, $htoan, $so_ct_cu, $ctu, $so_tkkt_cu, $iddg);
                //cập nhật trừ lại số tiền mới từ công nợ
                update_cong_no_ncc($idhd, $sotienmoi);
                echo "<script>
                        alert('Sửa phiếu thu thành công!');
                        window.location.href = 'index.php?act=dsphieuchi';
                      </script>";
                exit();
            }else {
                echo "<script>
                         alert('Lỗi! Không thể cập nhật phiếu thu.');
                        </script>";
            }
            
        }
        break;
    case 'lichsu-pc':
        //lấy lịch sử phiếu thu
        $nguoilap = $_SESSION['id_nv'];
        if(isset($_GET['id']) && ($_GET['id'])>0){
            $lspc=get_lichsu_phieuchi($_GET['id']);//lấy all info của phiếu thu có mã $id
            $tennv = get_ten_nv($nguoilap);
        }
         include "ketoan/lichsu_pc.php";
        break; 
    case 'in-phieuchi':
        if (isset($_GET['id'])) {
            $idpc = $_GET['id'];
            $phieuchi = get_phieu_chi($idpc);
            
            if (!$phieuchi) {
                echo "Không tìm thấy phiếu chi.";
                exit();
            }
        } else {
            echo "Thiếu mã phiếu chi.";
            exit();
        }
        include "ketoan/inphieuchi.php";
        break;
    case 'xoa_pc':
        if(isset($_GET['id']) && ($_GET['id'])>0){
            xoa_phieuchi($_GET['id']);
            echo "<script>
                         alert('Xóa phiếu chi thành công.');
                         window.location.href = 'index.php?act=dsphieuchi';
                        </script>";
        }
        break;
    case 'chon_pc':
        if (isset($_GET['id'])) {
            $kqluachon = $_GET['id'];
        }
        include "ketoan/luachon_pc.php";
        break;
    case 'hdban':
        $hdb = get_hoadon_ban();
        include "ketoan/hdban.php";
        break;
    case 'hdmua':
        $hdm = get_hoadon_mua();
        include "ketoan/hdmua.php";
        break;
    //SỔ KẾ TOÁN
    case 'soketoan':
        include "ketoan/soketoan.php";
        break;
    case 'xuly-sokt':
        if (isset($_POST["dongy"])) {
            //info sau khi đã sửa
            $tu = $_POST["from-date"];
            $den = $_POST["to-date"];
            $kqct = get_chitiet_ketoan($tu, $den);
        }
        include "ketoan/sochitiet.php";
        break;
default:
     include "view/header.php";
     include "view/home.php";
     include "view/footer.php";
        break;
}

} else{
     include "view/header.php";
     include "view/home.php";
     include "view/footer.php";
}

    
    




?>

