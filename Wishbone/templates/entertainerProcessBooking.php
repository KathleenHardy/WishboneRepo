<?php
 session_start();

 include ('../config.php');

 if(isset($_SESSION['authId']) )
 {
     $requestID = $_GET["id"];
     $query2 = "SELECT * 
             FROM bookingrequests where bookingReqId = ".$requestID;
             
     $result = mysqli_query($connection, $query2) or die(mysqli_error($connection));
     
     $count = mysqli_num_rows($result);
             
     if ($count >= 1) {
             
         while ($row = mysqli_fetch_array($result)) {

             $entid = $row["entid"];

 
             $querya = 'SELECT authId FROM entertainers WHERE entid = ?';
             $stmta =mysqli_prepare ($connection,$querya);
             $stmta->bind_param('s', $entid);
             $stmta->execute();
             $stmta->bind_result($authid);
             $stmta->fetch();
             $stmta->close();
 
             if($authid == $_SESSION['authId']){

                 $eventName = $row["event_name"];

                 $eventDate = $row["event_date"];
 
                 $eventDescription = $row["event_description"];
             
                 $gigssid = $row["gigsid"];

                 $eventPlannerId = $row["eventPlannerId"];

                 $entid = $row["entid"];

                 $venueOwnerId = $row["venueOwnerId"];

                 $venueid = $row["venueid"];

                 if(isset($_GET['accept']))
                 {
                                 //query to insrt into bookedgigs
                 $query = "insert into bookedgigs(entid,gigsid,eventPlannerId,venueOwnerId,venueId,event_name,event_date,event_description) 
                 values(".$entid.",".$gigssid.",".$eventPlannerId.",".$venueOwnerId.",".$venueid.",'".$eventName."','".$eventDate."','".$eventDescription."');";
                         //if success then show success msg else show error msg
                         $conn =   mysqli_query($connection,$query);
                             if($conn  === TRUE)
                             {
                                 ?>
                                 <script type="text/javascript">
                                 alert("Booking Accepted!");
                                 window.location.href = 'entertainerDashboardHome.php';
                                 </script>
                                 <?php
                             }else  {
                                 echo "<script type='text/javascript'>alert('".mysqli_error($connection)."');</script>";
                                 echo mysqli_error($connection);
                             }  
                 }
                 else if(isset($_GET['reject']))
                 {
                     ?>
                     <script type="text/javascript">
                     alert("Booking Rejected!");
                     window.location.href = 'entertainerDashboardHome.php';
                     </script>
                     <?php
                 }
                 
                 
                 if ( isset($_GET['reject']) || isset($_GET['accept'])) {
                     $deleteFromNotifications = "delete from entertainerbookingnotifications where bookingRequestId=?";
                     
                     if ($stmt2 = $connection->prepare( $deleteFromNotifications)) {
                         
                         $stmt2->bind_param( "i", $requestID_);
                         
                         //Set params
                         $requestID_ = $requestID;
                         //execute statement
                         $stmt2->execute();
                         
                     }
                 }
                 
            

             }
             else
             {
                 //this request is not for this current logged in entertainer
                 ?>

                 <script type="text/javascript">
                 window.location.href = 'index.php';
                 </script>
 
                 <?php
             }
         
         }
     } else {
                 // $fmsg = "No venues for this user";
     }
     
     


 
             
     mysqli_close($connection);
     
 }
 else
 {
         //if not logged in then redirect to login
         ?>

         <script type="text/javascript">
         window.location.href = 'login.php';
         </script>

         <?php
 }

?>