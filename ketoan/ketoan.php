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
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #a855f7; /* Màu cam */
            color: white !important;
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
                <h3>Dashboard</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Doanh thu</h5>
                            <p class="text-success fs-4"><?php echo $total?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Hóa đơn bán</h5>
                            <p class="text-primary fs-4"><?php echo $total_hdb?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Hóa đơn mua</h5>
                            <p class="text-primary fs-4"><?php echo $total_hdm?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Khách hàng</h5>
                            <p class="text-warning fs-4"><?php echo $total_kh?></p>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 mb-5">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Nhà cung cấp</h5>
                            <p class="text-warning fs-4"><?php echo $total_ncc?></p>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 mb-5">
                        <div class="card p-3 text-center shadow-sm">
                            <h5>Chi phí</h5>
                            <p class="text-danger fs-4"><?php echo $total_chi?></p>
                        </div>
                    </div>
                </div>

                <!-- DOANH THU THEO THÁNG -->
            <div class="card">
                <div class="card-body" style="background-color: rgb(11, 23, 57); color: rgb(174, 185, 225);">
                    <h5>Doanh Thu Theo Tháng</h5> <!-- Tiêu đề cho biểu đồ -->
                    <!-- nút <> -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="prevYear" class="btn btn-light">&lt;</button> <!-- Mũi tên lùi -->
                        <h5 id="yearLabel">Năm 2025</h5> <!-- Hiển thị năm hiện tại -->
                        <button id="nextYear" class="btn btn-light">&gt;</button> <!-- Mũi tên tiến -->
                    </div>
                    <canvas id="revenueChart"></canvas>
                   
                </div>
                
                <script>
                    const ctx = document.getElementById('revenueChart').getContext('2d');

                    // Dữ liệu từ PHP
                    const yearlyData = <?php echo json_encode($yearly_monthly_revenue); ?>;

                    const chartLabels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

                    // Khởi tạo biểu đồ với dữ liệu ban đầu
                    let currentYear = 2025; // Năm hiện tại (mặc định là 2025)
                    let chartData = {
                        labels: chartLabels,
                        datasets: [{
                            label: `Doanh thu (VNĐ) - Năm ${currentYear}`,
                            data: yearlyData[currentYear] || Array(12).fill(0), // Nếu không có dữ liệu cho năm hiện tại, sử dụng mảng 0
                            backgroundColor: 'rgb(7, 203, 247)', // Màu cột
                            borderColor: 'rgba(54, 162, 235, 1)', // Màu viền cột
                            borderWidth: 1
                        }]
                    };

                    const revenueChart = new Chart(ctx, {
                        type: 'bar', // Loại biểu đồ: cột
                        data: chartData,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true // Bắt đầu từ 0
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true, // Hiển thị chú thích
                                    position: 'top' // Vị trí chú thích
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.raw.toLocaleString(); // Định dạng số liệu với dấu phẩy
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Thay đổi dữ liệu khi nhấn mũi tên
                    document.getElementById('prevYear').addEventListener('click', function() {
                        currentYear--; // Lùi lại 1 năm
                        if (!yearlyData[currentYear]) {
                            yearlyData[currentYear] = Array(12).fill(0); // Nếu không có dữ liệu, set mặc định là 0 cho tất cả tháng
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChart(currentYear);
                    });

                    document.getElementById('nextYear').addEventListener('click', function() {
                        currentYear++; // Tiến lên 1 năm
                        if (!yearlyData[currentYear]) {
                            yearlyData[currentYear] = Array(12).fill(0); // Nếu không có dữ liệu, set mặc định là 0 cho tất cả tháng
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChart(currentYear);
                    });

                    // Hàm cập nhật biểu đồ
                    function updateChart(year) {
                        // Cập nhật tiêu đề năm
                        document.getElementById('yearLabel').innerText = `Năm ${year}`;

                        // Cập nhật dữ liệu của biểu đồ
                        revenueChart.data.datasets[0].label = `Doanh thu (VNĐ) - Năm ${year}`;
                        revenueChart.data.datasets[0].data = yearlyData[year] || Array(12).fill(0); // Nếu không có dữ liệu thì mặc định 0 cho tất cả tháng

                        // Vẽ lại biểu đồ với dữ liệu mới
                        revenueChart.update();
                    }
                </script>

            </div>

            <!-- TỔNG CHI THEO THÁNG -->  
<div class="card">
    <div class="card-body" style="background-color: rgb(11, 23, 57); color: rgb(174, 185, 225);">
        <h5>Tổng Chi Theo Tháng</h5> <!-- Tiêu đề biểu đồ -->
        <div class="d-flex justify-content-between align-items-center">
            <button id="prevYearOrders" class="btn btn-light">&lt;</button> <!-- Mũi tên lùi -->
            <h5 id="yearLabelOrders">Năm 2025</h5> <!-- Hiển thị năm hiện tại -->
            <button id="nextYearOrders" class="btn btn-light">&gt;</button> <!-- Mũi tên tiến -->
        </div>
        <canvas id="ordersChart"></canvas>
    </div>

    <script>
        const ctxOrders = document.getElementById('ordersChart').getContext('2d');

        // Dữ liệu từ PHP
        const yearlyDataOrders = <?php echo json_encode($yearly_monthly_orders); ?>;

        const orderChartLabels  = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

        let currentYearOrders = 2025; // Mặc định là 2025
        let chartDataOrders = {
            labels: orderChartLabels,
            datasets: [{
                label: `Tổng Chi - Năm ${currentYearOrders}`,
                data: yearlyDataOrders[currentYearOrders] || Array(12).fill(0),
                backgroundColor: 'rgb(7, 203, 247)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const ordersChart = new Chart(ctxOrders, {
            type: 'bar',
            data: chartDataOrders,
            options: {
                responsive: true,
                scales: {
                    y: {
                                    beginAtZero: true // Bắt đầu từ 0
                                }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw.toLocaleString() + ' VNĐ'; // Định dạng tiền tệ trong tooltip
                            }
                        }
                    }
                }
            }
        });

        // Nút lùi năm
        document.getElementById('prevYearOrders').addEventListener('click', function() {
            currentYearOrders--;
            if (!yearlyDataOrders[currentYearOrders]) {
                yearlyDataOrders[currentYearOrders] = Array(12).fill(0);
            }
            updateChartOrders(currentYearOrders);
        });

        // Nút tiến năm
        document.getElementById('nextYearOrders').addEventListener('click', function() {
            currentYearOrders++;
            if (!yearlyDataOrders[currentYearOrders]) {
                yearlyDataOrders[currentYearOrders] = Array(12).fill(0);
            }
            updateChartOrders(currentYearOrders);
        });

        // Cập nhật biểu đồ
        function updateChartOrders(year) {
            document.getElementById('yearLabelOrders').innerText = `Năm ${year}`;
            ordersChart.data.datasets[0].label = `Tổng Chi - Năm ${year}`;
            ordersChart.data.datasets[0].data = yearlyDataOrders[year];
            ordersChart.update();
        }
    </script>
</div>

            </div>
        </div>
    </div>

</body>
</html>