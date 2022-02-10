<?php
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/cleanData.php';

/** Initialisation des paramètres de la page */

if(session_status() === PHP_SESSION_NONE) session_start();




/** Affichage des formulaires selon la requête URL */

if(isset($_GET['action']) && ($_GET['action'] == 'connection' || $_GET['action'] == 'subscribe'))
    $action = $_GET['action'];
else
    $action = 'connection';




//** Contrôleur du formulaire d'inscription **/

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscribe'])) 
{
    if (isset($_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['pwd'], $_POST['pwdConfirm'],)) 
    {
        $Users = new Users;
        $errors =  [];
        $userSubscribe = cleanData($_POST);
        $userSubscribe['newsLetter'] = isset($userSubscribe['newsLetter']) ? true : false;

        if (!preg_match(REGEX_NAME, $userSubscribe['lastName'])) 
        {
            $errors['lastName'] = 'Format du nom incorrect';
            unset($userSubscribe['lastName']);
        }

        if (!preg_match(REGEX_NAME, $userSubscribe['firstName'])) 
        {
            $errors['firstName'] = 'Format du prénom incorrect';
            unset($userSubscribe['firstName']);
        }

        if (!filter_var($userSubscribe['mail'], FILTER_VALIDATE_EMAIL) && strlen($userSubscribe['mail']) > 100 || empty($userSubscribe['mail'])) 
        {
            $errors['mail'] = "Le format de l'adresse mail n'est pas valide";
            unset($userSubscribe['mail']);
        } 
        elseif ($Users->getExistUsermail($userSubscribe['mail'])) 
        {
            $errors['mail'] = "L'adresse mail existe déjà";
            unset($userSubscribe['mail']);
        }


        if ($_POST['pwd'] !== $_POST['pwdConfirm'] || empty($_POST['pwd']))
            $errors['pwd'] = "Les champs doivent être identiques";

        elseif (strlen($_POST['pwd']) < 8)
            $errors['pwd'] = "Le mot de passe doit contenir au minimum 8 caractères";


        if (empty($errors)) {

            $userSubscribe['lastName'] = ucfirst(strtolower($userSubscribe['lastName']));
            $userSubscribe['firstName'] = ucfirst(strtolower($userSubscribe['firstName']));
            $userSubscribe['mail'] = strtolower($userSubscribe['mail']);
            $userSubscribe['pwd'] = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
            $userSubscribe['token'] = bin2hex(random_bytes(32));

            if($Users->insertUser($userSubscribe))
            {
                $messageFlash = '';

                $lien = 'http://ecommerce.net/views/login.php?mail='.$userSubscribe['mail'].'&key='.$userSubscribe['token'];

                unset($userSubscribe);

                $to   = 'alexy.lepretre76@laposte.net';
                $from = 'no-reply@ecommerce.fr';
                $name = 'Ecommerce La Manu';
                $subj = 'Test !';
                $msg = 'Félicitation pour ton inscription, veuillez valider votre compte en cliquant sur : <a href="' . $lien . '">ce lien</a>';
                
                smtpmailer($to,$from, $name ,$subj, $msg);
            }
            else
                $messageFlash = '';
        }
    }
}


/** Contrôleur du formulaire de connexion **/


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connection'])){


    if(isset($_POST['remember'])){
    }

    if(isset($_POST['mail'], $_POST['pwd']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){

        $Users = new Users;
        $_POST['mail'] = strtolower($_POST['mail']);
        $userConnection = cleanData($_POST);

        if($Users->getExistUsermail($userConnection['mail'])){

            if($Users->comparePassword($_POST['pwd'], $userConnection['mail'])){

                if($Users->getStatusUser($userConnection['mail'])){

                    $_SESSION = $Users->getUser($userConnection['mail']);
                    // Faire une redirection plus tard dans le Dev (header());

                }else
                    $messageAlert = ['primary', "Votre compte n'a pas été activé, vérifier vos mails !"];
            }else
                $messageAlert = ['danger', "Mail ou mot de passe incorrect"];
        }
        else
            $messageAlert = ['danger', "Mail ou mot de passe incorrect"];
    }
}


/** Contrôleur de validation de l'adresse mail **/

if(isset($_GET['mail'], $_GET['key'])){

    if(filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL) && strlen($_GET['key']) == 64){

        $Users = new Users;
        $userConfirm = cleanData($_GET);
    
        if($Users->getExistUsermail($userConfirm['mail'])){
    
            $tokenMail = $Users->getTokenMail($userConfirm['mail']);
    
            if($tokenMail == $userConfirm['key']){

                $Users->setActivateAccount($userConfirm['mail']);
                $mail = $userConfirm['mail'];
                $messageAlert = ['success', "Votre adresse mail a bien été confirmée"];

            }
            elseif(is_null($tokenMail))
            {
                $messageAlert = ['primary', "Votre adresse mail a déjà été confirmée"];
                $mail = $userConfirm['mail'];
            }
            else
                $messageAlert = ['danger', "Le token de confirmation de mail est invalide"];
        }
    }
}