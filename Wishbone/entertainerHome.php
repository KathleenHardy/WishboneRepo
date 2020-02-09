<?php
include ('config.php');
require_once ('dto/gig.php');
session_start();

$user_check = $_SESSION['useremail'];

$infoQuery = "SELECT entertainers.imagelocation, entertainers.entid, entertainers.firstName, entertainers.lastName 
		FROM entertainers JOIN authentication
 			ON authentication.authid = entertainers.authid
 			WHERE authentication.email = '$user_check'";

$result = mysqli_query($connection, $infoQuery) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$Login_user_imagelocation = $row['imagelocation'];
$login_user_firstname = $row['firstName'];
$login_user_lastname = $row['lastName'];
$login_user_userid = $row['entid'];


$_SESSION['entertainerfirstname'] = $login_user_firstname;
$_SESSION['entertainerlastname'] = $login_user_lastname;
$_SESSION['entertainerid'] = $login_user_userid;

$myGigs = array();
$sql = "select * from gigs where entid = $login_user_userid"; #entId will be passed in here through a session param

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);

if ($count >= 1) {
    
    while($row = mysqli_fetch_array($result)) {
        
        $myGigs[] = new Gig( $row['gigsid'], $row['gigsName'], $row['gigsCategory'],$row['gigsArtType'],$row['gigsDetails'],$row['notes']);
    }
} else {
    #$fmsg = "Invalid Login Credentials.";
}




mysqli_close($connection);


?>


<!DOCTYPE html>
<html>
<head>
<title>Blog Detail</title>
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
						href="index.html">WISHBONE</a>
				</div>

				<!-- consult-nav -->
				<nav class="consult-nav">

					<!-- consult-menu -->
					<ul class="consult-menu">
						<li class="menu-item-has-children current-menu-item"><a
							href="entertainer.html">Home</a>
							<ul class="sub-menu">
								<li><a href="entertainer.html">My Network</a></li>
								<li><a href="#">My Art Profile</a></li>
							</ul></li>
						<li><a href="event.html">My Portfolio</a></li>
						<li><a href="about.html">About Me</a>
						<li><a href="create-gig.php">Add a Gig</a></li>
						<li><a href="post-availability.php">Set my Availability</a></li>
						<li><a href="#logout">Log out</a></li>
						
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
			<div class="consult-postDetail">
				<div class="image-full">
					<img src="assets/img/blogs/detail/1.jpg" alt="">
				</div>
				<div class="consult-postDetail"></div>
				<div class="container">
					<div class="consult-postDetail__main">

						<!-- social-01 -->
						<div class="social-01 social-01__style-02">
							<nav class="social-01__navSocial">
								<a class="social-01__item" href="#"><i
									class="fa fa-facebook"></i></a> <a class="social-01__item" href="#"><i
									class="fa fa-youtube"></i></a> <a class="social-01__item" href="#"><i
									class="fa fa-twitter"></i></a> <a class="social-01__item" href="#"><i
									class="fa fa-instagram"></i></a>
							</nav>
						</div>
						<!-- End / social-01 -->

						<div class="row">
							<div
								class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">
								<div class="consult-postDetail__content">
									<div class="row">
										<div
											class="col-xl-11 offset-0 offset-sm-0 offset-md-0 offset-lg-0 offset-xl-1 ">
											<h1 style="margin-bottom: 0px;"> <?= $login_user_firstname . ' ' . $login_user_lastname  ?> </h1>
											<ul class="consult-postDetail__meta"
												style="margin-bottom: 0px;">
												<li><i class="fa fa-music" aria-hidden="true"></i>
													Cover Band</li>
											</ul>

											<div class="row ">
												<div class="col-lg-6 ">
													<!-- infobox -->
													<div class="infobox">
														<div class="infobox__description"
															style="margin-top: 30px; margin-bottom: 10px;">
														</div>
													</div>
													<!-- End / infobox -->
												</div>
											</div>

											<p class="text">Nam elit ligula, egestas et ornare non,
												viverra eu justo. Aliquam ornare lectus ut pharetra dictum.
												Aliquam erat volutpat. In fringilla erat at eros pharetra
												faucibus. Nunc a magna eu lectus fringilla interdum luctus
												vitae diam. Morbi ac orci ac dolor pellentesque interdum vel
												accumsan risus. In vestibulum mattis turpis nec rhoncus.
												Maecenas facilisis commodo nunc, in blandit sem rutrum ac.
												Integer sit amet vehicula sem. Sed dictum arcu sit amet eros
												tempus pretium. Aenean lobortis risus purus.</p>
										</div>
									</div>

									<!-- Sound cloud link -->
									<div class="post-01__style-02 md-text-center">
										<div class="post-01__media">
											<div>
												<iframe width="100%" scrolling="no" frameborder="no"
													src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/308178330&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
											</div>
										</div>
									</div>
									<!-- End /  -->

									
									<div class="row">
										<div class="col-lg-6 ">
											<div class="image-full">
												<img src="assets/img/blogs/detail/4.jpg" alt="">
											</div>
										</div>
										<div class="col-lg-6 ">
											<div class="image-full">
												<img src="assets/img/blogs/detail/3.jpg" alt="">
											</div>
										</div>
									</div>
									<div class="row">
										<div
											class="col-xl-11 offset-0 offset-sm-0 offset-md-0 offset-lg-0 offset-xl-1 ">
											<p class="text">Sed ante nisl, fermentum et facilisis in,
												maximus sed ipsum. Cras hendrerit feugiat eros, ut fringilla
												nunc finibus sed. Quisque vitae dictum augue, vitae pretium
												sem. Proin tristique lobortis mauris nec mollis. Mauris id
												nibh sem. Vivamus ac ligula ac erat ultricies cursus semper
												ac enim. Aenean ac</p>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Related Posts-->

			<!-- Section -->
			<section class="md-section">
				<div class="container">

					<!-- title-01 -->
					<div class="title-01">
						<h2 class="title-01__title">My Gigs</h2>
					</div>
					<!-- End / title-01 -->

                    
					<div class="row">
						<?php 
						
						foreach($myGigs as $gig) {
						    print
						    '
                        <div class="col-lg-4 col-md-6 mb-4">
							<div class="card h-100">
								<a href="#"><img class="card-img-top"
									src="assets/img/projects/9.jpg" alt=""></a>
								<div class="card-body text-center">
									<h2 class="post-02__title" style="color: #f39c12;">
										<a href="#">' . $gig->getGigsName() . '</a>
									</h2>
									<div class="post-02__department">Cover Band</div>
									<p class="card-text" style="margin-top: 10px;">
										From <span>$24.99 CAD</span> per hour
									</p>
									<p style="margin-top: 50px;">
										<button
											type="button" class="btn btn-default btn-block">View</button>
									</p>
								</div>
								<div class="card-footer">
									<small class="text-muted"> &#9733; &#9733; &#9733;
										&#9733; &#9734; <span>6</span>
									</small>
								</div>
							</div>
						</div>
                        ';
						}
                        ?>
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
						<div class="footer__item" style="top: -12px; position: relative;">
							<a style="color: #f39c12; font-size: 35px; font-weight: 700;"
								href="index.html">WISHBONE</a>
							<p>Wishbone handles the entire booking process, including
								Management, ratings/ reviews, communication and payments.</p>
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
										<li><a href="#">How It Works </a></li>
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
								<a href="#" class="form-sub__title">Our Newsletter</a>
								<!--
										<form class="form-sub__form">
											<div class="form-item">
												<input class="form-control" type="email" placeholder="Enter Your Email Address..."/>
											</div>
											<div class="form-submit">
												<button class="form-button" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
											</div>
										</form>
										-->
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
			<div class="footer__copyright">2017 &copy; Copyright Wishbone.
				All rights Reserved.</div>
		</footer>
		<!-- End / footer -->

	</div>
	<!-- Vendors-->
	<script
		src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
		integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
		crossorigin="anonymous"></script>
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