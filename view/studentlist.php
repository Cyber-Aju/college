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
		body {
			background-color: white;
		}
	</style>
</head>

<body>
	<div class="parentlist">
		<div class="insert">
			<a class='yellowA' href="http://localhost/college/index.php?mod=student&view=studentAdd"><span
					class="label other">Add Student</span></a>
		</div>
		<div class="list">
			<div class="table">
				<?php
				if (is_array($list) && !empty($list)) {
					echo "<table border=0>
				<tr>
					<th>
						Id
					</th>
					<th>
						<div class='dropdown'>
						        <span>Student Name  &#x1F50D;</span>
						        <div class='dropdown-content'>
						            <form method='POST' action='http://localhost/college/index.php?mod=student&view=filter'>
						                <input type='hidden' name='mod' value='student'>
						                <input type='hidden' name='view' value='filter'>
										<input type='text' name='firstname' placeholder=' &#x1F50D; Search Name'>
										<button type='submit'>	Filter  </button>

						        </div>
						    </div>
					</th>
					<th>
					    <div class='dropdown'>
					        <span>Department  <select class='filterbtn'></select></span>
					        <div class='dropdown-content'>
					                <input type='hidden' name='mod' value='student'>
					                <input type='hidden' name='view' value='filter'>
					                <select name='department' onchange=''> <!-- this.form.submit()--->
					                    <option value=''>Select</option>
					                    <option value='CSE'>CSE</option>
					                    <option value='ECE'E>ECE</option>
					                    <option value='EEE'>EEE</option>
					                    <option value='MECH'>MECH</option>
					                    <option value='IT'>IT</option>
					                </select>
									<button type='submit'>Filter</button>
					        </div>
					    </div>
					</th>
								
					<th>
					    <div class='dropdown'>
					        <span>Status <select class='filterbtn'></select></span>
					        <div class='dropdown-content'>
					                <input type='hidden' name='mod' value='student'>
					                <input type='hidden' name='view' value='filter'>
					                <select name='status'>
					                    <option value=''>Select</option>
					                    <option value='Active'>Active</option>
					                    <option value='Not Active'>Not Active</option>
					                </select>
									<button type='submit'>Filter</button>
					            </form>
					        </div>
					    </div>
					</th>

					<th>
						Email
					</th>
					<th colspan='3'>
						Actions
					</th>
				<tr>";

					foreach ($list as $key => $value) {
						echo "<tr>
					<td>
						{$list[$key]['user_id']}
					</td>
					<td>
						<div class='tableRow'><div class='image'><img src='{$list[$key]['image_path']}' width=50 height=50></div><div class='name'><span style='text-transform:capitalize;'>{$list[$key]['firstname']} {$list[$key]['lastname']}</span></div></div>
					</td>
					<td>
						<span style='text-transform:uppercase;'>{$list[$key]['department']}<span>
					</td>
					<td>";
						if ($list[$key]['status'] == 'active') {
							echo "<span class='label labelSuccess'>Active</span>";
						} else {
							echo "<span class='label red'>Not Active</span>";
						}
						echo "</td>
					<td>
						{$list[$key]['email']}
					</td>
					<td>
						<a class='yellowA' href='http://localhost/college/index.php?mod=student&view=studentview&student_id={$list[$key]['user_id']}' ><span class='label yellow'>View &#x26F6;</span></a>
					</td>
					<td>
						<a class='edit' id='editStudent' onClick='return editStudent()' href='http://localhost/college/index.php?mod=student&view=studentEdit&student_id={$list[$key]['user_id']}'><span class='label blue'>&#128393;</span></a>
						
					</td>
					<td>
						<a class='del' id='deleteStudent' onClick='return deleteStudent()' href='http://localhost/college/index.php?mod=student&view=studentDelete&student_id={$list[$key]['user_id']}'><span class='label red'>␡</span></a>
					</td>
				<tr>";
					}
				} else {
					echo "<h2>No records found</h2> <button onclick='history.back()'>Go Back</button>";
				}
				?>
				</table>


				<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
					<ul class="pagination">
						<?php

						// base URL for pagination links
						$base_url = "index.php?mod=student&view=" . ($_GET['view'] === 'filter' ? 'filter' : 'studentlist');

						//previous Page Link
						if ($page > 1): ?>
							<li class="prev">
								<a href="<?php echo $base_url; ?>&page=<?php echo $page - 1; ?>">Prev</a>.
							</li>
						<?php endif; ?>

						<!-- Starting page link -->
						<?php if ($page > 3): ?>
							<li class="start"><a href="<?php echo $base_url; ?>&page=1">1</a></li>
							<li class="dots">...</li>
						<?php endif; ?>

						<!-- Previous Page Links -->
						<?php if ($page - 2 > 0): ?>
							<li class="page"><a
									href="<?php echo $base_url; ?>&page=<?php echo $page - 2; ?>"><?php echo $page - 2; ?></a>
							</li>
						<?php endif; ?>
						<?php if ($page - 1 > 0): ?>
							<li class="page"><a
									href="<?php echo $base_url; ?>&page=<?php echo $page - 1; ?>"><?php echo $page - 1; ?></a>
							</li>
						<?php endif; ?>

						<!-- Current Page -->
						<li class="currentpage"><a
								href="<?php echo $base_url; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

						<!-- Next Page Links -->
						<?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1): ?>
							<li class="page"><a
									href="<?php echo $base_url; ?>&page=<?php echo $page + 1; ?>"><?php echo $page + 1; ?></a>
							</li>
						<?php endif; ?>
						<?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1): ?>
							<li class="page"><a
									href="<?php echo $base_url; ?>&page=<?php echo $page + 2; ?>"><?php echo $page + 2; ?></a>
							</li>
						<?php endif; ?>

						<!-- Ending page link -->
						<?php if ($page < ceil($total_pages / $num_results_on_page) - 2): ?>
							<li class="dots">...</li>
							<li class="end"><a
									href="<?php echo $base_url; ?>&page=<?php echo ceil($total_pages / $num_results_on_page); ?>"><?php echo ceil($total_pages / $num_results_on_page); ?></a>
							</li>
						<?php endif; ?>

						<!-- Next Page Link -->
						<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
							<li class="next"><a href="<?php echo $base_url; ?>&page=<?php echo $page + 1; ?>">Next</a></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

			</div>

		</div>
	</div>

	<script src="./view/js/script.js"></script>
</body>

</html>