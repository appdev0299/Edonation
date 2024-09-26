<?php
require_once '../config/connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['billPaymentRef1'], $data['amount'], $data['created_at'], $data['id'])) {
    $billPaymentRef1 = filter_var($data['billPaymentRef1'], FILTER_SANITIZE_STRING);
    $amount = filter_var($data['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $created_at = date('Y-m-d', strtotime($data['created_at']));

    try {
        // ตรวจสอบข้อมูลในตาราง json_donat
        $sql = "SELECT * FROM json_donat WHERE billPaymentbillPaymentRef1 = :billPaymentRef1 AND amount = :amount AND DATE(date) = :created_at";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':billPaymentRef1', $billPaymentRef1);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // คัดลอกข้อมูลจาก donat_user ไปยัง donat พร้อม payerAccountName และ billPaymentRef2
            $copy_sql = "INSERT INTO donat (billPaymentRef1, type, email, phone, amount, address, subdistrict, district, province, gift, cc_email, project_number, project_name, created_at, payerAccountName, billPaymentRef2) 
                         SELECT du.billPaymentRef1, du.type, du.email, du.phone, du.amount, du.address, du.subdistrict, du.district, du.province, du.gift, du.cc_email, du.project_number, du.project_name, du.created_at, jd.payerAccountName, jd.billPaymentRef2 
                         FROM donat_user du
                         JOIN json_donat jd ON du.billPaymentRef1 = jd.billPaymentbillPaymentRef1
                         WHERE du.billPaymentRef1 = :billPaymentRef1";
            $copy_stmt = $pdo->prepare($copy_sql);
            $copy_stmt->bindParam(':billPaymentRef1', $billPaymentRef1);

            if ($copy_stmt->execute()) {
                if ($copy_stmt->rowCount() > 0) {
                    $response = [
                        'message' => 'success',
                        'details' => 'Data copied from donat_user to donat successfully'
                    ];
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
