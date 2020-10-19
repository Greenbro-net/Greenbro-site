<?php 

class Food extends Database 
{
   public function getFood()
   {
    $sql = "SELECT * FROM products WHERE category_id = 'products'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll();
    return $results;
   }
 
public function showFood()
    {
        $products = $this->getFood();
        include CONTENT . 'product-list.content.php';
    }  
}
?>
