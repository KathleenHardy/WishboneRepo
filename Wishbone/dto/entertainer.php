<?php
class Entertainer {
    // Properties
    private $entID;
    private $firstName;
    private $lastName;
    private $ratePerHour;
    private $profilePicture;
    private $homePagePicture;
    private $aboutMe;
    private $occupation;
    private $workDescription;
    
    function __construct() {
        
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
    
    function setProfilePicture( $profilePicture) {
        $this->profilePicture = $profilePicture;
    }
    
    function setHomePagePicture( $homePagePicture) {
        $this->homePagePicture = $homePagePicture;
    }
    
    function setAboutMe( $aboutMe) {
        $this->aboutMe = $aboutMe;
    }
    
    function setOccupation( $occupation) {
        $this->occupation = $occupation;
    }
    
    function setWorkDescription( $workDescription) {
        $this->workDescription = $workDescription;
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
    
    function getProfilePicture() {
        return $this->profilePicture;
    }
    
    function getHomePagePicture() {
        return $this->homePagePicture;
    }
    
    function getAboutMe() {
        return $this->aboutMe;
    }
    
    function getOccupation() {
        return $this->occupation;
    }
    
    function getWorkDescription() {
        return $this->workDescription;
    }
    
}

?>
