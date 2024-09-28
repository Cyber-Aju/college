<?php
class admin
{
    public function adminvalidation()
    {
        $getValues = $_POST;
        require('./model/adminmodel.php');
        $obj = new AdminModel;
        $validate = $obj->adminValidate($getValues);
        if(!$validate)
        {
            require('./view/error.php');
        }
    }
}
?>