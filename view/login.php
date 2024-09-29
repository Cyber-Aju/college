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
	:root {
		--primary:# #f8b133-yellow
		# #d22635-reddish
		# #073763-blue
		# #be1e55 -pink
	}
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
	}
	.form
	{
		background-color:white;
		width:25%;
		height:80%;
		margin:0px auto;
		position:relative;
		top:55px;
		border-radius:10px;
	}
	.formHeader
	{
		#border:1px solid red;
		background-image:url("./view/img/loginheader1.png");
		background-size: 100%;
		height:154.5px;
		padding:10px;
	}
	.formHeader
	{
		color:white;
		font-size:35px;
		text-align:center;
	}
	.formBody
	{
		#border:1px solid purple;
		padding:10px 25px;
	}
	.formBody input
	{
		padding:8px;
		width:300px;
		margin-bottom:20px;
	}
	.formBody label
	{
		display:block;
	}
	.formFooter
	{
		#border:1px solid blue;
		padding:10px;
		text-align:center;
	}
</style>
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
				<input id="email "type="email" name="email" maxlength="30" required> <br>
				<label for="password">Password</label><br>
				<input id="password "type = "password" name="password" minlength="8" required>  <br>
				<input class="submitbtn" type="submit">
			</form>
		</div>
		<div class="formFooter">
			Forget Password
		</div>
	</div>
</div>
</body>
</html>
