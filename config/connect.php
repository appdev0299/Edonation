<?php
// connect.php
$servername = "localhost";
$username = "edonation";
$password = "edonate@FON"; // เปลี่ยนเป็นรหัสผ่านของคุณ
$dbname = "edonation"; // เปลี่ยนเป็นชื่อฐานข้อมูลของคุณ

try {
    // ตั้งค่า charset=utf8 เพื่อให้รองรับการใช้งาน utf-8
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
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
