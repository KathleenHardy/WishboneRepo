<?php
class GigDetails {
    
    private $gigsName;
    private $gigsCategory;
    private $gigsArtType;
    private $gigsDetails;
    private $gigsNotes;
    
    private $firstName;
    private $lastName;
    private $ratePerHour;
    private $aboutMe;
    
    private $startDate;
    private $endDate;
    private $startTime;
    private $endTime;
    
    
    function __construct( $gigsName, $gigsCategory, $gigsArtType, $gigsDetails, $gigsNotes , $firstName, 
        $lastName, $ratePerHour, $aboutMe, $startDate, $endDate, $startTime, $endTime) {
        
        $this->gigsName = $gigsName;
        $this->gigsCategory = $gigsCategory;
        $this->gigsArtType = $gigsArtType;
        $this->gigsDetails = $gigsDetails;
        $this->gigsNotes = $gigsNotes;
        
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->ratePerHour = $ratePerHour;
        $this->aboutMe = $aboutMe;
        
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        
    }
    
    
    // mutators
    
    function setGigsName( $gigsName) {
        $this->gigsName = $gigsName;
    }
    
    function setGigsCategory( $gigsCategory) {
        $this->gigsCategory = $gigsCategory;
    }
    
    function setGigsArtType( $gigsArtType) {
        $this->gigsArtType = $gigsArtType;
    }
    
    function setGigsDetails( $gigsDetails) {
        $this->gigsDetails = $gigsDetails;
    }
    
    function setGigsNotes( $gigsNotes) {
        $this->gigsNotes = $gigsNotes;
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
    
    function setAboutMe( $aboutMe) {
        $this->aboutMe = $aboutMe;
    }
    
    function setStartDate( $startDate) {
        $this->startDate = $startDate;
    }
    
    function setEndDate( $endDate) {
        $this->endDate = $endDate;
    }
    
    function setStartTime( $startTime) {
        $this->startTime = $startTime;
    }
    
    function setEndTIme( $endTime) {
        $this->endTime = $endTime;
    }
    
    
    
    
    
    
    // accessors
    
    function getGigsName() {
        return $this->gigsName;
    }
    
    function getGigsCategory() {
        return $this->gigsCategory;
    }
    
    function getGigsArtType() {
        return $this->gigsArtType;
    }
    
    function getGigsDetails() {
        return $this->gigsDetails;
    }
    
    function getGigsNotes() {
        return $this->gigsNotes;
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
    
    function getAboutMe() {
        return $this->aboutMe;
    }
    
    function getStartDate() {
        return $this->startDate;
    }
    
    function getEndDate() {
        return $this->endDate;
    }
    
    function getStartTime() {
        return $this->startTime;
    }
    
    function getEndTIme() {
        return $this->endTime;
    }

}

?>