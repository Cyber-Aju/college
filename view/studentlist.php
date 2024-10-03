<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>Document</title>
<link rel="stylesheet" href="./view/css/styles.css"/>
<style>
	
</style>
</head>
<body>
<div class="parentlist">
    <?php echo "<h2>Welcome back <span class='adminname'> {$adminName} </span></h2>"; ?>
	
    <div class="logout"><a onClick = 'return logout()' href='http://localhost/college/index.php?mod=admin&view=logout'><span class="label other">Logout</span></a></div>
	<div class="insert">
       <a class='yellowA' href="http://localhost/college/index.php?mod=student&view=studentAdd"><span class="label other">Add Student</span></a>
    </div>
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
										<input type="text" name="first_name" placeholder=" &#x1F50D; Search Name">
										<button type="submit"><span class="label other">  	Filter  </span></button>
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
									<button type="submit"><span class="label other">Filter</span></button>
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
									<button type="submit"><span class="label other">Filter</span></button>
					            </form>
					        </div>
					    </div>
					</th>

					<th>
						Email
					</th>
					<th colspan="3">
						Actions
					</th>
					<!-- <th>
						
					</th>
					<th>
						
					</th> -->
				<tr>
			<?php
			foreach ($list as $key=>$value)
			{
				echo "<tr>
					<td>
						{$list[$key]['student_id']}
					</td>
					<td>
						<div class='tableRow'><div class='image'><img src='{$list[$key]['profile_image']}' width=50 height=50></div><div class='name'><span style='text-transform:capitalize;'>{$list[$key]['first_name']} {$list[$key]['last_name']}</span></div></div>
					</td>
					<td>
						<span style='text-transform:uppercase;'>{$list[$key]['department']}<span>
					</td>
					<td>";
						if($list[$key]['status']=='Active')
						{
							echo "<span class='label labelSuccess'>Active</span>";
						}
						else
						{
							echo "<span class='label red'>Not Active</span>";
						}
					echo "</td>
					<td>
						{$list[$key]['email']}
					</td>
					<td>
						<a class='yellowA' href='http://localhost/college/index.php?mod=student&view=studentview&student_id={$list[$key]['student_id']}' ><span class='label yellow'>View &#x26F6;</span></a>
					</td>
					<td>
						<a class='edit' id='editStudent' onClick='return editStudent()' href='http://localhost/college/index.php?mod=student&view=studentEdit&student_id={$list[$key]['student_id']}'><span class='label blue'>&#128393;</span></a>
						
					</td>
					<td>
						<a class='del' id='deleteStudent' onClick='return deleteStudent()' href='http://localhost/college/index.php?mod=student&view=studentDelete&student_id={$list[$key]['student_id']}'><span class='label red'>␡</span></a>
					</td>
				<tr>";
            }
			?>
			</table>
		</div>
		
	</div>
</div>

<script src="./view/js/script.js"></script>
</body>
</html>
