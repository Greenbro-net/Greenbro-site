<?php

echo "Hello there";
die;
class Test extends Food {
    function add()
    {
        
        $sql = "INSERT INTO `products_cart`(`id`, `product_id`, `quantity`, `member_id`) VALUES (2,2,3,4)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
    }
}
echo "Hello";
$test = new Test();

$test->add();