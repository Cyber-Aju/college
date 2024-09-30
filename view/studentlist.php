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
.logout
{
	float:right;
	padding-right:20px;
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 80px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 5px 7px;
  z-index: 1;
}

.dropdown-content p a
{
  text-decoration: none;
}

.dropdown:hover .dropdown-content {
  display: block;
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
						<div class="dropdown">
						        <span>Student Name</span>
						        <div class="dropdown-content">
						            <form method="GET" action="http://localhost/college/index.php?mod=student&view=filter">
						                <input type="hidden" name="mod" value="student">
						                <input type="hidden" name="view" value="filter">
										<input type="text" name="first_name">
										<button type="submit">Filter</button>
						            <!-- </form> -->
						        </div>
						    </div>
					</th>
					<th>
					    <div class="dropdown">
					        <span>Department</span>
					        <div class="dropdown-content">
					            <!-- <form method="GET" action="http://localhost/college/index.php?mod=student&view=filter"> -->
					                <input type="hidden" name="mod" value="student">
					                <input type="hidden" name="view" value="filter">
					                <select name="department" onchange=""> <!-- this.form.submit()--->
					                    <option value="">Select</option>
					                    <option value="CSE">CSE</option>
					                    <option value="ECE">ECE</option>
					                    <option value="EEE">EEE</option>
					                    <option value="MECH">MECH</option>
					                    <option value="IT">IT</option>
					                </select>
									<button type="submit">Filter</button>
					            <!-- </form> -->
					        </div>
					    </div>
					</th>
								
					<th>
					    <div class="dropdown">
					        <span>Status</span>
					        <div class="dropdown-content">
					            <!-- <form method="GET" action="http://localhost/college/index.php?mod=student&view=filter"> -->
					                <input type="hidden" name="mod" value="student">
					                <input type="hidden" name="view" value="filter">
					                <select name="status" onchange="this.form.submit()">
					                    <option value="">Select</option>
					                    <option value="Active">Active</option>
					                    <option value="Not Active">Not Active</option>
					                </select>
									<button type="submit">Filter</button>
					            </form>
					        </div>
					    </div>
					</th>

					<th>
						Email
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
						<a href='http://localhost/college/index.php?mod=student&view=studentview&student_id={$list[$key]['student_id']}' ><span class='label other'>view &#x26F6;</span></a>
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
