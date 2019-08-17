<?php

include_once("includes/db.inc.php");

class Features
{
    private $name;
    private $list;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if($name=="") {
            throw new Exception('Name can not be empty');
        }
        $this->name = $name;
    }

    public function getList()
    {
        return $this->list;
    }

    public function setList($list)
    {
        $this->list = $list;
    }

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

    public function deleteList()
    {
        global $conn;
        $statement = $conn->prepare("DELETE FROM lists(name) where name = (:name)");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }
}