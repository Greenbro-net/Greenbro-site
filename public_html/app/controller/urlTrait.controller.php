<?php
trait urlTrait 
{
    protected $domen_part;
    protected $url;
    
    private function get_setting()
    {
        parent::model('UrlModel');
        $url_model = new  UrlModel;
        return $object = $url_model->get_json();
    }
    
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

}