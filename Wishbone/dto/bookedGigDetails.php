<?php

class BookedGigDetails {
    private $bookedGigsId;
    private $gigsName;
    private $gigsDetails;
    private $eventDate;
    private $eventDescription;
    private $venueName;
    private $venueCity;
    private $venueProvince;
    private $evtname;
    private $firstName;
    private $lastName;
    private $email;
    
    
    
    function __construct() {
    }
    
    function setBookedGigsId( $bookedGigsId) {
        $this->bookedGigsId = $bookedGigsId;
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
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function getBookedGigsId() {
        return $this->bookedGigsId;
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
    
    function getEmail() {
        return $this->email;
    }
    
    
}

?>