<?php 

class FoodModel extends DBController
{
   private function getFood()
   {
      try {

        $sql = "SELECT P.*,  COUNT(R.product_id) as response_count 
            FROM `products` P
            LEFT JOIN `response` R ON `R`.`product_id` = `P`.`id`
            WHERE category_id = 'products'
            group by P.id";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
          // the parameter in the end for grabs only associative array data
        $results_getFood = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results_getFood)) {
          throw new Exception("Function getFood wasn't successful");
              } else {
                  return $results_getFood;
                     }

      } catch (Exception $exception) {
        file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
        'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                     }

    
   }
 
   public function showFood()
   { 
        $products = $this->getFood();
        include CONTENT . 'product-list.content.php';
    }  

}
?>
