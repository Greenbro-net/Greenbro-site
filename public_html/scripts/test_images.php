<?php
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
            $dir_name = 2;
            mkdir("../images/additional_images/$dir_name", 0755);

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
?>