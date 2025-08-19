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
            /*overflow-x: auto;  Để cuộn ngang nếu bảng quá rộng */
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

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

/**phiếu thu */

        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
}

h2 {
    text-align: center;
    font-weight: bold;
    color: #333;
}

.section-title {
    background-color: rgb(39, 62, 133);
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.form-control {
    height: 40px;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
}

.form-control:focus {
    border-color: rgb(39, 62, 133);
    box-shadow: 0 0 5px rgba(118, 214, 147, 0.5);
}

.table th {
    background-color: rgb(39, 62, 133);
    color: white;
    text-align: center;
    padding: 10px;
}

.table td {
    padding: 8px;
}

.btn-submit {
    background-color: rgb(202, 136, 29);
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    transition: 0.3s;
}

.btn-submit:hover {
    background-color: rgb(169, 141, 32);
    transform: scale(1.05);
}
/**mũi tên  */
.custom-input {
    position: relative;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000000'%3E%3Cpath fill-rule='evenodd' d='M1.5 5.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 .354.854l-6 6a.5.5 0 0 1-.708 0l-6-6A.5.5 0 0 1 1.5 5.5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
    cursor: pointer;
}

/* Tăng kích thước của dropdown menu */
.dropdown-menu {
    width: 275px !important; /* Điều chỉnh độ rộng */
    font-size: 16px; /* Tăng kích thước chữ */
    padding: 10px 0; /* Tạo khoảng cách giữa các mục */
    max-height: 250px; /* Giới hạn chiều cao */
    overflow-y: auto; /* Bật thanh cuộn khi cần */
    scrollbar-width: thin; /* Thanh cuộn mỏng trên Firefox */
}

/* Tăng chiều cao của từng mục trong dropdown */
.dropdown-item {
    padding: 12px 16px; /* Tăng khoảng cách */
    font-size: 16px; /* Tăng kích thước chữ */
    white-space: nowrap; /* Tránh xuống dòng */
}

/* Chỉnh input để đồng bộ với dropdown */
.custom-input {
    height: 45px; /* Tăng chiều cao */
    font-size: 16px; /* Tăng kích thước chữ */
}
/* Hiệu ứng hover khi di chuột vào */
.dropdown-item:hover {
    background-color:rgb(152, 136, 210); /* Màu xanh khi hover */
    color: white; /* Chữ trắng để dễ nhìn */
}
/**đôi tượng */
.custom-dropdown-input {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='black'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 1rem;
    padding-right: 2rem;
}
/* Tùy chỉnh thanh cuộn */
::-webkit-scrollbar {
    width: 8px; /* Độ rộng thanh cuộn */
}

::-webkit-scrollbar-thumb {
    background: #fd7e14; /* Màu thanh cuộn */
    border-radius: 4px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1; /* Màu nền của rãnh */
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
                
        <h2 class="text-center">Phiếu Chi</h2>
        
        <!-- Thông tin chung -->
        <form action="index.php?act=xuly-phieuchi"  method="POST" >
    <!-- <div class="section-title">Thông tin chung</div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label>Đối tượng</label>
            <div class="dropdown w-100">
                <input type="text" class="form-control dropdown-toggle custom-dropdown-input" id="doituongInput" name="doituong" data-bs-toggle="dropdown" placeholder="Chọn mã đối tượng" autocomplete="off" required>
                <ul class="dropdown-menu w-100" id="doituongList">
                    <?php foreach ($ncc as $cus): ?>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectDoiTuong('<?php echo htmlspecialchars($cus['NCC_ID']); ?>')">
                                <?php echo htmlspecialchars($cus['NCC_ID']); ?> - <?php echo htmlspecialchars($cus['NCC_TEN']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
         <div class="col-md-6">
            <label>Nhân viên thu</label>
            <input type="text" class="form-control" name="nhanvien" placeholder="Nhập mã nhân viên" required>
        </div> 
    </div> -->

    <!-- Chứng từ -->
    <div class="section-title mt-4">Chứng từ</div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label>Ngày hạch toán</label>
            <input type="date" class="form-control" name="ngay_hachtoan" required>
        </div>
        <div class="col-md-4">
            <label>Ngày chứng từ</label>
            <input type="date" class="form-control" name="ngay_chungtu" required>
        </div>
        <div class="col-md-4">
            <label>Mã hóa đơn</label>
            <div class="dropdown w-100">
                <input type="text" class="form-control dropdown-toggle custom-dropdown-input" id="hoadonInput" name="hoadon" data-bs-toggle="dropdown" placeholder="Chọn mã hóa đơn" autocomplete="off" readonly required>
                <ul class="dropdown-menu w-100" id="doituongList">
                    <?php foreach ($hd as $cus): ?>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectHoaDon('<?php echo htmlspecialchars($cus['HDM_ID']); ?>')">
                                <?php echo htmlspecialchars($cus['HDM_ID']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Hạch toán -->
    <div class="section-title mt-4">Hạch toán</div>
    <table class="table table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>Diễn giải</th>
                <th>TK Nợ</th>
                <th>TK Có</th>
                <th>Số tiền</th>
                <!-- <th>Đối tượng</th>
                <th>Tên đối tượng</th>                    -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="dropdown w-100">
                        <input type="text" class="form-control dropdown-toggle custom-input" id="diengiaiInput" name="diengiai" data-bs-toggle="dropdown" placeholder="Chọn diễn giải" autocomplete="off" readonly required>
                        <input type="hidden" id="diengiaiIdInput" name="diengiai_id"> <!-- Trường ẩn lưu ID -->
                        <ul class="dropdown-menu w-100" id="diengiaiList">
                            <?php foreach ($tk as $dg): ?>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectDienGiai(
                                        '<?php echo htmlspecialchars($dg['TKKT_DIENGIAI']); ?>',  // ID của diễn giải
                                        '<?php echo htmlspecialchars($dg['TKKT_ID']); ?>',
                                        '<?php echo htmlspecialchars($dg['TKKT_NO']); ?>',
                                        '<?php echo htmlspecialchars($dg['TKKT_CO']); ?>'
                                    )">
                                        <?php echo htmlspecialchars($dg['TKKT_DIENGIAI']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </td>
                <td><input type="text" class="form-control" id="tkNoInput" name="tk_no" placeholder="TK Nợ" readonly required></td>
                <td><input type="text" class="form-control" id="tkCoInput" name="tk_co" placeholder="TK Có" readonly required></td>
                <td><input type="number" class="form-control" name="so_tien" placeholder="Nhập số tiền" min=0 required></td>
                <!-- <td><input type="text" class="form-control" id="doituongInput2" name="" data-bs-toggle="dropdown" placeholder="Nhập mã đối tượng" autocomplete="off" required></td>
                  -->
                  <!-- <td>
    <div class="dropdown w-100">
        <input type="text" class="form-control dropdown-toggle custom-input" 
            id="doituongInput2" 
            name="doituong" 
            data-bs-toggle="dropdown" 
            placeholder="Nhập mã đối tượng" 
            autocomplete="off" 
            required>
        <ul class="dropdown-menu w-100" id="doituongList">
            <?php foreach ($ncc as $cus): ?>
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectDoiTuong2(
                        '<?php echo htmlspecialchars($cus['NCC_ID']); ?>',  
                        '<?php echo htmlspecialchars($cus['NCC_TEN']); ?>'
                    )">
                        <?php echo htmlspecialchars($cus['NCC_ID']); ?> - <?php echo htmlspecialchars($cus['NCC_TEN']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</td>
<td>
    <input type="text" class="form-control" id="tenDoiTuong" name="ten_doi_tuong" placeholder="Chọn đối tượng" readonly>
</td> -->


            </tr>
        </tbody>
    </table>

    <!-- Nút Lưu -->
    <div class="text-center mt-4">
        <input type="submit" class="btn-submit" name="savechi" value="Lưu phiếu thu">
    </div>
</form>





<script>
   // Chọn diễn giải và cập nhật các giá trị liên quan
function selectDienGiai(dienGiai, id, tkNo, tkCo) {
    document.getElementById("diengiaiInput").value = dienGiai;
    document.getElementById("diengiaiIdInput").value = id; // Gán ID vào input ẩn
    document.getElementById("tkNoInput").value = tkNo;
    document.getElementById("tkCoInput").value = tkCo;
}

// Chọn đối tượng và cập nhật thông tin vào form
// function selectDoiTuong(value) {
//         document.getElementById("doituongInput").value = value;
//         document.querySelector("input[name='ten_doi_tuong']").value = name;
//     }
   
// Đóng dropdown khi click ra ngoài
document.addEventListener("click", function(event) {
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
        if (!menu.closest(".dropdown").contains(event.target)) {
            menu.classList.remove("show");
        }
    });
});

// function selectDoiTuong2(maKhachHang, tenKhachHang) {
//     document.getElementById("doituongInput2").value = maKhachHang; // Gán mã KH vào ô nhập
//     document.getElementById("tenDoiTuong").value = tenKhachHang;   // Gán tên KH vào ô bên cạnh
// }

function selectHoaDon(value) {
    document.getElementById("hoadonInput").value = value; // Gán mã KH vào ô nhập
}

// onsubmit="return validateSearch()"
                    // function validateSearch() {
                    //     var keyword = document.querySelector('input[name="nhaptim"]').value.trim();
                    //     if (keyword === "") {
                    //         alert("Vui lòng nhập từ khóa tìm kiếm!");
                    //         return false; // Ngăn không cho gửi form
                    //     }
                    //     return true;
                    // }

    
</script>



        </div>
    </div>
</body>
</html>