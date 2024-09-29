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
		background-color:white;
		position:absolute;
	}
	.table
	{
		width:80%;
		#border: 1px solid red;
		margin:0 auto;
	}
	table {
		table-layout: fixed;
		width: 90%;
		border-collapse: collapse;
		#border: 3px solid purple;
		margin:0 auto;
	}
	th:nth-child(1) {
		width: 1%;
	}

	th:nth-child(2) {
		width: 25%;
	}

	th:nth-child(3) {
		width: 8%;
	}

	th:nth-child(4) {
		width: 5%;
	}

	th:nth-child(5) {
		width: 15%;
	}

	th:nth-child(6) {
		width: 3%;
	}

	th:nth-child(7) {
		width: 3%;
	}

	th:nth-child(8) {
		width: 3%;
	}

	th,
	td {
	  padding: 20px;
	}
	.image
	{
		float:left;
	}
	.image img
	{
		
		object-fit: cover;
	}
	.name
	{
		padding:15px 20px;
		float:left;
	}
	.fclear
	{
		clear:both;
	}
	.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
	
}
.labelSuccess
{
	background-color: #5cb85c;
}
.labelfailed
{
	background-color: red;
	text-decoration: none;
}
.other
{
	background-color:blue;
}
.del 
{	
	text-decoration: none;
}
.edit 
{
	text-decoration: none;
}
</style>
</head>
<body>
<div class="parent">
    <?php echo "<h2>Welcome back {$adminName} </h2>"; ?>
    <div class="logout"><a href='http://localhost/college/index.php?mod=admin&view=logout'>Logout</a></div>
	<div class="list">
		<div class="table">
			<table border=0>
				<tr>
					<th>
						Id
					</th>
					<th>
						Student Name
					</th>
					<th>
						Department
					</th>
					<th>
						status
					</th>
					<th>
						email
					</th>
					<th>
						
					</th>
					<th>
						
					</th>
					<th>
						
					</th>
				<tr>
			<?php
			foreach ($list as $key=>$value)
			{
				echo "<tr>
					<td>
						{$list[$key]['student_id']}
					</td>
					<td>
						<div class='tableRow'><div class='image'><img src='{$list[$key]['profile_image']}' width=50 height=50></div><div class='name'>{$list[$key]['first_name']} {$list[$key]['last_name']}</div></div>
					</td>
					<td>
						{$list[$key]['department']}
					</td>
					<td>";
						if($list[$key]['status']=='Active')
						{
							echo "<span class='label labelSuccess'>Active</span>";
						}
						else
						{
							echo "<span class='label labelfailed'>Not Active</span>";
						}
					echo "</td>
					<td>
						{$list[$key]['email']}
					</td>
					<td>
						<span class='label other'>view &#x26F6;</span>
					</td>
					<td>
						<a class='edit' href='http://localhost/college/index.php?mod=student&view=studentEdit&student_id={$list[$key]['student_id']}'><span class='label other'>&#128393;</span></a>
						
					</td>
					<td>
						<a class='del' href='http://localhost/college/index.php?mod=student&view=studentDelete&student_id={$list[$key]['student_id']}'><span class='label labelfailed'>␡</span></a>
					</td>
				<tr>";
            }
			?>
			</table>
		</div>
		<div align='center'>
        <button><a href="http://localhost/college/index.php?mod=student&view=studentAdd">Insert</a></button>
    </div>
	</div>
</div>
</body>
</html>
