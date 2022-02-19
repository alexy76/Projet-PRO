<?php

class Category extends Database {



    /**
     * 
     */
    public function getCategory() : array
    {
        $db = $this->connectDB();

        return $db->query("SELECT * FROM `ec_category`")->fetchAll();
    }


    /**
     * 
     */
    public function setCategory(string $nameCategory) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_category` (`cat_name`) VALUES (:nameCategory);";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCategory', $nameCategory, PDO::PARAM_STR);

        return $statment->execute();
    }


    /**
     * 
     */
    public function existIdCategory(int $id) : bool
    {
        $db = $this->connectDB();

        $query = "SELECT `cat_id` as 'id' FROM `ec_category` WHERE `cat_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch() === false ? false : true;
    }
}