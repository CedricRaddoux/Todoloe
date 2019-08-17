<?php

include_once("classes/Features.class.php");

    session_start();
        if( !isset($_SESSION['email'])){ //als het niet ge set is
           header('location: login.php'); 
        }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoloe</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
    
</head>
<body>
<?php include_once("includes/nav.inc.php"); ?>

<h1>Welcome back <?php echo $_SESSION['email']; ?></h1>



</body>
</html>