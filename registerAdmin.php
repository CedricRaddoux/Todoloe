<?php
include_once("classes/User.class.php");

//session_start();
//       if( !isset($_SESSION['email'])){ //als het niet ge set is
//          header('location: login.php'); 
//        }

// PROBEER OP TE VANGEN (als het niet werkt, gaat het naar de catch)
try {
    $error="";

    if (!empty($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setAdmin("1"); // Wel admin dus 1
        $user->register();
    
        if(!$error){
            header('Location: login.php');
           }
        }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
<h1 class="header">Register an admin</h1>
   
   <div class="error-popup"><?php if (isset($error)) {
        echo htmlspecialchars($error);
        } ?></div>
        
    <form action="" method="post">
        <div class="form-field">
            <label for="firstname">Firstname admin</label> <br>
            <input class="inputfields" type="text" name="firstname" id="firstname">
        </div>

        <div class="form-field">
            <label for="lastname">Lastname admin</label> <br>
            <input class="inputfields" type="text" name="lastname" id="lastname">
        </div>

        <div class="form-field">
            <label for="email">Email admin</label> <br>
            <input class="inputfields" type="text" name="email" id="email">
        </div>

        <div class="form-field">
            <label for="password">Password admin</label> <br>
            <input class="inputfields" type="password" name="password" id="password">
        </div>

        <button class="submitbutton" type="submit">Add admin</button>

        <p>Go back to the <a class="register" href="login.php">Login</a> page</p>
    </form>
</div>

</body>
</html>