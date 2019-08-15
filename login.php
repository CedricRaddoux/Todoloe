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
            header('location: index.php');

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
    <div class="alert-warning"><?php if (isset($error)) {
    echo htmlspecialchars($error);
} ?></div>

    <form action="" method="post">
    <a href=login.php><img class=logo src=images/logo.png alt=logo></a>
    <h1>Welcome to Todoloe</h1>
    <h1 class="header">Login</h1>
        <div class="form-field">
            <label for="email">Email</label>
            <input class="inputfields" type="text" name="email" id="email">
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input class="inputfields" type="password" name="password" id="password">
        </div>
        <button type="submit" class="submitbutton">Log in</button>

        <p>Don't have an account? <a class="register" href="register.php">Register</a></p>
    </form>

</div>

</body>
</html>