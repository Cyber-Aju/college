<?php
/*
  @author : Ajmal Akram S
  @created at : 25-09-2024
  @modified at : 26-09-2024
*/

$baseController = "./common/subController.php";
if(file_exists($baseController))
{
    require("./common/subController.php");
}
else
{
    echo "Not found!";
}

class student extends subcontroller
{
    public function __construct($request)
    {
        $this->subcontroller($request);
        $this->studentModelObj = new StudentModel;
        $this->parameter = $this->studentModelObj->studentList();
    }

    public function studentList()
    {
        $list = $this->parameter;
        if(is_array($list) && file_exists("./view/studentlist.php") )
        {
            include("./view/studentlist.php");
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
        $para = $this->studentModelObj->studentAdder($getValues);
        header("Refresh:2;url=http://localhost/college/index.php?mod=student&view=studentList");
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

    #__call magic method to handle if invalid function called. {Arguments: null,  returns : null}.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
        echo "Available methods : studentList"; 
    }
}

?>