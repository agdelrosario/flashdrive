<?php
	// This page generates a table of all the records in the database.
	$query = $_POST;
	
	// Retrieves currently logged user.
	$qu = $this->Users->logged();
	
	// Variable declaration.
	$checker = 0;
	
	// Checking if the is a logged user. If there is none, redirect to main controller.
	if ($qu->num_rows == 0) redirect ('main/');
	else {
		foreach ($qu->result() as $row) {
			if ($checker == 0) {
				include("header.php");
				$role = $row->role;
				$username = $row->username;
				$checker = 1;
				include("sidebar.php");
				echo "<h1>View All</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database. If there are records, the records are printed.
				if ($query->num_rows == 0) echo "<p>The database is empty.</p>";
				else {
					foreach ($query->result() as $row2) {
						if ($counter == 0) {
							// Generation of the table and its headings.
							echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
							<tr>
								<td width='10%'><b>ID #</b></td>
								<td width='40%''><b>Name</b></td>
								<td width='50%' style='text-align: right;'>&nbsp;</td>
							</tr>";
						}
						
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						displayContent($query, $counter, $q, $row->role);
						$counter++;
					}
					
					echo "</table><p>Total number of records: <b>" . $query->num_rows . "</b></p>";
				}
				
				$checker++;
				
				include("footer.php");
			}
		}
	}
	
	function displayContent($query, $count, $q, $role) {
		// Accessing and printing of the fetched data.
		$checker = 0;
		
		foreach ($query->result() as $row) {
			if ($checker == $count) {
				if ($checker % 2 == 0) echo "<tr class='altcolor1'>";
				else echo "<tr class='altcolor2'>";
				echo "<td style='padding: 10px;'>";
				
				$counter = 1;
				
				// Checking if there are more than one ID number.
				if ($q->num_rows == 0) echo $row->idnum;
				else {
					foreach ($q->result() as $row2) {
						if ($q->num_rows == $counter) echo $row2->idno;
						$counter++;
					}
				}
				
				echo "</td>";
				echo "<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row->idnum . "'>";
				echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>\n";
				echo "<td style='text-align: right;'>";
				include("anchors.php"); // Printing of the "Add Violation | Edit" anchors on the table.
				echo "</td></tr>";
			}
			
			$checker++;
		}	
	}
?>