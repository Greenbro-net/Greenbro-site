<?php
$host = 'greenbro.net';
$user = 'green64_one';
$password = '123456';
$dbName = 'green64_products';

$link = mysqli_connect($host, $user, $password, $dbName) or die($link->error);
mysqli_query($link, "SET NAMES `utf8`");