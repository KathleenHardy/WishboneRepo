<?php

//require_once ('../config.php');
require_once ('../dto/venue.php');
session_start();
?>
<?php

include ('../config.php');
//include ('../dto/venue.php');
$venueDTO = $_SESSION['myVenues'];

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

$venueNameErr = "";
$startDateErr = "";
$endDateErr = "";
$startTimeErr = "";
$endTimeErr = "";
$startBeforeEndErr = "";

$venueName = "";
$startDate = "";
$endDate = "";
$startTime = "";
$endTime = "";
$availTitle = "";


$requiredFields=0;

if (! empty($_POST)) {
    
    if (($_POST["venueName"])=="Choose a Venue") {
        $venueNameErr = "Name is required";
    } else {
        $venueName = $_POST['venueName'];
        $requiredFields++;
    }
    
    if (empty($_POST["startDate"])) {
        $startDateErr = "Start date is required";
    } else {
        $startDate = $_POST['startDate'];
        $requiredFields++;
    }
    
    if (empty($_POST["endDate"])) {
        $endDateErr = "End date is required";
    } else {
        $endDate = $_POST['endDate'];
        $requiredFields++;
    }

    if (empty($_POST["startTime"])) {
        $startTimeErr = "Start time is required";
    } else {
        $startTime = $_POST['startTime'];
        $requiredFields++;
    }
    
    if (empty($_POST["endTime"])) {
        $endTimeErr = "End time is required";
    } else {
        $endTime = $_POST['endTime'];
        $requiredFields++;
    }
    
    $availTitle = $_POST['availTitle'];
    

   // $venueName = $_POST['venueName'];
    //$startDate = $_POST['startDate'];
    //$endDate = $_POST['endDate'];
    //$startTime = $_POST['startTime'];
    //$endTime = $_POST['endTime'];
    
    
    
//      $sql2 = "SELECT venueID
//             FROM venues
//             WHERE venueName='$venueName'";

    //get logged in auth id
    //$authId =  $_SESSION['authId'];
    //echo $authId;
    //fetch eventPlannerId based on authId
    
    if($requiredFields==5){
        
        //$diff=strtotime($startDate."".$startTime, $endDate."".$endTime);
        //$diff= strtotime ( $startDate."".$startTime, $endDate."".$endTime ) : int
        $begin=$startDate."".$startTime;
        $end=$endDate."".$endTime;
        
        $beginTimeStamp=strtotime($begin);
        $endTimeStamp=strtotime($end);
        

        
        $diff=$endTimeStamp-$beginTimeStamp;

        
        if($diff<0){
            $startBeforeEndErr = "Start time cannot be after end time";
        }
        else{
        
    $querya = 'SELECT venueId FROM venues WHERE venueName = ?';
    $stmta =mysqli_prepare ($connection,$querya);
    $stmta->bind_param('s', $venueName);
    $stmta->execute();
    $stmta->bind_result($chosenVenueId);
    $stmta->fetch();
    $stmta->close();
    
     
/*      //$db = new mysqli($host, $username, $password, $database_name); // connect to the DB
     $query = $connection->prepare("SELECT venueId FROM venues WHERE venueName=?"); // prepate a query
     $querya->bind_param('i', '$venueName'); // binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
     $query->execute(); // actually perform the query
     $result = $query->get_result(); // retrieve the result so it can be used inside PHP
     $r = $result->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
     //echo $r['price']; // will return the price
     $chosenVenueId=$r['venueId']; */

    
    /*if ($stmt = $connection->prepare( $sql2)) {
        
        $stmt->bind_param( "i", $venueName);
        
        //execute statement
        $stmt->execute();
        
        //bind result variables
        $stmt->bind_result( $chosenVenueId);
        
        // fetch values
        $stmt->fetch();
        
        //close statement
        $stmt->close();
        
    } */
    
     /* $venId = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
    //$chosenVenueId = mysql_fetch_array($venId);
    //$chosenVenueId=mysqli_fetch_field($venId);
     $result = mysqli_query($connection, $sql2);
     
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             $venue = new Venue($row['venueId'], $row['venueOwnerId'], $row['venueName'], $row['venueCity'], $row['venueState'], $row['venueProvince'], $row['venueDescription'], $row['venuePicture']);            
             $chosenVenueId=$venue->getVenueID();
             //echo "Name: " . $row["name"]. "<br>";
         }
     } else {
         echo "0 results";
     } */
    //echo $chosenVenueId;
    //mysql

    $sql = "INSERT INTO venueavailability(venueId, availStartDate, availEndDate, availStartTime, availEndTime, availTitle) 
VALUES( $chosenVenueId, '$startDate', '$endDate', '$startTime', '$endTime','$availTitle')";
    

    if (mysqli_query($connection, $sql)) {
        header('Location: venueAvailabilityCalendar.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
    }
    }
    //mysqli_close($connection);
    
//     $sql2 = "SELECT venueID 
//             FROM venues 
//             WHERE venueName=$venueName";
//     $chosenVenueID = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
    
    
    /* $sql3="SELECT availId
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
    $sql4="INSERT INTO resourceAvailability(availId, venueId)
            VALUES ($availId, $chosenVenueId)";
    
    $run = mysqli_query($connection, $sql4) or die(mysqli_error($connection)); */
    ?>
<!--     <script type="text/javascript"> -->
 <!--     window.location.href = 'http://localhost:7331/Wishbone/templates/venueHostVenueList.php';-->
 <!--    </script>-->
<?php

    
} 
$authId = $_SESSION['authId'];

$query = "SELECT venueOwnerId, firstName, lastName, imageLocation
          FROM venueowners
          WHERE  authid = ?";

if ($stmt = $connection->prepare( $query)) {
    
    $stmt->bind_param( "i", $authId);
    
    //execute statement
    $stmt->execute();
    
    //bind result variables
    $stmt->bind_result( $venueOwnerId, $firstName, $lastName, $imageLocation);
    
    // fetch values
    $stmt->fetch();
    
    //close statement
    $stmt->close();
    
}
mysqli_close($connection);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Availability</title>
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
                                    <span><?= $firstName. " " . $lastName ?></span>
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
                                        <span id="more-details"><?= $firstName. " " . $lastName ?><i class="fa fa-caret-down"></i></span>
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
<h1 class="main-title">
Add a Venue Availability


</h1>
				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

							<div class="row">
								<div class="col-md-4 mx-auto">
									<div class="u-pull-half text-center">
										
									</div>
								</div>
							</div>
							<form action="addVenueAvailability-New.php" method="POST">

								<div class="form-group">
									<!-- Event Name -->
									<label for="venueName" class="control-label title2">Venue Name</label>
										<select name="venueName">
										
        <option selected="venueName">Choose a Venue</option>
        
        <?php

        foreach($venueDTO as $venue){
        ?>
        <option value="<?php echo strtolower($venue->getVenueName()); ?>"><?php echo $venue->getVenueName(); ?></option>
        
        <?php
        }
        ?>
    </select>
    <span class="error"> <?php echo $venueNameErr;?></span>
    
								</div>
								<div class="form-group">
											<label for="availTitle" class="control-label title2">Availability Name</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="availTitle" name="availTitle">
										</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueCity" class="control-label title2">Availability Start Date</label>
									<input type="date" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="startDate"
										name="startDate" placeholder="Enter the start date of the avilability">
										<span class="error"> <?php echo $startDateErr;?></span>
										
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueCity" class="control-label title2">Availability End Date</label>
									<input type="date" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="endDate"
										name="endDate" placeholder="Enter the end date of the avilability">
										<span class="error"> <?php echo $endDateErr;?></span>
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueState" class="control-label title2">Availability Start Time
										</label> <input type="time" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="startTime"
										name="startTime">
										<span class="error"> <?php echo $startTimeErr;?></span>
								</div>
								<div class="form-group">
									<!-- Event Name -->
									<label for="venueProvince" class="control-label title2">Availability End Time
										</label> <input type="time" class="form-control"
										style="border-bottom: 3px solid #fac668;" id="endTime"
										name="endTime">
										<span class="error"> <?php echo $endTimeErr;?></span>
										<span class="error"> <?php echo $startBeforeEndErr;?></span>
								</div>

								<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->

<!-- 								<a href="venueHostVenueList.php"> -->


								<button type="submit" class="btn-all" style="display: inline;">Add</button>
<!-- 								</a> -->


								<a href="venueAvailabilityCalendar.php"><button class="btn-all"
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

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
</body>

</html>
