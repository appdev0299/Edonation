<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// สร้างอ็อบเจกต์ PHPMailer
$mail = new PHPMailer;
$mail->CharSet = "UTF-8";
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;

// ตั้งค่าข้อมูลบัญชี Gmail
$gmail_username = "nursecmu.edonation@gmail.com";
$gmail_password = "hhhp ynrg cqpb utzi"; // **ใช้วิธีที่ปลอดภัยในการจัดเก็บรหัสผ่าน**

$sender = "noreply@NurseCMU E-Donation";
$email_sender = "nursecmu.edonation@gmail.com";
$email_receiver = isset($email_data['email']) ? filter_var($email_data['email'], FILTER_SANITIZE_EMAIL) : '';

if (!empty($email_receiver)) {
    $subject = "ระบบการแจ้งเตือน การบริจาคเงิน อัตโนมัติ";

    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;
    $mail->setFrom($email_sender, $sender);
    $mail->addAddress($email_receiver); // เพิ่มอีเมลผู้รับ
    $mail->Subject = $subject;

    // เนื้อหาของอีเมล
    $email_content = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
        <h1 style='background: #fb974e; padding: 10px 0 10px 10px; margin-bottom: 10px; font-size: 20px; color: white;'>
            NurseCMUE-Donation
        </h1>
        <div style='padding: 20px;'>
            <h3>ข้อความอัตโนมัติ: ยืนยันการชำระเงิน ผ่าน NurseCMUE-Donation</h3>
            <h4>รายละเอียด</h4>
            <p>หมายเลขการชำระเงิน: {$email_data['billPaymentRef1']}</p>
            <p>ชื่อผู้จ่าย: {$email_data['payerAccountName']}</p>
            <p>จำนวนเงิน: {$email_data['amount']} บาท</p>
            <p>วันที่: {$email_data['rec_date_out']}</p>
        </div>
        <hr>
        <p>หมายเหตุ: ใบเสร็จรับเงินจะมีผลสมบูรณ์เมื่อได้รับชำระเงินเรียบร้อยแล้ว</p>
        <p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ</p>
    </body>
    </html>
    ";

    $mail->msgHTML($email_content);

    // ส่งอีเมล
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
} else {
    echo 'Error: Invalid email address.';
}
