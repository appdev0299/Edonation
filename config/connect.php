<?php
// connect.php
$servername = "localhost";
$username = "root";
$password = ""; // เปลี่ยนเป็นรหัสผ่านของคุณ
$dbname = "e-donation"; // เปลี่ยนเป็นชื่อฐานข้อมูลของคุณ

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล',
                text: '" . $e->getMessage() . "',
                confirmButtonColor: '#ffaa00'
            });
        </script>
    ";
    exit(); // หยุดการทำงานหากเชื่อมต่อไม่ได้
}