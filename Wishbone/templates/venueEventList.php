<!DOCTYPE html>
<html>
<head>
<title>My Event List</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<?php include "navigationHeadInclude1.php" ?>
<!-- Fonts-->
<link rel="stylesheet" type="text/css"
	href="../assets/fonts/fontawesome/font-awesome.min.css">
<link
	href="https://fonts.googleapis.com/css?family=Archivo&display=swap"
	rel="stylesheet">
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
<?php
include ('../config.php');
include "navigationheaderVenueHost.php";
include ('../dto/venue.php');
include ('../dto/availability.php');

session_start();

// $authId = $_SESSION['authId'];

// $query = "SELECT venueOwnerId
// FROM venueowners
// WHERE authid = ?";

// if ($stmt = $connection->prepare( $query)) {

// $stmt->bind_param( "i", $authId);

// //execute statement
// $stmt->execute();

// //bind result variables
// $stmt->bind_result( $venueOwnerId);

// // fetch values
// $stmt->fetch();

// //close statement
// $stmt->close();

// }

// $_SESSION['venueOwnerId'] = $venueOwnerId;

$venueOwnerId = $_SESSION['venueOwnerId'];
$venueDTO = array();

$query2 = "SELECT * 
        FROM venues 
        WHERE venueOwnerId=$venueOwnerId";

$result = mysqli_query($connection, $query2) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);

if ($count >= 1) {

    while ($row = mysqli_fetch_array($result)) {

        $venueDTO[] = new Venue($row['venueId'], $row['venueOwnerId'], $row['venueName'], $row['venueCity'], $row['venueState'], $row['venueProvince'], $row['venueDescription'], $row['venuePicture']);
    }
} else {
    // $fmsg = "No venues for this user";
}
$_SESSION['myVenues'] = $venueDTO;

$availabilityDTO = array();
$query3 = "SELECT *
        FROM availability";

$result2 = mysqli_query($connection, $query3) or die(mysqli_error($connection));

$count2 = mysqli_num_rows($result2);

if ($count2 >= 1) {

    while ($row = mysqli_fetch_array($result2)) {

        $availabilityDTO[] = new Availability($row['availId'], $row['availStartDate'], $row['availEndDate'], $row['availStartTime'], $row['availEndTime']);
    }
} else {
    // $fmsg = "No availabilities";
}
$_SESSION['myVenues'] = $venueDTO;
$_SESSION['avails'] = $availabilityDTO;

mysqli_close($connection);

?>
	<div class="page-wrap">

		<!-- header -->

		<!-- End / header -->

		<!-- Content-->
		<div class="md-content">

			<section class="md-section" style="padding-bottom: 0;">
				<div class="container">
					<div class="row">
						<div
							class="col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h2 class="title-01__title">VENUES</h2>
							</div>
							<!-- End / title-01 -->

						</div>
					</div>
				</div>
				<div class="consult-project">
					<div class="row">


						<!-- post-02 -->
<?php
foreach ($venueDTO as $venue) {

    print '
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">
        <div class="post-02 post-02__style-02 js-post-effect">

								<div class="post-02__media">
                                    <a href="#"><img src='."../assets/img-temp/portfolio/" .$venue->getVenuePicture().' alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="font-weight:bold; color:white;">
									<a href="#">' . $venue->getVenueName() . '</a>
									</h2>
									<div class="post-02__department">' . $venue->getVenueCity() . '</div>
									<div class="post-02__content">
									<div class="post-02__department">' . $venue->getVenueState() . '</div>
									<div class="post-02__department">' . $venue->getVenueProvince() . '</div>
                                    <div class="post-02__description">' . $venue->getVenueDescription() . '</div>
									</div>
									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a>
								</div>
                                </div>
							</div>';
}
?>
							<!-- End / post-02 -->

					

				</div>

			</section>
			<div class="container">
				<div class="row">
					<div
						class="col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2 ">

						<!-- title-01 -->
						<div class="title-01 title-01__style-04">
							<h2 class="title-01__title">Availabilities</h2>
						</div>
						<!-- End / title-01 -->

					</div>
				</div>
			</div>
			<div class="consult-project">
				<div class="row">


						<!-- post-02 -->
<?php
foreach ($availabilityDTO as $availability) {

    print '
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">
        <div class="post-02 post-02__style-02 js-post-effect">

								<div class="post-02__media">
                                    <a href="#"><img src="../assets/img/projects/v-1.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="font-weight:bold; color:white;">
									<a href="#">' . $availability->getAvailStartDate() . ' to ' . $availability->getAvailEndDate() . '</a>
									</h2>
									<div class="post-02__content">
												<div class="post-02__description">DESCRIPTION: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a>
								</div>
</div>
							</div>';
}
?>
							<!-- End / post-02 -->

					

				</div>


				<a href="createNewVenue.php"><button type="button" class="btn-all"
						style="display: inline;">Add Venue</button></a> <a
					href="addVenueAvailability.php"><button type="button"
						class="btn-all" style="display: inline;">Add Availability</button></a>


				<!-- Past Events -->

				<section class="md-section" style="padding-bottom: 0;">
					<!-- 				<div class="container"> -->
					<!-- 					<div class="row"> -->
					<!-- 						<div -->
					<!-- 							class="col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2 "> -->

					<!-- title-01 -->
					<!-- 							<div class="title-01 title-01__style-04"> -->
					<!-- 								<h2 class="title-01__title">PAST EVENTS</h2> -->
					<!-- 							</div> -->
					<!-- End / title-01 -->

					<!-- 						</div> -->
					<!-- 					</div> -->
					<!-- 				</div> -->
					<!-- 				<div class="consult-project"> -->
					<!-- 					<div class="row"> -->
					<!-- 						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 " -->
					<!-- 							style="padding-left: 5px; padding-right: 5px;"> -->

					<!-- post-02 -->
					<!-- 							<div class="post-02 post-02__style-02 js-post-effect"> -->
					<!-- 								<div class="post-02__media"> -->
					<!-- 									<a href="#"><img src="../assets/img/projects/v-1.jpg" alt="" /></a> -->
					<!-- 								</div> -->
					<!-- 								<div class="post-02__body"> -->
					<h2 class="post-02__title" style="font-weight: bold; color: white;">
						<!-- 										EVENT NAME -->
						<!-- 									</h2> -->
						<!-- 									<div class="post-02__department">DATE TIME</div> -->
						<!-- 									<div class="post-02__content"> -->
						<!-- 									<div class="post-02__department">VENUE NAME</div> -->
						<!-- 									<div class="post-02__department">ENTERTAINER NAME & CONTACT INFO</div> -->
						<!-- 												<div class="post-02__description">DESCRIPTION: Etiam non varius -->
						<!-- 											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu. -->
						<!-- 											Suspendisse maximus ac nisl eu porta. Praesent eget consequat -->
						<!-- 											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div> -->
						<!-- 									</div> -->
						<!-- 									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a> -->
						<!-- 								</div> -->
						<!-- 							</div> -->
						<!-- End / post-02 -->

						<!-- 						</div> -->
						<!-- 						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 " -->
						<!-- 							style="padding-left: 5px; padding-right: 5px;"> -->

						<!-- post-02 -->
						<!-- 							<div class="post-02 post-02__style-02 js-post-effect"> -->
						<!-- 								<div class="post-02__media"> -->
						<!-- 									<a href="#"><img src="../assets/img/projects/v-2.jpg" alt="" /></a> -->
						<!-- 								</div> -->
						<!-- 								<div class="post-02__body"> -->
						<h2 class="post-02__title"
							style="font-weight: bold; color: white;">
							<!-- 										EVENT NAME -->
							<!-- 									</h2> -->
							<!-- 									<div class="post-02__department">DATE TIME</div> -->
							<!-- 									<div class="post-02__content"> -->
							<!-- 									<div class="post-02__department">VENUE NAME</div> -->
							<!-- 									<div class="post-02__department">ENTERTAINER NAME & CONTACT INFO</div> -->
							<!-- 												<div class="post-02__description">DESCRIPTION: Etiam non varius -->
							<!-- 											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu. -->
							<!-- 											Suspendisse maximus ac nisl eu porta. Praesent eget consequat -->
							<!-- 											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div> -->
							<!-- 									</div> -->
							<!-- 									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a> -->
							<!-- 								</div> -->
							<!-- 							</div> -->
							<!-- End / post-02 -->

							<!-- 						</div> -->
							<!-- 						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 " -->
							<!-- 							style="padding-left: 5px; padding-right: 5px;"> -->

							<!-- post-02 -->
							<!-- 							<div class="post-02 post-02__style-02 js-post-effect"> -->
							<!-- 								<div class="post-02__media"> -->
							<!-- 									<a href="#"><img src="../assets/img/projects/v-3.jpg" alt="" /></a> -->
							<!-- 								</div> -->
							<!-- 								<div class="post-02__body"> -->
							<h2 class="post-02__title"
								style="font-weight: bold; color: white;">
								<!-- 										EVENT NAME -->
								<!-- 									</h2> -->
								<!-- 									<div class="post-02__department">DATE TIME</div> -->
								<!-- 									<div class="post-02__content"> -->
								<!-- 									<div class="post-02__department">VENUE NAME</div> -->
								<!-- 									<div class="post-02__department">ENTERTAINER NAME & CONTACT INFO</div> -->
								<!-- 												<div class="post-02__description">DESCRIPTION: Etiam non varius -->
								<!-- 											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu. -->
								<!-- 											Suspendisse maximus ac nisl eu porta. Praesent eget consequat -->
								<!-- 											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div> -->
								<!-- 									</div> -->
								<!-- 									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a> -->
								<!-- 								</div> -->
								<!-- 							</div> -->
								<!-- End / post-02 -->

								<!-- 						</div> -->
								<!-- 						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 " -->
								<!-- 							style="padding-left: 5px; padding-right: 5px;"> -->

								<!-- post-02 -->
								<!-- 							<div class="post-02 post-02__style-02 js-post-effect"> -->
								<!-- 								<div class="post-02__media"> -->
								<!-- 									<a href="#"><img src="../assets/img/projects/v-4.jpg" alt="" /></a> -->
								<!-- 								</div> -->
								<!-- 								<div class="post-02__body"> -->
								<h2 class="post-02__title"
									style="font-weight: bold; color: white;">
									<!-- 										EVENT NAME -->
									<!-- 									</h2> -->
									<!-- 									<div class="post-02__department">DATE TIME</div> -->
									<!-- 									<div class="post-02__content"> -->
									<!-- 									<div class="post-02__department">VENUE NAME</div> -->
									<!-- 									<div class="post-02__department">ENTERTAINER NAME & CONTACT INFO</div> -->
									<!-- 												<div class="post-02__description">DESCRIPTION: Etiam non varius -->
									<!-- 											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu. -->
									<!-- 											Suspendisse maximus ac nisl eu porta. Praesent eget consequat -->
									<!-- 											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div> -->
									<!-- 									</div> -->
									<!-- 									<a data-toggle="modal" href="#eventDetailsModal" href="#!"><button type="button">View Details</button></a> -->
									<!-- 								</div> -->
									<!-- 							</div> -->
									<!-- End / post-02 -->

									<!-- 						</div> -->
									<!-- 					</div> -->
									<!-- 				</div> -->
									<!-- 			</section> -->




									<!-- End / Section -->
<?php include "footer.php" ?>
	
		
		
		
		
			
			</div>
			<!-- Event Details Modal Window -->
			<div class="modal fade" id="eventDetailsModal" tabindex="-1"
				role="dialog" aria-labelledby="exampleModalCenterTitle"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<form action="#">
							<div class="modal-header">
								<h3 class="modal-title" id="modalTitle">
									EVENT NAME HERE
									</h5>
									<button type="button" class="close" data-dismiss="modal"
										aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							
							</div>
							<div class="modal-body">
								<h5>Event Date/Time</h5>
								<h5>Venue Name</h5>
								<h5>Venue Location</h5>
								<h5>Event Description Here</h5>
							</div>
					
					</div>
					</form>
				</div>
			</div>
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
		<script type="text/javascript"
			src="../assets/vendors/menu/menu.min.js"></script>
		<script type="text/javascript"
			src="../assets/vendors/smoothscroll/SmoothScroll.min.js"></script>
		<!-- App-->
		<script type="text/javascript" src="../assets/js/main.js"></script>
	<?php include "navigationHeadInclude2.php" ?>


</body>
</html>