<!DOCTYPE html>
<html lang="en">

<?php
include_once('../config/head.php');
?>

<body>
    <div class="wrapper">
        <div class="preloader">
            <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div><!-- /.preloader -->

        <?php
        include_once('../config/header.php');
        ?>


        <section class="team-layout1 pb-80">
        </section>

        <section class="testimonials-layout1 pt-130 pb-80">
            <div class="container">
                <div class="testimonials-wrapper">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="contact-panel mb-50">
                                <div class="center">
                                    <?php
                                    require_once 'lib-crc16.inc.php';
                                    require_once '../config/connect.php';
                                    require_once 'phpqrcode/qrlib.php'; // รวมการใช้ QR code library

                                    // ตรวจสอบ ID ที่ถูกส่งผ่าน URL
                                    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                    if ($id <= 0) {
                                        echo "Invalid ID.";
                                        exit;
                                    }

                                    // ตรวจสอบการเชื่อมต่อ PDO
                                    if (!$pdo) {
                                        die("Connection failed: Unable to connect to the database.");
                                    }

                                    try {
                                        // ดึงข้อมูลจากฐานข้อมูล
                                        $sql = "SELECT amount, created_at, project_number, project_name, id, billPaymentRef1 FROM donat_user WHERE id = :id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                        $stmt->execute();

                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                        if ($row) {
                                            $amount = $row["amount"];
                                            $created_at = $row["created_at"];
                                            $project_number = $row["project_number"];
                                            $project_name = $row["project_name"];
                                            $id = $row["id"];
                                            $billPaymentRef1 = $row["billPaymentRef1"];

                                            // คำนวณปี พ.ศ.
                                            $created_at_year = (int)date('Y', strtotime($created_at)) + 543;
                                            $lastTwoDigits = substr($created_at_year, -2);

                                            // การจัดรูปแบบจำนวนเงินและ QR Code
                                            $amountFormatted = number_format($amount, 2, '.', '');
                                            $amountWithPadding = str_pad($amountFormatted, 10, '0', STR_PAD_LEFT);

                                            $qrcode00 = '000201';
                                            $qrcode01 = '010212';
                                            $qrcode3000 = '30630016A000000677010112';
                                            $qrcode3001 = '0115099400258783792';
                                            $qrcode3002 = '0215' . $lastTwoDigits . $project_number . str_pad($id, 7, '0', STR_PAD_LEFT);
                                            $qrcode3003 = '03010';
                                            $qrcode30 = $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003;

                                            $qrcode53 = '5303764';
                                            $qrcode54 = '5410' . $amountWithPadding;
                                            $qrcode58 = '5802TH';
                                            $qrcode62 = '62100706SCB001';
                                            $qrcode63 = '6304';
                                            $qrcode = $qrcode00 . $qrcode01 . $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003 . $qrcode53 . $qrcode54 . $qrcode58 . $qrcode62 . $qrcode63;

                                            // คำนวณ CRC16 checksum
                                            $checkSum = CRC16HexDigest($qrcode);
                                            $qrcodeFull = $qrcode . $checkSum;

                                            // สร้างไฟล์ QR Code โดยใช้ phpqrcode
                                            $tempDir = "qrcodepayment/";
                                            if (!file_exists($tempDir)) {
                                                mkdir($tempDir, 0755, true);
                                            }

                                            $fileName = 'qrcode_' . md5($qrcodeFull) . '.png';
                                            $pngAbsoluteFilePath = $tempDir . $fileName;

                                            // กำหนดขนาด QR Code
                                            $qrCodeSize = 5; // ขนาด QR Code เป็น 1x1 หน่วย
                                            $qrCodeECLevel = QR_ECLEVEL_Q; // ระดับการแก้ไขข้อผิดพลาด

                                            // สร้าง QR Code หากยังไม่มีไฟล์นี้
                                            if (!file_exists($pngAbsoluteFilePath)) {
                                                QRcode::png($qrcodeFull, $pngAbsoluteFilePath, $qrCodeECLevel, $qrCodeSize);
                                            }

                                            // เพิ่มภาพพื้นหลังให้กับ QR Code
                                            $backgroundImagePath = '../assets/images/e-Donation.png';
                                            $backgroundImage = imagecreatefrompng($backgroundImagePath);
                                            $qrImage = imagecreatefrompng($pngAbsoluteFilePath);

                                            // รวมภาพ QR Code กับภาพพื้นหลัง
                                            $bgWidth = imagesx($backgroundImage);
                                            $bgHeight = imagesy($backgroundImage);
                                            $qrWidth = imagesx($qrImage);
                                            $qrHeight = imagesy($qrImage);

                                            // ปรับขนาด QR Code ให้พอดีกับภาพพื้นหลัง
                                            $newQRWidth = min($bgWidth, $qrWidth); // ใช้ขนาดที่เล็กที่สุด
                                            $newQRHeight = min($bgHeight, $qrHeight); // ใช้ขนาดที่เล็กที่สุด

                                            $resizedQRImage = imagecreatetruecolor($newQRWidth, $newQRHeight);
                                            imagealphablending($resizedQRImage, false);
                                            imagesavealpha($resizedQRImage, true);
                                            $transparent = imagecolorallocatealpha($resizedQRImage, 0, 0, 0, 127);
                                            imagefill($resizedQRImage, 0, 0, $transparent);
                                            imagecopyresampled($resizedQRImage, $qrImage, 0, 0, 0, 0, $newQRWidth, $newQRHeight, $qrWidth, $qrHeight);

                                            // รวม QR Code กับภาพพื้นหลัง
                                            imagecopy($backgroundImage, $resizedQRImage, ($bgWidth - $newQRWidth) / 2, ($bgHeight - $newQRHeight) / 2, 0, 0, $newQRWidth, $newQRHeight);

                                            // กำหนดสีและฟอนต์สำหรับการวาดข้อความ
                                            $textColor = imagecolorallocate($backgroundImage, 255, 0, 0); // สีแดง
                                            $fontFile = 'font/NotoSansThai-Regular.ttf'; // เส้นทางของฟอนต์ TrueType

                                            // ข้อความที่ต้องการวาด
                                            $months = array(
                                                "01" => "มกราคม",
                                                "02" => "กุมภาพันธ์",
                                                "03" => "มีนาคม",
                                                "04" => "เมษายน",
                                                "05" => "พฤษภาคม",
                                                "06" => "มิถุนายน",
                                                "07" => "กรกฎาคม",
                                                "08" => "สิงหาคม",
                                                "09" => "กันยายน",
                                                "10" => "ตุลาคม",
                                                "11" => "พฤศจิกายน",
                                                "12" => "ธันวาคม"
                                            );
                                            $created_at_timestamp = strtotime($created_at);
                                            $created_at_plus_10_minutes = strtotime('+10 minutes', $created_at_timestamp); // บวกเวลา 10 นาที

                                            $day = date('d', $created_at_plus_10_minutes);
                                            $month = $months[date('m', $created_at_plus_10_minutes)];
                                            $year = date('Y', $created_at_plus_10_minutes) + 543; // เปลี่ยน ค.ศ. เป็น พ.ศ.
                                            $time = date('H:i', $created_at_plus_10_minutes); // เวลาในรูปแบบ ชั่วโมง:นาที

                                            $text1 = "โครงการ : " . $project_name;
                                            $text2 = "จำนวนเงินชำระ : " . $amountFormatted . " บาท";
                                            $text3 = "ชำระก่อน : วันที่ $day $month พ.ศ. $year เวลา $time น.";
                                            $text4 = "หมายเลขอ้างอิก : $billPaymentRef1";


                                            // วาดข้อความลงบนภาพ
                                            imagettftext($backgroundImage, 10, 0, 20, $bgHeight - 80, $textColor, $fontFile, $text1);
                                            imagettftext($backgroundImage, 10, 0, 20, $bgHeight - 60, $textColor, $fontFile, $text2);
                                            imagettftext($backgroundImage, 10, 0, 20, $bgHeight - 40, $textColor, $fontFile, $text3);
                                            imagettftext($backgroundImage, 10, 0, 20, $bgHeight - 20, $textColor, $fontFile, $text4);


                                            // บันทึกภาพรวม
                                            imagepng($backgroundImage, $pngAbsoluteFilePath);
                                            imagedestroy($backgroundImage);
                                            imagedestroy($qrImage);
                                            imagedestroy($resizedQRImage);

                                            // แสดง QR Code ในหน้าเว็บ
                                            echo "<div style='text-align: center;'><img src='" . $pngAbsoluteFilePath . "' alt='QR Code' /></div>";
                                        } else {
                                            echo "No data found.";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-layout5">

        </section>

        <footer class="footer">
            <div class="footer-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="footer-widget-about">
                                <img src="../assets/images/logo/logo-light.png" alt="logo" class="mb-30">
                                <p class="color-gray">Our goal is to deliver quality of care in a courteous, respectful, and
                                    compassionate manner. We hope you will allow us to care for you and strive to be the first and best
                                    choice for your family healthcare.
                                </p>
                                <a href="appointment.html" class="btn btn__primary btn__primary-style2 btn__link">
                                    <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                                </a>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-xl-2 -->
                        <div class="col-sm-6 col-md-6 col-lg-2 offset-lg-1">
                            <div class="footer-widget-nav">
                                <h6 class="footer-widget__title">Departments</h6>
                                <nav>
                                    <ul class="list-unstyled">
                                        <li><a href="#">Neurology Clinic</a></li>
                                        <li><a href="#">Cardiology Clinic</a></li>
                                        <li><a href="#">Pathology Clinic</a></li>
                                        <li><a href="#">Laboratory Analysis</a></li>
                                        <li><a href="#">Pediatric Clinic</a></li>
                                        <li><a href="#">Cardiac Clinic</a></li>
                                    </ul>
                                </nav>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-sm-6 col-md-6 col-lg-2">
                            <div class="footer-widget-nav">
                                <h6 class="footer-widget__title">Links</h6>
                                <nav>
                                    <ul class="list-unstyled">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Our CLinic</a></li>
                                        <li><a href="#">Our Doctors</a></li>
                                        <li><a href="#">News & Media</a></li>
                                        <li><a href="#">Appointments</a></li>
                                    </ul>
                                </nav>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="footer-widget-contact">
                                <h6 class="footer-widget__title color-heading">Quick Contacts</h6>
                                <ul class="contact-list list-unstyled">
                                    <li>If you have any questions or need help, feel free to contact with our team.</li>
                                    <li>
                                        <a href="tel:01061245741" class="phone__number">
                                            <i class="icon-phone"></i> <span>01061245741</span>
                                        </a>
                                    </li>
                                    <li class="color-body">2307 Beverley Rd Brooklyn, New York 11226 United States.</li>
                                </ul>
                                <div class="d-flex align-items-center">
                                    <a href="contact-us.html" class="btn btn__primary btn__link mr-30">
                                        <i class="icon-arrow-right"></i> <span>Get Directions</span>
                                    </a>
                                    <ul class="social-icons list-unstyled mb-0">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </ul><!-- /.social-icons -->
                                </div>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-primary -->
            <div class="footer-secondary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <span class="fz-14">&copy; 2020 DataSoft, All Rights Reserved. With Love by</span>
                            <a class="fz-14 color-primary" href="http://themeforest.net/user/7oroof">7oroof.com</a>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <nav>
                                <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end mb-0">
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cookies</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="search-popup">
            <button type="button" class="search-popup__close"><i class="fas fa-times"></i></button>
            <form class="search-popup__form">
                <input type="text" class="search-popup__form__input" placeholder="Type Words Then Enter">
                <button class="search-popup__btn"><i class="icon-search"></i></button>
            </form>
        </div>
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        var loopCount = 0;
        var maxLoops = 100;

        function fetchData() {
            var id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
            var amount = "<?php echo isset($_GET['amount']) ? $_GET['amount'] : ''; ?>";
            var created_at = "<?php echo isset($_GET['created_at']) ? $_GET['created_at'] : ''; ?>";
            var billPaymentRef1 = "<?php echo isset($_GET['billPaymentRef1']) ? $_GET['billPaymentRef1'] : ''; ?>";

            if (amount !== '' && created_at !== '' && billPaymentRef1 !== '' && id !== '') {
                var data = {
                    id: id,
                    amount: amount,
                    created_at: created_at,
                    billPaymentRef1: billPaymentRef1
                };
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "data_check.php", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
                        if (response.message === 'success') {
                            Swal.fire({
                                title: "ชำระเงินการบริจาคเสร็จสิ้น",
                                text: "ขอบคุณสำหรับการบริจาค",
                                icon: "success",
                                timer: 6000,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                window.location.href = "../home/";
                            }, 5000);

                            clearInterval(intervalId);
                        }
                    }
                };
                xhr.send(JSON.stringify(data));
            } else {
                console.log('ไม่ได้รับข้อมูลที่เพียงพอ');
            }

            loopCount++;
            if (loopCount >= maxLoops) {
                clearInterval(intervalId); 
            }
        }

        var intervalId = setInterval(fetchData, 5000);
    </script>
</body>

</html>