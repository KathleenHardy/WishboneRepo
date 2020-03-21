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

<?php
session_start();
session_unset();
?>

<?php
require_once ("config.php");



if( $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sign-in'])){
    include ('../enums/userType.php');
    
    $useremail = $userpassword = $fmsg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["useremail"]) && isset($_POST["userpassword"])) {
        $useremail = test_input($_POST["useremail"]);
        $userpassword = test_input($_POST["userpassword"]);
        
        
        $query = "SELECT userType, authid
              FROM authentication
              WHERE email = ? AND pass = ?";
        
        if ($stmt = $connection->prepare( $query)) {
            $_SESSION['useremail'] = $useremail;
            
            $stmt->bind_param( "ss", $useremail, $userpassword);
            
            //execute statement
            $stmt->execute();
            
            //bind result variables
            $stmt->bind_result($userType, $authid);
            
            // fetch values
            $stmt->fetch();
            
            $_SESSION['authId'] = $authid;
            
            if ($userType == UserType::EVENT_PLANNER) {
                header('Location: eventPlannerDashboardHome.php');
                mysqli_close($connection);
            } else if ( $userType == UserType::ENTERTAINER) {
                header('Location: entertainerDashboardHome.php');
                mysqli_close($connection);
            } else if ( $userType == UserType::VENUE_OWNER) {
                header('Location: venueDashboardHome.php');
                mysqli_close($connection);
            }
            //close statement
            $stmt->close();
        }
        
        else {
            $fmsg = "Invalid Login Credentials.";
        }
    }
} elseif( $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sign-up'])){
    include ('../dao/authenticationDAO.php');
    
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
        
        
        if (isset($_POST['sign-up'])) {
            if (! $hasError) {
                $authentication = new Authentication($_POST["userFirstName"], $_POST["userLastName"], $_POST["userEmail"], $_POST["userPwd"], $_POST["userType"]);
                $authentication->setProfileStatus( ProfileStatus::NOT_CREATED);
                $addSuccess = $authenticationDAO->addNewRegistrant($authentication);
                
                if ( $_POST["userType"] == UserType::EVENT_PLANNER) {
                    $_SESSION['authId'] = $authentication->getAuthId();
                    $_SESSION['useremail'] = $authentication->getRegistrantEmail();
                    header('Location: venueHostProfileView.php');
                } else if ( $_POST["userType"] == UserType::ENTERTAINER) {
                    $_SESSION['authId'] = $authentication->getAuthId();
                    $_SESSION['useremail'] = $authentication->getRegistrantEmail();
                    header('Location: entertainerCreateNewPortfolio.php');
                } else if ( $_POST["userType"] == UserType::VENUE_OWNER) {
                    $_SESSION['useremail'] = $authentication->getRegistrantEmail();
                    $_SESSION['authId'] = $authentication->getAuthId();
                    header('Location: venueProfileView.php');
                }
                
                echo $addSuccess;
                
            }
        }
           
    }
    
}




function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>



	
	<div class="page-wrap">
	<div class="login-page">
  <div class="form">
    <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
<input type="text" name="userFirstName" id="fname" placeholder="Enter your first name"/>
<div class="label">					
<label for="lname" class="label-login">Last Name</label>
</div>
<input type="text" name="userLastName" id="lname" placeholder="Enter your last name"/>					
<div class="label">					
<label for="email-signup" class="label-login">Email Address</label>
</div>      
<input type="text" name="userEmail" id="email-signup" placeholder="Enter your email"/>
<div class="label">					
<label for="pass-signup" class="label-login">Password</label>
</div>
      <input type="password" name="userPwd" id="pass-signup" placeholder="Create a password"/>
<div class="label">					
<label for="pass-confirm" class="label-login">Confirm Password</label>
</div>      
      <input type="password" name ="userConfirmPwd" id = "pass-confirm" placeholder="Confirm your password"/>
      <input type="hidden" name="action" value="signup">
      <button type="submit" id="sign-up" name="sign-up">SIGN UP</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    
    
    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <h1 class="main-login-title">ACCOUNT LOGIN</h1>
            <div class="label">					
            <label for="email-login" class="label-login">Email Address</label>
            </div>
                  <input type="text" name="useremail" id="email-login" placeholder="Enter your email"/>
            <div class="label">					
            <label for="pass-login" class="label-login">Password</label>
            </div>      
      <input type="password" name="userpassword" id="pass-login" placeholder="Enter your password"/>

      <button type="submit" id="sign-in" name="sign-in">SIGN IN</button>
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