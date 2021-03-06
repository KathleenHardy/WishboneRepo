<?php
session_start();
include ('../config.php');
$authId = $_SESSION['authId'];

$gigs_nameErr = $gigs_categoryErr = $gigs_labelErr = $gigs_artTypeErr = $gigs_detailsErr = "";

$createGigErr = array();

$entid = $_SESSION['entertainerid'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    if ( empty( $_POST["gigs_name"])) {
        $gigs_nameErr = "Please enter a name for your gig";
        $createGigErr[] = $gigs_nameErr;
    }
    
    if ( empty( $_POST["gigs_category"])) {
        $gigs_categoryErr = "Please specify a category for your gig";
        $createGigErr[] = $gigs_categoryErr;
    }
    
    if ( empty( $_POST["gigs_label"])) {
        $gigs_labelErr = "Please specify a label for your gig";
        $createGigErr[] = $gigs_labelErr;
    }

}

$query3 = "SELECT profileStatus, firstName, lastName, profilePicture
              FROM entertainers
              WHERE  authid = ?";

if ($stmt3 = $connection->prepare( $query3)) {
    
    $stmt3->bind_param( "i", $authId);
    
    //execute statement
    $stmt3->execute();
    
    //bind result variables
    $stmt3->bind_result( $profileStatus, $entFirstName, $entLastName, $profilePicture);
    
    // fetch values
    $stmt3->fetch();
    
    //close statement
    $stmt3->close();
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if ( empty( $_POST["gigs_artType"])) {
        $gigs_artTypeErr = "Please specify an art type for your gig";
        $createGigErr[] = $gigs_artTypeErr;
    }
    
    if ( empty( $_POST["gigs_details"])) {
        $gigs_detailsErr = "Please enter details for your gig";
        $createGigErr[] = $gigs_detailsErr;
    }
    
    if ( sizeof( $createGigErr) == 0) {

        $query2 = "INSERT INTO gigs
                  ( entid, gigsName, gigscategory, gigslabel, gigsArttype, gigsdetails, notes)
                  VALUES
                  (?,?,?,?,?,?,?)";
        
        if ($stmt2 = $connection->prepare( $query2)) {
            
            $stmt2->bind_param( "issssss", $entid, $gigsName, $gigsCategory, $gigsLabel, $gigsArtType, $gigsDetails, $gigsNotes);
            //Set params
            $gigsName = $_POST['gigs_name'];
            $gigsCategory = $_POST['gigs_category'];
            $gigsLabel = $_POST['gigs_label'];
            $gigsArtType = $_POST['gigs_artType'];
            $gigsDetails = $_POST['gigs_details'];
            $gigsNotes = $_POST['gigs_notes'];
            
            //execute statement
            $status = $stmt2->execute();
            
            if ($status === false) {
                trigger_error($stmt->error, E_USER_ERROR);
            } else {
                $insertedId = $stmt2->insert_id;
            }
            //close statement
            $stmt2->close();
        }
        
        
        if(isset($_FILES['image'])) {
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            //$file_path= $_SERVER['DOCUMENT_ROOT'] . "\\Wishbone\\assets\\img-temp\\portfolio\\";
            //$file_path = "C:/xampp/htdocs/WishboneRepo/Wishbone/assets/img-temp/portfolio/";
            
            $file_path = "../assets/img-temp/portfolio/";
            
            /*
             $file_ext=strtolower(end(explode('.', $file_name)));
             
             $extensions= array("jpeg","jpg","png");
             
             if(in_array($file_ext,$extensions)=== false){
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
             }
             */
            
            if($file_size > 2097152){
                $errors[]='File size must be excatly 2 MB';
            }
            
            if(empty($errors)==true){
                move_uploaded_file($file_tmp, $file_path.$file_name);
            }else{
                print_r($errors);
            }
            
            //upload gigs Image
            $query3 = "INSERT INTO gigsimages
                  ( gigsid, gigsImageLocation)
                  VALUES
                  (?,?)";
            
            if ($stmt3 = $connection->prepare( $query3)) {
                
                $stmt3->bind_param( "is", $insertedId, $gigsImageLocation);
                
                //Set params
                
                //$gigsImageLocation = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                //$gigsImageLocation = $target_file; //---------------------------------------
                
                
                $gigsImageLocation = basename($_FILES["image"]["name"]);
                
                //execute statement
                $status = $stmt3->execute();
                
                if ($status === false) {
                    trigger_error($stmt->error, E_USER_ERROR);
                } else {
                    header('Location: entertainerMainPortfolio.php');
                    mysqli_close($connection);
                }
                //close statement
                $stmt3->close();
            }
            
        }
        
        
    }
    
    
}

include ('../dto/notification.php');
$notificationDTO = array();
$_SESSION['notifications'] = array();

$getNotifications = "SELECT notificationId, notificationType, bookingRequestId, gigsid, event_date, requestorEmail, message
              FROM entertainerbookingnotifications
              WHERE  entid = ?";

if ($stmt2 = $connection->prepare( $getNotifications)) {
    
    $stmt2->bind_param( "i", $entid);
    
    //execute statement
    $stmt2->execute();
    
    //bind result variables
    $stmt2->bind_result( $notificationId, $notificationType, $bookingRequestId, $gigsid, $event_date, $requestorEmail, $message);
    
    //fetch values
    while( $stmt2->fetch()) {
        
        $notification = new Notification();
        
        $notification->setNotificationId( $notificationId);
        $notification->setNotificationType( $notificationType);
        $notification->setBookingRequestId($bookingRequestId);
        $notification->setGigsid($gigsid);
        $notification->setEventDate($event_date);
        $notification->setRequestorEmail($requestorEmail);
        $notification->setMessage( $message);
        
        $notificationDTO[] = $notification;
        array_push($_SESSION['notifications'], $notification);
    }
    
    
    
    
    //close statement
    $stmt2->close();
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Gig</title>
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
    		<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
    		<link rel="stylesheet" type="text/css" href="..assets/css2/normalize.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/demo.css" />
		<link rel="stylesheet" type="text/css" href="..assets/css2/component.css" />
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
                                    <?php 
                                    if ( sizeof( $notificationDTO) != 0) {
                                        print '<span class="badge bg-c-red"></span>';
                                    }
                                    ?> 
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <?php 
                                    if ( sizeof( $notificationDTO) != 0) {
                                        print '<label class="label label-danger">New</label>';
                                    }
                                    ?> 
                                        
                                    </li>
                                    <?php
                                        foreach($notificationDTO as $notifications) {
                                            print
                                            '
                                                <li class="waves-effect waves-light">
                                                    <div class="media">
                                                        <!-- <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-2.jpg" alt="Generic placeholder image"> -->
                                                        <div class="media-body">
                                                            <!-- <h5 class="notification-user">Event Planner: John Doe</h5> -->
                                                            <p class="notification-msg"><a href="entertainerNotificationDetails.php?id='. $notifications->getBookingRequestId() . '">' .$notifications->getMessage(). '</a></p>
                                                            <!-- <span class="notification-time">30 minutes ago</span> -->
                                                        </div>
                                                    </div>
                                                </li>
                                            ';
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
   <img src=<?= "../assets/img/profile/" . $profilePicture ?> class="img-radius-40" alt="User-Profile-Image">

                                    <span><?= $entFirstName. " " . $entLastName ?></span>
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
                                    <img class="img-80 img-radius" src=<?= "../assets/img/profile/" . $profilePicture ?> alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?= $entFirstName. " " . $entLastName ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="entertainerViewProfile-New.php"><i class="ti-user"></i>View Profile</a>
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
								<h1 class="main-title">Add New Gig</h1>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">

										<div class="form-group"> <!-- Gig Name -->
											<label for="gig_name_id" class="control-label title2">Gig Name</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="gig_name_id" name="gigs_name" placeholder="Enter a name for your Gig">
											<span class="error"><?php echo $gigs_nameErr;?></span>
										</div>	
										
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_category_id" class="control-label title2">Gig Category</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_category_id" name="gigs_category">
												<option value="" disabled selected="selected" >Select a category</option>
												<option value="Event">Event</option>
												<option value="Music">Music</option>
												<option value="Concert">Concert</option>
												<option value="Festival">Festival</option>
												<option value="Party">Party</option>
											</select>
											<span class="error"><?php echo $gigs_categoryErr;?></span>					
										</div>
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_label_id" class="control-label title2">Gig Label</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_label_id" name="gigs_label">
											    <option value="" disabled selected="selected" >Select a Label</option>
												<option value="Personal">Personal</option>
												<option value="Professional">Professional</option>
												<option value="Best">Best</option>
												<option value="Other">Other</option>
											</select>
											<span class="error"><?php echo $gigs_labelErr;?></span>					
										</div>
										
										<div class="form-group"> <!-- Gigs category -->
											<label for="gigs_artType_id" class="control-label title2">Gig Art Type</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_artType_id" name="gigs_artType">
											    <option value="" disabled selected="selected" >Select an art type</option>
												<option value="Musician">Musician</option>
												<option value="Dancer">Dancer</option>
												<option value="Painter">Painter</option>
												<option value="Actor">Actor</option>
												<option value="Model">Model</option>
												<option value="Singer">Singer</option>
												<option value="Photographer">Photographer</option>
												<option value="Blogger">Blogger</option>
											</select>
											<span class="error"><?php echo $gigs_artTypeErr;?></span>					
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_details-id" class="title2">Gigs Details</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="gigs_details-id" name="gigs_details" placeholder ="Enter details"></textarea>
											<span class="error"><?php echo $gigs_detailsErr;?></span>
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_notes-id" class="title2">Notes</label>
											<textarea class="form-control" rows="5" style="border: 2px solid #faa828;" id="gigs_notes-id" name="gigs_notes" placeholder="Add notes"></textarea>
										</div>
										
		<div class="form-group">
				<label for ="gigimage" class="title2">Upload Your Gig Image</label>
					<input type="file" name="image" id="gigimage" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="gigimage"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose image&hellip;</span></label>
										
										</div>
                                        
										<!--
										<div class="input-group">
											  <div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
											  </div>
												<input id="input-b1" name="input-b1" type="file" class="file" data-browse-on-zone-click="true"> 
										</div>
										for later -->
										 
										 <!--  
										<a href="entertainerPortfolio.php"><button type="button" class="btn-all" style="display:inline;">Create</button></a>
										 
										 
										<a href="entertainerPortfolio.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
										-->
										
										<br/>										
										<!-- Replace buttons with below code -->
										<div class="form-group" style="display:inline;"> 
											<a href="entertainerPortfolio.php"><button type="submit" name="submit" class="btn-all">Finish</button></a>
										</div> 
										<div class="form-group" style="display:inline;"> 
											<button class="btn-all">Cancel</button>
										</div>
										
										 
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
		<script src="../assets/js-other/custom-file-input.js"></script>

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
</body>

</html>
