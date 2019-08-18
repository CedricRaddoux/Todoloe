<?php

//include_once("includes/no-session.inc.php");
include_once("classes/Features.class.php");


try {
    $error="";
    if (!empty($_POST)) {
        $name = $_POST['name'];
        $deadline = $_POST['deadline'];
        $subject = $_POST['subject'];
        $list = $_POST['list'];

        $task = new Feature();
        $task->setName($name);
        $task->setDeadline($deadline);
        $task->setSubject($subject);
        $task->setList($list);
        $task->addTask();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

$feed = new Feature();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla|Lexend+Deca&display=swap" rel="stylesheet">
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?><br>

<div class="container">

    <p class="alert-warning"><?php if (isset($error)) {
    echo htmlspecialchars($error);
} ?></p>

    <h1>Add task</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        <div class="form-group">
            <select name="subject" id="subject">
                <?php foreach ($feed->getSubjects() as $s): ?>
                    <option value="<?php echo htmlspecialchars($s["id"]); ?>"><?php echo htmlspecialchars($s["name"]); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <select name="list" id="list">
                <?php foreach ($feed->getLists() as $l): ?>
                    <option value="<?php echo htmlspecialchars($l["id"]); ?>"><?php echo htmlspecialchars($l["name"]); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <input type="date" name="deadline" id="deadline"><br>
        </div>

        <button class="btn btn-danger" type="submit">Save</button>
    </form>
</div>

</body>
</html>