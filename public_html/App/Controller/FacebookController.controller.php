<?php

namespace App\Controller;

use App\Core\Controller;

class FacebookController extends Controller
{
    use \App\Traits\FacebookTrait;

    // the method below create object of facebook
    private function grab_fb_object() 
    {
       return self::create_fb_object();
    }
    // the method below prepares access token for facebook
    private function get_token()
    {
         return $this->create_handler()->getAccessToken();
    }
    // the method below prepares handler
    private function create_handler()
    {
        return $this->grab_fb_object()->getRedirectLoginHelper();
    }

    // the method below calls to FB API
    public function fb_callback() 
    {
        try {
            // the code below oop version 
            $accessToken = $this->get_token();

        } catch (\Facebook\Exceptions\FacebookResponseException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        } catch (\Facebook\Exceptions\FacebookSDKException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }

            // the code below means operation wasn't successful
              if (!$accessToken) {
                  header('Location: https://greenbro.net/facebook/login');
                  exit();
              }
            // the code below means operation was successful, grab all the data
              $oAuth2Client = $this->grab_fb_object()->getOAuth2Client();
              if ($accessToken->isLongLived()) {
                  
                  $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
              
                  $response = $this->grab_fb_object()->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
                  $userData = $response->getGraphNode()->asArray();

                  $_SESSION['userData'] = $userData;
                  $_SESSION['access_token']  =  (string) $accessToken;
                  //   after success will redirect to main page 
                  header('Location: https://greenbro.net');
                  exit();
                }

    }
    // the method below call to FB API
    public function login()
    {    
            $handler = $this->grab_fb_object()->getRedirectLoginHelper();
            $redirectTo = 'https://greenbro.net/facebook/fb_callback';
            $data = ['email'];
            $fullURL = $handler->getLoginUrl($redirectTo,  $data);

            header("Location: $fullURL");
            exit();  
    }

}





