<?php
class Admin
{
    public function __construct()
    {
        $adminModelPath = "./model/adminmodel.php";
        if (file_exists($adminModelPath)) {
            require_once($adminModelPath);
            $this->adminModelObj = new AdminModel;
        }
    }

    public function adminadd()
    {
        if (file_exists('./view/signup.php')) {
            require_once('./view/signup.php');
        }
        $adminValues = $_POST;
        $add = $this->adminModelObj->adminadd($getValues);
    }

    /**
     * validate admin through email and hashed password
     * @return void
     */
    public function adminvalidation()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format!";
                require_once('./view/error.php');
                return;
            }
            $getValues = ['email' => $email, 'password' => $password];
            $isValid = $this->adminModelObj->adminValidate($getValues);
        }
        if (!$isValid) {
            $error = "Wrong Mail and Password";
            require_once('./view/error.php');
        } else {
            session_start();
            $adminName = (strstr($getValues['email'], '@', 1));
            $_SESSION['adminLoggedBy'] = $adminName;
            $_SESSION['isAdminLoggedIn'] = true;
            header('Location: index.php?mod=student&view=studentlist');
            exit();
        }
    }

    /**
     * Function to intiate process & handling admin login
     * @return void
     */
    public function login()
    {
        require('./view/login.php');
        session_start();
        if (isset($_POST['email']) && (isset($_POST['password']))) {
            $this->adminvalidation();
        } else if (isset($_SESSION['isAdminLoggedIn'])) {
            header('Location: index.php?mod=student&view=studentlist');
            exit();
        }
    }

    /**
     * Logouts from the session
     * @return never
     */
    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();

        //redirect to the login page
        header('Location: index.php?mod=admin&view=login');
        exit();
    }
}
?>