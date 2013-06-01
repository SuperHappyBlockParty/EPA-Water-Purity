<?php
	include 'inc/header.php';
	include 'inc/class.epa.php';
	$epa = new Epa();
	
	if (strlen($_REQUEST['zip']) > 4) {
		$result_data = $epa->get_by_zip($_REQUEST['zip']);	
	}
?>		
		<div class="container" id="searchBar">
			<div class="row">
				<div class="span1">
					<img src="img/search@2x.png" alt="Search" />
				</div>
				<div class="span11">
					<h1>See if water quality issues exist in your area.</h1>
					<p>Enter your zip code:</p>
					<form class="form-search" method="post" action="">
						<input type="text" class="input-large search-query">
						<button type="submit" class="btn btn-medium"><i class="icon-search"></i> Search</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="span12">
					
				</div>
			</div>
		</div>
		
		<div>
			<?php
			foreach ($result_data as $k => $v) {
				echo $v[''];
			}
			
			?>
		</div>
<?php include 'inc/footer.php'; ?>