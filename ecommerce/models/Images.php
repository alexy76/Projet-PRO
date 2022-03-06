<?php

class Images extends Database{



    /**
     * Méthode permettant d'enregistrer une nouvelle collection
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

}

?>