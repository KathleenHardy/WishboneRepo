<?php
include ('../config.php'); 
require_once ('../dto/gig.php');
session_start();

$user_check = $_SESSION['useremail'];


$infoQuery = "SELECT authid,userType
		      FROM authentication
 			  WHERE authentication.email = '$user_check'";

$result = mysqli_query($connection, $infoQuery) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$auth_id = $row['authid'];
$userType = $row['userType'];

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$aboutMe = $_POST['aboutMe'];

if($userType==1){//Event Planer
    $updateQuery = "UPDATE eventplanners set firstName='$firstName' , lastName='$lastName' where authid='$auth_id'";
    $result = mysqli_query($connection, $updateQuery) or die(mysqli_error($connection));
    $_SESSION['entertainerfirstname'] = $firstName;
    $_SESSION['entertainerlastname'] = $lastName;
    
    
    mysqli_close($connection);
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if($userType==2){//Entertainer
    $updateQuery = "UPDATE entertainers set firstName='$firstName' , lastName='$lastName' , aboutMe='$aboutMe' where authid='$auth_id'";
    $result = mysqli_query($connection, $updateQuery) or die(mysqli_error($connection));
    $_SESSION['entertainerfirstname'] = $firstName;
    $_SESSION['entertainerlastname'] = $lastName;  
    
    mysqli_close($connection);
    header('Location: ' . 'entertainerPortfolio.php');
}else if($userType==3){//Venue Owner
    $updateQuery = "UPDATE venueowners set firstName='$firstName' , lastName='$lastName' where authid='$auth_id'";
    $result = mysqli_query($connection, $updateQuery) or die(mysqli_error($connection));
    $_SESSION['entertainerfirstname'] = $firstName;
    $_SESSION['entertainerlastname'] = $lastName;
    
    
    mysqli_close($connection);
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



?>
