<?php


define("DATABASE_HOST", "hosting26.ukrnames.com");
define("DATABASE_USERNAME", "green64_one");
define("DATABASE_PASSWORD", "123456");
define("DATABASE_NAME", "green64_bro");
define("DATABASE_NAME1", "green64_products");

class DatabaseTest {
    private static $host   ="greenbro.net";
    private static $dbName = "green64_products";
    private static $username = "green64_one";
    private static $password = "123456";

    protected static function connect() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$username, self::$password);
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);


        return $pdo;
    }
    protected static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
        }
    }




    public function get_id() 
       {
    $query = "SELECT * FROM `order_items`
       WHERE order_items_id = (
          SELECT MAX(order_items_id) FROM `order_items`)";
    $sql_statement = self::query($query);
    echo "<pre>";       

    //  var_dump($sql_statement[0]["order_items_id"]);
    return $last_insert_id = (int)$sql_statement[0]["order_items_id"];
       }


    

       public function getMemberCartItem($member_id)
       {
           // * it is means select all rows from table 
           // AS command is used to rename a column or table with an alias
   
           //    the code below gets from tbl_product all rows 
           // and in tbl_cart.id will be cart_id and gets quantity
           $query = "SELECT products.*, order_items.product_id as cart_id,order_items.quantity_of_item 
                      FROM products, order_items
    --    the code below means that id value has to be the same in both tables
                      WHERE products.id = order_items.product_id 
                   --    AND is like a && operator in PHP
                      AND order_items.united_order_items = ?";
           
           $params = array(
               array(
                   "param_type" => "i",
                   "param_value" => $member_id
               )
               );
   
           $cartItem = $this->getDBResult($query, $params);
           return $cartItem;
       }

       
       public function getDBResult($query, $params)
    {

        $sql_statement = self::connect()->prepare($query);
        
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
        }
        
        $result = $sql_statement->execute();

        $resultset = $sql_statement->fetchAll();

        if (! empty($resultset)) {
            return $resultset;
        }
    
      return $result;
    
 }

}

$user_query = new DatabaseTest();
// echo "<pre>";
$user_query->getMemberCartItem(11);
// var_dump($user_query->get_id());
