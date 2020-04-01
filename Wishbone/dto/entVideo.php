<?php
class entVideo {
    // Properties
    private $entVideoId;
    private $entId;
    private $entVideoEmbedCode;

    function __construct( $entVideoId, $entId, $entVideoEmbedCode) {
        $this->entVideoId = $entVideoId;
        $this->entId = $entId;
        $this->entVideoEmbedCode = $entVideoEmbedCode;
        
        
    }
    
    /**
     * @return mixed
     */
    public function getEntVideoId()
    {
        return $this->entVideoId;
    }

    /**
     * @return mixed
     */
    public function getEntId()
    {
        return $this->entId;
    }

    /**
     * @return mixed
     */
    public function getEntVideoEmbedCode()
    {
        return $this->entVideoEmbedCode;
    }

    /**
     * @param mixed $entVideoId
     */
    public function setEntVideoId($entVideoId)
    {
        $this->entVideoId = $entVideoId;
    }

    /**
     * @param mixed $entId
     */
    public function setEntId($entId)
    {
        $this->entId = $entId;
    }

    /**
     * @param mixed $entVideoEmbedCode
     */
    public function setEntVideoEmbedCode($entVideoEmbedCode)
    {
        $this->entVideoEmbedCode = $entVideoEmbedCode;
    }

   
    

    

    
}

?>
