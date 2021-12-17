<?php


namespace App\Model;


use Exception;


class ConfigSettingsModel
{
    // the code below for get and set url settings
    public function get_json()
    {
        try {
            $object = file_get_contents("config_settings.json");
            $json_object = json_decode($object);

            if (empty($json_object)) {
                throw new Exception("Method get_json has returned empty value");
            } else {
                return $json_object;
            }
        
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }
     
}