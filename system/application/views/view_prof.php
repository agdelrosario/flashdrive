<?php
	$query = $_POST;
	
	$q = $this->Users->logged();
	$checker = 0;
	
	foreach ($q->result() as $row) {
		if ($checker == 0) {
			$data = array(
				'role' => $row->role,
				'username' => $row->username
			);
			$counter = 0;
			foreach ($query->result() as $row) {
				if ($counter == 0) {
					$this->db->where('idno', $row->idnum);
					$q2 = $this->db->get('violations', '*');
					
					$this->db->where('fromrecord', $row->idnum);
					$q3 = $this->db->get('ids', '*');
				}
				$counter++;
			}
			$checker++;
		}
	}
	if ($checker == 0) redirect ('main/');
	else displayProfile($data, $query, $q2, $q3);
	
	function displayExpiredLicense () {
		echo "Expired license! ";
	}
	
	function displayExpiredFranchise () {
		echo "Expired franchise!";
	}
	
	function displayProfile ($data, $query, $q2, $q3) {
		include("header.php");
		$role = $data['role'];
		$username = $data['username'];
		$checker = 1;
		include("sidebar.php");
		$string;
		$current_year = date('Y');
		$current_month = date('m');
		$current_day = date('d');
		$year;
		$month;
		$day;
		$checker;
		
		if ($query->num_rows == 0) echo "<h1>Record missing</h1><p>You are trying to view the profile of a non-existent record.</p>";
		else {
			
			foreach ($query->result() as $row) {
				echo "<a href='" . base_url() . "uploads/" . $row->idnum . ".jpg'>
				<img alt='Your Thumbnail' src='" . base_url() . "uploads/" . $row->idnum . "_thumb.jpg' id='avatar2' />
				</a><br /><br />
				<h1>" . $row->surname . ", " . $row->firstname . " " . $row->midname . "</h1>
				<p align='right' id='alert'>";
				
				$string = strtok($row->license_exp, "-");
				$checker = 0;
				
				while ($string != false) {
					if ($checker == 0) $year = $string;
					else if ($checker == 1) $month = $string;
					else if ($checker == 2) $day = $string;
					$string = strtok ("-");
					$checker++;
				}
				
				if ($current_year > $year) displayExpiredLicense();
				else if ($current_year == $year) {
					if ($current_month > $month) displayExpiredLicense();
					else if ($current_month == $month) if ($current_day < $day) displayExpiredLicense();
				}
				
				$string = strtok($row->franchise_exp, "-");
				$checker = 0;
				
				while ($string != false) {
					if ($checker == 0) $year = $string;
					else if ($checker == 1) $month = $string;
					else if ($checker == 2) $day = $string;
					$string = strtok ("-");
					$checker++;
				}
				
				if ($current_year > $year) displayExpiredFranchise();
				else if ($current_year == $year) {
					if ($current_month > $month) displayExpiredFranchise();
					else if ($current_month == $month) if ($current_day < $day) displayExpiredFranchise();
				}
				
				echo "</p>";
				
				echo "<h2>ID ";
				if ($role != "upf") echo "<a href='" . base_url() . "index.php/add_controller/addID/" . $row->idnum . "'>[Add]</a>";
				echo "</h2>";
				
				$idcount = 0;
				
				if ($q3->num_rows != 0) {
					echo "<table width='100%' id='user'>
					<tr>
					<td width='15%'>Old IDs:</td>
					<td width='35%'>";
				
					if ($row->idcolor == 'yellow') echo "<span id='id_color_yellow'>";
					else echo "<span id='id_color_blue'>";
					echo $row->idnum . "</span>&nbsp;";
					
					foreach ($q3->result() as $row3) {
						if ($idcount + 1 == $q3->num_rows) {
							echo "
							<td width='15%'>Latest:</td>
							<td width='35%'>";
							if ($row3->color == 'yellow') echo "<span id='id_color_yellow'>";
							else echo "<span id='id_color_blue'>";
							echo $row3->idno . "</span>";
						}
						else {						
							if ($row3->color == 'yellow') echo "<span id='id_color_yellow'>";
							else echo "<span id='id_color_blue'>";
							echo $row3->idno . "</span>&nbsp;";
						}
						$idcount++;
					}
				}
				else {
					echo "<table width='100%' id='user'>
					<tr>
					<td width='15%'>Latest:</td>
					<td width='85%'>";
					if ($row->idcolor == 'yellow') echo "<span id='id_color_yellow'>";
					else echo "<span id='id_color_blue'>";
					echo $row->idnum . "</span>";
				}
				echo "</td></tr></table>&nbsp;";
				
				echo "<h2>Profile ";
				if ($role != "upf") echo "<a href='" . base_url() . "index.php/edit_controller/requestEdit/" . $row->idnum . "'>[Edit]</a>";
				echo "</h2>
					<table class = 'addform' cellpadding='0' cellspacing='0'>
						<th colspan='6'>Personal Information</th>
						<tr>
							<td colspan='2' width='33.33%'>1. Surname<br /><span class = 'info'>" . $row->surname . "</span></td>
							<td colspan='2' width='33.33%'>First name<br /><span class = 'info'>" . $row->firstname . "</span></td>
							<td colspan='2' width='33.33%'>Middle name<br /><span class = 'info'>" . $row->midname . "</span></td>
						</tr>
						<tr>
							<td colspan='6'>2. Address</td>
						</tr>
						<tr>
							<td colspan='1' width='15%'><span class = 'info'>" . $row->street . "</span></td>
							<td colspan='2' width='30%'><span class = 'info'>" . $row->barangay . "</span></td>
							<td colspan='1' width='15%'><span class = 'info'>" . $row->municipality . "</span></td>
							<td colspan='2' width='30%'><span class = 'info'>" . $row->province . "</span></td>
							</tr>
							<tr>
								<td colspan='1'>Street number</td>
								<td colspan='2'>Barangay</td>
								<td colspan='1'>Municipality</td>
								<td colspan='2'>Province</td>
							</tr>
							<tr>
								<td colspan='2'>3. Date of Birth<br />
									<table id='innertable' cellpadding='0' cellspacing='0'>
										<tr>";
							
				$string = strtok($row->dob, "-");
				while ($string != false) {
					echo "<td width='33%'><span class = 'info'>" . $string . "</span></td>";
					$string = strtok("-");
				}
				
				echo "					</tr>
										<tr>
											<td>YYYY</td>
											<td>MM</td>
											<td>DD</td>
										</tr>
									</table>
								</td>
								<td colspan='4'>4. Place of Birth
									<table id='innertable' cellpadding='0' cellspacing='0'>
										<tr>";
				
				$string = strtok ($row->pob, ",");
				while ($string != false) {
					echo "<td width='50%'><span class = 'info'>" . $string . "</span></td>";
					$string = strtok(",");
				}
				
				echo "
										</tr>
										<tr>
											<td>Town/City</td>
											<td>Province</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2'>5. Gender<br /><span class = 'info'>";
				
				if ($row->gender == 'm') echo "Male";
				else echo "Female";
				echo "				</span></td>
								<td colspan='4'>6. Civil Status<br /><span class = 'info'>";
							
				if ($row->civil == "single") echo "Single";
				else if ($row->civil == "married") echo "Married";
				else if ($row->civil == "widowed") echo "Widowed";
				else if ($row->civil == "separated") echo "Separated";
				echo "				</span>
								</td>
							</tr>
							<tr>
								<td colspan='3'>7. If married, specify the name of spouse:<br />
									<table id='innertable' cellpadding='0' cellspacing='0' ";
									if ($row->civil == "single" || $row->civil == "widowed" || $row->civil == "separated") echo "class='disabled'";
								echo ">
										<tr>
											<td width='33%'><span class = 'info'>" . $row->spouse_sname . "</span></td>
											<td width='33%'><span class = 'info'>" . $row->spouse_fname . "</span></td>
											<td width='33%'><span class = 'info'>" . $row->spouse_mname . "</span></td>
										</tr>
										<tr>
											<td>Surname</td>
											<td>First name</td>
											<td>Middle name</td>
										</tr>
										<tr>
											<td colspan='1'>Occupation:</td>
											<td colspan='2'><span class = 'info'>" . $row->spouse_occ . "</span></td>
										</tr>
										<tr>
											<td colspan='1'>Contact number:</td>
											<td colspan='2'><span class = 'info'>" . $row->spouse_contact . "</span></td>
										</tr>
										<tr>
											<td colspan='1'>Number of children:</td>
											<td colspan='2'><span class = 'info'>" . $row->children . "</span></td>
										</tr>
									</table>
								</td>
								<td colspan='3'>8. If single, widow or separated, specify the name of person to be contacted in case of emergency:<br />
									<table id='innertable' cellpadding='0' cellspacing='0'";
									if ($row->civil == "married") echo "class='disabled'";
								echo ">
										<tr>
											<td width='33%'><span class = 'info'>" . $row->emer_sname . "</span></td>
											<td width='33%'><span class = 'info'>" . $row->emer_fname . "</span></td>
											<td width='33%'><span class = 'info'>" . $row->emer_mname . "</span></td>
										</tr>
										<tr>
											<td>Surname</td>
											<td>First name</td>
											<td>Middle name</td>
										</tr>
										<tr>
											<td colspan='1'>Address:</td>
											<td colspan='2'><span class = 'info'>" . $row->emer_address . "</span></td>
										</tr>
										<tr>
											<td colspan='1'>Contact number:</td>
											<td colspan='2'><span class = 'info'>" . $row->emer_contact . "</span></td>
										</tr>
									</table> 
								</td>
							</tr>
							<tr>
								<td colspan='6'>
									<table id='innertable' cellpadding='0' cellspacing='0'>
										<tr>
											<td width='20%'>9. License Number:</td>
											<td width='80%'><span class = 'info'>" . $row->license . "</span></td>
										</tr>
										<tr>
											<td>Place obtained:</td>
											<td><span class = 'info'>" . $row->license_place . "</span></td>
										</tr>
										<tr>
											<td>Expiration Date:</td>
											<td>";
				
				$string = strtok($row->license_exp, "-");
				$checker = 0;
				
				while ($string != false) {
					if ($checker == 0) echo "(YYYY) ";
					else if ($checker == 1) echo " (MM) ";
					else if ($checker == 2) echo " (DD) ";
					echo "<span class = 'info'>" . $string . "</span>";
					$checker++;
					$string = strtok ("-");
				}
				
				echo "						</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='6'>10. Do you own the jeepney you are driving?
									<table id='innertable' cellpadding='0' cellspacing='0'>
										<tr>
											<td width='17%'";
									if ($row->jeep == "no") echo " class='disabled'";
									echo ">Plate Number:</td>
											<td width='33%'";
									if ($row->jeep == "no") echo " class='disabled'";
									echo "><span class = 'info'>";
				
				if ($row->jeep == "yes") echo $row->plate_number;
				
				echo "							</span>
											</td>
											<td width='17%'";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">Name of Operator:</td>
											<td width='33%'";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">";
				
				if ($row->jeep == "no") {
					$string = strtok ($row->operator, "-");
					$checker = 0;
					while ($string != false) {
						echo "<span class = 'info'>" . $string;
						if ($checker == 0) echo "</span> (First name)<br />";
						else echo "</span> (Surname)";
						$string = strtok (" ");
					}
				}
				
				echo "						</td>
										</tr>
										<tr>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo ">UPLB Sticker Number:</td>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo "><span class = 'info'>";
				
				if ($row->jeep == "yes") echo $row->sticker_number;
				
				echo "							</span></td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">Plate Number:</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo "><span class = 'info'>";
				
				if ($row->jeep == "no") echo $row->plate_number;
				
				echo "						</span></td>
										</tr>
										<tr>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo ">Expiration of Franchise:</td>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo ">";
							
				if ($row->jeep == "yes") {
					$string = strtok($row->franchise_exp, "-");
					$checker = 0;
					while ($string != false) {
						if ($checker == 0) echo "(YYYY) ";
						else if ($checker == 1) echo " (MM) ";
						else if ($checker == 2) echo " (DD) ";
						echo "<span class = 'info'>" . $string . "</span>";
						$checker++;
						$string = strtok ("-");
					}
				}
				
				echo "						</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">UPLB Sticker Number:</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo "><span class = 'info'>";
							
				if ($row->jeep == "no") echo $row->sticker_number;
				
				echo "						</span></td>
										</tr>
										<tr>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo ">Contact Number:</td>
											<td";
									if ($row->jeep == "no") echo " class='disabled'";
									echo "><span class = 'info'>";
							
				if ($row->jeep == "yes") echo $row->contact;
				
				echo "							</span></td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">Expiration of Franchise:</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">";
							
				if ($row->jeep == "no") {
					$string = strtok($row->franchise_exp, "-");
					$checker = 0;
					while ($string != false) {
						if ($checker == 0) echo "(YYYY) ";
						else if ($checker == 1) echo " (MM) ";
						else if ($checker == 2) echo " (DD) ";
						echo "<span class = 'info'>" . $string . "</span>";
						$checker++;
						$string = strtok ("-");
					}
				}
				
				echo "							&nbsp;
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo ">Contact Number:</td>
											<td";
									if ($row->jeep == "yes") echo " class='disabled'";
									echo "><span class = 'info'>";
				
				if ($row->jeep == "no") echo $row->contact;
				
				echo "						</span></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						";
					
				echo "<h2>Violations";
				if ($role != "upf") echo " <a href='" . base_url() . "index.php/add_controller/addViolation/" . $row->idnum . "'>[Add]</a>";
				echo "</h2>";
				
				$ct = 0;
				
				if ($q2->num_rows == 0) echo "<p>There are no violations.</p>";
				else {
			
					foreach ($q2->result() as $row2) {
						if ($ct == 0) {
							// Generation of the table and its headings.
							echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
							<tr>
								<td width='5%'><b>#</b></td>
								<td width='30%'><b>Violation</b></td>
								<td width='35%'><b>Officer</b></td>
								<td width='25%'><b>Date</b></td>
								<td width='5%'>&nbsp;</td>
							</tr>";
						}
						
						$ct++;
						
						if ($ct % 2 == 0) echo "<tr class='altcolor2'>";
						else echo "<tr class='altcolor1'>";
						
						echo "<td>" . $ct . "</td>
							<td>" . $row2->violation . "</td>
							<td>" . $row2->officer . "</td>
							<td>";
						
						// Display date in a more readable format.
						$counter = 0;
						$string = strtok($row2->date, '-');
						
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
						
						$chever = $ct - 1;
						
						echo $monthArray[$month] . " " . $day . ", " . $year . "</td>
						<td style='text-align: right;'>";
						if ($role != "upf") echo "<div id='anchors'><a href='" . base_url() . "index.php/add_controller/deleteViolation/" . ($ct - 1) . "-" . $row->idnum ."'>Delete</a></div>";
						echo "</td></tr>";
					}
					
					echo "</table><p>Total number of violations: <strong>" . $ct . "</strong></p>";
				}
			}
		}
		include("footer.php");
	}
?>