<?php

namespace App\Traits;

trait ControllerTrait
{
    protected $trait_model;

    protected static $static_trait_model;

    // change the names of methods 
    public function load_model($modelName, $data=[])
    {
        try {
            if(class_exists("\\App\Model\\" . $modelName)) {
            $modelName = "\\App\Model\\" . $modelName;

            $this->trait_model = new $modelName;

            } else {
                throw new Exception("Method load_model in trait hasn't found actual model class");
                   }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

    public function load_model_object($modelName, $data=[])
    {        
        try {
            if(class_exists("\\App\Model\\" . $modelName)) {
            $modelName = "\\App\Model\\" . $modelName;

            return $this->trait_model = new $modelName;

            } else {
                throw new Exception("Method load_model_by_trait in trait hasn't found actual model class");
                   }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

    public static function static_load_model($modelName, $data=[])
    {
        try {
            if(class_exists("\\App\Model\\" . $modelName)) {
            $modelName = "\\App\Model\\" . $modelName;

            self::$static_trait_model = new $modelName;

            } else {
                throw new Exception("Method static_load_model in trait hasn't found actual model class");
                   }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    public static function static_load_model_object($modelName, $data=[])
    {
        try {
            if(class_exists("\\App\Model\\" . $modelName)) {
            $modelName = "\\App\Model\\" . $modelName;

            return self::$static_trait_model = new $modelName;

            } else {
                throw new Exception("Method static_call_to_model in trait hasn't found actual model class");
                   }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

    

}