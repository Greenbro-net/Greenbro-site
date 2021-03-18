<?php
// The code below has to be reedit to MVC pattern and will call throw url(by controller)
// This file is invoked by the AJAX, displays images for slider   
$id = $_POST['$id'];
$filenameArray = [];

// function opendir opens descriptor of catalog

// function realpath returns absolute path to file 

// function dirname returns name of parent catalog from specified path 


$handle = opendir(dirname(realpath(__FILE__))."/../images/item_images/$id/");
//   function readdir gets element of catalot by means of it's descriptor
  while(false !== ($file = readdir($handle))) {
       if($file !== '.' && $file !== '..') {
           array_push($filenameArray, "../images/item_images/$id/$file");
       }

   }

// the function below deletes the same values with array 
   array_unique($filenameArray);   

echo json_encode($filenameArray);

