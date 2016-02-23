<?php
	// PAGE DESCRIPTION: This page displays all the search results for expired licenses.
	
	// Retrieve search results.
	$query = $_POST;
	
	// Retrieve logged user.
	$qu = $this->Users->logged();
	
	// Variable declaration.
	$month;
	$year;
	$day;
	$checker = 0;
	$counter = 0;
	$expired = 0;
	
	if ($qu->num_rows == 0) redirect ('main/');
	else {
		foreach ($qu->result() as $row) {
			if ($checker == 0) {				
				include("header.php");
				$role = $row->role;
				$username = $row->username;
				$checker = 1;
				include("sidebar.php");
				
				echo "<h1>Search by License Results</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database.
				if ($query->num_rows == 0) echo "<p>The database is empty.</p>";
				else {
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						$checker = 0;
						$ctr = 0;
						
						$string = strtok ($row2->license_exp, "-");
						while ($string != false) {
							if ($ctr == 0) $year = $string;
							else if ($ctr == 1) $month = $string;
							else if ($ctr == 2) $day = $string;
							$string = strtok("-");
							$ctr++;
						}
						
						if ($data['month'] == $month) {
							if ($data['year'] == $year) {
								if ($expired == 0) displayTableHeader();
								if ($expired % 2 == 0) echo "<tr class='altcolor1'>";
								else echo "<tr class='altcolor2'>";
								echo "<td style='padding: 10px;'>";
								
								$c = 1;
								
								// Checking if there are more than one ID number.
								if ($q->num_rows == 0) echo $row2->idnum;
								else {
									foreach ($q->result() as $row3) {
										if ($q->num_rows == $c) echo $row3->idno;
										$c++;
									}
								}
								
								echo "</td>
								<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row2->idnum . "'>" . $row2->surname . ", " . $row2->firstname . " " . $row2->midname . "</a></td>
								<td>" . $month . " " . $day . ", " . $year . "</td>
								<td style='text-align: right;'>";
								include('anchors3.php');
								echo "</td></tr>";
								$checker++;
								$ctr++;
								$expired++;
							}
						}
						
						$counter++;
					}
					
					if ($expired == 0) echo "<p>The database does not contain any record of a driver with a license like what you have searched for.</p>";
					else echo "</table><p>Total Results: <b>" . $expired . "</b></p>";
				}
				
				$checker++;
				
				include("footer.php");
			}
		}
	}
	
	function displayTableHeader() {
		echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
		<tr>
			<td width='10%'><b>ID #</b></td>
			<td width='45%''><b>Name</b></td>
			<td width='15%''><b>Expiration</b></td>
			<td width='30%' style='text-align: right;'>&nbsp;</td>
		</tr>";
	}
?>