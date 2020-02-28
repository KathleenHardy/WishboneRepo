<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
session_start();
include ('navigationheaderHome.php');

?>
<?php
// if (isset($_SESSION['useremail'])) {
//     header("Location: userHome.php");
// }

require_once ("../config.php");
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
            header('Location: eventPlannerEventList.php');
            mysqli_close($connection);
        } else if ( $userType == UserType::ENTERTAINER) {
            header('Location: entertainerEventList.php');
            mysqli_close($connection);
        } else if ( $userType == UserType::VENUE_OWNER) {
            header('Location: venueProfileView.php');
            mysqli_close($connection);
        }
        //close statement
        $stmt->close();
    }
    
    else {
        $fmsg = "Invalid Login Credentials.";
    }
    //close connection
    //$connection->close();
   
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
													method="post">
					<span class="login100-form-title p-b-33">
						ACCOUNT LOGIN
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="useremail" id="useremail"  placeholder="Email">
						
						<span class="focus-input100-1"></span>
						
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="userpassword" id="userpassword" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							SIGN IN
						</button>
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2 hov1">
							Username or Password?
						</a>
					</div>

					<div class="text-center">
						<span class="txt1">
							Create an account?
						</span>

						<a href="register.php" class="txt2 hov1">
							Sign up
						</a>
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