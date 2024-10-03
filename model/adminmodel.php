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
class AdminModel extends Connection
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
    public function adminValidate($submittedValues)
    {
        $email = $submittedValues['email'];
        $password = $submittedValues['password'];
        $checkMail = $this->connect->query("SELECT * FROM admin WHERE email='{$email}'")->fetchAll(PDO::FETCH_ASSOC);
        if ($checkMail) {
            if (password_verify($password, $checkMail[0]['password'])) {
                return 1;
            } else {
                return 0;
            }
        }
        $connecting = null;
    }
    public function adminAdd($getAdminValues)
    {
        $adminAdd = $this->connect->prepare("INSERT INTO admin (email,password) VALUES (:email,:password)");
        $adminAdd->bindParam(':email', $getAdminValues['email']);
        $password = password_hash($getAdminValues['password'], PASSWORD_BCRYPT);
        $adminAdd->bindParam(':password', $password);
        $adminAdd->execute();
    }
}
?>