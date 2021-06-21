<?php

namespace App\Model;

use Exception;

class SliderModel
{
   // This method is invoked by the AJAX, displays images for slider   
   public function grab_images($folder_id)
   {
       try {
            if (empty($folder_id)) {
              throw new Exception("Method grab_images doesn't get parameter");
              }

            $filenameArray = [];

            $path = "images/item_images/$folder_id/";
            // the loop below goes throw all files in folder
            foreach(scandir($path) as $file) {
                if($file !== '.' && $file !== '..') {
                    array_push($filenameArray, "/images/item_images/$folder_id/$file");
                }
            }

            // the function below deletes the same values with array 
            array_unique($filenameArray);   

            echo json_encode($filenameArray);
           } catch (Exception $exception) {
               file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
               'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }
        
    }
}