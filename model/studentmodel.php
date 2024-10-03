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

    #fetch students from student table
    public function studentlist()
    {
        $list = $this->connect->prepare("SELECT * FROM student WHERE status=:status || status='Not Active'");
        $status="Active";
        $list->bindParam(":status",$status);
        $list->execute();
        $selectList = $list->fetchAll(PDO::FETCH_ASSOC);
        return $selectList;
    }

    #insert student from the controller
    public function studentAdder($getValues,$targetFilePath,$age)
    {
        $insertQuery = $this->connect->prepare("INSERT INTO student (first_name,last_name,department,email,status,phone,dob,address,gender,profile_image,age,blood_group) values(:first_name,:last_name,:department,:email,:status,:phone,:dob,:address,:gender,:profile_image,:age,:blood_group)");
        $insertQuery->bindParam(':first_name',$getValues['first_name']);
        $insertQuery->bindParam(':last_name',$getValues['last_name']);
        $insertQuery->bindParam(':department',$getValues['department']);
        $insertQuery->bindParam(':email',$getValues['email']);
        $insertQuery->bindParam(':status',$getValues['status']);
        $insertQuery->bindParam(':phone',$getValues['phone']);
        $insertQuery->bindParam(':dob',$getValues['dob']);
        $insertQuery->bindParam(':address',$getValues['address']);
        $insertQuery->bindParam(':gender',$getValues['gender']);
        $insertQuery->bindParam(':profile_image',$targetFilePath);
        $insertQuery->bindParam(':age',$age);
        $insertQuery->bindParam(':blood_group',$getValues['blood_group']);

        $checkValid = $insertQuery->execute();
        if($checkValid)
        {
            return $insertQuery->rowCount();
        }
        else
        {
            echo "Failed to store in DB";
        }
        
    }

    #soft delete based on id received from controller
    public function studentDelete($id)
    {
        $update = $this->connect->prepare("UPDATE student SET status='2' WHERE student_id=:id");
        $update->bindParam(':id',$id);
        $update->execute();
        return $update;
    }

    public function studentUpdate($gettedValues,$targetFilePath)
    {
        $student_id = $gettedValues['student_id'];
        $first_name = $gettedValues['first_name'];
        $last_name = $gettedValues['last_name'];
        $department=$gettedValues['department'];
        $email = $gettedValues['email'];
        $status=$gettedValues['status'];
        $phone=$gettedValues['phone'];
        $dob=$gettedValues['dob'];
        $address=$gettedValues['address'];
        $gender=$gettedValues['gender'];
        $profile_image=$targetFilePath;
        $blood_group=$gettedValues['blood_group'];

        $prepareEdit = $this->connect->prepare("UPDATE student 
                                                SET first_name=:first_name, 
                                                last_name=:last_name, 
                                                department=:department, 
                                                email=:email, 
                                                status=:status,
                                                phone=:phone,
                                                dob=:dob,
                                                address=:address,
                                                gender=:gender,
                                                profile_image=:profile_image,
                                                blood_group=:blood_group
                                                WHERE student_id=:student_id");
        $prepareEdit->bindParam(':student_id',$student_id);
        $prepareEdit->bindParam(':first_name',$first_name);
        $prepareEdit->bindParam(':last_name',$last_name);
        $prepareEdit->bindParam(':department',$department);
        $prepareEdit->bindParam(':email',$email);
        $prepareEdit->bindParam(':status',$status);
        $prepareEdit->bindParam(':phone',$phone);
        $prepareEdit->bindParam(':dob',$dob);
        $prepareEdit->bindParam(':address',$address);
        $prepareEdit->bindParam(':gender',$gender);
        $prepareEdit->bindParam(':profile_image',$profile_image);
        $prepareEdit->bindParam(':blood_group',$blood_group);
        $updatedStatus = $prepareEdit->execute();
        return $updatedStatus;
    }

    public function particularShow($id)
    {
        $selectIdQuery = $this->connect->query("SELECT * FROM student WHERE student_id={$id}")->fetchAll(PDO::FETCH_ASSOC);
        return $selectIdQuery;
    }

    public function getFilteredStudents($department, $status,$first_name) 
    {
         $getAll = "SELECT * FROM student WHERE 1=1";
         
         #adding department if is selected
         if (!empty($department)) {
             $getAll .= " AND department = :department";
         }
         
         #adding status if it selected
         if (!empty($status)) {
             $getAll .= " AND status = :status";
         }

         #searching name if it has value
         if (!empty($first_name)) {
             $getAll .= " AND first_name = :first_name";
         }
         
         $stmt = $this->connect->prepare($getAll);
         if (!empty($department)) {
             $stmt->bindParam(':department', $department);
         }
         if (!empty($status)) {
             $stmt->bindParam(':status', $status);
         }
         if (!empty($first_name)) {
             $stmt->bindParam(':first_name', $first_name);
         }
         $stmt->execute();
         return $stmt->fetchAll();
     }
    
    #__call magic method to handle if invalid function called.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
        echo "Available methods : studentList";
    }
}
?>
