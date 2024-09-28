<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="http://localhost/college/index.php?mod=student&view=studentAdd" method="POST" align="center">
        <label>First Name</label>
        <input type="text" name="first_name" required><br><br>
        <label>Last Name</label>
        <input type="text" name="last_name" required><br><br>
        <label>Department</label>
        <input type="text" name="department" required ><br><br>
        <label>email</label>
        <input type="email" name="email" required ><br><br>
        <label>status</label> 
        <div>
        <input type="radio" id="Active" name="status" value="Active" />
        <label for="Active">Active</label>
        <input type="radio" id="Not_Active" name="status" value="Not_active" />
        <label for="Not_Active">Not Active</label>
        <input type="submit" name="submit"><br><br>
    </form>
</body>
</html>