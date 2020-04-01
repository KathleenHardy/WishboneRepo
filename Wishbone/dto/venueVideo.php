<?php
class venueVideo {
    // Properties
    private $venueVideoId;
    private $venueId;
    private $venueVideoEmbedCode;
    
    function __construct( $venueVideoId, $venueId, $venueVideoEmbedCode) {
        $this->venueVideoId = $venueVideoId;
        $this->venueId = $venueId;
        $this->venueVideoEmbedCode = $venueVideoEmbedCode;
        
        
    }

    /**
     * @return mixed
     */
    public function getVenueVideoId()
    {
        return $this->venueVideoId;
    }

    /**
     * @return mixed
     */
    public function getVenueId()
    {
        return $this->venueId;
    }

    /**
     * @return mixed
     */
    public function getVenueVideoEmbedCode()
    {
        return $this->venueVideoEmbedCode;
    }

    /**
     * @param mixed $venueVideoId
     */
    public function setVenueVideoId($venueVideoId)
    {
        $this->venueVideoId = $venueVideoId;
    }

    /**
     * @param mixed $venueId
     */
    public function setVenueId($venueId)
    {
        $this->venueId = $venueId;
    }

    /**
     * @param mixed $venueVideoEmbedCode
     */
    public function setVenueVideoEmbedCode($venueVideoEmbedCode)
    {
        $this->venueVideoEmbedCode = $venueVideoEmbedCode;
    }


    
 

    
}

?>
