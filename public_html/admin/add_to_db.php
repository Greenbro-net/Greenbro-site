<?php
// die;
require_once '../database_connection/database_connection.php';
var_dump($_POST);

session_start();



if(isset($_POST['set_time'])) {
    $_POST['set_time'] = $date = date('Y/m/d H:i:s');
} else {
    $_POST['set_time'] = false;
}


// Preparing variable to insert in DB
$products_name = trim($_POST['products_name']);
$brand_name = trim($_POST['brand_name']);
$category_of_products = trim(reset($_POST['category_of_products']));
$mini_description = trim($_POST['mini_description']);
$description = trim($_POST['description']);
$upload_image = trim($_POST['upload_image']);
$set_price = trim($_POST['set_price']);
$sale = trim($_POST['sale']);
$quantity = trim($_POST['quantity']);
$datetime = trim($_POST['set_time']);
$visible = trim($_POST['visible']);


// Checking data from manage.php that it is not null
if(isset($products_name,
       $upload_image,$_POST['category_of_products'] ) ) 
{
    echo "You send all inforrmation what you have to send <br>";
} else {
    echo "Check information which you are going to add to DB" ;
    die;
}


// // Start query
$select_sql = "SELECT name FROM `products`  "; 


                          $select_result = mysqli_query($link1, $select_sql)
                          or die(mysqli_error($link1));                                
// var_dump($select_result);
                  $array_1 = mysqli_fetch_fields($select_result);
    
$yourArray = array();
$index = 0;
while($row = mysqli_fetch_assoc($select_result)){
    $yourArray[$index] = $row;
    $index++;
}

// searching the same name of products
foreach ($yourArray as $array) {
    foreach($array as $value){
        
        if($value==$products_name ){
            
            echo "You already have the same name of products"; 
            die;
        }  
    }
}
    



// This code make by PDO 
$pdo = new PDO('mysql:host=hosting26.ukrnames.com;dbname=green64_products',
DATABASE_USERNAME, DATABASE_PASSWORD, array(
    PDO::ATTR_PERSISTENT => true, 
// This thing below very important and set right endoding
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// $sthComments = $pdo->query('SELECT * FROM registration ORDER BY user_id DESC');
// $comments = $sthComments->fetchAll(PDO::FETCH_ASSOC);
// var_dump($comments);

$sth = $pdo->prepare('INSERT INTO `products` VALUES (`id`, :name, :brand, :category_id, :mini_description, :description, :image,
                                                     :price, :sale, :quantity, :datetime, :visible)');


$data_products = [
    'name' => $products_name,
    'brand' => $brand_name,
    'category_id' => $category_of_products,
    'mini_description' => $mini_description,
    'description' => $description,
    'image' => $upload_image,
    'price' => $set_price,
    'sale' => $sale,
    'quantity' => $quantity, 
    'datetime' => $datetime,
    'visible'  => $visible,
];


         if( $sth->execute($data_products)) {
            $id = $pdo->lastInsertId();   



             echo "<div class=\"product-price\">грн".$row["price"];
             echo "<div class=\"product-price\"> ".$row["price"] . "грн";
 

echo "Товар був доданий успішно";
        }
        else{
            echo "You should check code, there are mistakes";
            die;
        }

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
        
        //   printf ("ID новой записи: %d.\n", mysqli_insert_id($link));

// header("Location: success.php?user_id=" . $id);
// exit();
?>
<a href="manage.php">Go to previous page</a>