<?php
require_once('../database_connection/link.php');
// $_POST["id"] =100;

$id = isset($_POST["id"]) ? $_POST["id"] : null;

if(isset($id)) {
    $response = $link->query("SELECT * FROM `products` WHERE `id` = $id");

    if($response->num_rows > 0) {
        $arr = [];
        $i = 0;
        $row = $response->fetch_assoc();
        do {         
        $arr[$i] = $row;
        $i++;
        } while( $row = $response->fetch_assoc());
    }
    echo json_encode($arr);
    exit;
}
else echo json_encode("We have mistake with goods card");

exit;


