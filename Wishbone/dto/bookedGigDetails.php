<?php

class BookedGigDetails {
    private $gigsName;
    private $gigsDetails;
    private $eventNamee;
    private $eventDate;
    private $eventDescription;
    private $venueName;
    private $venueCity;
    private $venueProvince;
    private $evtname;
    private $firstName;
    private $lastName;

    
    
    function __construct( $gigsName, $gigsDetails, $eventDate, $eventDescription , $venueName,
        $venueCity, $venueProvince, $firstName, $lastName,$evtname) {
            
            $this->gigsName = $gigsName;
            $this->gigsDetails = $gigsDetails;
            $this->eventDate = $eventDate;
            $this->venueName = $venueName;
            $this->venueCity = $venueCity;
            $this->venueProvince = $venueProvince;
            
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            
	    $this->eventDescription = $eventDescription;
            $this->evtname = $evtname;
    }
    
    function setGigsName( $gigsName) {
        $this->gigsName = $gigsName;
    }
    
    function setGigsDetails( $gigsDetails) {
        $this->gigsDetails = $gigsDetails;
    }
    
    function setEventDate( $eventDate) {
        $this->eventDate = $eventDate;
    }
    
    function setVenueName( $venueName) {
        $this->venueName = $venueName;
    }
    
    function setVenueCity( $venueCity) {
        $this->venueCity = $venueCity;
    }
    
    function setVenueProvince( $venueProvince) {
        $this->venueProvince = $venueProvince;
    }
    
    function setFirstName( $firstName) {
        $this->firstName = $firstName;
    }
    
    function setLastName( $lastName) {
        $this->lastName = $lastName;
    }
    
    function setEventName($eventName) {
        $this->evtname = $eventName;
    }
    
    function setEventDescription($eventDescription) {
        $this->eventDescription = $eventDescription;
    }

 	function getEventDescription() {
        return $this->eventDescription;
    }    

    function getEventName() {
        return $this->evtname;
    }  

    function getGigsName() {
        return $this->gigsName;
    }
    
    function getGigsDetails() {
        return $this->gigsDetails;
    }
    
    function getEventDate() {
        return $this->eventDate;
    }
    
    function getVenueName() {
        return $this->venueName;
    }
    
    function getVenueCity() {
        return $this->venueCity;
    }
    
    function getVenueProvince() {
        return $this->venueProvince;
    }    
    
    function getFirstName() {
        return $this->firstName;
    }
    
    function getLastName() {
        return $this->lastName;
    }
    

    
    
}

?>