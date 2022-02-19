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
}