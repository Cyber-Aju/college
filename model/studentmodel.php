<?php
$PDOConnect = "./common/connection.php";
if (file_exists($PDOConnect)) {
    require($PDOConnect);
} else {
    echo "Not Connected";
}

class StudentModel extends Connection
{
    public function __construct()
    {
        $this->connect = $this->connect();
    }

    /**
     * get a paginated list of students with their details.
     * @return array
     */
    public function studentlistPagination()
    {
        // Get the total number of records from our table "students".
        $total_pages = $this->connect->query('SELECT COUNT(*) FROM user')->fetch()[0];
        // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        // Number of results to show on each page.
        $num_results_on_page = 5;

        $query = 'SELECT 
                    * 
                  FROM 
                    user u 
                  JOIN user_details ud 
                        ON u.user_id = ud.r_user_id 
                  WHERE 
                        u.user_type = :user_type AND u.status = :status
                  LIMIT 
                    :limitt 
                  OFFSET
                    :offset';
        if ($stmt = $this->connect->prepare($query)) {
            // Calculate the page to get the results we need from our table.
            $calc_page = ($page - 1) * $num_results_on_page;
            $stmt->bindValue(':user_type', "student");
            $stmt->bindValue(':status', "active");
            $stmt->bindParam(':offset', $calc_page, PDO::PARAM_INT); //'Active'
            $stmt->bindParam(':limitt', $num_results_on_page, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $all = array('total_pages' => $total_pages, 'page' => $page, 'num_results_on_page' => $num_results_on_page, 'result' => $result);
            return $all;
        }
    }


    /**
     * add a new student and related details into the database.
     * @param mixed $getValues
     * @param mixed $targetFilePath
     * @param mixed $age
     * @return bool
     */
    public function studentAdder($getValues)
    {
        try {
            //inserting into personal table
            $personalQuery = $this->connect->prepare("
                INSERT INTO user (
                    username, password, user_type, status, 
                    created_at, updated_at, register_number
                    ) 
                VALUES 
                    (
                    :username, :password, :user_type, :status, 
                    :created_at, :updated_at, :register_number
                    )
            ");
            $password = md5($getValues['password']);
            $personalQuery->bindParam(':username', $getValues['username']);
            $personalQuery->bindParam(':password', $password);
            $personalQuery->bindParam(':user_type', $getValues['user_type']);
            $personalQuery->bindParam(':status', $getValues['status']);
            $personalQuery->bindParam(':created_at', $getValues['created_at']);
            $personalQuery->bindParam(':updated_at', $getValues['updated_at']);
            $personalQuery->bindParam(':register_number', $getValues['register_number']);
            $personalQuery->execute();
            $user_id = $this->connect->lastInsertId(); // Get the last inserted student_id


            //inserting into contact table
            $contactQuery = $this->connect->prepare("
                INSERT INTO user_details (
                    r_user_id, firstname, lastname, dob, gender, email, mobile, address, blood_group, image_path, department
                    ) 
                VALUES (
                    :r_user_id, :firstname, :lastname, :dob, :gender, :email, :mobile, :address, :blood_group, :image_path, :department
                    )
            ");
            $contactQuery->bindParam(':r_user_id', $user_id);
            $contactQuery->bindParam(':firstname', $getValues['firstname']);
            $contactQuery->bindParam(':lastname', $getValues['lastname']);
            $contactQuery->bindParam(':dob', $getValues['dob']);
            $contactQuery->bindParam(':gender', $getValues['gender']);
            $contactQuery->bindParam(':email', $getValues['email']);
            $contactQuery->bindParam(':mobile', $getValues['mobile']);
            $contactQuery->bindParam(':address', $getValues['address']);
            $contactQuery->bindParam(':blood_group', $getValues['blood_group']);
            $contactQuery->bindParam(':image_path', $getValues['image_path']);
            $contactQuery->bindParam(':department', $getValues['department']);
            $contactQuery->execute();

            return $user_id;
        } catch (Exception $e) {
            echo "Failed to store in DB: " . $e->getMessage();
            return false;
        }
    }

    /**
     *     soft delete student by setting their status to not active in the academic table.
     * @param mixed $id
     * @return bool|PDOStatement
     */
    public function studentDelete($id)
    {
        try {
            $update = $this->connect->prepare("UPDATE user
            SET status = 'inactive'
            WHERE user_id = :id");
            $update->bindParam(':id', $id);
            $update->execute();
            return $update;
        } catch (Exception $e) {
            echo "Failed to delete in DB: " . $e->getMessage();
            return false;
        }

    }

    /**
     * update student in Database
     * @param mixed $gettedValues
     * @param mixed $targetFilePath
     * @param mixed $age
     * @return bool
     */
    public function studentUpdate($gettedValues, $targetFilePath)
    {
        $user_id = $gettedValues['user_id'];
        try {
            // Updating the `user` table
            $personalQuery = $this->connect->prepare("
            UPDATE user 
            SET username = :username, 
                register_number = :register_number,
                updated_at = :updated_at
            WHERE user_id = :user_id
        ");
            $personalQuery->bindParam(':username', $gettedValues['username']);
            $personalQuery->bindParam(':register_number', $gettedValues['register_number']);
            $personalQuery->bindParam(':updated_at', $gettedValues['updated_at']);
            $personalQuery->bindParam(':user_id', $user_id);
            $personalQuery->execute();

            // Updating the `user_details` table
            $contactQuery = $this->connect->prepare("
            UPDATE user_details 
            SET firstname = :firstname, lastname = :lastname, dob = :dob, 
                gender = :gender, email = :email, mobile = :mobile, 
                address = :address, blood_group = :blood_group, image_path = :image_path 
            WHERE r_user_id = :r_user_id
        ");
            $contactQuery->bindParam(':firstname', $gettedValues['firstname']);
            $contactQuery->bindParam(':lastname', $gettedValues['lastname']);
            $contactQuery->bindParam(':dob', $gettedValues['dob']);
            $contactQuery->bindParam(':gender', $gettedValues['gender']);
            $contactQuery->bindParam(':email', $gettedValues['email']);
            $contactQuery->bindParam(':mobile', $gettedValues['mobile']);
            $contactQuery->bindParam(':address', $gettedValues['address']);
            $contactQuery->bindParam(':blood_group', $gettedValues['blood_group']);
            $contactQuery->bindParam(':image_path', $targetFilePath);
            $contactQuery->bindParam(':r_user_id', $user_id);
            $contactQuery->execute();

            return true;
        } catch (Exception $e) {
            echo "Failed to update: " . $e->getMessage();
            return false;
        }
    }


    /**
     * Select particular student using id
     * @param mixed $id
     * @return array
     */
    /**
     * Select particular student using id from the new tables.
     * @param mixed $id
     * @return array
     */
    public function particularShow($id)
    {
        $selectIdQuery = $this->connect->prepare("
        SELECT 
            u.user_id, 
            u.username, 
            u.register_number,
            u.user_type, 
            u.status, 
            u.created_at, 
            u.updated_at, 
            ud.firstname, 
            ud.lastname, 
            ud.dob, 
            ud.gender, 
            ud.email, 
            ud.mobile, 
            ud.address, 
            ud.blood_group, 
            ud.image_path,
            ud.department 
        FROM 
            user u
        JOIN user_details ud 
            ON u.user_id = ud.r_user_id
        WHERE 
            u.user_id = :id
    ");
        $selectIdQuery->bindParam(':id', $id);
        $selectIdQuery->execute();
        return $selectIdQuery->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * filter based on department status and searching names
     * @param mixed $department
     * @param mixed $status
     * @param mixed $first_name
     * @return array
     */
    public function getFilteredStudents($department, $status, $first_name)
    {
        $getAll = "
            SELECT 
            u.user_id, 
            u.username, 
            u.register_number,
            u.user_type, 
            u.status, 
            u.created_at, 
            u.updated_at, 
            ud.firstname, 
            ud.lastname, 
            ud.dob, 
            ud.gender, 
            ud.email, 
            ud.mobile, 
            ud.address, 
            ud.blood_group, 
            ud.image_path,
            ud.department 
        FROM 
            user u
        JOIN user_details ud 
            ON u.user_id = ud.r_user_id
        WHERE u.user_type = 'student' 
        ";


        if (!empty($department)) {
            $getAll .= " AND ud.department = :department";
        }
        if (!empty($status)) {
            $getAll .= " AND u.status = :status";
        }
        if (!empty($first_name)) {
            $getAll .= " AND ud.first_name LIKE :first_name";
        }

        $getAll .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->connect->prepare($getAll);

        if (!empty($department)) {
            $stmt->bindParam(':department', $department);
        }
        if (!empty($status)) {
            $stmt->bindParam(':status', $status);
        }
        if (!empty($first_name)) {
            // $a = $first_name;
            $first_name = $first_name . '%';
            $stmt->bindParam(':first_name', $first_name);
        }
        $page = 1;
        $num_results_on_page = 5;

        $calc_page = ($page - 1) * $num_results_on_page;
        $stmt->bindParam(':limit', $num_results_on_page, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $calc_page, PDO::PARAM_INT);

        $stmt->execute();
        $total_pages = $this->getTotalFilteredRecords($department, $status, $first_name);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $all = array('total_pages' => $total_pages, 'page' => $page, 'num_results_on_page' => $num_results_on_page, 'result' => $result);
        return $all;
    }


    /**
     * filter pagination
     * @param mixed $department
     * @param mixed $status
     * @param mixed $first_name
     * @return mixed
     */
    public function getTotalFilteredRecords($department, $status, $first_name)
    {
        $getAll = "SELECT 
                        COUNT(*) as total 
                    FROM user u
                    JOIN user_details ud 
                        ON u.user_id = ud.r_user_id 
                    WHERE 1=1 ";

        if (!empty($department)) {
            $getAll .= " AND ud.department = :department";
        }
        if (!empty($status)) {
            $getAll .= " AND u.status = :status";
        }
        if (!empty($first_name)) {
            $getAll .= " AND ud.first_name LIKE :first_name";
            $first_name .= '%';
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
        return $stmt->fetchColumn();
    }


    // __call magic method to handle if invalid function called.
    public function __call($name, $arguments)
    {
        echo "Calling Wrong method '$name' <br>";
    }
}
?>