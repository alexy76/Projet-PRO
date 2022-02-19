<?php

class Collections extends Database{


    /**
     * 
     */
    public function setNameCollection(string $nameCollection, int $idCat) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_collection` (`col_name`, `cat_id`) VALUES (:nameCollection, :idCat)";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCollection', $nameCollection, PDO::PARAM_STR);
        $statment->bindValue(':idCat', $idCat, PDO::PARAM_INT);

        return $statment->execute();
    }


    /**
     * 
     */
    public function getCollections() : array
    {
        $db = $this->connectDB();
        return $db->query("SELECT group_concat(`col_name`) AS 'nameCol', `cat_name` AS 'nameCat', group_concat(`col_id`) AS 'idCol', `cat_id` AS 'idCat' FROM `ec_collection`
        NATURAL JOIN `ec_category`
        GROUP BY `cat_id`")->fetchAll();
    }
}