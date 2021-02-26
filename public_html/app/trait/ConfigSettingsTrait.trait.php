<?php

trait ConfigSettingsTrait 
{
    use controllerTrait;
    use modelTrait;

    protected $domen_part;
    protected $url;
    protected $email_password;
    
    
    
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

}