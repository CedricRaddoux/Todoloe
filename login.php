<?php
session_start();

include_once("classes/User.class.php");


try {
    $error="";

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->login();

        if ($user->login()) {
            $_SESSION['email'] = $email;
            foreach ($user->checkIsAdmin() as $u) {
                if ($u['isAdmin'] == 0) {
                    header('location: index.php');
                } else {
                    header('location: indexAdmin.php');
                }
            }

        } else {
            $error = "Please fill in all fields.";
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
    <title>Login</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    
    <form action="" method="post">
    <a href=login.php><img class=logo src=images/logo.png alt=logo></a>
    <h3>The easiest way to plan your tasks</h3>
    <h1 class="header">Login</h1>
       
       <div class="error-popup"><?php if (isset($error)) {
        echo htmlspecialchars($error);
        } ?></div>
       
        <div class="form-field">
            <label for="email">Email</label> <br>
            <input class="inputfields" type="text" name="email" id="email">
        </div>
        <div class="form-field">
            <label for="password">Password</label> <br>
            <input class="inputfields" type="password" name="password" id="password">
        </div>
        <button type="submit" class="submitbutton">Log in</button>

        <p>Don't have an account? <a class="register" href="register.php">Register</a></p>
    </form>

</div>

</body>
</html>