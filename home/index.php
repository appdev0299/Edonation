<!DOCTYPE html>
<html lang="en">

<?php
include_once('../config/head.php');
?>

<body>
    <div class="wrapper">
        <div class="preloader">
            <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div>
        <?php
        include_once('../config/header.php');
        ?>

        <section class="slider">
            <div class="slick-carousel m-slides-0"
                data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/3.png" alt="slide img"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                <div class="slide__content">
                                    <h2 class="slide__title">ทุกการให้ ยิ่งใหญ่เสมอ</h2>
                                    <p class="slide__desc">เชิญชวนร่วมบริจาคเงินเพื่อสนับสนุนการศึกษา คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</p>
                                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">

                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="fas fa-gift"></i>
                                            </div>
                                            <h2 class="feature__title">ของที่ระลึก</h2>
                                        </li>

                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <span style="font-size: 26px; font-weight: bold;">x2</span>
                                            </div>
                                            <h2 class="feature__title">ลดหน่อยภาษี 2 เท่า</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/2.png" alt="slide img"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                <div class="slide__content">
                                    <h2 class="slide__title">บริจาคเพื่อทุนการศึกษา</h2>
                                    <p class="slide__desc">บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</p>
                                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <span style="font-size: 26px; font-weight: bold;">x2</span>
                                            </div>
                                            <h2 class="feature__title">ลดหน่อยภาษี 2 เท่า</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/1.png" alt="slide img"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                <div class="slide__content">
                                    <h2 class="slide__title">บริจาคเพื่อสาธารณะประโยชน์</h2>
                                    <p class="slide__desc">บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ</p>
                                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <span style="font-size: 26px; font-weight: bold;">x1</span>
                                            </div>
                                            <h2 class="feature__title">ลดหน่อยภาษี 1 เท่า</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services-layout1 services-carousel">
            <div class="bg-img"><img src="../assets/images/backgrounds/2.jpg" alt="background"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                        <div class="heading text-center mb-60">
                            <h3 class="heading__title">โครงการ</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    require_once '../config/connect.php';
                    $stmt = $pdo->prepare("SELECT * FROM project");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $t1) {
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="post-item">
                                <div class="post__img">
                                    <img src="../assets/images/blog/grid/1.jpg" alt="post image" loading="lazy">
                                </div>
                                <div class="post__body">
                                    <div class="post__meta-cat">
                                        <?= $t1['project_tex']; ?>
                                    </div>

                                    <h4 class="post__title"><?= $t1['project_name']; ?></h4>

                                    <p class="post__desc"><?= $t1['project_description']; ?></p>
                                    <a href="../donat/?project_number=<?= $t1['project_number']; ?>" class="btn btn__secondary btn__link btn__rounded">
                                        <span>บริจาค</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php
        include_once('../config/footer.php');
        ?>

        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            // ตัวอย่างการเรียกใช้ AJAX
            $.ajax({
                url: 'check_and_move_data.php', // ไฟล์ PHP ที่ต้องการส่งข้อมูลไป
                type: 'POST',
                data: {
                    billPaymentRef1: 'some_value' // ข้อมูลที่ต้องการส่งไปยัง PHP
                },
                success: function(response) {
                    console.log('สำเร็จ:', response);
                },
                error: function(xhr, status, error) {
                    console.error('เกิดข้อผิดพลาด:', error);
                }
            });
        });
    </script>
</body>

</html>