<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Fonts-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/fonts/fontawesome/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/fonts/themify-icons/themify-icons.css">
		<!-- Vendors-->
		<link rel="stylesheet" type="text/css" href="../assets/vendors/bootstrap4/bootstrap-grid.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/vendors/magnific-popup/magnific-popup.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/vendors/owl.carousel/owl.carousel.css">
		<link rel="stylesheet" type="text/css" href="../assets/vendors/_jquery/jquery.min.css">
		
		<!-- <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap4/bootstrap-grid.min.css"> -->
		<!-- <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap4/bootstrap-grid.min.css"> -->
		<!-- App & fonts-->
		<link rel="stylesheet" type="text/css" href="../assets/css2/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;amp;subset=latin-ext">	
	<link rel="stylesheet" type="text/css" href="../assets/css/headerUI.css">

	<link rel="stylesheet" type="text/css" href="../assets/css/loginNew.css">
	
	
</head>
<body>	
	<div class="page-wrap">
	<div class="login-page">
  <div class="form">
    <form class="register-form">
    <h1 class="main-login-title">REGISTER</h1>
    					<div class="buttonsRegister" style="text-align: center;">					
					<span class="txt1" style="text-align: center;">Select a role:</span>
					<br/>
					<br/>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-secondary active" style ="font-size: 12px; ">
                        <input type="radio" name="userType" value=2 id="option1" autocomplete="off" checked>ENTERTAINER
                      </label>
                      <label class="btn btn-secondary" style ="font-size: 12px;">
                        <input type="radio" name="userType" value=1 id="option2" autocomplete="off">EVENT PLANNER
                      </label>
                      <label class="btn btn-secondary" style ="font-size: 12px;">
                        <input type="radio" name="userType" value=3 id="option3" autocomplete="off">VENUE HOST
                      </label>
                    </div>
					</div>
					<br/>
					<br/>
<div class="label" style="align: left;">					
<label for="fname" class="label-login">First Name</label>
</div>
<input type="text" name="fname" id="fname" placeholder="Enter your first name"/>
<div class="label">					
<label for="lname" class="label-login">Last Name</label>
</div>
<input type="text" name="lname" id="lname" placeholder="Enter your last name"/>					
<div class="label">					
<label for="email-signup" class="label-login">Email Address</label>
</div>      
<input type="text" name="email-signup" id="email-signup" placeholder="Enter your email"/>
<div class="label">					
<label for="pass-signup" class="label-login">Password</label>
</div>
      <input type="password" name="pass-signup" id="pass-signup" placeholder="Create a password"/>
<div class="label">					
<label for="pass-confirm" class="label-login">Confirm Password</label>
</div>      
      <input type="password" name ="pass-confirm" id = "pass-confirm" placeholder="Confirm your password"/>
      <button>SIGN UP</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form">
        <h1 class="main-login-title">ACCOUNT LOGIN</h1>
<div class="label">					
<label for="email-login" class="label-login">Email Address</label>
</div>
      <input type="text" name="email-login" id="email-login" placeholder="Enter your email"/>
<div class="label">					
<label for="pass-login" class="label-login">Password</label>
</div>      
      <input type="password" name="pass-login" id="pass-login" placeholder="Enter your password"/>
      <button>SIGN IN</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
</div>
<?php
include ('footer.php');

?>
		<script type="text/javascript" src="../assets/vendors/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/imagesloaded/imagesloaded.pkgd.js"></script>
		<script type="text/javascript" src="../assets/vendors/isotope-layout/isotope.pkgd.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.countdown/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.countTo/jquery.countTo.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.countUp/jquery.countup.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.matchHeight/jquery.matchHeight.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.mb.ytplayer/jquery.mb.YTPlayer.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/masonry-layout/masonry.pkgd.js"></script>
		<script type="text/javascript" src="../assets/vendors/owl.carousel/owl.carousel.js"></script>
		<script type="text/javascript" src="../assets/vendors/jquery.waypoints/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/menu/menu.min.js"></script>
		<script type="text/javascript" src="../assets/vendors/smoothscroll/SmoothScroll.min.js"></script>
		<!-- App-->
		<script type="text/javascript" src="../assets/js/main.js"></script>
</body>
	<script src="../assets/vendors/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
$('.message a').click(function(){
	   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
	});
	
</script>

</html>