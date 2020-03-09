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

<?php
include ('../dao/authenticationDAO.php');
include ('../navigationheaderHome.php');
require_once ("../config.php");

session_start();

$hasError = false;
$authenticationDAO = new AuthenticationDAO();
$errorMessages = Array();


if (isset($_POST["userFirstName"]) || isset($_POST["userLastName"]) || isset($_POST["userEmail"]) || isset($_POST["userPwd"]) || isset($_POST["userConfirmPwd"])) {

    
    if ($_POST["userFirstName"] == "") {
        $hasError = true;
        $errorMessages['firstNameError'] = 'Please enter your first name';
    }

    if ($_POST["userLastName"] == "") {
        $hasError = true;
        $errorMessages['lastNameError'] = 'Please enter your last name';
    }

    if ($_POST["userEmail"] == "" || ! preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['userEmail'])) {
        $hasError = true;
        $errorMessages['EmailError'] = 'Please enter your first name';
    }

    if ($_POST["userPwd"] == "") {
        $hasError = true;
        $errorMessages['PasswordError'] = 'Please enter your password';
    }

    if (! preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $_POST["userPwd"])) {
        $hasError = true;
        $errorMessages['PasswordError'] = 'The password must contain at least one number, one alphabetic character, one special character, and suggested length is between 8 and 12';
    }

    if ($_POST["userPwd"] !== $_POST["userConfirmPwd"]) {
        $hasError = true;
        $errorMessages['userConfirmPwdError'] = 'Passwords need to be matched';
    }
    
    
    if (isset($_POST['reg_user'])) {  
        if (! $hasError) {
            $authentication = new Authentication($_POST["userFirstName"], $_POST["userLastName"], $_POST["userEmail"], $_POST["userPwd"], $_POST["userType"]);
            $authentication->setProfileStatus( ProfileStatus::NOT_CREATED);
            $addSuccess = $authenticationDAO->addNewRegistrant($authentication);
                       
            if ( $_POST["userType"] == UserType::EVENT_PLANNER) {
                header('Location: eventPlannerProfile.php');
            } else if ( $_POST["userType"] == UserType::ENTERTAINER) {
                $_SESSION['authId'] = $authentication->getAuthId();
                header('Location: entertainerPortfolioEmpty.php');
            } else if ( $_POST["userType"] == UserType::VENUE_OWNER) {
                $_SESSION['authId'] = $authentication->getAuthId();
                header('Location: venueProfileView.php');
            }
            
            echo $addSuccess;

        }
    }
    
    //testing.test@1.com
    
}

?>


<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<span class="login100-form-title p-b-33">
						REGISTER
					</span>
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
					<div class="wrap-input100 validate-input" data-validate="Enter your first name">
						<input class="input100" type="text" name="userFirstName" placeholder="First Name">
						<?php
            if (isset($errorMessages['firstNameError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['firstNameError'] . '</span>';
            }
            ?>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter your last name">
						<input class="input100" type="text" name="userLastName" placeholder="Last Name">
						<?php
            if (isset($errorMessages['lastNameError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['lastNameError'] . '</span>';
            }
            ?>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter your email">
						<input class="input100" type="text" name="userEmail" placeholder="Email">
						<?php
            if (isset($errorMessages['EmailError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['EmailError'] . '</span>';
            }
            ?>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="userPwd" placeholder="Password">
						<?php
            if (isset($errorMessages['PasswordError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['PasswordError'] . '</span>';
            }
            ?> 
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<div class="wrap-input100 rs1 validate-input" data-validate="Confirm your password">
						<input class="input100" type="password" name="userConfirmPwd" placeholder="Confirm Password">
						<?php
            if (isset($errorMessages['userConfirmPwdError'])) {
                echo '<span style=\'color:red\'>' . $errorMessages['userConfirmPwdError'] . '</span>';
            }
            ?>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>					
					<div class="container-login100-form-btn m-t-20">
						<button type="submit" id="reg_user" name="reg_user" class="login100-form-btn">SIGN UP</button>
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
