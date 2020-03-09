<?php
class EventPlanner{
    // Properties
    private $eventPlannerID;
    private $authid;
    private $firstName;
    private $lastName;
    private $imageLocation;
    
    
    function __construct( $eventPlannerID,$authid,$firstName,$lastName,$imageLocation) {
        $this->eventPlannerID = $eventPlannerID;
        $this->authid = $authid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->imageLocation = $imageLocation;
    
    }
    
    
    // mutators
    function setEventPlannerID( $eventPlannerID) {
        $this->eventPlannerID = $eventPlannerID;
    }
    
    function setAuthid( $authid) {
        $this->authid = $authid;
    }
    
    function setFirstName( $firstName) {
        $this->firstName = $firstName;
    }
    
    function setLastName( $lastName) {
        $this->lastName = $lastName;
    }
    
    function setImageLocation( $imageLocation) {
        $this->imageLocation = $imageLocation;
    }
   
    
    // accessors
    function getEventPlannerID() {
        return $this->eventPlannerID;
    }
    
    function getAuthid() {
        return $this->authid;
    }
    
    function getFirstName() {
        return $this->firstName;
    }
    
    function getLastName() {
        return $this->lastName;
    }
    
    function getImageLocation() {
        return $this->imageLocation;
    }
    
    
}

?>
