<?php
	// PAGE DESCRIPTION: This page displays the search results.
	
	// Retrieve search results.
	$query = $_POST;
	
	// Retrieve logged user.
	$qu = $this->Users->logged();
	$checker = 0;
	
	if ($qu->num_rows == 0) redirect ('main/');
	else {
		foreach ($qu->result() as $row) {
			if ($checker == 0) {
				include("header.php");
				$role = $row->role;
				$username = $row->username;
				$checker = 1;
				include("sidebar.php");
			
				echo "<h1>Search Results</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database.
				if ($query->num_rows == 0) echo "<p>The database does not contain what you have searched for.</p>";
				else {
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						displayContent($query, $counter, $q, $role);
						$counter++;
					}
					
					echo "</table><p>Total Results: <b>" . $query->num_rows . "</b></p>";
				}
				
				$checker++;
				
				include("footer.php");
				
				$checker++;
			}
		}
	}
	
	function displayContent ($query, $counter, $q, $role) {
		$checker = 0;
		
		if ($query->num_rows == 0) echo "<p></p>";
		else {
			
			foreach ($query->result() as $row) {
				if ($checker == $counter) {
					if ($counter == 0) displayTableHeader();
					if ($checker % 2 == 0) echo "<tr class='altcolor1'>";
					else echo "<tr class='altcolor2'>";
					
					echo "<td style='padding: 10px;'>";
					
					$c = 1;
					
					// Checking if there are more than one ID number.
					if ($q->num_rows == 0) echo $row->idnum;
					else {
						foreach ($q->result() as $row8) {
							if ($q->num_rows == $c) echo $row8->idno;
							$c++;
						}
					}
					
					echo "</td><td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row->idnum . "'>";
					echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
					echo "<td style='text-align: right;'>";
					include("anchors.php");
					echo "</td></tr>";
				}
				$checker++;
			}
		}
	}
	
	function displayTableHeader() {
		echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
		<tr>
			<td width='10%'><b>ID #</b></td>
			<td width='50%''><b>Name</b></td>
			<td width='40%' style='text-align: right;'>&nbsp;</td>
		</tr>";
	}
?>