<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>Document</title>
<style>
	body
	{
		margin:0px;
		padding:0px;
	}
	.parent
	{
		width:1535px;
		height:690px;
		background-color:#073763;
		position:absolute;
        #margin-top:250px;
	}
	.child
	{
		width:40%;
		height:80%;
		background-color:white;
		margin:50px auto;
		padding:20px;
		border-radius:10px;
	}
	.child p
	{
		
		text-align:center;
		font-size:20px;
	}
	.child div
	{
		padding:10px;
	}
	.profile
	{
		float:left;
		width:40%
		height:40%;
		#background-color:yellow;
        overflow:hidden;
	}
    .profile img
    {
        width:80%;
        margin-left:25px;
    }
	.block 
	{
		width:40%;
		float:left;
	}
	.otherdetails
	{
		width:40%;
		float:left;
	}
	.academic
	{
		width:40%;
		float:left;
	}
    .back
    {
        width:50%;
        margin:0px auto;
        float:bottom;
    }
</style>
</head>
<body>
<div class="parent">
	<div class="child">
		<p>Student Details </p>
		<div class="profile">
			<img src="<?php echo "{$viewQuer[0]['profile_image']}"?>">
		</div>
		<div class="block">Personal Details
			<div class="sid">
			Student Id : <?php echo $viewQuer[0]['student_id']?>
			</div >
			<div class="fname">
				First Name : <?php echo $viewQuer[0]['first_name']?>
			</div>
			<div class="lname">
				Last Name : <?php echo $viewQuer[0]['last_name']?>
			</div>
			<div>
			Age : <?php echo $viewQuer[0]['age']?>
			</div>
			<div>
			Gender : <?php echo $viewQuer[0]['gender']?>
			</div>
			<div>
				DOB : <?php echo $viewQuer[0]['dob']?>
			</div>
		</div>
		<div class="academic"> Academic information:
		<div>
			Department : <?php echo $viewQuer[0]['department']?>
		</div>
		<div>
			Status : <?php echo $viewQuer[0]['status']?>
		</div>
		</div>
		<div class="otherdetails"> Contact Information:
		<div>
			Email : <?php echo $viewQuer[0]['email']?>
		</div>
		<div>
			Phone : <?php echo $viewQuer[0]['phone']?>
		</div>
		<div>
			Address : <?php echo $viewQuer[0]['address']?>
		</div>
		<div>
			Blood Group : <?php echo $viewQuer[0]['blood_group']?>
		</div>
		</div>
        <div class="back">
            <button><a href="http://localhost/college/index.php?mod=student&view=studentlist">Go back</a></button>
        </div>
	</div>
</div>
</body>
</html>
