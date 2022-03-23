<?php

function smtpmailer($to, $from, $from_name, $subject, $body) : bool
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 

    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;  
    $mail->Username = 'ecommerce.lamanu@gmail.com';
    $mail->Password = 'EcomLaManu76';

//   $path = 'reseller.pdf';
//   $mail->AddAttachment($path);
    $mail->CharSet = 'UTF-8';

    $mail->IsHTML(true);
    $mail->From="ecommerce.lamanu@gmail.com";
    $mail->FromName=$from_name;
    $mail->Sender=$from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);

    return $mail->Send();
}


/* Fonction retournant un tableau nettoyé */
function cleanDataArray(array $dataArray) : array
{
    return array_map(function($elt){ 
        return trim(stripslashes(htmlspecialchars($elt))); }, $dataArray);
}

/* Fonction retournant une chaine de caractère nettoyée */
function cleanData(string $elt) : string
{
    return trim(stripslashes(htmlspecialchars($elt)));
}

function emptyArray(array $tab, int $nb) : bool
{
    return count(array_filter($tab, function($elt){ 
        return !empty($elt); })) == $nb ? true : false;
}

function formatSlug(string $str) : string
{
    $str = preg_replace('#Ç#', 'C', $str);
    $str = preg_replace('#ç#', 'c', $str);
    $str = preg_replace('#è|é|ê|ë#', 'e', $str);
    $str = preg_replace('#È|É|Ê|Ë#', 'E', $str);
    $str = preg_replace('#à|á|â|ã|ä|å#', 'a', $str);
    $str = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $str);
    $str = preg_replace('#ì|í|î|ï#', 'i', $str);
    $str = preg_replace('#Ì|Í|Î|Ï#', 'I', $str);
    $str = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $str);
    $str = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $str);
    $str = preg_replace('#ù|ú|û|ü#', 'u', $str);
    $str = preg_replace('#Ù|Ú|Û|Ü#', 'U', $str);
    $str = preg_replace('#ý|ÿ#', 'y', $str);
    $str = preg_replace('#Ý#', 'Y', $str);
    $str = preg_replace('#-#', '', $str);
    $str = preg_replace('#/#', ' ', $str);
    $str = preg_replace('#  #', ' ', $str);
    $str = preg_replace('# #', '-', $str);

    return strtolower($str);
}



?>