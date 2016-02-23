<?php
	// This page generates a table of all the records that have blue colored IDs in the database.
	$query = $_POST;
	
	// Retrieves currently logged user.
	$qu = $this->Users->logged();
	
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
				
				echo "<h1>View list of drivers with blue IDs</h1>";
				
				$counter = 0;
				
				// Checking if there are records in the database.
				if ($query->num_rows == 0) echo "<p>The database is empty.</p>";
				else {
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$q = $this->db->get('ids', '*');
						
						// Checking if the records in the database have blue IDs.
						if ($row2->idcolor == "blue") {
							if ($blue == 0) displayTableHeader();
						
							if ($blue % 2 == 0) echo "<tr class='altcolor1'>";
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
							<td>
								<a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row2->idnum . "'>" . $row2->surname . ", " . $row2->firstname . " " . $row2->midname . "</a>
							</td>
							<td style='text-align: right;'>
								<div id='anchors'>
									<a href='" . base_url() . "index.php/add_controller/addViolation/" . $row2->idnum . "'>Add Violation</a>
									| <a href='" . base_url() . "index.php/add_controller/addID/" . $row2->idnum . "'>Add ID</a>
									| <a href='" . base_url() . "index.php/edit_controller/requestEdit/" . $row2->idnum . "'>Edit</a>
								</div>
							</td></tr>";
								
							$blue++;
						}
						else {
							$ctr = 0;
							$i = 0;
							
							// Checking if there are more than one ID number.
							if ($q->num_rows != 0) {
								foreach ($q->result() as $row4) {
									if ($row4->color == "blue") {
										if ($blue == 0) displayTableHeader();
										
										foreach ($query->result() as $row3) {
											if ($ctr == $i) {
												if ($blue % 2 == 0) echo "<tr class='altcolor1'>";
												else echo "<tr class='altcolor2'>";
												
												echo "<td style='padding: 10px;'>";
												
												$c = 1;
												
												// Checking if there are more than one ID number.
												if ($q->num_rows == 0) echo $row2->idnum;
												else {
													foreach ($q->result() as $row8) {
														if ($q->num_rows == $c) echo $row8->idno;
														$c++;
													}
												}
												
												echo "</td>
												<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row2->idnum . "'>" . $row2->surname . ", " . $row2->firstname . " " . $row2->midname . "</a></td>
												<td style='text-align: right;'>";
												include('anchors3.php');
												echo "</td></tr>";
											}
											
											$i++;
										}
										
										$blue++;
									}
								}
								
								$counter++;
							}
						}
					}
				}
			
				if ($blue == 0) echo "<p>There are no drivers with blue IDs in the database.</p>";
				else echo "</table><p>Total Results: <b>" . $blue . "</b></p>";
			}
		
			$checker++;
		
			include("footer.php");
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