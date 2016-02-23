<?php
	// PAGE DESCRIPTION: This page asks if the administrator is sure on deleting a user.
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			if ($row->role != "upf") displayContent($row->role, $row->username);
			else redirect('main/');
		}
	}
	
	function displayContent($role, $username) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display notice.
		echo "<h1>Delete " . $data['username'] . "</h1>
		<p>Are you sure you wanted to delete this user?
		[<a href='" . base_url() . "index.php/admin_controller/requestDelete/" . $data['username'] . "'>Yes</a>]
		[<a href='" . base_url() . "index.php/admin_controller/viewUsers'>No</a>]</p>";
		
		// Display footer.
		include("footer.php");
	}
?>