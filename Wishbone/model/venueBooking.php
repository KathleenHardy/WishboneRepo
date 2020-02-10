<?php

class VenueBooking
{

    private $venueName;

    function __construct($venueName)
    {
        $this->venueName = $venueName;
        
    }

    public function getVenueName()
    {
        return $this->venueName;
    }

    public function setVenueName($venueName)
    {
        $this->venueName = $venueName;
    }


}
?>