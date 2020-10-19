<?php

class BookModel extends Database
{
    public function getBooks()
    {
        try {
        $sql = "SELECT * FROM products  WHERE category_id = 'books'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results_getBooks = $stmt->fetchAll();
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