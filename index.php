<?php
include 'config.php';

// Truy vấn lấy dữ liệu sinh viên và ngành học
$result = $conn->query("SELECT SinhVien.MaSV, SinhVien.HoTen, SinhVien.GioiTinh, SinhVien.NgaySinh, SinhVien.Hinh, NganhHoc.MaNganh FROM SinhVien LEFT JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #28a745 !important; /* Xanh lá đậm */
        }
        .navbar .nav-link {
            color: #fff !important;
        }
        h2 {
            color: #28a745; /* Màu xanh lá */
        }
        .table thead {
            background-color: #28a745;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #d4edda;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Sinh viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hocphan.php">Học phần</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-light btn-sm" href="login.php">Đăng Nhập</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Danh sách sinh viên -->
<div class="container mt-4">
    <h2>Danh sách sinh viên</h2>
    <a href="create.php" class="btn btn-primary mb-3">Thêm sinh viên</a>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Hình ảnh</th>
                <th>Họ và Tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Mã Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['MaSV']) ?></td>
                <td>
                    <?php 
                    $imagePath = "Content/images/" . htmlspecialchars($row['Hinh']);
                    if (!empty($row['Hinh']) && file_exists($imagePath)) {
                        echo '<img src="'.$imagePath.'" width="50" class="rounded">';
                    } else {
                        echo '<img src="Content/images/default.png" width="50" class="rounded" alt="Không có ảnh">';
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($row['HoTen']) ?></td>
                <td><?= htmlspecialchars($row['GioiTinh']) ?></td>
                <td><?= htmlspecialchars($row['NgaySinh']) ?></td>
                <td><?= htmlspecialchars($row['MaNganh']) ?></td>
                <td>
    <a href="detail.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-success btn-sm rounded-pill px-3">Xem</a>
    <a href="edit.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-warning btn-sm rounded-pill px-3">Sửa</a>
    <a href="delete.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-danger btn-sm rounded-pill px-3" 
       onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
</td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>