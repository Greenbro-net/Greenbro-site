<?php
require_once '../database_connection/database_connection.php';

session_start();

// prepare two values before checking values 
if(isset($_POST["visible"])) {
    $_POST["visible"] = 1;
}

if(isset($_POST['set_time'])) {
    $_POST['set_time'] = $date = date('Y/m/d H:i:s');
} else {
    $_POST['set_time'] = false;
}


// the code below doesn't work properly
// checking values in $_POST that it isn't empty
foreach ($_POST as $keys => $values) {
    var_dump($keys . "=>" .$values);
    echo "<br>";
    if(!isset($values) || $values == "") {
        header('Location: http://greenbro.com/admin/manage.php');
        exit;
    }
}

echo "<pre>";
var_dump($_POST);

// die;



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
    



// This code makes by PDO 
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






// TODO add all new parameters from $_FILES

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
// Display here information about last good which was added
echo "Товар був доданий успішно";
$result1  = $pdo->prepare('SELECT * FROM `products` WHERE id=:id');
$result1->execute(['id' => $id]);
$user1 = $result1->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($user1);


        }
        else{
            echo "You should check code, there are mistakes";
            die;
        }


























// This code creates and stores folders and images to the images
echo "<pre>";
var_dump($_FILES["fileMulti"]);

$target_dir = "../images/additional_images/";

if(isset($_FILES["main_image"]["name"]) && $_FILES["main_image"]["name"] != "") {
    // the loop below for adds main_image  values to fileMulti array 
    foreach($_FILES["fileMulti"] as $key => $value) {
    array_unshift($_FILES["fileMulti"][$key], $_FILES["main_image"][$key]);
    }
} else {
    echo "Sorry, come back and chose main image.";
    die;
}

// the code below adds images, after it's puting images in additional_images folder an names they
// in order like in folder from where they were download
// images with number 0 will be main image

// using foreach loop for each element of $_FILES array
foreach ($_FILES["fileMulti"]["name"] as $key => $error) {

    $target_file = $target_dir .basename($_FILES["fileMulti"]["name"][$key]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image of fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileMulti"]["tmp_name"][$key]);
        if($check !== false) {
            echo "File is an image - " . $check["mine"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileMulti"]["size"][$key] > 500000) {
        echo "Sorry, your file is to large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" &&
        $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if ($uploadOk != 0) {
            // code for changing image files names   
            $file_name = $_FILES["fileMulti"]["name"][$key];


            // the code below should create a forlder which will be name like it's id in DB
            //  future folder name 
            $dir_name = $id;
            if(!isset($result_mkdir)) {
                
              $result_mkdir =   mkdir("../images/additional_images/$dir_name", 0755);
            }
            
            
            // functions below were divided because of Only variables should be passed by reference
            $tmp = explode(".", $file_name);
            $ext = end($tmp);

            $name = $key. '.' . $ext;
            $path = "../images/additional_images/$dir_name/" . $name;

            if(move_uploaded_file($_FILES["fileMulti"]["tmp_name"][$key],
            $path)) {
                
              echo "The file ". basename($_FILES["fileMulti"]["name"][$key]). "
              has been uploaded.";
            }
    } else {
               echo "Sorry, there was an error uploading your file.";
           }
        }
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