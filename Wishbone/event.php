<?php
include ('config.php');
include ('dto/gigDetails.php');

session_start();

$gigDetailsDT0 = array();

$sql = "select * from gigsdetails";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);

if ($count >= 1) {
    
    while($row = mysqli_fetch_array($result)) {
        $gigDetailsDT0[] = new GigDetails( $row['gigsName'], $row['gigsCategory'], $row['gigsArtType'], $row['gigsDetails'], $row['notes'],
                                           $row['firstName'],$row['lastName'],$row['ratePerHour'], $row['aboutMe'], 
                                           $row['availStartDate'], $row['availEndDate'], $row['availStartTime'], $row['availEndTime']);
    }
} else {
    #$fmsg = "Invalid Login Credentials.";
}

mysqli_close($connection);
?>


<!DOCTYPE html>
<html>
<head>
<title>Events</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Fonts-->
<link rel="stylesheet" type="text/css"
	href="assets/fonts/fontawesome/font-awesome.min.css">
<link rel="stylesheet" type="text/css"
	href="assets/fonts/themify-icons/themify-icons.css">
<!-- Vendors-->
<link rel="stylesheet" type="text/css"
	href="assets/vendors/bootstrap4/bootstrap-grid.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
	integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
	crossorigin="anonymous">
<link rel="stylesheet" type="text/css"
	href="assets/vendors/magnific-popup/magnific-popup.min.css">
<link rel="stylesheet" type="text/css"
	href="assets/vendors/owl.carousel/owl.carousel.css">
<!-- App & fonts-->
<link rel="stylesheet" type="text/css"
	href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;amp;subset=latin-ext">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
</head>

<body>
	<div class="page-wrap">

		<!-- header -->
		<header class="header">
			<div class="container">
				<div class="header__logo">
					<a style="color: #f39c12; font-size: 25px; font-weight: 700;"
						href="index.php">WISHBONE</a>
				</div>

				<!--
					<div class="header__toogleGroup">
						<div class="header__chooseLanguage">
										
										<div class="dropdown" data-init="dropdown"><a class="dropdown__toggle" href="javascript:void(0)">EN <i class="fa fa-angle-down" aria-hidden="true"></i></a>
											<div class="dropdown__content" data-position="right">
												<ul class="list-style-none">
													<li><a href="#">EN</a></li>
													<li><a href="#">DE</a></li>
													<li><a href="#">VI</a></li>
												</ul>
											</div>
										</div>
										
						</div>
						<div class="search-form">
							<div class="search-form__toggle"><i class="ti-search"></i></div>
							<div class="search-form__form">
												
												<div class="form-search">
													<form>
														<input class="form-control" type="text" placeholder="Hit enter to search or ESC to close"/>
													</form>
												</div>
												
							</div>
						</div>
					</div>
					-->

				<!-- consult-nav -->
				<nav class="consult-nav">

					<!-- consult-menu -->
					<ul class="consult-menu">
						<li><a href="index.php">Home</a></li>

						<!--
							<li class="menu-item-has-children"><a href="#">page</a>
								<ul class="sub-menu">
									<li>
										<a href="comming-soon.html">Comming Soon</a>
									</li>
									<li>
										<a href="404.html">404</a>
									</li>
									<li>
										<a href="typography.html">Typography</a>
									</li>
								</ul>
							</li>
							-->

						<li class="menu-item-has-children"><a href="entertainer.php">Entertainer</a>
							<ul class="sub-menu">
								<li><a href="entertainer.php">Find Entertainer</a></li>
								<li><a href="#">Become Entertainer</a></li>
							</ul></li>
						<li class="current-menu-item"><a href="event.php">Events</a>
						</li>
						<li><a href="about.html">about</a>
						<li><a href="contact.html">contact</a></li>
					</ul>
					<!-- consult-menu -->

					<div class="navbar-toggle">
						<span></span><span></span><span></span>
					</div>
				</nav>
				<!-- End / consult-nav -->

			</div>
		</header>
		<!-- End / header -->

		<!-- Content-->
		<div class="md-content">

			<!-- Section -->
			<section class="md-section">
				<div class="container">

					<div class="row">
						<div
							class="col-lg-10 offset-0 offset-sm-0 offset-md-0 offset-lg-1 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04"
								style="margin-bottom: 25px;">
								<h2 class="title-01__title">
									Explore all <span>Events</span>
								</h2>

								<div class="row">
									<div class="col-lg-12">
										<div class="widget-text__content">
											<!-- form-search -->
											<div class="form-search">
												<form>
													<input class="form-control" type="text"
														placeholder="Enter Location..." />
												</form>
											</div>
											<!-- End / form-search -->
										</div>
									</div>
								</div>
							</div>
							<!-- End / title-01 -->

							<div class="row">
								<div class="col-lg-12">
									<p class="text-center"
										style="margin-bottom: 60px; font-weight: 500; color: #c2c2c2;">All
										Events</p>
								</div>
							</div>

						</div>
					</div>

					<!-- post-03 -->
					
					<?php
					$counter = 0;
					foreach($gigDetailsDT0 as $gigDetails) {
					    
					    if ($counter++ % 2 == 1 ) {
					        print
					        '<div class="post-03">
        						<div class="post-03__media">
        							<a href="#"><img src="assets/img/services/3.jpg" alt="" /></a>
        						</div>
        						<div class="post-03__body">
        							<h6 class="post-03__subTitle">' . $gigDetails->getGigsArtType() . '</h6>
        							<h2 class="post-03__title">
        								<a href="#">' . $gigDetails->getGigsName() . '</a>
        							</h2>
        							<div class="post-03__description">
        								<p>1 June, 2018</p>
        								<p>Building B, University of Ottawa</p>
        								<p>Starts at $' . $gigDetails->getRatePerHour() . ' CAD</p>
        								<span>' . $gigDetails->getGigsDetails() . '</span>
        							</div>
        							<a class="post-03__link" href="event-detail.html"> view event
        								<i class="fa fa-angle-right" aria-hidden="true"></i>
        							</a>
        						</div>
        					</div>';
					        
					    } else {
					        print
					        '<div class="post-03 post-03__reverse">
        						<div class="post-03__media">
        							<a href="#"><img src="assets/img/services/3.jpg" alt="" /></a>
        						</div>
        						<div class="post-03__body">
        							<h6 class="post-03__subTitle">' . $gigDetails->getGigsArtType() . '</h6>
        							<h2 class="post-03__title">
        								<a href="#">' . $gigDetails->getGigsName() . '</a>
        							</h2>
        							<div class="post-03__description">
        								<p>1 June, 2018</p>
        								<p>Building B, University of Ottawa</p>
        								<p>Starts at $' . $gigDetails->getRatePerHour() . ' CAD</p>
        								<span>' . $gigDetails->getGigsDetails() . '</span>
        							</div>
        							<a class="post-03__link" href="event-detail.html"> view event
        								<i class="fa fa-angle-right" aria-hidden="true"></i>
        							</a>
        						</div>
        					</div>';
					        
					        
					    } 
					    
					}
					?>

					<!-- 
					<div class="post-03">
						<div class="post-03__media">
							<a href="#"><img src="assets/img/services/1.jpg" alt="" /></a>
						</div>
						<div class="post-03__body">
							<h6 class="post-03__subTitle">Music Event</h6>
							<h2 class="post-03__title">
								<a href="#">Jonathan Moody Live</a>
							</h2>
							<div class="post-03__description">
								<p>1 June, 2018</p>
								<p>Building B, University of Ottawa</p>
								<p>Starts at $10 CAD</p>
								<span>Maecenas lorem ex, euismod eget pulvinar non,
									facilisis ut leo. Quisque placerat purus in neque efficitur
									ornare.</span>
							</div>
							<a class="post-03__link" href="event-detail.html"> view event
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>

					<div class="post-03 post-03__reverse">
						<div class="post-03__media">
							<a href="#"><img src="assets/img/services/2.jpg" alt="" /></a>
						</div>
						<div class="post-03__body">
							<h6 class="post-03__subTitle">Music Event</h6>
							<h2 class="post-03__title">
								<a href="#">Jonathan Moody Live</a>
							</h2>
							<div class="post-03__description">
								<p>1 June, 2018</p>
								<p>Building B, University of Ottawa</p>
								<p>Starts at $10 CAD</p>
								<span>Maecenas lorem ex, euismod eget pulvinar non,
									facilisis ut leo. Quisque placerat purus in neque efficitur
									ornare.</span>
							</div>
							<a class="post-03__link" href="event-detail.html"> view event
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>
	
					<div class="post-03">
						<div class="post-03__media">
							<a href="#"><img src="assets/img/services/3.jpg" alt="" /></a>
						</div>
						<div class="post-03__body">
							<h6 class="post-03__subTitle">Music Event</h6>
							<h2 class="post-03__title">
								<a href="#">Jonathan Moody Live</a>
							</h2>
							<div class="post-03__description">
								<p>1 June, 2018</p>
								<p>Building B, University of Ottawa</p>
								<p>Starts at $10 CAD</p>
								<span>Maecenas lorem ex, euismod eget pulvinar non,
									facilisis ut leo. Quisque placerat purus in neque efficitur
									ornare.</span>
							</div>
							<a class="post-03__link" href="event-detail.html"> view event
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					
					-->
					
					<!-- End / post-03 -->

				</div>
			</section>
			<!-- End / Section -->


			<!-- Section -->
			<section class="md-section js-consult-form js-consult-form--02"
				style="background-color: #f7f7f7;">
				<div class="container">
					<div class="row">
						<div
							class="col-md-10 col-lg-8 offset-0 offset-sm-0 offset-md-1 offset-lg-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h2 class="title-01__title">We Improve Your Customer
									Service</h2>
								<div>Etiam non varius justo, vel tempor mi. Nulla
									facilisi. Fusce at tortor arcu. Suspendisse maximus ac nisl eu
									porta. Praesent eget consequat nisi, at mollis turpis. Quisque
									sed venenatis neque, at mollis magna. Nullam quis interdum
									augue, non feugiat leo. Mauris efficitur porta maximus.
									Curabitur auct</div>
							</div>
							<!-- End / title-01 -->

						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-3 ">

							<!-- iconbox -->
							<div class="iconbox iconbox__style-02">
								<div class="iconbox__icon">
									<i class="ti-announcement"></i>
								</div>
								<div>
									<h2 class="iconbox__title">
										<a href="#">Support Services</a>
									</h2>
									<div class="iconbox__description">Etiam non varius justo,
										vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
										Suspendisse maximus ac</div>
								</div>
							</div>
							<!-- End / iconbox -->

						</div>
						<div class="col-sm-6 col-md-6 col-lg-3 ">

							<!-- iconbox -->
							<div class="iconbox iconbox__style-02">
								<div class="iconbox__icon">
									<i class="ti-headphone"></i>
								</div>
								<div>
									<h2 class="iconbox__title">
										<a href="#">Email Marketing</a>
									</h2>
									<div class="iconbox__description">Nam suscipit nisi
										risus, et porttitor metus molestie a. Phasellus id quam id
										turpis suscipit pretium</div>
								</div>
							</div>
							<!-- End / iconbox -->

						</div>
						<div class="col-sm-6 col-md-6 col-lg-3 ">

							<!-- iconbox -->
							<div class="iconbox iconbox__style-02">
								<div class="iconbox__icon">
									<i class="ti-timer"></i>
								</div>
								<div>
									<h2 class="iconbox__title">
										<a href="#">Risk Management</a>
									</h2>
									<div class="iconbox__description">Integer placerat
										ullamcorper urna nec rhoncus. Sed velit justo, lacinia non
										sapien imperdiet, sagitt</div>
								</div>
							</div>
							<!-- End / iconbox -->

						</div>
						<div class="col-sm-6 col-md-6 col-lg-3 ">

							<!-- iconbox -->
							<div class="iconbox iconbox__style-02">
								<div class="iconbox__icon">
									<i class="ti-briefcase"></i>
								</div>
								<div>
									<h2 class="iconbox__title">
										<a href="#">Investment Planning</a>
									</h2>
									<div class="iconbox__description">Maecenas lorem ex,
										euismod eget pulvinar non, facilisis ut leo. Quisque placerat
										purus in neque effi</div>
								</div>
							</div>
							<!-- End / iconbox -->

						</div>
					</div>
					<div class="consult-form consult-form--02 js-consult-form__content"
						style="background-image: url('assets/img/backgrounds/2.jpg');">

						<!-- form-01 -->
						<div class="form-01" style="padding: 60px;">
							<h2 class="form-01__title">We Here To Help You</h2>
							<form class="form-01__form">
								<div class="form__item">
									<input type="text" name="name" placeholder="Your name" />
								</div>
								<div class="form__item">
									<input type="text" name="phone" placeholder="Your Email" />
								</div>
								<div class="form__item">
									<textarea rows="3" name="Your message"
										placeholder="Your message"></textarea>
								</div>
								<div class="form__button">
									<a class="btn btn-primary btn-w180" href="#">send message</a>
								</div>
							</form>
						</div>
						<!-- End / form-01 -->

					</div>
				</div>
			</section>
			<!-- End / Section -->


			<!-- Section -->
			<section class="md-section">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-lg-3 col-xl-3 ">

							<!-- pricing -->
							<div class="pricing">
								<header>
									<div class="pricing__icon">
										<i class="ti-support" aria-hidden="true"></i>
									</div>
									<h2 class="pricing__title">Start</h2>
								</header>
								<div>
									<ul class="pricing__list">
										<li>Charter Plane Crashes</li>
										<li class="disable">Cruise Ship Accidents</li>
										<li class="disable">Bicycle accidents</li>
									</ul>
									<div class="pricing__price">
										<span>$</span>62<span class="pricing__time">/ month</span>
									</div>
									<a class="btn btn-primary btn-outline btn-w180" href="#">choose
										plan</a>
								</div>
							</div>
							<!-- End / pricing -->

						</div>
						<div class="col-md-6 col-lg-3 col-xl-3 ">

							<!-- pricing -->
							<div class="pricing">
								<header>
									<div class="pricing__icon">
										<i class="ti-ruler-pencil" aria-hidden="true"></i>
									</div>
									<h2 class="pricing__title">business</h2>
								</header>
								<div>
									<ul class="pricing__list">
										<li>Charter Plane Crashes</li>
										<li>Cruise Ship Accidents</li>
										<li>Bicycle accidents</li>
									</ul>
									<div class="pricing__price">
										<span>$</span>71<span class="pricing__time">/ month</span>
									</div>
									<a class="btn btn-primary btn-outline btn-w180" href="#">choose
										plan</a>
								</div>
							</div>
							<!-- End / pricing -->

						</div>
						<div class="col-md-6 col-lg-3 col-xl-3 ">

							<!-- pricing -->
							<div class="pricing">
								<header>
									<div class="pricing__icon">
										<i class="ti-server" aria-hidden="true"></i>
									</div>
									<h2 class="pricing__title">corporate</h2>
								</header>
								<div>
									<ul class="pricing__list">
										<li>Charter Plane Crashes</li>
										<li class="disable">Cruise Ship Accidents</li>
										<li class="disable">Bicycle accidents</li>
									</ul>
									<div class="pricing__price">
										<span>$</span>81<span class="pricing__time">/ month</span>
									</div>
									<a class="btn btn-primary btn-outline btn-w180" href="#">choose
										plan</a>
								</div>
							</div>
							<!-- End / pricing -->

						</div>
						<div class="col-md-6 col-lg-3 col-xl-3 ">

							<!-- pricing -->
							<div class="pricing">
								<header>
									<div class="pricing__icon">
										<i class="ti-harddrives" aria-hidden="true"></i>
									</div>
									<h2 class="pricing__title">enterprise</h2>
								</header>
								<div>
									<ul class="pricing__list">
										<li>Charter Plane Crashes</li>
										<li class="disable">Cruise Ship Accidents</li>
										<li class="disable">Bicycle accidents</li>
									</ul>
									<div class="pricing__price">
										<span>$</span>71<span class="pricing__time">/ month</span>
									</div>
									<a class="btn btn-primary btn-outline btn-w180" href="#">choose
										plan</a>
								</div>
							</div>
							<!-- End / pricing -->

						</div>
					</div>
				</div>
			</section>
			<!-- End / Section -->

		</div>
		<!-- End / Content-->

		<!-- footer -->
		<footer class="footer">
			<div class="footer__main">
				<div class="row row-eq-height">
					<div class="col-8 col-sm-7 col-md-9 col-lg-3 ">
						<div class="footer__item">
							<a class="consult_logo" href="#"><img
								src="assets/img/logo.png" alt="" /></a>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								Ut laoreet ut lacus a tincidunt.</p>
						</div>
					</div>
					<div
						class="col-sm-6 col-md-4 col-lg-3 col-xl-2 offset-0 offset-sm-0 offset-md-0 offset-lg-0 offset-xl-1 ">
						<div class="footer__item">

							<!-- widget-text__widget -->
							<section class="widget-text__widget widget">
								<div class="widget-text__content">
									<ul>
										<li><a href="#">Term of Services </a></li>
										<li><a href="#">Privacy Policy </a></li>
										<li><a href="#">Sitemap </a></li>
										<li><a href="#">Help</a></li>
									</ul>
								</div>
							</section>
							<!-- End / widget-text__widget -->

						</div>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 ">
						<div class="footer__item">

							<!-- widget-text__widget -->
							<section class="widget-text__widget widget">
								<div class="widget-text__content">
									<ul>
										<li><a href="#">How It Work </a></li>
										<li><a href="#">Carrier </a></li>
										<li><a href="#">Pricing </a></li>
										<li><a href="#">Support</a></li>
									</ul>
								</div>
							</section>
							<!-- End / widget-text__widget -->

						</div>
					</div>
					<div class="col-md-4 col-lg-2 col-xl-2 ">
						<div class="footer__item">

							<!-- form-sub -->
							<div class="form-sub">
								<h4 class="form-sub__title">Our Newsletter</h4>
								<form class="form-sub__form">
									<div class="form-item">
										<input class="form-control" type="email"
											placeholder="Enter Your Email Address..." />
									</div>
									<div class="form-submit">
										<button class="form-button" type="submit">
											<i class="fa fa-paper-plane" aria-hidden="true"></i>
										</button>
									</div>
								</form>
							</div>
							<!-- End / form-sub -->

						</div>
					</div>
					<div class="col-sm-6 col-md-4 col-lg-2 col-xl-2  consult_backToTop">
						<div class="footer__item">
							<a href="#" id="back-to-top"> <i class="fa fa-angle-up"
								aria-hidden="true"> </i><span>Back To Top</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer__copyright">2017 &copy; Copyright Awe7. All
				rights Reserved.</div>
		</footer>
		<!-- End / footer -->

	</div>
	<!-- Vendors-->
	<script type="text/javascript"
		src="assets/vendors/jquery/jquery.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/imagesloaded/imagesloaded.pkgd.js"></script>
	<script type="text/javascript"
		src="assets/vendors/isotope-layout/isotope.pkgd.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.countTo/jquery.countTo.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.countUp/jquery.countup.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.matchHeight/jquery.matchHeight.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.mb.ytplayer/jquery.mb.YTPlayer.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/masonry-layout/masonry.pkgd.js"></script>
	<script type="text/javascript"
		src="assets/vendors/owl.carousel/owl.carousel.js"></script>
	<script type="text/javascript"
		src="assets/vendors/jquery.waypoints/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="assets/vendors/menu/menu.min.js"></script>
	<script type="text/javascript"
		src="assets/vendors/smoothscroll/SmoothScroll.min.js"></script>
	<!-- App-->
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>