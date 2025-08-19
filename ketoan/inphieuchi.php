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
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

/* To display Samsung and Mã phiếu thu, Ngày lập in the corners */
/* Header container */
/* Header container */
.receipt-header-container {
    display: flex;
    justify-content: space-between; /* Distribute space between the company info and receipt info */
    align-items: center; /* Vertically center items */
    margin-bottom: 20px;
}

/* Company info (logo and name) */
.cty-info {
    display: flex;
    align-items: center; /* Align the logo and company name vertically */
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
.company-address {
            margin-top: 5px; /* Add space between the name and address */
            font-size: 14px;
            color: #666; /* Lighter color for the address */
        }
/* Receipt info (receipt details) */
.receipt-info {
    display: flex;
    flex-direction: column;
    align-items: flex-stat; /* Align text to the right */
}

.receipt-info p {
    margin: 0;
    font-size: 16px;
    color: #333;
}



.receipt-content {
    margin-bottom: 20px;
    margin-left: 50px;
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
    /*color: #fd7e14;  Orange color */
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
/* Căn phải cho ngày tháng */
.current-date {
            text-align: right;
            font-size: 16px;
            color: #333;
        }
        .date {
            margin-top: 50px;
            text-align: right;
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
                <div class="receipt-info">
                    <p><strong>Mã phiếu chi:</strong> <?php echo $phieuchi['PC_ID']; ?></p>
                    <p><strong>Ngày lập:</strong> <?php echo $phieuchi['PC_NGAYHOACHTOAN']; ?></p>
                </div>
        </div>
    
</div>
<div class="receipt-header">Phiếu Chi</div>
<div class="receipt-content">
   
    <p><strong>Mã hóa đơn:</strong> <?php echo $phieuchi['HDM_ID']; ?></p>
    <p><strong>Nhà cung cấp:</strong> <?php echo $phieuchi['NCC_TEN']; ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo $phieuchi['NCC_SDT']; ?></p>
    <p><strong>Địa chỉ:</strong> <?php echo $phieuchi['NCC_DIACHI']; ?></p>
    <p class="amount"><strong>Số tiền:</strong> <?php echo number_format($phieuchi['PC_SOTIEN'], 0, ',', '.'); ?> VND</p>
</div>

<!-- Hiển thị ngày hiện tại -->
<div class="date">
        <p><span id="current-date"></span></p> 
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


    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const button = document.getElementById('download-pdf');

            // Ẩn nút "Xuất PDF"
            button.style.display = 'none';

            html2canvas(document.getElementById('content-to-print')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                pdf.save('phieu_chi.pdf');

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
