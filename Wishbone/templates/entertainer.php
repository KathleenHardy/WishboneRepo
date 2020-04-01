

<?php 

session_start();

include ('../config.php');
include ('../dto/entertainer.php');
include ('../dto/occupation.php');

$entertainersDTO = array();
$occupationsDTO = array();

$query1 = "SELECT entid, firstName, lastName, ratePerHour, profilePicture, aboutMe
           FROM entertainers
           WHERE NOT profilePicture ='' ";

if ($stmt1 = $connection->prepare( $query1)) {
    
    //execute statement
    $stmt1->execute();
    
    //bind result variables
    $stmt1->bind_result( $entid, $firstName, $lastName, $ratePerHour, $profilePicture, $aboutMe);
    
    //fetch values
    while( $stmt1->fetch()) {

        $entertainer = new Entertainer();
        
        $entertainer->setEntID($entid);
        $entertainer->setFirstName($firstName);
        $entertainer->setLastName($lastName);      
        $entertainer->setProfilePicture($profilePicture);
        $entertainer->setAboutMe($aboutMe);
        $entertainer->setRatePerHour($ratePerHour);
        
        $entertainersDT0[] = $entertainer;
    }
    
    //close statement
    $stmt1->close();  
}

$query2 = "SELECT entid, occupation FROM occupation";
if ($stmt2 = $connection->prepare( $query2)) {
    
    //execute statement
    $stmt2->execute();
    
    //bind result variables
    $stmt2->bind_result( $entid, $occupation);
    
    while ($stmt2->fetch()){
        $occupation_ = new Occupation();
        $occupation_->setEntertainerID( $entid);
        $occupation_->setOccupation( $occupation);
        
        $occupationsDTO[] = $occupation_;
    }
    
    //close statement
    $stmt2->close();
}

$connection->close();

/**
function sortEntertainer( $occupation) {
    $query1 = "SELECT entid, firstName, lastName, occupation, profilePicture, aboutMe
           FROM entertainers WHERE ";
    
    if ($stmt1 = $connection->prepare( $query1)) {
        
        //execute statement
        $stmt1->execute();
        
        //bind result variables
        $stmt1->bind_result( $entid, $firstName, $lastName, $occupation, $profilePicture, $aboutMe);
        
        //fetch values
        while( $stmt1->fetch()) {
            
            $entertainer = new Entertainer();
            
            $entertainer->setEntID($entid);
            $entertainer->setFirstName($firstName);
            $entertainer->setLastName($lastName);
            $entertainer->setOccupation($occupation);
            $entertainer->setProfilePicture($profilePicture);
            $entertainer->setAboutMe($aboutMe);
            
            $entertainersDT0[] = $entertainer;
        }
        
        //close statement
        $stmt1->close();
}
*/


?>

<!DOCTYPE html>
<html>
<head>
<title>Projects</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Fonts-->
<link rel="stylesheet" type="text/css"
	href="../assets/fonts/fontawesome/font-awesome.min.css">
<link rel="stylesheet" type="text/css"
	href="../assets/fonts/themify-icons/themify-icons.css">
<!-- Vendors-->
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/bootstrap4/bootstrap-grid.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
	integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
	crossorigin="anonymous">
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/magnific-popup/magnific-popup.min.css">
<link rel="stylesheet" type="text/css"
	href="../assets/vendors/owl.carousel/owl.carousel.css">
<!-- App & fonts-->
<link rel="stylesheet" type="text/css"
	href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;amp;subset=latin-ext">
<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
</head>

<body>
<?php
    include ("navigationBeforeLogin.php");
?>
	<div class="page-wrap">


		<!-- End / header -->

		<!-- Content-->
		<div class="md-content">

			<!-- Section -->
			<section class="md-section">
				<div class="container">

					<div class="row">

						<div class="col-md-4">
							<section class="widget-text__widget widget-text__style-02 widget">
								<h3 class="widget-title">Search</h3>
								<div class="widget-text__content">

									<!-- form-search -->
									<div class="form-search">
										<form action="create-gig.php">
											<input class="form-control" type="text"
												placeholder="Type and Hit Enter..." />
										</form>
									</div>
									<!-- End / form-search -->

								</div>
							</section>
							<!-- End / widget-text__widget -->

							<!-- widget-text__widget -->
							<section class="widget-text__widget widget-text__style-02 widget">
								<h3 class="widget-title">categories</h3>
								<div class="widget-text__content">
									<ul>
										<li><a href="#">All </a></li>
										<li><a href="#">Bands and musicians </a></li>
										<li><a href="#">Artists</a></li>
										<li><a href="#">Dancers</a></li>
										<li><a href="#">Cultural entertainment and Comedians</a></li>
										<li><a href="#">Photographer</a></li>
									</ul>
								</div>
							</section>
							<!-- End / widget-text__widget -->
						</div>

						<div class="col-md-8">
							<div class="row">
							
                            
							<?php 

							            foreach($entertainersDT0 as $entertainers) {
							                
							                $allOccupations=""; 
							                foreach($occupationsDTO as $occu) {
							                    if ( $entertainers->getEntID() == $occu->getEntertainerID()) {
							                        if ($allOccupations == "") {
							                            $allOccupations = $allOccupations. $occu->getOccupation() ;
							                        } else {
							                             $allOccupations = $allOccupations . " | ".  $occu->getOccupation() ;
							                        }
							                    }
							                };
							             
							            print 
							            '<div class="col-lg-4 col-md-6 mb-4">
									           <div class="card h-100">
										             <a href="#"><img class="card-img-top" src="../assets/img/profile/' . $entertainers->getProfilePicture() . '" alt="Card image" style="width:100%"></a>
										       <div class="card-body text-center">
											         <h2 class="post-02__title" style="color: #f39c12;">
												        <a href="#">' . $entertainers->getFirstName() . ' ' . $entertainers->getLastName() . '</a>
											         </h2>

											   <div class="post-02__department">'. $allOccupations .'</div>

    											<p class="card-text" style="margin-top: 10px;">
    												From <span>$' . $entertainers->getRatePerHour() . ' CAD</span> per hour
    											</p>

                                                <p class="card-text">' .$entertainers->getAboutMe(). '</p>    

    											<p style="margin-top: 50px;">
    												<a href="eventPlannerEntertainerPortfolio.php?id=' . $entertainers->getEntID() . '">
                                                            <button type="button" class="btn btn-default btn-block">View</button>
                                                    </a>
                                                        <br>
                                                    <a href="eventPlannerEventForm.php?id='. $entertainers->getEntID() . '"">
                                                            <button type="button" class="btn btn-default btn-block">Book Now</button>
                                                    </a>
    											</p>

        										</div>
        										<div class="card-footer">
        											<small class="text-muted"> &#9733; &#9733; &#9733;
        												&#9733; &#9734; <span>6</span>
        											</small>
        										</div>

        									</div>
        								</div>';
        							 }
							?>
								</div>

							</div>

							<div class="row">
								<div class="col-lg-12" style="margin-top: 60px;">
									<div class="text-center">
										<a class="btn btn-primary btn-w180" href="#">Load more</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end of Section -->

			</section>
			<!-- End / Section -->
		</div>

	</div>
	<!-- End / Content-->

	<!-- footer -->
	<?php include ("footer.php"); ?>		

	<!-- End / footer -->


	<script>
        function goToEntertainerDetailsPage () {
            //find a way to access php object so I can populate entertainer detail page
        	location.href='entertainer-detail.html';
        }
    </script>

	<!-- Vendors-->
	<script
		src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
		integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
		crossorigin="anonymous"></script>
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
</body>
</html>