<?php 

class Food extends Database {


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
// new functin which show messages
function showmessage($row) 
{    
    $message = "Є в наявності";
    if($row["quantity"] < 6) {
        $message = "Товар закінчується";
    } 
    if ($row["quantity"] == 0) {
        $message = "Товар закінчився";
    }
    return $message;
}
?>
<section class="catalog" id="catalog">
    <h2>Наші товари</h2>
    <div class="container">
        <div class="row">

<?php

        $rows = $this->getFood();
        foreach($rows as $row)
        {

                    echo "
                    <div class=\"product col-lg-3 col-md-4 col-sm-6\" data-product-id=\"".$row["id"]."\">               
                        <div class=\"product__img\"> <img src=\"../images/picture/".$row["image"]."\" alt=\"Nice Cat\" /> </div>
                        <p class=\"product-name\">".$row["name"]."</p>
                        <div class=\"product-menu\">";

            //   TO DO IT!!!!!!!!!!
                    if($row["sale"]) {
                        $price = $row["price"] - ($row["price"] * ($row["sale"] / 100));
                        $price = (ceil($price*100) / 100);
                        echo "<div class=\"product-price sale\">$" . $price;
                    }
                    else 
                    // echo "<div class=\"product-price\">грн".$row["price"];
                    echo "<div class=\"product-price\"> ".$row["price"] . "грн";
                    
                    echo "</div>
                            <div class=\"how-many\">
                                <div class=\"quantity-input\">
                                    <input class=\"minus btn\" type=\"button\" value=\"-\">
                                    <input class=\"input-text quantity text\" value=\"1\" size=\"4\" data-quantity=\"".$row["quantity"]."\">
                                    <input class=\"plus btn\" type=\"button\" value=\"+\">
                                    
                                    
                                     <div class=\"stock\"> ".showmessage($row)." </div>
                                </div>
                            </div>
                            <button class=\"btn add-to-cart\">Добавить в корзину</button>
                        </div>
                    </div>
                            ";

        }
        ?>
        </div>
    </div>
</section>

<div class="basket checkout-button">
    <img src="../images/shopping-basket.svg" alt="shopping-basket">
</div>

<?php
    }
}
?>