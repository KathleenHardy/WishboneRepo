<?php

class BookedGigDetails {
    private $gigsName;
    private $gigsDetails;
    private $eventDate;
    private $venueName;
    private $venueCity;
    private $venueProvince;
    
    private $firstName;
    private $lastName;
    private $email;
    
    
    function __construct( $gigsName, $gigsDetails, $eventDate , $venueName,
        $venueCity, $venueProvince, $firstName, $lastName, $email) {
            
            $this->gigsName = $gigsName;
            $this->gigsDetails = $gigsDetails;
            $this->eventDate = $eventDate;
            $this->venueName = $venueName;
            $this->venueCity = $venueCity;
            $this->venueProvince = $venueProvince;
            
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;    
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
    
    function setEmail( $email) {
        $this->email = $email;
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
    
    function getEmail() {
        return $this->email;
    }
    
    
    
}

?>