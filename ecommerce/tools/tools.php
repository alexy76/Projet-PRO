<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";

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

function cleanDataArray(array $dataArray) : array
{
    return array_map(function($elt){ 
        return trim(stripslashes(htmlspecialchars($elt))); }, $dataArray);
}

function cleanData(string $elt) : string
{
    return trim(stripslashes(htmlspecialchars($elt)));
}

function emptyArray(array $tab, int $nb) : bool
{
    return count(array_filter($tab, function($elt){ 
        return !empty($elt); })) == $nb ? true : false;
}



?>