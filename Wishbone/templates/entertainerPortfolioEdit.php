<?php
include ('../config.php');
require_once ('../dto/gig.php');

if(!isset($_SESSION)){session_start();}

$user_check = $_SESSION['useremail'];

$infoQuery = "SELECT entertainers.profilePicture, entertainers.entid, entertainers.firstName, 
        entertainers.lastName, entertainers.aboutMe
		FROM entertainers JOIN authentication
 			ON authentication.authid = entertainers.authid
 			WHERE authentication.email = '$user_check'";

$result = mysqli_query($connection, $infoQuery) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$Login_user_imagelocation = $row['profilePicture'];
$login_user_firstname = $row['firstName'];
$login_user_lastname = $row['lastName'];
$login_user_aboutme = $row['aboutMe'];
$login_user_userid = $row['entid'];


$_SESSION['entertainerfirstname'] = $login_user_firstname;
$_SESSION['entertainerlastname'] = $login_user_lastname;
$_SESSION['entertainerid'] = $login_user_userid;


mysqli_close($connection);


?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
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
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
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
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 " style="text-align: center;">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h2 class="title-01__title">UPDATE YOUR INFORMATION</h2>
							</div>
							<form action="eventPlannerProfileUpdate.php" method="POST">
										<div class="form-group"> <!-- Event Name -->
    											<label for="firstName" class="control-label title2">First Name</label>
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="firstName" name="firstName" value="<?php echo $login_user_firstname;?>">
    									</div>	
    									<div class="form-group"> <!-- Event Name -->
    											<label for="lastName" class="control-label title2">Last Name</label>
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="lastName" name="lastName" value="<?php echo $login_user_lastname;?>">
    									</div>	
    									
										<div class="form-group"> <!-- About Me -->
											<label for="aboutMe" class="title2">About Me</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="aboutMe" name="aboutMe"><?php echo $login_user_aboutme;?></textarea>
										</div>
										
										
										
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										<button type="submit" class="btn-all" style="display:inline;">Update</button>
										<!-- a href="entertainerPortfolio.php"><button type="button" class="btn-all" style="display:inline;">Update</button></a-->
										 
										 
										<a href="entertainerPortfolio.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
										
										<!-- Replace buttons with below code -->
										<!--<div class="form-group" style="display:inline;"> 
											<a href="entertainerPortfolio.php"><button type="submit" class="btn-all">Update</button></a>
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