<?php

include_once("includes/db.inc.php");

class User
{
    private $Firstname;
    private $Lastname;
    private $Email;
    private $Password;

    // FIRSTNAME
    public function getFirstname()
    {
        return $this->Firstname;
    }

    public function setFirstname($Firstname)
    {
        if ($Firstname=="") {
            throw new Exception('Firstname can not be empty');
        }
        $this->Firstname = $Firstname;
    }

    // LASTNAME
    public function getLastnamename()
    {
        return $this->Lastname;
    }

    public function setLastname($Lastname)
    {
        if ($Lastname=="") {
            throw new Exception('Lastname can not be empty');
        }
        $this->Lastname = $Lastname;
    }

    // EMAIL
    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        if ($Email=="") {
            throw new Exception('Email can not be empty');
        }
        $this->Email = $Email;
    }

    // PASSWORD
    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        if ($Password=="") {
            throw new Exception('Pasword can not be empty');
        }
        $this->Password = $Password;
    }

    // REGISTER
    public function register()
    {
        // connection
        global $conn;

        // Gegevens in de databank plaatsen
        $statement = $conn->prepare("insert into user (firstname, lastname, email, password) values (:firstname, :lastname, :email, :password)");
        // Uitvoeren van een prepared statement (bindparam)
        $statement->bindparam(":firstname", $this->Firstname); 
        $statement->bindparam(":lastname", $this->Lastname);
        $statement->bindparam(":email", $this->Email);
        $statement->bindparam(':password', $this->Password);

       /* 
       if( strlen($password) > 8){
            throw new Exception("password must be at least 8 character long");
        }
        */

        $options = [
            'cost'=> 12
        ];
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);
        $statement->bindValue(":password", $password);
        $statement->execute();

        // execute (uitvoeren)
        $result = $statement->execute();

        // return true/false
        return $result;
    }

    // LOGIN
    public function login()
    {
        // connection
        global $conn;

        $p_password = $this->getPassword();

        // Gegevens uit de databank halen
        $statement = $conn->prepare("SELECT * FROM user where email = :email LIMIT 1");
        $statement->execute(array( ":email"=>$this->getEmail()));

        if ($statement->rowCount() == 1) {
            $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
            $hash = $currentUser['password'];
            $_SESSION['email'] = $currentUser['email'];
            $_SESSION['id'] = $currentUser['id'];


            if (password_verify($p_password, $hash)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
