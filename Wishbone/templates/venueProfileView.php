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
<link rel="stylesheet" type="text/css" href="../assets/css/min.styles.css">
<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css">
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
		
<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
</head>

<body>

<?php 
session_start();
include ('../config.php');
include "navigationheaderVenueHost.php";

$authId = $_SESSION['authId'];

$query = "SELECT venueOwnerId, firstName, lastName, imageLocation
          FROM venueowners
          WHERE  authid = ?";

if ($stmt = $connection->prepare( $query)) {

    $stmt->bind_param( "i", $authId);
    
    //execute statement
    $stmt->execute();

    //bind result variables
    $stmt->bind_result( $venueOwnerId, $firstName, $lastName, $imageLocation);
    
    // fetch values
    $stmt->fetch();
    
    //close statement
    $stmt->close();
      
}


$_SESSION['venueOwnerfirstname'] = $firstName;
$_SESSION['venueOwnerlastname'] = $lastName;
$_SESSION['venueOwnerId'] = $venueOwnerId;



$query2 = "SELECT email
          FROM authentication
          WHERE  authid = ?";

if ($stmt2 = $connection->prepare( $query2)) {
    
    $stmt2->bind_param( "i", $authId);
    
    //execute statement
    $stmt2->execute();
    
    //bind result variables
    $stmt2->bind_result($email);
    
    // fetch values
    $stmt2->fetch();
    
    //close statement
    $stmt2->close();  
}

/**
 * TODO: You can query the database here to get all the venues - please use prepared statements:
 * 
 */


$connection->close();

?>




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
								<h2 class="title-01__title"><?= $firstName . ' ' . $lastName  ?></h2>
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
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="firstName" name="firstName" value="<?php echo $firstName;?>">
    										</div>	
    										<div class="form-group"> <!-- Event Name -->
    											<label for="lastName" class="control-label title2">Last Name</label>
    											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="lastName" name="lastName" value="<?php echo $lastName;?>">
    										</div>											
										 <button type="submit" class="btn-all" style="display:inline;">Update</button>
										</form>	
									</div>
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