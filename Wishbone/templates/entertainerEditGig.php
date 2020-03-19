<?php
$authId = $_SESSION['authId'];

/*
 if(isset($_FILES['fileToUpload'])) {
 
 //'../assets/img-temp/gigs/'
 $target_dir = "../assets/img-temp/portfolio/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 // Check if image file is a actual image or fake image
 if(isset($_POST["submit"])) {
 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 if($check !== false) {
 echo "File is an image - " . $check["mime"] . ".";
 $uploadOk = 1;
 } else {
 echo "File is not an image.";
 $uploadOk = 0;
 }
 }
 // Check if file already exists
 
 if (file_exists($target_file)) {
 echo "Sorry, file already exists.";
 $uploadOk = 0;
 }
 
 
 // Check file size
 if ($_FILES["fileToUpload"]["size"] > 500000) {
 echo "Sorry, your file is too large.";
 $uploadOk = 0;
 }
 
 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
 && $imageFileType != "gif" ) {
 echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
 $uploadOk = 0;
 }
 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
 echo "Sorry, your file was not uploaded.";
 // if everything is ok, try to upload file
 } else {
 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to ". $target_file;
 } else {
 echo "Sorry, there was an error uploading your file.";
 }
 }
 }
 */

if(isset($_FILES['fileToUpload'])){
    $errors= array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size =$_FILES['fileToUpload']['size'];
    $file_tmp =$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
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
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $query = "SELECT entid
               FROM entertainers
               WHERE  authid = ?";
    
    if ($stmt = $connection->prepare( $query)) {
        
        $stmt->bind_param( "i", $authId);
        
        //execute statement
        $stmt->execute();
        
        //bind result variables
        $stmt->bind_result($entid);
        
        // fetch values
        $stmt->fetch();
        
        //close statement
        $stmt->close();
    }
    
    
    
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
        
        
        $gigsImageLocation = basename($_FILES["fileToUpload"]["name"]);
        
        //execute statement
        $status = $stmt3->execute();
        
        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        } else {
            //header('Location: entertainerPortfolio.php');
            mysqli_close($connection);
        }
        //close statement
        $stmt3->close();
    }
    
}


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
    		<link rel="stylesheet" type="text/css" href="../assets/css/mainNew.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
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
                                        <a href="user-profile.html">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="auth-normal-sign-in.html">
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
                                            <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
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
                                    <a href="form-elements-component.html" class="waves-effect waves-dark">
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
								<h1 class="main-title">Edit Existing Gig</h1>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_selection" class="control-label title2">Select Gig to Update/Delete</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_selection" name="gigs_selection">
												<option value="Event">Gig1</option>
												<option value="Music">Gig2</option>
												<option value="Concert">Gig3</option>
											</select>					
										</div>
										
							<br/>
								<h3 class="main-title">Fill in Details to Update</h3>
								<p class="plain-text">Otherwise, click "Remove" button directly</p>
										<div class="form-group"> <!-- Gig Name -->
											<label for="gig_name_id" class="control-label title2">Gig Name</label>
											<input type="text" class="form-control" style="border-bottom: 2px solid #faa828;" id="gig_name_id" name="gigs_name" placeholder="Enter a name for your Gig">
										</div>	
										
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_category_id" class="control-label title2">Gig Category</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_category_id" name="gigs_category">
												<option value="Event">Event</option>
												<option value="Music">Music</option>
												<option value="Concert">Concert</option>
												<option value="Festival">Festival</option>
												<option value="Party">Party</option>
											</select>					
										</div>
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigs_label_id" class="control-label title2">Gig Label</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_label_id" name="gigs_label">
												<option value="Personal">Personal</option>
												<option value="Professional">Professional</option>
												<option value="Best">Best</option>
												<option value="Other">Other</option>
											</select>					
										</div>
										
										<div class="form-group"> <!-- Gigs category -->
											<label for="gigs_artType_id" class="control-label title2">Gig Art Type</label>
											<select class="form-control" style="border-bottom: 2px solid #faa828;" id="gigs_artType_id" name="gigs_artType">
												<option value="Musician">Musician</option>
												<option value="Dancer">Dancer</option>
												<option value="Painter">Painter</option>
												<option value="Actor">Actor</option>
												<option value="Model">Model</option>
												<option value="Singer">Singer</option>
												<option value="Photographer">Photographer</option>
												<option value="Blogger">Blogger</option>
											</select>					
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_details-id" class="title2">Gigs Details</label>
											<textarea class="form-control" style="border: 2px solid #faa828;" rows="5" id="gigs_details-id" name="gigs_details" placeholder ="Enter details"></textarea>
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigs_notes-id" class="title2">Notes</label>
											<textarea class="form-control" rows="5" style="border: 2px solid #faa828;" id="gigs_notes-id" name="gigs_notes" placeholder="Add notes"></textarea>
										</div>
										
										<div class="form-group">
										<label for="gigPhoto" class="title2">Upload New Gig Image</label>
										 
                                        <div class="input-group">
                                       	  <!--
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                          </div>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gigPhoto"
                                              aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                          </div>
                                           -->
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <input type="submit" value="Upload Image" name="submit">                                          
                                        </div>
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
											<a href="entertainerMainPortfolio.php"><button type="submit" name="submit" class="btn-all">Update</button></a>
											<a href="entertainerMainPortfolio.php"><button type="submit" name="submit" class="btn-all">Remove</button></a>
											<a href="entertainerMainPortfolio.php"><button type="button" class="btn-all">Cancel</button></a>

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

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
</body>

</html>
