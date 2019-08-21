<?php

        include_once("classes/List.class.php");
        include_once("classes/User.class.php");

        try {
            $error="";

            if (isset($_POST['delete_admin'])) {
                $Admin = new User();
                $Admin->deleteAdmin($Admin);
            }
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        $feed = new User();

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
<?php include_once("includes/navAdmin.inc.php"); ?>

<h1 class="header">Delete an admin</h1>
   
   <div class="error-popup"><?php if (isset($error)) {
        echo htmlspecialchars($error);
        } ?></div>

        
    <?php foreach ($feed->getAdmins() as $l): ?>
    <h3><?php echo htmlspecialchars($l["email"]); ?></h3>
    <button class="submitbutton" type="submit" name="delete_admin">Delete Admin</button>
    <?php endforeach; ?>





</body>
</html>