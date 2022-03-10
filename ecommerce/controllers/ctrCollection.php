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

if(!isset($_GET['id']) || !ctype_digit($_GET['id']) || !$Collections->getExistIdCollection(intval($_GET['id']))){
    header('Location: home.php');
    exit();
}


$Products = new Products;

$productsByCollection = $Products->get_displayByCollection(intval($_GET['id']));



/** Valeur des metas (A VOIR PLUS TARD POUR LA RECHERCHER PAR COLLECTION) */
$meta_title = 'En cours de construction';
$meta_description = "En cours de construction";


?>