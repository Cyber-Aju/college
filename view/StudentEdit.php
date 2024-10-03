
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>studentAdd</title>
<link rel="stylesheet" href="./view/css/styles.css"/>

<style>
	
</style>
</head>
<body>
<div class="parent">
	<div class="formoutside">
	<form action="http://localhost/college/index.php?mod=student&view=studentUpdate" method="POST" enctype="multipart/form-data">
        <?php //print_r($quer);?>
	<p>Add Student</p>
	<div class="forminside">
        <div class="id">
            <label for="studentId">student Id </label>
            <input id="studentId" type="text" name="student_id" value="<?php echo "{$quer[0]['student_id']}"?>" required readonly>
        </div>
	<div class="fname">
		<label for="first_name">First Name</label>
        <input id="first_name" type="text" name="first_name" value="<?php echo "{$quer[0]['first_name']}"?>" required><br><br>
	</div>
	<div class="lname">
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" name="last_name" value="<?php echo "{$quer[0]['last_name']}"?>" required><br><br>
	</div>
	<div class="dept">
        <label for="department">Department</label>
        <input id="department" type="text" name="department" value="<?php echo "{$quer[0]['department']}"?>" required ><br><br>
	</div>
	<div class="email">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo "{$quer[0]['email']}"?>" required ><br><br>
	</div>
	<div class="phone">
        <label for="phone">Phone</label>
        <input id="phone" type="tel" name="phone" value="<?php echo "{$quer[0]['phone']}"?>" required> <br><br>
	</div>
	<div class="dob">
        <label for="dob" >DOB</label>
        <input id="dob" type="date" name="dob" value="<?php echo "{$quer[0]['dob']}"?>" required> <br><br>
	</div>
	<div class="address">
        <label for="address">Address</label>
        <input id="address" type="text" name="address" value="<?php echo "{$quer[0]['address']}"?>" required> <br><br>
	</div>
	<div class="status">
        <label for="status">Status</label>
        <input style="width:20px;" type="radio" id="Active" name="status" value="Active" <?php if ($quer[0]['status'] == 'Active') echo 'checked'; ?> />
        <label style="display:inline;" for="Active">Active</label>
        <input style="width:20px;" type="radio" id="Not_Active" name="status" value="Not Active" <?php if ($quer[0]['status'] == 'Not Active') echo 'checked'; ?> />
        <label style="display:inline;" for="Not_Active">Not Active</label> <br><br>
	</div>
	<div class="gender">
        <label for="gender">Gender</label>
		<select name="gender" id="gender">
		  <option value="Male" <?php if ($quer[0]['gender'] == 'Male') echo 'selected'; ?>>Male</option>
		  <option value="Female" <?php if ($quer[0]['gender'] == 'Female') echo 'selected'; ?>>Female</option>
		</select><br><br>
	</div>
    <div class="blood_grp">
        <label for="blood_group">Blood group</label>
		<select name="blood_group" id="blood_group">
		  <option value="A POSITIVE" <?php if ($quer[0]['blood_group'] == 'A POSITIVE') echo 'selected'; ?>>A POSITIVE (A+)</option>
		  <option value="A NEGATIVE" <?php if ($quer[0]['blood_group'] == 'A NEGATIVE') echo 'selected'; ?>>A NEGATIVE (A-)</option>
		  <option value="B POSITIVE" <?php if ($quer[0]['blood_group'] == 'B POSITIVE') echo 'selected'; ?>>B POSITIVE (B+)</option>
		  <option value="B NEGATIVE" <?php if ($quer[0]['blood_group'] == 'B NEGATIVE') echo 'selected'; ?>>B NEGATIVE (B-)</option>
		  <option value="O POSITIVE" <?php if ($quer[0]['blood_group'] == 'O POSITIVE') echo 'selected'; ?>>O POSITIVE (O+)</option>
		  <option value="O NEGATIVE" <?php if ($quer[0]['blood_group'] == 'O NEGATIVE') echo 'selected'; ?>>O NEGATIVE (O-)</option>
		  <option value="AB POSITIVE" <?php if ($quer[0]['blood_group'] == 'AB POSITIVE') echo 'selected'; ?>>AB POSITIVE (AB+)</option>
		  <option value="AB NEGATIVE" <?php if ($quer[0]['blood_group'] == 'AB NEGATIVE') echo 'selected'; ?>>AB NEGATIVE (AB-)</option>
		</select><br><br>
	</div>
	<div class="avatar">
        <label for="avatar">Choose a profile picture:</label>
		<img src="<?php echo $quer[0]['profile_image']; ?>" width=120 height=150>
        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required/> <br><br>
        <input type="submit" name="submit"><br><br>
	</div>
	<div class="fclear">
		
	</div>
	</div>
    </form>
	</div>
</div>
</body>
</html>
