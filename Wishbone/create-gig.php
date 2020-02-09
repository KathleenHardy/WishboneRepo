<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Create a Gig</title>
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
						<li class="current-menu-item"><a href="index.html">Home</a></li>

						<li class="menu-item-has-children"><a href="entertainer.php">Entertainer</a>
							<ul class="sub-menu">
								<li><a href="entertainer.php">Find Entertainer</a></li>
								<li><a href="#">Become Entertainer</a></li>
							</ul></li>

						<li><a href="event.php">Events</a></li>
						<li><a href="about.html">About</a></li>
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
							<form action="create-gig.php" method="POST">

										<div class="form-group"> <!-- Gig Name -->
											<label for="gig_name_id" class="control-label">Gigs Name</label>
											<input type="text" class="form-control" id="gig_name_id" name="gigs_name" placeholder="Enter a name for your Gig">
										</div>	
										
										<div class="form-group"> <!-- Gigs category -->
											<label for="gigs_category_id" class="control-label">Gigs Category</label>
											<select class="form-control" id="gigs_category_id" name="gigs_category">
												<option value="Event">Event</option>
												<option value="Music">Music</option>
												<option value="Concert">Concert</option>
												<option value="Festival">Festival</option>
												<option value="Party">Party</option>
											</select>					
										</div>
										
										<div class="form-group"> <!-- Gigs category -->
											<label for="gigs_artType_id" class="control-label">Gigs Art Type</label>
											<select class="form-control" id="gigs_artType_id" name="gigs_artType">
												<option value="Musician">Musician</option>
												<option value="Dancer">Dancer</option>
												<option value="Painter">Painter</option>
												<option value="Actor">Actor</option>
												<option value="Model">Model</option>
												<option value="Singer">Singer</option>
												<option value="Photographer">Photographer</option>
												<option value="Blogger">Blogger</option>
											</select>					
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_details-id">Gigs details</label>
											<textarea class="form-control" rows="5" id="gigs_details-id" name="gigs_details"></textarea>
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_notes-id">Notes</label>
											<textarea class="form-control" rows="5" id="gigs_notes-id" name="gigs_notes"></textarea>
										</div>
										
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										
										<div class="form-group"> <!-- Submit Button -->
											<button type="submit" class="btn btn-primary">Create Gig</button>
										</div>  
							</form>
<?php

require_once ("config.php");

$enthId = $_SESSION['entertainerid'];


if (! empty($_POST)) {
    
    $gigsName = $_POST['gigs_name'];
    $gigsCategory = $_POST['gigs_category'];
    $gigsArtType = $_POST['gigs_artType'];
    $gigsDetails = $_POST['gigs_details'];
    $gigsNotes = $_POST['gigs_notes'];
    
    
	$sql = "INSERT INTO `gigs`(`entid`, `gigsName`, `gigscategory`, `gigsArttype`, `gigsdetails`, `notes`) VALUES 
    	                       ( $enthId,'$gigsName','$gigsCategory','$gigsArtType','$gigsDetails','$gigsNotes')";

	if (mysqli_query($connection, $sql)) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	}

	mysqli_close($connection);

}	

?>							
							
							<!-- End / title-01 -->
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
							<a class="consult_logo" href="#"><img src="assets/img/logo.png"
								alt="" /></a>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
								laoreet ut lacus a tincidunt.</p>
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
			<div class="footer__copyright">2017 &copy; Copyright Awe7. All rights
				Reserved.</div>
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