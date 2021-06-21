<?php

namespace App\Controller;

use App\Core\Controller;
//object of FB we can create only in one file, that why this controller is in gitignore
class FacebookController extends Controller
{
    // the method below create object of facebook
    private function create_fb_object() 
    {
       return $facebook = new \Facebook\Facebook([
               'app_id' => '884265225709842',
               'app_secret' => 'f86ca7c41c8856599712ebca3b7c2baf',
               'default_graph_version' => 'v9.0'
            ]);
    }
    // the method below prepares access token for facebook
    private function get_token()
    {
         return $this->create_handler()->getAccessToken();
    }
    // the method below prepares handler
    private function create_handler()
    {
        return $this->create_fb_object()->getRedirectLoginHelper();
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
              $oAuth2Client = $this->create_fb_object()->getOAuth2Client();
              if ($accessToken->isLongLived()) {
                  
                  $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
              
                  $response = $this->create_fb_object()->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
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
            $handler = $this->create_fb_object()->getRedirectLoginHelper();
            $redirectTo = 'https://greenbro.net/facebook/fb_callback';
            $data = ['email'];
            $fullURL = $handler->getLoginUrl($redirectTo,  $data);

            header("Location: $fullURL");
            exit();  
    }

}





