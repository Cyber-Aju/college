<?php
if (file_exists('./controller/basecontroller.php')) {
    require_once('./controller/basecontroller.php');
}

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
        $this->fileHandling($mvc = 'MODEL', $file = 'studentmodel', NULL);
        $this->studentModelObj = new StudentModel;
    }


    /**
     * fetch and display the list of students
     * @return void
     */
    public function studentList()
    {
        $paginationData = $this->studentModelObj->studentlistPagination();
        $this->fileHandling($mvc = 'VIEW', $file = 'studentlist', $paginationData);
    }

    /**
     * To add new students
     * 
     * @return bool
     */
    public function studentAdd()
    {
        $this->fileHandling($mvc = 'VIEW', $file = 'StudentAdd', NULL);

        if (isset($_POST['submit'])) {
            $currentDate = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $now = $currentDate->format('Y-m-d H:i:s');
            $dob = new DateTime($_POST['dob']);
            $age = $currentDate->diff($dob)->y;
            if ($age > 17) {
                $isDob = $_POST['dob'];
            } else {
                echo "<script>alert('Age should be above 17')</script>";
            }

            //image handling through image function
            $targetFilePath = $this->image($_POST);

            $regno = 1;
            $user_type = 'ST00';
            $register_number = $user_type . $regno;
            $getValues = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
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
                'dob' => $isDob,
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
                $this->error($error);
            } else {
                $message = 'Inserted';
                $this->success($message);
                echo "<h2>Inserted Successfully!</h2><script>window.location.href = 'http://localhost/college/index.php?mod=student&view=studentList';</script>";
                // header("Location:index.php?mod=student&view=studentList");
                exit();
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
            $this->error($error);
        } else {
            $message = 'deleted';
            $this->success($message);
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
        $this->fileHandling($mvc = 'VIEW', $file = 'StudentEdit', $quer);
    }

    /**
     * updating value as in posted in the edit form
     * @return void
     */
    public function studentUpdate($request)
    {
        if (isset($_POST['submit'])) {
            $currentDateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $now = $currentDateTime->format('Y-m-d H:i:s');

            //image handling through image function
            $targetFilePath = $this->image($_POST);
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
                $this->error($error);
            } else {
                $message = 'Updated';
                $this->success($message);
                header("Refresh:1;url=index.php?mod=student&view=studentList");
                exit();
            }
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
            $student_name = $getValues['firstname'];
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
                $this->error($error);
            }
        }
        return null;
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