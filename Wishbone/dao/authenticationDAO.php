<?php
require_once ('abstractDAO.php');
require_once ('./model/authentication.php');
include ('enums/userType.php');

class AuthenticationDAO extends AbstractDAO
{

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
            echo "signing up as an Event Planner";
            $this-> registerAsEventPlanner( $Registrant, $imageLoc);
            
        } else if ( $Registrant->getRegistrantType() == UserType::ENTERTAINER) {
            echo "signing up as an Entertainer";
            $this-> registerAsEntertainer( $Registrant);
            
        } else if ( $Registrant->getRegistrantType() == UserType::VENUE_OWNER) {
            echo "signing up as a Venue Owner";
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
            
            $query2 = 'INSERT INTO entertainers (authid, firstname, lastname)
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
    
    
    
    private function registerAsEventPlanner( $Registrant) {
        if (! $this->mysqli->connect_errno) {
            $query1 = 'INSERT INTO authentication
                            (email, pass, userType) VALUES(?,?,?)';
            
            $userType = UserType::EVENT_PLANNER;
            $email = $Registrant->getRegistrantEmail();
            $pass = $Registrant->getRegistrantPassword();
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
?>