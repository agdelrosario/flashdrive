<?php
	// PAGE DESCRIPTION: This page is displayed when required fields are not filled on the addition of records.
	
	// Retrieve logged user.
	$query = $this->Users->logged();
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Displays the header and the sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// The content of the page.
		echo "<h1>Adding of record failed</h1>
		<p>You left required field/s empty. Click '&laquo; Back' to go back to the form you were filling. The information you filled are still there.</p>";
		
		// Displays the footer.
		include("footer.php");
	}
?>