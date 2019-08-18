<?php

include_once("includes/db.inc.php");

class Lists
{
    private $name;
    private $list;
    private $title;
    private $deadline;
    private $done;

    //NAME
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if($name=="") {
            throw new Exception('The title of the list can not be empty');
        }
        $this->name = $name;
    }

    //LIST
    public function getList()
    {
        return $this->list;
    }

    public function setList($list)
    {
        $this->list = $list;
    }

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

    //ADD LIST
    public function addList()
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO lists(name) VALUES (:name)");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function getLists()
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM lists");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getTaskByList($list_id) 
    {
        global $conn;
        $statement = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id ORDER BY deadline ASC"); // van laag naar hoog
        $statement->bindValue(":list_id", $list_id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function deleteList($list_id)
    {
        global $conn;
        $statement = $conn->prepare("DELETE FROM lists WHERE :list_id");
        $statement->bindValue(":list_id", $list_id);
        $statement->execute();
    }
}