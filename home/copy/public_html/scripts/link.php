<?php
$host = 'greenbro.net';
$user = 'green64';
$password = 'Q7wM1NnZ55Hh';
$dbName = 'green64_products';

$link = mysqli_connect($host, $user, $password, $dbName) or die($link->error);

// $link->query("set character_set_client='cp1251'");
// $link->query("set character_set_results='cp1251'");
// $link->query("set collation_connection='cp1251_general_ci'");
// $link->query("SET NAMES cp1251");

$link->query("set character_set_client='UTF-8'");
$link->query("set character_set_results='UTF-8'");
$link->query("set collation_connection='utf8_general_ci'");
$link->query("SET NAMES UTF-8");