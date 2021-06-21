<?php

namespace App\Trait;

use Exception;

trait ConfigSettingsTrait 
{

    use \App\Trait\ControllerTrait;

    protected $domen_part;
    protected $url;
    protected $email_password;
    protected $email_host;
    protected $email_user_name;
    
    
    
    // the method below gets url from object
    public function get_url()
    {
       return (string)$this->get_setting()->url;
    }
    // the method below gets domen part from object
    public function get_domen_part()
    {
       return (string)$this->get_setting()->domen_part;
    }

    // the method below gets email password from object
    public function get_email_password()
    {
        return (string)$this->get_setting_without_parent()->email_password;
    }
    // the method beow gets host name for PHPMailer
    public function get_email_host()
    {
        return (string)$this->get_setting_without_parent()->email_host;
    }
    // the method below gets email user name for PHPMailer
    public function get_email_user_name()
    {
        return (string)$this->get_setting_without_parent()->email_user_name;
    }

    // the method below can't be move to modelTrait it causes error
    private function get_setting()
    {
        parent::model('ConfigSettingsModel');
        $url_model = new  \App\Model\ConfigSettingsModel;
        return $object = $url_model->get_json();
    }
    // the method below can't be move to modelTrait it causes error
    private function get_setting_without_parent()
    {
        // $this->load_model_config('ConfigSettingsModel');
        $url_model = $this->load_model_by_trait('ConfigSettingsModel');
        // $url_model = new  \App\Model\ConfigSettingsModel;
        return $object = $url_model->get_json();
    }
    
    // the method below can't be move to modelTrait it causes error
    private function load_model_config($modelName, $data=[])
    {
        try {
            if(class_exists("\\App\Model\\" . $modelName)) {
            $modelName = "\\App\Model\\" . $modelName;

            $this->trait_model = new $modelName;
            } else {
                throw new Exception("Method load_model_config hasn't found actual model class");
                   }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

}