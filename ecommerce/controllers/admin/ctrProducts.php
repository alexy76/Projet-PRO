<?php

/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('Location: ../login.php');
    exit();
}

require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../models/Database.php';
require_once '../../models/Category.php';
require_once '../../models/Collections.php';
require_once '../../models/Products.php';
require_once '../../tools/tools.php';

$Category = new Category;
$Collections = new Collections;
$Products = new Products;


$listCollections = $Collections->getListCollections();


/** TEMPORAIRE */





/** Contrôleur permettant l'ajout d'un nouveau produit ! */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addProduct'])) {


    if (!empty($_POST['nameProduct'])) {

        if (isset($_POST['idColProduct']) && ctype_digit($_POST['idColProduct'])) {

            if ($Products->setNewProduct(cleanData($_POST['nameProduct']), intval($_POST['idColProduct']))) {

                $flashToast = true;
                $flashMsg = ['success', "Le produit a été créé"];
            } else {
                $flashToast = true;
                $flashMsg = ['error', "Une erreur est survenue"];
            }
        } else {
            $flashToast = true;
            $flashMsg = ['warning', 'Veuillez choisir une collection'];
        }
    } else {
        $flashToast = true;
        $flashMsg = ['warning', 'Veuillez saisir un nom de produit'];
    }
}



/** Pagination des produits en fonction de la méthode de tri sélectionnée */

$nameMethod = 'allProducts';

if (isset($_GET['req']))       $req = !empty($_GET['req']) ? $_GET['req'] : ' ';

if (isset($_GET['search']) && method_exists($Products, 'getCount_' . $_GET['search']))
    $nameMethod = $_GET['search'];


$nbProducts = $Products->{'getCount_' . $nameMethod}(isset($req) ? $req . '%' : '');

$nbElt = 8;
$nbPages = ceil($nbProducts / $nbElt);
$offset = isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] <= $nbPages ? ($_GET['page'] * $nbElt) - $nbElt : 0;
$pageActual = ($offset / $nbElt) + 1;

$getAllProducts = $Products->{'get_' . $nameMethod}(isset($req) ? $req . '%' : '', intval($nbElt), intval($offset));

