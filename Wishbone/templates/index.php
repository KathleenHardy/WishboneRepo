<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Fonts-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;amp;subset=latin-ext">
		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
<script>
var TxtRotate = function(el, toRotate, period) {
	  this.toRotate = toRotate;
	  this.el = el;
	  this.loopNum = 0;
	  this.period = parseInt(period, 10) || 2000;
	  this.txt = '';
	  this.tick();
	  this.isDeleting = false;
	};

	TxtRotate.prototype.tick = function() {
	  var i = this.loopNum % this.toRotate.length;
	  var fullTxt = this.toRotate[i];

	  if (this.isDeleting) {
	    this.txt = fullTxt.substring(0, this.txt.length - 1);
	  } else {
	    this.txt = fullTxt.substring(0, this.txt.length + 1);
	  }

	  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

	  var that = this;
	  var delta = 300 - Math.random() * 500;

	  if (this.isDeleting) { delta /= 2; }

	  if (!this.isDeleting && this.txt === fullTxt) {
	    delta = this.period;
	    this.isDeleting = true;
	  } else if (this.isDeleting && this.txt === '') {
	    this.isDeleting = false;
	    this.loopNum++;
	    delta = 500;
	  }

	  setTimeout(function() {
	    that.tick();
	  }, delta);
	};

	window.onload = function() {
	  var elements = document.getElementsByClassName('txt-rotate');
	  for (var i=0; i<elements.length; i++) {
	    var toRotate = elements[i].getAttribute('data-rotate');
	    var period = elements[i].getAttribute('data-period');
	    if (toRotate) {
	      new TxtRotate(elements[i], JSON.parse(toRotate), period);
	    }
	  }
	  // INJECT CSS
	  var css = document.createElement("style");
	  css.type = "text/css";
	  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
	  document.body.appendChild(css);
	};
	</script>
	</head>
	
	<body>
<?php
include ("navigationBeforeLogin.php");
?>
		<div class="page-wrap">
						
			<!-- Content-->
			<div class="md-content">
				
				<!-- slider -->
				<div class="slider">
					
					<!-- carousel__element owl-carousel -->
					<div class="carousel__element owl-carousel" data-options='{"items":1,"loop":true,"dots":false,"nav":false,"margin":0, "autoplay": true, "autoplayTimeout": 3000}'>
						<div class="slider__item" style="background-image: url('../assets/img/slider.jpg');">
							<div class="md-tb">
								<div class="md-tb__cell">
									<div class="slider__content">
										<div class="container">
											
											<div class="row">
												<div class="col-lg-12">
													<div class="widget-text__content">	
														<!-- form-search -->
														<div class="form-search">
                                                    <div id="fly-in">
                                                    <div>
                                                        <a
                                                            style="color: #FAA828; font-family: 'Averta'; font-size: 130px; font-weight: bold; opacity: 1;"
                                                            href="index.php">WISHBONE</a>
                                                            </div>
                                                            </div>
<!--
															<form>
																<input class="form-control" style="background: transparent; border-color:#c2c2c2; color:#c2c2c2" type="text" placeholder="Enter Location to find an entertainer..."/>
															</form>
-->
														</div><!-- End / form-search -->
                                                <br/>
                                                <br/>
                                                <br/>
                                                <span style="color: white; font-size: 25px; font-family: 'Intro Script';">At
                                                    The Thought Of A Wish</span>
                                                <p style="color: #FAA828; font-family: 'Averta'; font-size: 40px;" id="changeTexts"
     class="txt-rotate" data-period="2000" data-rotate='[ "Discover an exciting city.", "Connect with new talents.", "Hire great entertainment." ]'/>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--
						<div class="slider__item" style="background-image: url('https://picsum.photos/1920/1080');">
							<div class="md-tb">
								<div class="md-tb__cell">
									<div class="slider__content">
										<div class="container">
											<h2>We create the trend</h2>
											<p>Curabitur elementum urna augue, eu porta purus gravida in. Cras consectetur, lorem a cursus vestibulum, ligula purus iaculis nulla, in dignissim risus turpis id justo. Sed eleifend ante et ligula elei</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						-->
					</div><!-- End / carousel__element owl-carousel -->
					
				</div><!-- End / slider -->
				
				<!-- Service-->
				
				<!-- Section -->
				<section class="md-section" style="background-color:#f7f7f7;padding:0;">
					<div class="container">
						<div class="textbox-group">
							<div class="row">
								<div class="col-md-4 col-lg-4 ">
									
									<!-- textbox -->
									<div class="textbox">
										<div class="textbox__image"><a href="#"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone1.jpg" alt=""/></a></div>
										<div class="textbox__body">
											<h2 class="textbox__title"><a href="#">DISCOVER</a></h2>
											<h2 class="textbox__title2"><a href="#">the city</a></h2>
											<i class="fa fa-heart" style = "font-size: 23px; color: #faa828;"></i>
											<div class="textbox__description">Explore what your city has to offer! Exciting events, new entertainers and artists, and a variety of venues.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
								<div class="col-md-4 col-lg-4 ">
									
									<!-- textbox -->
									<div class="textbox">
										<div class="textbox__image"><a href="#"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone2.jpg" alt=""/></a></div>
										<div class="textbox__body">
											<h2 class="textbox__title"><a href="#">CONNECT</a></h2>
											<h2 class="textbox__title2"><a href="#">with talent</a></h2>	
											<i class="fa fa-handshake-o" style = "font-size: 23px; color: #faa828;"></i>										
											<div class="textbox__description">Learn all about local entertainers - see their gigs, their talents, and their brand.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
								<div class="col-md-4 col-lg-4 ">
									
									<!-- textbox -->
									<div class="textbox">
										<div class="textbox__image"><a href="#"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone3.jpg" alt=""/></a></div>
										<div class="textbox__body">
											<h2 class="textbox__title"><a href="#">BOOK</a></h2>
											<h2 class="textbox__title2"><a href="#">your entertainment</a></h2>
											<i class="fa fa-check-circle-o" style = "font-size: 23px; color: #faa828;"></i>
											<div class="textbox__description">Plan your event by booking an entertainer and their gigs through a simple form. No extra steps.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End / Section -->
								
				<!-- About-->
				
				<!-- Section -->
				<section class="md-section">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 ">
								
								<!-- title-01 -->
								<div class="title-01 title-01__style-03 md-text-left">
                                    <div style="position: relative; margin: 0 auto;">
                                        <p class ="subtitle-extra">support local entertainers</p>
                                        <div style="position: absolute; top: 20px; left: 100px; width: 100%"><p class="subtitle-extra2">&</p></div>
                                         <div style="position: absolute; top: 30px; left: 126px; width: 100%"><p class="subtitle-extra3">still organize great events</p></div>
                                    </div>
                                <br/>
                                <br/>
                                <br/>
								<div style = "text-align: center;">	
									<h2 class="title-Ottawa" style = "padding: 20px;">OTTAWA</h2>								
									<p class="text-description">Canada's capital city is a melting pot of different cultures, and a booming marketplace for new, exciting talents. Discover your local capital city by learning about new, upcoming entertainers and booking them for your own customized events.</p>
								</div>
								</div><!-- End / title-01 -->
						
								<div class="row">
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">99</h2>
											</div>
											<div class="box-number__description">Happy planners</div>
										</div><!-- End / box-number -->
										
									</div>
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">1200</h2>
											</div>
											<div class="box-number__description">Bookings</div>
										</div><!-- End / box-number -->
										
									</div>
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">15</h2>
											</div>
											<div class="box-number__description">Entertainers</div>
										</div><!-- End / box-number -->
										
									</div>
								</div>
							</div>
							<div class="col-lg-6 ">
								<div class="js-consult-slider">
									
									<!-- carousel__element owl-carousel -->
										<img style = "height: 600px; width: 440px;" src="../assets/img/backgrounds/img-main-2.jpg" alt="">
										<!--div class="image-full"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone5.jpg" alt=""></div-->
										<p> Photo by Tim Mossholder on Unsplash</p>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End / Section -->
				
				<!-- Contact us-->
				
				
			</div>
			<!-- End / Content-->
	<?php include ("footer.php"); ?>		
		</div>
		<!-- Vendors-->
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
</html>
