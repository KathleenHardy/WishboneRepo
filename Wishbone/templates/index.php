<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Fonts-->
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
											<h2 class="textbox__title"><a href="#">Discover</a></h2>
											<div class="textbox__description">Organize local talent on demand. Social icons will be respected through our rating system to offer the finest quality of work. Explore all desired services through our discover tab.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
								<div class="col-md-4 col-lg-4 ">
									
									<!-- textbox -->
									<div class="textbox">
										<div class="textbox__image"><a href="#"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone2.jpg" alt=""/></a></div>
										<div class="textbox__body">
											<h2 class="textbox__title"><a href="#">Connect</a></h2>
											<div class="textbox__description">Network through our interconnected system of rated portfolios. Collaborate, contact and gain inspiration from similar profiles; progressing towards building your own brand.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
								<div class="col-md-4 col-lg-4 ">
									
									<!-- textbox -->
									<div class="textbox">
										<div class="textbox__image"><a href="#"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone3.jpg" alt=""/></a></div>
										<div class="textbox__body">
											<h2 class="textbox__title"><a href="#">Book</a></h2>
											<div class="textbox__description">Ensure that your services are given the gratitudes they deserve. Charge for your services and organize clientele to manage future transactions.</div>
										</div>
									</div><!-- End / textbox -->
									
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End / Section -->
				
				
				<!-- Section -->
				<section class="md-section" style="background-color:#f7f7f7;padding-top:0;">
					<div class="container">
						<div class="row">
							<div class="col-md-10 col-lg-8 offset-0 offset-sm-0 offset-md-1 offset-lg-2 ">
								
								<!-- iconbox -->
								<div class="iconbox">
									<div class="iconbox__icon"><i class="ti-headphone-alt"></i></div>
									<div>
										<h2 class="iconbox__title"><a href="#">Talent Around You</a></h2>
										<div class="iconbox__description">Wishbone is geared toward structuring talented entrepreneurs by offering their service on demand. Here you will have the leniency of finding local talent, booking venues or receiving services from well respected locals demonstrating their finest quality of work. Innovation, creativity, and exposure are key qualities we ensure our talent - giving our community group the needed resources to develop their brand. Use your talents and explore the amazing opportunities that are presented within our Wishbone community.</div>
									</div>
								</div><!-- End / iconbox -->
								
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-3 ">
								
								<!-- iconbox -->
								<div class="iconbox iconbox__style-02">
									<div class="iconbox__icon"><i class="ti-announcement"></i></div>
									<div>
										<h2 class="iconbox__title"><a href="#">Brand &amp; Identity</a></h2>
										<div class="iconbox__description">Moors skirt sterilized carrots cartoon. Integer No animal would. But the makeup Reserved football</div>
									</div>
								</div><!-- End / iconbox -->
								
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3 ">
								
								<!-- iconbox -->
								<div class="iconbox iconbox__style-02">
									<div class="iconbox__icon"><i class="ti-headphone"></i></div>
									<div>
										<h2 class="iconbox__title"><a href="#">Marketing Planning</a></h2>
										<div class="iconbox__description">In regards to our partnership, Wishbone contains a service which provides members discounted rates to enhance a clientele base through our operated marketing services. Regulate your marketing strategies by working with experienced recruits at the touch of your fingertips </div>
									</div>
								</div><!-- End / iconbox -->
								
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3 ">
								
								<!-- iconbox -->
								<div class="iconbox iconbox__style-02">
									<div class="iconbox__icon"><i class="ti-timer"></i></div>
									<div>
										<h2 class="iconbox__title"><a href="#">Production Planning</a></h2>
										<div class="iconbox__description">Renting spaces has never been so easy - members will have discounted rates to rent halls, attend wishbone presented events and organize future event planning</div>
									</div>
								</div><!-- End / iconbox -->
								
							</div>
							<div class="col-sm-6 col-md-6 col-lg-3 ">
								
								<!-- iconbox -->
								<div class="iconbox iconbox__style-02">
									<div class="iconbox__icon"><i class="ti-briefcase"></i></div>
									<div>
										<h2 class="iconbox__title"><a href="#">Media Planning</a></h2>
										<div class="iconbox__description">Coverage through the community helps get your name out there; through Wishbones developed partnerships, we have partnered with well respected media sources to offer members credible insight and coverage based on the content you post. 

- From blogs, interviews, articles, and more, we provide you with inclusive media coverage throughout numerous media outlets along your journey as an independent entertainer.
</div>
									</div>
								</div><!-- End / iconbox -->
								
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
									<h6 class="title-01__subTitle">about</h6>
									<h2 class="title-01__title">Journey to become leaders in entertainment</h2>
									<div>As leaders - we are able to guide our lives towards an innovative path by creating new forms of passions, opportunities and ideas. Wishbone favours the idea of unity as a determining factor for the success of any pursued organization. Our values lie on creating a platform where we will optimize networking amongst diverse groups; making it easily accessible to reach different crowds, and build relationships that benefit all individuals. Through our rating system, we propose that satisfaction will appeal to the wishbone community by encouraging our clientele to earn and strive for the finest quality of work - making their rating a mere reflection of their work.</div>
								</div><!-- End / title-01 -->
								
								<div class="row">
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">99</h2>
											</div>
											<div class="box-number__description">Happy clients</div>
										</div><!-- End / box-number -->
										
									</div>
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">1200</h2>
											</div>
											<div class="box-number__description">Message per Day</div>
										</div><!-- End / box-number -->
										
									</div>
									<div class="col-sm-4 ">
										
										<!-- box-number -->
										<div class="box-number">
											<div class="box-number__number">
												<h2 class="js-counter" data-counter-time="2000" data-counter-delay="10">15</h2>
											</div>
											<div class="box-number__description">Awards</div>
										</div><!-- End / box-number -->
										
									</div>
								</div>
							</div>
							<div class="col-lg-6 ">
								<div class="js-consult-slider">
									
									<!-- carousel__element owl-carousel -->
									<div class="carousel__element owl-carousel" data-options='{"items":1,"loop":true,"dots":false,"nav":false,"margin":30,"responsive":{"0":{"items":2},"576":{"items":3},"992":{"items":1}}}'>
										<div class="image-full"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone4.jpg" alt=""></div>
										<!--div class="image-full"><img src="C:/Users/nanda/Desktop/Algonquin/wishbone/wishbone pictures/wishbone5.jpg" alt=""></div-->
									</div><!-- End / carousel__element owl-carousel -->
									
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End / Section -->
				
				<!-- Contact us-->
				
				<!-- Section -->
				<section class="md-section md-skin-dark js-consult-form" style="background-image:url(&quot;../assets/img/backgrounds/1.jpg&quot;);">
					<div class="md-overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col-lg-8 offset-0 offset-sm-0 offset-md-0 offset-lg-2 ">
								
								<!-- title-01 -->
								<div class="title-01 title-01__style-02">
									<h2 class="title-01__title">Contact With Us via Hot Line</h2>
									<div>However, at airports, in ferment and antioxidants, the biggest</div>
								</div><!-- End / title-01 -->
								
								<div class="consult-phone">(+88) 242 2323 777</div>
							</div>
						</div>
						
						<!-- form-01 -->
						<div class="form-01 consult-form js-consult-form__content">
							<h2 class="form-01__title">Give Us Your Feedback</h2>
							<form class="form-01__form">
								<div class="form__item form__item--03">
									<input type="text" name="name" placeholder="Your name"/>
								</div>
								<div class="form__item form__item--03">
									<input type="text" name="phone" placeholder="Your Email"/>
								</div>
								<div class="form__item form__item--03">
									<input type="email" name="email" placeholder="Your Email"/>
								</div>
								<div class="form__item">
									<textarea rows="3" name="Your message" placeholder="Your message"></textarea>
								</div>
								<div class="form__button"><a class="btn btn-primary btn-w180" href="#">send message</a>
								</div>
							</form>
						</div><!-- End / form-01 -->
						
					</div>
				</section>
				<!-- End / Section -->
				
				<!-- What’s Client Say ?-->
				
				<!-- Section -->
				<section class="md-section" style="padding-bottom:0;">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2 ">
								
								<!-- title-01 -->
								<div class="title-01" style="margin-bottom:50px;">
									<h2 class="title-01__title">What’s Client Say?</h2>
								</div><!-- End / title-01 -->
								
							</div>
						</div>
						<div class="consult-slide">
							
							<!-- carousel__element owl-carousel -->
							<div class="carousel__element owl-carousel" data-options='{"loop":true,"dots":true,"nav":false,"margin":30,"responsive":{"0":{"items":1},"992":{"items":2}}}'>
								
								<!-- testimonial -->
								<div class="testimonial">
									<div class="testimonial__info"><a class="testimonial__avatar" href="#"><img src="../assets/img/avatars/avatar-01.jpg" alt=""/></a>
										<h5 class="testimonial__name">Brandon Hanson</h5><span class="testimonial__position">Support</span>
									</div>
									<div class="testimonial__content">
										<div class="testimonial__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Architex lake and a headset. Quisque luctus nibh augue, non ultrices arcu molestie in. In</div>
									</div>
								</div><!-- End / testimonial -->
								
								
								<!-- testimonial -->
								<div class="testimonial">
									<div class="testimonial__info"><a class="testimonial__avatar" href="#"><img src="../assets/img/avatars/avatar-02.jpg" alt=""/></a>
										<h5 class="testimonial__name">Brandon Hanson</h5><span class="testimonial__position">CEO &amp; Founder</span>
									</div>
									<div class="testimonial__content">
										<div class="testimonial__text">However, at airports, in ferment and antioxidants, but the biggest thing. Tomorrow Bureau feugiat to ecological boundaries, but now. Each of said propaganda, V</div>
									</div>
								</div><!-- End / testimonial -->
								
								
								<!-- testimonial -->
								<div class="testimonial">
									<div class="testimonial__info"><a class="testimonial__avatar" href="#"><img src="../assets/img/avatars/1.jpg" alt=""/></a>
										<h5 class="testimonial__name">Maria Gutierrez</h5><span class="testimonial__position">Designer</span>
									</div>
									<div class="testimonial__content">
										<div class="testimonial__text">Moors skirt sterilized carrots cartoon. Integer No animal would. But the makeup Reserved football arrows weekend. Gluten. praesen</div>
									</div>
								</div><!-- End / testimonial -->
								
							</div><!-- End / carousel__element owl-carousel -->
							
						</div>
					</div>
				</section>
				<!-- End / Section -->
				
				
				<!-- Latest Blogs -->
				
				<!-- Section -->
				<section class="md-section consult-background">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-lg-8 offset-0 offset-sm-0 offset-md-2 offset-lg-2 ">
								
								<!-- title-01 -->
								<div class="title-01">
									<h2 class="title-01__title">Upcoming Events</h2>
								</div><!-- End / title-01 -->
								
							</div>
						</div>
						
						<!-- carousel__element owl-carousel -->
						<div class="carousel__element owl-carousel" data-options='{"loop":false,"dots":false,"nav":true,"margin":30,"responsive":{"0":{"items":1},"768":{"items":2},"992":{"items":3}}}'>
							
							<!--  -->
							<div>
								<div class="post-01__media"><a href="#"><img src="../assets/img/blogs/related-1.jpg" alt=""/></a>
								</div>
								<div>
									<ul class="post-01__categories">
										<li><a href="#">Services</a></li>
									</ul>
									<h2 class="post-01__title"><a href="#">Getting Started with Vue.Js</a></h2>
									<div class="post-01__time">Nov 16, 2017</div>
									<div class="post-01__note">by Bryan Ryan</div>
								</div>
							</div><!-- End /  -->
							
							
							<!--  -->
							<div>
								<div class="post-01__media"><a href="#"><img src="../assets/img/blogs/related-2.jpg" alt=""/></a>
								</div>
								<div>
									<ul class="post-01__categories">
										<li><a href="#">Services</a></li>
									</ul>
									<h2 class="post-01__title"><a href="#">Getting Started with Vue.Js</a></h2>
									<div class="post-01__time">Nov 4, 2017</div>
									<div class="post-01__note">by Ashley Mills</div>
								</div>
							</div><!-- End /  -->
							
							
							<!--  -->
							<div>
								<div class="post-01__media"><a href="#"><img src="../assets/img/blogs/related-3.jpg" alt=""/></a>
								</div>
								<div>
									<ul class="post-01__categories">
										<li><a href="#">Services</a></li>
									</ul>
									<h2 class="post-01__title"><a href="#">How to Create and Manage SVG Sprites</a></h2>
									<div class="post-01__time">Nov 21, 2017</div>
									<div class="post-01__note">by Alan Lane</div>
								</div>
							</div><!-- End /  -->
							
							
							<!--  -->
							<div>
								<div class="post-01__media"><a href="#"><img src="../assets/img/blogs/related-4.jpg" alt=""/></a>
								</div>
								<div>
									<ul class="post-01__categories">
										<li><a href="#">Business</a></li>
									</ul>
									<h2 class="post-01__title"><a href="#">Free Sketch Plugins</a></h2>
									<div class="post-01__time">Nov 2, 2017</div>
									<div class="post-01__note">by Alan Lane</div>
								</div>
							</div><!-- End /  -->
							
						</div><!-- End / carousel__element owl-carousel -->
						
					</div>
				</section>
				<!-- End / Section -->
				
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
