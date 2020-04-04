<?php
class Notification {
    // Properties
    private $notificationId;
    private $notificationType;
    private $entid;
    private $message;
    
    private $bookingRequestId;
    private $gigsid;
    private $event_date;
    private $requestorEmail;
    
    function __construct() {
 
    }

    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @return mixed
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     * @return mixed
     */
    public function getEntid()
    {
        return $this->entid;
    }
    
    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    public function getBookingRequestId()
    {
        return $this->bookingRequestId;
    }
    
    public function getGigsId()
    {
        return $this->gigsid;
    }
    
    public function getEventDate()
    {
        return $this->event_date;
    }
    
    public function getRequestorEmail()
    {
        return $this->requestorEmail;
    }
    
    

    public function setNotificationType( $notificationType)
    {
        $this->notificationType = $notificationType;
    }


    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
    }


    public function setEntid($entid)
    {
        $this->entid = $entid;
    }
    
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    public function setBookingRequestId($bookingRequestId)
    {
        $this->bookingRequestId = $bookingRequestId;
    }
    
    public function setGigsid($gigsid)
    {
        $this->gigsid = $gigsid;
    }
    
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
    }
    
    public function setRequestorEmail($requestorEmail)
    {
        $this->requestorEmail = $requestorEmail;
    }


}

?>
