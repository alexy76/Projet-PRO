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

    if (ctype_digit($_POST['idProduct']) && ctype_digit($_POST['idColProduct'])) {

        if ($Products->setChangeCollection(intval($_POST['idProduct']), intval($_POST['idColProduct']))) {

            $flashToast = true;
            $flashMsg = ['success', 'Le produit a été migré vers une autre collection'];
        } else {
            $flashToast = true;
            $flashMsg = ['error', 'Une erreur s\'est produite'];
        }
    }
}



/** Contrôleur permettant de modifier le prix ou la remise (%) d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePrice'])) {

    $price = floatval(cleanData($_POST['price']));
    $discount = intval(cleanData($_POST['discount']));
    $id = intval($_POST['idProduct']);

    if ($discount >= 0 && $price >= 0 && is_int($discount) && is_float($price)) {

        if ($Products->setNewPrice($id, $price, $discount)) {

            $flashToast = true;
            $flashMsg = ['success', 'Les prix ont été changés'];
        } else {
            $flashToast = true;
            $flashMsg = ['error', 'Une erreur s\'est produite'];
        }
    } else {
        $flashToast = true;
        $flashMsg = ['warning', 'Les champs doivent contenir une valeur minimale à 0'];
    }
}



/** Contrôleur permettant d'ajouter des déclinaisons du produits (options du produit) */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeOption'])) {

    if ($Products->setOptionsProduct(intval($_POST['idProduct']), cleanData($_POST['optionProduct']))) {
        $flashToast = true;
        $flashMsg = ['success', 'Les options ont été modifiées'];
    } else {
        $flashToast = true;
        $flashMsg = ['error', 'Une erreur s\'est produite'];
    }
}



/** Contrôleur permettant d'ajouter ou modifier les métas de la page produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeMeta'])) {

    $metaTitle = cleanData($_POST['metaTitlePost']);
    $metaDescription = cleanData($_POST['metaDescriptionPost']);

    if ($Products->setMetaProduct($metaTitle, $metaDescription, intval($_POST['idProduct']))) {
        $flashToast = true;
        $flashMsg = ['success', 'Les options ont été modifiées'];
    } else {
        $flashToast = true;
        $flashMsg = ['error', 'Une erreur s\'est produite'];
    }
}



$listCollections = $Collections->getListCollections();
$product = $Products->getProduct(intval($_GET['id']));