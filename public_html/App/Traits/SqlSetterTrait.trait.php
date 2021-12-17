<?php


namespace App\Traits;


use Exception;
use PDO;


trait SqlSetterTrait
{
    // the method below sets params and returns sql object
    public function setSqlStatements(object $sql_statement, array $params): object
    {
        try {
            if (empty($params)) {
                throw new Exception("Method setSqlStatements had got an empty parameter");
            }

            foreach($params as $key => $param) {
                if (is_integer($param)) {
                    $sql_statement->bindParam($key + 1, $params[$key]["param_value"], PDO::PARAM_INT);
                } else {
                    $sql_statement->bindParam($key + 1, $params[$key]["param_value"], PDO::PARAM_STR);
                }
            }

            if (!is_object($sql_statement)) {
                throw new Exception("Method setSqlStatements had returned not an object");
            }
            return $sql_statement;
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}




