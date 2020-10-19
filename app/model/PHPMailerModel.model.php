<?php

class PHPMailerModel 
{
// testing function below for sending email letter after successful customer order 
   public function sent_letter($united_order)
   {
     try {
        // require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
        // require '/usr/share/php/libphp-phpmailer/class.smtp.php';

        // the relative paths below work fine
        require_once  LIBRARY . '/libphp-phpmailer/class.phpmailer.php';
        require_once  LIBRARY . '/libphp-phpmailer/class.smtp.php';
        $mail = new PHPMailer;
        $mail->setFrom('admin@example.com');
        // addres of letters reciever 
        $mail->addAddress('greenbro.net@gmail.com');
        $mail->Subject = 'New order';
        $mail->Body = "We have new order with number: . $united_order";
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        
        //Set your existing gmail address as user name
        $mail->Username = 'sergey25prihodko@gmail.com';
        //Set the password of your gmail address here
        $mail->Password = '123456gogl';
        if(!$mail->send()) {
          echo 'Email error: ' . $mail->ErrorInfo;
          throw new Exception("Function sent_letter wasn't successful");
                           } else {
                              echo 'Email has been sent.';
                                  } 
    
         }  catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString()   . $mail->ErrorInfo);
                                         }
    }

}