<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();


/** Valeur des metas */
$meta_title = "Profil du compte client | ECOMMERCE.NET";
$meta_description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus magnam odit voluptate quo, numquam corrupti, eveniet veniam, repellendus reprehenderit recusandae at asperiores! Beatae, ipsa quidem adipisci impedit necessitatibus eius laudantium.";


/** Contrôleur permettant la modification du nom et du prénom du client */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifyProfilName'])) {
    if (isset($_POST['lastName'], $_POST['firstName'])) {
        if (!emptyArray($_POST, 1)) {
            $userName = cleanDataArray($_POST);
            $userName['lastName'] = ucfirst(strtolower($userName['lastName']));
            $userName['firstName'] = ucfirst(strtolower($userName['firstName']));

            if ($_SESSION['lastname'] == $userName['lastName'] && $_SESSION['firstname'] == $userName['firstName']) {
                $messageAlertName = ['warning', 'Les données n\'ont pas été modifiées'];
            } else {
                $errors = [];

                if (!preg_match(REGEX_NAME, $userName['lastName']) || !preg_match(REGEX_NAME, $userName['firstName']))
                    $messageAlertName = ['danger', 'Le format est incorrect'];

                if (!isset($messageAlertName)) {
                    $Users = new Users;
                    if ($Users->setNameClient($userName, (int)$_SESSION['id'])) {
                        $messageAlertName = ['success', 'Votre identité a bien été modifiée'];
                        $_SESSION['lastname'] = $userName['lastName'];
                        $_SESSION['firstname'] = $userName['firstName'];
                    }
                }
            }
        } else
            $messageAlertName = ['danger', 'Tous les champs sont obligatoires'];
    }
}



/** Contrôleur permettant la modification du mot de passe du client */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifyPassword'])) {
    if (isset($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'])) {
        if (!emptyArray($_POST, 1)) {
            $Users = new Users;

            if ($Users->verifyPasswordClient($_SESSION['id'], $_POST['oldPassword'])) 
            {
                if ($_POST['newPassword'] === $_POST['confirmNewPassword'] && !empty($_POST['newPassword'])) 
                {

                    $Users = new Users;

                    if ($Users->setNewPassword($_SESSION['id'], password_hash($_POST['newPassword'], PASSWORD_BCRYPT)))

                        $messageAlertPassword = ['success', 'Le mot de passe a bien été modifié'];

                    else
                        $messageAlertPassword = ['warning', 'Une erreur est survenue'];
                } else
                    $messageAlertPassword = ['danger', 'La confirmation du mot de passe est incorrect'];
            } else
                $messageAlertPassword = ['danger', 'Le mot de passe actuel ne correspond pas'];
        }
        else
            $messageAlertPassword = ['danger', 'Tous les champs sont obligatoires'];
    }
}


/** Contrôleur permettant la modification de l'adresse de livraison du client */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifyAddress'])) 
{
    if (isset($_POST['address'], $_POST['zipCode'], $_POST['city'], $_POST['country'])) 
    {
        $errors = [];

        $address = cleanDataArray($_POST);

        if(!preg_match(REGEX_ZIP, $address['zipCode']))
        {
            $errors['zipCode'] = "Le format du code postal est incorrect";
            unset($address['zipCode']);
        }

        if(!preg_match(REGEX_ADDR, $address['address']))
        {
            $errors['address'] = "Le format de l'adresse est incorrect";
            unset($address['address']);
        }

        if(!preg_match(REGEX_CITY, $address['city']))
        {
            $errors['city'] = "Le format du nom de la ville est incorrect";
            unset($address['city']);
        }

        if(!preg_match(REGEX_CITY, $address['country']))
        {
            $errors['country'] = "Le format du nom du pays est incorrect";
            unset($address['country']);
        }

        if(empty($errors))
        {
            $Users = new Users;
            
            if($Users->setAddress($address, (int)$_SESSION['id']))
            {
                $messageAlertAddress = ['success', 'Votre adresse a été enregistré'];

                $_SESSION['address'] = $address['address'];
                $_SESSION['zipcode'] = $address['zipCode'];
                $_SESSION['city'] = $address['city'];
                $_SESSION['country'] = $address['country'];

                unset($address);
            }
            else
                $messageAlertAddress = ['danger', 'une erreur s\'est produite'];
            
        }
        else
            $messageAlertAddress = ['warning', 'Aucune modification apportée'];
    }
}