<?php

/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('Location: ../login.php');
    exit();
}


require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../tools/tools.php';
require_once '../../models/Database.php';
require_once '../../models/Products.php';
require_once '../../models/Collections.php';
require_once '../../models/Images.php';
require_once '../../models/GetImages.php';



$Products = new Products;
$Collections = new Collections;
$Images = new Images;
$GetImages = new GetImages;



if (!isset($_GET['id']) || !ctype_digit($_GET['id']) || !$Products->getExistProduct(intval(cleanData($_GET['id'])))) {
    header('Location: ./products.php');
    exit();
}



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

    if ($discount >= 0 && $discount <= 100 && $price >= 0 && is_int($discount) && is_float($price)) {

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
        $flashMsg = ['success', 'Google vous remercie :D'];
    } else {
        $flashToast = true;
        $flashMsg = ['error', 'Une erreur s\'est produite'];
    }
}



/** Contrôleur permettant de modifier la collection d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uploadFile'])) {

    extract($_FILES["fileToUpload"]);

    if (empty($_POST['altImg'])) {
        $flashToast = true;
        $flashMsg = ['warning', 'Le texte alternatif est obligatoire'];
    } elseif ($error > 0) {
        $flashToast = true;
        $flashMsg = ['warning', 'Veuillez choisir un fichier'];
    } elseif (!@getimagesize($tmp_name)) {
        $flashToast = true;
        $flashMsg = ['warning', 'Le fichier n\'est pas une image'];
    } elseif ($size > 3 * 1024 ** 2) {
        $flashToast = true;
        $flashMsg = ['warning', 'L\'image est trop volumineuse'];
    } elseif (!in_array(getimagesize($tmp_name)['mime'], ['image/avif', 'image/webp', 'image/png', 'image/jpeg', 'image/tiff', 'image/gif', 'image/bmp'])) {
        $flashToast = true;
        $flashMsg = ['warning', 'Le format de l\'image n\'est pas autorisé'];
    } else {

        $explodeNameFile = explode('/', getimagesize($tmp_name)['mime']);

        $extension = end($explodeNameFile);
        $newNameFile = "pdt_" . $_POST['idProduct'] . "_" . uniqid() . '.' . $extension;

        if (move_uploaded_file($tmp_name, "../../assets/img/products/" . $newNameFile)) {

            if ($idImage = $Images->insertAfterUploadImg($newNameFile, $extension, cleanData($_POST['altImg']))) {

                try {
                    $GetImages->insertIntermediateTableImage(intval($idImage), intval($_POST['idProduct']));

                    $flashToast = true;
                    $flashMsg = ['success', "L'image a été uploadée."];
                } catch (PDOException $e) {
                    $flashToast = true;
                    $flashMsg = ['error', $e->errorInfo[2]];
                }

            } else {
                $flashToast = true;
                $flashMsg = ['error', "Une erreur s'est produite."];
            }
        } else {
            $flashToast = true;
            $flashMsg = ['error', "Une erreur s'est produite lors de l'upload."];
        }
    }
}



/** Contrôleur permettant de supprimer une image d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteImage'])) {

    if (unlink($_POST['pathImg'])) {
        if ($Images->deleteImage(intval($_POST['idImage']))) {
            $flashToast = true;
            $flashMsg = ['success', "L'image a été supprimée."];
        } else {
            $flashToast = true;
            $flashMsg = ['error', "Une erreur s'est produite."];
        }
    }
}



/** Contrôleur permettant de changer le texte alternatif d'une image */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editImage'])) {

    if ($Images->updateAltText(intval($_POST['idImage']), cleanData($_POST['textAlt']))) {
        $flashToast = true;
        $flashMsg = ['success', "Le texte alternatif a été modifié"];
    } else {
        $flashToast = true;
        $flashMsg = ['error', "Une erreur s'est produite."];
    }
}


/** Contrôleur permettant de changer le descriptif du produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveDescription'])) {

    if($Products->setDescriptionProduct($_POST['descriptionProduct'], $_POST['idProduct'])){
        $flashToast = true;
        $flashMsg = ['success', "La description produit a été modifiée"];
    }else{
        $flashToast = true;
        $flashMsg = ['error', "Une erreur s'est produite."];
    }
}




$listCollections = $Collections->getListCollections();
$product = $Products->getProduct(intval($_GET['id']));
$images = $GetImages->getImagesProduct(intval($_GET['id']));