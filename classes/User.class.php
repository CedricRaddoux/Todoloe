<?php

include_once("includes/db.inc.php");

class User
{
    private $Firstname;
    private $Lastname;
    private $Email;
    private $Password;
    private $Admin;

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

    // ADMIN
    public function getAdmin()
    {
        return $this->Admin;
    }

    public function setAdmin($Admin)
    {
        if ($Admin=="") {
            throw new Exception('Admin can not be empty');
        }
        $this->Admin = $Admin;
    }

    // REGISTER
    public function register()
    {
        // connection
        global $conn;

        if (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception($this->Email . " is not a valid email address");

          }

          $query = $conn->prepare( "SELECT email FROM user WHERE email = :email");
          $query->bindValue(":email", $this->Email);
          $query->execute();
          $query->fetch(PDO::FETCH_ASSOC);
  
          if($query->rowCount() !== 0) { # If rows are found for query
              throw new Exception("Email already exists"); 
          }
        // Gegevens in de databank plaatsen
        $statement = $conn->prepare("insert into user (firstname, lastname, email, password, isAdmin) values (:firstname, :lastname, :email, :password, :isAdmin)");
        // Uitvoeren van een prepared statement (bindparam)
        $statement->bindparam(":firstname", $this->Firstname); 
        $statement->bindparam(":lastname", $this->Lastname);
        $statement->bindparam(":email", $this->Email);
        $statement->bindparam(':password', $this->Password);
        $statement->bindparam(':isAdmin', $this->Admin);

       /* 
       if( strlen($password) > 8){
            throw new Exception("password must be at least 8 character long");
        }
        */


    // WACHTWOORD BEVEILIGEN MET BCRYPT
        $options = [
            'cost'=> 12 //salt van 12
        ];
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);
        $statement->bindValue(":password", $password);

        // execute (uitvoeren)
        $result = $statement->execute();

        // return true/false
        return $result;
    }


    // EMAIL NAKIJKEN OF ER AL 1 BESTAAT 
    public function checkIfEmailExists($Email){

        // connection
         global $conn;

       



    }

    public function checkIsAdmin()
    {
        global $conn;

        $statement = $conn->prepare("SELECT isAdmin FROM user where email = :email");
        $statement->bindValue(":email", $_SESSION['email']);
        $statement->execute();
        return $statement;
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
