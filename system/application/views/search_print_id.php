<?php
	// PAGE DESCRIPTION: This page generates a table of all the records that have blue colored IDs in the database.
	
	// Retrieve all records of drivers in the database.
	$this->load->database();
	$query = $this->db->get('drivers', '*');
	
	// ID number.
	$d = $_POST;
	
	// Retrieves currently logged user.
	$this->db->where('logged', "true");
	$qu = $this->db->get('user', '*');
	
	// Variable declaration.
	$checker = 0;
	$blue = 0;
	
	// Checking if there is a logged user.
	if ($qu->num_rows == 0) redirect ('main/');
	else {
		foreach ($qu->result() as $row) {
			if ($checker == 0) {
				include("header.php");
				$role = $row->role;
				$username = $row->username;
				$checker = 1;
				include("sidebar.php");
				
				echo "<h1>Search by ID results</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database.
				if ($query->num_rows == 0) echo "<p>The database is empty.</p>";
				else {
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						$blue = displayContent($query, $blue, $d, $counter, $q, $role);
						$counter++;
					}
					
					if ($blue == 0) echo "<p>There are no drivers with blue IDs in the database.</p>";
					else echo "</table><p>Total Results: <b>" . $blue . "</b></p>";
				}
				
				$checker++;
				
				include("footer.php");
			}
		}
	}
	
	function displayContent($query, $blue, $d, $count, $q, $role) {
		$checker = 0;
		$bluecheck = 0;
		
		// Checking if the records in the database have blue IDs.
		foreach ($query->result() as $row) {	
			if ($checker == $count) {
				if ($d == $row->idnum) {
					if ($blue == 0) displayTableHeader();
				
					if ($blue % 2 == 0) echo "<tr class='altcolor1'>";
					else echo "<tr class='altcolor2'>";
					
					echo "<td style='padding: 10px;'>";
					
					$c = 1;
					
					// Checking if there are more than one ID number.
					if ($q->num_rows == 0) echo $row->idnum;
					else {
						foreach ($q->result() as $row2) {
							if ($q->num_rows == $c) echo $row2->idno;
							$c++;
						}
					}
					
					echo "</td>";
					echo "<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row->idnum . "'>";
					echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
					echo "<td style='text-align: right;'>";
					include('anchors.php');
					echo "</td></tr>";
					
					$bluecheck++;
				}
				else {
					$counter = 0;
					$i = 0;
					
					// Checking if there are more than one ID number.
					if ($q->num_rows != 0) {
						foreach ($q->result() as $row4) {
							if ($row4->idno == $d) {
								if ($blue == 0) displayTableHeader();
								
								foreach ($query->result() as $row3) {
									if ($counter == $i) {
				
										if ($blue % 2 == 0) echo "<tr class='altcolor1'>";
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
										
										echo "</td>";
										echo "<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row->idnum . "'>";
										echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
										echo "<td style='text-align: right;'>";
										include('anchors.php');
										echo "</td></tr>";
									}
									
									$i++;
								}
							
								$bluecheck++;
							}
							
							$counter++;
						}
					}
				}
			}
			
			$checker++;
		}
		
		//echo "<br />[" . $bluecheck . "] ^^^" . $blue . "^^^";
		if ($bluecheck > 0) $blue++;
		return $blue;
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