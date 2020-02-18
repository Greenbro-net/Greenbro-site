<?php
require_once('../scripts/link.php');

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : null;

if(isset($id) && isset($quantity)) $link->query("UPDATE `products` SET `quantity` = '".$quantity."' WHERE `id` =".$id);