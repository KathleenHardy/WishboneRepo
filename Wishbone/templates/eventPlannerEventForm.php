<!DOCTYPE html>
<html>
<head>
<title>Event Form</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
		<?php
		session_start();
		include "navigationHeadInclude1.php" ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


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
		
<script>
    $(document).ready(function(){
      var date_input=$('input[name="eventDate"]'); //our date input has the name "date"
	  date_input.innerHTML = "haha";
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
<?php
include ('../dto/venue.php');
include ('../dto/gig.php');
include ('../dao/authenticationDAO.php');
include ("navigationheaderEventPlanner.php");
require_once ("../config.php");


//get selected entainer id
if(isset($_GET["id"]))
{
	$entid = $_GET["id"];
	$_SESSION['entid'] = $entid;
}
else
{
	$entid = $_SESSION['entid'];
}


$venuesDTO = array();

$query2 = "SELECT * 
		FROM venues;";
		
$result = mysqli_query($connection, $query2) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);
		
if ($count >= 1) {
		
	while ($row = mysqli_fetch_array($result)) {
	    $venuesDTO[] = new Venue ($row['venueId'], $row['venueOwnerId'], $row['venueName'], $row['venueCity'], $row['venueState'], $row['venueProvince'], $row['venueDescription'], $row['venuePicture']);
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



//connection object from config file

$hasError = false;
$errorMessages = Array();

//cehcks if value is set after button clic or not
if(isset($_POST["eventName"]) || isset($_POST["eventDate"]) || isset($_POST["eventDescription"]) || isset($_POST["eventplanner_email"]))   
{
    require_once ("../config.php");

    
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
        
			echo $_POST["eventplanner_email"];
			$eventPlannerEmail = $_POST["eventplanner_email"];
			
			$querya = 'SELECT authid FROM authentication WHERE email = ?';
            $stmta =mysqli_prepare ($connection,$querya);
            $stmta->bind_param('s', $eventPlannerEmail);
            $stmta->execute();
            $stmta->bind_result($eventPlannerAuthId);
            $stmta->fetch();
            $stmta->close();


			$querya = 'SELECT eventPlannerId FROM eventplanners WHERE authid = ?';
            $stmta =mysqli_prepare ($connection,$querya);
            $stmta->bind_param('s', $eventPlannerAuthId);
            $stmta->execute();
            $stmta->bind_result($epID);
            $stmta->fetch();
            $stmta->close();


            //fetch venueOwnerId from vanues based on venueId
            $venue_id = $_POST["venueSelection"];
            $queryVenueOwner = 'SELECT venueOwnerId FROM venues WHERE venueId = ?';
            $stmta = mysqli_prepare ($connection,$queryVenueOwner);
            $stmta->bind_param('s', $venue_id);
            $stmta->execute();
            $stmta->bind_result($venueOwnerId);
            $stmta->fetch();
            $stmta->close();
			
			$querya = 'SELECT email FROM authentication WHERE authid = (select authid from entertainers where entid = ?)';
            $stmta =mysqli_prepare ($connection,$querya);
            $stmta->bind_param('s',$_SESSION['entid']);
            $stmta->execute();
            $stmta->bind_result($entertainerEmail);
            $stmta->fetch();
            $stmta->close();


			$resAvailId = '1';
            
            //get selected gig id
            $gigsid = $_POST["gigSelection"];
            
            //get evenet name
            $event_name = $_POST["eventName"];
            
            //get event date
            $event_date = date($_POST["eventDate"]);
            
            //get event description
            $event_description = $_POST["eventDescription"];
			
			
            //query to insrt into bookedgigs
            $query = "insert into bookingrequests(entid,gigsid,eventPlannerId,venueOwnerId,venueId,event_name,event_date,event_description) 
values(".$_SESSION['entid'].",".$gigsid.",".$epID.",".$venueOwnerId.",".$venue_id.",'".$event_name."','".$event_date."','".$event_description."');";
            echo $query;
           //if success then show success msg else show error msg
		   $conn =   mysqli_query($connection,$query);
		   if($conn  === TRUE)
           {
            $last_id = mysqli_insert_id($connection);
    
         //   echo '<script>document.write(shortUrl);</script>';
               // the message
              $url = $_SERVER['REQUEST_URI'];
              $shortUrl = substr($url,0, strrpos($url, '/'));
              $server = "http://localhost";
               $htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to WishBone</title> 
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
 
                // send email
                mail($entertainerEmail,"Wishbone", $htmlContent,$headers);
              ?> <script type="text/javascript">
              window.location.href = 'eventPlannerEventConfirmation.php';
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

	<div class="page-wrap">

		<!-- header -->

		<!-- End / header -->

		<!-- Content-->
		<div class="md-content">

			<!-- Section -->
			<section class="md-section">
				<div class="container">
					<div class="row">
						<div
							class="col-lg-10 col-xl-8 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-2 ">

							<!-- title-01 -->
							<div class="title-01 title-01__style-04">
								<h2 class="title-01__title">PLAN YOUR EVENT</h2>
							</div>
							<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

										<div class="form-group"> <!-- Event Name -->
											<label for="eventName" class="control-label title2">Event Name</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="eventName" name="eventName" placeholder="Enter a name for your event">
										</div>	 
										<div class="form-group"> <!-- Event Name -->   
											<label for="eventDate" class="control-label title2">Event Date/Time</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="eventDate" name="eventDate" placeholder="Enter the date/time of event">
										</div>	
									
										<!-- <div class="form-group" style="padding: 20px;"> 
											<label for="entertainerSelection" class="control-label title2">Select Your Entertainer</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="entertainerSelection" name="entertainerSelection">
												<option value="1">Jack</option>
												<option value="2">Melody</option>
												<option value="3">Moonstruck</option>
												<option value="4">Bob</option>
												<option value="5">Andrew Archibald</option>
											</select>					
										</div> -->
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigSelection" class="control-label title2">Select Your Gig (based on entertainer)</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="gigSelection" name="gigSelection">
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
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="venueSelection" name="venueSelection">
											<?php

											foreach($venuesDTO as $venue){
											?>
											<option value="<?php echo $venue->getVenueID() ?>"><?php echo $venue->getVenueName(); ?></option>
											<?php
											}
											?>
											
											</select>
											<label for="eventName" class="control-label title2">Event Planner Email Address</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="eventplanner_email" name="eventplanner_email" placeholder="Enter Event Planner Email">
											
										</div>
										
										<div class="form-group"> <!-- Gigs details -->
											<label for="eventDescription" class="title2">Event Description</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="eventDescription" name="eventDescription" placeholder ="Enter details"></textarea>
										</div>
										<div class="form-group">
										<label for="gigPhoto" class="title2">Upload Event Image</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                          </div>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gigPhoto"
                                              aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                          </div>
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
										
										<input  class="btn-all" style="display:inline;" type=SUBMIT value="Submit">
										 
										
										 
										<a href="eventPlannerEventList.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
										
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
			</section>
			<!-- End / Section -->
<?php include "footer.php" ?>
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
	<?php include "navigationHeadInclude2.php" ?>
</body>
</html>