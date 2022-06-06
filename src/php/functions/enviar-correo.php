<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require_once "../classes/Connection.php";

$mail = new PHPMailer;
$postdata = http_build_query(
    array(
        'fallo' => json_encode($fallo)
    )
);
$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
$context = stream_context_create($opts);
$message = file_get_contents('http://localhost/src/php/functions/message.php', false, $context);

//Server settings
$mail->SMTPDebug = 0;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->isHTML(true);
$mail->Host       = 'smtp.ionos.mx ';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication


//Obtención de credenciales desde base de datos 

$conn = new Connection();
$mysql = $conn->getConnection();
$sql = "SELECT * FROM cuenta";
if($result = $mysql->query($sql)) {
    if($result->num_rows > 0) {
        while($row = $result->fetch_array()) {
            $mail->Username = $row['correo'];
            $mail->Password = $row['pass'];
            $mysql->close();
        }
    } else {
        $mysql->close();
    }
}

/*
$mail->Username   = 'correo@ejemplo.com';                     //SMTP username


$mail->Password   = "*********";                               //SMTP password
*/

$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;   


$mail->setFrom('solsoft@alethetwin.online', 'SolSoft Manejo de Errores');
$mail->addReplyTo('solsoft@alethetwin.online', 'SolSoft Manejo de errores');

//Destinatario

$mail->addAddress('alethetwin@icloud.com', 'Alejandro Sánchez');

//mail
$mail->Subject = 'Pirmera prueba de html';
$mail->Body = $message;
$mail->AltBody = $message;

//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
