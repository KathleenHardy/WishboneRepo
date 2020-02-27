<!DOCTYPE html>
<html>
<head>
<title>Entertainers List</title>
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
<?php 
include "navigationheaderVenueHost.php";
include ('../config.php');
include ('../dto/entertainer.php');



$entertainersDT0 = array();

$query1 = "SELECT entid, firstName, lastName, occupation, aboutMe
           FROM entertainers";

if ($stmt1 = $connection->prepare( $query1)) {
    
    //execute statement
    $stmt1->execute();
    
    //bind result variables
    $stmt1->bind_result( $entid, $firstName, $lastName, $occupation, $aboutMe);
    
    //fetch values
    while( $stmt1->fetch()) {
        
        $entertainer = new Entertainer();
        
        $entertainer->setEntID($entid);
        $entertainer->setFirstName($firstName);
        $entertainer->setLastName($lastName);
        $entertainer->setOccupation($occupation);
        $entertainer->setAboutMe($aboutMe);
        
        $entertainersDT0[] = $entertainer;
    }
    
    //close statement
    $stmt1->close();
}

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
								<h6 class="title-01__subTitle">entertainers</h6>
								<h2 class="title-01__title">BOOK YOUR ENTERTAINER</h2>
							</div>
														<!-- End / title-01 -->

						</div>
					</div>
				</div>
				
				<div class="consult-project">
					<div class="row">
					<?php
					   foreach( $entertainersDT0 as $entertainers) {
    					    print
    					    '
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
        							style="padding-left: 5px; padding-right: 5px;">
        							<div class="post-02 post-02__style-02 js-post-effect">
        								<div class="post-02__media">
        									<a href="#"><img src="../assets/img/projects/v-1.jpg" alt="" /></a>
        								</div>
        								<div class="post-02__body">
        									<h2 class="post-02__title" style="color: white;">
        										' . $entertainers->getFirstName() . '  ' . $entertainers->getLastName() . '
        									</h2>
        									<div class="post-02__department">' . $entertainers->getOccupation() . '</div>
        									<div class="post-02__content">
        												<div class="post-02__description">ABOUT ME: ' . $entertainers->getAboutMe() . '</div>
        									</div>
        									<span style="display: inline;"><a href="venueEntertainerPortfolio.php?entid=' . $entertainers->getEntID() . '"><button type="button">View More</button></a></span>
        									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
        								</div>
        							</div>
        						</div>

                            ';
    					}
    				?>

						<!-- 
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-2.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="media-entertainer">
									<a href="#"><img src="../assets/img/projects/v-3.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>
								
						</div>
						</div>
						
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-4.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-1.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-2.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>

															</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-3.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
									
								</div>
								</div>

						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 "
							style="padding-left: 5px; padding-right: 5px;">

							<div class="post-02 post-02__style-02 js-post-effect">
								<div class="post-02__media">
									<a href="#"><img src="../assets/img/projects/v-4.jpg" alt="" /></a>
								</div>
								<div class="post-02__body">
									<h2 class="post-02__title" style="color: white;">
										ENTERTAINER NAME
									</h2>
									<div class="post-02__department">OCCUPATION</div>
									<div class="post-02__content">
												<div class="post-02__description">ABOUT ME: Etiam non varius
											justo, vel tempor mi. Nulla facilisi. Fusce at tortor arcu.
											Suspendisse maximus ac nisl eu porta. Praesent eget consequat
											nisi, at mollis turpis. Quisque sed venenatis neque, at molli</div>
									</div>
									<span style="display: inline;"><a href="venueEntertainerPortfolio.php"><button type="button">View More</button></a></span>
									<span style="display: inline;"><a href="venueEventForm.php"><button type="button">Book Now</button></a></span>
								</div>
							</div>
                             -->

						</div>
					</div>
				</div>
					</div>
					
				</div>
			</section>
		
		
		
			
			<!-- End / Section -->
<?php include "footer.php" ?>
<?php
$_SESSION['entid']=$entertainers->getEntID(); 
?>

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
	
	<script type="text/javascript">
        function venueEntertainerPortfolio ( entid) {
            //find a way to access php object so I can populate entertainer detail page
        	location.href='entertainer-detail.html';
        }
    </script>
    
	<?php include "navigationHeadInclude2.php" ?>
</body>
</html>