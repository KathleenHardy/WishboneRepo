<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendors/bootstrap/css/bootstrap.min (2).css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendors/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/vendors/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendors/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendors/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/vendors/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/mainLogin.css">
	<link href="https://fonts.googleapis.com/css?family=Archivo&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>
<?php include "navigationheaderHome.php" ?>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="entertainerHome.php">
					<span class="login100-form-title p-b-33">
						REGISTER
					</span>
					<div class="buttonsRegister">					
					<span class="txt1" style="text-align: center;">You are a/an:</span>
					<br/>
					<br/>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked>ENTERTAINER
                      </label>
                      <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option2" autocomplete="off">EVENT PLANNER
                      </label>
                      <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option3" autocomplete="off">VENUE HOST
                      </label>
                    </div>
					</div>
					<br/>
					<br/>
					<div class="wrap-input100 validate-input" data-validate="Enter your first name">
						<input class="input100" type="text" name="firstname" placeholder="First Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter your last name">
						<input class="input100" type="text" name="lastname" placeholder="Last Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter your email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Confirm your password">
						<input class="input100" type="password" name="pass" placeholder="Confirm Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>					
					<div class="container-login100-form-btn m-t-20">
						<button type="submit" class="login100-form-btn">SIGN UP</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="../assets/vendors/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendors/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendors/bootstrap/js/popper.js"></script>
	<script src="../assets/vendors/bootstrap/js/bootstrap.min (2).js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendors/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendors/daterangepicker/moment.min.js"></script>
	<script src="../assets/vendors/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../assets/vendors/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../assets/js/mainLogin.js"></script>

</body>
</html>