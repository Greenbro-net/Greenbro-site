<?php
session_start();
require_once 'config.php';
  
        try {

          $accessToken = $handler->getAccessToken();

        } catch (\Facebook\Exceptions\FacebookResponseException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        } catch (\Facebook\Exceptions\FacebookSDKException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }

            // the code below means operation wasn't successful
              if (!$accessToken) {
                  header('Location: https://greenbro.net/scripts/facebook/login.php');
                  exit();
              }
            // the code below means operation was successful, grab all the data
              $oAuth2Client = $facebook->getOAuth2Client();
              if ($accessToken->isLongLived()) 
                  $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
              
                  $response = $facebook->get("/me?fields=id,email,last_name,first_name", $accessToken);
                  $userData = $response->getGraphNode()->asArray();

                  $_SESSION['userData'] = $userData;
                  $_SESSION['access_token']  =  (string) $accessToken;
                //   after success will redirect to main page 
                  header('Location: https://greenbro.net/scripts/facebook/index.php');
                  exit();
                
