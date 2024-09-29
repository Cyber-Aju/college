<?php
/*
  @author : Ajmal Akram S
  @created at : 25-09-2024
  @modified at : 26-09-2024
*/

class student
{
    public function __construct()
    {
        $model = "./model/studentmodel.php";
        if(file_exists($model))
        {
            require($model);
        }
        else
        {
            echo "Folder not found!";
        }
        $this->studentModelObj = new StudentModel;
        $this->parameter = $this->studentModelObj->studentList();
        session_start();
        if (!isset($_SESSION['isAdminLoggedIn'])) {
            header('Location: index.php?mod=admin&view=adminValidation');
            exit();
        }
        // print_r($_SESSION);
    }

    public function studentList()
    {
        $list = $this->parameter;
        if(is_array($list) && file_exists("./view/studentlist.php") )
        {
            $adminName = $_SESSION['adminLoggedBy'];
            require("./view/studentlist.php");
        }
        else
        {
            echo "view not found";
        }
        return null;
    }

    #inserting new values
    public function studentAdd($request)
    {
        require("./view/StudentAdd.php");
        $getValues = $_POST;
        $dob = $getValues['dob'];
        $dobDate = new DateTime($dob);
        $now = new DateTime(); // Current date
        // Calculate the difference
        $age = $now->diff($dobDate);
        $age = $age->y; 
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) 
        {
            // Retrieve file information
            $file = $_FILES['avatar'];
            $student_id = 1; // Assume student_id is known (e.g., from session or form)
            $student_name = $getValues['first_name']; // Retrieve the student's name (e.g., from database or form)

            // Define the target directory
            $targetDir = "./view/uploads/";

            // Generate a new filename using student_id and student_name
            $fileType = pathinfo($file['name'], PATHINFO_EXTENSION); // Get the file extension
            $newFileName = $student_id . "_" . $student_name . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            // Move the file to the target directory with the new name
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                $para = $this->studentModelObj->studentAdder($getValues, $targetFilePath, $age);
            } else {
                echo "Error moving the uploaded file.";
            }
            // $para = $this->studentModelObj->studentAdder($getValues, $targetFilePath, $age);
            echo "$para";
        }
        // header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentList");
        return $para;
    }

    public function studentDelete($request)
    {
        $id = $_GET['student_id'];
        $this->studentModelObj->studentDelete($id);
        // $this->studentList($request);
        header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentList");
    }

    public function studentEdit($request)
    {
        $uid = $_GET['student_id'];
        $quer = $this->studentModelObj->particularShow($uid);
        require("view/StudentEdit.php");
    }

    public function studentUpdate($request)
    {
        $gettedValues=$_POST;
        $ho = $this->studentModelObj->studentUpdate($gettedValues);
        // print_r($ho);
        // $this->studentList($request);
        header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentList");
    }

    public function filter()
    {
        $gettedValues=$_POST;
        $aa = $this->studentModelObj->filter($gettedValues);
        print_r($aa);
        // header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentList");
    }

    #__call magic method to handle if invalid function called. {Arguments: null,  returns : null}.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
        echo "Available methods : studentList"; 
    }
}

?>