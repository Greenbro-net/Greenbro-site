<?php
require_once '../database_connection/database_connection.php';

session_start();


$name = trim($_REQUEST['name']);
$password = trim($_REQUEST['password']);




// This code make by PDO 
$pdo = new PDO('mysql:host=hosting26.ukrnames.com;dbname=green64_bro',
DATABASE_USERNAME, DATABASE_PASSWORD, array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sthComments = $pdo->query('SELECT * FROM `admin` ');
$comments = $sthComments->fetchAll(PDO::FETCH_ASSOC);



if($name===$comments['0']['name']  && password_verify($password, $comments['0']['password'])) {
    //  Redirect to page for manage
    header('Location: manage.php' );
    exit();
} else {
    echo "incorect admin name or password";
    die;
}




// This code for adding new users:
// $sth = $pdo->prepare('INSERT INTO `admin` VALUES (null, :name,  :password, null)');

// $data = [
//     'name' => $name,
//     'password' => password_hash($password, PASSWORD_BCRYPT)
// ];

//          //todo save to db
//         $sth->execute($data);
//         $id = $pdo->lastInsertId();   



?>

