<!DOCTYPE html>
<html lang="en" class="no-js">
  <!-- Head -->
  <head>
    <title>Entertainer Portfolio</title>

    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="Bootstrap Theme, Freebies, UI Kit, MIT license">
    <meta name="description" content="Stream - UI Kit">
    <meta name="author" content="htmlstream.com">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Web Fonts -->
    <link href="//fonts.googleapis.com/css?family=Playfair+Display:400,700%7COpen+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Styles -->
    <link rel="stylesheet" type="text/css" href="../assets/vendors/bootstrap/css/bootstrap.css">

    <!-- Components Vendor Styles -->
    <link rel="stylesheet" type="text/css" href="../assets/vendors/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendors/magnific-popup/magnific-popup.css">

    <!-- Theme Styles -->
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    
    <!-- Button Styles -->
    <link rel="stylesheet" type="text/css" href="../assets/css/buttonEffects.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet" />
    
    
		<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css" /> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <!-- End Head -->

  <body>
<?php 
session_start();
include "navigationheaderVenueHost.php"; 
include ('../config.php');
require_once ('../dto/gig.php');

$_SESSION['entid']=$_GET['entid'];
$entid = $_SESSION['entid'];

$query = "SELECT authid, firstName, lastName, ratePerHour, occupation, workDescription, profilePicture, homePagePicture, aboutMe, myQuote, profileStatus
          FROM entertainers
          WHERE  entid = ?";

if ($stmt = $connection->prepare( $query)) {
    
    $stmt->bind_param( "i", $entid);
    
    //execute statement
    $stmt->execute();
    
    //bind result variables
    $stmt->bind_result($authId, $firstName, $lastName, $ratePerHour, $occupation, $workDescription, $profilePicture, $homePagePicture, $aboutMe, $myQuote, $profileStatus);
    
    // fetch values
    $stmt->fetch();
    
    //close statement
    $stmt->close();
    
}

$myGigs = array();
$query2 = "SELECT gigsid, gigsName, gigsCategory, gigsLabel, gigsArtType, gigsDetails, notes
           FROM gigs
           WHERE  entid = ?";

if ($stmt2 = $connection->prepare( $query2)) {
    
    $stmt2->bind_param( "i", $entid);
    
    //execute statement
    $stmt2->execute();
    
    //bind result variables
    $stmt2->bind_result($gigsid, $gigsName, $gigsCategory, $gigsLabel,  $gigsArtType, $gigsDetails, $gigsNotes);
    
    // fetch values
    while( $stmt2->fetch()) {
        
        $myGigs[] = new Gig( $gigsid, $gigsName, $gigsCategory, $gigsLabel, $gigsArtType, $gigsDetails, $gigsNotes);
        
    }
    
    //close statement
    $stmt2->close();
}

$myGigsPictures = array();

foreach( $myGigs as $gigs) {
    $query3 = "SELECT gigsImageLocation
              FROM gigsImages
              WHERE  gigsid = ?";
    
    if ($stmt3 = $connection->prepare( $query3)) {
        $gigsId = $gigs->getGigsID();
        
        $stmt3->bind_param( "i", $gigsId);
        
        //execute statement
        $stmt3->execute();
        
        //bind result variables
        $stmt3->bind_result($gigsImageLocation);
        
        // fetch values
        while( $stmt3->fetch()) {
            $myGigsPictures[] = $gigsImageLocation;
        }
        
        $gigs->addGigsPictures($myGigsPictures);
        
        unset($myGigsPictures);
        $myGigsPictures = array();
        
        //close statement
        $stmt3->close();
        
    }
    
}


$query4 = "SELECT email
          FROM authentication
          WHERE  authid = ?";

if ($stmt4 = $connection->prepare( $query4)) {
    
    $stmt4->bind_param( "i", $authId);
    
    //execute statement
    $stmt4->execute();
    
    //bind result variables
    $stmt4->bind_result($email);
    
    // fetch values
    $stmt4->fetch();
    
    //close statement
    $stmt4->close();
    
}



$connection->close();


?>
    
    
    
    

      <!-- Promo Block -->
      <section class="js-parallax u-promo-block u-promo-block--mheight-500 u-overlay u-overlay--dark text-white" style="background-image: url(../assets/img-temp/1920x1080/img5.jpg);">
        <!-- Promo Content -->
        <div class="container u-overlay__inner u-ver-center u-content-space">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="text-center">
                <h1 class="display-sm-4 display-lg-3"><?= $firstName . ' ' . $lastName  ?></h1>
                <p class="h6 text-uppercase u-letter-spacing-sm mb-2"><?= $occupation ?></p>

                <ul class="list-inline text-center mb-0">
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Facebook">
                    <a class="text-white" href="#!">
                      <i class="fab fa-facebook"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Dribbble">
                    <a class="text-white" href="#!">
                      <i class="fab fa-dribbble"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Linkedin">
                    <a class="text-white" href="#!">
                      <i class="fab fa-linkedin"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <a class="text-white" href="#!">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <a class="text-white" href="#!">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- End Promo Content -->
      </section>
      <!-- End Promo Block -->
    </header>
    <!-- End Header -->

    <main role="main">
      <!-- About Section -->
      <section>
        <div class="container">
          <!-- Profile Block -->
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="u-pull-half text-center">
                <img class="img-fluid u-avatar u-box-shadow-lg rounded-circle mb-3" width="200" height="auto" src="../assets/img-temp/200x200/img1.jpg" alt="Image Description">
              </div>
            </div>
          </div>
          <!-- End Profile Block -->

          <!-- About and Contact -->
          <div class="row u-content-space-bottom">
            <div class="col-lg-12" style="text-align: center;">
              <h2 class="mb-3 h1" style="font-family: 'Archivo', sans-serif; text-align:center; font-weight: bold; color:#fac668;">ABOUT ME</h2>
              <p class="h5" style="font-family: 'Archivo', sans-serif; text-align:center; color:white;"><?= $aboutMe ?></p>
              <p class="h5" style="font-family: 'Archivo', sans-serif; text-align:center; color:white;"><?= $myQuote ?></p>
              <p class="blockquote-footer"><?= $firstName . ' ' . $lastName . ', ' . $occupation?></p>
              <br/>
              <h2 class="mb-3 h1" style="font-family: 'Archivo', sans-serif; text-align:center; font-weight: bold; color:#fac668;">CONTACT ME</h2>
              <p class="h5" style="font-family: 'Archivo', sans-serif; text-align:center; color:white;">EMAIL: <?= $email ?></p>
            </div>
                    
          <!-- End About and Contact -->
        </div>
        </div>
      </section>
      <!-- End About Section -->

      <div class="container">
        <hr class="my-0">
      </div>

      <!-- Portfolio -->
      <section class="u-content-space">
        <div class="container">
          <header class="text-center w-md-50 mx-auto mb-8">
            <h2 class="h1" style="font-family: 'Archivo', sans-serif; font-weight: bold; color:#fac668;">MY GIGS</h2>
            <p class="h5" style="font-family: 'Archivo', sans-serif; color:white;">I play soulful music for a variety of audiences to enjoy.</p>            
          </header>

          <ul class="js-shuffle-controls u-portfolio-controls text-center mb-5">
            <li class="u-portfolio-controls__item"><a href="#!" data-group="all" class="active">ALL</a></li>
            <li class="u-portfolio-controls__item"><a href="#!" data-group="its-illustration">PERSONAL</a></li>
            <li class="u-portfolio-controls__item"><a href="#!" data-group="its-design">PROFESSIONAL</a></li>
            <li class="u-portfolio-controls__item"><a href="#!" data-group="its-graphic">BEST</a></li>
            <li class="u-portfolio-controls__item"><a href="#!" data-group="its-logo">OTHER</a></li>
          </ul>

          <!-- Work Content -->
          <div class="js-shuffle u-portfolio row no-gutters mb-6">
          
          
          <?php 
          foreach( $myGigs as $gigs) {
              $picArray = $gigs->getGigsPictures();
              $imgSrc = reset( $picArray);
              
              print
              '<figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups=' . "[\"" . $gigs->getGigsLabel() . "\"]" . '>
    		      <img class="u-portfolio__image" src=' ."../assets/img-temp/portfolio/" . $imgSrc . ' alt="Image Description">
    				 <figcaption class="u-portfolio__info">
                        <h6 class="mb-0">' . $gigs->getGigsName() . '</h6>
                        <small class="d-block">' . $gigs->getGigsCategory() . '</small>
    				 </figcaption>
                     <a class="js-popup-image u-portfolio__zoom" href=' ."../assets/img-temp/portfolio/" . $imgSrc . '>Zoom</a>
               </figure>
               ';
          }
          
          ?>
          <!--
            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-illustration"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img1.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">Gig Name</h6>
                <small class="d-block">Gig Category</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img1.jpg">Zoom</a>
            </figure>

            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-design"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img2.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">Bottle Design</h6>
                <small class="d-block">Mockup</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img2.jpg">Zoom</a>
            </figure>

            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-graphic"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img3.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">App Developement</h6>
                <small class="d-block">Åpp</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img3.jpg">Zoom</a>
            </figure>

            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-logo"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img4.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">Just Bored</h6>
                <small class="d-block">Freetime</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img4.jpg">Zoom</a>
            </figure>

            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-illustration"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img5.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">Cake Lab</h6>
                <small class="d-block">Graphic</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img5.jpg">Zoom</a>
            </figure>

            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups='["its-graphic"]'>
              <img class="u-portfolio__image" src="../assets/img-temp/portfolio/img6.jpg" alt="Image Description">
              <figcaption class="u-portfolio__info">
                <h6 class="mb-0">NB Project</h6>
                <small class="d-block">Logo</small>
              </figcaption>
              <a class="js-popup-image u-portfolio__zoom" href="../assets/img-temp/portfolio/img6.jpg">Zoom</a>
            </figure>
            -->



            <!-- sizer -->
            
            <figure class="col-sm-6 col-md-4 u-portfolio__item shuffle_sizer"></figure>
          </div>
          <!-- End Work Content -->
        </div>
            <!-- End Portfolio -->
         <div class="row">
         <div class="col-md-12" style="text-align: center;">   
           <a href="venueEventForm.php"><button type="button" style="display:inline; padding: 8px 20px; background: #fac668; border: 0; outline: none; border-radius: 25px; color: #fff; font-size: 20px;">Book</button></a>
           <a href="venueEntertainerList.php"><button type="button" style="display:inline; padding: 8px 20px; background: #fac668; border: 0; outline: none; border-radius: 25px; color: #fff; font-size: 20px;">Back</button></a>

    </div>
    </div>
    </main>

    <!-- Footer -->
        <?php include "footer.php" ?>
    <!-- End Call Us Modal Window -->

    <!-- JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
    <!-- Global Vendor -->
    <script src="../assets/vendors/jquery.min.js"></script>
    <script src="../assets/vendors/jquery.migrate.min.js"></script>
    <script src="../assets/vendors/popper.min.js"></script>
    <script src="../assets/vendors/bootstrap/js/bootstrap.min.js"></script>

    <!-- Components Vendor  -->
    <script src="../assets/vendors/jquery.parallax.js"></script>
    <script src="../assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="../assets/vendors/shuffle/jquery.shuffle.min.js"></script>

    <!-- Theme Settings and Calls -->
    <script src="../assets/js/global.js"></script>

    <!-- Theme Components and Settings -->
    <script src="../assets/js/vendors/parallax.js"></script>
    <script src="../assets/js/vendors/magnific-popup.js"></script>
    <script src="../assets/js/vendors/shuffle.js"></script>
    <!-- END JAVASCRIPTS -->
  </body>
  <!-- End Body -->
</html>