<?php

//require_once ('../config.php');
include "navigationheaderEntertainer.php";

//include "navigationheaderVenueHost.php";
//require_once ('../dto/venue.php');
//session_start();
//$authIdLocal=$_SESSION['authId'];
$authIdLocal=$authId;

?>
<?php


//$venueDTO = $_SESSION['myVenues'];

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

if (! empty($_POST)) {

    echo "Posting";

    //$venueName = $_POST['venueName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    

    $sql = "INSERT INTO availability(availStartDate, availEndDate, availStartTime, availEndTime) 
VALUES( '$startDate', '$endDate', '$startTime', '$endTime')";
    

    if (mysqli_query($connection, $sql)) {
        echo "New availability created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
    
    //mysqli_close($connection);
    
//     $sql2 = "SELECT venueID 
//             FROM venues 
//             WHERE venueName=$venueName";
//     $chosenVenueID = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
    $sql2 = "SELECT entid
            FROM entertainers
            WHERE authid=?";

    if ($stmt = $connection->prepare( $sql2)) {
        
        $stmt->bind_param( "i", $authIdLocal);
        
        //execute statement
        $stmt->execute();
        
        //bind result variables
        $stmt->bind_result( $chosenEntId);
        
        // fetch values
        $stmt->fetch();
        
        //close statement
        $stmt->close();
        
    }
    
    $sql3="SELECT availId
            FROM availability
            WHERE availStartDate=? AND availEndDate=? AND availStartTime=? AND availEndTime=?";
    
    if ($stmt = $connection->prepare( $sql3)) {
        
        $stmt->bind_param( "ssss", $startDate, $endDate, $startTime, $endTime);
        
        //execute statement
        $stmt->execute();
        
        //bind result variables
        $stmt->bind_result( $availId);
        
        // fetch values
        $stmt->fetch();
        
        //close statement
        $stmt->close();
        
    }
    $sql4="INSERT INTO resourceAvailability(availId, entId)
            VALUES ($availId, $chosenEntId)";
    
    $run = mysqli_query($connection, $sql4) or die(mysqli_error($connection));
    ?>
    <script type="text/javascript">
    //window.location.href = 'http://localhost:7331/Wishbone/templates/entertainerAvailabilityList.php';
    window.location.href = 'entertainerAvailabilityList.php';
    </script>
<?php

    
}

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
<script type="text/javascript"
	src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet"
	href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

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
<link rel="stylesheet" type="text/css"
	href="../assets/css/min.styles.css">
<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
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

							<div class="row">
								<div class="col-md-4 mx-auto">
									<div class="u-pull-half text-center">
										<img
											class="img-fluid u-avatar u-box-shadow-lg rounded-circle mb-3"
											width="200" height="auto"
											src="../assets/img-temp/200x200/img1.jpg"
											alt="Image Description">
									</div>
								</div>
							</div>
							<form action="addEntertainerAvailability.php" method="POST">

								  
								<div class="form-group">
									<!-- Event Name -->
									<label for="startDate" class="control-label title2">Availability Start Date</label>
									<input type="date" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="startDate"
										name="startDate" placeholder="Enter the start date of the avilability">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="endDate" class="control-label title2">Availability End Date</label>
									<input type="date" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="endDate"
										name="endDate" placeholder="Enter the end date of the avilability">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="startTime" class="control-label title2">Availability Start Time
										</label> <input type="time" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="startTime"
										name="startTime">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="endTime" class="control-label title2">Availability End Time
										</label> <input type="time" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="endTime"
										name="endTime">
								</div>

								<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->

								<a href="entertainerAvailabilityList.php"><button type="submit" class="btn-all" style="display: inline;">Add</button></a>


								<a href="entertainerEventList.php"><button class="btn-all"
										type="button" style="display: inline;">Cancel</button></a>

								<!-- Replace buttons with below code -->
								<!--<div class="form-group" style="display:inline;"> 
											<a href="entertainerPortfolio.php"><button type="submit" class="btn-all">Create</button></a>
										</div> 
										<div class="form-group" style="display:inline;"> 
											<button class="btn-all">Cancel</button>
										</div>   -->


							</form>

						</div>
					</div>
				</div>
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
		<script type="text/javascript"
			src="../assets/vendors/menu/menu.min.js"></script>
		<script type="text/javascript"
			src="../assets/vendors/smoothscroll/SmoothScroll.min.js"></script>
		<!-- App-->
		<script type="text/javascript" src="../assets/js/main.js"></script>
	<?php include "navigationHeadInclude2.php" ?>




</body>
</html>