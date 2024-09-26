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

        <section class="shop-grid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            <?php
                            require_once '../config/connect.php';
                            $stmt = $pdo->prepare("SELECT * FROM service_donat");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $count = 1;
                            $letters = range('a', 'm');
                            foreach ($result as $t1) {
                                $letterIndex = ($count - 1) % count($letters);
                            ?>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="product-item">
                                        <div class="product__img">
                                            <img src="../assets/images/products/<?= $letters[$letterIndex]; ?>.jpg" alt="Product <?= $count; ?>" loading="lazy">
                                        </div>
                                        <div class="product__info">
                                            <h4 class="product__title"><?= $t1['name']; ?></h4>
                                            <span class="product__price"><?= $t1['amount']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $count++;
                            }
                            ?>
                        </div>
                    </div>
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
</body>

</html>