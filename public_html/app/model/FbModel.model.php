<?php

class FbModel 
{
    public function grab_fb_object() 
    {
        try {
             $result_grab_fb = require_once '../fb_config.php';
             if (empty($result_grab_fb)) {
                 throw new Exception("FB config file wasn't require");
             } 
             elseif (!empty($facebook)) {
                 return $facebook;
                }
   
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString()   . $mail->ErrorInfo);
                                       }
    }
    
}