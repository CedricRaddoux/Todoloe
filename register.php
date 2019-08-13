<?php
include_once("classes/User.class.php");

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
        $user->register();

        header('Location: login.php');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
echo $password;
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
</head>
<body>

<div class="alert-warning"><?php if (isset($error)) {
    echo htmlspecialchars($error);
} ?></div>

<div class="container">
<h1 class="header">Register</h1>
    <form action="" method="post">
        <div class="form-field">
            <label for="firstname">Firstname</label> <br>
            <input class="inputfields" type="text" name="firstname" id="firstname">
        </div>

        <div class="form-field">
            <label for="lastname">Lastname</label> <br>
            <input class="inputfields" type="text" name="lastname" id="lastname">
        </div>

        <div class="form-field">
            <label for="email">Email</label> <br>
            <input class="inputfields" type="text" name="email" id="email">
        </div>

        <div class="form-field">
            <label for="password">Password</label> <br>
            <input class="inputfields" type="password" name="password" id="password">
        </div>

        <button class="submitbutton" type="submit">Register</button>
    </form>
</div>

</body>
</html>