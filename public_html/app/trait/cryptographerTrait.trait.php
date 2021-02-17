<?php
trait cryptographerTrait
{
    protected $integer;
    //the method below hashes user_id into alphanumeric string
    public static function hashed($integer) 
    {
        return  base_convert($integer, 10,36);
    }
}