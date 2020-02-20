<?php

class Authentication
{

    private $registrantFirstName;

    private $registrantLastName;

    private $registrantEmail;

    private $registrantPassword;
    
    private $registrantType;
    
    private $authId;

    function __construct($registrantFirstName, $registrantLastName, $registrantEmail, $registrantPassword, $registrantType)
    {
        $this->setRegistrantFirstName($registrantFirstName);
        $this->setRegistrantLastName($registrantLastName);
        $this->setRegistrantEmail($registrantEmail);
        $this->setRegistrantPassword($registrantPassword);
        $this->setRegistrantType($registrantType);
        
    }

    public function getRegistrantFirstName()
    {
        return $this->registrantFirstName;
    }

    public function setRegistrantFirstName($registrantFirstName)
    {
        $this->registrantFirstName = $registrantFirstName;
    }

    public function getRegistrantLastName()
    {
        return $this->registrantLastName;
    }

    public function setRegistrantLastName($registrantLastName)
    {
        $this->registrantLastName = $registrantLastName;
    }

    public function getRegistrantEmail()
    {
        return $this->registrantEmail;
    }

    public function setRegistrantEmail($registrantEmail)
    {
        $this->registrantEmail = $registrantEmail;
    }

    public function getRegistrantPassword()
    {
        return $this->registrantPassword;
    }

    public function setRegistrantPassword($registrantPassword)
    {
        $this->registrantPassword = $registrantPassword;
    }
    
    public function getRegistrantType()
    {
        return $this->registrantType;
    }
    
    public function setRegistrantType($registrantType)
    {
        echo $registrantType;
        $this->registrantType = $registrantType;
    } 
    
    public function getAuthId()
    {
        return $this->authId;
    }
    
    public function setAuthId($authId)
    {
        echo $authId;
        $this->authId = $authId;
    } 
}
?>