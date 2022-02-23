<?php

class Collections extends Database{



    /**
     * Méthode permettant d'enregistrer une nouvelle collection
     * @param string (Nom de la collection)
     * @param int (identifiant de la catégorie associée à la collection)
     * @return bool
     */
    public function setNameCollection(string $nameCollection, int $idCat) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_collection` (`col_name`, `col_position`, `cat_id`) VALUES (:nameCollection, :positionCollection, :idCat)";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCollection', $nameCollection, PDO::PARAM_STR);
        $statment->bindValue(':idCat', $idCat, PDO::PARAM_INT);
        $statment->bindValue(':positionCollection', $this->getCountCollectionPerCategory($idCat) + 1, PDO::PARAM_INT);

        return $statment->execute();
    }


    /**
     * Méthode permettant d'obtenir le nombre de collections enregistrées pour une catégorie (utilisée notamment pour les positions)
     * @return int (nombre de collections)
     */
    private function getCountCollectionPerCategory(int $id) : int
    {
        $db = $this->connectDB();

        $query = "SELECT count(`col_id`) as 'count' FROM `ec_collection` WHERE `cat_id` = :id"; 

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch()->count;
    }


    /**
     * Méthode permettant d'obtenir la liste des catégories et des collections associées,
     * triée par position des catégories et ensuite par la position des collections
     * @return array 
     */
    public function getCollections() : array
    {
        $db = $this->connectDB();
        $req = $db->query("SELECT `cat_name` as 'nameCategory', `cat_position` as 'positionCat', `cat_id` as 'idCat', 
                        group_concat(`col_name`) AS 'nameCol', group_concat(`col_position`) AS 'positionCol', 
                        group_concat(`col_id`) AS 'idCol', group_concat(`col_slug`) AS 'slugCol'
                        FROM `ec_collection`
                        NATURAL JOIN `ec_category`
                        GROUP BY `cat_id`
                        order by `cat_position`, `col_position`")->fetchAll();
                        
        foreach($req as $key => $category){

            $collections[$key]['category']['id'] = $category->idCat;
            $collections[$key]['category']['name'] = $category->nameCategory;
            $collections[$key]['category']['position'] = $category->positionCat;
        
        
            for($i = 0; $i < count(explode(',', $category->idCol)); $i++)
            {
                $collections[$key]['collections'][explode(',', $category->positionCol)[$i]]['id'] = explode(',', $category->idCol)[$i];
                $collections[$key]['collections'][explode(',', $category->positionCol)[$i]]['name'] = explode(',', $category->nameCol)[$i];
                $collections[$key]['collections'][explode(',', $category->positionCol)[$i]]['slug'] = explode(',', $category->slugCol)[$i];
            }
        
            ksort($collections[$key]['collections']);
        }

        return $collections;
    }



    /**
     * Méthode utilisée avec AJAX permettant d'enregistrée la nouvelle position d'une collection
     * @param int (identifiant collection)
     * @param int (nouvelle position)
     * @return bool
     */
    public function setNewPositionCollection(int $id, int $position) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_collection` SET `col_position` = :position WHERE `col_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':position', $position, PDO::PARAM_INT);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }
}