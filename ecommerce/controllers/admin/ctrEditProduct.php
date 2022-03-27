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

    if (!empty($_POST['nameProduct'])) {

        if (isset($_POST['idProduct']) && ctype_digit($_POST['idProduct']) && $Products->getExistProduct(intval($_POST['idProduct']))) {

            $name = cleanData($_POST['nameProduct']);
            $slug = formatSlug($name);

            if (!$Products->getExistSlug($slug)) {

                if ($Products->setNewName(intval($_POST['idProduct']), $name, $slug)) {

                    $flashMsg = [true, 'success', 'Le nom a été changé'];
                } else
                    $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
            } else
                $flashMsg = [true, 'warning', 'Le nom de produit est déjà utilisé'];
        } else
            $flashMsg = [true, 'warning', 'L\'ID que vous souhaitez modifier n\'existe pas'];
    } else
        $flashMsg = [true, 'warning', 'Veuillez entrez un nom de produit'];
}



/** Contrôleur permettant de modifier la collection d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeCollection'])) {

    if (isset($_POST['idProduct']) && ctype_digit($_POST['idProduct']) && $Products->getExistProduct(intval($_POST['idProduct']))) {

        if (isset($_POST['idColProduct']) && ctype_digit($_POST['idColProduct']) && $Collections->getExistIdCollection(intval($_POST['idColProduct']))) {

            if ($Products->setChangeCollection(intval(cleanData($_POST['idProduct'])), intval(cleanData($_POST['idColProduct'])))) {

                $flashMsg = [true, 'success', 'Le produit a été migré vers une autre collection'];
            } else
                $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
        } else
            $flashMsg = [true, 'warning', 'L\'ID de la collection que vous souhaitez modifier n\'existe pas'];
    } else
        $flashMsg = [true, 'warning', 'L\'ID du produit que vous souhaitez modifier n\'existe pas'];
}



/** Contrôleur permettant de modifier le prix ou la remise (%) d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePrice'])) {

    if (isset($_POST['idProduct']) && ctype_digit($_POST['idProduct']) && $Products->getExistProduct(intval($_POST['idProduct']))) {

        $price = floatval(cleanData($_POST['price']));
        $discount = intval(cleanData($_POST['discount']));

        if ($discount >= 0 && $discount <= 100 && $price >= 0) {

            if ($Products->setNewPrice(intval($_POST['idProduct']), $price, $discount)) {

                $flashMsg = [true, 'success', 'Les prix ont été changés'];
            } else
                $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
        } else
            $flashMsg = [true, 'warning', 'Les champs doivent contenir des valeurs numériques positives'];
    } else
        $flashMsg = [true, 'warning', 'L\'ID du produit que vous souhaitez modifier n\'existe pas'];
}



/** Contrôleur permettant d'ajouter des déclinaisons du produit (options du produit) */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeOption'])) {

    if (isset($_POST['idProduct']) && ctype_digit($_POST['idProduct']) && $Products->getExistProduct(intval($_POST['idProduct']))) {

        if ($Products->setOptionsProduct(intval($_POST['idProduct']), cleanData($_POST['optionProduct']))) {

            $flashMsg = [true, 'success', 'Les options ont été modifiées'];
        } else
            $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
    } else
        $flashMsg = [true, 'warning', 'L\'ID du produit que vous souhaitez modifier n\'existe pas'];
}



/** Contrôleur permettant d'ajouter ou modifier les métas de la page produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeMeta'])) {

    $metaTitle = cleanData($_POST['metaTitlePost']);
    $metaDescription = cleanData($_POST['metaDescriptionPost']);

    if ($Products->setMetaProduct($metaTitle, $metaDescription, intval($_POST['idProduct']))) {
        $flashMsg = [true, 'success', 'Google vous remercie :D'];
    } else {
        $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
    }
}



/** Contrôleur permettant de modifier la collection d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uploadFile'])) {

    extract($_FILES["fileToUpload"]);

    if (empty($_POST['altImg'])) {
        $flashMsg = [true, 'warning', 'Le texte alternatif est obligatoire'];
    } elseif ($error > 0) {
        $flashMsg = [true, 'warning', 'Veuillez choisir un fichier'];
    } elseif (!@getimagesize($tmp_name)) {
        $flashMsg = [true, 'warning', 'Le fichier n\'est pas une image'];
    } elseif ($size > 3 * 1024 ** 2) {
        $flashMsg = [true, 'warning', 'L\'image est trop volumineuse'];
    } elseif (!in_array(getimagesize($tmp_name)['mime'], ['image/avif', 'image/webp', 'image/png', 'image/jpeg', 'image/tiff', 'image/gif', 'image/bmp'])) {
        $flashMsg = [true, 'warning', 'Le format de l\'image n\'est pas autorisé'];
    } else {

        $explodeNameFile = explode('/', getimagesize($tmp_name)['mime']);

        $extension = end($explodeNameFile);
        $newNameFile = "pdt_" . $_POST['idProduct'] . "_" . uniqid() . '.' . $extension;

        if (move_uploaded_file($tmp_name, "../../assets/img/products/" . $newNameFile)) {

            if ($idImage = $Images->insertAfterUploadImg($newNameFile, $extension, cleanData($_POST['altImg']))) {

                try {
                    $GetImages->insertIntermediateTableImage(intval($idImage), intval($_POST['idProduct']));

                    $flashMsg = [true, 'success', "L'image a été uploadée."];
                } catch (PDOException $e) {
                    $flashMsg = [true, 'error', $e->errorInfo[2]];
                }
            } else {
                $flashMsg = [true, 'error', "Une erreur s'est produite."];
            }
        } else {
            $flashMsg = [true, 'error', "Une erreur s'est produite lors de l'upload."];
        }
    }
}



/** Contrôleur permettant de supprimer une image d'un produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteImage'])) {

    if (unlink($_POST['pathImg'])) {
        if ($Images->deleteImage(intval($_POST['idImage']))) {
            $flashMsg = [true, 'success', "L'image a été supprimée."];
        } else {
            $flashMsg = [true, 'error', "Une erreur s'est produite."];
        }
    }
}



/** Contrôleur permettant de changer le texte alternatif d'une image */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editImage'])) {

    if ($Images->updateAltText(intval($_POST['idImage']), cleanData($_POST['textAlt']))) {
        $flashMsg = [true, 'success', "Le texte alternatif a été modifié"];
    } else {
        $flashMsg = ['error', "Une erreur s'est produite."];
    }
}


/** Contrôleur permettant de changer le descriptif du produit */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveDescription'])) {

    if ($Products->setDescriptionProduct($_POST['descriptionProduct'], $_POST['idProduct'])) {
        $flashMsg = [true, 'success', "La description produit a été modifiée"];
    } else {
        $flashMsg = [true, 'error', "Une erreur s'est produite."];
    }
}




$listCollections = $Collections->getListCollections();
$product = $Products->getProduct(intval($_GET['id']));
$images = $GetImages->getImagesProduct(intval($_GET['id']));
