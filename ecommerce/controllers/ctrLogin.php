<?php
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */

if(session_status() === PHP_SESSION_NONE) session_start();

/** Valeur des metas */
$meta_title = 'Se connecter a son compte | ECOMMERCE.NET';
$meta_description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus magnam odit voluptate quo, numquam corrupti, eveniet veniam, repellendus reprehenderit recusandae at asperiores! Beatae, ipsa quidem adipisci impedit necessitatibus eius laudantium.";


/** Affichage des formulaires selon la requête URL */

if(isset($_GET['action']) && ($_GET['action'] == 'connection' || $_GET['action'] == 'subscribe'))
    $action = $_GET['action'];
else
    $action = 'connection';




//** Contrôleur du formulaire d'inscription **/

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscribe'])) 
{
    if (isset($_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['pwd'], $_POST['pwdConfirm'])) 
    {
        if(!emptyArray($_POST, 2))
        {
            $Users = new Users;
            $errors =  [];
            $userSubscribe = cleanDataArray($_POST);
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


            if (empty($_POST['g-recaptcha-response']))
                $errors['reCaptcha'] = 'Veuillez valider le reCAPTCHA';
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode('6LdB5HAeAAAAAChezk16TaVcl5O2ACuH_2KrZPfV') .  '&response=' . urlencode($_POST['g-recaptcha-response']);
                $responseKeys = json_decode(file_get_contents($url), true);

                if (!$responseKeys["success"]) 
                    $errors['reCaptcha'] = 'Bots interdit sur ce site';
            }


            if (empty($errors)) {

                $userSubscribe['lastName'] = ucfirst(strtolower($userSubscribe['lastName']));
                $userSubscribe['firstName'] = ucfirst(strtolower($userSubscribe['firstName']));
                $userSubscribe['mail'] = strtolower($userSubscribe['mail']);
                $userSubscribe['pwd'] = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
                $userSubscribe['token'] = bin2hex(random_bytes(32));

                if($Users->insertUser($userSubscribe))
                {
                    $lien = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] .'?mail='. urlencode($userSubscribe['mail']) .'&key='. urlencode($userSubscribe['token']);

                    //unset($userSubscribe);

                    $to   = 'alexy.lepretre76@laposte.net';
                    $from = 'no-reply@ecommerce.fr';
                    $name = 'Ecommerce La Manu';
                    $subj = 'Test !';
                    $msg = 'Felicitation pour ton inscription, valide ton compte en cliquant sur : <a href="' . $lien . '">ce lien</a>';
                    
                    if(smtpmailer($to,$from, $name ,$subj, $msg)){
                        header('Location: login?validatedSubscribe');
                        exit();
                    }else
                        echo "Le mail n'a pas été envoyé";

                    
                }
                else
                    $messageFlash = '';
            }
        }
        else
            $messageAlert = ['danger', 'Tous les champs doivent être complétés !'];
    }
}


/** Contrôleur du formulaire de connexion **/


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connection']))
{
    if(!emptyArray($_POST, 2))
    {
        if(isset($_POST['mail'], $_POST['pwd']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
        {
                $Users = new Users;
                $_POST['mail'] = strtolower($_POST['mail']);
                $userConnection = cleanDataArray($_POST);

                if($Users->getExistUsermail($userConnection['mail'])){

                    if($Users->comparePassword($_POST['pwd'], $userConnection['mail'])){

                        if($Users->getStatusUser($userConnection['mail'])){

                            $_SESSION = $Users->getUser($userConnection['mail']);
                            // Faire une redirection plus tard dans le Dev (header());

                        }else
                            $messageAlert = ['primary', "Votre compte n'a pas encore été activé ! Veuillez vérifier vos mails ou vos Spams. <br>Si toutefois vous ne l'aurez pas reçu, cliquez <form class='d-inline' method='POST' action=''><input type='hidden' value='". $userConnection['mail'] ."' name='confirmMail'><input class='link-button colorlink' type='submit' value='ici' name='sendConfirmMail'></form>"];
                    }else{
                        $messageAlert = ['danger', "Mail ou mot de passe incorrect"];
                        $mail = $userConnection['mail'];
                    }
                }
                else
                    $messageAlert = ['danger', "Mail ou mot de passe incorrect"];
            }
            
        }
    else
        $messageAlert = ['danger', 'Tous les champs doivent être complétés !'];
}


/** Contrôleur de validation de l'adresse mail **/

if(isset($_GET['mail'], $_GET['key'])){

    if(filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL) && strlen($_GET['key']) == 64){

        $Users = new Users;
        $userConfirm = cleanDataArray($_GET);
    
        if($Users->getExistUsermail($userConfirm['mail'])){
    
            if(($token = $Users->getTokenMail($userConfirm['mail'])) == $userConfirm['key']){

                $Users->setActivateAccount($userConfirm['mail']);
                $mail = $userConfirm['mail'];
                $messageAlert = ['success', "Votre adresse mail a bien été confirmée"];

            }
            elseif(is_null($token))
            {
                $messageAlert = ['primary', "Votre adresse mail a déjà été confirmée"];
                $mail = $userConfirm['mail'];
            }
            else
                $messageAlert = ['danger', "Le token de confirmation de mail est invalide"];
        }
    }
}



/** Contrôleur permettant d'envoyer a nouveau un mail de confirmation d'adresse mail client */

if(isset($_POST['sendConfirmMail'], $_POST['confirmMail']) && filter_var($_POST['confirmMail'], FILTER_VALIDATE_EMAIL)){

    $Users = new Users();
    $mailConfirm = strtolower(cleanData($_POST['confirmMail']));

    if($Users->getExistUsermail($mailConfirm))

        if(!$Users->getStatusUser($mailConfirm)){
            
            $lien = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] .'?mail='. urlencode($mailConfirm) .'&key='. urlencode($Users->getTokenMail($mailConfirm));

            $to   = 'alexy.lepretre76@laposte.net';
            $from = 'no-reply@ecommerce.fr';
            $name = 'Ecommerce La Manu';
            $subj = 'Test !';
            $msg = 'Felicitation pour ton inscription, valide ton compte en cliquant sur : <a href="' . $lien . '">ce lien</a>';
            
            if(smtpmailer($to,$from, $name ,$subj, $msg))

                $messageAlert = ['success', "Le mail a bien été envoyé à l'adresse : <b>".$mailConfirm."</b>"];
            else

                $messageAlert = ['danger', "Une erreur s'est produite lors de l'envoi du mail, à l'adresse : <b>".$mailConfirm."</b>"];
        }
}

?>