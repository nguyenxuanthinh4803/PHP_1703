<?php
include 'config.php'; // Kết nối đến cơ sở dữ liệu

if (isset($_GET['MaSV'])) {
    $maSV = $_GET['MaSV'];

    // Kiểm tra xem sinh viên có tồn tại không
    $checkQuery = $conn->prepare("SELECT Hinh FROM SinhVien WHERE MaSV = ?");
    $checkQuery->bind_param("s", $maSV);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = "Content/images/" . basename($row['Hinh']);

        // Bắt đầu transaction
        $conn->begin_transaction();
        try {
            // Xóa các bản ghi liên quan trong bảng DangKy trước
            $deleteDangKy = $conn->prepare("DELETE FROM DangKy WHERE MaSV = ?");
            $deleteDangKy->bind_param("s", $maSV);
            $deleteDangKy->execute();

            // Xóa sinh viên khỏi CSDL
            $deleteSinhVien = $conn->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
            $deleteSinhVien->bind_param("s", $maSV);
            $deleteSinhVien->execute();

            // Xóa ảnh nếu không phải ảnh mặc định
            if (!empty($row['Hinh']) && file_exists($imagePath) && $row['Hinh'] !== 'default.png') {
                unlink($imagePath);
            }

            // Hoàn thành transaction
            $conn->commit();
            echo "<script>alert('Xóa sinh viên thành công!'); window.location.href='index.php';</script>";
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $conn->rollback();
            echo "<script>alert('Lỗi khi xóa sinh viên!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy sinh viên!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Thiếu thông tin sinh viên!'); window.location.href='index.php';</script>";
}
?>
