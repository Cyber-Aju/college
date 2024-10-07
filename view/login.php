<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>Login</title>
	<link rel="stylesheet" href="./view/css/styles.css" />
	<script src="./view/js/login.js"></script>
</head>

<body>
	<div class="parent">
		<div class="form">
			<div class="formHeader">
				<!-- <img src="./view/img/loginheader1.png"> -->
				<p>Login</p>
			</div>
			<div class="formBody">
				<form method="POST" action="http://localhost/college/index.php?mod=login&view=validation"
					onsubmit="return validateForm()">
					<label for="username">Username</label><br>
					<input id="username " type="text" name="username" maxlength="30" required> <br>
					<label for="password">Password</label><br>
					<input id="password " type="password" name="password" minlength="8"
						pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_]).{8,}" required> <br>
					<input class="submitbtn" type="submit">
				</form>
			</div>
			<div class="formFooter">
				<!-- <a class="forget" href="#">Forget Password</a> -->
			</div>
		</div>
	</div>

</body>

</html>