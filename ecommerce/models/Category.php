<?php

class Category extends Database {



    /**
     * Méthode permettant d'obtenir les données de la table des Catégories
     * @return array
     */
    public function getCategory() : array
    {
        $db = $this->connectDB();

        return $db->query("SELECT * FROM `ec_category` ORDER BY `cat_position`")->fetchAll();
    }



    /**
     * Méthode permettant d'obtenir le nombre de catégories enregistrées (utilisée notamment pour les positions)
     * @return int (nombre de catégorie)
     */
    private function getCountCategory() : int
    {
        $db = $this->connectDB();

        return $db->query("SELECT count(*) as 'countCategory' FROM `ec_category`")->fetch()->countCategory;
    }



    /**
     * Méthodes permettant d'enregistrer une nouvelle catégorie dans la table
     * @param string (nom de la catégorie)
     * @param string (slug de la collection)
     * @return bool
     */
    public function setCategory(string $nameCategory, string $slug) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_category` (`cat_name`, `cat_position`, `cat_slug`) VALUES (:nameCategory, :positionCategory, :slug);";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCategory', $nameCategory, PDO::PARAM_STR);
        $statment->bindValue(':slug', $slug, PDO::PARAM_STR);
        $statment->bindValue(':positionCategory', $this->getCountCategory() + 1, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de vérifier si une catégorie existe dans la table en fonction de l'identifiant
     * @param int (identifiant catégorie)
     * @return bool
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



    /**
     * Méthode utilisée avec AJAX permettant d'enregistrer la nouvelle position d'une catégorie
     * @param int (identifiant catégorie)
     * @param int (nouvelle position)
     * @return bool
     */
    public function setNewPositionCategory(int $id, int $position) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_category` SET `cat_position` = :position WHERE `cat_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':position', $position, PDO::PARAM_INT);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de savoir si la catégorie existe
     * @param string (nom de la catégorie)
     * @return bool
     */
    public function getExistCategory(string $nameCategory) : bool
    {
        $db = $this->connectDB();
        $query = "SELECT count(`cat_id`) as 'countCategory' FROM `ec_category`  WHERE `cat_name` = :nameCategory";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameCategory', $nameCategory, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->countCategory == 0 ? false : true;
    }

}