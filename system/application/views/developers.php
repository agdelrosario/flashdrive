<?php
	// PAGE DESCRIPTION: This page displays information about the developers.
	
	// Retrieves logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");

		// Display information.
		echo "<h1>Developers</h1>
		<p>This web application is developed by CMSC 128 AB-2L Group 2 (2nd Semester A.Y. 2010-2011) students in service for the Institute of Computer Science and the Office of the Vice Chancellor for Community Affairs as partial fulfillment of their requirements for the CMSC 128 (Introduction to Software Engineering) course.</p>
		<p>Following are the members of the developer team:</p>
		<table width='100%'>
			<tr>
				<td width='20%'>Team Leader</td>
				<td width='80%'>
					<b>Aletheia Grace D. del Rosario</b><br />
					BS Computer Science<br />
					aletheia.delrosario@gmail.com
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Members</td>
				<td>
					<b>Jerome R. Vila</b><br />
					BS Computer Science<br />
					jeromeriveravila@gmail.com
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<b>Kevin Glen Duque</b><br />
					BS Computer Science<br />
					kevinglenduque@gmail.com
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<b>Dexter Allen S. Galvez</b><br />
					BS Computer Science<br />
					dexterallengalvez@gmail.com
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<b>Kimberly Mae P. Velasquez</b><br />
					BS Computer Science<br />
					kmpvelasquez@gmail.com
				</td>
			</tr>
		</table>
		<p>Please feel free to contact any of the members of the developer team for maintainance of the web application.</p>";
		
		// Display footer.
		include("footer.php");
	}
?>