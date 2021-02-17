<?php
trait controllerTrait
{
    protected $model;

    public function model($modelName, $data=[])
    {
        if(file_exists(MODEL . $modelName . '.model.php'))
        {
            // there are we were changed require to require_once for escaping Error from model which load a few times
            require_once MODEL . $modelName . '.model.php';
            $this->model = new $modelName;
        }
    }
}