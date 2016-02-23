<?php
	// PAGE DESCRIPTION: This page displays the search by license form.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/');
	else {
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent($role, $username, $query) {
		include("header.php");
		$checker = 1;
		include("sidebar.php");
	
		$data = array('id' => 'searchform', 'class' => 'searchform');
		echo form_open('search_controller/requestSearchLicense',$data);
		
		echo "<h1>Search by License</h1>
		<form name = \"searchform\" method = \"post\">
			<table id = \"searchtable\">
				<tr>
					<td>Enter parameter:</td>
					<td>
						
					</td>
					<td>
						<select name='year'>";
		
		// Generate year from three years from now until 1930.
		for ($i = date("Y") + 3; $i>1929; $i--) { 
			echo "<option>$i</option>\n"; 
		}
		
		echo "			</select>
					</td>
					<td><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\"></td>
				</tr>
			</table>
			</form>";
			
		// Display footer.
		include("footer.php");
	}
?>