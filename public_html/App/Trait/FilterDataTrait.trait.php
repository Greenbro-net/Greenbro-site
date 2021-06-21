<?php 

namespace App\Trait;

trait FilterDataTrait
{
    // the method below filter input data
    private function filter_data($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}