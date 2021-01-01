<?php

class BookModel extends DBController
{
    private function getBooks()
    {
        try {

        $sql = "SELECT P.*,  COUNT(R.product_id) as response_count 
            FROM `products` P
            LEFT JOIN `response` R ON `R`.`product_id` = `P`.`id`
            WHERE category_id = 'books'
            group by P.id";
        

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results_getBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results_getBooks)) {
                throw new Exception("Function getBooks wasn't successful");
                     } else {
                        return $results_getBooks;
                            }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }

    }

    public function showBooks()
    {   
        $products = $this->getBooks();
        include CONTENT . 'product-list.content.php';
    }
}