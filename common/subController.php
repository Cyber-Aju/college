<?php
class SubController
{
    public function subcontroller($request)
    {
        $model = "./model/{$request['model']}" . "model.php";
        if(file_exists($model))
        {
            require($model);
        }
        else
        {
            echo "Folder not found!";
        }
    }
}
?>