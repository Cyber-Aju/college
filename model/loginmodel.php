<?php
$PDOConnect = "./common/connection.php";
if (file_exists($PDOConnect)) {
    require($PDOConnect);
} else {
    echo "Not Connected";
}
/**
 * child of connection to operating DB process
 */
class LoginModel extends Connection
{
    public function __construct()
    {
        $this->connect = $this->connect();
    }

    /**
     * Validate admin credentials
     * @param mixed $submittedValues
     * @return int
     */
    public function Validate($submittedValues)
    {
        print_r($submittedValues);
        $username = $submittedValues['username'];
        $password = MD5($submittedValues['password']);
        $checkMail = $this->connect->query("SELECT * FROM user WHERE username='{$username}' AND password = '{$password}'")->fetchAll(PDO::FETCH_ASSOC);
        if ($checkMail) {
            return $checkMail;
        }
        $connecting = null;
    }
    // public function adminAdd($getAdminValues)
    // {
    //     $adminAdd = $this->connect->prepare("INSERT INTO admin (email,password) VALUES (:email,:password)");
    //     $adminAdd->bindParam(':email', $getAdminValues['email']);
    //     $password = password_hash($getAdminValues['password'], PASSWORD_BCRYPT);
    //     $adminAdd->bindParam(':password', $password);
    //     $adminAdd->execute();
    // }
}
?>