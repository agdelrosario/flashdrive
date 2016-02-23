<?php
	// PAGE DESCRIPTION: This page displays the search by name form.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/');
	else {
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent ($role, $username, $query) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");

		$attr = array('id' => 'searchform', 'class' => 'searchform');
		echo form_open('search_controller/requestSearch', $attr);
		
		echo "<h1>Search by Surname</h1>
		<form name = \"searchform\" method = \"post\">
		<table id = \"searchtable\">
			<tr>
				<td>Enter surname:</td>
				<td><input type = \"text\" id = \"sname\" name = \"sname\" class = \"username\"></td>
				<td><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\"></td>
			</tr>
		</table>
		</form>";
		
		include("footer.php");
	}
?>