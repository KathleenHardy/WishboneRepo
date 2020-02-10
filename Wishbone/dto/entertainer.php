<?php
class Entertainer {
    // Properties
    private $entID;
    private $firstName;
    private $lastName;
    private $ratePerHour;
    private $imageLocation;
    private $homePagePicture;
    private $aboutMe;
    
    function __construct( $entID, $firstName, $lastName, $ratePerHour, $imageLocation, $homePagePicture, $aboutMe) {
        $this->entID = $entID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->ratePerHour = $ratePerHour;
        $this->imageLocation = $imageLocation;
        $this->homePagePicture = $homePagePicture;
        $this->aboutMe = $aboutMe;
    }
    

    // mutators
    function setEntID( $entID) {
        $this->entID = $entID;
    }
    
    function setFirstName( $firstName) {
        $this->firstName = $firstName;
    }
    
    function setLastName( $lastName) {
        $this->lastName = $lastName;
    }
    
    function setRatePerHour( $ratePerHour) {
        $this->ratePerHour = $ratePerHour;
    }
    
    function setImageLocation( $imageLocation) {
        $this->imageLocation = $imageLocation;
    }
    
    function setHomePagePicture( $homePagePicture) {
        $this->homePagePicture = $homePagePicture;
    }
    
    function setAboutMe( $aboutMe) {
        $this->aboutMe = $aboutMe;
    }
    
    // accessors
    function getEntID() {
        return $this->entID;
    }
    
    function getFirstName() {
        return $this->firstName;
    }
    
    function getLastName() {
        return $this->lastName;
    }
    
    function getRatePerHour() {
        return $this->ratePerHour;
    }
    
    function getImageLocation() {
        return $this->imageLocation;
    }
    
    function getHomePagePicture() {
        return $this->homePagePicture;
    }
    
    function getAboutMe() {
        return $this->aboutMe;
    } 
    
}

?>
