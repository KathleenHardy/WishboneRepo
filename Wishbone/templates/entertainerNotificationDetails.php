<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notification Details</title>
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
    <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
</head>

<body>
    <?php
        session_start();

        include ('../config.php');
        
        $firstName= $_SESSION['entertainerfirstname'];
        $lastName=$_SESSION['entertainerlastname'];
        $entid=$_SESSION['entertainerid'];
        $profilePicture =$_SESSION['entertainerProfilePicture'];
        
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
        
    
        if(isset($_SESSION['authId']) )
        {
            $requestID = $_GET["id"];

            $query2 = "SELECT * 
                    FROM bookingrequests where bookingReqId = ".$requestID;
                    
            $result = mysqli_query($connection, $query2) or die(mysqli_error($connection));
            
            $count = mysqli_num_rows($result);
                    
            if ($count >= 1) {
                    
                while ($row = mysqli_fetch_array($result)) {

                    $entid = $row["entid"];

        
                    $querya = 'SELECT authId FROM entertainers WHERE entid = ?';
                    $stmta =mysqli_prepare ($connection,$querya);
                    $stmta->bind_param('s', $entid);
                    $stmta->execute();
                    $stmta->bind_result($authid);
                    $stmta->fetch();
                    $stmta->close();
        
                    if($authid == $_SESSION['authId']){

                        $eventName = $row["event_name"];

                        $eventDate = $row["event_date"];
        
                        $eventDescription = $row["event_description"];
                    

                        $gigssid = $row["gigsid"];

                        $eventPlannerId = $row["eventPlannerId"];
    
                        $entid = $row["entid"];
    
                        $venueOwnerId = $row["venueOwnerId"];
    
                        $venueid = $row["venueid"];
                        
                        $contactEmail = $row["eventPlannerEmail"];

                        if(isset($_POST['accept']))
                        { 
                        //query to insrt into bookedgigs
                        $query = "insert into bookedgigs(entid,gigsid,eventPlannerId,venueOwnerId,venueId,event_name,event_date,event_description) 
                        values(".$entid.",".$gigssid.",".$eventPlannerId.",".$venueOwnerId.",".$venueid.",'".$eventName."','".$eventDate."','".$eventDescription."');";

                                //if success then show success msg else show error msg
                                $conn =   mysqli_query($connection,$query);
                                    if($conn  === TRUE)
                                    {
                                        ?>
                                        <script type="text/javascript">
                                        alert("Booking Accept        ed!");
                                        window.location.href = 'entertainerDashboardHome.php';
                                        </script>
                                        <?php
                                    }else  {
                                        echo "<script type='text/javascript'>alert('".mysqli_error($connection)."');</script>";
                                        echo mysqli_error($connection);
                                    }
                                    
                                    

                        }
                        else if(isset($_POST['reject']))
                        {
                            ?>
                            <script type="text/javascript">
                            alert("Booking Rejected!");
                            window.location.href = 'entertainerDashboardHome.php';
                            </script>
                            <?php
                        }
                        
                       

                    $queryb = 'SELECT gigsName FROM gigs WHERE gigsid = ?';
                    $stmta =mysqli_prepare ($connection,$queryb);
                    $stmta->bind_param('s', $gigssid);
                    $stmta->execute();
                    $stmta->bind_result($gig);
                    $stmta->fetch();
                    $stmta->close();
        
                    
                    $querya = 'SELECT venueName FROM venues WHERE venueid = ?';
                    $stmta =mysqli_prepare ($connection,$querya);
                    $stmta->bind_param('s', $venueid);
                    $stmta->execute();
                    $stmta->bind_result($venue);
                    $stmta->fetch();
                    $stmta->close();
                    
                    $querya = 'SELECT firstName,lastName FROM eventPlanners WHERE eventPlannerId = ?';
                    $stmta =mysqli_prepare ($connection,$querya);
                    $stmta->bind_param('s', $eventPlannerId);
                    $stmta->execute();
                    $stmta->bind_result($first,$last);
                    $stmta->fetch();
                    $stmta->close();
                
                    $eventPlanner = $first." ".$last;

                    
                        

                    }
                    else
                    {
                        //this request is not for this current logged in entertainer
                        ?>

                        <script type="text/javascript">
                        window.location.href = 'index.php';
                        </script>
        
                        <?php
                    }
                
                }
            } else {
                        // $fmsg = "No venues for this user";
            }
            
            
    

        
                    
            mysqli_close($connection);
            
        }
        else
        {
                //if not logged in then redirect to login
                ?>

                <script type="text/javascript">
                window.location.href = 'login.php';
                </script>

                <?php
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
                        <a href="entertainerDashboardHome.php">
                            <h4>WISHBONE</h4>
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
                                        <span id="more-details"><?= $firstName. " " . $lastName ?><i class="fa fa-caret-down"></i></span>
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

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">



<h1 class="main-title">Your Booking Notification</h1>      
<br/>
<br/>   
 <div class="center" style ="padding: 30px;">


 <div class="card text-center notification-card">
   <img class="card-img-top event-img-size-notification" src="../assets/img/backgrounds/1.jpg" alt="event img">
   <div class="card-body">
     <h5 class="card-title title2"><?php echo $eventName; ?></h5>
     <p class="card-text"><?php echo $eventDate; ?></p>
     <p class="card-text"><?php echo $eventDescription; ?></p>
           <p class="card-text">Gig Selected: <?php echo $gig; ?></p>
     <p class="card-text"><?php echo $venue; ?></p>
     <p class="card-text">Contact <?php echo $contactEmail; ?></p>
   </div>
   <div class="card-footer text-muted">
   
   <a href="entertainerProcessBooking.php?id=<?php echo $_GET["id"]; ?>&accept=1" style="display: inline; color: green;">Accept</a> <p style="display: inline;">or </p><a href="entertainerProcessBooking.php?id=<?php echo $_GET["id"]; ?>&reject=1" style="color: red; display: inline;">Reject</a></div>  
 </div>           
 </div>
 

 </form>
                                      
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
