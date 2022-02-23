<?php

class Newsletters extends Database
{

    /**
     * Méthode permettant d'enregistrer un email dans la table Newsletters
     * @param string (adresse mail)
     * @return bool
     */
    public function setMail(string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_newsletters` (`news_adress_mail`) VALUES (:mail);";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);

        return $statment->execute();
    }
}