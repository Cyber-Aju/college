<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>studentEdit</title>
	<link rel="stylesheet" href="./view/css/styles.css" />
	<script src="./view/js/studentForm.js"></script>
</head>

<body>
	<?PHP print_r($quer); ?>
	<div class="parent">
		<div class="formoutside">
			<form action="index.php?mod=student&view=studentUpdate" method="POST" enctype="multipart/form-data"
				onSubmit="return validateStudentForm()">
				<p>Edit a Student</p>
				<div class="forminside">
					<div class="id">
						<label for="studentId">student Id </label>
						<input id="studentId" type="text" name="user_id" value="<?php echo "{$quer[0]['user_id']}" ?>"
							required readonly>
					</div>
					<div class="register_number">
						<label for="register_number">Register number</label>
						<input id="register_number" type="text" name="register_number"
							value="<?php echo "{$quer[0]['register_number']}" ?>" required readonly>
						<input id="created_at" type="hidden" name="created_at"
							value="<?php echo "{$quer[0]['created_at']}" ?>" readonly>
					</div>
					<div class="username">
						<label for="username">username</label>
						<input id="username" type="text" name="username" value="<?php echo "{$quer[0]['username']}" ?>"
							required>
					</div>
					<!-- <div class="password">
						<label for="password">Password</label>
						<input id="password" type="password" name="password"
							value="<? php// echo "{$quer[0]['password']}" ?>" required>
					</div> -->
					<div class="fname">
						<label for="firstname">First Name</label>
						<input id="firstname" type="text" name="firstname"
							value="<?php echo "{$quer[0]['firstname']}" ?>" required><br><br>
					</div>
					<div class="lname">
						<label for="lastname">Last Name</label>
						<input id="lastname" type="text" name="lastname" value="<?php echo "{$quer[0]['lastname']}" ?>"
							required><br><br>
					</div>
					<div class="dept">
						<label for="department">Department</label>
						<input id="department" type="text" name="department"
							value="<?php echo "{$quer[0]['department']}" ?>"><br><br>
					</div>
					<div class="email">
						<label for="email">Email</label>
						<input id="email" type="email" name="email" value="<?php echo "{$quer[0]['email']}" ?>"
							required><br><br>
					</div>
					<div class="mobile">
						<label for="mobile">Mobile</label>
						<input id="mobile" type="tel" name="mobile" value="<?php echo "{$quer[0]['mobile']}" ?>"
							required>
						<br><br>
					</div>
					<div class="dob">
						<label for="dob">DOB</label>
						<input id="dob" type="date" name="dob" value="<?php echo "{$quer[0]['dob']}" ?>" required>
						<br><br>
					</div>
					<div class="address">
						<label for="address">Address</label>
						<input id="address" type="text" name="address" value="<?php echo "{$quer[0]['address']}" ?>"
							required> <br><br>
					</div>
					<!-- <div class="status">
						<label for="status">Status</label>
						<input style="width:20px;" type="radio" id="Active" name="status" value="Active" <? php// if ($quer[0]['status'] == 'Active')
							//echo 'checked'; ?> />
						<label style="display:inline;" for="Active">Active</label>
						<input style="width:20px;" type="radio" id="Not_Active" name="status" value="Not Active" <? php// if ($quer[0]['status'] == 'Not Active')
							//echo 'checked'; ?> />
						<label style="display:inline;" for="Not_Active">Not Active</label> <br><br>
					</div> -->
					<div class="gender">
						<label for="gender">Gender</label>
						<select name="gender" id="gender" class="selectData">
							<option value="Male" <?php if ($quer[0]['gender'] == 'Male')
								echo 'selected'; ?>>Male</option>
							<option value="Female" <?php if ($quer[0]['gender'] == 'Female')
								echo 'selected'; ?>>Female
							</option>
						</select><br><br>
					</div>
					<div class="blood_grp">
						<label for="blood_group">Blood group</label>
						<select name="blood_group" id="blood_group" class="selectData">
							<option value="A+" <?php if ($quer[0]['blood_group'] == 'A+')
								echo 'selected'; ?>>A
								POSITIVE (A+)</option>
							<option value="A-" <?php if ($quer[0]['blood_group'] == 'A-')
								echo 'selected'; ?>>A
								NEGATIVE (A-)</option>
							<option value="B+" <?php if ($quer[0]['blood_group'] == 'B+')
								echo 'selected'; ?>>B
								POSITIVE (B+)</option>
							<option value="B-" <?php if ($quer[0]['blood_group'] == 'B-')
								echo 'selected'; ?>>B
								NEGATIVE (B-)</option>
							<option value="O+" <?php if ($quer[0]['blood_group'] == 'O+')
								echo 'selected'; ?>>O
								POSITIVE (O+)</option>
							<option value="O-" <?php if ($quer[0]['blood_group'] == 'O-')
								echo 'selected'; ?>>O
								NEGATIVE (O-)</option>
							<option value="AB+" <?php if ($quer[0]['blood_group'] == 'AB+')
								echo 'selected'; ?>>AB
								POSITIVE (AB+)</option>
							<option value="AB-" <?php if ($quer[0]['blood_group'] == 'AB-')
								echo 'selected'; ?>>AB
								NEGATIVE (AB-)</option>
						</select><br><br>
					</div>
					<div class="avataredit">
						<label for="avatar">Update a profile picture:</label>
						<img src="<?php echo $quer[0]['image_path']; ?>" width=120 height=150 alt="currentImage">
						<input type="hidden" id="profile" name="profile" value="<?php echo $quer[0]['image_path']; ?>">
						<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" /> <br><br>
						<input onClick="return update()" type="submit" name="submit"><br><br>
					</div>
					<div class="fclear">
						<div class="backadd">
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