<?php // PAGE DESCRIPTION: This page displays the view menu.

	// Retrieves logged user.
	$query = $_POST;
	
	// Variable declaration.
	$checker = 0;
	
	if ($query->num_rows == 0) redirect ('main/');
	else {
		foreach ($query->result() as $row) {
			if ($row->logged == 'true' && $checker++ == 0) displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		echo "<h1>Select a view feature</h1>
		<ul id='featureselection'>
			<li><a href='" . base_url() . "index.php/view_controller/requestView'>View all records</a></li>
			<li><a href='" . base_url() . "index.php/view_controller/requestViewExpLicense'>View records of drivers with expired licenses</a></li>
			<li><a href='" . base_url() . "index.php/view_controller/requestViewExpFranchise'>View records of drivers with expired franchises</a></li>
			<li><a href='" . base_url() . "index.php/view_controller/requestViewBlue'>View records of drivers with blue IDs</a></li>
			<li><a href='" . base_url() . "index.php/view_controller/requestViewYellow'>View records of drivers with yellow IDs</a></li>
		</ul>";

		include("footer.php");
	}
?>