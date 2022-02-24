<?php

class Products extends Database
{

    /**
     * Méthode permettant d'enregistrer un produit en base de données
     * @param string (titre du produit)
     * @param int (identifiant de la collection)
     * @return bool
     */
    public function setNewProduct(string $title, int $idCol): bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_products` (`pdt_title`,`pdt_price`,`pdt_activated`,`col_id`) 
                VALUES (:title, 0, 0, :idCol)";

        $statment = $db->prepare($query);
        $statment->bindValue(':title', $title, PDO::PARAM_STR);
        $statment->bindValue(':idCol', $idCol, PDO::PARAM_INT);
        
        return $statment->execute();
    }



    /**
     * Méthode permettant de récupérer le nombre total de produits (aide à la pagination)
     * @return int (nombre total de produits)
     */
    public function getCount_allProducts() : int
    {
        $db = $this->connectDB();
        return $db->query("SELECT count(`pdt_id`) AS 'nbAllProducts' FROM `ec_products`")->fetch()->nbAllProducts;
    }



    /**
     * Méthode permettant de récupérer les données de tous les produits (limité avec un offset)
     * @param string (optionnel, pas utilisé pour cette méthode)
     * @param int (nombre d'élement à récuperer)
     * @param int (offset pour la pagination)
     * @return array 
     */
    public function get_allProducts(string $opt = null, int $nbElt, int $offset) : array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_products` ORDER BY `pdt_id` DESC LIMIT :nbElt OFFSET :offset";

        $statment = $db->prepare($query);
        $statment->bindValue(':nbElt', $nbElt, PDO::PARAM_INT);
        $statment->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetchAll();
    }



}


?>