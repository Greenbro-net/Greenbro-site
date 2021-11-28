<?php

// TO DO Delete it 
namespace App\Controller;

use App\Core\Controller;

// the class below just gives us access to trait methods 
class WrapperController extends Controller
{
    use \App\Traits\ConfigSettingsTrait;

    public function some_function()
    {

    }
}