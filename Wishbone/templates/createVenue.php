<?php
session_start();
?>
<?php

include ('../config.php');

$venueOwnerId = $_SESSION['venueOwnerId'];

$venueNameErr = "";
$venueName = "";
$requiredFields = 0;
$venueVideoEmbedCode = "";

if (! empty($_POST)) {

    if (empty($_POST["venueName"])) {
        $venueNameErr = "Name is required";
    } else {
        $venueName = $_POST['venueName'];
        $requiredFields ++;
    }

    $venueCity = $_POST['venueCity'];
    // $venueState = $_POST['venueState'];
    $venueState = "";

    $venueProvince = $_POST['venueProvince'];
    $venueDescription = $_POST['venueDescription'];
    $venuePicture = $_FILES['venuePicture']['name'];
    $venueVideoEmbedCode = $_POST['venueVideoEmbedCode'];

    $target = "../assets/img-temp/portfolio/" . basename($venuePicture);

    if ($requiredFields == 1) {

        if (isset($_FILES['venuePicture'])) {
            $errors = array();
            $file_name = $_FILES['venuePicture']['name'];
            $file_size = $_FILES['venuePicture']['size'];
            $file_tmp = $_FILES['venuePicture']['tmp_name'];
            $file_type = $_FILES['venuePicture']['type'];
            $file_path = "C:/Users/kate/git/WishboneRepo/Wishbone/assets/img-temp/portfolio/";

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                // echo $file_tmp;
                // echo " ";
                // echo $file_name;

                move_uploaded_file($file_tmp, $file_path . $file_name);
            } else {
                print_r($errors);
            }
        }

        $sql = "INSERT INTO venues(venueOwnerId, venueName, venueCity, venueState, venueProvince, venueDescription, venuePicture) 
VALUES( $venueOwnerId, '$venueName','$venueCity','$venueState','$venueProvince','$venueDescription','$venuePicture')";

        if (mysqli_query($connection, $sql)) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
        if (! empty($_POST["venueVideoEmbedCode"])) {

            $query4 = "SELECT venueId
          FROM venues
          WHERE  venueOwnerId = ? and venueName=?";

            if ($stmt4 = $connection->prepare($query4)) {

                $stmt4->bind_param("ss", $venueOwnerId, $venueName);

                // execute statement
                $stmt4->execute();

                // bind result variables
                $stmt4->bind_result($venueId);

                // fetch values
                $stmt4->fetch();

                // close statement
                $stmt4->close();
            }
            echo $venueId;

            $vidSql = "INSERT INTO venueVideos(venueId, venueVideoEmbedCode) VALUES( $venueId, '$venueVideoEmbedCode')";

            if (mysqli_query($connection, $vidSql)) {
                echo "";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
            mysqli_close($connection);
        }

        if (move_uploaded_file($_FILES['venuePicture']['tmp_name'], $target)) {
            $sf = "s";
        } else {
            $sf = "f";
        }
    }

    // }

    ?>

<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Create Venue</title>
<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta name="keywords"
	content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
<meta name="author" content="Codedthemes" />
<!-- Favicon icon -->
<link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
<!-- Google font-->
<link
	href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
	rel="stylesheet">
<!-- waves.css -->
<link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css"
	type="text/css" media="all">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css"
	href="../assets/css2/bootstrap/css/bootstrap.min.css">
<!-- waves.css -->
<link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css"
	type="text/css" media="all">
<!-- themify icon -->
<link rel="stylesheet" type="text/css"
	href="../assets/icon/themify-icons/themify-icons.css">
<!-- font-awesome-n -->
<link rel="stylesheet" type="text/css"
	href="../assets/css2/font-awesome-n.min.css">
<link rel="stylesheet" type="text/css"
	href="../assets/css2/font-awesome.min.css">
<!-- scrollbar.css -->
<link rel="stylesheet" type="text/css"
	href="../assets/css2/jquery.mCustomScrollbar.css">
<!-- font awesome for icons -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css">

<link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
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
	<!-- Pre-loader start -->
	<div class="theme-loader">
		<div class="loader-track">
			<div class="preloader-wrapper">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Pre-loader end -->
	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">
			<nav class="navbar header-navbar pcoded-header">
				<div class="navbar-wrapper">
					<div class="navbar-logo">
						<a class="mobile-menu waves-effect waves-light"
							id="mobile-collapse" href="#!"> <i class="ti-menu"></i>
						</a>
						<div class="mobile-search waves-effect waves-light">
							<div class="header-search">
								<div class="main-search morphsearch-search">
									<div class="input-group">
										<span class="input-group-prepend search-close"><i
											class="ti-close input-group-text"></i></span> <input
											type="text" class="form-control" placeholder="Enter Keyword">
										<span class="input-group-append search-btn"><i
											class="ti-search input-group-text"></i></span>
									</div>
								</div>
							</div>
						</div>
						<a href="venueDashboardHome.php">
							<h4 style="color: white;">WISHBONE</h4>
						</a> <a class="mobile-options waves-effect waves-light"> <i
							class="ti-more"></i>
						</a>
					</div>
					<div class="navbar-container container-fluid">
						<ul class="nav-left">
							<li>
								<div class="sidebar_toggle">
									<a href="javascript:void(0)"><i class="ti-menu"></i></a>
								</div>
							</li>
							<li><a href="#!" onclick="javascript:toggleFullScreen()"
								class="waves-effect waves-light"> <i class="ti-fullscreen"></i>
							</a></li>
						</ul>
						<ul class="nav-right">
							<li class="header-notification"><a href="#!"
								class="waves-effect waves-light"> <i class="ti-bell"></i> <span
									class="badge bg-c-red"></span>
							</a>
								<ul class="show-notification">
									<li>
										<h6>Notifications</h6> <label class="label label-danger">New</label>
									</li>
									<li class="waves-effect waves-light">
										<div class="media">
											<img class="d-flex align-self-center img-radius"
												src="../assets/images/avatar-2.jpg"
												alt="Generic placeholder image">
											<div class="media-body">
												<h5 class="notification-user">John Doe</h5>
												<p class="notification-msg">Lorem ipsum dolor sit amet,
													consectetuer elit.</p>
												<span class="notification-time">30 minutes ago</span>
											</div>
										</div>
									</li>
									<li class="waves-effect waves-light">
										<div class="media">
											<img class="d-flex align-self-center img-radius"
												src="../assets/images/avatar-4.jpg"
												alt="Generic placeholder image">
											<div class="media-body">
												<h5 class="notification-user">Joseph William</h5>
												<p class="notification-msg">Lorem ipsum dolor sit amet,
													consectetuer elit.</p>
												<span class="notification-time">30 minutes ago</span>
											</div>
										</div>
									</li>
									<li class="waves-effect waves-light">
										<div class="media">
											<img class="d-flex align-self-center img-radius"
												src="../assets/images/avatar-3.jpg"
												alt="Generic placeholder image">
											<div class="media-body">
												<h5 class="notification-user">Sara Soudein</h5>
												<p class="notification-msg">Lorem ipsum dolor sit amet,
													consectetuer elit.</p>
												<span class="notification-time">30 minutes ago</span>
											</div>
										</div>
									</li>
								</ul></li>
							<li class="user-profile header-notification"><a href="#!"
								class="waves-effect waves-light"> <img
									src="../assets/images/avatar-4.jpg" class="img-radius"
									alt="User-Profile-Image"> <span>John Doe</span> <i
									class="ti-angle-down"></i>
							</a>
								<ul class="show-notification profile-notification">
									<li class="waves-effect waves-light"><a href="#!"> <i
											class="ti-settings"></i> Settings
									</a></li>
									<li class="waves-effect waves-light"><a
										href="venueHostProfileView.php"> <i class="ti-user"></i>
											Profile
									</a></li>
									<li class="waves-effect waves-light"><a href="index.php"> <i
											class="ti-layout-sidebar-left"></i> Logout
									</a></li>
								</ul></li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
					<nav class="pcoded-navbar">
						<div class="sidebar_toggle">
							<a href="#"><i class="icon-close icons"></i></a>
						</div>
						<div class="pcoded-inner-navbar main-menu">
							<div class="">
								<div class="main-menu-header">
									<img class="img-80 img-radius"
										src="../assets/images/avatar-4.jpg" alt="User-Profile-Image">
									<div class="user-details">
										<span id="more-details">John Doe<i class="fa fa-caret-down"></i></span>
									</div>
								</div>
								<div class="main-menu-content">
									<ul>
										<li class="more-details"><a href="venueHostProfileView.php"><i
												class="ti-user"></i>View Profile</a> <a href="#!"><i
												class="ti-settings"></i>Settings</a> <a href="index.php"><i
												class="ti-layout-sidebar-left"></i>Logout</a></li>
									</ul>
								</div>
							</div>
							<div class="p-15 p-b-0">
								<form class="form-material">
									<div class="form-group form-primary">
										<input type="text" name="footer-email" class="form-control"> <span
											class="form-bar"></span> <label class="float-label"><i
											class="fa fa-search m-r-10"></i>Search Here</label>
									</div>
								</form>
							</div>
							<div class="pcoded-navigation-label">NAVIGATION</div>
							<ul class="pcoded-item pcoded-left-item">
								<li class="active"><a href="venueDashboardHome.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="ti-home"></i><b>D</b></span> <span
										class="pcoded-mtext">Dashboard</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
								<li class=""><a href="messages.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="ti-email"></i><b>D</b></span> <span
										class="pcoded-mtext">Messages</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
								<li class=""><a href="bookmarks.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fa fa-bookmark"></i><b>D</b></span> <span
										class="pcoded-mtext">Bookmarks</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
								<li class=""><a href="reviews.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fa fa-star"></i><b>D</b></span> <span
										class="pcoded-mtext">Reviews</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
							</ul>
							<div class="pcoded-navigation-label">ORGANIZE AND MANAGE</div>
							<ul class="pcoded-item pcoded-left-item">
								<li class="pcoded-hasmenu"><a href="javascript:void(0)"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fa fa-list-alt"></i><b>BC</b></span> <span
										class="pcoded-mtext">Events</span> <span class="pcoded-mcaret"></span>
								</a>
									<ul class="pcoded-submenu">
										<li class=" "><a href="venueHostUpcomingEvents.php"
											class="waves-effect waves-dark"> <span class="pcoded-micon"><i
													class="ti-angle-right"></i></span> <span
												class="pcoded-mtext">Upcoming</span> <span
												class="pcoded-mcaret"></span>
										</a></li>
										<li class=" "><a href="venueHostPastEvents.php"
											class="waves-effect waves-dark"> <span class="pcoded-micon"><i
													class="ti-angle-right"></i></span> <span
												class="pcoded-mtext">Past</span> <span class="pcoded-mcaret"></span>
										</a></li>
									</ul></li>
								<li class=""><a href="venueHostAllEntertainers.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fa fa-user"></i><b>D</b></span> <span
										class="pcoded-mtext">Book Entertainers</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
								<li class=""><a href="venueHostVenueList.php"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fas fa-building"></i><b>D</b></span> <span
										class="pcoded-mtext">My Venues</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
							</ul>
							<div class="pcoded-navigation-label">ACCOUNT</div>
							<ul class="pcoded-item pcoded-left-item">
								<li class=""><a href="form-elements-component.html"
									class="waves-effect waves-dark"> <span class="pcoded-micon"><i
											class="fa fa-cog"></i><b>FC</b></span> <span
										class="pcoded-mtext">Settings</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
								<li class=""><a href="index.php" class="waves-effect waves-dark">
										<span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>FC</b></span>
										<span class="pcoded-mtext">Logout</span> <span
										class="pcoded-mcaret"></span>
								</a></li>
							</ul>
						</div>
					</nav>
					<div class="pcoded-content">
						<!-- Page-header start -->

						<!-- Page-header end -->
						<div class="pcoded-inner-content">
							<!-- Main-body start -->
							<div class="main-body">
								<div class="page-wrapper">
									<!-- Page-body start -->
									<div class="page-body">
										<div class="container">
											<div class="row">
												<div
													class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

													<div class="row">
														<div class="col-md-4 mx-auto">
															<div class="u-pull-half text-center"></div>
														</div>
													</div>

													<form action="createVenue.php" method="POST"
														enctype="multipart/form-data">

														<div class="form-group">
															<!-- Event Name -->
															<label for="venueName" class="control-label title2">Venue
																Name</label> <input type="text" class="form-control"
																style="border-bottom: 3px solid #fac668;" id="venueName"
																name="venueName" placeholder="Enter the venue's name"> <span
																class="error"> <?php echo $venueNameErr;?></span>

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
															<label for="venueProvince" class="control-label title2">Venue
																Province</label> <input type="text" class="form-control"
																style="border-bottom: 3px solid #fac668;"
																id="venueProvince" name="venueProvince"
																placeholder="Enter the venue's province">
														</div>
														<div class="form-group">
															<label for="venueDescription" class="title2">Venue
																Description</label>
															<textarea class="form-control" rows="5"
																style="border: 3px solid #fac668;" id="venueDescription"
																name="venueDescription"
																placeholder="Add a description for your venue"></textarea>
														</div>

														<div class="form-group">
															<label for="venueVideoEmbedCode"
																class="control-label title2">Video Embed Code</label> <input
																type="text" class="form-control"
																style="border-bottom: 2px solid #faa828;"
																id="venueVideoEmbedCode" name="venueVideoEmbedCode">
														</div>

														<div class="form-group">
															<label for="venuePicture" class="title2">Upload Venue
																Image</label> <input type="file" name="venuePicture">
														</div>


														<button type="submit" class="btn-all"
															style="display: inline;">Add</button>



														<a href="venueHostVenueList.php"><button class="btn-all"
																type="button" style="display: inline;">Cancel</button></a>


													</form>

												</div>
											</div>
										</div>
									</div>
									<!-- Page-body end -->
								</div>
								<div id="styleSelector"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Warning Section Starts -->
	<!-- Older IE warning message -->
	<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
	<!-- Warning Section Ends -->

	<!-- Required Jquery -->
	<script type="text/javascript"
		src="../assets/javascript/jquery/jquery.min.js "></script>
	<script type="text/javascript"
		src="../assets/javascript/jquery-ui/jquery-ui.min.js "></script>
	<script type="text/javascript"
		src="../assets/javascript/popper.js/popper.min.js"></script>
	<script type="text/javascript"
		src="../assets/javascript/bootstrap/js/bootstrap.min.js "></script>
	<!-- waves js -->
	<script src="../assets/pages/waves/js/waves.min.js"></script>
	<!-- jquery slimscroll js -->
	<script type="text/javascript"
		src="../assets/javascript/jquery-slimscroll/jquery.slimscroll.js"></script>

	<!-- slimscroll js -->
	<script
		src="../assets/javascript/jquery.mCustomScrollbar.concat.min.js "></script>

	<!-- menu js -->
	<script src="../assets/javascript/pcoded.min.js"></script>
	<script src="../assets/javascript/vertical/vertical-layout.min.js "></script>

	<script type="text/javascript" src="../assets/javascript/script.js "></script>
</body>

</html>
