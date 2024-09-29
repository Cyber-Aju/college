<?php
class Connection
{
    public function connect()
    {
        $server='localhost';
        $user="root";
        $databaseName = "college";
        $connectDB = new PDO("mysql:host=$server;dbname=$databaseName","$user",'1234');
        if($connectDB)
        {
            // echo "Successfully Connected from connection class<br>";
        }
        else
        {
            echo "Connection Failed <br>";
        }
        return $connectDB;
    }
}
// $obj=new Connection;
// $obj->connect();
?> 