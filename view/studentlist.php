<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Student List's</h1>
    <table cellspacing="0" cellpadding="10" border="1" align="center">
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        // print_r($list);
        foreach ($list as $key=>$value)
        {
            echo "<tr>
            <td>{$list[$key]['student_id']}</td>
            <td>{$list[$key]['first_name']}</td>
            <td>{$list[$key]['last_name']}</td>
            <td>{$list[$key]['department']}</td>
            <td>{$list[$key]['email']}</td>
            <td><a href='http://localhost/college/index.php?mod=student&view=studentEdit&student_id={$list[$key]['student_id']}'>Edit</a></td>
            <td><a href='http://localhost/college/index.php?mod=student&view=studentDelete&student_id={$list[$key]['student_id']}'>Delete</a></td>
            </tr>";
        }
        ?>
    </table>
    <div align="center">
        <button><a href="http://localhost/college/index.php?mod=student&view=studentAdd">Insert</a></button>
    </div>
</body>
</html>