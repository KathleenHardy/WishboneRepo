<!DOCTYPE html>
<html lang="en">

<head>
    <title>Entertainer Portfolio</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css2/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/jquery.mCustomScrollbar.css">
    <!-- font awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <!-- Style.css -->
            <link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css">
    <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
</head>

<body>
<?php 
session_start();
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
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="venueDashboardHome.php">
                            <h4 style="color:white;">WISHBONE</h4>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="../assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="venueHostProfileView.php">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="index.php">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="../assets/images/avatar-4.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details">John Doe<i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="venueHostProfileView.php"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="index.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 p-b-0">
                                <form class="form-material">
                                    <div class="form-group form-primary">
                                        <input type="text" name="footer-email" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Here</label>
                                    </div>
                                </form>
                            </div>
                            <div class="pcoded-navigation-label">NAVIGATION</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="venueDashboardHome.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="messages.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-email"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Messages</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>    
                                <li class="">
                                    <a href="bookmarks.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-bookmark"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Bookmarks</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="reviews.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-star"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Reviews</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">ORGANIZE AND MANAGE</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-list-alt"></i><b>BC</b></span>
                                        <span class="pcoded-mtext">Events</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="venueHostUpcomingEvents.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Upcoming</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="venueHostPastEvents.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Past</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="entertainerEventsCalendar.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-calendar"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Calendar</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>                                
                                <li class="">
                                    <a href="venueHostAllEntertainers.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Book Entertainers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> 
                                <li class="">
                                    <a href="venueHostVenueList.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fas fa-building"></i><b>D</b></span>
                                        <span class="pcoded-mtext">My Venues</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>                                                                                                
                            </ul>
                            <div class="pcoded-navigation-label">ACCOUNT</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="form-elements-component.html" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-cog"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Settings</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Logout</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
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

<div>
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
                      <i class="fab fa-facebook fa-2x"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Dribbble">
                    <a class="text-white" href="#!">
                      <i class="fab fa-dribbble fa-2x"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Linkedin">
                    <a class="text-white" href="#!">
                      <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <a class="text-white" href="#!">
                      <i class="fab fa-twitter fa-2x"></i>
                    </a>
                  </li>
                  <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <a class="text-white" href="#!">
                      <i class="fab fa-instagram fa-2x"></i>
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
                <img class="img-fluid u-avatar u-box-shadow-lg rounded-circle mb-3" width="300" height="300" src=<?= "../assets/img/profile/" . $profilePicture ?> alt="Image Description">
              </div>
            </div>
          </div>
          <!-- End Profile Block -->

          <!-- About and Contact -->
          <div class="row u-content-space-bottom">
            <div class="col-lg-12" style="text-align: center;">
              <h1 class="main-title">ABOUT ME</h1>
              <p class="h5" style="font-family: 'Averta'; text-align:center; color:#36454f;"><?= $aboutMe ?></p>
              <p class="h5" style="font-family: 'Averta'; text-align:center; color:#36454f;"><?= $myQuote ?></p>
              <p class="blockquote-footer"><?= $firstName . ' ' . $lastName . ', ' . $occupation?></p>
              <br/>
              <h1 class="main-title">CONTACT ME</h1>
              <p class="h5" style="font-family: 'Averta'; text-align:center; color:#36454f;">EMAIL: <?= $email ?></p>
            </div>
                    
          <!-- End About and Contact -->
        </div>
        </div>
      </section>
      <!-- End About Section -->
      <div class="container">
        <hr class="my-0">
      </div>

<!-- New Media section -->
          <div class="row u-content-space-bottom">
            <div class="col-lg-12" style="text-align: center;">
            <h1 class="main-title">MY MEDIA</h1>
            <p align="center">New Media Files Show Up Here</p>
            
            </div>
            </div>
<!-- end -->
      <div class="container">
        <hr class="my-0">
      </div>

      <!-- Portfolio -->
      <section class="u-content-space">
        <div class="container">
          <header class="text-center w-md-50 mx-auto mb-8">
            <h1 class="main-title">MY GIGS</h1>
            <p class="h5" style="font-family: 'Averta'; color:#005BAD;">I play soulful music for a variety of audiences to enjoy.</p>            
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
            <figure class="col-sm-6 col-md-4 u-portfolio__item shuffle_sizer"></figure>
          </div>
          <!-- End Work Content -->
        </div>
            <!-- End Portfolio -->
      <!--  Button to Add Gigs -->  
      <div class="buttons-section" style="text-align: center;">
<div class="button_entertainer" style="display: inline;" align="center"><a class="button_add_gigs" href="venueHostBookEvent.php">Book</a></div>
<div class="button_entertainer" style="display: inline;" align="center"><a class="button_add_gigs" href="venueHostAllEntertainers.php">Back</a></div>
 </div>

    </main>



</div>


                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
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
    <!-- Required Jquery -->
    <script type="text/javascript" src="../assets/javascript/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="../assets/javascript/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/javascript/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/javascript/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/javascript/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="../assets/javascript/jquery.mCustomScrollbar.concat.min.js "></script>

    <!-- menu js -->
    <script src="../assets/javascript/pcoded.min.js"></script>
    <script src="../assets/javascript/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
</body>

</html>
