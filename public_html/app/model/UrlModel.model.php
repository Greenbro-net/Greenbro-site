<?php

class UrlModel
{
     // the code below for get and set url settings
     public function get_json()
     {
       $object = file_get_contents("url_settings.json");
       $json_object = json_decode($object);
       return $json_object;
     }
}