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
                    <div class="bg-img"><img src="../assets/images/sliders/1.jpg" alt="slide img"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                                <div class="slide__content">
                                    <h2 class="slide__title">Providing Best Medical Care</h2>
                                    <p class="slide__desc">The health and well-being of our patients and their health care team will
                                        always be our priority, so we follow the best practices for cleanliness.</p>
                                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                                        <!-- feature item #1 -->
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-heart"></i>
                                            </div>
                                            <h2 class="feature__title">Examination</h2>
                                        </li><!-- /.feature-item-->
                                        <!-- feature item #2 -->
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-medicine"></i>
                                            </div>
                                            <h2 class="feature__title">Prescription </h2>
                                        </li><!-- /.feature-item-->
                                        <!-- feature item #3 -->
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-heart2"></i>
                                            </div>
                                            <h2 class="feature__title">Cardiogram</h2>
                                        </li><!-- /.feature-item-->
                                        <!-- feature item #4 -->
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-blood-test"></i>
                                            </div>
                                            <h2 class="feature__title">Blood Pressure</h2>
                                        </li><!-- /.feature-item-->
                                    </ul><!-- /.features-list -->
                                </div><!-- /.slide-content -->
                            </div><!-- /.col-xl-7 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.slide-item -->
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/2.jpg" alt="slide img"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                                <div class="slide__content">
                                    <h2 class="slide__title">All Aspects Of Medical Practice</h2>
                                    <p class="slide__desc">The health and well-being of our patients and their health care team will
                                        always be our priority, so we follow the best practices for cleanliness.</p>
                                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-heart"></i>
                                            </div>
                                            <h2 class="feature__title">Examination</h2>
                                        </li>

                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-medicine"></i>
                                            </div>
                                            <h2 class="feature__title">Prescription </h2>
                                        </li>

                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-heart2"></i>
                                            </div>
                                            <h2 class="feature__title">Cardiogram</h2>
                                        </li>

                                        <li class="feature-item">
                                            <div class="feature__icon">
                                                <i class="icon-blood-test"></i>
                                            </div>
                                            <h2 class="feature__title">Blood Pressure</h2>
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