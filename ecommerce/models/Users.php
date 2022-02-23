<?php
class Users extends Database{


    /**
     * Méthode permettant d'enregistrer un utilisateur
     * @param array (string 'mail',string 'pwd', string 'lastName', string 'firstName', boolean 'newsLetter', string 'token')
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
    public function getTokenMail(string $mail)
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
     * @param string (password)
     * @param string (adresse email)
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



    /**
     * Méthode permettant de récupérer les données d'un utilisateur (ouverture de session)
     * @param string (adresse mail)
     * @return array (données de l'utilisateur)
     */
    public function getUser(string $mail)
    {
        $db = $this->connectDB();

        $query = "SELECT `usr_id` AS 'id', `usr_mail` AS 'mail', `usr_lastname` AS 'lastname',
        `usr_firstname` AS 'firstname', `usr_role` AS 'role', `usr_adress` AS 'address', 
        `usr_zip_code` AS 'zipcode', `usr_city` AS 'city', `usr_country` AS 'country', 
        `usr_accept_newsletters` AS 'newsletters', `usr_registered` AS 'registered'
        FROM `ec_users` WHERE `usr_mail` = :mail";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch(PDO::FETCH_ASSOC);
    }



    /**
     * Méthode permettant d'enregistrer un jeton(token), (récupération du mot de passe)
     * @param string (token)
     * @param string (adresse email)
     * @return bool
     */
    public function setTokenPassword(int $code, string $token, string $mail) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` 
                SET `usr_token_password` = :token, `usr_time_validity_token` = NOW() + INTERVAL 10 MINUTE 
                WHERE `usr_mail` = :mail";

        $statment = $db->prepare($query);
        $statment->bindValue(':mail', $mail, PDO::PARAM_STR);
        $statment->bindValue(':token', $token, PDO::PARAM_STR);

        return $statment->execute();
    }



    /**
     * Méthode permettant de mettre à jour le nom et le prénom d'un client
     * @param array ('firstName','lastName')
     * @return bool
     */
    public function setNameClient(array $name, int $id) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` SET `usr_lastname` = :lastname, `usr_firstname` = :firstname WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':lastname', $name['lastName'], PDO::PARAM_STR);
        $statment->bindValue(':firstname', $name['firstName'], PDO::PARAM_STR);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }

    

    /**
     * Méthode permettant de vérifier le password d'un client enregistré afin de le modifier par la suite
     * @param int (identifiant du client)
     * @param string (mot de passe actuel du client)
     * @return bool
     */
    public function verifyPasswordClient(int $id, string $pwd) : bool
    {
        $db = $this->connectDB();

        $query = "SELECT `usr_password` as 'pwd' FROM `ec_users` WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->execute();
        
        return password_verify($pwd, $statment->fetch()->pwd);
    }



    /**
     * Méthode permettant d'enregistré le nouveau password d'un client
     * @param int (identifiant du client)
     * @param string (hash du nouveau mot de passe)
     */
    public function setNewPassword(int $id, string $pwd) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` SET `usr_password` = :pwd WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->bindValue(':pwd', $pwd, PDO::PARAM_STR);

        return $statment->execute();
    }



    /**
     * Méthode permettant d'enregistrer l'adresse du client
     * @param array ('address', 'zipCode', 'city', 'country')
     * @param int (identifiant du client)
     * @return bool
     */
    public function setAddress(array $addr, int $id) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` 
                SET `usr_adress` = :address, `usr_zip_code` = :zipcode, `usr_city` = :city, `usr_country` = :country
                WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':address', $addr['address'], PDO::PARAM_STR);
        $statment->bindValue(':zipcode', $addr['zipCode'], PDO::PARAM_STR);
        $statment->bindValue(':city', $addr['city'], PDO::PARAM_STR);
        $statment->bindValue(':country', $addr['country'], PDO::PARAM_STR);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant au client d'activé son inscription à la Newsletter
     * @param int (identifiant du client)
     * @return bool
     */
    public function setActivateNewsletters(int $id) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` SET `usr_accept_newsletters` = TRUE WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant à un client d'effacer son adresse postale de la base de données
     * @param int (identifiant du client)
     * @return bool
     */
    public function deleteAddrClient(int $id) : bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_users` SET `usr_adress` = NULL, `usr_zip_code` = NULL, `usr_city` = NULL, `usr_country` = NULL WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de récupérer le nombre total de personnes inscrites (aide à la pagination)
     * @return int (nombre total de clients)
     */
    public function getCount_AllClients() : int
    {
        $db = $this->connectDB();
        return $db->query("SELECT count(`usr_id`) as 'nbClients' FROM `ec_users`")->fetch()->nbClients;
    }



    /**
     * Méthode permettant de récuperer les données de toutes les personnes inscrites
     * @param string (option = null, non utilisée pour cette méthode)
     * @param int (nombre d'élements à récuperer)
     * @param int (offset de départ)
     * @return array (liste de tous les inscrits)
     */
    public function get_AllClients(string $optional = null, int $nbElt, int $offset) : array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_users` ORDER BY `usr_lastname` LIMIT :nbElt OFFSET :offset";

        $statment = $db->prepare($query);
        $statment->bindValue(':nbElt', $nbElt, PDO::PARAM_INT);
        $statment->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetchAll();
    }



    /**
     * Méthode permettant de récupérer le nombre des personnes inscrites selon un champ de recherche par nom (aide à la pagination)
     * @return int (nombre total d'inscrits selon la recherche par nom)
     */
    public function getCount_NameClient(string $lastname) : int
    {
        $db = $this->connectDB();

        $query = "SELECT count(`usr_id`) as 'nbClients' FROM `ec_users` WHERE `usr_lastname` LIKE :lastname";

        $statment = $db->prepare($query);
        $statment->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->nbClients;
    }



    /**
     * Méthode permettant de récuperer les données des personnes inscrites selon une recherche par nom
     * @param string (nom de la personne inscrite à rechercher)
     * @param int (nombre d'élements à récuperer)
     * @param int (offset de départ)
     * @return array (liste des inscrits selon le champ de recherche par nom)
     */
    public function get_NameClient(string $lastname, int $nbElt, int $offset) : array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_users` WHERE `usr_lastname` LIKE :lastname ORDER BY `usr_lastname` LIMIT :nbElt OFFSET :offset";

        $statment = $db->prepare($query);
        $statment->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statment->bindValue(':nbElt', $nbElt, PDO::PARAM_INT);
        $statment->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetchAll();
    }


    /**
     * Méthode permettant de récupérer le nombre total de personnes inscrites ayant un compte non activé  (aide à la pagination)
     * @return int (nombre total d'inscrits ayant un compte non activé)
     */
    public function getCount_AccountNotActivated() : int
    {
        $db = $this->connectDB();
        return $db->query("SELECT count(`usr_id`) as 'nbClients' FROM `ec_users` WHERE `usr_account_activate` = FALSE")->fetch()->nbClients;
    }



    /**
     * Méthode permettant de récuperer les données des personnes inscrites ayant un compte non activé
     * @param string (option = null, non utilisée pour cette méthode)
     * @param int (nombre d'élements à récuperer)
     * @param int (offset de départ)
     * @return array (liste des inscrits ayant un compte non activé)
     */
    public function get_AccountNotActivated(string $optional = null, int $nbElt, int $offset) : array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_users` WHERE `usr_account_activate` = FALSE ORDER BY `usr_lastname` LIMIT :nbElt OFFSET :offset";

        $statment = $db->prepare($query);
        $statment->bindValue(':nbElt', $nbElt, PDO::PARAM_INT);
        $statment->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetchAll();
    }



    /**
     * Méthode utilisée avec Ajax permettant de rechercher les noms des inscrits en fonction de la saisie de l'administrateur
     * @param string (suite de lettres saisie par l'administrateur)
     * @return array (tableau contenant au maximum 10 noms correspondant à la recherche)
     */
    public function getName(string $stringName) : array
    {
        $db = $this->connectDB();

        $search = $stringName.'%';

        $query = "SELECT `usr_lastname` FROM `ec_users` WHERE `usr_lastname` LIKE :search ORDER BY `usr_lastname` LIMIT 10 OFFSET 0";

        $statment = $db->prepare($query);
        $statment->bindValue(':search', $search, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetchAll();
    }



    /**
     * Méthode permettant de supprimer une personne inscrite
     * @param string (identifiant du compte a supprimer)
     * @return bool
     */
    public function deleteUser(string $id) : bool
    {
        $db = $this->connectDB();

        $query = "DELETE FROM `ec_users` WHERE `usr_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_STR);

        return $statment->execute();
    }
}
?>