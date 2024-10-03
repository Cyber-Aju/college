<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>Document</title>
	<link rel="stylesheet" href="./view/css/styles.css" />
	<style>

	</style>
</head>

<body>
	<div class="parent">
		<div class="child">
			<p>Student Details </p>
			<div>
				<div class="profile">
					<img src="<?php echo "{$viewQuer[0]['profile_image']}" ?>" alt="" width=80 height=230>
				</div>
				<div class="personal"><span class="subhead">Personal Details</span>
					<div class="sid">
						Student Id : <?php echo $viewQuer[0]['student_id'] ?>
					</div>
					<div class="fnamev">
						Name : <?php echo $viewQuer[0]['first_name'] ?> <?php echo $viewQuer[0]['last_name'] ?>
					</div>
					<div class="agev">
						Age : <?php echo $viewQuer[0]['age'] ?>
					</div>
					<div class="genderv">
						Gender : <?php echo $viewQuer[0]['gender'] ?>
					</div>
					<div class="dobv">
						DOB : <?php echo $viewQuer[0]['dob'] ?>
					</div>
					<div class="blood_groupv">
						Blood Group : <?php echo $viewQuer[0]['blood_group'] ?>
					</div>
				</div>
			</div>
			<div class="academic"> <span class="subhead">Academic information:</span>
				<div class="departmentv">
					Department : <?php echo $viewQuer[0]['department'] ?>
				</div>
				<div class="statusv">
					Status : <?php echo $viewQuer[0]['status'] ?>
				</div>
			</div>
			<div class="otherdetails"> <span class="subhead">Contact Information:</span>
				<div class="emailv">
					Email : <?php echo $viewQuer[0]['email'] ?>
				</div>
				<div class="phonev">
					Phone : <?php echo $viewQuer[0]['phone'] ?>
				</div>
				<div class="addressv">
					Address : <?php echo $viewQuer[0]['address'] ?>
				</div>
			</div>
			<div class="back">
				<a class="label other" href="http://localhost/college/index.php?mod=student&view=studentlist">Go
					back</a>
			</div>
		</div>
	</div>
</body>

</html>