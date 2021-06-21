<?php

namespace App\Trait;

use Exception;

/**
 * Deep inspection of <var>$input</var> object.
 *
 * @param mixed $input
 *   The variable to inspect.
 * @param int $visibility [optional]
 *   The visibility of the properties that should be inspected, defaults to <code>ReflectionProperty::IS_PUBLIC</code>.
 * @return boolean
 *   <code>FALSE</code> if <var>$input</var> was no object or if any property of the object has a value other than:
 *   <code>NULL</code>, <code>""</code>, or <code>[]</code>.
 */
trait EmptyObjectCheckingTrait
{
   
    protected function object_has_properties($input) 
    { // exceptions inside try block doesn't work properly
        if (empty($input)) {
            throw new Exception("Method object_has_properties doesn't get argument");
                 }

       try {
            $visibility = ReflectionProperty::IS_PUBLIC;
            if (is_object($input)) {
                $properties = (new ReflectionClass($input))->getProperties($visibility);
                $c = count($properties);
                for ($i = 0; $i < $c; ++$i) {
                $properties[$i]->setAccessible(true);
            
                $value = $properties[$i]->getValue($input);
                if (empty($value)) {
                     return false;
                     }
                }
            }
            return true;
       
     
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }  



}


 