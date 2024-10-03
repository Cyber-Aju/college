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
        $total_pages = $this->connect->query('SELECT COUNT(*) FROM personal')->fetch()[0];
        // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        // Number of results to show on each page.
        $num_results_on_page = 5;

        $query = 'SELECT 
                    * 
                  FROM 
                    personal p 
                  JOIN academic a 
                        ON p.student_id = a.student_id 
                  JOIN contact c 
                        ON p.student_id = c.student_id 
                  LIMIT 
                    :limitt 
                  OFFSET
                    :offset';
        if ($stmt = $this->connect->prepare($query)) {
            // Calculate the page to get the results we need from our table.
            $calc_page = ($page - 1) * $num_results_on_page;
            $stmt->bindParam(':offset', $calc_page, PDO::PARAM_INT);
            $stmt->bindParam(':limitt', $num_results_on_page, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $all = array('total_pages' => $total_pages, 'page' => $page, 'num_results_on_page' => $num_results_on_page, 'result' => $result);
            return $all;
        }
    }

    /**
     * fetch students from student table
     * @return array
     */
    public function studentlist()
    {
        $list = $this->connect->prepare("
            SELECT 
                p.student_id, 
                p.first_name, 
                p.last_name, 
                p.age, 
                p.gender, 
                p.profile_image,
                p.dob, 
                p.blood_group, 
                c.email, 
                c.phone, 
                c.address, 
                a.department, 
                a.status
            FROM 
                personal p
            JOIN contact c 
                ON p.student_id = c.student_id
            JOIN academic a 
                ON p.student_id = a.student_id
            WHERE 
                a.status = :status || a.status = 'Not Active'
        ");

        $status = "Active";
        $list->bindParam(":status", $status);
        $list->execute();
        return $list->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * add a new student and related details into the database.
     * @param mixed $getValues
     * @param mixed $targetFilePath
     * @param mixed $age
     * @return bool
     */
    public function studentAdder($getValues, $targetFilePath, $age)
    {
        try {
            //inserting into personal table
            $personalQuery = $this->connect->prepare("
                INSERT INTO personal (
                    first_name, last_name, age, gender, 
                    profile_image, dob, blood_group
                    ) 
                VALUES 
                    (
                    :first_name, :last_name, :age, :gender, 
                    :profile_image, :dob, :blood_group
                    )
            ");
            $personalQuery->bindParam(':first_name', $getValues['first_name']);
            $personalQuery->bindParam(':last_name', $getValues['last_name']);
            $personalQuery->bindParam(':age', $age);
            $personalQuery->bindParam(':gender', $getValues['gender']);
            $personalQuery->bindParam(':profile_image', $targetFilePath);
            $personalQuery->bindParam(':dob', $getValues['dob']);
            $personalQuery->bindParam(':blood_group', $getValues['blood_group']);
            $personalQuery->execute();
            $student_id = $this->connect->lastInsertId(); // Get the last inserted student_id

            //inserting into contact table
            $contactQuery = $this->connect->prepare("
                INSERT INTO contact (
                    student_id, email, phone, address
                    ) 
                VALUES (
                    :student_id, :email, :phone, :address
                    )
            ");
            $contactQuery->bindParam(':student_id', $student_id);
            $contactQuery->bindParam(':email', $getValues['email']);
            $contactQuery->bindParam(':phone', $getValues['phone']);
            $contactQuery->bindParam(':address', $getValues['address']);
            $contactQuery->execute();

            //inserting into academic table
            $academicQuery = $this->connect->prepare("
                INSERT INTO academic (
                    student_id, department, status
                    ) 
                VALUES (
                    :student_id, :department, :status
                    )
            ");
            $academicQuery->bindParam(':student_id', $student_id);
            $academicQuery->bindParam(':department', $getValues['department']);
            $academicQuery->bindParam(':status', $getValues['status']);
            $academicQuery->execute();
            return true;
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
        $update = $this->connect->prepare("UPDATE academic
                                                  SET status = '2'
                                                  WHERE student_id = :id");
        $update->bindParam(':id', $id);
        $update->execute();
        return $update;
    }

    /**
     * update student in Database
     * @param mixed $gettedValues
     * @param mixed $targetFilePath
     * @param mixed $age
     * @return bool
     */
    public function studentUpdate($gettedValues, $targetFilePath, $age)
    {
        $student_id = $gettedValues['student_id'];
        try {
            //updating personal table
            $personalQuery = $this->connect->prepare("
                UPDATE 
                    personal 
                SET 
                    first_name = :first_name, 
                    last_name = :last_name, 
                    age = :age, 
                    gender = :gender,
                    profile_image = :profile_image,
                    dob = :dob, 
                    blood_group = :blood_group
                WHERE 
                    student_id = :student_id
            ");
            $personalQuery->bindParam(':first_name', $gettedValues['first_name']);
            $personalQuery->bindParam(':last_name', $gettedValues['last_name']);
            $personalQuery->bindParam(':age', $age);
            $personalQuery->bindParam(':gender', $gettedValues['gender']);
            $personalQuery->bindParam(':profile_image', $targetFilePath);
            $personalQuery->bindParam(':dob', $gettedValues['dob']);
            $personalQuery->bindParam(':blood_group', $gettedValues['blood_group']);
            $personalQuery->bindParam(':student_id', $student_id);
            $personalQuery->execute();

            //updating contact table
            $contactQuery = $this->connect->prepare("
                UPDATE 
                    contact 
                SET 
                    email = :email, 
                    phone = :phone, 
                    address = :address
                WHERE 
                    student_id = :student_id
            ");
            $contactQuery->bindParam(':email', $gettedValues['email']);
            $contactQuery->bindParam(':phone', $gettedValues['phone']);
            $contactQuery->bindParam(':address', $gettedValues['address']);
            $contactQuery->bindParam(':student_id', $student_id);
            $contactQuery->execute();

            //updating academic table
            $academicQuery = $this->connect->prepare("
                UPDATE 
                    academic 
                SET 
                    department = :department, 
                    status = :status
                WHERE 
                    student_id = :student_id
            ");
            $academicQuery->bindParam(':department', $gettedValues['department']);
            $academicQuery->bindParam(':status', $gettedValues['status']);
            $academicQuery->bindParam(':student_id', $student_id);
            $academicQuery->execute();
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
    public function particularShow($id)
    {
        $selectIdQuery = $this->connect->prepare("
            SELECT 
                p.student_id, 
                p.first_name, 
                p.last_name, 
                p.age, 
                p.gender,
                p.profile_image, 
                p.dob, 
                p.blood_group, 
                c.email, 
                c.phone, 
                c.address, 
                a.department, 
                a.status
            FROM 
                personal p
            JOIN contact c 
                ON p.student_id = c.student_id
            JOIN academic a 
                ON p.student_id = a.student_id
            WHERE 
                p.student_id = :id
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
                p.student_id, 
                p.first_name, 
                p.last_name, 
                p.age, 
                p.gender,
                p.profile_image, 
                p.dob, 
                p.blood_group, 
                c.email, 
                c.phone, 
                c.address, 
                a.department, 
                a.status
            FROM 
                personal p
            JOIN contact c 
                ON p.student_id = c.student_id
            JOIN academic a 
                ON p.student_id = a.student_id
            WHERE 1=1 
        ";

        if (!empty($department)) {
            $getAll .= " && a.department = :department";
        }
        if (!empty($status)) {
            $getAll .= " && a.status = :status";
        }
        if (!empty($first_name)) {
            $getAll .= " && p.first_name LIKE :first_name";
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
                    FROM personal p 
                    JOIN academic a 
                        ON p.student_id = a.student_id 
                    WHERE 1=1 ";

        if (!empty($department)) {
            $getAll .= " AND a.department = :department";
        }
        if (!empty($status)) {
            $getAll .= " AND a.status = :status";
        }
        if (!empty($first_name)) {
            $getAll .= " AND p.first_name LIKE :first_name";
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