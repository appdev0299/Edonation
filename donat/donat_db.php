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
        $district_id = $_POST['district'] ?? null; // เปลี่ยนเป็น district_id
        $amphure_id = $_POST['amphure'] ?? null; // เปลี่ยนเป็น amphure_id
        $province_id = $_POST['province'] ?? null; // เปลี่ยนเป็น province_id

        // รับค่า project_number จากฟอร์ม
        $project_number = $_POST['project_number'] ?? 'default_project_number';

        $gift = isset($_POST['gift']) ? 1 : 0;
        $cc_email = isset($_POST['cc_email']) ? 1 : 0;

        // ตรวจสอบ province
        $province_sql = "SELECT name_th FROM provinces WHERE id = :province_id";
        $province_stmt = $pdo->prepare($province_sql);
        $province_stmt->bindParam(':province_id', $province_id);
        $province_stmt->execute();
        $province_row = $province_stmt->fetch(PDO::FETCH_ASSOC);
        $province_name = $province_row['name_th'] ?? '';

        // ตรวจสอบ amphure
        $amphure_sql = "SELECT name_th FROM amphures WHERE id = :amphure_id";
        $amphure_stmt = $pdo->prepare($amphure_sql);
        $amphure_stmt->bindParam(':amphure_id', $amphure_id);
        $amphure_stmt->execute();
        $amphure_row = $amphure_stmt->fetch(PDO::FETCH_ASSOC);
        $amphure_name = $amphure_row['name_th'] ?? '';

        // ตรวจสอบ district และดึง zip_code
        $district_sql = "SELECT name_th, zip_code FROM districts WHERE id = :district_id";
        $district_stmt = $pdo->prepare($district_sql);
        $district_stmt->bindParam(':district_id', $district_id);
        $district_stmt->execute();
        $district_row = $district_stmt->fetch(PDO::FETCH_ASSOC);
        $district_name = $district_row['name_th'] ?? '';
        $zip_code = $district_row['zip_code'] ?? '';

        // เตรียมคำสั่ง SQL
        $sql = "INSERT INTO donat_user (type, email, phone, amount, address, district, amphure, province, gift, cc_email, created_at, project_number, project_name, status_donat,payby, zip_code) 
                VALUES (:type, :email, :phone, :amount, :address, :district_name, :amphure_name, :province_name, :gift, :cc_email, CURRENT_TIMESTAMP, :project_number, :project_name, :status_donat, :payby, :zip_code)";

        $stmt = $pdo->prepare($sql);

        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':district_name', $district_name);
        $stmt->bindParam(':amphure_name', $amphure_name);
        $stmt->bindParam(':province_name', $province_name);
        $stmt->bindParam(':gift', $gift);
        $stmt->bindParam(':cc_email', $cc_email);
        $stmt->bindParam(':project_number', $project_number);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':status_donat', $status_donat);
        $stmt->bindParam(':payby', $payby);
        $stmt->bindParam(':zip_code', $zip_code);
        $status_donat = 'online';
        $payby = 'QR CODE';

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
