<?php
// เรียกไฟล์สำหรับเชื่อมต่อฐานข้อมูล
include '../config/connect.php';

if (isset($_GET['district_id'])) {
    $district_id = $_GET['district_id'];

    try {
        // เตรียมคำสั่ง SQL
        $sql = "SELECT zip_code FROM districts WHERE id = :district_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':district_id', $district_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // ส่งกลับ JSON
        echo json_encode(['zip_code' => $row['zip_code'] ?? null]);
    } catch (PDOException $e) {
        // หากเกิดข้อผิดพลาดในการดึงข้อมูล
        echo json_encode(['error' => 'ไม่สามารถดึงข้อมูลได้: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8')]);
    }
} else {
    echo json_encode(['error' => 'ไม่มี district_id']);
}
