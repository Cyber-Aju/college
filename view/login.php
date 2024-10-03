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
	<script src="./view/js/script.js"></script>
</head>

<body>
	<div class="parent">
		<div class="form">
			<div class="formHeader">
				<!-- <img src="./view/img/loginheader1.png"> -->
				<p>Admin Login</p>
			</div>
			<div class="formBody">
				<form method="POST" action="http://localhost/college/index.php?mod=admin&view=adminvalidation">
					<label for="email">Email</label><br>
					<input id="email " type="email" name="email" maxlength="30" required> <br>
					<label for="password">Password</label><br>
					<input id="password " type="password" name="password" minlength="8" required> <br>
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