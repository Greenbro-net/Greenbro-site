<?php

function callAPI($method, $url, $data) 
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;   
            }
    }
    // OPTIONS
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'APIKEY: 1111111111111111111',
        'Content-Type:  application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //  EXECUTE:
    $result = curl_exec($curl);
    if (!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
}