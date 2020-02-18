<?php
session_start();

// this code below for captcha
if ($_POST['submit']) {
    if($_POST['submit'] && (!preg_match("/^[Іа-яА-ЯёЁa-zA-Z0-9і]+$/",$_POST['contact_textarea'])) ) {
        check_in1();
        header('Location: contact.php' );
        die;
    }
    
    if( !$_POST['g-recaptcha-response'] && $_POST['submit'])  {
    check_in();
    header('Location: contact.php' );
    // exit('Do captcha');
    die;
    }
}

// this function for show message if not correct data in form
function check_in(){
        $_SESSION['contact'] = 65;
        $contact_num = 1;
        ++$contact_num; 
        $_SESSION['contact_num'] = $contact_num;
        $_SESSION['contact_num'];
  }   
  // this function for show message if not correct symbols in textarea
function check_in1(){
        $_SESSION['contact'] = 66;
        $contact_num = 1;
        ++$contact_num; 
        $_SESSION['contact_num'] = $contact_num;
        $_SESSION['contact_num'];
  }   
  
  
  
  

    // Code for captcha
    $secret_key = '6LeKAbIUAAAAAFKQUYwZf_sOytnhQc7PDGLFG9VS';
    $response = $_POST['g-recaptcha-response'];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $dav = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="
    .$secret_key."&response=".$response."&remoteip=".$ip);
    $res = json_decode($dav,true);
    
    if($res['success']) {
        
        // This code is for sending email-letters
$_POST['contact_name'] = trim($_POST['contact_name']);
$_POST['contact_email'] = trim($_POST['contact_email']);
$_POST['contact_textarea'] = trim($_POST['contact_textarea']);

       // This is for delete html things for post request

$_POST['contact_name'] = htmlspecialchars($_POST['contact_name']);
$_POST['contact_email'] = htmlspecialchars($_POST['contact_email']);
$_POST['contact_textarea'] = htmlspecialchars($_POST['contact_textarea']);


if(isset($_POST['submit'])) {
    // chech that our fields is not empty
    if(!isset($_POST['contact_name']) || $_POST['contact_name'] =='' ||
       !isset($_POST['contact_email'])|| $_POST['contact_email'] =='' ||
       !isset($_POST['contact_textarea']) || $_POST['contact_textarea'] =='')
    {   
        // This is for checking
        // echo "mistake is here";
        check_in();
        header('Location: contact.php' );
        exit();
    } 


// checking email it is right or not
$email = $_POST['contact_email'];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

if (!isset($email) || $email == '') {
    header('Location: contact.php' );
    die;
} else {
    $subject = $_POST['contact_name'];
    $message = $_POST['contact_textarea'];
    $headers = 'From:'. $email2 . "\r\n"; 
    $headers .= 'Cc:'. $email2. "\r\n";
    
    //If text bigger than 70 symbols makes a move
    $message = wordwrap($message, 70);

    //Sent an email by this function
    if($result=mail('greenbro.net@gmail.com', $subject, $message)) {
                // echo "Your letter was send";
        
        header('Location: ../messages/success_contact.php' );
    } else {
        // This code when message was not send
        header('Location: contact.php' );
        die;
       }
     }
  }
}
?>
