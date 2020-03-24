<?php
class Availability {
    // Properties
    private $availId;
    private $availStartDate;
    private $availEndDate;
    private $availStartTime;
    private $availEndTime;
    private $availTitle;
    
    /**
     * @return mixed
     */
    public function getAvailId()
    {
        return $this->availId;
    }

    /**
     * @return mixed
     */
    public function getAvailStartDate()
    {
        return $this->availStartDate;
    }

    /**
     * @return mixed
     */
    public function getAvailEndDate()
    {
        return $this->availEndDate;
    }

    /**
     * @return mixed
     */
    public function getAvailStartTime()
    {
        return $this->availStartTime;
    }

    /**
     * @return mixed
     */
    public function getAvailEndTime()
    {
        return $this->availEndTime;
    }
    
    public function getAvailTitle()
    {
        return $this->availTitle;
    }

    /**
     * @param mixed $availId
     */
    public function setAvailId($availId)
    {
        $this->availId = $availId;
    }

    /**
     * @param mixed $availStartDate
     */
    public function setAvailStartDate($availStartDate)
    {
        $this->availStartDate = $availStartDate;
    }

    /**
     * @param mixed $availEndDate
     */
    public function setAvailEndDate($availEndDate)
    {
        $this->availEndDate = $availEndDate;
    }

    /**
     * @param mixed $availStartTime
     */
    public function setAvailStartTime($availStartTime)
    {
        $this->availStartTime = $availStartTime;
    }

    /**
     * @param mixed $availEndTime
     */
    public function setAvailEndTime($availEndTime)
    {
        $this->availEndTime = $availEndTime;
    }
    
    public function setAvailTitle ($availTitle)
    {
        $this->availTitle = $availTitle;
    }
    
    
    

    function __construct( $availId, $availStartDate, $availEndDate, $availStartTime, $availEndTime, $availTitle) {
        $this->availId = $availId;
        $this->availStartDate = $availStartDate;
        $this->availEndDate = $availEndDate;
        $this->availStartTime = $availStartTime;
        $this->availEndTime = $availEndTime;
        $this->availTitle = $availTitle;
    }
    

  

    
}

?>
