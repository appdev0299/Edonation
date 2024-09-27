<?php
require_once '../config/connect.php';
require '../vendor/autoload.php'; // อย่าลืมรวม autoload ของ Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['billPaymentRef1'], $data['amount'], $data['created_at'], $data['id'])) {
    $billPaymentRef1 = filter_var($data['billPaymentRef1'], FILTER_SANITIZE_STRING);
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
            $copy_sql = "INSERT INTO donat (billPaymentRef1, type, email, phone, amount, address, subdistrict, district, province, gift, cc_email, project_number, project_name, created_at, payerAccountName, billPaymentRef2) 
                         SELECT du.billPaymentRef1, du.type, du.email, du.phone, du.amount, du.address, du.subdistrict, du.district, du.province, du.gift, du.cc_email, du.project_number, du.project_name, du.created_at, jd.payerAccountName, jd.billPaymentRef2 
                         FROM donat_user du
                         JOIN json_donat jd ON du.billPaymentRef1 = jd.billPaymentRef1
                         WHERE du.billPaymentRef1 = :billPaymentRef1";
            $copy_stmt = $pdo->prepare($copy_sql);
            $copy_stmt->bindParam(':billPaymentRef1', $billPaymentRef1);

            if ($copy_stmt->execute()) {
                if ($copy_stmt->rowCount() > 0) {
                    // ดึงข้อมูลจากตาราง donat
                    $last_insert_id = $pdo->lastInsertId(); // รับ ID ล่าสุดที่ถูกแทรก
                    $select_sql = "SELECT billPaymentRef1, payerAccountName, amount, email, project_name 
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
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // กำหนดเซิร์ฟเวอร์ SMTP
                        $mail->SMTPAuth = true;
                        $mail->Username = 'nursecmu.edonation@gmail.com'; // อีเมลที่ใช้ส่ง
                        $mail->Password = 'hhhp ynrg cqpb utzi'; // รหัสผ่านอีเมล
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ใช้การเข้ารหัส TLS
                        $mail->Port = 587; // พอร์ตสำหรับการเชื่อมต่อ

                        // ตั้งค่าผู้ส่งและผู้รับ
                        $mail->setFrom('nursecmu.edonation@gmail.com', 'noreply@NurseCMU E-Donation');
                        $mail->addAddress($donat_data['email']); // เพิ่มอีเมลผู้รับ

                        // เนื้อหาอีเมล
                        $mail->isHTML(true); // กำหนดให้ใช้ HTML

                        $mail->Subject = 'Thank You for Your Donation'; // กำหนดหัวข้อของอีเมล

                        $mail->Body = '
                                        <!DOCTYPE html>
                                        <html lang="th">
                                        <head>
                                            <meta charset="UTF-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <style>
                                                body {
                                                    font-family: Arial, sans-serif;
                                                    background-color: #f4f4f4;
                                                    margin: 0;
                                                    padding: 20px;
                                                }
                                                .container {
                                                    max-width: 600px;
                                                    margin: 0 auto;
                                                    background-color: #ffffff;
                                                    border-radius: 5px;
                                                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                                    padding: 20px;
                                                }
                                                h1 {
                                                    color: #003049;
                                                    text-align: center;
                                                }
                                                p {
                                                    font-size: 16px;
                                                    line-height: 1.6;
                                                }
                                                .highlight {
                                                    background-color: #ffcc00;
                                                    padding: 5px;
                                                    border-radius: 3px;
                                                    font-weight: bold;
                                                }
                                                .footer {
                                                    text-align: center;
                                                    margin-top: 20px;
                                                    font-size: 12px;
                                                    color: #777;
                                                }
                                            </style>
                                        </head>
                                        <body>
                                            <div class="container">
                                                <h1>ขอบคุณสำหรับการบริจาคของคุณ!</h1>
                                                <p>รายละเอียดการบริจาคของคุณ:</p>
                                                <p>Bill Payment Reference: <span class="highlight">' . $donat_data['billPaymentRef1'] . '</span></p>
                                                <p>Amount: <span class="highlight">' . number_format($donat_data['amount'], 2) . ' บาท</span></p>
                                                <p>Payer Account Name: <span class="highlight">' . $donat_data['payerAccountName'] . '</span></p>
                                                <p>Project Name: <span class="highlight">' . $donat_data['project_name'] . '</span></p>
                                                <div class="footer">
                                                    <p>ขอขอบคุณสำหรับการสนับสนุนของคุณ!</p>
                                                </div>
                                            </div>
                                        </body>
                                        </html>
                                        ';
                        $mail->send(); // ส่งอีเมล

                        $response = [
                            'message' => 'success',
                            'details' => 'Data copied from donat_user to donat successfully and email sent',
                            'email_data' => $donat_data // ส่งข้อมูลไปยัง email
                        ];
                    } catch (Exception $e) {
                        $response = [
                            'message' => 'email_failed',
                            'details' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo
                        ];
                    }
                } else {
                    $response = [
                        'message' => 'no_rows_copied',
                        'details' => 'No rows were copied to donat'
                    ];
                }
            } else {
                $response = [
                    'message' => 'insert_failed',
                    'details' => 'Failed to copy data from donat_user to donat'
                ];
            }
        } else {
            $response = [
                'message' => 'not_found',
                'details' => 'No data found for billPaymentRef1: ' . $billPaymentRef1 . ', amount: ' . $amount . ', date: ' . $created_at
            ];
        }
    } catch (PDOException $e) {
        $response = [
            'message' => 'db_error',
            'details' => $e->getMessage()
        ];
    }
} else {
    $response = [
        'message' => 'invalid_data'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
