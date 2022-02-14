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


var_dump($_POST);

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
