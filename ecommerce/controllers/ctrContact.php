<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Newsletters.php';
require_once '../models/Collections.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */
if(session_status() === PHP_SESSION_NONE) session_start();
$Collections = new Collections;


/** Valeur des metas */
$meta_title = "Contactez-nous | ECOMMERCE.NET";
$meta_description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus magnam odit voluptate quo, numquam corrupti, eveniet veniam, repellendus reprehenderit recusandae at asperiores! Beatae, ipsa quidem adipisci impedit necessitatibus eius laudantium.";



/**Contrôleur du formulaire de contact */
if(isset($_POST['fromName'], $_POST['fromMail'], $_POST['messageMail'], $_POST['g-recaptcha-response'], $_POST['sendMail']))
{
    if(!emptyArray($_POST, 1))
    {
        $formContact = cleanDataArray($_POST);

        if(!preg_match(REGEX_FORM_NAME, $formContact['fromName']))
        {
            $errors['fromName'] = "Le format de l'identité est incorrect.";
            unset($formContact['fromName']);
        }

        if(!filter_var($formContact['fromMail'], FILTER_VALIDATE_EMAIL) || strlen($formContact['fromMail']) > 100)
        {
            $errors['fromMail'] = "Le format de l'email est invalide.";
            unset($formContact['fromMail']);
        }

        if(strlen($formContact['messageMail']) > 250)
            $errors['messageMail'] = "Attention vous êtes limité a 500 caractères.";


        if (empty($_POST['g-recaptcha-response']))
                $errors['reCaptcha'] = 'Veuillez valider le reCAPTCHA';
            else {
                //$ip = $_SERVER['REMOTE_ADDR'];
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode('6LdB5HAeAAAAAChezk16TaVcl5O2ACuH_2KrZPfV') .  '&response=' . urlencode($_POST['g-recaptcha-response']);
                $responseKeys = json_decode(file_get_contents($url), true);

                if (!$responseKeys["success"]) 
                    $errors['reCaptcha'] = 'Bots interdit sur ce site';
        }

        if(empty($errors))
        {
            $to   = 'alexy.lepretre76@laposte.net';
            $from = $formContact['fromMail'];
            $name = 'Reclamation client Ecommerce';
            $subj = 'Reclamation client Ecommerce';
            $msg = 'Nom et prenom de la personne a recontacter : '. $formContact['fromName'] .' 
            <br><br> Message du client : 
            <br><br> ' . $formContact['messageMail'];
            
            if(smtpmailer($to,$from, $name ,$subj, $msg)){
                unset($formContact);
                $messageAlert = ['success', 'Votre message a bien été envoyé, nous vous réponderons sous 24H.'];
            }else
            $messageAlert = ['danger', 'Une erreur est survenue, veuillez réessayer'];
        }
        
    }
    else
        $messageAlert = ['danger', 'Tous les champs doivent être complétés !'];
}



/** Contrôleur d'ajout de mail dans la table Newsletters  */
if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $Newsletters = new Newsletters;
    if($Newsletters->setMail(strtolower(cleanData($_POST['NewsLetterMail'])))){
        $flashToast = true;
        $flashMsg = ['success', 'Inscription validée'];
    }
}