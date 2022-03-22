<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../models/Newsletters.php';
require_once '../tools/tools.php';
require_once '../controllers/ctrCartAjax.php';

/** Initialisation des paramètres de la page */
if(session_status() === PHP_SESSION_NONE) session_start();

$Collections = new Collections;
$Product = new Products;

if(!isset($_GET['id']) || !ctype_digit($_GET['id']) || !$Product->getExistProduct(intval($_GET['id']))){
    header('Location: /views/404.php');
    exit();
}

$product = $Product->get_displayByIdProduct(intval($_GET['id']));

if(empty($product['images'][0]['image'])){
    header('Location: ../views/404.php');
    exit();
}
/** Valeur des metas */
$meta_title = $product['metaTitle'];
$meta_description = $product['metaDescription'];



/** Contrôleur d'ajout de mail dans la table Newsletters  */
if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $Newsletters = new Newsletters;
    if($Newsletters->setMail(strtolower(cleanData($_POST['NewsLetterMail'])))){
        $flashToast = true;
        $flashMsg = ['success', 'Inscription validée'];
    }
}