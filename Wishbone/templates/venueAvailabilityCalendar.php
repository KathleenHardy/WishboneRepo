<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upcoming Events</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- bootstrap -->
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css2/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css2/jquery.mCustomScrollbar.css">
    <!-- font awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <!-- Style.css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
  <link rel="stylesheet" type="text/css" href="../assets/css2/style.css">
  
    <link href='../assets/css/fullcalendar.css' rel='stylesheet' />
    <link href='../assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='../assets/js/jquery-1.10.2.js' type="text/javascript"></script>
    <script src='../assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
    <script src='../assets/js/fullcalendar.js' type="text/javascript"></script>
    <script src="/code.jquery.com/jquery-2.1.0.min.js" type="text/javascript" ></script>

<?php 

session_start();
include ('../config.php');
include ('../dto/availability.php');

$authId=$_SESSION['authId'];

$query0 = "SELECT venueOwnerId
          FROM venueowners
          WHERE  authid = ?";

if ($stmt0 = $connection->prepare( $query0)) {
    
    $stmt0->bind_param( "i", $authId);
    
    //execute statement
    $stmt0->execute();
    
    //bind result variables
    $stmt0->bind_result($venueOwnerId);
    
    // fetch values
    $stmt0->fetch();
    
    //close statement
    $stmt0->close();    
}


$availabilityDTO = array();

/*
 * SELECT availid, venueowners.venueOwnerId, availStartDate, availEndDate, availStartTime, availEndTime, availTitle FROM 
venueOwners inner join venues ON
venueowners.venueOwnerId = venues.venueOwnerId inner join venueavailability ON
venues.venueId = venueavailability.venueId
 */

$query = "SELECT availid, availStartDate, availEndDate, availStartTime, availEndTime, availTitle FROM 
venueOwners inner join venues ON
venueowners.venueOwnerId = venues.venueOwnerId inner join venueavailability ON
venues.venueId = venueavailability.venueId
          WHERE  venueowners.venueOwnerId = ?";

if ($stmt = $connection->prepare( $query)) {
    
    $stmt->bind_param( "i", $venueOwnerId);
    
    //execute statement
    $stmt->execute();
    
    //bind result variables
    $stmt->bind_result( $availid, $availStartDate, $availEndDate, $availStartTime, $availEndTime, $availTitle);
    
    // fetch values
    while( $stmt->fetch()) {
        $availabilityDTO[] = new Availability( $availid, $availStartDate, $availEndDate, $availStartTime, $availEndTime, $availTitle);
    }
    
    //close statement
    $stmt->close();
       
}

?>



<script>

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var events = [];

		<?php foreach( $availabilityDTO as $availability) { ?>

    		var myEvent = new Object();
    		myEvent.title = "<?= $availability->getAvailTitle() ?>";
    		myEvent.sponsor_name = "My availability";
    		myEvent.isDeletable = true;
    		myEvent.url = "venueCalenderDetail.php?id=<?= $availability->getAvailId()?>";
    		
    		myEvent.start = new Date(
    	       <?=substr( $availability->getAvailStartDate(), 0, 4)?>, 
    	       <?=substr( $availability->getAvailStartDate(), 5, 2)-1?>, 
    	       <?=substr( $availability->getAvailStartDate(), 8, 2)?>);

    		myEvent.end = new Date(
    	    	       <?=substr( $availability->getAvailEndDate(), 0, 4)?>, 
    	    	       <?=substr( $availability->getAvailEndDate(), 5, 2)-1?>, 
    	    	       <?=substr( $availability->getAvailEndDate(), 8, 2)?>);

    		myEvent.className = 'info';

    	    events.push( myEvent);

		<?php } ?>
		
		/*  className colors
		className: default(transparent), important(red), chill(pink), success(green), info(blue)
		*/

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');

				if (title) {
					$.ajax({
	                    type: "POST",
	                    url: 'venueAvailabilityCalendar.php',
	                    data: {title: title, start: start, end: end },
	                    success: function(data)
	                    {
	                    }

	        		});

					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"

					);
				}
				calendar.fullCalendar('unselect');
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				/**
				$.ajax({
                    type: "POST",
                    url: 'entertainerEventsCalendar.php',
                    data: {copiedTitle: copiedEventObject.title, copiedStart: copiedEventObject.start, copiedEnd: copiedEventObject.end },
                    success: function(data)
                    {
                    }

        		});
        		*/

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			}, 
			eventMouseover: function(event, element) {
				var deviceType = $("#deviceType").val();

				console.log(deviceType);
				
				if(deviceType == 0){
					
					var openClickPopup = 0;
					$.each($('.popout'),function(){
							if($(this).hasClass("open")){
								openClickPopup = 1;
							}
					})
				
					if(openClickPopup == 1){
						$('.tooltipevent').remove();
					}else{
						var calendar_custom_class = $("#calendar").attr("custom_class");
						var popupWidth = "260px";
							
						
						if(calendar_custom_class == "inner_calendar"){
							popupWidth = "200px";
						}

						if ( event.isDeletable) {
							var detailText = 
    							'<div id="eventContent" class="eventPopup ">' + 
    							  '<div class="">' + 
    							    '<div class="row row-centered pos">' + 
    							      '<div class="col-lg-12 col-xs-12 col-centered">' + 
    							        '<img src="../assets/images/user-bg.jpg" class="img-responsive event_image " alt=""  hegiht="140px">' +
    							          '<h3 id="event_sponcername">'+event.sponsor_name+'</h3>' + 
    							          '<h3 id="event_heading">'+event.title+'</h3>' +
    							              '<ul>' + 
    							               	'<li> <i class="fa fa-calendar"></i> Start: <span id="startDate">'+event.start+'</span> <span id="startTime">START TIME</span></li>' + 
    							               	'<li> <i class=" fa fa-map-marker"></i> Location:  <span id="eventLocation">'+event.location+'</span></li>' + 
    							               	'<li class="short_description"> <i class=" fa fa-file-text"></i> Description: <span id="eventSponsorDescription">'+event.short_description+'</span></li>' + 
    							              '</ul>' + 
    							              '<input class ="btn-all" style="display:inline;" type="submit" id="submit" name="submit" value="Delete" /> <br>' +							              
    							            '</div><div class="clearfix">' + 
    							            '</div>'+
    							         '</div>'+
    							     '</div>'+
    							  '</div>';
						} else {
    						var detailText = 
    							'<div id="eventContent" class="eventPopup ">' + 
    							  '<div class="">' + 
    							    '<div class="row row-centered pos">' + 
    							      '<div class="col-lg-12 col-xs-12 col-centered">' + 
    							        '<img src="../assets/images/user-bg.jpg" class="img-responsive event_image " alt=""  hegiht="140px">' +
    							          '<h3 id="event_sponcername">'+event.sponsor_name+'</h3>' + 
    							          '<h3 id="event_heading">'+event.title+'</h3>' +
    							              '<ul>' + 
    							               	'<li> <i class="fa fa-calendar"></i> Start: <span id="startDate">'+event.start+'</span> <span id="startTime">START TIME</span></li>' + 
    							               	'<li> <i class=" fa fa-map-marker"></i> Location:  <span id="eventLocation">'+event.location+'</span></li>' + 
    							               	'<li class="short_description"> <i class=" fa fa-file-text"></i> Description: <span id="eventSponsorDescription">'+event.short_description+'</span></li>' + 
    							              '</ul>' + 						              
    							            '</div><div class="clearfix">' + 
    							            '</div>'+
    							         '</div>'+
    							     '</div>'+
    							  '</div>';
						}
						
						var eventDetail = '<div class="showEventDetail '+calendar_custom_class+'_page'+'">'+detailText+'</div>';
						
						var tooltip = '<div class="tooltipevent" style="width:'+popupWidth+';background:#fff;padding-top:5px;padding-bottom:5px;border:4px solid #D9E0E7;position:absolute;z-index:10001;">' + eventDetail + '</div>';
						$("body").append(tooltip);
						
							
						$(this).mouseover(function(e) {
							$(this).css('z-index', 10000);
							$('.tooltipevent').fadeIn('500');
							$('.tooltipevent').fadeTo('10', 1.9);
							
						}).mousemove(function(e) {
							var offset = $(this).offset();
							//alert(offset.top +'===>'+offset.left); 
							var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
							var a = new Date(event.start_date);
							var weekday = weekday[a.getDay()];
							
							var addExtraLeft = 50;
							if(weekday == "Saturday"){
								addExtraLeft = addExtraLeft * 2;
							}else if(weekday == "Sunday"){
								addExtraLeft = 0;
							}
							
							$('.tooltipevent').css('top', e.pageY + 15);
							$('.tooltipevent').css('left', Math.round(offset.left - addExtraLeft));
						});
					}
				
					}
				
			},
			eventMouseout: function(event, element) {

				//if ( event.isDeletable) {
					
				//} else {
					var deviceType = $("#deviceType").val();
					if(deviceType == 0){
						 $(this).css('z-index', 8);
						 $('.tooltipevent').remove();
				//	}
				}
			},
			events,
			
			/**
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				}
				],
			
			
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 30),
					url: 'http://google.com/',
					className: 'success'
				}
			],
			*/
			
			
		});


	});

</script>
<?php 
if (isset($_POST['title'])) {

    $query2 = "INSERT INTO venueavailability
              (venueId, availStartDate, availEndDate, availStartTime, availEndTime, availTitle)
              VALUES
              (?,?,?,?,?,?)";
    
    if ($stmt2 = $connection->prepare( $query2)) {
        
        $stmt2->bind_param( "isssss", $venueid_, $availStartDate, $availEndDate, $availStartTime, $availEndTime, $availTitle);
        
        //Set params
        $venueid_ = 1;
        $availStartDate = formatDate($_POST['start']);
        $availEndDate = formatDate($_POST['end']);
        $availStartTime = '00:00:00';
        $availEndTime = '00:00:00';
        $availTitle = $_POST['title'];
        
        //execute statement
        $stmt2->execute();
        
        //close statement
        $stmt2->close();
    }
}


function formatDate(string $date) {

    $year=substr( $date, 11, 4);
    
    $month=0;
    
    if ( substr( $date, 4, 3) == "Jan") {
        $month=1;
    } else if ( substr( $date, 4, 3) == "Feb") {
        $month=2;
    } else if ( substr( $date, 4, 3) == "Mar") {
        $month=3;
    } else if ( substr( $date, 4, 3) == "Apr") {
        $month=4;
    } else if ( substr( $date, 4, 3) == "May") {
        $month=5;
    } else if ( substr( $date, 4, 3) == "Jun") {
        $month=6;
    } else if ( substr( $date, 4, 3) == "Jul") {
        $month=7;
    } else if ( substr( $date, 4, 3) == "Aug") {
        $month=8;
    } else if ( substr( $date, 4, 3) == "Sep") {
        $month=9;
    } else if ( substr( $date, 4, 3) == "Oct") {
        $month=10;
    } else if ( substr( $date, 4, 3) == "Nov") {
        $month=11;
    } else if ( substr( $date, 4, 3) == "Dec") {
        $month=12;
    }
    
    $day = substr( $date, 8, 2);
    
    return $year .'-'. $month . '-' . $day;
}

?>

<style>

	body {
		/* margin-top: 40px; */
		text-align: center;
		font-size: 14px;
		font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
		background-color: #DDDDDD;
		}

	#wrap {
		width: 1100px;
		margin: 0 auto;
		}

	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		text-align: left;
		}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}

	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
/* 		float: right; */
        margin: 0 auto;
		width: 900px;
		background-color: #FFFFFF;
		  border-radius: 6px;
        box-shadow: 0 1px 50px #C3C3C3;
		}

</style>


</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="entertainerDashboardHome.php">
                            <h4>WISHBONE</h4>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="../assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="../assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="entertainerViewProfile-New.php">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="index.php">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="../assets/images/avatar-4.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details">John Doe<i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 p-b-0">
                                <form class="form-material">
                                    <div class="form-group form-primary">
                                        <input type="text" name="footer-email" class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Here</label>
                                    </div>
                                </form>
                            </div>
                            <div class="pcoded-navigation-label">NAVIGATION</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="entertainerDashboardHome.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="messages.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-email"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Messages</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>    
                                <li class="">
                                    <a href="bookmarks.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-bookmark"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Bookmarks</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="reviews.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-star"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Reviews</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">ORGANIZE AND MANAGE</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-list-alt"></i><b>BC</b></span>
                                        <span class="pcoded-mtext">Events</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="venueHostUpcomingEvents.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Upcoming</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="venueHostPastEvents.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Past</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="venueAvailabilityCalendar.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-calendar"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Calendar</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>                                
                                <li class="">
                                    <a href="venueHostAllEntertainers.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Book Entertainers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> 
                                <li class="">
                                    <a href="venueHostVenueList.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fas fa-building"></i><b>D</b></span>
                                        <span class="pcoded-mtext">My Venues</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>                                                                                               
                            </ul>
                            <div class="pcoded-navigation-label">ACCOUNT</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="form-elements-component.html" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-cog"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Settings</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="index.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Logout</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->

                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
<div id='wrap'>

<div id='calendar'></div>

<div style='clear:both'></div>
</div>
 <div style="text-align: center;">
 <h1 class="main-title" style="padding: 50px; text-align: center;">
Venue Availabilities

</h1>
</div>

<div class="outer">
	<button type="button"><a href="addVenueAvailability-New.php">Add New Availability</a></button>
</div>



                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Jquery -->
    <!--  <script type="text/javascript" src="../assets/javascript/jquery/jquery.min.js "></script> -->
    <script type="text/javascript" src="../assets/javascript/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/javascript/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/javascript/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/javascript/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="../assets/javascript/jquery.mCustomScrollbar.concat.min.js "></script>

    <!-- menu js -->
    <script src="../assets/javascript/pcoded.min.js"></script>
    <script src="../assets/javascript/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="../assets/javascript/script.js "></script>
    <input type="hidden" id="deviceType" value="0">
</body>

</html>
