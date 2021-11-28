<?php

namespace App\Traits;

use Facebook\Facebook;

trait FacebookTrait
{
    public static function create_fb_object(): Facebook
    {
        return $facebook = new \Facebook\Facebook([
            'app_id' => APP_ID,
            'app_secret' => APP_SECRET,
            'default_graph_version' => DEFAULT_GRAPH_VERSION
            ]);
    }
}