<?php
class Occupation {
    // Properties
    private $occupationID;
    private $entertainerID;
    private $occupation;
    
    function __construct() { 
    }
    

    public function getOccupationID()
    {
        return $this->occupationID;
    }

    public function getEntertainerID()
    {
        return $this->entertainerID;
    }
    
    public function getOccupation()
    {
        return $this->occupation;
    }

    
    public function setOccupationID( $occupationID)
    {
        $this->occupationID = $occupationID;
    }
    
    public function setEntertainerID( $entertainerID)
    {
        $this->entertainerID = $entertainerID;
    }

    public function setOccupation( $occupation)
    {
        $this->occupation = $occupation;
    }
   
}

?>
