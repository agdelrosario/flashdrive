<?php
	// PAGE DESCRIPTION: This page displays the search by ID form.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/');
	else {
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent($role, $username, $query) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
	
		$attr = array('id' => 'searchform', 'class' => 'searchform');
		echo Form_open('search_controller/requestSearchID',$attr); . "
		<h1>Search by ID Number</h1>
			<form name = \"searchform\" method = \"post\">
			<table id = \"searchtable\">
				<tr>
					<td>
						Enter id number: 
					</td>
					<td>
						<input type = \"text\" id = \"id\" name = \"id\" class = \"username\">
					</td>
					<td>
						<input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\">
					</td>
				</tr>
			</table>
		</form>";
		
		// Display footer.
		include("footer.php");
	}
?>