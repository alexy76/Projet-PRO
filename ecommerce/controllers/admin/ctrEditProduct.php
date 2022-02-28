<?php

/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('Location: ../login.php');
    exit();
} elseif (!isset($_GET['id']) || !ctype_digit($_GET['id'])){
    header('Location: ./products.php');
    exit();
}


require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../tools/tools.php';
require_once '../../models/Database.php';
require_once '../../models/Products.php';
require_once '../../models/Collections.php';


$Products = new Products;
//$Category = new Category;
$Collections = new Collections;


$listCollections = $Collections->getListCollections();

$product = $Products->getProduct($_GET['id']);

//var_dump($product);