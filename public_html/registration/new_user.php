<?php
require_once '../database_connection/database_connection.php';

session_start();



// foreach($_POST as $value){
//     echo "$value <br />";
// }

$name = trim($_REQUEST['name']);
$mail = trim($_REQUEST['mail']);
$password = trim($_REQUEST['password']);
$two = trim($_REQUEST['two']);

// Checking data from registration.php that it is not null
if(!isset($name, $mail, $password))
{
    header( 'Location: registration.php');
    exit();
}


// Array for success and fail messages
$_SESSION=array("success"=>"Реєстрація пройшла успішно",
                 "fail_name"=>"Введіть інше ім'я",
                 "fail_mail"=>"Змініть адресу електронної пошти",
                 "fail_password"=>"Ви не вірно підтвердили пароль, спробуйте знову",
                 "message_name"=>"",
                 "message_mail"=>"",
                 "message_password"=>""
                );

//    Checking password             
    if($password !== $two){
    $_SESSION['message_password']= $_SESSION['fail_password'];
        header('Location: unsuccesfull.php'); 
    die;
}



// TO DO password_verify

// // Start query
$select_sql = "SELECT name, mail FROM registration   "; 

                          $select_result = mysqli_query($link, $select_sql)
                          or die(mysqli_error($link));                                
// var_dump($select_result);
                  $array_1 = mysqli_fetch_fields($select_result);
$yourArray = array();
$index = 0;
while($row = mysqli_fetch_assoc($select_result)){
    $yourArray[$index] = $row;
    $index++;
}

// searching the same name
foreach ($yourArray as $array) {
    foreach($array as $value){
        if($value==$name ){
            $_SESSION['message_name']= $_SESSION['fail_name'];
            header('Location: unsuccesfull.php');  
            die;
        }  
    }
}
    foreach ($yourArray as $array) {
        foreach($array as $value){
            if($value==$mail){
                $_SESSION['message_mail']= $_SESSION['fail_mail'];
                header('Location: unsuccesfull.php');  
                die;
        }  
    }  
}      


// This code make by PDO 
$pdo = new PDO('mysql:host=hosting26.ukrnames.com;dbname=green64_bro',
DATABASE_USERNAME, DATABASE_PASSWORD, array(PDO::ATTR_PERSISTENT => true));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sthComments = $pdo->query('SELECT * FROM registration ORDER BY user_id DESC');
$comments = $sthComments->fetchAll(PDO::FETCH_ASSOC);
// var_dump($comments);

$sth = $pdo->prepare('INSERT INTO registration VALUES (null, :name, :mail, :password)');

$data = [
    'name' => $name,
    'mail' => $mail,
    'password' => password_hash($password, PASSWORD_BCRYPT)
];
//  if ($request->isPost())
//  {
//      if($form->isValid()){
//          //todo save to db
         $sth->execute($data
            
            );
            $id = $pdo->lastInsertId();   
// } 
//  }





// This code below for query to db
// $insert_sql2 =  sprintf("INSERT INTO registration " . "(  name, mail, password) " . 
//                                      "VALUES ( '%s', '%s', '%s');",
//                                      mysqli_real_escape_string($link, $name),
//                                      mysqli_real_escape_string($link, $mail),
//                                      mysqli_real_escape_string($link, crypt($password, $name)));   
                                               

//           $select = "SELECT * FROM users";
                         
//           mysqli_query($link, $insert_sql2)
//            or die(mysqli_error($link));
         
//           if(!isset($_POST)){
//             //   echo"array_POST without values";
//               die("array_POST without values");
//           }$order_id = $link->lastInsertId(); 
        
        // echo "Hello";
        // die;
        
        // error_reporting(E_ALL);
        
        //   printf ("ID новой записи: %d.\n", mysqli_insert_id($link));
header("Location: success.php?user_id=" . $id);
exit();
?>

