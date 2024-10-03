<?php

class student
{
    #handles session checks and loads the student model to fetch the student list.
    public function __construct()
    {
        session_start();
         #session false go to login
        if (!isset($_SESSION['isAdminLoggedIn'])) 
        {
            header('Location: index.php?mod=admin&view=login');
            exit();
        }
        // else
        // {
        //     header('Location: index.php?mod=admin&view=adminvalidation');
        //     exit();
        // }
        $adminName = $_SESSION['adminLoggedBy'];
        require_once('./common/header.php');
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
    }

    public function studentList()
    {
        $all= $this->studentModelObj->studentlistPagination();
        // print_r($all);
        $list = $all['result'];
        $total_pages = $all['total_pages'];
        // print_r($total_pages);
        $page = $all['page'];
        // print_r($page);
        $num_results_on_page = $all['num_results_on_page'];
        if(is_array($list) && file_exists("./view/studentlist.php") )
        {
            require("./view/studentlist.php");
        }
        else
        {
            echo "view not found";
        }
        return null;
    }

    // #To display students
    // public function studentList()
    // {
    //     $list = $this->parameter;
    //     if(is_array($list) && file_exists("./view/studentlist.php") )
    //     {
    //         $adminName = $_SESSION['adminLoggedBy'];
    //         require("./view/studentlist.php");
    //     }
    //     else
    //     {
    //         echo "view not found";
    //     }
    //     return null;
    // }

    #renaming images and ensured that moved in our desired path
    public function image($getValues)
    {
        #checking image has any error and ensure that uploaded image's name
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) 
        {
            $file = $_FILES['avatar'];
            $student_dept = $getValues['department']; 
            $student_name = $getValues['first_name'];
            $targetDir = "./view/uploads/";

            # generate a new filename using student_name
            $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $student_dept . "_" . $student_name . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            # move the file to the target directory with the new name
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) 
            {
                return $targetFilePath;
            }
            else 
            { 
                echo "Error moving the uploaded file.";
            }
        }
    }

    #To add new students
    public function studentAdd($request)
    {
        if(file_exists("./view/StudentAdd.php"))
        {
            require_once ("./view/StudentAdd.php");
            if(isset($_POST['dob']))
            {
                $getValues = $_POST;
                #calculate age via dob
                $dob = $getValues['dob'];
                $dobDate = new DateTime($dob);
                $now = new DateTime();
                $age = $now->diff($dobDate);
                $age = $age->y;

                #image handling through image function
                $targetFilePath = $this->image($getValues);
                $para = $this->studentModelObj->studentAdder($getValues, $targetFilePath, $age);
                if (!$para)
                {
                    echo "False";
                }
                else
                {
                    header("Refresh:2;url=index.php?mod=student&view=studentList");
                    exit();
                }
                return $para;
            }
        }
        else
        {
            echo "student add file is not included!";
        }
    }

    #to soft delete a student
    public function studentDelete($request)
    {
        // $id = $_GET['student_id'];
        $id = $request['request_data']['student_id'];

        $msg = $this->studentModelObj->studentDelete($id);
        if(!$msg)
        {
            echo "Not deleted";
        }
        else
        {
            header("Refresh:2;url=index.php?mod=student&view=studentList");
            exit();
        }
    }

    #to interface the form to edit
    public function studentEdit($request)
    {
        // $uid = $_GET['student_id'];
        $uid = $request['request_data']['student_id'];
        $quer = $this->studentModelObj->particularShow($uid);
        if(file_exists("view/StudentEdit.php"))
        {
            require_once ("view/StudentEdit.php");
        }
        else
        {
            echo "wrong view path";
        }
    }

    #updating value as in posted in the edit form
    public function studentUpdate()
    {
        $gettedValues=$_POST;

        #image handling
        $targetFilePath = $this->image($gettedValues);
        $dob = $gettedValues['dob'];
            $dobDate = new DateTime($dob);
            $now = new DateTime();
            $age = $now->diff($dobDate);
            $age = $age->y;
        if($targetFilePath==NULL || $age==NULL)
        {
            // print_r($gettedValues);
            
            $targetFilePath = $gettedValues['profile'];
            $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath,$age);
        }
        else
        {
            $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath,$age);
        }
        
        if(!$msg)
        {
            echo "Not updated";
        }
        else
        {
            header("Refresh:2;url=index.php?mod=student&view=studentList");
            exit();
        }
    }

    #Searcing name, filtering by status and department
    public function filter()
    {
        $department = isset($_GET['department']) ? $_GET['department'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
        $list = $this->studentModelObj->getFilteredStudents($department,$status,$first_name);
        $adminName = $_SESSION['adminLoggedBy'];
        if(file_exists('view/studentlist.php'))
        {
            require_once 'view/studentlist.php';
        }
    }

    #view a particular student
    public function studentview($request)
    {
        // $getId = $_GET['student_id'];
        $getId = $request['request_data']['student_id'];
        $viewQuer = $this->studentModelObj->particularShow($getId);
        if(file_exists('./view/view.php'))
        {
            require_once('./view/view.php');
        }
    }

    #__call magic method to handle if invalid function called. {Arguments: null,  returns : null}.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
        echo "Available methods : studentList"; 
    }
}

?>