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
    <!-- biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Kế Toán</title>
    <style>
       body {
            background-color: #f8f9fa;
        }
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #a855f7; /* Màu cam */
            color: white !important;
        }
        .container {
            max-width: 100%;
            /*overflow-x: auto;  Để cuộn ngang nếu bảng quá rộng */
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

}

        /*DANH SÁCH PHIẾU THU*/ 
        h3{
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .option{
            display: flex; /* Sử dụng Flexbox để dễ dàng căn giữa */
    justify-content: center; /* Căn giữa các phần tử theo chiều ngang */
    gap: 15px; /* Khoảng cách giữa các nút */
    margin-top: 40px; /* Khoảng cách phía trên */
            
        }
/* Nút "Sửa" */
.btn-edit {
    display: inline-block;
    padding: 6px 12px;
    background:rgb(34, 219, 13);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}
.btn-del{
    display: inline-block;
    padding: 6px 12px;
    background:rgb(242, 61, 10);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}
.btn-del:hover {
    background:rgb(164, 4, 4);
    transition: 0.3s;
}
.btn-edit:hover {
    background:rgb(13, 149, 35);
    transition: 0.3s;
}
.btn-in{
    display: inline-block;
    padding: 6px 12px;
    background:rgb(24, 144, 229);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}
.btn-in:hover {
    background:rgb(6, 82, 136);
    transition: 0.3s;
}
.btn-sua{
    display: inline-block;
    padding: 6px 12px;
    background:rgb(202, 177, 11);
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}
.btn-sua:hover {
    background:rgb(133, 108, 6);
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
                <h3>Danh sách các lựa chọn</h3>
                <div class="option">
                    <a class="btn-edit" href="index.php?act=chitiet-pt&id=<?php echo $kqluachon?>">Xem chi tiết</a>                                  
                    <a class="btn-sua" href="index.php?act=suaphieuthu&id=<?php echo $kqluachon?>">Sửa phiếu thu</a>
                    <a class="btn-del" href="#" onclick="xoa('<?php echo $kqluachon?>')">Xóa phiếu thu</a>
                    <a class="btn-in" href="index.php?act=in-phieuthu&id=<?php echo $kqluachon?>">In phiếu thu</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function xoa(id) {
            if (confirm("Bạn có chắc muốn xóa phiếu thu này không?")) {
                window.location.href = "index.php?act=xoa_pt&id=" + id;
            }
        }
    </script>
</body>
</html>