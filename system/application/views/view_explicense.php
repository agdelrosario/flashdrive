<?php
	// This page generates a table of all the records that have expired licenses in the database.
	$query = $_POST;
	
	// Retrieves currently logged user.
	$qu = $this->Users->logged();
	
	// Variable declaration.
	$checker = 0;
	$expired = 0;
	
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
				echo "<h1>View list of drivers with expired licenses</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database.
				if ($query->num_rows == 0) echo "<p>The database is empty.</p>";
				else {
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						$expired = displayContent($query, $counter, $q, $expired, $role);
						$counter++;
					}
					
					if ($expired == 0) echo "<p>There are no drivers with expired licenses in the database.</p>";
					else echo "</table><p>Total Results: <b>" . $expired . "</b></p>";
				}
				
				$checker++;
			}
		}
		
		include("footer.php");
	}
	
	function displayContent($query, $count, $q, $expired, $role) {
		$checker = 0;
		$counter = 0;
		$month;
		$day;
		$year;
		$current_year = date("Y");
		$current_month = date("m");
		$current_day = date("d");
		
		// Checking if the records in the database have expired licenses.
		foreach ($query->result() as $row) {
			if ($checker == $count) {
				$counter = 0;
				$string = strtok ($row->license_exp, "-");
				while ($string != false) {
					if ($counter == 0) $year = $string;
					else if ($counter == 1) $month = $string;
					else if ($counter == 2) $day = $string;
					$string = strtok("-");
					$counter++;
				}
				
				if ($current_year > $year) {
					if ($expired == 0) displayTableHeader();
					if ($expired % 2 == 0) echo "<tr class='altcolor1'>";
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
					echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
					echo "<td>" . $month . "/" . $day . "/" . $year . "</td>";
					echo "<td style='text-align: right;'>";
					include('anchors.php');
					echo "</td></tr>";
					
					$expired++;
				}
				else if ($current_year == $year) {
					if ($current_month > $month) {
						if ($expired == 0) displayTableHeader();
						if ($expired % 2 == 0) echo "<tr class='altcolor1'>";
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
						echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
						echo "<td>" . $month . "/" . $day . "/" . $year . "</td>";
						echo "<td style='text-align: right;'>";
						include('anchors.php');
						echo "</td>";
						echo "</tr>";
						
						$expired++;
					}
					else if ($current_month == $month) {
						if ($current_day < $day) {
							if ($expired == 0) displayTableHeader();
							if ($expired % 2 == 0) echo "<tr class='altcolor1'>";
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
							echo $row->surname . ", " . $row->firstname . " " . $row->midname . "</a></td>";
							echo "<td>" . $month . "/" . $day . "/" . $year . "</td>";
							echo "<td style='text-align: right;'>";
							include("anchors.php");
							echo "</td></tr>";
							
							$expired++;
						}
					}
				}
			}
		
			$checker++;
		}
		
		return $expired;
	}
	
	function displayTableHeader () {
		// Generation of the table and its headings.
		echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
		<tr>
			<td width='10%'><b>ID #</b></td>
			<td width='50%''><b>Name</b></td>
			<td width='10%''><b>Expiration</b></td>
			<td width='30%' style='text-align: right;'>&nbsp;</td>
		</tr>";
	}
?>