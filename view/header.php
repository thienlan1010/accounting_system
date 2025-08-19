<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="view/CSS/home.css">

    <title>Kế Toán</title>
</head>
<body>
    <div class="wrapper">
        <!-- phần header -->
        <header class="bg-gray-custom shadow-sm">
            <div class="container">
                <div class="row align-items-center py-3">
                    <!-- Logo -->
                    <div class="col-md-6 d-flex align-items-center">
                        <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
                        <h2 class="ms-3 text-primary">Samsung FinMaster</h2> <!-- Thêm tên website -->
                    </div>
        
                    <!-- Login Button -->
                    <div class="col-md-6 d-flex justify-content-end">
                        <!-- Nút mở modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Đăng nhập
                        </button>
                    </div>
                </div>
            </div>
        </header>
    </div>
    
    <!-- login -->
    <div class="modal fade <?php echo !empty($txt) ? 'show' : ''; ?>" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="loginModalLabel">Đăng nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?act=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <!-- Mở modal nếu có lỗi -->

                        <input name="dangnhap" type="submit" class="btn btn-success custom-btn" value="Đăng nhập">
                    </form>
                </div>
                
                 <!-- Hiển thị lỗi -->
                 <?php if (!empty($txt)): ?>
                        <div class="alert alert-danger"><?php echo $txt; ?></div>
                    <?php endif; ?>

            </div>
        </div>
    </div>

<!-- Mở modal nếu có lỗi -->
<?php if (!empty($txt)): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
            myModal.show();
        });
    </script>
<?php endif; ?>