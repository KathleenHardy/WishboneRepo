<?php
include ('../config.php');
require_once ('../dto/gig.php');
session_start();

$user_check = $_SESSION['useremail'];

$infoQuery = "SELECT entertainers.profilePicture, entertainers.entid, entertainers.firstName, entertainers.lastName
		FROM entertainers JOIN authentication
 			ON authentication.authid = entertainers.authid
 			WHERE authentication.email = '$user_check'";

$result = mysqli_query($connection, $infoQuery) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$Login_user_imagelocation = $row['profilePicture'];
$login_user_firstname = $row['firstName'];
$login_user_lastname = $row['lastName'];
$login_user_userid = $row['entid'];


$_SESSION['entertainerfirstname'] = $login_user_firstname;
$_SESSION['entertainerlastname'] = $login_user_lastname;
$_SESSION['entertainerid'] = $login_user_userid;


mysqli_close($connection);


?>
<!DOCTYPE html>
<html>
<head>
<title>Event Form</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
		<?php include "navigationHeadInclude1.php" ?>

<!-- for date time widget -->
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
<link rel="stylesheet" type="text/css" href="../assets/css/min.styles.css">
<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
	
</head>

<body>
<?php include "navigationheaderEventPlanner.php" ?>
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
							<div class="title-01 title-01__style-04" style="padding: 20px;">
								<h2 class="title-01__title"><?= $login_user_firstname.' '.$login_user_lastname ?></h2>
							</div>
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="u-pull-half text-center">
                <img class="img-fluid u-avatar u-box-shadow-lg rounded-circle mb-3" width="200" height="auto" src="../assets/img-temp/200x200/img1.jpg" alt="Image Description">
              </div>
            </div>
          </div>
		
										<div class="profileInfo" style ="padding: 20px; text-align: center;">		
										<form action="eventPlannerProfileUpdate.php" method="POST">

    										<div class="form-group"> <!-- Event Name -->
    											<label for="firstName" class="control-label title2">First Name</label>
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="firstName" name="firstName" value="<?php echo $login_user_firstname;?>">
    										</div>	
    										<div class="form-group"> <!-- Event Name -->
    											<label for="lastName" class="control-label title2">Last Name</label>
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="lastName" name="lastName" value="<?php echo $login_user_lastname;?>">
    										</div>	
    																											
    										
                                            </div>										
										 <button type="submit" class="btn-all" style="display:inline;">Update</button>
										</form>										
										
											
										
							</div>
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