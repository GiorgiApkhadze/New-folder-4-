<?php

require_once(__DIR__ . "/functions/db.php");
require_once(__DIR__ . "/functions/functions.php");

db_Connect();

$jobs = get_jobs();

db_Disconnect();

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hailtrephes </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/responsive.css">

		<script src="./js/functions.js"></script>
</head>

<body>

    <header>
        <!-- Header Start -->
				<div class="header-area">
		        <div class="main-header ">
		            <div class="header-bottom  header-sticky">
		                <div class="container">
		                    <div class="row align-items-center">
		                        <!-- Logo -->
		                        <div class="col-xl-2 col-lg-2">
									<div class="logo">
										<a href="index.php"><img src="assets/img/icon01.svg" style="color:white" alt=""></a>
									</div>
								</div>
								<div class="col-xl-10 col-lg-10">
									<div class="menu-wrapper  d-flex align-items-center justify-content-end">
										<!-- Main-menu -->
										<div class="main-menu d-none d-lg-block">
											<nav>
												<ul id="navigation">
													<li><a href="about.php">About</a></li>
													<li><a href="services.php">Services</a></li>
													<li><a href="jobs.php">Join</a>
													</li>
												</ul>
											</nav>
										</div>
										<!-- Header-btn -->
										<div class="header-right-btn d-none d-lg-block ml-20">
											<a href="contact.php" class="btn header-btn">Contact</a>
										</div>
									</div>
								</div>
		                        <!-- Mobile Menu -->
		                        <div class="col-12">
		                            <div class="mobile_menu d-block d-lg-none"></div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
        <!-- Header End -->
    </header>
    <main>
        <!--? slider Area Start-->
				<div class="slider-area " >
						<div class="slider-active">
								<!-- Single Slider -->
								<div class="single-slider slider-height d-flex align-items-center" style="background-image: url(assets/img/banner02.png);min-height: 500px;">
										<div class="container" style="margin-left:30%;">
												<div class="row">
														<div class="col-xl-9 col-lg-9">
																<div class="hero__caption">
																		<h1><span style="color:#2268DD">Hailtrephes</span> Challange </h1>
																</div>

																<div class="hero-pera">
																		<p>Join the Halitrephes team and contribute your knowledge, skills </br>
																			and ability towards unique opportunities within the federal marketplace.</p>
																</div>
																<!-- <form class="search-box"> -->
																		<div class="search-form" style="border: 4px solid #FFFFFF;
																																							    margin-left: 23%;
																																							    width: 18%;
																																							    padding: 5px;">
																			<input id="send_cv" type="file" style="display: none;" onchange="send_cv(this);">
																			<a href="javascript:void(0)" onclick="document.getElementById('send_cv').click();">Email Your Resume</a>
																		</div>
																<!-- </form> -->
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
				<div class="hero__caption" style="
    padding: 50px;
    padding-left: 36%;
">
						<h1><span style="color:#2268DD">Find Your Seat </span> at Our Table </h1>
				</div>
				<ul class="cards">

					<?php
					foreach ($jobs as $jb):
					?>
				  	<li class="cards_item">
						    <div class="card">


				      			<div class="card_content">
								        <h2 class="card_heading"><?=$jb['name'] ?></h2>
												<h4 class="card_heading"><?=$jb['location'] ?></h4>
												<hr>
								        <p><?=$jb['sh_description'] ?></p>
								        <a href="job_description.php?job_id=<?=$jb['id'] ?>" class="card_button">View Details</a>
				      			</div>

						    </div>
					  </li>
					<?php
					endforeach;
					?>
				</ul>

				<div class="testimonial-area testimonial-padding section-bg" data-background="assets/img/gallery/section_bg04.jpg" style="padding-top: 2%;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-7">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-25">
                        <h2>Looking for a Teaming Partner?</h2>
                    </div>
                    <div class="h1-testimonial-active mb-70">
                        <!-- Single Testimonial -->
                        <div class="single-testimonial ">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <div class="testimonial-top-cap">
                                    <p>Fill your small business set-aside with a trusted </br> SDVOSB teammate</p>
                                </div>
                                <!-- founder -->
                            </div>
                        </div>
                        <!-- Single Testimonial -->
                        <!-- <div class="single-testimonial ">
                        </div> -->
                    </div>
                </div>
                <!-- Form Start -->
                <div class="col-xl-4 col-lg-5 col-md-8">
                        <button name="submit" class="submit-btn" onclick="window.location.href = './contact.php';">Contact Us</button>
                </div>
                <!-- Form End -->
            </div>
        </div>
    </div>

        <!-- slider Area End-->
        <!--================Blog Area =================-->

        <!--================Blog Area =================-->
    </main>
		<footer>
		    <!--? Footer Start-->
		    <div class="footer-area footer-bg">
        <div class="container">
            <div class="footer-top footer-padding">
                <!-- Footer Menu -->
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6" style="border-right: 1px solid white;">
                        <div class="single-footer-caption">
                            <!-- logo -->
                            <div class="footer-logo" style="padding-top: 10%;">
                                <a href="index.php"><img src="assets/img/footerlogo.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer-caption">
                            <div class="footer-tittle">
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="services.php">Services</a></li>
                                    <li><a href="jobs.php"> Join</a></li>
                                    <li><a href="contacnt.php"> Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" style="border-right: 1px solid white;">
                        <div class="single-footer-caption">
                            <div class="footer-tittle">
                                <ul>
                                    <li><a target="_blank" href="./file/Halitrephes - Privacy Policy.docx">Privacy Policy</a></li>
                                    <li><a target="_blank" href="./file/Halitrephes - Terms of Use.docx">Term of use</a></li>
                                    <li><a href="#"> Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                        <div class="single-footer-caption">
                            <!-- Footer Social -->
                            <div class="footer-social " style="
                                                                display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
                                                                display: -ms-flexbox;  /* TWEENER - IE 10 */
                                                                display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
                                                                display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
                                                                justify-content: center;
                                                                align-items: center;
                                                                min-height: 100px;">
                                <ul style="padding-top: 10%;">
                                    <li><div style="
                                                        background-color: #244191;
                                                        min-width: 30px;
                                                        border-radius: 10%;
                                                    " align="center">
                                            <a target="_blank" href="https://www.linkedin.com/company/halitrephes/"><i class="fab fa-linkedin-in" style="color: #2268DD;"></i></a>
                                        </div></li>
                                    <li style="margin-top: 100%;">
                                        <div style="
                                                        background-color: #244191;
                                                        min-width: 30px;
                                                        border-radius: 10%;
                                                    " align="center">
                                            <a target="_blank" href="https://www.facebook.com/Halitrephes/"><i class="fab fa-facebook-f" style="color: #2268DD;"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6"" style="display: contents;">
                        <div class="single-footer-caption mb-50" style="margin-bottom: 0px;">
                            <P style="color: white;">Ⓒ 2020 HALITREPHES LCC</P>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6" style="display: contents;">
                        <div class="single-footer-caption mb-50" style="margin-bottom: 0px;">
                            <P style="color: white;"><i class="fa fa-phone" style="transform: rotate(90deg);"></i> +1 214 609 6539</P>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6"" style="display: contents;">
                        <div class="single-footer-caption mb-50" style="margin-bottom: 0px;">
                            <P style="color: white;"><i class="fas fa-map-marker-alt"></i> 21 NORTH BROAD STREET, SUITE D, LURAY, VA 22835</P>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6" style="display: contents">
                        <div class="single-footer-caption mb-50" style="margin-bottom: 0px;">
                           <P style="color: white;"><i class="fa fa-envelope"></i> <a href="mailto:info@halitrephes.com">info@halitrephes.com</a></P>
                        </div>
                    </div>
                </div>
            <!-- Footer Bottom -->
            <!-- <div class="footer-bottom">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12">
                        <div class="footer-copy-right text-center">
                            <p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reservedh by Hailtrephes</p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
		    <!-- Footer End-->
		</footer>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

<!-- JS here -->

		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>

		<!-- Nice-select, sticky -->
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="./assets/js/plugins.js"></script>
		<script src="./assets/js/main.js"></script>


</body>
</html>
