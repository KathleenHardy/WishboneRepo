<!DOCTYPE html>
<html>
<head>
<title>Portfolio Creation</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<?php
include "navigationHeadInclude1.php" 
?>

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
include ("navigationheaderEntertainer.php"); 
?>

<?php
include ('../enums/userType.php');

$authId = $_SESSION['authId'];


if(isset($_FILES['profilepic'])){
    $errors= array();
    $profilePic_file_name = $_FILES['profilepic']['name'];
    $profilePic_file_size =$_FILES['profilepic']['size'];
    $profilePic_file_tmp =$_FILES['profilepic']['tmp_name'];
    $profilePic_file_type=$_FILES['profilepic']['type'];
    
    //$profilePic_file_path = "C:/xampp/htdocs/WishboneRepo/Wishbone/assets/img/profile/";
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
                  SET ratePerHour = ?, occupation = ?, workDescription = ?, profilePicture = ?, homePagePicture = ?, aboutMe = ?, myQuote = ?, profileStatus = ?
                  WHERE  authid = ?";
        
        if ($stmt = $connection->prepare( $query)) {
            $profileStatus = profileStatus();
            
            $stmt->bind_param( "dssssssii", $ratePerHour, $occupation, $workDescription, $profilePicture, $homePagePicture, $aboutMe, $myQuote, $profileStatus, $authId);
            
            //Set params
            $ratePerHour = $_POST['hourlyrate'];
            $occupation = $_POST['occupation'];
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
                echo("<script>location.href = 'entertainerPortfolio.php?msg=$msg';</script>");
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
								<h2 class="title-01__title">CREATE YOUR PORTFOLIO</h2>
							</div>
							<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

										<div class="form-group"> <!-- Event Name -->
											<label for="hourlyrate" class="control-label title2">What's your hourly rate?</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="hourlyrate" name="hourlyrate">
										</div>	 
										<div class="form-group"> <!-- Event Name -->   
											<label for="occupation" class="control-label title2">What's your occupation as an entertainer?</label>
											<input type="text" class="form-control" style="border-bottom: 3px solid #fac668;" id="occupation" name="occupation">
										</div>	
										<div class="form-group"> <!-- Gigs details -->
											<label for="aboutme" class="title2">Tell us about yourself</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="aboutme" name="aboutme" placeholder ="Anything you want"></textarea>
										</div>
										<div class="form-group"> <!-- Gigs details -->
											<label for="gigsdetails" class="title2">Tell us about your work</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="gigsdetails" name="gigsdetails" placeholder ="Anything you want"></textarea>
										</div>										
										<div class="form-group"> <!-- Gigs details -->
											<label for="quote" class="title2">An inspirational quote or your favourite one</label>
											<textarea class="form-control" style="border: 3px solid #fac668;" rows="5" id="quote" name="quote" placeholder ="Anything you want"></textarea>
										</div>
                                        <div class="form-group">
                                        <label for="profilepic" class="title2">Upload Your Portfolio Image</label>
                                        <br/>
                                        <br/>
                                        <input type="file" id="profilepic" name="profilepic"><br><br>
                                        </div>
                                        <div class="form-group">
                                        <label for="bgimage" class="title2">Upload Your Background Image</label>
                                        <br/>
                                        <br/>
                                        <input type="file" id="bgimage" name="bgimage"><br><br>
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
										<input  class="btn-all" style="display:inline;" type="submit" value="Submit">
										 
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