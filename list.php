<?php

include_once("classes/Features.class.php");

try {
    $error="";

    if (!empty($_POST)) {
        if (isset($_POST['save'])) {
            $name = $_POST['name'];

            $list = new Features();
            $list->setName($name);
            $list->addList();

        } elseif (isset($_POST['delete'])) {
                $list = new Features();
                $list->deleteList();
            }
        }
} catch (Exception $e) {
    $error = $e->getMessage();
}

$feed = new Features();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
    </head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div class="container">

    <form action="" method="post">

        <h1>Add list</h1>

        <div class="form-group">
        <div class="error-popup"><?php if (isset($error)) {
        echo htmlspecialchars($error);
        } ?></div>
            <label for="name">Enter the name of the list</label>
            <input class="inputfields" type="text" name="name" id="name">
        </div>

        <button class="submitbutton" type="submit" name="save">Add list</button>
        <br>

        <div class="form-group">
            
                <?php foreach ($feed->getLists() as $l): ?>
                    <p value="<?php echo htmlspecialchars($l["name"]); ?>"><?php echo htmlspecialchars($l["name"]); ?></p>
                    <input class="btn btn-danger" type="submit" value="delete" name="delete">
                <?php endforeach; ?>
            
        </div>

        
        
    </form>
</body>
</html>