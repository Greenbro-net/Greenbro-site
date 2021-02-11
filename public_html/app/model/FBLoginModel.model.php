<?php

class FBLoginModel
{
    public function do() 
    {
        try {
   
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString()   . $mail->ErrorInfo);
                                       }
    }
    
}

