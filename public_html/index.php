<?php
	include 'inc/header.php';
	include 'inc/class.epa.php';
	$epa = new Epa();
	
	if (strlen($_REQUEST['zip']) > 4) {
		$zip_code_req = (int) trim($_REQUEST['zip']);
		$result_data = $epa->get_by_zip($zip_code_req);
	}
?>		
		<div class="container" id="searchBar">
			<div class="row">
				<div class="span1">
					<img src="img/search@2x.png" alt="Search" />
				</div>
				<div class="span11">
					<h1>See if water quality issues exist in your area.</h1>
					<p>Enter your zip code. <span class="muted">(Initial results may take a few seconds to load.)</span></p>
					<form class="form-search" method="post" action="/">
						<input type="text" class="input-large search-query" name="zip" value="<?php echo $zip_code_req ?>" />
						<button type="submit" class="btn btn-medium"><i class="icon-search"></i> Search</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="span12">
					<?php
					if (strlen($zip_code_req) > 4) {
						if (is_array($result_data) && count($result_data) > 0) {
							echo '<h1>Requested Zip Code: ' . $zip_code_req . "</h1>\n";
							echo '<table class="table table-striped">';
							echo "<tr>\n";
							echo '<th>Facility Name</th>';
							echo '<th>County Served</th>';
							echo '<th>Contaminant</th>';
							echo '<th>Health Effects</th>';
							echo '<th>Sources</th>';
							echo "</tr>\n";
							foreach ($result_data as $k => $v) {
								//print_r($v); // Uncomment to display all data
								echo "<tr>\n";
								echo '<td>' . $v['PWSNAME'] . "</td>\n"; // Display a single column
								echo '<td>' . $v['COUNTYSERVED'] . "</td>\n";
								echo '<td>' . $v['CNAME'] . "</td>\n";
								echo '<td>' . $v['HEALTH_EFFECTS'] . "</td>\n";
								echo '<td>' . $v['SOURCES'] . "</td>\n";
								echo "</tr>\n";
								echo "<tr>\n";
								echo '<td colspan="5">' . $v['DEFINITION'] . "</td>\n";
								echo "</tr>\n";
							}
							echo '</table>';
						} else {
							echo '<h1>No data was available.</h1>';
						}
					}
					
					?>
				</div>
			</div>
		</div>
		
		<div>
			
			
		</div>
<?php include 'inc/footer.php'; ?>