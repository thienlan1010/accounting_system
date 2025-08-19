<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/CSS/ketoan.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Kế Toán</title>
    <style>
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #a855f7; /* Màu cam */
            color: white !important;
        }
        .container {
    max-width: 100%;
    overflow-x: auto; /* Để cuộn ngang nếu bảng quá rộng */
}

h3 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.category-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.category-table th, 
.category-table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

/* Tiêu đề bảng - Xanh lá cây nhạt */
.category-table th {
    background: rgb(39, 62, 133); /* Xanh lá cây nhạt */
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

/* Dòng chẵn, lẻ */
.category-table tr:nth-child(even) {
    background: #f8f9fa;
}

.category-table tr:hover {
    background: #e9f5e1; /* Xanh lá cây rất nhạt */
    transition: 0.3s;
}

/* Nút "Sửa" */
.btn-edit {
    display: inline-block;
    padding: 6px 12px;
    background: #fd7e14;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

.btn-edit:hover {
    background: #dc5a00;
    transition: 0.3s;
}


    </style>
</head>
<body>
     <!-- Sidebar -->
     <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white p-3" id="sidebar">
            <div class="d-flex align-items-center">
                <img src="images/logo.png" alt="Logo" class="img-fluid me-2" style="max-height: 50px;">
                <h4 class="mb-0">Kế Toán</h4>
            </div>

            <ul class="nav flex-column">
                <br>
                <li class="nav-item"><a href="index.php?act=ketoan" class="nav-link text-white"><i class="fas fa-home"></i> Trang chủ kế toán</a></li>
                <li class="nav-item"><a href="index.php?act=hdban" class="nav-link text-white"><i class="fas fa-file-invoice-dollar"></i> Hóa đơn bán</a></li>
                <li class="nav-item"><a href="index.php?act=hdmua" class="nav-link text-white"><i class="fas fa-receipt"></i> Hóa đơn mua</a></li>
                <li class="nav-item"><a href="index.php?act=dsphieuthu" class="nav-link text-white"><i class="fas fa-file-invoice"></i> Quản lý phiếu thu</a></li>
                <li class="nav-item"><a href="index.php?act=dsphieuchi" class="nav-link text-white"><i class="fas fa-money-bill-wave"></i> Quản lý phiếu chi</a></li>
                <li class="nav-item"><a href="index.php?act=CusDebt" class="nav-link text-white"><i class="fas fa-hand-holding-usd"></i> Quản lý công nợ khách hàng</a></li>
                <li class="nav-item"><a href="index.php?act=debttosupplier" class="nav-link text-white"><i class="fas fa-file-contract"></i> Quản lý công nợ nhà cung cấp</a></li>
                <li class="nav-item"><a href="index.php?act=soketoan" class="nav-link text-white"><i class="fas fa-chart-pie"></i> Sổ kế toán chi tiết</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div id="page-content" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-brand">Chào, <?php echo $_SESSION['username']; ?></span>             
                    <div class="out">
                        <a href="index.php?act=thoat"><button class="btn btn-danger" onclick="logout()">Đăng xuất</button></a>
                    </div>

                    <script>
                        function logout() {
                            if (confirm("Bạn có chắc muốn đăng xuất?")) {
                                window.location.href = "index.php?act=thoat"; // Hoặc thay bằng trang xử lý logout
                            }
                        }
                    </script>

                </div>
            </nav>

            <div class="container mt-4">
                <h3>Danh sách công nợ nhà cung cấp</h3>
                <table class="category-table">
                    <tr>
                        <th>STT</th>
                        <th>HĐ mua</th>
                        <th>Mã NCC</th>
                        <th>Tên NCC</th>
                        <th>Tổng tiền</th>
                        <th>Tiền trả</th>
                        <th>Còn nợ</th>
                        <th>Ngày phát sinh</th>
                        <th>Hạng trả</th>
                        <th>Trạng thái</th>
                        <!-- <th>Hành động</th> -->
                    </tr>
                    <!-- Dữ liệu sản phẩm từ PHP -->
                    <?php //var_dump($dm);
                                if(isset($no_ncc) && (count($no_ncc) > 0)){//>1 tức có dl 
                                    $i=1;
                                    foreach ($no_ncc as $sp) {
                                        echo '<tr>
                                                <td>'.$i.'</td>
                                                <td>'.$sp['HDM_ID'].'</td>
                                                <td>'.$sp['NCC_ID'].'</td>
                                                <td>'.$sp['NCC_TEN'].'</td>                                             
                                                <td>'.$sp['CNTR_TONGTIEN'].'</td>
                                                <td>'.$sp['CNTR_SOTIENTRA'].'</td>
                                                <td>'.$sp['CNTR_CONNO'].'</td>
                                                <td>'.$sp['CNTR_NGAYPHATSINH'].'</td>
                                                <td>'.$sp['CNTR_DUKIENTRA'].'</td>
                                                <td>'.$sp['CNTR_TRANGTHAI'].'</td>
                                                
                                                </td>
                                            </tr>';
                                            $i++;
                                    }
                                }
                                ?>
                </table>

            </div>
        </div>
    </div>
    <!-- <td><a class="btn-edit" href="index.php?act=update-sp-form&id='.$sp['CNT_ID'].'">Sửa</a>  -->
</body>
</html>