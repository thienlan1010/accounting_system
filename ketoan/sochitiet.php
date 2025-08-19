<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <title>Phiếu Thu</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .receipt-container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .receipt-header {
            margin-top: 50px;
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* To display Samsung and Mã phiếu thu, Ngày lập in the corners */
        .receipt-header-container {
            display: flex;
            justify-content: space-between; /* Distribute space between the company info and receipt info */
            align-items: center; /* Vertically center items */
            margin-bottom: 20px;
        }

        /**thông tin công ty */
        .cty-info {
            display: flex; /* Align logo and company name horizontally */
            align-items: center; /* Vertically align the logo and company name */
        }

        .cty-info img {
            margin-right: 10px; /* Set 10px space between the logo and company name */
        }

        .cty-info h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        /* Add styling for the company address */
        .company-address {
            margin-top: 5px; /* Add space between the name and address */
            font-size: 14px;
            color: #666; /* Lighter color for the address */
        }

        /* Receipt info (receipt details) */
        .receipt-info {
            /* margin-top: 10px; */
            margin-bottom: 20px;
            font-size: 16px;
            color: #333;
            
            display: flex;
            justify-content: center; /* Căn giữa các phần tử */
            align-items: center; /* Căn giữa theo chiều dọc */
            gap: 20px; /* Tạo khoảng cách giữa các phần tử */
        }

        .receipt-info p {
            margin: 0;
            font-size: 16px;
            color: #333;
            text-align: center; /* Căn giữa văn bản */
        }


        /* Căn phải cho ngày tháng */
        .current-date {
            text-align: right;
            font-size: 16px;
            color: #333;
        }

        .receipt-content {
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 18px;
            color: #333;
        }

        .receipt-content p {
            margin: 5px 0;
        }

        .receipt-content strong {
            color: #000;
        }

        .amount {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Print button styling */
        .print-button {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            background-color: #fd7e14; /* Orange */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        .print-button:hover {
            background-color: #e06d00; /* Darker orange */
        }

        /* ký tên */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            text-align: center;
        }

        .signature-item {
            width: 30%;
        }

        .signature-item p {
            margin: 0;
        }

        .signature-item p:first-child {
            font-weight: bold;
        }

        .signature-item p:last-child {
            margin-top: 5px;
            font-style: italic;
        }

        .date {
            margin-top: 50px;
            text-align: right;
        }

        /* Phần "Mẫu số" nằm ở góc phải */
        .info-banhanh {
            display: flex;
            flex-direction: column;  /* Xếp các phần tử theo chiều dọc */
            justify-content: center; /* Căn giữa theo chiều dọc */
            align-items: center;     /* Căn giữa theo chiều ngang */
            text-align: center;      /* Căn giữa văn bản */
            /* margin-top: 0px; */
        }

        .info-banhanh h5,
        .info-banhanh p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }
        table {
    width: 100%;
    border-collapse: collapse; /* Đảm bảo các đường viền của các ô bảng không bị chồng lên nhau */
}

th, td {
    border: 1px solid #000; /* Đặt đường viền cho các ô bảng */
    padding: 8px;
    text-align: center;
}

    </style>
</head>
<body>
<div class="receipt-container" id="content-to-print">
    <div class="receipt-header-container">
        <div class="cty-info">
            <img src="images/logo.png" alt="Logo" width="60px" height="60px">
            <div>
                <h2>Công Ty Samsung</h2>
                <p class="company-address">9A Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, TP. Cần Thơ</p>
            </div>
        </div>
        <div class="info-banhanh">
            <h5>Mẫu số: 02-VT</h5>
            <p>(Ban hành theo Thông tư số: 200/2014/TT-BTC Ngày 22/12/2014 của BTC)</p>
            <!-- <p>Ngày 22/12/2014 của BTC</p> -->
        </div>
    </div>
    
    <div class="receipt-header">Sổ kế toán chi tiết quỹ tiền mặt</div>
    
    <!-- Phần "Từ ngày đến ngày" nằm ngang -->
    <div class="receipt-info">
        <p><strong>Từ:</strong> <?php echo $tu; ?></p>
        <p><strong>Đến:</strong> <?php echo $den; ?></p>
    </div>

    <div class="receipt-content">
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Loại Phiếu</th>
                    <th>Mã Phiếu</th>
                    <th>Ngày Hoạch Toán</th>
                    <th>Ngày Chứng Từ</th>
                    <th>Số Tiền</th>
                    <th>Diễn Giải</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kqct as $phieu): ?>
                    <tr>
                        <td><?php echo $phieu['LOAI']; ?></td>
                        <td><?php echo $phieu['ID']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($phieu['NGAYHOACHTOAN'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($phieu['NGAYCHUNGTU'])); ?></td>
                        <td><?php echo number_format($phieu['SOTIEN'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo $phieu['TKKT_DIENGIAI']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="date">
        <p><span id="current-date"></span></p> <!-- Hiển thị ngày hiện tại -->
    </div>

    <!-- Khu vực ký tên nằm ngang với "(ký, họ tên)" -->
    <div class="signature-section">
        <div class="signature-item">
            <p><strong>Người lập phiếu</strong></p>
            <p>(ký, họ tên)</p>
        </div>
        <div class="signature-item">
            <p><strong>Kế toán trưởng</strong></p>
            <p>(ký, họ tên)</p>
        </div>
        <div class="signature-item">
            <p><strong>Giám đốc</strong></p>
            <p>(ký, họ tên)</p>
        </div>
    </div>

    <button class="print-button" id="download-pdf">Xuất PDF</button>
</div>

<script>
   document.getElementById('download-pdf').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const button = document.getElementById('download-pdf');

    // Ẩn nút "Xuất PDF"
    button.style.display = 'none';

    html2canvas(document.getElementById('content-to-print'), {
        useCORS: true, // Sử dụng CORS để hỗ trợ tải hình ảnh đúng
        logging: true,  // Ghi lại các thông báo trong console nếu có lỗi
        backgroundColor: "#fff", // Đảm bảo nền trắng khi render
    }).then(function(canvas) {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const imgWidth = 190;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        pdf.save('so_ke_toan.pdf');

        // Hiển thị lại nút sau khi tạo PDF
        button.style.display = 'block';
    });
});


    // Đoạn mã JavaScript để lấy ngày tháng năm hiện tại và hiển thị vào phần "Ngày"
    document.addEventListener("DOMContentLoaded", function() {
        const currentDate = new Date();
        const day = currentDate.getDate(); // Ngày
        const month = currentDate.getMonth() + 1; // Tháng (cộng thêm 1 vì tháng trong JavaScript bắt đầu từ 0)
        const year = currentDate.getFullYear(); // Năm

        // Hiển thị theo định dạng "Ngày 4 tháng 4 năm 2025"
        const formattedDate = `Ngày ${day} tháng ${month} năm ${year}`;

        // Đặt ngày vào phần tử có id là "current-date"
        document.getElementById('current-date').textContent = formattedDate;
    });
</script>

</body>
</html>
