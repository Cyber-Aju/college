<?php
require('./controller/basecontroller.php');
/**
 * Student class that handles student operations
 */
class Student extends SubController
{
    /**
     * handles session checks and loads the student model to fetch the student list.
     */
    public function __construct()
    {
        //if session false goes to login
        if (!isset($_SESSION['isAdminLoggedIn'])) {
            header('Location: index.php?mod=login&view=login');
            exit();
        }
        $this->fileHandling($mvc = 'COMMON', $file = 'header', NULL);
        // if (file_exists('./common/header.php')) {
        //     require('./common/header.php');
        // }
        $this->fileHandling($mvc = 'MODEL', $file = 'studentmodel', NULL);

        // $modelPath = "./model/studentmodel.php";
        // if (file_exists($modelPath)) {
        //     require($modelPath);
        // } else {
        //     $error = "Model Not Found";
        //     require_once('./view/error.php');
        // }
        $this->studentModelObj = new StudentModel;
    }


    /**
     * fetch and display the list of students
     * @return void
     */
    public function studentList()
    {
        $paginationData = $this->studentModelObj->studentlistPagination();
        // print_r($paginationData);
        // $list = $paginationData['result'];
        // $total_pages = $paginationData['total_pages'];
        // $page = $paginationData['page'];
        // $num_results_on_page = $paginationData['num_results_on_page'];

        // if (is_array($list) && file_exists("./view/studentlist.php")) {
        //     require("./view/studentlist.php");
        // } else {
        //     $error = "view list not found";
        //     require_once('./view/error.php');
        // }
        // print_r($list);
        /**
         * [0] => Array
                (
                    [user_id] => 5
                    [username] => admin@infiniti
                    [password] => Inf!n!t!
                    [user_type] => admin
                    [status] => 
                    [created_at] => 2024-10-05 21:10:07
                    [updated_at] => 2024-10-05 21:10:07
                    [register_number] => AD001
                    [detail_id] => 1
                    [r_user_id] => 5
                    [firstname] => Ajmal
                    [lastname] => Akram
                    [r_department_id] => 2
                    [dob] => 2002-10-17
                    [gender] => male
                    [email] => ajmalakram152@gmail.com
                    [mobile] => 7094653492
                    [address] => TVK Main Road, Ammapet, Salem
                    [blood_group] => B+
                    [image_path] => ./view/uploads/_Ajmal.jpg
                    [department_id] => 2
                    [department] => 
                )
         */
        $this->fileHandling($mvc = 'VIEW', $file = 'studentlist', $paginationData);

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
                $error = "Error moving the uploaded file.";
                require_once('./view/error.php');
            }
        }
        return null;
    }

    /**
     * To add new students
     * 
     * @return bool
     */
    public function studentAdd()
    {
        // if (file_exists("./view/StudentAdd.php")) {
        //     require('./view/StudentAdd.php');
        // } else {
        //     $error = "student add file is not included!";
        //     require_once('./view/error.php');
        // }
        $this->fileHandling($mvc = 'VIEW', $file = 'StudentAdd', NULL);
        // print_r($_POST);
        /**
         * 


Array
(
    [username] => admin@infiniti
    [password] => Inf!n!t!
    [re-password] => Inf!n!t!
    [first_name] => Ajmal
    [last_name] => Akram
    [department] => CSE
    [email] => ajmalakram152@gmail.com
    [phone] => 7094653492
    [dob] => 2002-10-17
    [address] => TVK main road, Ammapet, Salem
    [gender] => male
    [blood_group] => B+
    [submit] => Submit
)
         */
        if (isset($_POST['submit'])) {
            //calculate age via dob
            // $dob = $_POST['dob'];
            // $dobDate = new DateTime($dob);
            $noow = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $now = $noow->format('Y-m-d H:i:s');
            // $age = $now->diff($dobDate);
            // $age = $age->y;

            //image handling through image function
            $targetFilePath = $this->image($_POST);

            $regno = 1;
            $user_type = 'ST00';
            $register_number = $user_type . $regno;
            // $type = if(usertype == admin? AD:ST);
            $getValues = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'user_type' => 'student',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
                'register_number' => $register_number,
                'firstname' => ucfirst(trim($_POST['first_name'])),
                'lastname' => ucfirst(trim($_POST['last_name'])),
                'department' => $_POST['department'],
                'gender' => $_POST['gender'],
                'image_path' => $targetFilePath,
                'dob' => $_POST['dob'],
                'blood_group' => $_POST['blood_group'],
                'email' => strtolower($_POST['email']),
                'mobile' => $_POST['mobile'],
                'address' => ucwords(trim($_POST['address']))
            ];
            $regno++;

            $insertedData = $this->studentModelObj->studentAdder($getValues);
            $regno = $insertedData;
            if (!$insertedData) {
                $error = "Student data not inserted";
                require_once('./view/error.php');
            } else {
                echo "DONE!";
                // echo "<h2>Inserted Successfully!</h2><script>window.location.href = 'http://localhost/college/index.php?mod=student&view=studentList';</script>";
                // header("Location:index.php?mod=student&view=studentList");
                // exit();
            }
            return $insertedData;
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
            $error = "Deleted unsuccessfully";
            require_once('./view/error.php');
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
        // if (file_exists("view/StudentEdit.php")) {
        //     require("view/StudentEdit.php");
        // } else {
        //     $error = "Edit file not included correctly";
        //     require_once('./view/error.php');
        // }
        $this->fileHandling($mvc = 'VIEW', $file = 'StudentEdit', $quer);
    }

    /**
     * updating value as in posted in the edit form
     * @return void
     */
    public function studentUpdate($request)
    {
        if (isset($_POST['submit'])) {
            //calculate age via dob
            // $dob = $_POST['dob'];
            // $dobDate = new DateTime($dob);
            $noow = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $now = $noow->format('Y-m-d H:i:s');
            // $age = $now->diff($dobDate);
            // $age = $age->y;

            //image handling through image function
            $targetFilePath = $this->image($_POST);
            // print_r($_POST);
            $gettedValues = [
                'user_id' => $_POST['user_id'],
                'username' => $_POST['username'],
                'user_type' => 'student',
                'status' => 'active',
                'created_at' => $_POST['created_at'],
                'updated_at' => $now,
                'register_number' => $_POST['register_number'],
                'firstname' => ucfirst(trim($_POST['firstname'])),
                'lastname' => ucfirst(trim($_POST['lastname'])),
                'department' => $_POST['department'],
                'gender' => $_POST['gender'],
                'image_path' => $targetFilePath,
                'dob' => $_POST['dob'],
                'blood_group' => $_POST['blood_group'],
                'email' => strtolower($_POST['email']),
                'mobile' => $_POST['mobile'],
                'address' => ucwords(trim($_POST['address']))
            ];

            if ($targetFilePath == NULL) {
                $targetFilePath = $_POST['profile'];
                $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath);
            } else {
                $msg = $this->studentModelObj->studentUpdate($gettedValues, $targetFilePath);
            }

            if (!$msg) {
                $error = "Not updated";
                require_once('./view/error.php');
            } else {
                // header("Refresh:1;url=index.php?mod=student&view=studentList");
                exit();
            }
        }
        // $gettedValues = $_POST;

        //image handling
        // $targetFilePath = $this->image($gettedValues);

        // $dob = $gettedValues['dob'];
        // $dobDate = new DateTime($dob);
        // $now = new DateTime();
        // $age = $now->diff($dobDate);
        // $age = $age->y;

    }

    /**
     * Searcing name, filtering by status and department
     * @return void
     */
    public function filter()
    {
        $department = isset($_POST['department']) ? $_POST['department'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';

        // get filtered students from the model
        $paginationData = $this->studentModelObj->getFilteredStudents($department, $status, $first_name);

        // $list = $paginationData['result'];
        // $total_pages = $paginationData['total_pages'];
        // $page = $paginationData['page'];
        // $num_results_on_page = $paginationData['num_results_on_page'];

        $adminName = $_SESSION['adminLoggedBy'];
        // if (file_exists('view/studentlist.php')) {
        //     require 'view/studentlist.php';
        // }
        $this->fileHandling($mvc = 'VIEW', $file = 'studentlist', $paginationData);

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
        // if (file_exists('./view/view.php')) {
        //     require('./view/view.php');
        // }
        $this->fileHandling($mvc = 'VIEW', $file = 'view', $viewQuer);

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