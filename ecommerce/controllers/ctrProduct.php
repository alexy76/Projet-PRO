<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */
if(session_status() === PHP_SESSION_NONE) session_start();

$Collections = new Collections;
$Product = new Products;

if(!isset($_GET['id']) || !ctype_digit($_GET['id']) || !$Product->getExistProduct(intval($_GET['id']))){
    header('Location: 404.php');
    exit();
}


var_dump($Product->get_displayByIdProduct(intval($_GET['id'])));

$product = $Product->get_displayByIdProduct(intval($_GET['id']));