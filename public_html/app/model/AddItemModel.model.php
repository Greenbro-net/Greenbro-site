<?php

class AddItemModel extends ItemData
{
    
    // the method adds new product to products table
    public function add_new_product($add_item_obj)
    {
        try {

            $query = "INSERT INTO `products`(`name`, `brand`, `category_id`, `mini_description`, `description`, `image`, `price`, `sale`, `quantity`, `datetime`, `visible`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
           
            $params = array(
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->products_name
            ),
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->brand_name
            ),
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->category_of_products
            ),
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->mini_description
            ),
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->description
            ),
            array(
                "param_type" => "s",
                "param_value" => $add_item_obj->upload_image
            ),
            array(
                "param_type" => "i",
                "param_value" => $add_item_obj->set_price
            ),
            array(
                "param_type" => "i",
                "param_value" => $add_item_obj->sale
            ),
            array(
               "param_type" => "i",
               "param_value" => $add_item_obj->quantity
            ),
            array(
               "param_type" => "s",
               "param_value" => $add_item_obj->datetime
            ),
            array(
               "param_type" => "i",
               "param_value" => $add_item_obj->visible
            ));

           // in success case of execution method returns 1 or false
           $result_add_new_product = $this->updateProductsTable($query, $params);

           if (empty($result_add_new_product)) {
                 throw new Exception("Method add_new_product wasn't successful");
                           } else {
                              return $result_add_new_product;
                                  }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the method below gets last id from products table
    public function get_last_products_id()
    {
       try { 
       $query = "SELECT * FROM `products` WHERE id = (
       SELECT MAX(id) FROM `products`)";

       $last_products_id = self::query($query);

       $params = array(
            "param_type" => "i",
            "param_value" => 0
                      );
            //then we return the value for row united_order_items for other customer ordering and plus to the value 1
            $result_get_last_product_id = (int)$last_products_id[0]["id"];
                  if (empty($result_get_last_product_id)) {
                          throw new Exception("Method get_last_product_id wasn't successful");
                                                  } else {
                                                      return $result_get_last_product_id;
                                                         }
           }    catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                             }

    }


    // the method below unites images data in array
    protected function create_image_array()
    {   
        try {
            if (empty($_FILES["main_image"]["name"]) ) { 
               throw new Exception("Method create_image_array doesn't get an argument");
                }
                // the loop below for adds main_image  values to fileMulti array 
                foreach($_FILES["fileMulti"] as $key => $value) {
               $result_create_image_array = array_unshift($_FILES["fileMulti"][$key], $_FILES["main_image"][$key]);
               
               if (empty($result_create_image_array)) {
                 throw new Exception("Method create_image_array function array_unshift wasn't successful");
                 } else {
                    $result_create_image_array = $_FILES["fileMulti"];
                        }

              } 
              return  $result_create_image_array;
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }
    // the method below checks images for right data type
    protected function is_file_image($key)
    {
        try {
            $check = getimagesize($_FILES["fileMulti"]["tmp_name"][$key]);
            
            if($check == false) {
                throw new Exception("Method is_file_image have found file which is not image");
                } 
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below checks file exist or not
    protected function check_existing_of_file($target_file)
    {
        try {
            
            if (file_exists($target_file)) {
                throw new Exception("Method check_existing_of_file have found file already exist");
                } 
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below checks file size
    protected function check_file_size($key)
    {
        try {
            
            if ($_FILES["fileMulti"]["size"][$key] > 500000) {
                throw new Exception("Method check_file_size have found image to large");
                } 
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below checks file type
    protected function check_file_type($imageFileType)
    {
        try {
            
            if ($imageFileType != "jpg" && $imageFileType != "png" &&
                $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                throw new Exception("Method check_file_type have found image type not allow");
                } 
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below moves uploaded image
    protected function move_upload_image($key, $path)
    {
        try {
            if(!move_uploaded_file($_FILES["fileMulti"]["tmp_name"][$key], $path)) {
                throw new Exception("Method move_upload_image has an error");
            }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           } 
    }
    // the method below creates image storage
    protected function create_image_storage($dir_name)
    {
       try {
            if (!file_exists("images/item_images/$dir_name")) {
                $result_mkdir = mkdir("images/item_images/$dir_name", 0755);
                if (empty($result_mkdir)) {
                    throw new Exception("Method create_image_storage has error in mkdir function");
                  }
            } 
           } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }  
    }
    
    // the method below checks and downloads images
    public function organize_image_download()
    { // images with number 0 will be main image
      // the code below adds images, after it's puting images in item_images folder an names they
        $this->create_image_array();
        foreach ($_FILES["fileMulti"]["name"] as $key => $value) {

            $target_dir = "images/item_images/";
            $target_file = $target_dir .basename($_FILES["fileMulti"]["name"][$key]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Check if image file is a actual image of fake image
            $this->is_file_image($key);
            // Check if file already exists
            $this->check_existing_of_file($target_file);
            // Check file size
            $this->check_file_size($key);
            // Allow certain file formats
            $this->check_file_type($imageFileType);

            // the code below should create a forlder names as last id + 1
            $dir_name = $this->get_last_products_id() + 1;
            // the if statement below checks do we have the same folder
            $this->create_image_storage($dir_name);
                
            // functions below were divided because of Only variables should be passed by reference
            $tmp = explode(".", $_FILES["fileMulti"]["name"][$key]);
            // end function get let element of array 
            // $ext = end($tmp);b
            $ext = "jpg";
            $name = $key. '.' . $ext;
            $path = "images/item_images/$dir_name/" . $name;
            
            // the method below uploads files
            $this->move_upload_image($key, $path);
        }
      
    }



}


