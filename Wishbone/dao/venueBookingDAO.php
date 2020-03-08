<?php
require_once ('abstractDAO.php');
require_once ('./model/venueBooking.php');

class VenueBookingDAO extends AbstractDAO
{

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
       }
    }

    public function createNewBooking($bookedVenue)
    {


        if (! $this->mysqli->connect_errno) {

            $query1="SELECT venueId FROM venues WHERE venueName = ?";
            $venueName=$bookedVenue->getVenueName();
            $stmt1 = $this->mysqli->prepare($query1);
            $stmt1->bind_param('s', $venueName);
            $stmt1->execute();
            $stmt1->bind_result($venueId);
            $stmt1->fetch();
            $stmt1->close();
            

            $querya = "SELECT resAvailId FROM resourceAvailability WHERE venueId = ?";
            $stmta = $this->mysqli->prepare($querya);
            $stmta->bind_param('i', $venueId);
            $stmta->execute();
            $stmta->bind_result($resAvailId);
            $stmta->fetch();
            $stmta->close();
            

            $query2 = "INSERT INTO bookedVenues(resAvailId, eventPlannerId, venueId)
							VALUES(?,1,?)";

            $stmt2 = $this->mysqli->prepare($query2);
            $stmt2->bind_param('ii', $resAvailId, $venueId);
            $stmt2->execute();

            return $bookedVenue->getVenueName() . ' booked successfully';
            // }
        } else {
            return 'Could not connect to Database';
        }
    }
}
?>