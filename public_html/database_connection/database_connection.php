<?php
require_once 'app_config.php';
$link = mysqli_connect(DATABASE_HOST,DATABASE_USERNAME, DATABASE_PASSWORD)
or die("<p>Mistake of connect with database: " .
   mysqli_error() . "</p>");
   
   //  This string below set a correct encoding
  //  it was changed 
         mysqli_query($link, "SET NAMES `utf8`");


mysqli_select_db($link, DATABASE_NAME)
  or die("<p>Mistake with connection to database " . DATABASE_NAME .
      mysqli_error($link) . "</p>");




// This code for query to DB with products
$link1 = mysqli_connect(DATABASE_HOST,DATABASE_USERNAME, DATABASE_PASSWORD)
      or die("<p>Mistake of connect with database: " .
         mysqli_error() . "</p>");

        //  This string below set a correct encoding
        
        //  mysqli_query($link1, "SET NAMES `utf8`");
         mysqli_set_charset($link1, 'utf8');
        
           
mysqli_select_db($link1, DATABASE_NAME1)
        or die("<p>Mistake with connection to database  from 21" . DATABASE_NAME1 .
            mysqli_error($link1) . "</p>");



?>