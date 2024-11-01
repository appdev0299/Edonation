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
                                <form class="contact-panel__form" method="post" id="contactForm">
                                    <div class="row">
                                        <?php
                                        // ตรวจสอบว่ามีการส่ง project_number มาหรือไม่
                                        if (isset($_GET['project_number'])) {
                                            $project_number = $_GET['project_number'];

                                            // เชื่อมต่อฐานข้อมูล
                                            require_once '../config/connect.php';

                                            // เตรียม statement เพื่อดึงข้อมูล project_name และ project_tex (หรือ project_description)
                                            $stmt = $pdo->prepare("SELECT project_name, project_tex FROM project WHERE project_number = :project_number");
                                            $stmt->bindParam(':project_number', $project_number, PDO::PARAM_STR);
                                            $stmt->execute();

                                            // ดึงผลลัพธ์ออกมา
                                            $project = $stmt->fetch();

                                            // ตรวจสอบว่าพบข้อมูลหรือไม่
                                            if ($project) {
                                                $project_name = $project['project_name'];
                                                $project_tex = $project['project_tex']; // ดึง project_tex ด้วย
                                            } else {
                                                $project_name = "Project not found.";
                                                $project_tex = "";
                                            }
                                        } else {
                                            $project_name = "No project number provided.";
                                            $project_tex = "";
                                        }
                                        ?>
                                        <div class="col-sm-12">
                                            <h4 class="contact-panel__title"><?= htmlspecialchars($project_name); ?></h4>
                                            <p class="contact-panel__desc mb-30"><?= htmlspecialchars($project_tex); ?></p>
                                        </div>
                                        <input type="hidden" name="project_number" value="<?= htmlspecialchars($project_number); ?>">
                                        <input type="hidden" name="project_name" value="<?= htmlspecialchars($project_name); ?>">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-widget form-group-icon"></i>
                                                <select class="form-control" name="type" id="type">
                                                    <option value="">เลือกประเภท</option>
                                                    <option value="ศิษย์เก่า">ศิษย์เก่า</option>
                                                    <option value="บุคลากร">บุคลากร</option>
                                                    <option value="อื่น ๆ">อื่น ๆ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-email form-group-icon"></i>
                                                <input type="email" class="form-control" placeholder="อีเมล" id="email" name="email">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-phone form-group-icon"></i>
                                                <input type="tel" class="form-control" placeholder="โทรศัพท์" id="phone" name="phone" pattern="[0-9]{10}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="fas fa-coins form-group-icon"></i>
                                                <input type="number" class="form-control" placeholder="จำนวนเงิน" id="amount" name="amount" step="0.01">
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-md-12 col-lg-12" id="address-section" style="display: none;">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-location form-group-icon"></i>
                                                        <input type="text" class="form-control" placeholder="เลขที่" id="address" name="address">
                                                    </div>
                                                </div>
                                                <?php
                                                // Fetch provinces using PDO
                                                try {
                                                    $sql = "SELECT * FROM provinces";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute();
                                                    $provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                } catch (PDOException $e) {
                                                    echo "
                                                            <script>
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'เกิดข้อผิดพลาดในการดึงข้อมูลจังหวัด',
                                                                    text: '" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "',
                                                                    confirmButtonColor: '#ffaa00'
                                                                });
                                                            </script>
                                                        ";
                                                    exit(); // หยุดการทำงานหากดึงข้อมูลไม่ได้
                                                }
                                                ?>
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-location form-group-icon"></i>
                                                        <select class="form-control" name="province" id="province">
                                                            <option value="">เลือกจังหวัด</option>
                                                            <?php foreach ($provinces as $result): ?>
                                                                <option value="<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($result['name_th'], ENT_QUOTES, 'UTF-8') ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-location form-group-icon"></i>
                                                        <select class="form-control" name="amphure" id="amphure">
                                                            <option value="">เลือกอำเภอ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-location form-group-icon"></i>
                                                        <select class="form-control" name="district" id="district">
                                                            <option value="">เลือกตำบล</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <i class="icon-location form-group-icon"></i>
                                                        <input type="number" class="form-control" placeholder="รหัสไปรษณีย์" id="zip_code" name="zip_code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <input type="checkbox" id="gift" name="gift" disabled style="appearance: none; -webkit-appearance: none; width: 20px; height: 20px; border: 2px solid #ffaa00; border-radius: 50%; position: relative; cursor: pointer;">
                                                <label for="gift">รับของที่ระลึก</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <div class="form-group" style="margin-top: 5px;">
                                                <input type="checkbox" id="cc_email" name="cc_email" checked required style="appearance: none; -webkit-appearance: none; width: 20px; height: 20px; border: 2px solid #ffaa00; border-radius: 50%; position: relative; cursor: pointer;">
                                                <label for="cc_email">ยินดีรับข้อมูลข่าวสารของคณะพยาบาลฯ ผ่านทางอีเมล</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <button type="submit" class="btn btn__primary btn__rounded btn__block btn__xhight mt-10">
                                                <span>ถัดไป</span> <i class="icon-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                include_once('donat_db.php');
                                ?>
                                <script>
                                    // เมื่อค่าเงินถูกป้อนให้ตรวจสอบว่าควรเปิดหรือปิด address-section
                                    document.getElementById('amount').addEventListener('input', function() {
                                        var amount = parseFloat(this.value);
                                        var giftCheckbox = document.getElementById('gift');
                                        var addressSection = document.getElementById('address-section');

                                        if (amount > 1000) {
                                            giftCheckbox.disabled = false;
                                            giftCheckbox.checked = true; // ตั้งค่าให้ถูก check ทันที
                                        } else {
                                            giftCheckbox.disabled = true;
                                            giftCheckbox.checked = false; // ยกเลิกการเลือกเมื่อจำนวนเงินต่ำกว่า 1000
                                        }

                                        // ตรวจสอบสถานะของ giftCheckbox เพื่อแสดงหรือซ่อน address-section
                                        if (giftCheckbox.checked) {
                                            addressSection.style.display = 'block'; // แสดงฟอร์ม
                                        } else {
                                            addressSection.style.display = 'none'; // ซ่อนฟอร์ม
                                        }
                                    });

                                    // เมื่อ giftCheckbox เปลี่ยนสถานะให้แสดงหรือซ่อน address-section
                                    document.getElementById('gift').addEventListener('change', function() {
                                        var addressSection = document.getElementById('address-section');
                                        if (this.checked) {
                                            addressSection.style.display = 'block'; // แสดงฟอร์ม
                                        } else {
                                            addressSection.style.display = 'none'; // ซ่อนฟอร์ม
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="about-layout5">

        </section>
        <?php
        include_once('../config/footer.php');
        ?>
        <div class="search-popup">
            <button type="button" class="search-popup__close"><i class="fas fa-times"></i></button>
            <form class="search-popup__form">
                <input type="text" class="search-popup__form__input" placeholder="Type Words Then Enter">
                <button class="search-popup__btn"><i class="icon-search"></i></button>
            </form>
        </div><!-- /. search-popup -->
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script_province.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var type = document.getElementById('type').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var amount = document.getElementById('amount').value;
            var giftChecked = document.getElementById('gift').checked;
            var address = document.getElementById('address').value;
            var district = document.getElementById('district').value;
            var amphure = document.getElementById('amphure').value;
            var province = document.getElementById('province').value;

            if (!type || !email || !phone || !amount) {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    text: 'กรุณากรอกข้อมูลที่จำเป็นทั้งหมดให้ครบ',
                    confirmButtonText: 'ตกลง'
                });
                event.preventDefault();
                return;
            }

            if (giftChecked) {
                if (!address || !district || !amphure || !province) {
                    Swal.fire({
                        icon: 'error',
                        title: 'กรุณากรอกข้อมูลที่อยู่ให้ครบถ้วน',
                        text: 'กรุณากรอกข้อมูลที่อยู่ทั้งหมดให้ครบ',
                        confirmButtonText: 'ตกลง'
                    });
                    event.preventDefault();
                    return;
                }
            }
        });
    </script>


</body>

</html>