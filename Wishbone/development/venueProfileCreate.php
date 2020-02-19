<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Create Venue Profile</title>
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
	<?php include "navigationheaderVenueHost.php" ?>
	
		<div class="container">
<br/><p/>
<br/><p/>
<br/><p/>
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h2 class ="title-01__title">CREATE PROFILE</h2>
				</div>
				<form id="myform" class="fs-form fs-form-full" autocomplete="off">
					<ol class="fs-fields">
						<li>
							<label class="fs-field-label fs-anim-upper" for="q0" style="font-family:'Archivo', sans-serif; font-size: 25px;">What's your venue name?</label>
							<input class="fs-anim-lower" id="q0" name="q0" type="text" placeholder="First name" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q1" style="font-family:'Archivo', sans-serif; font-size: 25px;">What's your venue location?</label>
							<input class="fs-anim-lower" id="q1" name="q1" type="text" placeholder="Last name" required/>
						</li>												
						<li>
							<label class="fs-field-label fs-anim-upper" for="q2" style="font-family:'Archivo', sans-serif; font-size: 25px;">Describe your venue</label>
							<textarea class="fs-anim-lower" style="border:solid 3px #fac668;" id="q2" name="q2" placeholder="Describe here"></textarea>
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