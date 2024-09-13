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
                                <form class="contact-panel__form" method="post" action="../assets/php/contact.php" id="contactForm">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="contact-panel__title">Book An Appointment</h4>
                                            <p class="contact-panel__desc mb-30">Please feel welcome to contact our friendly reception staff
                                                with any general or medical enquiry. Our doctors will receive or return any urgent calls.
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-widget form-group-icon"></i>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="ศิษย์เก่า">ศิษย์เก่า</option>
                                                    <option value="บุคลากร">บุคลากร</option>
                                                    <option value="อื่น ๆ">อื่น ๆ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-email form-group-icon"></i>
                                                <input type="email" class="form-control" placeholder="อีเมล" id="email" name="email" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="icon-phone form-group-icon"></i>
                                                <input type="number" class="form-control" placeholder="โทรศัพท์" id="phone" name="phone" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <i class="fas fa-coins form-group-icon"></i>
                                                <input type="number" class="form-control" placeholder="จำนวนเงิน" id="amount" name="amount" required>
                                            </div>
                                        </div>

                                        <div id="address-section" style="display: none;">
                                            <div class="col-sm-6 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <i class="icon-location form-group-icon"></i>
                                                    <input type="text" class="form-control" placeholder="เลขที่" id="address" name="address" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <i class="icon-location form-group-icon"></i>
                                                    <input type="text" class="form-control" placeholder="ตำบล" id="subdistrict" name="subdistrict" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <i class="icon-location form-group-icon"></i>
                                                    <input type="text" class="form-control" placeholder="อำเภอ" id="district" name="district" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <i class="icon-location form-group-icon"></i>
                                                    <input type="text" class="form-control" placeholder="จังหวัด" id="province" name="province" required>
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
                                                <input type="checkbox" id="terms" name="terms" checked style="appearance: none; -webkit-appearance: none; width: 20px; height: 20px; border: 2px solid #ffaa00; border-radius: 50%; position: relative; cursor: pointer;">
                                                <label for="terms">ยินดีรับข้อมูลข่าวสารของคณะพยาบาลฯ ผ่านทางอีเมล</label>
                                            </div>
                                        </div>


                                        <style>
                                            input[type="checkbox"]:checked {
                                                background-color: #ffaa00;
                                                border-color: #ffaa00;
                                            }

                                            input[type="checkbox"]:checked::after {
                                                content: '✔';
                                                color: white;
                                                font-size: 14px;
                                                position: absolute;
                                                top: -2px;
                                                left: 4px;
                                            }
                                        </style>

                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <button type="submit" class="btn btn__primary btn__rounded btn__block btn__xhight mt-10">
                                                <span>ถัดไป</span> <i class="icon-arrow-right"></i>
                                            </button>
                                            <div class="contact-result"></div>
                                        </div>
                                    </div>
                                </form>
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
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-secondary -->
        </footer><!-- /.Footer -->
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
</body>

</html>