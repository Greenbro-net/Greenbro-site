<?php
session_start ();
if(isset($_POST["send"])){
    $from = htmlspecialchars ($_POST["from"]);
    $to = htmlspecialchars ($_POST["to"]);
    $subject = htmlspecialchars ($_POST["subject"]);
    $message = htmlspecialchars ($_POST["message"]);
    $_SESSION["from"] = $from;
    $_SESSION["to"]   = $to;
    $_SESSION["subject"] = $subject;
    $_SESSION["message"] = $message;

    $error_from ="";
    $error_to ="";
    $error_subject ="";
    $error_message ="";
    $error = false;

    if($from == "" || !preg_match ("/@/", $from)){
        $error_from = "Enter correct email";
        $error = true;
    }
    if($to =="" || !preg_match ("/@/", $to)){
        $error_to = "Enter correct email";
        $error = true;
    }
    
    if(strlen($subject) ==0){
        $error_subject = "Enter right topic name";
        $error = true;
    }
    if(strlen($message) ==0){
        $error_message = "Enter message";
        $error = true;
    }
    if(!$error) {
        $subject = "=?utf-8?B?".base64_encode($subject)."?=";
        $headers = "From: $from\r\nReply-to: $from\r\nContent-type:
        text/plain; charset=utf-8\r\n";
        mail ($to, $subject, $message, $headers);
        header ("Location: success.php");
        exit;
    }
}
?>
