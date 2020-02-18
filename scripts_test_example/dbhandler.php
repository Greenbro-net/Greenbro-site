<?php
require_once('link.php');

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : null;

if(isset($id) ?? isset($quantity)) $ling->query("INSERT INTO `products` (`id`, `name`, `brand`, `brand_id`, `mini_description`, `description`, `image`, `price`, `sale`, `quantity`, `datetime`, `visible`) VALUES (NULL, 'test', 'test', '11', 'test', 'test', 'oil.jpg', '10', NULL, '10', current_timestamp(), '1')");
//$link->query("UPDATE `products` SET `quantity` = '".$quantity."' WHERE `id` =".$id);
return json_encode("hello");

//$ling->query("INSERT INTO `products` (`id`, `name`, `brand`, `brand_id`, `mini_description`, `description`, `image`, `price`, `sale`, `quantity`, `datetime`, `visible`) VALUES (NULL, 'test', 'test', '11', 'test', 'test', 'oil.jpg', '10', NULL, '10', current_timestamp(), '1')");