<?php
	// PAGE DESCRIPTION: This page displays the verification form.
	
	// Retrieve flag if verification is successful or not.
	$query = $_POST;
	
	// Retrieve logged user.
	$q = $this->Users->logged();
	
	if ($q->num_rows == 0) {
		include("header.php");
		$checker = 0;
		include("sidebar.php");
		
		echo "<h1>Verification ";
		
		if ($query == 'success') echo "successful</h1>
			<p>Please <a href='" . base_url() . "index.php/main/'>log-in</a> now.</p>";
		else if ($query == 'fail') echo "failed</h1>
			<p>Please <a href='" . base_url() . "index.php/admin_controller/verify'>verify</a> your account again.</p>";
		
		// Display footer.
		include("footer.php");
	}
	else redirect('main/');
	
?>