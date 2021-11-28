<?php

namespace App\Traits;

trait CryptoGrapherTrait
{
    protected $integer;
    //the method below hashes user_id into alphanumeric string
    public static function hashed($integer) 
    {
        return  base_convert($integer, 10,36);
    }
    //the method below inverse hashes user_id into numeric string
    private static function inverse_hashed($integer) 
    {
        return  base_convert($integer, 36, 10);
    }

    // the code below returns hashed user_id for ajax function 
    public static function display_user_data()
    {
        if (!empty($_SESSION['user_id'])) {
            return self::hashed($_SESSION['user_id']);
        } else {
          if (!empty($_SESSION['userData']['id'])) {
            return self::hashed($_SESSION['userData']['id']);
            }
        }
    }
}