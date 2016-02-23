<?php
	// PAGE DESCRIPTION: This page displays the search by color form.
	
	// Retrieve logged user.
	$q = $this->Users->logged();
	
	$checker = 0;
	$color = 0;
	
	if ($q->num_rows == 0) redirect('main/');
	else {
		foreach ($q->result() as $row) {
			if ($checker == 0) {
				include("header.php");
				$role = $row->role;
				$username = $row->username;
				$checker = 1;
				include("sidebar.php");
				
				echo "<h1>Search by ID Color Results</h1>";
				
				if ($query->num_rows == 0) echo "<p>The database does not contain any record of a driver with the ID color like what you have searched for.</p>";
				else {
					// If the passed ID color contained in $data equates to the ID color searched for by the user and
					// if the passed surname contained in $data equates to the surname searched for by the user, records will be displayed.
					foreach ($query->result() as $row2) {
						$this->db->where('fromrecord', $row2->idnum);
						$qu = $this->db->get('ids', '*');
						
						if ($row2->idcolor == $data['color'] && $row2->surname == $data['surname']) {						
							if ($color == 0) displayTableHeader();
							if ($color % 2 == 0) echo "<tr class='altcolor1'>";
							else echo "<tr class='altcolor2'>";
							
							echo "<td style='padding: 10px;'>";
							
							$c = 1;
							
							// Checking if there are more than one ID number.
							if ($qu->num_rows == 0) echo $row2->idnum;
							else {
								foreach ($qu->result() as $row3) {
									if ($qu->num_rows == $c) echo $row3->idno;
									$c++;
								}
							}
							
							echo "</td>
							<td>
								<a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row2->idnum . "'>" . $row2->surname . ", " . $row2->firstname . " " . $row2->midname . "</a>
							</td>
							<td style='text-align: right;'>";
							include('anchors3.php');
							echo "</td></tr>";
							
							$color++;
						}
						else {
							$ctr = 0;
							$i = 0;
							
							if ($qu->num_rows != 0) {
								foreach ($qu->result() as $row4) {
									if ($row4->color == $data['color']) {
										if ($color == 0) displayTableHeader();
										
										foreach ($query->result() as $row3) {
											if ($ctr == $i) {
												if ($color % 2 == 0) echo "<tr class='altcolor1'>";
												else echo "<tr class='altcolor2'>";
												
												echo "<td style='padding: 10px;'>";
												
												$c = 1;
												
												// Checking if there are more than one ID number.
												if ($qu->num_rows == 0) echo $row2->idnum;
												else {
													foreach ($qu->result() as $row8) {
														if ($qu->num_rows == $c) echo $row8->idno;
														$c++;
													}
												}
												
												echo "</td>
												<td><a href='" . base_url() . "index.php/view_controller/requestProfile/" . $row2->idnum . "'>" . $row2->surname . ", " . $row2->firstname . " " . $row2->midname . "</a></td>
												<td style='text-align: right;'>
													<div id='anchors'>
														<a href='" . base_url() . "index.php/add_controller/addViolation/" . $row2->idnum . "'>Add Violation</a>
														| <a href='" . base_url() . "index.php/add_controller/addID/" . $row2->idnum . "'>Add ID</a>
														| <a href='" . base_url() . "index.php/edit_controller/requestEdit/" . $row2->idnum . "'>Edit</a>
													</div>
												</td></tr>";
											}
											
											$i++;
										}
										
										$color++;
									}
								}
							}
						}
					}
				}
				
				if ($color == 0) echo "<p>The database does not contain what you searched for.</p>";
				else echo "</table><p>Total Results: <b>" . $color . "</b></p>";
				include("footer.php");
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