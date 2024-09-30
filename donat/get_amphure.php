<?php
include('../config/connect.php'); // เชื่อมต่อกับไฟล์ connect.php

$sql = "SELECT * FROM amphures WHERE province_id = :province_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':province_id', $_GET['province_id'], PDO::PARAM_INT);

try {
    $stmt->execute();
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
} catch (PDOException $e) {
    echo json_encode(['error' => 'ไม่สามารถดึงข้อมูลอำเภอได้: ' . $e->getMessage()]);
}
