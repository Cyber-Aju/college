<?php
/**
 * Student class that handles student operations
 */
class Student
{
    /**
     * handles session checks and loads the student model to fetch the student list.
     */
    public function __construct()
    {
        session_start();
        //if session false go to login
        if (!isset($_SESSION['isAdminLoggedIn'])) {
            header('Location: index.php?mod=admin&view=login');
            exit();
        }
        $adminName = $_SESSION['adminLoggedBy'];
        if (file_exists('./common/header.php')) {
            require_once('./common/header.php');
        }
        $modelPath = "./model/studentmodel.php";
        if (file_exists($modelPath)) {
            require_once($modelPath);
        } else {
            echo "Folder not found!";
        }
        $this->studentModelObj = new StudentModel;
        $this->parameter = $this->studentModelObj->studentList();
    }

    /**
     * fetch and display the list of students
     * @return void
     */
    public function studentList()
    {
        $paginationData = $this->studentModelObj->studentlistPagination();
        $list = $paginationData['result'];
        $total_pages = $paginationData['total_pages'];
        $page = $paginationData['page'];
        $num_results_on_page = $paginationData['num_results_on_page'];
        if (is_array($list) && file_exists("./view/studentlist.php")) {
            require("./view/studentlist.php");
        } else {
            echo "view not found";
        }
    }

    /**
     * renaming images and ensured that moved in our desired path
     * @param mixed $getValues
     * @return string
     */
    public function image($getValues)
    {
        //checking image has any error
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $file = $_FILES['avatar'];
            $student_dept = $getValues['department'];
            $student_name = $getValues['first_name'];
            $targetDir = "./view/uploads/";

            //generate a new filename using student_name with department name
            $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $student_dept . "_" . $student_name . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            //move the file to the target directory with the new name
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $targetFilePath;
            } else {
                echo "Error moving the uploaded file.";
            }
        }
        return null;
    }

    /**
     * To add new students
     * @param mixed $request
     * @return bool
     */
    public function studentAdd($request)
    {
        if (file_exists("./view/StudentAdd.php")) {
            require_once("./view/StudentAdd.php");
            if (isset($_POST['dob'])) {
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
                if (!$para) {
                    echo "False";
                } else {
                    header("Refresh:1;url=index.php?mod=student&view=studentList");
                    exit();
                }
                return $para;
            }
        } else {
            echo "student add file is not included!";
        }
    }

    /**
     * soft delete a student
     * @param mixed $request
     * @return void
     */
    public function studentDelete($request)
    {
        $id = $request['request_data']['student_id'];

        $msg = $this->studentModelObj->studentDelete($id);
        if (!$msg) {
            echo "Not deleted";
        } else {
            header("Refresh:1;url=index.php?mod=student&view=studentList");
            exit();
        }
    }

    /**
     * to interface the form to edit
     * @param mixed $request
     * @return void
     */
    public function studentEdit($request)
    {
        $uid = $request['request_data']['student_id'];
        $quer = $this->studentModelObj->particularShow($uid);
        if (file_exists("view/StudentEdit.php")) {
            require_once("view/StudentEdit.php");
        } else {
            echo "wrong view path";
        }
    }

    /**
     * updating value as in posted in the edit form
     * @return void
     */
    public function studentUpdate()
    {
        $gettedValues = $_POST;

        //image handling
        $targetFilePath = $this->image($gettedValues);

        $dob = $gettedValues['dob'];
        $dobDate = new DateTime($dob);
        $now = new DateTime();
        $age = $now->diff($dobDate);
        $age = $age->y;

        if ($targetFilePath == NULL || $age == NULL) {
            $targetFilePath = $gettedValues['profile'];
            $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath, $age);
        } else {
            $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath, $age);
        }

        if (!$msg) {
            echo "Not updated";
        } else {
            header("Refresh:1;url=index.php?mod=student&view=studentList");
            exit();
        }
    }

    /**
     * Searcing name, filtering by status and department
     * @return void
     */
    public function filter()
    {
        $department = isset($_POST['department']) ? $_POST['department'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';

        // get filtered students from the model
        $paginationData = $this->studentModelObj->getFilteredStudents($department, $status, $first_name);
        $list = $paginationData['result'];
        $total_pages = $paginationData['total_pages'];
        $page = $paginationData['page'];
        $num_results_on_page = $paginationData['num_results_on_page'];

        $adminName = $_SESSION['adminLoggedBy'];
        if (file_exists('view/studentlist.php')) {
            require_once 'view/studentlist.php';
        }
    }

    /**
     * view a particular student
     * @param mixed $request
     * @return void
     */
    public function studentview($request)
    {
        $getId = $request['request_data']['student_id'];
        $viewQuer = $this->studentModelObj->particularShow($getId);
        if (file_exists('./view/view.php')) {
            require_once('./view/view.php');
        }
    }

    /**
     * magic method to handle invalid method calls
     * @param mixed $name
     * @param mixed $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
    }
}

?>