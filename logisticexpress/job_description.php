<?php

require_once(__DIR__ . "/functions/db.php");
require_once(__DIR__ . "/functions/functions.php");

if (!isset($_GET['job_id'])) exit;

db_Connect();

$detailed_info = get_job_data($_GET['job_id']);
$field = get_job_tasks($_GET['job_id']);

db_Disconnect();

for ($i = 0; $i < sizeof($field); $i++)
{
    $field[$i] = json_decode($field[$i]['data'], true);
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Transportation HTML-5 Template </title>
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

		<script src="./js/jquery-3.4.1.min.js"></script>
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
				<div class="Content slider-area" style="padding:200px">
					<h3 class="Position">Position</h3>
						<h5 class="Position_name"><?=$detailed_info[0]['name'] ?></h5>
							<h3 class="job_desc_res">Job Description:</h3>
								<p >
									<?=$detailed_info[0]['fdescription'] ?>
								</p>
					<?php
					for ($i = 0; $i < sizeof($field); $i++):
					?>
						<h3 class="job_desc_res"><?=$field[$i][0]['header'] ?></h3>
						<ul>
							<?php
							for ($j = 0; $j < sizeof($field[$i][1]['values']); $j++):
							?>
								<li><p><?=$field[$i][1]['values'][$j] ?></p></li>
							<?php
							endfor;
							?>
						</ul>
					<?php
					endfor;
					?>


														<div class="file-upload">

				  <div class="image-upload-wrap">
				    <input class="file-upload-input" type='file' onchange="readURL(this);send_cv(this);"/>
				    <div class="drag-text">
				      <h3>Drag & drop Your Resume here</h3>
				    </div>
				  </div>
				  <div class="file-upload-content">
					<!-- <img class="file-upload-image" src="#" alt="your image" /> -->
					<p>Your CV has been sent.</p>
				    <div class="image-title-wrap">
				      <button type="button" onclick="removeUpload()" class="remove-image"><span class="image-title">Return</span></button>
				    </div>
				  </div>
				</div>

				</div>
				<div class="testimonial-area testimonial-padding section-bg" data-background="assets/img/gallery/section_bg04.jpg">
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
														<div class="single-testimonial ">
														</div>
												</div>
										</div>
										<!-- Form Start -->
										<div class="col-xl-4 col-lg-5 col-md-8">
														<button name="submit" class="submit-btn">Contact Us</button>
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
		                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
		                        <div class="single-footer-caption mb-50">
		                            <div class="footer-tittle">
		                                <ul>
		                                    <li><a href="about.php">About Us</a></li>
		                                    <li><a href="services.php">Services</a></li>
		                                    <li><a href="jobs.php"> Join</a></li>
		                                    <li><a href="contacnt.php"> Contact</a></li>
		                                </ul>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
		                        <div class="single-footer-caption mb-50">
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
		                        <div class="single-footer-caption mb-50">
		                            <!-- logo -->
		                            <div class="footer-logo">
		                                <a href="index.html"><img src="assets/img/footerlogo.svg" alt=""></a>
		                            </div>
		                            <!-- Footer Social -->
		                            <div class="footer-social ">
		                                <a href="https://www.facebook.com/Halitrephes/"><i class="fab fa-facebook-f" style="color:white"></i></a>
		                                <a href="https://www.linkedin.com/company/halitrephes/"><i class="fab fa-linkedin-in" style="color:white"></i></a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <!-- Footer Bottom -->
		            <div class="footer-bottom">
		                <div class="row d-flex align-items-center">
		                    <div class="col-lg-12">
		                        <div class="footer-copy-right text-center">
		                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reservedh by Hailtrephes
		  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
		                        </div>
		                    </div>
		                </div>
		            </div>
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
<script>
	function readURL(input) {
	  if (input.files && input.files[0]) {

	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('.image-upload-wrap').hide();

	      //$('.file-upload-image').attr('src', e.target.result);
	      $('.file-upload-content').show();

	      //$('.image-title').html(input.files[0].name);
	    };

	    reader.readAsDataURL(input.files[0]);

	  } else {
	    removeUpload();
	  }
	}

	function removeUpload() {
	  //$('.file-upload-input').replaceWith($('.file-upload-input').clone());
	  $('.file-upload-content').hide();
	  $('.image-upload-wrap').show();
	}

	$('.image-upload-wrap').bind('dragover', function () {
			$('.image-upload-wrap').addClass('image-dropping');
		});
		$('.image-upload-wrap').bind('dragleave', function () {
			$('.image-upload-wrap').removeClass('image-dropping');
	});

</script>
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
				<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
