<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Event</title>
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
    <?php
		session_start();
		 ?>
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
		<link rel="stylesheet" type="text/css" href="..assets/css2/normalize.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/demo.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/component.css" />
		
		</head>

<body>
<?php 

include ('../dto/venue.php');
include ('../dto/gig.php');
include ('../dto/eventPlanner.php');

include ('../dao/authenticationDAO.php');
require_once ("../config.php");

//get selected entainer id
if(isset($_GET["id"]))
{
	$entid = $_GET["id"];
	$_SESSION['entId'] = $entid;
}else
{
	$entid = $_SESSION['entId'];
}

 //get logged in auth id
 $authId = $_SESSION['authId'];
 //echo $authId;
 //fetch eventPlannerId based on authId
 $querya = 'SELECT venueOwnerId FROM venueowners WHERE authid = ?';
 $stmta =mysqli_prepare ($connection,$querya);
 $stmta->bind_param('s', $authId);
 $stmta->execute();
 $stmta->bind_result($venueOwnerID);
 $stmta->fetch();
 $stmta->close();

$venuesDTO = array();

$query2 = "SELECT * 
		FROM venues where venueOwnerId=".$venueOwnerID;
		
$result = mysqli_query($connection, $query2) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);
		
if ($count >= 1) {
		
	while ($row = mysqli_fetch_array($result)) {
	    $venuesDTO[] = new Venue($row['venueId'], $row['venueOwnerId'], $row['venueName'], $row['venueCity'], $row['venueState'], $row['venueProvince'], $row['venueDescription'], $row['venuePicture']);
	}
} else {
			// $fmsg = "No venues for this user";
}

$_SESSION['myVenues'] = $venuesDTO;

//gigs
$gigsDTO = array();

$query3 = "SELECT * 
		FROM gigs where entid=".$entid;
		
$result2 = mysqli_query($connection, $query3) or die(mysqli_error($connection));

$count2 = mysqli_num_rows($result2);
		
if ($count2 >= 1) {
		
	while ($row = mysqli_fetch_array($result2)) {
		
		$gigsDTO[] = new Gig  ($row['gigsid'], $row['gigsName'], $row['gigsCategory'], $row['gigsLabel'], $row['gigsArtType'], $row['gigsDetails'],$row['notes']);
	
	}
} else {
			// $fmsg = "No venues for this user";
}

$_SESSION['myGigs'] = $gigsDTO;

//event planner

$eventPlannerDTO = array();

$query4 = "SELECT * FROM eventplanners;";
		
$result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));

$count3 = mysqli_num_rows($result4);
		
if ($count3 >= 1) {
		
	while ($row = mysqli_fetch_array($result4)) {
		$eventPlannerDTO[] = new EventPlanner  ($row['eventPlannerId'], $row['authid'], $row['firstName'], $row['lastName'], $row['imageLocation']);
	
	}
} else {
			// $fmsg = "No venues for this user";
}

$_SESSION['myEventPlanners'] = $eventPlannerDTO;





//connection object from config file

$hasError = false;
$errorMessages = Array();

//cehcks if value is set after button clic or not
if(isset($_POST["eventName"]) || isset($_POST["eventDate"]) || isset($_POST["eventDescription"]))   
{
  
    
    if ($_POST["eventName"] == "") {
        $hasError = true;
        $errorMessages['eventName'] = 'Please enter event name';
    }

    if ($_POST["eventDate"] == "") {
        $hasError = true;
        $errorMessages['eventDate'] = 'Please enter event date';
    }

    if ($_POST["eventDescription"] == "") {
        $hasError = true;
        $errorMessages['eventDescription'] = 'Please enter event description';
    }
    
    
  
        if (! $hasError) {
           

			

            //fetch venueOwnerId from vanues based on venueId
            $venue_id = $_POST["venueSelection"];
            $queryVenueOwner = 'SELECT venueOwnerId FROM venues WHERE venueId = ?';
            $stmta = mysqli_prepare ($connection,$queryVenueOwner);
            $stmta->bind_param('s', $venue_id);
            $stmta->execute();
            $stmta->bind_result($venueOwnerId);
            $stmta->fetch();
            $stmta->close();
        
            
			$resAvailId = '1';
            
            //get selected gig id
			$gigsid = $_POST["gigSelection"];
			
			//$eventplannerID = $_POST["eventplannerSelection"];
            
            //get evenet name
            $event_name = $_POST["eventName"];
            
            //get event date
            $event_date = date($_POST["eventDate"]);
            
            //get event description
            $event_description = $_POST["eventDescription"];
            
            //query to insrt into bookedgigs
            $query = "insert into bookingrequests(entid,gigsid,eventPlannerId,venueOwnerId,venueId,event_name,event_date,event_description) 
values(".$_SESSION['entId'].",".$gigsid.",1,".$venueOwnerId.",".$venue_id.",'".$event_name."','".$event_date."','".$event_description."');";
            echo $query;
           //if success then show success msg else show error msg
            $conn =   mysqli_query($connection,$query);
            if($conn  === TRUE)
            {
                $last_id = mysqli_insert_id($connection);
                
                
                echo $_SESSION['entId'];
                $querya = 'SELECT email FROM authentication WHERE authid = (select authid from entertainers where entid = ?)';
                $stmta =mysqli_prepare ($connection,$querya);
                $stmta->bind_param('s',$_SESSION['entId']);
                $stmta->execute();
                $stmta->bind_result($entertainerEmail);
                $stmta->fetch();
                $stmta->close();
                
                
                //   echo '<script>document.write(shortUrl);</script>';
                // the message
                $url = $_SERVER['REQUEST_URI'];
                $shortUrl = substr($url,0, strrpos($url, '/'));
                $server = "http://localhost";
                $htmlContent = '
    <html>
    <head>
        <title>Welcome to Wishbone</title>
    </head>
    <body>
        <h1>Thanks you for joining with us!</h1>
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">
            <tr>
                <th>WishBone
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>You got a new Booking Request</td>
            </tr>
            <tr>
    
                <th>Website:</th><td><a href="'.$server.$shortUrl .'/entertainerNotificationDetails.php?id='.$last_id.'">Click here to Review Booking Request</a></td>
            </tr>
        </table>
    </body>
    </html>';
                
                
                // Set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                echo $entertainerEmail;
                // send email
                mail($entertainerEmail,"Wishbone", $htmlContent,$headers);
                ?> <script type="text/javascript">
             window.location.href = 'venueEventConfirmation.php';
           
              </script>
               <?php
               
               /*
               echo("<script>location.href = 'eventPlannerEventConfirmation.php?msg=$msg';</script>");
               */
           }else {
               echo "<script type='text/javascript'>alert('".mysqli_error($connection)."');</script>";
               echo mysqli_error($connection);
           }
            
         }
    //testing.test@1.com
    
}


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
                            <h4 style="color: white;">WISHBONE</h4>
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
                                    <a href="venueAvailabilityCalendar.php" class="waves-effect waves-dark">
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
				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h1 class="main-title">PLAN YOUR EVENT</h1>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="POST">

										<div class="form-group"> <!-- Event Name -->
											<label for="eventName" class="control-label title2">Event Name</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="eventName" name="eventName" placeholder="Enter a name for your event">
											<span class="error"><?php 
											if(isset($errorMessages['eventName']))
											echo $errorMessages['eventName'];?></span>
										</div>	
										<div class="form-group"> <!-- Event Name -->
											<label for="eventDate" class="control-label title2">Event Date/Time</label>
											<input type="date" class="form-control" style="border-bottom: 2px solid #faa828;" id="eventDate" name="eventDate" placeholder="Enter the date/time of event">
											<span class="error"><?php 
											if(isset($errorMessages['eventDate']))
											echo $errorMessages['eventDate'];?></span>
										</div>	
									
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigSelection" class="control-label title2">Select Your Gig (based on entertainer)</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigSelection" name="gigSelection">
											<?php

											foreach($gigsDTO as $gig){
											?>
											<option value="<?php echo $gig->getGigsID() ?>"><?php echo $gig->getGigsName(); ?></option>
											<?php
											}
											?>
											</select>					
										</div>		
																	
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="venueSelection" class="control-label title2">Select Your Venue</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="venueSelection" name="venueSelection">
											<?php

											foreach($venuesDTO as $venue){
											?>
											<option value="<?php echo $venue->getVenueID() ?>"><?php echo $venue->getVenueName(); ?></option>
											<?php
											}
											?>
											</select>
										</div>
										<div class="form-group"> <!-- Gigs details -->
											<label for="eventDescription" class="title2">Event Description</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="eventDescription" name="eventDescription" placeholder ="Enter details"></textarea>
											<span class="error"><?php 
											if(isset($errorMessages['eventDescription']))
											echo $errorMessages['eventDescription'];?></span>
										</div>
												<div class="form-group">
				<label for ="eventpic" class="title2">Upload Your Event Image</label>
					<input type="file" name="file-1[]" id="eventpic" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="eventpic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose image&hellip;</span></label>
										
										</div>
										
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										 
										<input  class="btn-all" style="display:inline;" type=SUBMIT value="Submit">
										 
										
										 
										<a href="venueHostAllEntertainers.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
										
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
</body>

</html>



<!-- 
	<div class="form-group" style="padding: 20px;"> <!-- Event Planner -->
<!-- 										<label for="eventplannerSelection" class="control-label title2">Select Your Event Planner</label> -->
					<!--						<select class="form-control" style="border-bottom: 2px solid #faa828;" id="eventplannerSelection" name="eventplannerSelection">  -->
				<!-- 							<?php 

// 												foreach($eventPlannerDTO as $eventplanner){
// 												?>
												<option value="<?php echo $eventplanner->getEventPlannerID() ?>"><?php echo $eventplanner->getFirstName()." ".$eventplanner->getLastName() ?></option>
												<?php
// 												}
// 												?>

											</select>		-->			
										</div>	
  -->
