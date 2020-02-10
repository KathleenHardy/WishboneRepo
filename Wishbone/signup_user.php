<!DOCTYPE html>
<html>
<head>
<title>User Registration</title>
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

<?php
include ('dao/authenticationDAO.php');
require_once ("config.php");

$hasError = false;
$authenticationDAO = new AuthenticationDAO();
$errorMessages = Array();

if (isset($_POST["userFirstName"]) || isset($_POST["userLastName"]) || isset($_POST["userEmail"]) || isset($_POST["userPwd"]) || isset($_POST["userConfirmPwd"])) {

    
    if ($_POST["userFirstName"] == "") {
        $hasError = true;
        $errorMessages['firstNameError'] = 'Please enter your first name';
    }

    if ($_POST["userLastName"] == "") {
        $hasError = true;
        $errorMessages['lastNameError'] = 'Please enter your last name';
    }

    if ($_POST["userEmail"] == "" || ! preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['userEmail'])) {
        $hasError = true;
        $errorMessages['EmailError'] = 'Please enter your first name';
    }

    if ($_POST["userPwd"] == "") {
        $hasError = true;
        $errorMessages['PasswordError'] = 'Please enter your password';
    }

    if (! preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $_POST["userPwd"])) {
        $hasError = true;
        $errorMessages['PasswordError'] = 'The password must contain at least one number, one alphabetic character, one special character, and suggested length is between 8 and 12';
    }

    if ($_POST["userPwd"] !== $_POST["userConfirmPwd"]) {
        $hasError = true;
        $errorMessages['userConfirmPwdError'] = 'Passwords need to be matched';
    }
    
     
    
    if (isset($_POST['reg_user'])) {
        $selected_radio = $_POST["userType"];
        
        if ($selected_radio == 'Entertainer') {
            $email = $_POST["userEmail"];
            $pass = $_POST["userPwd"];
            $firstName = $_POST["userFirstName"];
            $lastName = $_POST["userLastName"];      
            
            $sql = "INSERT INTO `authentication`(`email`, `pass`, `userType`) VALUES ('$email','$pass', 2)";
            if (mysqli_query($connection, $sql)) {
                #echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
            
            $sql2 = "select authid from authentication where email = '$email'";
            $result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
            
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                
                $row = mysqli_fetch_array($result);
                $authID = $row['authid'];

                $sql3 = "INSERT INTO `entertainers`(`authid`, `firstName`, `lastName`) VALUES ( $authID, '$firstName','$lastName')";
                if (mysqli_query($connection, $sql3)) {
                    #echo "New record created successfully";
                } else {
                    echo "Error: " . $sql3 . "<br>" . mysqli_error($connection);
                }
                
                
            } else {
                echo 'no value';
            }
            
        }
        
        else if ($selected_radio == 'Event Planner') {
            if (! $hasError) {
                $authentication = new Authentication($_POST["userFirstName"], $_POST["userLastName"], $_POST["userEmail"], $_POST["userPwd"]);
                $addSuccess = $authenticationDAO->addNewRegistrant($authentication);
                echo $addSuccess;
            }
        }
        else if ($selected_radio == 'Venues') {
        }
        
    }
   
        
        
    
    
}

?>
			<!-- header -->
		<header class="header">
			<div class="container">
				<div class="header__logo">
					<a style="color: #f39c12; font-size: 25px; font-weight: 700;"
						href="index.php">WISHBONE</a>
				</div>

				<!-- consult-nav -->
				<nav class="consult-nav">

					<!-- consult-menu -->
					<ul class="consult-menu">
						<li class="current-menu-item"><a href="index.php">Home</a></li>

						<li class="menu-item-has-children"><a href="entertainer.php">Entertainer</a>
							<ul class="sub-menu">
								<li><a href="entertainer.php">Find Entertainer</a></li>
								<li><a href="#">Become Entertainer</a></li>
							</ul></li>

						<li><a href="event.php">Events</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="about.html">Contact</a></li>
						<li><a href="login.php">log in / Sign up</a></li>
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
			<section class="md-section" style="padding-top: 80px;">
				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 offset-0 offset-sm-0 offset-md-0 offset-lg-1 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04"
								style="margin-bottom: 25px;">
								<h2 class="title-01__title">
									<span>User Registration</span>
								</h2>

								<div class="row">
									<div class="col-lg-3"></div>
									<div class="col-lg-6">
										<div class="widget-text__content">
											<!-- form-search -->
											<div class="form-search">
												<form
													action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
													method="post">
													<input id="userFirstName" name="userFirstName" type="text"
														class="form-control"
														placeholder="Please enter your first name" required>
														<?php
            if (isset($errorMessages['firstNameError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['firstNameError'] . '</span>';
            }
            ?>
														<input id="userLastName" name="userLastName" type="text"
														class="form-control"
														placeholder="Please enter your last name" required>
														<?php
            if (isset($errorMessages['lastNameError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['lastNameError'] . '</span>';
            }
            ?>
														<input id="userEmail" name="userEmail" type="email"
														class="form-control" placeholder="Please enter user email"
														required>
														<?php
            if (isset($errorMessages['EmailError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['EmailError'] . '</span>';
            }
            ?>             
														<input id="userPwd" name="userPwd" type="password"
														class="form-control" placeholder="Password" required>
														<?php
            if (isset($errorMessages['PasswordError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['PasswordError'] . '</span>';
            }
            ?> 
														<input id="userConfirmPwd" name="userConfirmPwd"
														type="password" class="form-control"
														placeholder="Confirm Password" required>
														<?php
            if (isset($errorMessages['userConfirmPwdError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['userConfirmPwdError'] . '</span>';
            }
            ?>
            											<label class="radio-inline"><input type="radio" name="userType" value="Entertainer" checked>Entertainer</label>
                                                        <label class="radio-inline"><input type="radio" name="userType" value="Event Planner">Event Planner</label>
                                                        <label class="radio-inline"><input type="radio" name="userType" value="Venues">Venues</label>
                                                        
														<div class="form__button">
														<button class="btn btn-primary btn-w180" type="submit"
															id="reg_user" , name="reg_user">Save</button>
														<a class="btn btn-primary btn-w180" href="index.php">cancel</a><br>

													</div>
												</form>
											</div>
											<!-- End / form-search -->
										</div>
									</div>
									<div class="col-lg-3"></div>
								</div>
							</div>
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