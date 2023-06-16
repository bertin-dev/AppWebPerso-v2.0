<?php

/**

 * Created by PhpStorm.

 * User: Supers-Pipo

 * Date: 11/04/2019

 * Time: 14h21

 */



namespace App\PHPMailer;



require  '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



class Send_Email

{

    public static function envoi($getmail, $getauthor_email = '', $getsujet = '', $getmsg = '', $contentPDF = '', $namePDF =''){



// Instantiation and passing `true` enables exceptions

        $mail = new PHPMailer(true);



        try {

            //Server settings

            $mail->SMTPDebug = 0;                                       // Enable verbose debug output mettre à 2 pour debugger

            $mail->isSMTP();                                            // Set mailer to use SMTP

            $mail->Host       = 'mail.bertin-mounok.com';  // Specify main and backup SMTP servers

            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

            $mail->Username   = '_mainaccount@bertin-mounok.com';                     // SMTP username

            $mail->Password   = 'Mh_0tmKN';                               // SMTP password

            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted

            $mail->Port       = 465;                                    // TCP port to connect to



            //Recipients

            $mail->setFrom('ne-pas-repondre@bertin-mounok.com', ' '.date("Y", time()).', bertin.dev, Inc.');

            $mail->addAddress($getmail, $getauthor_email);     // Add a recipient

            //$mail->addAddress('ellen@example.com');               // Name is optional

            //$mail->addReplyTo('info@example.com', 'Information');

            //$mail->addCC('cc@example.com');

            //$mail->addBCC('bcc@example.com');



            // Attachments

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name



            if($contentPDF != '') {

                $mail->AddStringAttachment($contentPDF, $namePDF, 'base64', 'application/pdf');

            }



            // Content

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = utf8_decode($getsujet);

            $mail->Body    = utf8_decode($getmsg);

            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



            $mail->send();

            return 'success';

        } catch (Exception $e) {

            return "Une erreur est survenue lors de l'envoi du mail d'activation. Veuillez contacter l'administrateur afin d'activer votre compte<br/>: {$mail->ErrorInfo}";

        }

    }



}