
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>studentAdd</title>
<style>
	body
	{
		margin:0px;
		padding:0px;
	}
	.parent
	{
        margin-top:500px;
		width:1535px;
		height:690px;
		#background-color:#073763;
		position:absolute;
	}
	.formoutside form
	{
		background-color:white;
		width:50%;
		margin:0px auto;
		padding:20px;
	}
	.formoutside p
	{
		text-align:center;
		font-size:20px;
	}
	.forminside input
	{
		padding:8px;
		width:300px;
		margin-bottom:20px;
	}
	.forminside label
	{
		display:block;
	}
	.fname
	{
		width:50%;
		float:left;
	}
	.lname
	{
		width:50%;
		float:right;
	}
	.dept
	{
		width:50%;
		float:left;
	}
	.email
	{
		width:50%;
		float:right;
	}
	.phone
	{
		width:50%;
		float:left;
	}
	.dob
	{
		width:50%;
		float:right;
	}
	.address
	{
		width:50%;
		float:left;
	}
	.gender
	{
		width:50%;
		float:right;
	}
	.status
	{
		width:50%;
		float:left;
		display:inline;
		padding:unset;
		margin:unset;
	}
	.avatar
	{
		width:50%;
		float:right;
	}
	.fclear
	{
		clear:both;
	}
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
            <input id="studentId" type="text" name="student_id" value="<?php echo "{$quer[0]['student_id']}"?>" required>
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
        <input id="status" type="radio" id="Active" name="status" value="<?php echo "{$quer[0]['status']}"?>" />
        <label for="Active">Active</label>
        <input type="radio" id="Not_Active" name="status" value="<?php echo "{$quer[0]['status']}"?>" />
        <label for="Not_Active">Not Active</label> <br><br>
	</div>
	<div class="gender">
        <label for="gender">Gender</label>
		<select name="gender" id="gender">
		  <option value="<?php echo "{$quer[0]['gender']}"?>">Male</option>
		  <option value="<?php echo "{$quer[0]['gender']}"?>">Female</option>
		</select><br><br>
	</div>
    <div class="blood_grp">
        <label for="blood_group">Blood group</label>
		<select name="blood_group" id="blood_group">
		  <option value="<?php echo "{$quer[0]['blood_group']}"?>">B POSITIVE</option>
		  <option value="<?php echo "{$quer[0]['blood_group']}"?>">A POSITIVE</option>
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
