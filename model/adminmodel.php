<?php
$PDOConnect = "./common/connection.php";
if(file_exists($PDOConnect))
{
    require($PDOConnect);
}
else
{
    echo "Not Connected";
}
class AdminModel extends Connection
{
    public function __construct()
    {
        
        $this->connect = $this->connect();
    }
    public function adminValidate($gettedValues)
    {
        $email= $gettedValues['email'];
        $password= $gettedValues['password'];
        $checkMail =  $this->connect->query("SELECT * FROM admin WHERE email='{$email}'")->fetchAll(PDO::FETCH_ASSOC);
        if($checkMail)
        {
            if (password_verify($password, $checkMail[0]['password'])) 
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        $connecting = null;
    }
}
?>