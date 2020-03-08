<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Create Portfolio</title>
		<meta name="description" content="Fullscreen Form Interface: A distraction-free form concept with fancy animations" />
		<meta name="keywords" content="fullscreen form, css animations, distraction-free, web design" />
		<meta name="author" content="Codrops" />
		<?php include "navigationHeadInclude1.php" ?>
		
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../assets/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/component.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/cs-skin-boxes.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/mainNew2.css" />

		<script src="../assets/js/modernizr.custom.js"></script>
	</head>
	<body>
	
<?php 
// session is already set in navigationheaderEntertainer.php
include "navigationheaderEntertainer.php" 
?>

<?php
include ('../enums/userType.php');

$authId = $_SESSION['authId'];


function profileStatus() {
    
    if ( isset($_POST['q0']) && isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3'])) {
        $result = ProfileStatus::COMPLETE;
    } else if ( isset($_POST['q0']) || isset($_POST['q1']) || isset($_POST['q2']) || isset($_POST['q3'])) {
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
            $ratePerHour = $_POST['q0'];
            $occupation = $_POST['q1'];
            $workDescription = $_POST['q3'];
            $profilePicture = "";
            $homePagePicture = "";
            $aboutMe = $_POST['q2'];
            $myQuote = $_POST['q4'];
            
            
            //execute statement
            $status = $stmt->execute();
            
            if ($status === false) {
                trigger_error($stmt->error, E_USER_ERROR);
            } else {
                header('Location: entertainerPortfolio.php');
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


	
		<div class="container">
<br/><p/>
<br/><p/>
<br/><p/>
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h2 class ="title-01__title">CREATE PORTFOLIO</h2>
				</div>
				<form id="myform" class="fs-form fs-form-full" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
					<ol class="fs-fields">
					
						<li>
							<label class="fs-field-label fs-anim-upper" for="q0" style="font-family:'Archivo', sans-serif; font-size: 25px;">What's your rate per hour?</label>
							<input class="fs-anim-lower" id="q0" name="q0" type="text" placeholder="Your rate per hour" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q1" data-info="Just so people know" style="font-family:'Archivo', sans-serif; font-size: 25px;">What's your occupation as an entertainer?</label>
							<input class="fs-anim-lower" id="q1" name="q1" type="text" placeholder="What do you do as an entertainer?" required/>
						</li>			
						
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q2" data-info="This will help us know who you are" style="font-family:'Archivo', sans-serif; font-size: 25px;">Tell us about yourself</label>
							<textarea class="fs-anim-lower" style="border:solid 3px #fac668;" id="q2" name="q2" placeholder="Describe here"></textarea>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q3" style="font-family:'Archivo', sans-serif; font-size: 25px;">Describe your work/gigs</label>
							<textarea class="fs-anim-lower" style="border:solid 3px #fac668;" id="q3" name="q3" placeholder="Describe here"></textarea>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q3" style="font-family:'Archivo', sans-serif; font-size: 25px;">Your inspirational quote</label>
							<textarea class="fs-anim-lower" style="border:solid 3px #fac668;" id="q4" name="q4" placeholder="Describe here"></textarea>
						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="Upload your profile picture" style="font-family:'Archivo', sans-serif; font-size: 25px;">Upload your profile picture.</label>
							
							<select class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick a color</option>
								<option value="#588c75" data-class="color-588c75">#588c75</option>
								<option value="#b0c47f" data-class="color-b0c47f">#b0c47f</option>
								<option value="#f3e395" data-class="color-f3e395">#f3e395</option>
								<option value="#f3ae73" data-class="color-f3ae73">#f3ae73</option>
								<option value="#da645a" data-class="color-da645a">#da645a</option>
								<option value="#79a38f" data-class="color-79a38f">#79a38f</option>
								<option value="#c1d099" data-class="color-c1d099">#c1d099</option>
								<option value="#f5eaaa" data-class="color-f5eaaa">#f5eaaa</option>
								<option value="#f5be8f" data-class="color-f5be8f">#f5be8f</option>
								<option value="#e1837b" data-class="color-e1837b">#e1837b</option>
								<option value="#9bbaab" data-class="color-9bbaab">#9bbaab</option>
								<option value="#d1dcb2" data-class="color-d1dcb2">#d1dcb2</option>
								<option value="#f9eec0" data-class="color-f9eec0">#f9eec0</option>
								<option value="#f7cda9" data-class="color-f7cda9">#f7cda9</option>
								<option value="#e8a19b" data-class="color-e8a19b">#e8a19b</option>
								<option value="#bdd1c8" data-class="color-bdd1c8">#bdd1c8</option>
								<option value="#e1e7cd" data-class="color-e1e7cd">#e1e7cd</option>
								<option value="#faf4d4" data-class="color-faf4d4">#faf4d4</option>
								<option value="#fbdfc9" data-class="color-fbdfc9">#fbdfc9</option>
								<option value="#f1c1bd" data-class="color-f1c1bd">#f1c1bd</option>
							</select>
							

						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="Upload your homepage picture" style="font-family:'Archivo', sans-serif; font-size: 25px;">Upload your homepage picture.</label>
							<select class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick a color</option>
								<option value="#588c75" data-class="color-588c75">#588c75</option>
								<option value="#b0c47f" data-class="color-b0c47f">#b0c47f</option>
								<option value="#f3e395" data-class="color-f3e395">#f3e395</option>
								<option value="#f3ae73" data-class="color-f3ae73">#f3ae73</option>
								<option value="#da645a" data-class="color-da645a">#da645a</option>
								<option value="#79a38f" data-class="color-79a38f">#79a38f</option>
								<option value="#c1d099" data-class="color-c1d099">#c1d099</option>
								<option value="#f5eaaa" data-class="color-f5eaaa">#f5eaaa</option>
								<option value="#f5be8f" data-class="color-f5be8f">#f5be8f</option>
								<option value="#e1837b" data-class="color-e1837b">#e1837b</option>
								<option value="#9bbaab" data-class="color-9bbaab">#9bbaab</option>
								<option value="#d1dcb2" data-class="color-d1dcb2">#d1dcb2</option>
								<option value="#f9eec0" data-class="color-f9eec0">#f9eec0</option>
								<option value="#f7cda9" data-class="color-f7cda9">#f7cda9</option>
								<option value="#e8a19b" data-class="color-e8a19b">#e8a19b</option>
								<option value="#bdd1c8" data-class="color-bdd1c8">#bdd1c8</option>
								<option value="#e1e7cd" data-class="color-e1e7cd">#e1e7cd</option>
								<option value="#faf4d4" data-class="color-faf4d4">#faf4d4</option>
								<option value="#fbdfc9" data-class="color-fbdfc9">#fbdfc9</option>
								<option value="#f1c1bd" data-class="color-f1c1bd">#f1c1bd</option>
							</select>
						</li>
					</ol><!-- /fs-fields -->
					<button class="fs-submit" style="font-family:'Archivo', sans-serif;" type="submit">Send My Answers</button>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->

		</div><!-- /container -->
		<script src="../assets/js/classie.js"></script>
		<script src="../assets/js/selectFx.js"></script>
		<script src="../assets/js/fullscreenForm.js"></script>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder').style.backgroundColor = val;
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add( document.body, 'overview' ); // for demo purposes only
					}
				} );
			})();
		</script>
		<?php include "navigationHeadInclude2.php" ?>
	</body>
</html>