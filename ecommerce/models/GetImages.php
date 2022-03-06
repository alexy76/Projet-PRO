<?php

class GetImages extends Database{



    /**
     * Méthode permettant d'insérer les images produits en relation avec les produits (table intermédiaire)
     * @param int (identifiant du produit)
     * @param int (identifiant de l'image)
     * @return bool
     */
    public function insertIntermediateTableImage(int $idImage, int $idProduct) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_get_images` (`img_id`, `pdt_id`) 
        VALUES (:idImage, :idProduct)";

        $statment = $db->prepare($query);
        $statment->bindValue(':idImage', $idImage, PDO::PARAM_INT);
        $statment->bindValue(':idProduct', $idProduct, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de récupérer les images d'un produit
     * @param int (identifiant du produit)
     * @return array
     */
    public function getImagesProduct(int $idProduct) : array
    {
        $db = $this->connectDB();

        $query = "SELECT `img_id` as 'id', `img_name_file` as 'nameImg', `img_label_file` as 'txtAlt'  
        FROM `ec_get_images`
        NATURAL JOIN `ec_images`
        WHERE `pdt_id` = :idProduct";

        $statment = $db->prepare($query);
        $statment->bindValue(':idProduct', $idProduct, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetchAll();
    }

}

?>