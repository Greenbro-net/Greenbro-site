<?php

namespace App\Controller;

use App\Core\Controller;
use App\Controller\EraseUserDataController;

class  FbDataDeletionController extends Controller
{
    use \App\Trait\CryptoGrapherTrait;

    public function deletion() {
        // there are we call method from eraseuserdata Contrl 
    
        parse_signed_request($_REQUEST['signed_request']);
    }
    
}
// the code below checks signed_request 
if (!empty($_POST['signed_request'])) {
    $signed_request = $_POST['signed_request'];
    $data = parse_signed_request($signed_request);
    $user_id = $data['user_id'];


    // Start data deletion
    $code = CryptoGrapherTrait::hashed($user_id);

    $confirmation_code = 'abc123'; // unique code for the deletion request
    $status_url = "https://greenbro.net/fbdatadeletion/deletion?user_id=$code"; //  Url to track the deletion (you can find out status of deletion)


    $data = array(
        'url' => $status_url,
        'confirmation_code' => $code
    );

}



function parse_signed_request($signed_request) {
    // list - Assign variables as if they were an array
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    $secret = "f86ca7c41c8856599712ebca3b7c2baf"; // Use your app  secret here

    //decode the data
    $sig = base64_url_decode($encoded_sig);
    $data = json_decode(base64_url_decode($payload), true);

    //confirm  the signature
    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
    if ($sig !== $expected_sig) {
        error_log('Bad  Signed JSON signature!');
        return  null;
    }

    
      // what we should do in success case
      // we pass parameter in erase_fb_data from FB SDK
      $eraseuserdata_object = new EraseUserDataController();

      $eraseuserdata_object->erase_fb_data($data['user_id']);
    
    
    return $data;
}

function base64_url_decode($input) {
    // base64_decode - Decodes data encoded with MIME base64
    // strtr - Translate characters or replace substrings
    return base64_decode(strtr($input, '-_', '+/'));
}


 




