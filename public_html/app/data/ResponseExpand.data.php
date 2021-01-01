<?php

// if we don't need that class in the future we have to delete it

// this class we use for expanding use method model in other classes 
class ResponseExpand extends DBController
{
    public function getResponses()
    {
        try {
        $sql = "SELECT * FROM response";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result_getResponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($result_getResponses)) {
            throw new Exception("Function getResponses wasn't successful");
                 } else {
                    return $result_getResponses;
                        }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
}