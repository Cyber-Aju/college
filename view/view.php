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
	<?php //print_r($viewQuer); ?>
	<div class="parent">
		<div class="child">
			<p>Student Details </p>
			<div>
				<div class="profile">
					<img src="<?php echo "{$viewQuer[0]['image_path']}" ?>" alt="" width=80 height=230>
				</div>
				<div class="personal"><span class="subhead">Personal Details</span>
					<div class="sid">
						Student Id : <?php echo $viewQuer[0]['user_id'] ?>
					</div>
					<div class="fnamev">
						Name : <?php echo $viewQuer[0]['firstname'] ?> <?php echo $viewQuer[0]['lastname'] ?>
					</div>
					<div class="agev">
						<?php $dob = $viewQuer[0]['dob'];
						$dobDate = new DateTime($dob);
						$now = new DateTime();
						$age = $now->diff($dobDate);
						$age = $age->y; ?>
						Age : <?php echo $age ?>
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
					Phone : <?php echo $viewQuer[0]['mobile'] ?>
				</div>
				<div class="addressv">
					Address : <?php echo $viewQuer[0]['address'] ?>
				</div>
			</div>

			<div class="back"><?php
			if (isset($_SESSION['previous_page']) && isset($_GET['login']) && $_GET['login'] === 'student') {
				// If coming from the previous page and login was successful
				echo "<a class='' href=''></a>";
				unset($_SESSION['previous_page']);  // Clear after using
			
			} else if (!isset($_GET['login'])) {
				// If login was not set, show a generic back button
				echo "<a class='label other' href='http://localhost/college/index.php?mod=student&view=studentlist'>Go back</a>";
			}
			?>


			</div>
		</div>
	</div>
</body>

</html>