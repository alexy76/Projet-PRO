<?php

class Products extends Database
{

    /**
     * Méthode permettant d'enregistrer un nouveau produit
     * @param string        (nom du produit)
     * @param int           (identifiant de la collection)
     * @return int|bool     (identifiant de l'id nouvellement créé | false)
     */
    public function setNewProduct(string $title, int $idCol, string $slug)
    {
        $db = $this->connectDB();

        $query = "INSERT INTO `ec_products` (`pdt_title`,`pdt_price`, `pdt_discount`, `pdt_activated`, `pdt_slug`, `col_id`) 
                VALUES (:title, 0, 0, 0, :slug, :idCol)";

        $statment = $db->prepare($query);
        $statment->bindValue(':title', $title, PDO::PARAM_STR);
        $statment->bindValue(':idCol', $idCol, PDO::PARAM_INT);
        $statment->bindValue(':slug', $slug, PDO::PARAM_STR);

        if ($statment->execute())
            return $db->lastInsertId();
        else
            return false;
    }



    /**
     * Méthode permettant de savoir si le produit existe
     * @param int (identifiant du produit)
     * @return bool
     */
    public function getExistProduct(int $id): bool
    {
        $db = $this->connectDB();
        $query = "SELECT count(`pdt_id`) as 'countProduct' FROM `ec_products`  WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch()->countProduct == 0 ? false : true;
    }



    /**
     * Méthode utilisée avec Ajax permettant de rechercher les noms des produits en autocomplétion
     * @param string (suite de lettres saisie par l'administrateur)
     * @return array (tableau contenant au maximum 10 noms de produits correspondant à la recherche)
     */
    public function getNamesProducts(string $stringNameProduct): array
    {
        $db = $this->connectDB();

        $search = $stringNameProduct . '%';

        $query = "SELECT `pdt_title` FROM `ec_products` WHERE `pdt_title` LIKE :search ORDER BY `pdt_title` LIMIT 10 OFFSET 0";

        $statment = $db->prepare($query);
        $statment->bindValue(':search', $search, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetchAll();
    }



    /**
     * Méthode permettant de récupérer le nombre total de produits (aide à la pagination)
     * @return int (nombre total de produits)
     */
    public function getCount_allProducts(): int
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
    public function get_allProducts(string $opt = null, int $nbElt, int $offset): array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_products` NATURAL JOIN `ec_collection` ORDER BY `pdt_id` DESC LIMIT :nbElt OFFSET :offset";

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
    public function getCount_NameProduct(string $titleProduct): int
    {
        $db = $this->connectDB();

        $query = "SELECT count(`pdt_id`) as 'nbProducts' FROM `ec_products` WHERE `pdt_title` LIKE :titleProduct";

        $statment = $db->prepare($query);
        $statment->bindValue(':titleProduct', $titleProduct, PDO::PARAM_STR);
        $statment->execute();

        return $statment->fetch()->nbProducts;
    }



    /**
     * Méthode permettant de récuperer les données des personnes inscrites selon une recherche par nom
     * @param string (nom de la personne inscrite à rechercher)
     * @param int (nombre d'élements à récuperer)
     * @param int (offset de départ)
     * @return array (liste des inscrits selon le champ de recherche par nom)
     */
    public function get_NameProduct(string $titleProduct, int $nbElt, int $offset): array
    {
        $db = $this->connectDB();

        $query = "SELECT * FROM `ec_products` NATURAL JOIN `ec_collection` WHERE `pdt_title` LIKE :titleProduct ORDER BY `pdt_title` LIMIT :nbElt OFFSET :offset";

        $statment = $db->prepare($query);
        $statment->bindValue(':titleProduct', $titleProduct, PDO::PARAM_STR);
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
    public function deleteProduct(int $id): bool
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
    public function activateProduct(int $id): bool
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
    public function getStatusProduct(int $id): int
    {
        $db = $this->connectDB();
        return intval($db->query("SELECT `pdt_activated` as 'status' FROM `ec_products` WHERE `pdt_id` = $id")->fetch()->status);
    }



    /**
     * Méthode utilisée avec AJAX pour changer le statut de l'activation d'un produit
     * @param int (identifiant du produit)
     * @return bool
     */
    public function changeStatusProduct(int $id, int $status): bool
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
    public function getProduct(int $id): array
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
    public function setNewName(int $id, string $name, string $slug): bool
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
    public function getExistSlug(string $slug): bool
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
    public function setChangeCollection(int $idProduct, int $idCol): bool
    {
        $db = $this->connectDB();
        $query = "UPDATE `ec_products` SET `col_id` = :idCol WHERE `pdt_id` = :idProduct";

        $statment = $db->prepare($query);
        $statment->bindValue(':idProduct', $idProduct, PDO::PARAM_INT);
        $statment->bindValue(':idCol', $idCol, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de modifier le prix et la remise d'un produit
     * @param int (identifiant produit)
     * @param float (prix du produit)
     * @param int (remise sur le produit en %)
     * @return bool
     */
    public function setNewPrice(int $id, float $price, int $discount): bool
    {
        $db = $this->connectDB();
        $query = "UPDATE `ec_products` SET `pdt_price` = :price , `pdt_discount` = :discount  WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':price', $price, PDO::PARAM_STR);
        $statment->bindValue(':discount', $discount, PDO::PARAM_INT);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de modifier le prix et la remise d'un produit
     * @param int (identifiant produit)
     * @param string (options pour le produit | séparateur ",")
     * @return bool
     */
    public function setOptionsProduct(int $id, string $options): bool
    {
        $db = $this->connectDB();
        $query = "UPDATE `ec_products` SET `pdt_option` = :options WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':options', $options, PDO::PARAM_STR);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de modifier le prix et la remise d'un produit
     * @param string (meta title de la fiche produit)
     * @param string (meta description de la fiche produit)
     * @param int (identifiant produit)
     * @return bool
     */
    public function setMetaProduct(string $metaTitle, string $metaDescription, int $id): bool
    {
        $db = $this->connectDB();
        $query = "UPDATE `ec_products` SET `pdt_meta_title` = :metaTitle, `pdt_meta_description` = :metaDescription WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':metaTitle', $metaTitle, PDO::PARAM_STR);
        $statment->bindValue(':metaDescription', $metaDescription, PDO::PARAM_STR);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }



    /**
     * Méthode permettant de modifier la description d'un produit
     * @param string (Description du produit CODE HTML)
     * @param int (Identifiant du produit)
     * @return bool
     */
    public function setDescriptionProduct(string $descriptionProduct, int $id): bool
    {
        $db = $this->connectDB();

        $query = "UPDATE `ec_products` SET `pdt_long_description` = :descriptionProduct WHERE `pdt_id` = :id";

        $statment = $db->prepare($query);
        $statment->bindValue(':descriptionProduct', $descriptionProduct, PDO::PARAM_STR);
        $statment->bindValue(':id', $id, PDO::PARAM_INT);

        return $statment->execute();
    }


    /**
     * Méthode permettant de récupérer le nombre de produits selon la collection (aide à la pagination)
     * @param int (identifiant de la collection)
     * @return int (nombre total de produits)
     */
    public function getCount_displayByCollection(int $idCollection): int
    {
        $db = $this->connectDB();

        $query = "SELECT count(`pdt_id`) as 'nbProducts' 
                    FROM `ec_products` 
                    WHERE `col_id` = :idCollection AND `pdt_activated` = 1";

        $statment = $db->prepare($query);
        $statment->bindValue(':idCollection', $idCollection, PDO::PARAM_INT);
        $statment->execute();

        return $statment->fetch()->nbProducts;
    }


    /**
     * Méthode permettant de récuperer la liste des produits par collection (pagination + tri)
     * @param int (identifiant de la collection)
     * @param string (nom de la requete)
     * @param int (nombre d element a recuperer)
     * @param int (offset)
     * @return array|null
     */
    public function get_displayByCollection(int $idCollection, string $query, int $nbElt, int $offset)
    {
        $queryAccept = ['all', 'pricedesc', 'priceasc'];

        if (in_array($query, $queryAccept)) {

            $db = $this->connectDB();

            switch ($queryAccept) {
                case $query == 'all':
                    $queryReq = "WHERE `col_id` = :idCollection AND `pdt_activated` = 1 GROUP BY `pdt_id` LIMIT :nbElt OFFSET :offset";
                    break;
                case $query == 'pricedesc':
                    $queryReq = "WHERE `col_id` = :idCollection AND `pdt_activated` = 1
                                GROUP BY `pdt_id` 
                                ORDER BY `pdt_price` DESC
                                LIMIT :nbElt OFFSET :offset;";
                    break;
                case $query == 'priceasc':
                    $queryReq = "WHERE `col_id` = :idCollection AND `pdt_activated` = 1
                                GROUP BY `pdt_id` 
                                ORDER BY `pdt_price` ASC
                                LIMIT :nbElt OFFSET :offset;";
                    break;
            }

            $query = "SELECT `pdt_id` AS 'idProduct', `pdt_title` AS 'titleProduct', `pdt_price` AS 'priceProduct', 
                        `pdt_discount` AS 'discountPrice', `img_name_file` AS 'imageProduct', 
                        `img_label_file` AS 'labelImage', `pdt_slug` AS 'slugProduct' 
                        FROM `ec_products`
                        NATURAL JOIN `ec_get_images`
                        NATURAL JOIN `ec_images`" . $queryReq;

            $statment = $db->prepare($query);
            $statment->bindValue(':idCollection', $idCollection, PDO::PARAM_INT);
            $statment->bindValue(':nbElt', $nbElt, PDO::PARAM_INT);
            $statment->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statment->execute();

            return $statment->fetchAll();
        } else {
            return null;
        }
    }

    /**
     * Méthode permettant de récupérer les informations d'un produit
     * @param int (identifiant du produit)
     * @return array
     */
    public function get_displayByIdProduct(int $idProduct)
    {
        $db = $this->connectDB();
        $query = "SELECT `pdt_id` as 'id', `col_id` as 'idCol', `pdt_title` as 'title', `pdt_price` as 'price', `pdt_discount` as 'discount', 
                    `pdt_option` as 'option', `pdt_activated` as 'activated', `pdt_slug` as 'slug', `col_slug` as 'slugCol',
                    `pdt_long_description` as 'longDescription', `pdt_meta_title` as 'metaTitle', 
                    `pdt_meta_description` as 'metaDescription', `col_name` as 'colName', `cat_name` as 'catName',
                    `col_slug` as 'colSlug', group_concat(`img_name_file`) as 'nameImages', group_concat(`img_label_file`) as 'altImages' 
                    FROM `ec_products` 
                    NATURAL JOIN `ec_collection`
                    NATURAL JOIN `ec_category`
                    NATURAL JOIN `ec_get_images`
                    NATURAL JOIN `ec_images`
                    WHERE `pdt_id` = :idProduct
                    GROUP BY `pdt_id` = :idProduct";

        $statment = $db->prepare($query);
        $statment->bindValue(':idProduct', $idProduct, PDO::PARAM_INT);
        $statment->execute();

        $product = $statment->fetch(PDO::FETCH_ASSOC);

        $images = explode(',', $product['nameImages']);
        $altImages = explode(',', $product['altImages']);

        unset($product['nameImages']);
        unset($product['altImages']);

        for ($i = 0; $i < count($images); $i++) {
            $product['images'][] = [
                'image' => $images[$i],
                'alt' => $altImages[$i]
            ];
        }

        return $product;
    }
}
