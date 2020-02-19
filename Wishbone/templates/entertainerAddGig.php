<!DOCTYPE html>
<html>
<head>
<title>Add Gig</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
		<?php include "navigationHeadInclude1.php" ?>

<!-- Fonts-->
<link rel="stylesheet" type="text/css"
	href="../assets/fonts/fontawesome/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Archivo&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css"
	href="../assets/fonts/themify-icons/themify-icons.css">
<!-- Vendors-->
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/bootstrap4/bootstrap-grid.min.css">
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/magnific-popup/magnific-popup.min.css">
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/owl.carousel/owl.carousel.css">
<!-- App & fonts-->
<link rel="stylesheet" type="text/css"
	href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;amp;subset=latin-ext">
<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css">
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
</head>

<body>
<?php include "navigationheaderEntertainer.php" ?>
	<div class="page-wrap">

		<!-- header -->

		<!-- End / header -->

		<!-- Content-->
		<div class="md-content">

			<!-- Section -->
			<section class="md-section">
				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h2 class="title-01__title">ADD YOUR GIG</h2>
							</div>
							<form action="entertainerAddGig.php" method="POST">

										<div class="form-group"> <!-- Gig Name -->
											<label for="gig_name_id" class="control-label title2">Gig Name</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="gig_name_id" name="gigs_name" placeholder="Enter a name for your Gig">
										</div>	
										
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_category_id" class="control-label title2">Gig Category</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="gigs_category_id" name="gigs_category">
												<option value="Event">Event</option>
												<option value="Music">Music</option>
												<option value="Concert">Concert</option>
												<option value="Festival">Festival</option>
												<option value="Party">Party</option>
											</select>					
										</div>
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_label_id" class="control-label title2">Gig Label</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="gigs_category_id" name="gigs_category">
												<option value="Personal">Personal</option>
												<option value="Professional">Professional</option>
												<option value="Best">Best</option>
												<option value="Other">Other</option>
											</select>					
										</div>
										
										<div class="form-group"> <!-- Gigs category -->
											<label for="gigs_artType_id" class="control-label title2">Gig Art Type</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="gigs_artType_id" name="gigs_artType">
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
											<label for="gigs_details-id" class="title2">Gigs Details</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="gigs_details-id" name="gigs_details" placeholder ="Enter details"></textarea>
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_notes-id" class="title2">Notes</label>
											<textarea class="form-control" rows="5" style="border: 3px solid #fac668;" id="gigs_notes-id" name="gigs_notes" placeholder="Add notes"></textarea>
										</div>
										
										<div class="form-group">
										<label for="gigPhoto" class="title2">Upload Gig Image</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                          </div>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gigPhoto"
                                              aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                          </div>
                                        </div>
                                        </div>
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										 
										<a href="entertainerPortfolio.php"><button type="button" class="btn-all" style="display:inline;">Create</button></a>
										 
										 
										<a href="entertainerPortfolio.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
										
										<!-- Replace buttons with below code -->
										<!--<div class="form-group" style="display:inline;"> 
											<a href="entertainerPortfolio.php"><button type="submit" class="btn-all">Create</button></a>
										</div> 
										<div class="form-group" style="display:inline;"> 
											<button class="btn-all">Cancel</button>
										</div>   -->
										
										 
							</form>
							</div>
							</div></div>
			</section>
			<!-- End / Section -->
<?php include "footer.php" ?>
	</div>
	<!-- Vendors-->
	<script type="text/javascript"
		src="../assets/vendors/jquery/jquery.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/imagesloaded/imagesloaded.pkgd.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/isotope-layout/isotope.pkgd.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.countTo/jquery.countTo.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.countUp/jquery.countup.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.matchHeight/jquery.matchHeight.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.mb.ytplayer/jquery.mb.YTPlayer.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/masonry-layout/masonry.pkgd.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/owl.carousel/owl.carousel.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/jquery.waypoints/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="../assets/vendors/menu/menu.min.js"></script>
	<script type="text/javascript"
		src="../assets/vendors/smoothscroll/SmoothScroll.min.js"></script>
	<!-- App-->
	<script type="text/javascript" src="../assets/js/main.js"></script>
	<?php include "navigationHeadInclude2.php" ?>
</body>
</html>