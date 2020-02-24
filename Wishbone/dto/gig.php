<?php
class Gig {
    // Properties
    private $gigsID;
    private $gigsName;
    private $gigsCategory;
    private $gigsLabel;
    private $gigsArtType;
    private $gigsDetails;
    private $gigsNotes;
    private $gigsPictures = array();
    
    
    function __construct( $gigsID, $gigsName, $gigsCategory, $gigsLabel, $gigsArtType, $gigsDetails, $gigsNotes) {
        $this->gigsID = $gigsID;
        $this->gigsName = $gigsName;
        $this->gigsCategory = $gigsCategory;
        $this->gigsLabel = $gigsLabel;
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
    
    function setGigsLabel( $gigsLabel) {
        $this->gigsLabel = $gigsLabel;
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
    
    function addGigsPictures( array $pictures) {
        $this->gigsPictures = array_merge( $this->gigsPictures, $pictures);
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
    
    function getGigsLabel() {
        return $this->gigsLabel;
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
    
    function getGigsPictures() {
        return $this->gigsPictures;
    }
    
}

?>
