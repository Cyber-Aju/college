<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>studentAdd</title>
	<link rel="stylesheet" href="./view/css/styles.css" />
	<script src="./view/js/studentForm.js"></script>
</head>

<body>
	<div class="parent">
		<div class="formoutside">
			<form action="index.php?mod=student&view=studentAdd" method="POST" enctype="multipart/form-data"
				onSubmit="return validateStudentForm()">
				<p>Add Student</p>
				<div class="forminside">
					<div class="username">
						<label for="username">Username</label>
						<input id="username" type="text" name="username" required><br><br>
					</div>
					<div class="password">
						<label for="password">Password</label>
						<input id="password" type="password" name="password" required><br><br>
					</div>
					<div class="re-password">
						<label for="re-password">Re-Password</label>
						<input id="re-password" type="password" name="re-password" required><br><br>
					</div>
					<div class="fname">
						<label for="first_name">First name</label>
						<input id="first_name" type="text" name="first_name" required><br><br>
					</div>
					<div class="lname">
						<label for="last_name">Last name</label>
						<input id="last_name" type="text" name="last_name" required><br><br>
					</div>
					<div class="dept">
						<label for="department">Department</label>
						<select name="department" id="department" class="selectData">
							<option value="">Select</option>
							<option value="CSE">CSE</option>
							<option value="ECE">ECE</option>
							<option value="EEE">EEE</option>
							<option value="MECH">MECH</option>
							<option value="IT">IT</option>
						</select><br><br>
					</div>
					<div class="email">
						<label for="email">Email</label>
						<input id="email" type="email" name="email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
							required><br><br>
					</div>
					<div class="phone">
						<label for="phone">Mobile</label>
						<input id="phone" type="tel" name="mobile" required> <br><br>
					</div>
					<div class="dob">
						<label for="dob">DOB</label>
						<input id="dob" type="date" name="dob" required> <br><br>
					</div>
					<div class="address">
						<label for="address">Address</label>
						<input id="address" type="textarea" name="address" required> <br><br>
					</div>
					<div class="gender">
						<label for="gender">Gender</label>
						<select name="gender" id="gender" class="selectData">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select><br><br>
					</div>
					<div class="blood_grp">
						<label for="blood_group">Blood group</label>
						<select name="blood_group" id="blood_group" class="selectData">
							<option value="">select</option>
							<option value="A+">A POSITIVE (A+)</option>
							<option value="A-">A NEGATIVE (A-)</option>
							<option value="B+">B POSITIVE (B+)</option>
							<option value="B-">B NEGATIVE (B-)</option>
							<option value="O+">O POSITIVE (O+)</option>
							<option value="O-">O NEGATIVE (O-)</option>
							<option value="AB+">AB POSITIVE (AB+)</option>
							<option value="AB-">AB NEGATIVE (AB-)</option>
						</select><br><br>
					</div>
					<div class="avatar">
						<label for="avatar">Choose a profile picture:</label>
						<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" /> <br><br>
						<input type="submit" name="submit"><br><br>
					</div>
					<div class="fclear">
						<div class="back">
							<a class="label other" href="index.php?mod=student&view=studentlist">Go
								back</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>