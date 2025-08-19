<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/ketoan.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Kế Toán</title>
</head>
<body>
     <!-- Sidebar -->
     <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white p-3" id="sidebar">
            <h4 class="text-center">Tài chính</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-home"></i>Menu</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-file-invoice"></i>Xem báo cáo doanh thu</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-users"></i>Xem biểu đồ doanh thu</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div id="page-content" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-brand">Chào, Tài chính!</span>
                    <div class="ms-auto">
                        <img src="avatar.png" alt="Avatar" class="rounded-circle" width="40">
                    </div>
                </div>
            </nav>

            <div class="container mt-4">
                <h3>Dashboard</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Doanh thu</h5>
                            <p class="text-success fs-4">50,000,000đ</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Hóa đơn</h5>
                            <p class="text-primary fs-4">120</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Khách hàng</h5>
                            <p class="text-warning fs-4">200</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Chi phí</h5>
                            <p class="text-danger fs-4">10,000,000đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>