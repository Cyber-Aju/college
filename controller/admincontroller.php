<?php
class admin
{
    public function adminvalidation($request)
    {
        $getValues = $_POST;
        // require('./model/adminmodel.php');
        $model = "./model/{$request['model']}" . "model.php";
        if(file_exists($model))
        {
            require($model);
        }
        else
        {
            echo "Folder not found!";
        }
        $obj = new AdminModel;
        $validate = $obj->adminValidate($getValues);
        // print_r($validate);
        // echo "$validate";
        if(!$validate)
        {
            require('./view/error.php');
        }
        else
        {
            session_start();
            $adminName= (strstr($getValues['email'],'@',1));
            $_SESSION['adminLoggedBy'] = $adminName;
            $_SESSION['isAdminLoggedIn'] = true;
            header('Location: index.php?mod=student&view=studentlist');
            
            // print_r($getValues);
            
            // print_r($adminName);
            // header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentlist");
            // require('./controller/studentcontroller.php');
            // $studentObj = new Student;
            // $studentObj->studentList($adminName);
            exit();
        }
    }

    public function logout()
    {
        // Start the session
        session_start();

        // Unset all of the session variables
        $_SESSION = [];

        // Destroy the session completely
        session_destroy();

        // Redirect to the login page or any other page
        header('Location: index.php');
        exit();
    }
}
?>