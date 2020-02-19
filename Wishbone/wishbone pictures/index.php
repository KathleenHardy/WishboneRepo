<!DOCTYPE html>
<html>
<head>
<title>WISHBONE</title>
<meta charset="utf-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="assets/css/homepageEffect.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<link href="https://fonts.googleapis.com/css?family=Archivo&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
</script>
<script src="assets/js/main.js"></script>
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
<?php include "navigationheaderHome.php" ?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="20000">
  <div class="carousel-inner">
    <div class="carousel-item active slide-one" style="background-repeat:no-repeat; background-size:cover;background-image: url('assets/img/mainpage-effect/concert.jpg')">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="wrappedtext">
        <h3 class ="first" style="color: #feb154; font-family: 'Archivo', sans-serif;"><span id="first">WELCOME ENTERTAINERS, <span id="second"
     class="txt-rotate" data-period="2000" data-rotate='[ "PROMOTE YOUR BRAND.", "CREATE YOUR PROFILE.", "ADD YOUR GIGS.", "PERFORM FOR AUDIENCES.", "DO ALL OF THE ABOVE." ]'></span></span></h3>
            <br/><a href="login.php"><button type ="button" class="mainbutton1">Get Started</button></a>
        </div>
        </div>
        </div>
        </div>
        </div>
    <div class="carousel-item slide-two" style="background-repeat:no-repeat; background-size:cover;background-image: url('assets/img/mainpage-effect/gallery4.jpg')">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="wrappedtext">
        <h3 class ="first" style="color: #feb154; font-family: 'Archivo', sans-serif;"><span id="first">WELCOME EVENT PLANNERS, <span id="second"
     class="txt-rotate" data-period="2000" data-rotate='[ "FIND AWESOME ENTERTAINERS.", "SELECT YOUR VENUE.", "PLAN EVENTS WITH NO CONFLICTS.", "CHOOSE WHAT YOU WANT." ]'></span></span></h3>
            <br/><a href="login.php"><button type ="button" class="mainbutton1">Get Started</button></a>
        </div>
        </div>
        </div>
        </div>
        </div>
    <div class="carousel-item slide-three" style="background-repeat:no-repeat; background-size:cover;background-image: url('assets/img/mainpage-effect/venue2.jpg')">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="wrappedtext">
        <h3 class ="first" style="color: #feb154; font-family: 'Archivo', sans-serif;"><span id="first">WELCOME VENUE HOSTS, <span id="second"
     class="txt-rotate" data-period="2000" data-rotate='[ "FIND AWESOME ENTERTAINERS.", "UPDATE YOUR INFORMATION.", "HOST AMAZING EVENTS.", "CHOOSE WHAT YOU WANT." ]'></span></span></h3>
            <br/><a href="login.php"><button type ="button" class="mainbutton1">Get Started</button></a>
        </div>
        </div>
        </div>
        </div>
        </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="main-heading" style="top: 20%; left: 33%;">
<h1 style="text-align: center; letter-spacing: -1px; color: #feb154; font-family: 'Archivo', sans-serif; font-size: 100px; font-weight: 800; opacity: 1;">
WISHBONE</h1>
<h5 class="animated heartBeat delay-2s" style="text-align: center; letter-spacing: -1px; color: white; font-weight: bold; font-family: 'Playfair Display', serif;">Discover, Connect & Book At The Thought Of A Wish</h5>
</div>
</body>
</html>