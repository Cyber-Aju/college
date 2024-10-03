
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
	<form action="http://localhost/college/index.php?mod=student&view=studentAdd" method="POST" enctype="multipart/form-data">
	<p>Add Student</p>
	<div class="forminside">
	<div class="fname">
		<label for="first_name">First Name</label>
        <input id="first_name" type="text" name="first_name" required><br><br>
	</div>
	<div class="lname">
        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" name="last_name" required><br><br>
	</div>
	<div class="dept">
        <label for="department">Department</label>
        <!-- <input id="department" type="text" name="department" required ><br><br> -->

		<select name="department" id="department" class="selectData">
		<option value="CSE">CSE</option>
		  <option value="ECE" >ECE</option>
		  <option value="EEE" >EEE</option>
		  <option value="MECH" >MECH</option>
		  <option value="IT" >IT</option>
		</select><br><br>
	</div>
	<div class="email">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required ><br><br>
	</div>
	<div class="phone">
        <label for="phone">Phone</label>
        <input id="phone" type="tel" name="phone" required> <br><br>
	</div>
	<div class="dob">
        <label for="dob" >DOB</label>
        <input id="dob" type="date" name="dob" required> <br><br>
	</div>
	<div class="address">
        <label for="address">Address</label>
        <input id="address" type="text" name="address" required> <br><br>
	</div>
	<div class="status">
        <label for="status">Status</label> 
        <input style="width:20px;" type="radio" id="Active" name="status" value="Active" />
        <label style="display:inline;" for="Active">Active</label>
        <input style="width:20px;"type="radio" id="Not_Active" name="status" value="Not_active" />
        <label style="display:inline;" for="Not_Active">Not Active</label> <br><br>
	</div>
	<div class="gender">
        <label for="gender">Gender</label>
		<select name="gender" id="gender">
		  <option value="male">Male</option>
		  <option value="female">Female</option>
		</select><br><br>
	</div>
    <div class="blood_grp">
        <label for="blood_group">Blood group</label>
		<select name="blood_group" id="blood_group">
		<option value="A POSITIVE">A POSITIVE (A+)</option>
		  <option value="A NEGATIVE" >A NEGATIVE (A-)</option>
		  <option value="B POSITIVE" >B POSITIVE (B+)</option>
		  <option value="B NEGATIVE" >B NEGATIVE (B-)</option>
		  <option value="O POSITIVE" >O POSITIVE (O+)</option>
		  <option value="O NEGATIVE" >O NEGATIVE (O-)</option>
		  <option value="AB POSITIVE">AB POSITIVE (AB+)</option>
		  <option value="AB NEGATIVE">AB NEGATIVE (AB-)</option>
		</select><br><br>
	</div>
	<div class="avatar">
        <label for="avatar">Choose a profile picture:</label>
        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" /> <br><br>
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
