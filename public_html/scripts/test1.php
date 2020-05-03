<?php

if(isset($_POST["upload_image"])) 
{
    if($_FILES["image_file"]["name"] != '') //{check file selected or not
        {
          $allowed_ext = array("jpg", "png", "jpeg");
          $ext = end(explode(".", $_FILES["image_file"]["name"])); // get uploaded file ext
          if(in_array($ext, $allowed_ext))//check for valid extension
          {
              if($_FILES["image_file"]["size"]<5000) // check image size 5000 means 500 kb
              {
                   $name = md5(rand()) . '.' . $ext; //rename image file
                   $path = "../images/additional_images/" . $name;// image upload path
                   move_uploaded_file($_FILES["image_file"]["tmp_name"], $path);
                   header("location:test1.php?file-name=".$name."");
              }
          }
          else
          {
            echo '<script>alert("Invalid Image file")</script>';
          }
        }
        else
        {
            echo '<script> alert("Please select file")</script>';
        }

}
?>



<html lang="en">
<head>
   <title>How to rename uploaded image in php with image upload validation</title>

</head>
<body>
    <div align="center">
   <h1>How to rename uploaded image in php with image upload validation</h1>

<form action="" method="POST" enctype="multipart/form-data">
 
 <input type="file" name="image_file" />
 <input name="upload_image" type="submit" value="Upload Image" />
 

 </form>
 <?php
 if(isset($_GET["file-name"]))
 {
     echo 'Image uploaded successfully<br /><br />';
     echo '<img src="../images/additional_images/'.$_GET["file-name"].'" />';
 }
 ?>
  </div>
</body>
</html>

