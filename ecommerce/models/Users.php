<?php
class Users extends Database{


    /**
     * Méthode permettant d'enregistrer un utilisateur
     * @param array (string mail, string password, string nom, string prenom, boolean newsletter, string tokem_mail)
     * @return bool
     */
    public function insertUser(array $user) : bool
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_users` (`usr_mail`, `usr_password`, `usr_lastname`, `usr_firstname`, `usr_accept_newsletters`, `usr_registered`, `usr_account_activate`, `usr_role`, `usr_token_mail`)
        VALUES (:mail, :pwd, :lastName, :firstName, :newsLetter, date_format(NOW(), '%Y-%m-%d'), false, 1, :token)";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $user['mail'], PDO::PARAM_STR);
        $statment->bindValue(':pwd', $user['pwd'], PDO::PARAM_STR);
        $statment->bindValue(':lastName', $user['lastName'], PDO::PARAM_STR);
        $statment->bindValue(':firstName', $user['firstName'], PDO::PARAM_STR);
        $statment->bindValue(':newsLetter', $user['newsLetter'], PDO::PARAM_BOOL);
        $statment->bindValue(':token', $user['token'], PDO::PARAM_STR);

        return $statment->execute();
    }



    /**
     * Méthode permettant de connaître l'existence d'une adresse mail en bdd
     * @param string (adresse email)
     * @return bool
     */
    public function getExistUsermail(string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "SELECT count(`usr_mail`) as 'countMail' FROM `ec_users` WHERE `usr_mail` = :mail";
        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->countMail > 0 ? true : false;
    }



    /**
     * Méthode permettant de récuperer le token de confirmation du mail
     * @param string (adresse email)
     * @return mixed (string | NULL)
     */
    public function getTokenMail(string $mail) : mixed
    {
        $db = $this->connectDB();

        $query = "SELECT `usr_token_mail` as 'token' FROM `ec_users` WHERE `usr_mail` = :mail";
        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->token;
    }



    /**
     * Méthode permettant d'activer le compte utilisateur
     * @param string (adresse email)
     * @return bool
     */
    public function setActivateAccount(string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` SET `usr_token_mail` = NULL, `usr_account_activate` = TRUE WHERE `usr_mail` = :mail";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);

        return $statment->execute();
    }



    /**
     * Méthode permettant de comparer le password de l'utilisateur a celui de la BDD
     * @param string (password, adresse email)
     * @return bool
     */
    public function comparePassword(string $pwd, string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "SELECT `usr_password` as 'pwd' FROM `ec_users` WHERE `usr_mail` = :mail";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->execute();

        return password_verify($pwd, $statment->fetch()->pwd);
    }



    /**
     * Méthode permettant de connaître si un utilisateur a validé son email
     * @param string (adresse email)
     * @return bool
     */
    public function getStatusUser(string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "SELECT `usr_account_activate` as 'activate' FROM `ec_users` WHERE `usr_mail` = :mail";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->activate;
    }
}
?>