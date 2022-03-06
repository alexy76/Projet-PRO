<?php

class Images extends Database{



    /**
     * Méthode permettant d'insérer une nouvelle image produit en bdd
     * @param string (nom du fichier)
     * @param string (extension du fichier)
     * @param string (Texte alternatif de l'image)
     * @return string | bool (identifiant de l'insertion ou false en cas d'échec)
     */
    public function insertAfterUploadImg(string $nameFile, string $extFile, string $altFile)
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_images` (`img_name_file`, `img_ext_file`, `img_label_file`) 
        VALUES (:nameFile, :extFile, :altFile)";

        $statment = $db->prepare($query);
        $statment->bindValue(':nameFile', $nameFile, PDO::PARAM_STR);
        $statment->bindValue(':extFile', $extFile, PDO::PARAM_STR);
        $statment->bindValue(':altFile', $altFile, PDO::PARAM_STR);

        if($statment->execute()){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }



    /**
     * Méthode permettant de supprimer une image d'un produit (+ table intermédiaire "delete cascade")
     * @param int (identifiant de l'image)
     * @return bool
     */
    public function deleteImage(int $idImage) : bool
    {
        $db = $this->connectDB();

        $query = "DELETE FROM `ec_images` WHERE `img_id` = :idImage";

        $statment = $db->prepare($query);
        $statment->bindValue(':idImage', $idImage, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de modifier le texte alternatif d'une image
     * @param int (identifiant de l'image)
     * @return bool
     */
    public function updateAltText(int $idImage, string $altText) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_images` SET `img_label_file` = :altText WHERE `img_id` = :idImage";

        $statment = $db->prepare($query);
        $statment->bindValue(':altText', $altText, PDO::PARAM_STR);
        $statment->bindValue(':idImage', $idImage, PDO::PARAM_INT);

        return $statment->execute();
    }

}

?>