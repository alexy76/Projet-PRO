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
     * @param int (nombre d'élements à récuperer)
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



    /**
     * Méthode permettant la suppression d'un ou plusieurs produits
     * @param int (identifiant produit)
     * @return bool
     */
    public function deleteProduct(int $id) : bool
    {
        $db = $this->connectDB();

        $query = "DELETE FROM `ec_products` WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant d'activer la mise en ligne d'un ou plusieurs produit(s)
     * @param int (identifiant produit)
     * @return bool
     */
    public function activateProduct(int $id) : bool
    {
        $db = $this->connectDB();

        $status = $this->getStatusProduct($id) == 1 ? 0 : 1;

        $query = "UPDATE `ec_products` SET `pdt_activated` = $status WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /** 
     * Méthode permettant de récuperer le statut d'activation de mise en ligne du produit 
     * @param int (identifiant produit)
     * @return int
     * */
    private function getStatusProduct(int $id) : int
    {
        $db = $this->connectDB();
        return intval($db->query("SELECT `pdt_activated` as 'status' FROM `ec_products` WHERE `pdt_id` = $id")->fetch()->status);
    }



    /**
     * Méthode utilisée avec AJAX pour changer le statut de l'activation d'un produit
     * @param int (identifiant du produit)
     * @return bool
     */
    public function changeStatusProduct(int $id, int $status) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_products` SET `pdt_activated` = $status WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de récuperer les données d'un produit
     * @param int (identifiant du produit)
     * @return array
     */
    public function getProduct(int $id) : array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_products` WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch(PDO::FETCH_ASSOC);
    }



    /**
     * Méthode permettant de changer le nom d'un produit
     * @param int (identifiant du produit)
     * @param string (nom du nouveau produit)
     * @return bool
     */
    public function setNewName(int $id, string $name, string $slug) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_products` SET `pdt_title` = :name, `pdt_slug` = :slug WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->bindValue(':name', $name, PDO::PARAM_STR);
        $statment->bindValue(':slug', $slug, PDO::PARAM_STR);

        return $statment->execute();
    }



    /**
     * Méthode permettant de savoir si le slug produit est déjà utilisé
     * @param string (slug produit)
     * @return bool
     */
    public function getExistSlug(string $slug) : bool
    {
        $db = $this->connectDB();
        $query = "SELECT count(`pdt_id`) as 'countSlug' FROM `ec_products`  WHERE `pdt_slug` = :slug";

        $statment = $db->prepare($query);
        $statment->bindValue(':slug', $slug, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->countSlug == 0 ? false : true;
    }



    /** Méthode permettant de migrer un produit vers une autre collection 
     * @param int (identifiant produit)
     * @param int (identifiant collection)
     * @param bool
    */
    public function setChangeCollection(int $idProduct, int $idCol) : bool
    {
        $db = $this->connectDB();
        $query = "UPDATE `ec_products` SET `col_id` = :idCol WHERE `pdt_id` = :idProduct";

        $statment = $db->prepare($query);
        $statment->bindValue(':idProduct', $idProduct, PDO::PARAM_INT);
        $statment->bindValue(':idCol', $idCol, PDO::PARAM_INT);

        return $statment->execute();
    }
}


?>