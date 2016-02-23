<?php
	// PAGE DESCRIPTION: This page displays if the administrator tries to delete itself.
	
	if ($query->num_rows > 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		displayContent();
	}
	
	function displayContent() {
		// Display the header and the sidebar.
		include("header.php");
		$checker = 0;
		include("sidebar.php");
		
		// Display notice.
		echo "<h1>Sending password failed</h1>
		<p>Your username does not exist in the database.</p>";
		
		// Display footer.
		include("footer.php");
	}
?>