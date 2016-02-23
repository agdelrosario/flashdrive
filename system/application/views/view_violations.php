<?php
	// This page generates a table of violation records of a certain driver.	
	$query = $_POST;
	
	$q = $this->Users->logged();
	$checker = 0;
	$data = 0;
	
	foreach ($q->result() as $row) {
		if ($checker == 0) {
			$data = array(
				'role' => $row->role,
				'username' => $row->username
			);
			$checker++;
		}
	}
	
	if ($checker == 0) redirect ('main/');
	else displayContent($data, $query);
	
	function displayContent($data, $query) {
		include("header.php");
		$role = $data['role'];
		$username = $data['username'];
		$checker = 1;
		include("sidebar.php");
		
		$checker = 0;
		echo "<h1>Violations";
		
		if ($query->num_rows == 0) echo "</h1><p>There are no violations.</p>";
		else {
	
			foreach ($query->result() as $row) {
				if ($checker == 0) {
					echo " of " . $row->surname . ", " . $row->firstname . " " . $row->middlename . "</h1>";
					
					// Generation of the table and its headings.
					echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
					<tr>
						<td width='5%'><b>#</b></td>
						<td width='30%'><b>Violation</b></td>
						<td width='40%''><b>Officer</b></td>
						<td width='25%''><b>Date</b></td>
					</tr>";
				}
				
				$checker++;
				
				if ($checker % 2 == 0) echo "<tr class='altcolor2'>";
				else echo "<tr class='altcolor1'>";
				
				echo "<td>" . $checker . "</td>
					<td>" . $row->violation . "</td>
					<td>" . $row->officer . "</td>
					<td>";
				
				// Display date in a more readable format.
				$counter = 0;
				$string = strtok($row->date, '-');
				
				while ($string != false) {
					if ($counter == 0) $year = $string;
					else if ($counter == 1) $month = $string;
					else if ($counter == 2) $day = $string;
					$counter++;
					$string = strtok('-');
				}
				
				$monthArray = array (
					'01' => "January",
					'02' => "February",
					'03' => "March",
					'04' => "April",
					'05' => "May",
					'06' => "June",
					'07' => "July",
					'08' => "August",
					'09' => "September",
					'10' => "October",
					'11' => "November",
					'12' => "December"
				);
				
				echo $monthArray[$month] . " " . $day . ", " . $year . "</td>
				</tr>";
			}
			
			echo "</table><p>Total number of violations: <strong>" . $checker . "</strong></p>";
		}
		
		include("footer.php");
	}
?>