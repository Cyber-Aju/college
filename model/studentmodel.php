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

class StudentModel extends Connection
{
    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function studentlist()
    {
        $list = $this->connect->prepare("SELECT * FROM student WHERE status=:status");
        $status="Active";
        $list->bindParam(":status",$status);
        $list->execute(); //->fetchAll(PDO::FETCH_ASSOC)
        $selectList = $list->fetchAll(PDO::FETCH_ASSOC);
        return $selectList;
    }

    public function studentAdder($getValues)
    {
        $insertQuery = $this->connect->prepare("INSERT INTO student (first_name,last_name,department,email,status) values(:first_name,:last_name,:department,:email,:status)");
        $insertQuery->bindParam(':first_name',$getValues['first_name']);
        $insertQuery->bindParam(':last_name',$getValues['last_name']);
        $insertQuery->bindParam(':department',$getValues['department']);
        $insertQuery->bindParam(':email',$getValues['email']);
        $insertQuery->bindParam(':status',$getValues['status']);
        $checkValid = $insertQuery->execute();
        if($checkValid)
        {
            // echo "Successfully " . $insertQuery->rowCount() . " Inserted in DB"; 
            // // header("");
            // header("Refresh:2;url=http://localhost/forms/formTaskRefactor/route.php?module=select");
        }
        else
        {
            echo "Failed to store in DB";
        }
        return $insertQuery->rowCount();
    }

    public function studentDelete($id)
    {
        $update = $this->connect->prepare("UPDATE student SET status='2' WHERE student_id=:id");
        // $sid=$id;
        // print_r($sid);
        $update->bindParam(':id',$id);
        $update->execute();
        return $update;
    }

    public function studentEdit($uid)
    {
        // print_r($uid);
        $quer = $this->particularShow($uid);
        return $quer;
    }

    public function studentUpdate($gettedValues)
    {
        $student_id = $gettedValues['student_id'];
        $first_name = $gettedValues['first_name'];
        $last_name = $gettedValues['last_name'];
        $department=$gettedValues['department'];
        $email = $gettedValues['email'];
        $status=$gettedValues['status'];
        $prepareEdit = $this->connect->prepare("UPDATE student SET first_name=:first_name, last_name=:last_name, department=:department, email=:email, status=:status WHERE student_id=:student_id");
        $prepareEdit->bindParam(':student_id',$student_id);
        $prepareEdit->bindParam(':first_name',$first_name);
        $prepareEdit->bindParam(':last_name',$last_name);
        $prepareEdit->bindParam(':department',$department);
        $prepareEdit->bindParam(':email',$email);
        $prepareEdit->bindParam(':status',$status);
        $updatedStatus = $prepareEdit->execute();
        return $updatedStatus;
    }

    public function particularShow($id)
    {
        $selectIdQuery = $this->connect->query("SELECT * FROM student WHERE student_id={$id}")->fetchAll(PDO::FETCH_ASSOC); //WHERE status='no'
        return $selectIdQuery;
    }

    #__call magic method to handle if invalid function called.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
        echo "Available methods : studentList";
    }
}
?>