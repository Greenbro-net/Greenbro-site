<?php


namespace App\Model;


class DeletionModel
{
    public $deletion_code;

    private function set_deletion_code()
    {
        $this->deletion_code = trim($_GET['code']);
    }


    public function get_deletion_code()
    {
        $this->set_deletion_code();
        return $deletion_code = $this->deletion_code;
    }
    
}