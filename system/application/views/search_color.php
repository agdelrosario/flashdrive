<?php
	// PAGE DESCRIPTION: This page displays the search by color form.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent($role, $username, $query) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
	
		// Display form.
		$attr = array('id' => 'searchform', 'class' => 'searchform');
		echo form_open('search_controller/requestSearchColor', $attr) . "
		<h1>Search by ID color</h1>
		<form name = \"searchform\" method = \"post\">
		<table id = \"user\" withd='100%'>
			<tr>
				<td width='25%'>Enter surname:</td>
				<td width='25%'><input type = \"text\" id = \"surname\" name = \"surname\" class = \"username\"></td>
				<td width='50%'>&nbsp;</td>
			</tr>
			<tr>
				<td>Select ID color:</td>
				<td>
					<select name='color'>
						<option value='blue'>Blue</option>
						<option value='yellow'>Yellow</option>
					</select>
				</td>
				<td width='50%'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan='2' align='center'><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\"></td>
				<td width='50%'>&nbsp;</td>
			</tr>
		</table>
		</form>";
		
		// Display the footer.
		include("footer.php");
	}
?>