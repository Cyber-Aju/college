<?php
class Login
{
    public function __construct()
    {
        $ModelPath = "./model/loginmodel.php";
        if (file_exists($ModelPath)) {
            require_once($ModelPath);
            $this->loginModelObj = new LoginModel;
        }
    }

    /**
     * validate admin through email and hashed password
     * @return void
     */
    public function validation()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (empty($username) || empty($password)) {
                echo "<script>alert('username and password should not be empty'); window.history.back();</script>";
                exit;
            }
            $getValues = ['username' => $username, 'password' => $password];
            $isValid = $this->loginModelObj->validate($getValues);
            if ($isValid[0]['user_type'] == 'student') {
                $adminName = (strstr($getValues['username'], '@', 1));
                $_SESSION['adminLoggedBy'] = $adminName;
                $_SESSION['isAdminLoggedIn'] = true;
                $_SESSION['previous_page'] = $_SERVER['PHP_SELF'];

                $studentView = "index.php?mod=student&view=studentview&student_id={$isValid[0]['user_id']}&login=student";
                header("Location: $studentView");
                exit;

            } else if ($isValid[0]['user_type'] == 'admin') {
                $adminName = (strstr($getValues['username'], '@', 1));
                $_SESSION['adminLoggedBy'] = $adminName;
                $_SESSION['isAdminLoggedIn'] = true;

                header('Location: index.php?mod=student&view=studentlist');
                exit();
            } else {
                $error = "Wrong username and Password";
                require_once('./view/error.php');
            }
        }
    }

    /**
     * Function to intiate process & handling admin login
     * @return void
     */
    public function login()
    {
        require('./view/login.php');
        if (isset($_POST['username']) && (isset($_POST['password']))) {
            $this->adminvalidation();
        } else if (isset($_SESSION['isAdminLoggedIn'])) {
            header('Location: index.php?mod=student&view=studentlist');
            exit();
        }
    }

    /**
     * Logouts from the session
     * @return 
     */
    public function logout()
    {
        // session_start();
        $_SESSION = [];
        session_destroy();

        //redirect to the login page
        header('Location: index.php?mod=login&view=login');
        exit();
    }
}
?>