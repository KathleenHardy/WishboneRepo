<?php
class Gig {
    // Properties
    private $gigsID;
    private $gigsName;
    private $gigsCategory;
    private $gigsArtType;
    private $gigsDetails;
    private $gigsNotes;
    
    
    function __construct( $gigsID, $gigsName, $gigsCategory, $gigsArtType, $gigsDetails, $gigsNotes) {
        $this->gigsID = $gigsID;
        $this->gigsName = $gigsName;
        $this->gigsCategory = $gigsCategory;
        $this->gigsArtType = $gigsArtType;
        $this->gigsDetails = $gigsDetails;
        $this->gigsNotes = $gigsNotes;
    }
    
    
    // mutators
    function setGigsID( $gigsID) {
        $this->gigsID = $gigsID;
    }
    
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
    
    // accessors
    function getGigsID() {
        return $this->gigsID;
    }
    
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
    
}

?>
