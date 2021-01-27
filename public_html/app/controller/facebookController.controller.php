<?php


class FacebookController extends Controller
{
    
    // the method below create object of facebook
    private function create_fb_object() 
    {
        // the array below for Facebook app 
        return $facebook = new \Facebook\Facebook([
        'app_id' => '884265225709842',
        'app_secret' => '88a78eda35cbb12323f383fdd7eac19e',
        'default_graph_version' => 'v9.0'
        ]);
    }
    // the method below prepares access token for facebook
    private function prepare_token()
    {
         return $this->create_handler()->getAccessToken();
    }
    // the method below prepares handler
    private function create_handler()
    {
        return $this->create_fb_object()->getRedirectLoginHelper();
    }


    // testing function below 
    public function callback() 
    {
        try {
            // $handler = $facebook->getRedirectLoginHelper();
            $accessToken = $this->prepare_token();

        } catch (\Facebook\Exceptions\FacebookResponseException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        } catch (\Facebook\Exceptions\FacebookSDKException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }

            // the code below means operation wasn't successful
              if ($accessToken) {
                  header('Location: https://greenbro.net/facebook/login');
                  exit();
              }
            // the code below means operation was successful
              $oAuth2Client = $this->create_fb_object()->getOAuth2Client();
              if (!$accessToken->isLongLived()) {
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

    public function login()
    {    
        $handler = $this->create_handler();

        $redirectTo = 'https://greenbro.net/facebook/callback';
        $data = ['email'];
        $fullURL = $handler->getLoginUrl($redirectTo,  $data);
        // header('Content-Type: $fullURL');
        // echo $fullURL;
    }
}
// die;
// header('Content-Type: application/json');

// $signed_request = $_POST['signed_request'];
// $data = parse_signed_request($signed_request);
// $user_id = $data['user_id'];

// // Start data deletion

// $status_url = "http://greenbro.com/facebook/deletion?id=abc123";// URL to track the deletion
// $confirmation_code ="abc123"; // unique code for te deletion request

// $data = array(
//     'url' => $status_url,
//     'confirmation_code' => $confirmation_code
// );
// echo json_encode($data);

// function parse_signed_request($signed_request){
// // the list() functions is used to assign values to a list of variables in one operation 
//     list($encoded_sig, $payload) = explode('.', $signed_request, 2);

//     $secret = "appsecret"; // Use your app secret here

//     // decode the data
//     $sig = base64_url_decode($encoded_sig);
//     $data = json_encode(base_url_decode($payload), true);

//     // confirm the signature
//     $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
//     if ($sig !== $expected_sig) {
//         error_log('Bad Signed JSON signature!');
//         return null;
//     }

//     return $data;
// }

// function base64_url_decode($input) {
//     return base64_url_decode(strtr($input, '-_', '+/'));
// }

// we should have JSON object 
// {
//     "algorithm": "HMAC-SHA256",
//     "expires":  1291840400,
//     "issued_at": 129836800,
//     "user_id": "218471"
// }