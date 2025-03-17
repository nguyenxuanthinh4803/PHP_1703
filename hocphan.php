<?php
include 'config.php';
$result = $conn->query("SELECT * FROM hocphan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .hocphan-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 15px;
        }
        .hocphan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }
        .btn-dangky {
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Học Phần</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Sinh viên</a></li>
                <li class="nav-item"><a class="nav-link active" href="hocphan.php">Học phần</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">DANH SÁCH HỌC PHẦN</h2>

    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card hocphan-card shadow-sm p-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= $row['TenHP'] ?></h5>
                        <p class="card-text"><strong>Mã học phần:</strong> <?= $row['MaHP'] ?></p>
                        <p class="card-text"><strong>Số tín chỉ:</strong> <?= $row['SoTinChi'] ?></p>
                        <a href="dangkyhocphan.php?MaHP=<?= $row['MaHP'] ?>" class="btn btn-success btn-dangky w-100">Đăng Ký</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
