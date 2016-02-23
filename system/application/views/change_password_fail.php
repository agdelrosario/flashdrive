<?php 
	// PAGE DESCRIPTION: This page displays if the password enterred in the old password field does not match the current password when changing the password.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display the header and the sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display notice.
		echo "<h1>Change password attemp failed</h1>
		<p>You did not enter correctly the old password. Please <a href='" . base_url() . "index.php/admin_controller/changePassword'>try</a> again.</p>";
		
		// Display footer.
		include("footer.php");
	}
?>