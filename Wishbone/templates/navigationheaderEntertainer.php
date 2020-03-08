<?php 
if(!isset($_SESSION)){session_start();}
include ('../config.php');
include ('../enums/profileStatus.php');

$authId = $_SESSION['authId'];

$query = "SELECT profileStatus 
          FROM entertainers
          WHERE  authid = ?";

if ($stmt = $connection->prepare( $query)) {

    $stmt->bind_param( "i", $authId);
    
    //execute statement
    $stmt->execute();

    //bind result variables
    $stmt->bind_result( $profileStatus);
    
    // fetch values
    $stmt->fetch();
    
    //close statement
    $stmt->close();
      
}
?>

<!-- Navigation Bar -->
<header>
  <!-- Navbar -->
  <nav class="js-navbar-scroll navbar fixed-top navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <span style="color: #feb154; font-family: 'Archivo', sans-serif;">WISHBONE</span>
      </a>

      <button class="navbar-toggler" type="button"
              data-toggle="collapse"
              data-target="#navbarTogglerDemo"

              aria-controls="navbarTogglerDemo"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo">

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item mr-4 mb-2 mb-lg-0">
            <a class="nav-link" href="entertainerEventList.php">My Events</a>
          </li>
          <li class="nav-item mr-4 mb-2 mb-lg-0">
            <a class="nav-link" href="entertainerPortfolio.php">Portfolio</a>
          </li>
          <li class="nav-item mr-4 mb-2 mb-lg-0">
            <a class="nav-link" href="entertainerAvailabilityList.php">My Availabilities</a>
          </li>
<?php
if ( $profileStatus == ProfileStatus::INCOMPLETE || $profileStatus == ProfileStatus::NOT_CREATED) {
  print'
       <li class="nav-item mr-4 mb-2 mb-lg-0">
            <a class="nav-link" href="entertainerPortfolioEmpty.php">Create Portfolio</a>
       </li> 
       '; 
}
?>
          <li class="nav-item mr-4 mb-2 mb-lg-0">
            <a class="nav-link" href="index.php">Logout</a>
          </li>              
         </ul>               
      </div>
    </div>
  </nav>
 </header>
<!-- End navigation top bar -->
