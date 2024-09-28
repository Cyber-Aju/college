<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="http://localhost/college/index.php?mod=student&view=studentUpdate" method="POST" align="center">
        <?php //print_r($quer);?>
        <label>student Id </label>
        <input type="text" name="student_id" value="<?php echo "{$quer[0]['student_id']}"?>" required>
        <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo "{$quer[0]['first_name']}"?>" required><br><br>
        <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo "{$quer[0]['last_name']}"?>" required><br><br>
        <label>Department</label>
        <input type="text" name="department" value="<?php echo "{$quer[0]['department']}"?>" required ><br><br>
        <label>Email</label>
        <input type="" name="email" value="<?php echo "{$quer[0]['email']}"?>" required ><br><br>
        <input type="radio" id="Active" name="status" value="Active" />
        <label for="Active">Active</label>
        <input type="radio" id="Not_Active" name="status" value="Not_active" />
        <label for="Not_Active">Not Active</label>
        <input type="submit" name="submit"><br><br>

    </form>
</body>
</html>