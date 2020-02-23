<?php
class Venue {
    // Properties
    private $venueID;
    private $venueOwnerID;
    private $venueName;
    private $venueCity;
    private $venueState;
    private $venueProvince;
    
    function __construct( $venueID, $venueOwnerID, $venueName, $venueCity, $venueState, $venueProvince) {
        $this->venueID = $venueID;
        $this->venueOwner = $venueOwnerID;
        $this->venueName = $venueName;
        $this->venueCity = $venueCity;
        $this->venueState = $venueState;
        $this->venueProvince = $venueProvince;
    }
    

    // mutators
    function setVenueID( $venueID) {
        $this->venueID = $venueID;
    }
    
    function setVenueOwnerID( $venueOwnerID) {
        $this->venueOwnerID = $venueOwnerID;
    }
    
    function setVenueName( $venueName) {
        $this->venueName = $venueName;
    }
    
    function setVenueCity( $venueCity) {
        $this->venueCity = $venueCity;
    }
    
    function setVenueState( $venueState) {
        $this->venueState = $venueState;
    }
    
    function setVenueProvince( $venueProvince) {
        $this->venueProvince = $venueProvince;
    }

    
    // accessors
    function getVenueID() {
        return $this->venueID;
    }
    
    function getVenueOwnerID() {
        return $this->venueOwnerID;
    }
    
    function getVenueName() {
        return $this->venueName;
    }
    
    function getVenueCity() {
        return $this->venueCity;
    }
    
    function getVenueState() {
        return $this->venueState;
    }
    
    function getVenueProvince() {
        return $this->venueProvince;
    }
    

    
}

?>
