<?php

class SliderModel
{
    
   public function grab_images($folder_id)
   {
       try {
            if (empty($folder_id)) {
              throw new Exception("Method grab_images doesn't get parameter");
              }
            // This file is invoked by the AJAX, displays images for slider   
            $filenameArray = [];

            // function opendir opens descriptor of catalog
            // function realpath returns absolute path to file 
            // function dirname returns name of parent catalog from specified path 

            $handle = opendir("images/item_images/$folder_id/");
            //   function readdir gets element of catalot by means of it's descriptor

            while(false !== ($file = readdir($handle))) {
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