<?php

namespace App\Model;

// use Exception;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;


class PHPMailerModel
{
   use \App\Trait\ConfigSettingsTrait;
 
   
   public function sent_letter($united_order)
   {    
     try {
        $mail = new PHPMailer(true);
        // Server settings
        // the option below allows us set debug information
        $mail->SMTPDebug = 0;
        $mail->IsSMTP();
        $mail->Host = $this->get_email_host();
        $mail->SMTPAuth = true;
        //Set your existing gmail address as user name
        $mail->Username = $this->get_email_user_name();
        //Set the password of your gmail address here
        $mail->Password = $this->get_email_password();
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; 

        // Recipients
        $mail->setFrom('order@greenbro.net');
        // addres of letters reciever 
        $mail->addAddress('greenbro.net@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New order';
        $mail->Body = "We have new order with number: . $united_order";
        
        
        if(!$mail->send()) {
         
          throw new Exception("Function sent_letter wasn't successful" . $mail->ErrorInfo);
                           } else {
                              // echo 'Email has been sent.';
                                  } 
    
         }  catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString()   . $mail->ErrorInfo);
                                         }
            
    }

}