<?php
require_once ('abstractDAO.php');
require_once ('../model/authentication.php');
include ('../enums/userType.php');  
include ('../enums/profileStatus.php');

class AuthenticationDAO extends AbstractDAO
{
    private $salt;

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function addNewRegistrant($Registrant) {

        echo $Registrant->getRegistrantType();
        
        if ( $Registrant->getRegistrantType() == UserType::EVENT_PLANNER) {
            $this-> registerAsEventPlanner( $Registrant);
            
        } else if ( $Registrant->getRegistrantType() == UserType::ENTERTAINER) {
            $this-> registerAsEntertainer( $Registrant);
            
        } else if ( $Registrant->getRegistrantType() == UserType::VENUE_OWNER) {
            $this-> registerAsVenueOwner( $Registrant);  
        }
       
    }
    

    
    private function registerAsVenueOwner( $Registrant) {
        
        if (! $this->mysqli->connect_errno) {
            $query1 = 'INSERT INTO authentication
                            (email, pass, userType) VALUES(?,?,?)';
            
            $userType = UserType::VENUE_OWNER;
            $email = $Registrant->getRegistrantEmail();
            $pass = $Registrant->getRegistrantPassword();
            //$salt = uniqid(mt_rand(), true);
            //$crypted_pass = crypt($pass, $salt);
            $stmt = $this->mysqli->prepare($query1);
            $stmt->bind_param('ssi', $email, $pass, $userType);
            $stmt->execute();
            // $stmt->close();
            
            $querya = 'select authid from authentication where email = ?';
            $stmta = $this->mysqli->prepare($querya);
            $stmta->bind_param('s', $email);
            $stmta->execute();
            $stmta->bind_result($authId);
            $stmta->fetch();
            $stmta->close();
            
            $Registrant->setAuthId( $authId);
            
            $query2 = 'INSERT INTO venueOwners (authid, firstname, lastname)
							VALUES(?,?,?)';
            
            $firstname = $Registrant->getRegistrantFirstName();
            $lastname = $Registrant->getRegistrantLastName();
            $stmt2 = $this->mysqli->prepare($query2);
            $stmt2->bind_param('sss', $authId, $firstname, $lastname);
            $stmt2->execute();
            $stmt2->close();
            
        } else {
            return 'Could not connect to Database';
        }
    }

    
    private function registerAsEntertainer( $Registrant) {
        
        if (! $this->mysqli->connect_errno) {
            $query1 = 'INSERT INTO authentication
                            (email, pass, userType) VALUES(?,?,?)';
            
            $userType = UserType::ENTERTAINER;
            $email = $Registrant->getRegistrantEmail();
            $pass = $Registrant->getRegistrantPassword();
            //$salt = uniqid(mt_rand(), true);
            //$crypted_pass = crypt($pass, $salt);
            $stmt = $this->mysqli->prepare($query1);
            $stmt->bind_param('ssi', $email, $pass,$userType);
            $stmt->execute();
            // $stmt->close();
            
            $querya = 'select authid from authentication where email = ?';
            $stmta = $this->mysqli->prepare($querya);
            $stmta->bind_param('s', $email);
            $stmta->execute();
            $stmta->bind_result($authId);
            $stmta->fetch();
            $stmta->close();
            
            $Registrant->setAuthId( $authId);
            
            $query2 = 'INSERT INTO entertainers (authid, firstname, lastname, profileStatus)
							VALUES(?,?,?,?)';

            $firstname = $Registrant->getRegistrantFirstName();
            $lastname = $Registrant->getRegistrantLastName();
            $profileStatus = $Registrant->getProfileStatus();
            $stmt2 = $this->mysqli->prepare($query2);
            $stmt2->bind_param('sssi', $authId, $firstname, $lastname, $profileStatus);
            $stmt2->execute();
            $stmt2->close();

        } else {
            return 'Could not connect to Database';
        }
        
    }
    
    
    
    private function registerAsEventPlanner( $Registrant) {
        if (! $this->mysqli->connect_errno) {
            $query1 = 'INSERT INTO authentication
                            (email, pass, userType) VALUES(?,?,?)';
            
            $userType = UserType::EVENT_PLANNER;
            $email = $Registrant->getRegistrantEmail();
            $pass = $Registrant->getRegistrantPassword();
            //$salt = uniqid(mt_rand(), true);
            //$crypted_pass = crypt($pass, $salt);
            $stmt = $this->mysqli->prepare($query1);
            $stmt->bind_param('sss', $email, $pass,$userType);
            $stmt->execute();
            // $stmt->close();
            
            $querya = 'select authid from authentication where email = ?';
            $stmta = $this->mysqli->prepare($querya);
            $stmta->bind_param('s', $email);
            $stmta->execute();
            $stmta->bind_result($authId);
            $stmta->fetch();
            $stmta->close();
            
            $Registrant->setAuthId( $authId);
            
            $query2 = 'INSERT INTO eventPlanners(authid, firstname, lastname)
							VALUES(?,?,?)';
            
            $firstname = $Registrant->getRegistrantFirstName();
            $lastname = $Registrant->getRegistrantLastName();
            $stmt2 = $this->mysqli->prepare($query2);
            $stmt2->bind_param('sss', $authId, $firstname, $lastname);
            $stmt2->execute();
            $stmt2->close();

            return $Registrant->getRegistrantFirstName() . ' ' . $Registrant->getRegistrantLastName() . ' ' . $Registrant->getRegistrantEmail() . ' added successfully';
            // }
        } else {
            return 'Could not connect to Database';
        }
    }
}

/**
 * $currentPassword = '$2a$15$Ku2hb./9aA71tPo/E015h.LsNjXrZe8pyRwXOCpSnGb0nPZuxeZP2';
$checkPassword = 'passwords1';

if(crypt($checkPassword, $currentPassword) === $currentPassword){
    echo 'You are in!';
}else{
    echo 'You entered the wrong password';
}
 */
?>