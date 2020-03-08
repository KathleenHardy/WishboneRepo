<?php
class Venue {
    // Properties
    private $venueID;
    private $venueOwnerID;
    private $venueName;
    private $venueCity;
    private $venueState;
    private $venueProvince;
    private $venueDescription;
    private $venuePicture;
    
    
    function __construct( $venueID, $venueOwnerID, $venueName, $venueCity, $venueState, $venueProvince, $venueDescription, $venuePicture) {
        $this->venueID = $venueID;
        $this->venueOwner = $venueOwnerID;
        $this->venueName = $venueName;
        $this->venueCity = $venueCity;
        $this->venueState = $venueState;
        $this->venueProvince = $venueProvince;
        $this->venueDescription = $venueDescription;
        $this->venuePicture = $venuePicture;
        
    }
    

    /**
     * @return mixed
     */
    public function getVenueDescription()
    {
        return $this->venueDescription;
    }

    /**
     * @return mixed
     */
    public function getVenuePicture()
    {
        return $this->venuePicture;
    }

    /**
     * @param mixed $venueDescription
     */
    public function setVenueDescription($venueDescription)
    {
        $this->venueDescription = $venueDescription;
    }

    /**
     * @param mixed $venuePicture
     */
    public function setVenuePicture($venuePicture)
    {
        $this->venuePicture = $venuePicture;
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
