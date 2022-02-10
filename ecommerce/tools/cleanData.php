<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
// require_once "../../pwd.php";

function smtpmailer($to, $from, $from_name, $subject, $body)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 

    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;  
    $mail->Username = 'ecommerce.lamanu@gmail.com';
    $mail->Password = PWD_GMAIL;   

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
    if(!$mail->Send())
    {
        $error ="Please try Later, Error Occured while Processing...";
        return $error; 
    }
    else 
    {
        $error = "Thanks You !! Your email is sent.";  
        return $error;
    }
}

function cleanData(array $postData)
{
    return array_map(
        function($elt){
            return trim(stripslashes(htmlspecialchars($elt)));
        }
    , $postData);
}

?>