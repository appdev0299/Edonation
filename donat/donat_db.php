<?php
// เรียกไฟล์สำหรับเชื่อมต่อฐานข้อมูล
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // รับข้อมูลจากฟอร์ม
        $type = $_POST['type'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $amount = $_POST['amount'] ?? null;
        $project_name = $_POST['project_name'] ?? null;
        $address = $_POST['address'] ?? null;
        $subdistrict = $_POST['subdistrict'] ?? null;
        $district = $_POST['district'] ?? null;
        $province = $_POST['province'] ?? null;

        // รับค่า project_number จากฟอร์ม
        $project_number = $_POST['project_number'] ?? 'default_project_number';

        $gift = isset($_POST['gift']) ? 1 : 0;
        $cc_email = isset($_POST['cc_email']) ? 1 : 0;

        // เตรียมคำสั่ง SQL
        $sql = "INSERT INTO donat_user (type, email, phone, amount, address, subdistrict, district, province, gift, cc_email, created_at, project_number, project_name, status_donat) 
        VALUES (:type, :email, :phone, :amount, :address, :subdistrict, :district, :province, :gift, :cc_email, CURRENT_TIMESTAMP, :project_number, :project_name, :status_donat)";

        $stmt = $pdo->prepare($sql);

        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':subdistrict', $subdistrict);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':province', $province);
        $stmt->bindParam(':gift', $gift);
        $stmt->bindParam(':cc_email', $cc_email);
        $stmt->bindParam(':project_number', $project_number);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':status_donat', $status_donat);
        $status_donat = 'online';


        $stmt->execute();

        // ดึง ID ล่าสุดที่สร้างขึ้น
        $lastId = $pdo->lastInsertId();

        // ดึงค่า created_at จากฐานข้อมูล
        $created_at_sql = "SELECT created_at, project_number FROM donat_user WHERE id = :id";
        $created_at_stmt = $pdo->prepare($created_at_sql);
        $created_at_stmt->bindParam(':id', $lastId);
        $created_at_stmt->execute();
        $row = $created_at_stmt->fetch(PDO::FETCH_ASSOC);

        $created_at = $row['created_at'];
        $project_number = $row['project_number']; // รับค่า project_number จากฐานข้อมูล

        // สร้างเลข billPaymentRef1
        $year = date('Y') + 543; // ปี พ.ศ. ปรับเป็นปี ค.ศ.
        $year_last_two = substr($year, -2); // สองหลักหลังสุด (เช่น 67)

        // เติม 0 ให้ครบ 7 หลัก
        $serial_number = sprintf("%07d", $lastId);

        $billPaymentRef1 = $year_last_two . $project_number . $serial_number;

        // อัปเดตตารางด้วยเลข billPaymentRef1
        $update_sql = "UPDATE donat_user SET billPaymentRef1 = :billPaymentRef1 WHERE id = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':billPaymentRef1', $billPaymentRef1);
        $update_stmt->bindParam(':id', $lastId);
        $update_stmt->execute();

        // แสดง SweetAlert2 แจ้งเตือนการบันทึกข้อมูลสำเร็จ
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกสำเร็จ!',
                    text: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
                    confirmButtonColor: '#ffaa00',
                    timer: 3000, // ปิดอัตโนมัติหลังจาก 3 วินาที
                    showConfirmButton: false // ซ่อนปุ่ม OK
                }).then(function() {
                    window.location.href = 'qrgenerator?billPaymentRef1=' + encodeURIComponent('" . $billPaymentRef1 . "') + 
                                      '&id=' + encodeURIComponent('" . $lastId . "') + 
                                      '&amount=' + encodeURIComponent('" . $amount . "') + 
                                      '&created_at=' + encodeURIComponent('" . $created_at . "');
                });
            };
        </script>
        ";
    } catch (Exception $e) {
        // แสดง SweetAlert2 แจ้งเตือนเมื่อเกิดข้อผิดพลาด
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: '" . $e->getMessage() . "',
                    confirmButtonColor: '#ffaa00'
                });
            </script>
        ";
    }
}