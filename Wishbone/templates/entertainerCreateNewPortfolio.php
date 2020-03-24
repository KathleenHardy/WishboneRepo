
<?php
session_start();
?>

<?php

require_once ("config.php");
include ('../enums/userType.php');
include ('../enums/profileStatus.php');

$authId = $_SESSION['authId'];

if(isset($_FILES['profilepic'])){
    $errors= array();
    $profilePic_file_name = $_FILES['profilepic']['name'];
    $profilePic_file_size =$_FILES['profilepic']['size'];
    $profilePic_file_tmp =$_FILES['profilepic']['tmp_name'];
    $profilePic_file_type=$_FILES['profilepic']['type'];
    
    $profilePic_file_path = "../assets/img/profile/";
    
    if($profilePic_file_size > 2097152){
        $errors[]='File size must be excatly 2 MB';
    }
    
    if(empty($errors)==true){
        move_uploaded_file($profilePic_file_tmp, $profilePic_file_path.$profilePic_file_name);
    }else{
        print_r($errors);
    }
}


if(isset($_FILES['bgimage'])){
    $errors= array();
    $bgPic_file_name = $_FILES['bgimage']['name'];
    $bgPic_file_size =$_FILES['bgimage']['size'];
    $bgPic_file_tmp =$_FILES['bgimage']['tmp_name'];
    $bgPic_file_type=$_FILES['bgimage']['type'];
    
    //$bgPic_file_path = "C:/xampp/htdocs/WishboneRepo/Wishbone/assets/img/backgrounds/";
    $bgPic_file_path = "../assets/img/backgrounds/";
    
    
    if($bgPic_file_size > 2097152){
        $errors[]='File size must be excatly 2 MB';
    }
    
    if(empty($errors)==true){
        move_uploaded_file($bgPic_file_tmp, $bgPic_file_path.$bgPic_file_name);
    }else{
        print_r($errors);
    }
}


function profileStatus() {
    
    if ( isset($_POST['hourlyrate']) && isset($_POST['occupation']) && isset($_POST['aboutme']) && isset($_POST['gigsdetails'])) {
        $result = ProfileStatus::COMPLETE;
    } else if ( isset($_POST['hourlyrate']) || isset($_POST['occupation']) || isset($_POST['aboutme']) || isset($_POST['gigsdetails'])) {
        $result = ProfileStatus::INCOMPLETE;
    }
    
    return $result;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $query = "UPDATE entertainers
                  SET ratePerHour = ?, workDescription = ?, profilePicture = ?, homePagePicture = ?, aboutMe = ?, myQuote = ?, profileStatus = ?
                  WHERE  authid = ?";
    
    if ($stmt = $connection->prepare( $query)) {
        $profileStatus = profileStatus();
        
        $stmt->bind_param( "dsssssii", $ratePerHour, $workDescription, $profilePicture, $homePagePicture, $aboutMe, $myQuote, $profileStatus, $authId);
        
        //Set params
        $ratePerHour = $_POST['hourlyrate'];
        $workDescription = $_POST['gigsdetails'];
        $profilePicture = basename($_FILES["profilepic"]["name"]);
        $homePagePicture = basename($_FILES["bgimage"]["name"]);
        $aboutMe = $_POST['aboutme'];
        $myQuote = $_POST['quote'];
        
        
        //execute statement
        $status = $stmt->execute();
        
        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        } else {
            //echo("<script>location.href = 'entertainerMainPortfolio.php?msg=$msg';</script>");
            //header("Location: entertainerMainPortfolio.php");
            mysqli_close($connection);
        }
        
        //close statement
        $stmt->close();
    }
    
    else {
        //  $fmsg = "Invalid Login Credentials.";
    }
    //close connection
    //$connection->close();   
  
    //echo $_REQUEST
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Something posted
        echo "i am here";
        if (isset($_POST['myOccupation'])) {
            // btnDelete
            echo "i am here - 2";
        } else {
            // Assume btnSubmit
        }
    }
  
}

// Handle AJAX request (start)
//print_r($_POST);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Material Able bootstrap admin template by Codedthemes</title>
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
    <!-- for the upload file css link 
		<link rel="stylesheet" type="text/css" href="..assets/css2/normalize.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/demo.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/component (2).css" />
		
		<script src="/code.jquery.com/jquery-2.1.0.min.js" type="text/javascript" ></script>
		-->
		
<!-- end -->		

    		<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     
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
                        <a href="entertainerDashboardHome.php">
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
                                        <a href="entertainerViewProfile-New.php">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="../logout.php">
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
                                            <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="../logout.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
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
                                    <a href="entertainerDashboardHome.php" class="waves-effect waves-dark">
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
                                            <a href="entertainerUpcomingEvents.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Upcoming</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="entertainerPastEvents.php" class="waves-effect waves-dark">
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
                                    <a href="entertainerMainPortfolio.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Portfolio</span>
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
                                    <a href="../logout.php" class="waves-effect waves-dark">
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

				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h1 class="main-title">CREATE YOUR PORTFOLIO</h1>
							</div>
							<form  action="entertainerCreateNewPortfolio.php" method="post" enctype="multipart/form-data">

										<div class="form-group"> <!-- Event Name -->
											<label for="hourlyrate" class="control-label title2">What's your hourly rate?</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="hourlyrate" name="hourlyrate">
										</div>
										<!--	 
										<div class="form-group">   
											<label for="occupation" class="control-label title2">What's your occupation as an entertainer?</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="occupation" name="occupation">
										</div>
										-->	
										<!-- code below is UI for adding more occupations -->
<div class="form-group">
<div class="occupations-list">
<h1 class="control-label title2" style="text-align: left;">What are your occupations?</h1>
<input type="text" id="occupationAdded" style="border-bottom: 2px solid #faa828;">
<br>
<p>Occupations Listed:</p>
<ol class="list-occupations" #id = "occupation" name="occupation"></ol>
<input class ="add-button-list" type='button' onclick='changeText2()' value='Add' />
</div>
</div>
                                        <!-- end of occupations list -->
                                 							
										<div class="form-group"> <!-- Gigs details -->
											<label for="aboutme" class="title2">Tell us about yourself</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="aboutme" name="aboutme" placeholder ="Anything you want"></textarea>
										</div>
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigsdetails" class="title2">Tell us about your work</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="gigsdetails" name="gigsdetails" placeholder ="Anything you want"></textarea>
										</div>										
										<div class="form-group"> <!-- Gigs details -->
											<label for="quote" class="title2">An inspirational quote or your favourite one</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="quote" name="quote" placeholder ="Anything you want"></textarea>
										</div>
										
										
										<!-- Code for creative file upload -->
										<div class="form-group">
				<label for ="eventpic" class="title2">Upload Your Profile Image</label>
					<input type="file" name="profilepic" id="profilepic" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="profilepic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose image&hellip;</span></label>
										
										</div>
												<div class="form-group">
				<label for ="eventpic" class="title2">Upload Your Background Image</label>
					<input type="file" name="bgimage" id="bgimage" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="bgimage"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose image&hellip;</span></label>
										
										</div>
										<!-- end -->
										
										
                                                       
										
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										<div style="text-align:center;">

										<input class ="btn-all" style="display:inline;" type='submit' id='submit' name='submit' value='Submit' />
										 
										</div>
										<!-- Replace buttons with below code -->
										<!--<div class="form-group" style="display:inline;"> 
											<a href="entertainerPortfolio.php"><button type="submit" class="btn-all">Create</button></a>
										</div> 
										<div class="form-group" style="display:inline;"> 
											<button class="btn-all">Cancel</button>
										</div>   -->
										
										 
							</form>
							</div>
							</div></div>

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
		<script src="../assets/js-other/custom-file-input.js"></script>

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
    
    <script>    

    var occupation = [];
    
    function changeText2() {
    	var occupationToAdd = $('#occupationAdded').val();

    	$('ol').append( '<li class = "items">' + occupationToAdd + '</li>' );

    	occupation.push( occupationToAdd)
    } 


    $(document).ready(function(){

    	$("#submit").on("click", function(){
        	
    		if ( occupation.length > 0) {
           	 $.ajax({
           			url: 'entertainerCreateNewPortfolio.php',
                    type: 'POST',
                    data: {myOccupation: occupation},
                    success: function(){
                   	console.log(occupation);
                    }
                   });
            }
    	 });
         /**
         $.ajax({
         type: 'post',
         url: 'entertainerCreateNewPortfolio.php',
         data: {occupation: JSON.stringify( occupation) },
         success: function(){
         alert (occupation);
         }
        });

         */   
        
      });

    
    </script> 
    <?php 
    
    ?>
</body>
</html>