<?php

trait ConfigSettingsTrait 
{

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
        $url_model = new  ConfigSettingsModel;
        return $object = $url_model->get_json();
    }
    // the method below can't be move to modelTrait it causes error
    private function get_setting_without_parent()
    {
        $this->load_model_config('ConfigSettingsModel');
        $url_model = new  ConfigSettingsModel;
        return $object = $url_model->get_json();
    }
    // the method below can't be move to modelTrait it causes error
    private function load_model_config($modelName, $data=[])
    {
        if(file_exists(MODEL . $modelName . '.model.php'))
        {
            // there are we were changed require to require_once for escaping Error from model which load a few times
            require_once MODEL . $modelName . '.model.php';
            $this->trait_model = new $modelName;
        }
    }

}