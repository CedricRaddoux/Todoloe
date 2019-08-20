<?php

include_once("includes/db.inc.php");

class Task
{
    private $title;
    private $deadline;
    private $done;
    private $list_id;

    //TITLE
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if($title=="") {
            throw new Exception('Title can not be empty');
        }
        $this->title = $title;
    }

    //DEADLINE
    public function getDeadline()
    {
        return $this->deadline;
    }

    public function SetDeadline($deadline)
    {
        if($deadline=="") {
            throw new Exception('Title can not be empty');
        }
        $this->deadline = $deadline;
    }

    //DONE
    public function getDone()
    {
        return $this->done;
    }

    public function setDone($done)
    {
        if($done=="") {
            throw new Exception('Title can not be empty');
        }
        $this->done = $done;
    }

    //LIST_ID
    public function getList_id()
    {
        return $this->list_id;
    }

    public function setList_id($list_id)
    {
        if($list_id=="") {
            throw new Exception('Title can not be empty');
        }
        $this->list_id = $list_id;
    }


    //ADD TASK
    public function addTask($title, $deadline, $done, $list_id)
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO tasks(title, deadline, done, list_id) 
                                    VALUES (:title, :deadline, :done, :list_id)");

        //KIJK NA OF ER AL ZO'N EMAIL BESTAAT
        if($statement->rowCount() !== 0) { # If rows are found for query
            throw new Exception("There is already a task with that name"); 
            }
        $statement->bindValue(":title", $title);
        $statement->bindValue(":deadline", $deadline);
        $statement->bindValue(":done", $done);
        $statement->bindValue(":list_id", $list_id);

        $statement->execute();
    }
}