<?php

class Collections extends Database
{



    /**
     * Méthode permettant d'enregistrer une nouvelle collection
     * @param string (Nom de la collection)
     * @param string (slug de la collection)
     * @param int (identifiant de la catégorie associée à la collection)
     * @return bool
     */
    public function setNameCollection(string $nameCollection, string $slugCollection, int $idCat): bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_collection` (`col_name`, `col_position`, `col_slug`, `cat_id`) VALUES (:nameCollection, :positionCollection, :slugCollection, :idCat)";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCollection', $nameCollection, PDO::PARAM_STR);
        $statment->bindValue(':slugCollection', $slugCollection, PDO::PARAM_STR);
        $statment->bindValue(':idCat', $idCat, PDO::PARAM_INT);
        $statment->bindValue(':positionCollection', $this->getCountCollectionPerCategory($idCat) + 1, PDO::PARAM_INT);

        return $statment->execute();
    }


    /**
     * Méthode permettant d'obtenir le nombre de collections enregistrées pour une catégorie (utilisée notamment pour les positions)
     * @return int (nombre de collections)
     */
    private function getCountCollectionPerCategory(int $id): int
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
    public function getCollections(): array
    {
        $db = $this->connectDB();
        $req = $db->query("SELECT `cat_name` as 'nameCategory', `cat_position` as 'positionCat', `cat_id` as 'idCat', 
                        group_concat(`col_name`) AS 'nameCol', group_concat(`col_position`) AS 'positionCol', 
                        group_concat(`col_id`) AS 'idCol', group_concat(`col_slug`) AS 'slugCol'
                        FROM `ec_collection`
                        NATURAL JOIN `ec_category`
                        GROUP BY `cat_id`
                        order by `cat_position`, `col_position`")->fetchAll();

        foreach ($req as $key => $category) {

            $collections[$key]['category']['id'] = $category->idCat;
            $collections[$key]['category']['name'] = $category->nameCategory;
            $collections[$key]['category']['position'] = $category->positionCat;

            $keyCol = explode(',', $category->positionCol);
            $idCol = explode(',', $category->idCol);
            $nameCol = explode(',', $category->nameCol);
            $slugCol  = explode(',', $category->slugCol);

            for ($i = 0; $i < count(explode(',', $category->idCol)); $i++) {
                $collections[$key]['collections'][$keyCol[$i]]['id'] = $idCol[$i];
                $collections[$key]['collections'][$keyCol[$i]]['name'] = $nameCol[$i];
                $collections[$key]['collections'][$keyCol[$i]]['slug'] = $slugCol[$i];
            }

            ksort($collections[$key]['collections']);
        }

        return $collections;
    }



    /**
     * Méthode utilisée avec AJAX permettant d'enregistrer la nouvelle position d'une collection
     * @param int (identifiant collection)
     * @param int (nouvelle position)
     * @return bool
     */
    public function setNewPositionCollection(int $id, int $position): bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_collection` SET `col_position` = :position WHERE `col_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':position', $position, PDO::PARAM_INT);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de retourner la liste des collections avec leurs ID
     * @return array
     */
    public function getListCollections(): array
    {
        $db = $this->connectDB();

        $query = "SELECT `cat_name` AS 'nameCat', group_concat(col_name) AS 'nameCol', group_concat(col_id) AS 'idCol' FROM `ec_collection`
        NATURAL JOIN `ec_category`
        GROUP BY `cat_position`
        ORDER BY `cat_position`";

        foreach ($db->query($query)->fetchAll() as $key => $value) {
            $collections[$key]['category'] = $value->nameCat;

            for ($i = 0; $i < count(explode(',', $value->nameCol)); $i++) {
                $collections[$key]['collections'][$i] = [
                    'id' => explode(',', $value->idCol)[$i],
                    'name' => explode(',', $value->nameCol)[$i]
                ];
            }
        }

        return $collections;
    }



    /**
     * Méthode permettant de savoir si la collection existe
     * @param string (nom de la collection)
     * @return bool
     */
    public function getExistCollection(string $nameCollection): bool
    {
        $db = $this->connectDB();
        $query = "SELECT count(`col_id`) as 'countCollection' FROM `ec_collection`  WHERE `col_name` = :nameCollection";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCollection', $nameCollection, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->countCollection == 0 ? false : true;
    }



    /**
     * Méthode permettant de savoir si l'identifiant de la collection existe en base de données
     * @param int (identifiant de la collection)
     * @return bool
     */
    public function getExistIdCollection(int $idCollection): bool
    {
        $db = $this->connectDB();
        $query = "SELECT count(`col_id`) as 'countId' FROM `ec_collection`  WHERE `col_id` = :idCollection";

        $statment = $db->prepare($query);
        $statment->bindValue(':idCollection', $idCollection, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch()->countId == 1 ? true : false;
    }


    /**
     * Méthode permettant de récupérer des information d'une collection par son ID
     * @param int (identifiant de la collection)
     * @return object
     */
    public function getCollectionByID(int $idCollection)
    {
        $db = $this->connectDB();

        $query = "SELECT `col_name`, `cat_name` FROM ec_collection
            NATURAL JOIN `ec_category` WHERE `col_id` = :idCollection";

        $statment = $db->prepare($query);
        $statment->bindValue(':idCollection', $idCollection, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch(PDO::FETCH_ASSOC);
    }
}
