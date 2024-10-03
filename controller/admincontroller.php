<?php
class Admin
{
    public function __construct()
    {
        $model = "./model/adminmodel.php";
        if(file_exists($model))
        {
            require($model);
            $this->obj = new AdminModel;
        }
    }

    public function adminadd()
    {
        require_once('./view/signup.php');
        $getAdminValues = $_POST;
        print_r($getAdminValues);
        $add = $this->obj->adminadd($getValues);

    }

    #validate admin
    public function adminvalidation()
    {
        $getValues = $_POST;
        $validate = $this->obj->adminValidate($getValues);
        // $validate = $this->validate;
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
                exit();
            //     $timeout_duration = 1800;

            // if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            //     // Last request was more than 30 minutes ago
            //     session_unset(); // Unset session variables
            //     session_destroy(); // Destroy the session
            // }
            // else if (time() - $_SESSION["LAST_ACTIVITY"] > 60) {
            //     $_SESSION["LAST_ACTIVITY"] = time(); // update last activity time stamp
            // }
            // $_SESSION['LAST_ACTIVITY'] = time();
                
                // print_r($getValues);

                // print_r($adminName);
                // header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentlist");
                // require('./controller/studentcontroller.php');
                // $studentObj = new Student;
                // $studentObj->studentList($adminName);
            
        }
        // else
        // {
        //     echo "Folder not found!";
        // }
    }

    public function login()
    {
        require('./view/login.php');
        session_start();
        if(isset($_POST['email']) && (isset($_POST['password'])))
        {
            $this->adminvalidation();
        }
        else if(isset($_SESSION['isAdminLoggedIn']))
        {
            header('Location: index.php?mod=student&view=studentlist');
            exit();
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();

        #redirect to the login page
        header('Location: index.php?mod=admin&view=login');
        exit();
    }
}
?>