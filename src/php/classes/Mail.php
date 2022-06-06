<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';
require_once 'Connection.php';

class Mail {
    private string $subject;
    private string $htmlMessage;
    private string $textAlternativeMessage;
    public string $error;

    public function __construct(string $subject = "", string $htmlMessage = "", string $textAlternativeMessage = "") {
        $this->subject = $subject;
        $this->htmlMessage = $htmlMessage;
        $this->textAlternativeMessage = $textAlternativeMessage;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getHtmlMessage() {
        return $this->htmlMessage;
    }

    public function getTextAlternativeMessage() {
        return $this->textAlternativeMessage;
    }

    public function setSubject(string $subject) {
        $this->subject = $subject;
    }

    public function setHtmlMessage(string $htmlMessage) {
        $this->htmlMessage = $htmlMessage;
    }

    public function setTextAlternativeMessage(string $textAlternativeMessage) {
        $this->textAlternativeMessage = $textAlternativeMessage;
    }


    public function __toString() {
        $string = "";
        $string .= "MAIL: <br>";
        $string .= "Asunto: " . $this->getSubject();
        $string .= "Mensaje HTML: " . $this->getHtmlMessage();
        $string .= "Mensaje de texto alternativo: " . $this->getTextAlternativeMessage();
    }

    public function send(string $recipientEmail, string $recipientName) {
        $mail = new PHPMailer;

        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->isHTML(true);
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Username = 'testmailer918@gmail.com';
        $mail->Password = 'TestMailer918.';


        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;   


        $mail->setFrom('admin@admin.com', 'test');
        $mail->addReplyTo('rawrcesar13@gmail.com', 'test');

        //Destinatario
        $mail->addAddress($recipientEmail, $recipientName);

        //mail
        $mail->Subject = $this->getSubject();
        $mail->Body = $this->getHtmlMessage();
        $mail->AltBody = $this->getTextAlternativeMessage();

        // Comentado para evitar spam en pruebas 
        // 
        $result = true;
        $result = $mail->send();
        if (!$result) {
            $this->error = $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
        return true;
    }

}