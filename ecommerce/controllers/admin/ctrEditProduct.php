<?php
/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('Location: ../login.php');
    exit();
} elseif (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: ./products.php');
    exit();
}


require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../tools/tools.php';
require_once '../../models/Database.php';
require_once '../../models/Products.php';
require_once '../../models/Collections.php';

var_dump($_POST);
var_dump($_FILES);

$Products = new Products;
$Collections = new Collections;


/** Contrôleur permettant de modifier le nom d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeName'])) {

    $name = cleanData($_POST['nameProduct']);
    $slug = formatSlug($name);
    $id = intval($_POST['idProduct']);

    if (!$Products->getExistSlug($slug) && !empty($name) && !empty($id)) {

        if ($Products->setNewName($id, $name, $slug)) {

            $flashToast = true;
            $flashMsg = ['success', 'Le nom a été changé'];

        } else {
            $flashToast = true;
            $flashMsg = ['error', 'Une erreur s\'est produite'];
        }
    } else {
        $flashToast = true;
        $flashMsg = ['warning', 'Le nom de produit est déjà utilisé'];
    }
}



/** Contrôleur permettant de modifier la collection d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeCollection'])) {

    if(ctype_digit($_POST['idProduct']) && ctype_digit($_POST['idColProduct'])){

        if ($Products->setChangeCollection(intval($_POST['idProduct']), intval($_POST['idColProduct']))) {

            $flashToast = true;
            $flashMsg = ['success', 'Le produit a été migré vers une autre collection'];

        } else {
            $flashToast = true;
            $flashMsg = ['error', 'Une erreur s\'est produite'];
        }
    }
}


$listCollections = $Collections->getListCollections();
$product = $Products->getProduct($_GET['id']);