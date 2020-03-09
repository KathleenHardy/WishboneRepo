<?php
session_start();
?>
<?php

require_once ('../config.php');
include "navigationheaderVenueHost.php";

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
if (isset($_FILES['venuePicture'])) {
    $errors = array();
    $file_name = $_FILES['venuePicture']['name'];
    $file_size = $_FILES['venuePicture']['size'];
    $file_tmp = $_FILES['venuePicture']['tmp_name'];
    $file_type = $_FILES['venuePicture']['type'];
    // $file_path= $_SERVER['DOCUMENT_ROOT'] . "\\Wishbone\\assets\\img-temp\\portfolio\\";
    $file_path = "C:/Users/kate/git/WishboneRepo/Wishbone/assets/img-temp/portfolio/";

    /*
     * $file_ext=strtolower(end(explode('.', $file_name)));
     *
     * $extensions= array("jpeg","jpg","png");
     *
     * if(in_array($file_ext,$extensions)=== false){
     * $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     * }
     */

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        echo $file_tmp;
        echo "          ";
        echo $file_name;

        move_uploaded_file($file_tmp, $file_path . $file_name);
        // copy($_FILES['fileToUpload']['tmp_name'], "../assets/img-temp/portfolio/".$file_name);
    } else {
        print_r($errors);
    }
}

$venueOwnerId = $_SESSION['venueOwnerId'];

if (! empty($_POST)) {


    $venueName = $_POST['venueName'];
    $venueCity = $_POST['venueCity'];
    $venueState = $_POST['venueState'];
    $venueProvince = $_POST['venueProvince'];
    $venueDescription = $_POST['venueDescription'];    
    $venuePicture = $_FILES['venuePicture']['name'];
    
    // image file directory
    //$target = "C:/Users/kate/git/WishboneRepo/Wishbone/assets/img-temp/portfolio/".basename($venuePicture);
    $target = "../assets/img-temp/portfolio/".basename($venuePicture);
    
   

    $sql = "INSERT INTO venues(venueOwnerId, venueName, venueCity, venueState, venueProvince, venueDescription, venuePicture) 
VALUES( $venueOwnerId, '$venueName','$venueCity','$venueState','$venueProvince','$venueDescription','$venuePicture')";

    if (mysqli_query($connection, $sql)) {
        echo "New venue created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
    
    if (move_uploaded_file($_FILES['venuePicture']['tmp_name'], $target)) {
        $sf="s";
    }else{
        $sf="f";
    }


    mysqli_close($connection);
    ?>
     <script type="text/javascript">
       window.location.href = 'venueEventList.php';
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
<?php include "navigationheaderVenueHost.php" ?>

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

							<form action="createNewVenue.php" method="POST" enctype="multipart/form-data">

								<div class="form-group">
									<!-- Event Name -->
									<label for="venueName" class="control-label title2">Venue Name</label>
									<input type="text" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="venueName"
										name="venueName" placeholder="Enter the venue's name">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueCity" class="control-label title2">City</label>
									<input type="text" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="venueCity"
										name="venueCity" placeholder="Enter the venue's city">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueState" class="control-label title2">Venue
										State</label> <input type="text" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="venueState"
										name="venueState">
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueProvince" class="control-label title2">Venue
										Province</label> <input type="text" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="venueProvince"
										name="venueProvince">
								</div>
								<div class="form-group">
									<label for="venueDescription" class="title2">Venue Description</label>
									<textarea class="form-control" rows="5"
										style="border: 3px solid #fac668;" id="venueDescription"
										name="venueDescription"
										placeholder="Add a description for your venue"></textarea>
								</div>
								<div class="form-group">
									<label for="venuePicture" class="title2">Upload Venue Image</label>
									<input type="file" name="venuePicture">
								</div>


								 <a href="venueEventList.php"><button type="submit" class="btn-all" style="display: inline;">Add</button></a>


								<a href="venueEventList.php"><button class="btn-all"
										type="button" style="display: inline;">Cancel</button></a>


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