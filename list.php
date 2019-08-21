<?php

include_once("classes/Task.class.php");
include_once("classes/List.class.php");

try {
    $error="";

    if (!empty($_POST)) {
        if (isset($_POST['add_list'])) {
            $list = new Lists();
            $name = $_POST['list_title'];
            $list->setName($name);
            $list->addList();

        } elseif (isset($_POST['delete_list'])) {
                $list_id = $_POST['list_id'];
                $list = new Lists();
                $list->deleteList($list_id);
            }
        }

        if (!empty($_POST)) {
            if (isset($_POST['add_task'])) {
                $task = new Task();
                $title = $_POST['task_title'];
                $deadline = $_POST['task_deadline'];
                $done = 0;
                $list_id = $_POST['list_id'];
                $task->addTask($title, $deadline, $done, $list_id);
            }
        }
} catch (Exception $e) {
    $error = $e->getMessage();
}

$feed = new Lists();

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
            <input class="inputfields" type="text" name="list_title" id="list_title">
        </div>

        <button class="submitbutton" type="submit" name="add_list">Add list</button>
        <br>

        <div class="form-group">
            
        <?php foreach ($feed->getLists() as $l): ?>
        <?php foreach ($feed->getTaskByList($l["id"]) as $task):?>
                        <p><?php echo $task["title"]; ?></p>
                        <p><?php echo $task["deadline"]; ?></p>
                    <?php endforeach; ?>

                    <!-- Echo de id en name van de kust --> 
                    <h3><?php echo $l["id"];?><?php echo htmlspecialchars($l["name"]); ?></h3><br>
                    <form action="" method="post">
                    <input class="inputfields" type="hidden" name="list_id" value="<?php echo $l["id"];?>">
                    <input class="inputfields" type="text" name="task_title" id="task_title">
                    <input class="inputfields" type="date" name="task_deadline" id="task_deadline">
                    <button class="submitbutton" type="submit" name="add_task">Add task</button>
                    <button class="submitbutton" type="submit" name="delete_list">Delete list</button>
                    </form>
                <?php endforeach; ?>
                
            
        </div>

        
        
    </form>
</body>
</html>