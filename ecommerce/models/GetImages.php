<?php

class GetImages extends Database{



    /**
     * Méthode permettant d'enregistrer une nouvelle collection
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

}

?>