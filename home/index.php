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
                </div>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/2.jpg" alt="slide img"></div>
                </div>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/3.jpg" alt="slide img"></div>
                </div>
                <div class="slide-item align-v-h">
                    <div class="bg-img"><img src="../assets/images/sliders/4.jpg" alt="slide img"></div>
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