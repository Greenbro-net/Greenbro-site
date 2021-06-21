<?php

namespace App\Trait;

trait ValidationTrait
{
    // the method below filter input data
    private function filter_data_validation_trait($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // the method below set user id
    protected function set_user_id()
    {   
        if (!empty($_SESSION["user_id"])) {
            $user_id = $this->user_id  = $this->filter_data_validation_trait($_SESSION["user_id"]);
             }
    }
    // the method below get user_id
    protected function  get_user_id()
    {
        $this->set_user_id();
        return $this->user_id;
    }
}