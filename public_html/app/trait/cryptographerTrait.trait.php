<?php
trait cryptographerTrait
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
}