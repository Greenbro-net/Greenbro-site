<?php

namespace App\Controller;

use App\Core\Controller;

// the class below just gives us access to trait methods 
class WrapperController extends Controller
{
    use \App\Trait\ConfigSettingsTrait;

    public function some_function()
    {

    }
}