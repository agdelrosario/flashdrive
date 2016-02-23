<?php
	// PAGE DESCRIPTION: This page displays the form to add an image to a certain record.
	
	// Retrieves the logged user.
	$query = $this->Users->logged();
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Displays the header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display the upload image form.
		echo "<h1>Upload an image</h1>
		<p><b>Step two.</b> Upload a photo.</p>
		<div id='addImage'>" . form_open_multipart('add_controller/doUpload') . "
			<input type='file' name='userfile' />
			<p><input type='submit' value='Submit' name='submit' class='submit' /></p>" . form_close() . "
		</div>";
		
		// Display the footer.
		include('footer.php');
	}
?>