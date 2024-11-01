<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../config/connect.php';
require_once "../phpmailer/PHPMailerAutoload.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['billPaymentRef1'], $data['amount'], $data['created_at'], $data['id'])) {
    $billPaymentRef1 = htmlspecialchars($data['billPaymentRef1'], ENT_QUOTES, 'UTF-8');
    $amount = filter_var($data['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $created_at = date('Y-m-d', strtotime($data['created_at']));

    try {
        // ตรวจสอบข้อมูลในตาราง json_donat
        $sql = "SELECT * FROM json_donat WHERE billPaymentRef1 = :billPaymentRef1 AND amount = :amount AND DATE(date) = :created_at";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':billPaymentRef1', $billPaymentRef1);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $copy_sql = "INSERT INTO donat (billPaymentRef1, type, email, phone, amount, address, district, amphure, province, zip_code, gift, cc_email, project_number, project_name, created_at, payby,status_donat, payerAccountName, billPaymentRef2) 
             SELECT du.billPaymentRef1, du.type, du.email, du.phone, du.amount, du.address, du.district, du.amphure, du.province, du.zip_code, du.gift, du.cc_email, du.project_number, du.project_name, du.created_at, du.payby,du.status_donat, jd.payerAccountName, jd.billPaymentRef2
             FROM donat_user du
             JOIN json_donat jd ON du.billPaymentRef1 = jd.billPaymentRef1
             WHERE du.billPaymentRef1 = :billPaymentRef1";
            $copy_stmt = $pdo->prepare($copy_sql);
            $copy_stmt->bindParam(':billPaymentRef1', $billPaymentRef1);

            if ($copy_stmt->execute()) {
                if ($copy_stmt->rowCount() > 0) {
                    // ดึงข้อมูลจากตาราง donat
                    $last_insert_id = $pdo->lastInsertId();
                    $select_sql = "SELECT billPaymentRef1, payerAccountName, amount, email, project_name, id, created_at 
                                   FROM donat 
                                   WHERE id = :id";
                    $select_stmt = $pdo->prepare($select_sql);
                    $select_stmt->bindParam(':id', $last_insert_id);
                    $select_stmt->execute();

                    $donat_data = $select_stmt->fetch(PDO::FETCH_ASSOC);

                    // ส่ง email ด้วยข้อมูลที่ดึงมา
                    $mail = new PHPMailer(true); // เริ่มต้น PHPMailer
                    try {
                        // ตั้งค่าการตั้งค่าเซิร์ฟเวอร์
                        $mail->CharSet = "UTF-8";
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // กำหนดเซิร์ฟเวอร์ SMTP
                        $mail->SMTPAuth = true;
                        $mail->Username = 'nursecmu.edonation@gmail.com'; // อีเมลที่ใช้ส่ง
                        $mail->Password = 'hhhp ynrg cqpb utzi'; // รหัสผ่านอีเมล
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587; // พอร์ตสำหรับการเชื่อมต่อ

                        // ตั้งค่าผู้ส่งและผู้รับ
                        $mail->setFrom('nursecmu.edonation@gmail.com', 'noreply@NurseCMU E-Donation');
                        $mail->addAddress($donat_data['email']); // เพิ่มอีเมลผู้รับ

                        // เนื้อหาอีเมล
                        $mail->isHTML(true); // กำหนดให้ใช้ HTML

                        $mail->Subject = 'Thank You for Your Donation'; // กำหนดหัวข้อของอีเมล

                        // แปลงวันที่ให้เป็นภาษาไทย
                        $created_at = $donat_data['created_at'] ?? null;
                        if ($created_at) {
                            // สร้าง DateTime object
                            $dateTime = new DateTime($created_at);
                            $dateTime->setTimezone(new DateTimeZone('Asia/Bangkok')); // ตั้งโซนเวลา
                            $formatter = new IntlDateFormatter('th_TH', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                            $thai_date = $formatter->format($dateTime);
                        } else {
                            $thai_date = 'ไม่ทราบวันที่';
                        }

                        // สร้างอีเมล
                        $mail->Body = '
                                        <!DOCTYPE html>
                                        <html lang="th">
                                        <head>
                                            <meta charset="UTF-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <link rel="preconnect" href="https://fonts.googleapis.com">
                                            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
                                            <style>
                                                body {
                                                    font-family: "Noto Sans Thai", sans-serif;
                                                    background-color: #ffffff;
                                                    margin: 0;
                                                    padding: 20px;
                                                }

                                                .container {
                                                    max-width: 600px;
                                                    margin: 0 auto;
                                                    background-color: #f4f4f4;
                                                    border-radius: 5px;
                                                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                                    padding: 20px;
                                                }

                                                .header {
                                                    background-color: #ff6a00;
                                                    padding: 20px;
                                                    text-align: left;
                                                    border-top-left-radius: 5px;
                                                    border-top-right-radius: 5px;
                                                }

                                                .header img {
                                                    width: 200px;
                                                    margin-bottom: 20px;
                                                }

                                                h1 {
                                                    color: #003049;
                                                    font-size: 24px;
                                                }

                                                p {
                                                    font-size: 16px;
                                                    line-height: 1.6;
                                                    color: #333;
                                                }

                                                .footer {
                                                    text-align: center;
                                                    margin-top: 20px;
                                                    font-size: 12px;
                                                    color: #777;
                                                }

                                                .btn {
                                                    display: inline-block;
                                                    padding: 10px 15px;
                                                    background-color: #ff6a00;
                                                    color: white;
                                                    text-decoration: none;
                                                    border-radius: 5px;
                                                    text-align: center;
                                                    font-weight: bold;
                                                    transition: background-color 0.3s;
                                                    margin: 20px 0;
                                                }

                                                .btn:hover {
                                                    background-color: #f8c49c;
                                                }
                                            </style>
                                        </head>

                                        <body>
                                            <div class="container">
                                                <div class="header">
                                                    <img src="https://app.nurse.cmu.ac.th/appdev/Edonation/assets/images/logo/logo-nurse-w.png" alt="Logo">
                                                </div>
                                                <h1>ข้อความอัตโนมัติ : ยืนยันการชำระเงิน ผ่าน NurseCMU e-Donation</h1>
                                                <p>โครงการ : <span>' . htmlspecialchars($donat_data['project_name']) . '</span></p>
                                                <p>เลขอ้างอิง : <span>' . htmlspecialchars($donat_data['billPaymentRef1']) . '</span></p>
                                                <p>จำนวนเงิน : <span>' . number_format($donat_data['amount'], 2) . ' บาท</span></p>
                                                <p>จาก : <span>' . htmlspecialchars($donat_data['payerAccountName']) . '</span></p>
                                                <p>วันที่ : <span>' . $thai_date . '</span></p>
                                                <a href="https://example.com/donation-details" class="btn">ใบเสร็จรับเงิน</a>
                                                <p>ขอแสดงความนับถือ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</p>
                                                <p>หมายเหตุ :<br>
                                                    - ใบเสร็จรับเงินจะมีผลสมบูรณ์ต่อเมื่อได้รับชำระเงินเรียบร้อยแล้วและมีลายเซ็นของผู้รับเงินครบถ้วน<br>
                                                    - อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ หากต้องการสอบถามรายละเอียดเพิ่มเติม โทร.
                                                    053-949075 | นางสาวชนิดา ต้นพิพัฒน์ งานการเงิน การคลังและพัสดุ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</p>
                                                <br>
                                                <div class="footer">
                                                    <p>NurseCMU e-Donation | Communications and Branding Department</p>
                                                    <p>&copy; 2024 Faculty of Nursing Chiang Mai University, All Rights Reserved.</p>
                                                </div>
                                            </div>
                                        </body>
                                        </html>';
                        $mail->send();
                        echo json_encode(['success' => true, 'message' => 'ส่งอีเมลเรียบร้อยแล้ว']);
                    } catch (Exception $e) {
                        echo json_encode(['success' => false, 'message' => 'ส่งอีเมลไม่สำเร็จ: ' . $mail->ErrorInfo]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'การคัดลอกข้อมูลไม่สำเร็จ']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลการบริจาค']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ถูกต้อง']);
}
