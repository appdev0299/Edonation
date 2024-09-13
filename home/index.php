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
            </div><!-- /.carousel -->
        </section><!-- /.slider -->
        <section class="contact-info py-2">
            <div class="container">
                <div class="row row-no-gutter boxes-wrapper">
                    <div class="col-sm-12 col-md-4">
                        <div class="contact-box d-flex">
                            <div class="contact__icon">
                                <i class="icon-call3"></i>
                            </div><!-- /.contact__icon -->
                            <div class="contact__content">
                                <h2 class="contact__title">Emergency Cases</h2>
                                <p class="contact__desc">Please feel free to contact our friendly reception staff with any general or
                                    medical enquiry.</p>
                                <a href="tel:+201061245741" class="phone__number">
                                    <i class="icon-phone"></i> <span>01061245741</span>
                                </a>
                            </div><!-- /.contact__content -->
                        </div><!-- /.contact-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-sm-12 col-md-4">
                        <div class="contact-box d-flex">
                            <div class="contact__icon">
                                <i class="icon-health-report"></i>
                            </div><!-- /.contact__icon -->
                            <div class="contact__content">
                                <h2 class="contact__title">Doctors Timetable</h2>
                                <p class="contact__desc">Qualified doctors available six days a week, view our timetable to make an
                                    appointment.</p>
                                <a href="doctors-timetable.html" class="btn btn__white btn__outlined btn__rounded">
                                    <span>View Timetable</span><i class="icon-arrow-right"></i>
                                </a>
                            </div><!-- /.contact__content -->
                        </div><!-- /.contact-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-sm-12 col-md-4">
                        <div class="contact-box d-flex">
                            <div class="contact__icon">
                                <i class="icon-heart2"></i>
                            </div><!-- /.contact__icon -->
                            <div class="contact__content">
                                <h2 class="contact__title">Opening Hours</h2>
                                <ul class="time__list list-unstyled mb-0">
                                    <li><span>Monday - Friday</span><span>8.00 - 7:00 pm</span></li>
                                    <li><span>Saturday</span><span>9.00 - 10:00 pm</span></li>
                                    <li><span>Sunday</span><span>10.00 - 12:00 pm</span></li>
                                </ul>
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
                            <h2 class="heading__subtitle">The Best Medical And General Practice Care!</h2>
                            <h3 class="heading__title">Providing Medical Care For The Sickest In Our Community.</h3>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="post-item">
                            <div class="post__img">
                                <a href="blog-single-post.html">
                                    <img src="../assets/images/blog/grid/1.jpg" alt="post image" loading="lazy">
                                </a>
                            </div>
                            <div class="post__body">
                                <div class="post__meta-cat">
                                    <a href="#">Mental Health</a>
                                </div>
                                <div class="post__meta d-flex">
                                    <span class="post__meta-date">Jan 30, 2022</span>
                                    <a class="post__meta-author" href="#">Martin King</a>
                                </div>
                                <h4 class="post__title"><a href="#">6 Tips to Protect Your Mental Health When You’re Sick</a></h4>

                                <p class="post__desc">It’s normal to feel anxiety, worry and grief any time you’re diagnosed with a
                                    condition that’s certainly true if you test positive for COVID-19, or are presumed to be positive...
                                </p>
                                <a href="../donat/" class="btn btn__secondary btn__link btn__rounded">
                                    <span>Read More</span>
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="post-item">
                            <div class="post__img">
                                <a href="blog-single-post.html">
                                    <img src="../assets/images/blog/grid/2.jpg" alt="post image" loading="lazy">
                                </a>
                            </div>
                            <div class="post__body">
                                <div class="post__meta-cat">
                                    <a href="#">Infectious</a><a href="#">Tips</a>
                                </div>
                                <div class="post__meta d-flex">
                                    <span class="post__meta-date">Jan 30, 2022</span>
                                    <a class="post__meta-author" href="#">John Ezak</a>
                                </div>
                                <h4 class="post__title"><a href="#">Unsure About Wearing a Face Mask? Here’s How and Why</a></h4>
                                <p class="post__desc">That means that you should still be following any shelter-in-place orders in your
                                    community. But when you’re venturing out to the grocery store, pharmacy or hospital..
                                </p>
                                <a href="blog-single-post.html" class="btn btn__secondary btn__link btn__rounded">
                                    <span>Read More</span>
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="post-item">
                            <div class="post__img">
                                <a href="blog-single-post.html">
                                    <img src="../assets/images/blog/grid/3.jpg" alt="post image" loading="lazy">
                                </a>
                            </div>
                            <div class="post__body">
                                <div class="post__meta-cat">
                                    <a href="#">Life Style</a><a href="#">Nutrition</a>
                                </div>
                                <div class="post__meta d-flex">
                                    <span class="post__meta-date">Jan 28, 2022</span>
                                    <a class="post__meta-author" href="#">Saul Wade</a>
                                </div>
                                <h4 class="post__title"><a href="#">Tips for Eating Healthy When You’re Working From Home </a></h4>

                                <p class="post__desc">It’s normal to feel anxiety, worry and grief any time you’re diagnosed with a
                                    condition that’s certainly true if you test positive for COVID-19, or are presumed to be positive...
                                </p>
                                <a href="blog-single-post.html" class="btn btn__secondary btn__link btn__rounded">
                                    <span>Read More</span>
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>