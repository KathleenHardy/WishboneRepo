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
     
      
      var options={
        format: 'mm/dd/yyyy'
      };
      $("#eventDate").datepicker(options);
    })
</script>
</head>

<body>
<?php
include ('../dao/authenticationDAO.php');
include ("navigationheaderEventPlanner.php");
require_once ("../config.php");

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
            //get logged in auth id
            $authId =  $_SESSION['authId'];
            
            //fetch eventPlannerId based on authId
            $querya = 'SELECT eventPlannerId FROM eventPlanners WHERE authid = ?';
            $stmta =mysqli_prepare ($connection,$querya);
            $stmta->bind_param('s', $authId);
            $stmta->execute();
            $stmta->bind_result($eventplannerID);
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
            
            //get selected entainer id
            $entid = $_POST["entertainerSelection"];
            $queryResAvailId = 'SELECT `resAvailId` FROM resourceavailability WHERE entid = ?';
            $stmta = mysqli_prepare ($connection,$queryResAvailId);
            $stmta->bind_param('s', $entid);
            $stmta->execute();
            $stmta->bind_result($resAvailId);
            $stmta->fetch();
            $stmta->close();
            
            
            //get selected gig id
            $gigsid = $_POST["gigSelection"];
            
            //get evenet name
            $event_name = $_POST["eventName"];
            
            //get event date
            $event_date = date($_POST["eventDate"]);
            
            //get event description
            $event_description = $_POST["eventDescription"];
            
            //query to insrt into bookedgigs
            $query = "insert into bookedgigs(entid,gigsid,eventPlannerId,venueOwnerId,resAvailId,event_name,event_date,event_description) 
values(".$entid.",".$gigsid.",".$eventplannerID.",".$venueOwnerId.",".$resAvailId.",'".$event_name."','".$event_date."','".$event_description."');";
            echo $query;
           //if success then show success msg else show error msg
           if( mysqli_query($connection,$query) === TRUE)
           {
            
              ?> <script type="text/javascript">
               window.location.href = 'http://localhost/WishboneRepo/wishbone/templates/eventPlannerEventConfirmation.php';
               </script>
               <?php
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
									
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="entertainerSelection" class="control-label title2">Select Your Entertainer</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="entertainerSelection" name="entertainerSelection">
												<option value="1">Jack</option>
												<option value="2">Melody</option>
												<option value="3">Moonstruck</option>
												<option value="4">Bob</option>
												<option value="5">Andrew Archibald</option>
											</select>					
										</div>
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="gigSelection" class="control-label title2">Select Your Gig (based on entertainer)</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="gigSelection" name="gigSelection">
												<option value="1">Gig 1</option>
												<option value="2">Gig 2</option>
												<option value="3">Gig 3</option>
												<option value="4">Gig 4</option>
												<option value="5">Gig 5</option>
											</select>					
										</div>										
										<div class="form-group" style="padding: 20px;"> <!-- Gigs category -->
											<label for="venueSelection" class="control-label title2">Select Your Venue</label>
											<select class="form-control" style="border-bottom: 3px solid #fac668;" id="venueSelection" name="venueSelection">
												<option value="1">Concert 1</option>
												<option value="2">Concert 2</option>
												<option value="3">Venue 3</option>
												<option value="4">Gallery 4</option>
												<option value="5">Museum 5</option>
											</select>
											<label for="eventName" class="control-label title2">Or Use Your Own</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="valueName" name="custom_venue" placeholder="Enter your own venue">
											
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
										<div style="text-align:center;">
										<input  class="btn-all" style="display:inline;" type=SUBMIT value="Submit">
										 
										
										 
										<a href="eventPlannerEventList.php"><button class="btn-all" type ="button" style="display:inline;">Cancel</button></a>
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