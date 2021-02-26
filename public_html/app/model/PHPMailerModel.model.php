<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

class PHPMailerModel
{
   use ConfigSettingsTrait;
   // TO DO create method for grabing config from config_settings.json 
 

// testing function below for sending email letter after successful customer order 
   public function sent_letter($united_order)
   {    
       
        $mail = new PHPMailer(true);
     try {
       
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        //Set your existing gmail address as user name
        $mail->Username = 'sergey25prihodko@gmail.com';
        //Set the password of your gmail address here
        $mail->Password = $this->get_email_password();
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; 

        // Recipients
        $mail->setFrom('admin@example.com');
        // addres of letters reciever 
        $mail->addAddress('greenbro.net@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New order';
        $mail->Body = "We have new order with number: . $united_order";
        
        
        if(!$mail->send()) {
          echo 'Email error: ' . $mail->ErrorInfo;
          throw new Exception("Function sent_letter wasn't successful" . $mail->ErrorInfo);
                           } else {
                              echo 'Email has been sent.';
                                  } 
    
         }  catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString()   . $mail->ErrorInfo);
                                         }
    }

}