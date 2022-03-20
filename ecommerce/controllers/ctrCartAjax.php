<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Category.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../tools/tools.php';


$Products = new Products;


/* Controleur permettant de vérifier si un produit existe et retourne des informations du produit */
if(isset($_POST['idProduct']) && ctype_digit($_POST['idProduct'])){

    if($Products->getExistProduct(intval($_POST['idProduct'])) && $Products->getStatusProduct(intval($_POST['idProduct'])) == 1){

        echo json_encode($Products->get_displayByIdProduct(intval($_POST['idProduct'])));

    }else{
        echo 'false';
    }
}


?>