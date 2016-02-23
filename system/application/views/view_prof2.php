<?php
	$query = $_POST;
	
	$checker = 0;
	$data = 0;
	
	// Retrieves currently logged user.
	$q = $this->Users->logged();
	
	if ($q->num_rows == 0) redirect('main/');
	else {
		foreach ($q->result() as $row) {
			if ($row->logged == 'true' && $checker == 0 && $row->role != "upf") {
				include("header.php");
		$role = $row->role;
		$username = $row->username;
		$checker = 1;
		include("sidebar.php");
		
	foreach ($query->result() as $row){
	
		
		echo "<h1>Edit profile of " . $row->surname . ", " . $row->firstname . " " . $row->midname . "</h1>";
		
		$attr = array('class' => 'form1', 'id' => 'form1');
		echo form_open('edit_controller/requestEditRecord/' . $row->idnum ,$attr);
		
		echo "
		<p><strong>Note:</strong> ID number and ID color cannot be edited.</p>
		<table class = 'addform' cellpadding='0' cellspacing='0'>
			<th colspan='6'>Identification Number</th>
			<tr>
				<td colspan='3' width='50%'>ID NUMBER<br /><input disabled='disabled' id = 'idnumb' value='" . $row->idnum . "' class='text' type = 'text' name = 'idnumb' maxlength = '30' /></td>
				<td colspan='3' width='50%'>ID COLOR<br />
					<select name='idcolor' disabled='disabled'>
						<option value='blue'";
						if ($row->idcolor == "blue") echo " selected = 'selected'";
						echo ">Blue</option>
						<option value='yellow'";
						if ($row->idcolor == "yellow") echo " selected = 'selected'";
						echo ">Yellow</option>
					</select>
				</td>
			</tr>
			<th colspan='6'>Personal Information</th>
			<tr>
				<td colspan='2' width='33.33%'>1. Surname <a id='alert' title='Required field'>*</a><br /><input value = '" . $row->surname . "' id = 'surname' class='text' type = 'text' name = 'surname' maxlength = '30' /></td>
				<td colspan='2' width='33.33%'>First name <a id='alert' title='Required field'>*</a><br /><input value = '" . $row->firstname . "' id = 'firstname' class='text' type = 'text' name = 'fname' maxlength = '30'/></td>
				<td colspan='2' width='33.33%'>Middle name <a id='alert' title='Required field'>*</a><br /><input value = '" . $row->midname . "' id = 'midname' class='text' type = 'text' name = 'mname' maxlength = '30'/></td>
			</tr>
			<tr>
				<td colspan='6'>2. Address</td>
			</tr>
			<tr>
				<td colspan='1' width='15%'><input value = '" . $row->street . "' id = 'sno' class='text' type = 'text' name = 'sno' maxlength = '20'/></td>
				<td colspan='2' width='30%'><input value = '" . $row->barangay . "' id = 'brgy' class='text' type = 'text' name = 'brgy' maxlength = '30'/></td>
				<td colspan='1' width='15'><input value = '" . $row->municipality . "' id = 'municipality' class='text' type = 'text' name = 'municipality' maxlength = '30'/></td>
				<td colspan='2' width='30%'><input value = '" . $row->province . "' id = 'prov' class='text' type = 'text' name = 'prov' maxlength = '30'/></td>
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
						<tr>
							<td width='33%'>";
							$year = strtok($row->dob, "-");
								$month = strtok("-");
								$day = strtok("-");
							echo "<select name='dobday'>";
									for($i = 1; $i <= 31; $i++){									
										if ($day == $i) {
											echo "<option selected = 'selected' value='" . $i . "'>" . $i . "</option>";
										}
										else {
											echo "<option value='" . $i . "'>" . $i . "</option>";
										}
									}
								echo "</select>
								<!--<input id = 'day' type = 'text' name = 'day' maxlength = '2' size = '1'/>-->
							</td>
							<td width='33%'>
								<select value = '" . $month . "' name='dobmonth'>
									<option value='01' ";
									if($month == 1) echo "selected = 'selected'";
									echo ">January</option>
									<option value='02' ";
									if($month == 2) echo "selected = 'selected'";
									echo ">February</option>
									<option value='03' ";
									if($month == 3) echo "selected = 'selected'";
									echo ">March</option>
									<option value='04' ";
									if($month == 4) echo "selected = 'selected'";
									echo ">April</option>
									<option value='05' ";
									if($month == 5) echo "selected = 'selected'";
									echo ">May</option>
									<option value='06' ";
									if($month == 6) echo "selected = 'selected'";
									echo ">June</option>
									<option value='07' ";
									if($month == 7) echo "selected = 'selected'";
									echo ">July</option>
									<option value='08' ";
									if($month == 8) echo "selected = 'selected'";
									echo ">August</option>
									<option value='09' ";
									if($month == 9) echo "selected = 'selected'";
									echo ">September</option>
									<option value='10' ";
									if($month == 10) echo "selected = 'selected'";
									echo ">October</option>
									<option value='11' ";
									if($month == 11) echo "selected = 'selected'";
									echo ">November</option>
									<option value='12' ";
									if($month == 12) echo "selected = 'selected'";
									echo ">December</option>
								</select>
							</td>
							<td width='33%'>
								<select value = '" . $year . "' name='dobyear'>";
										for ($i = date('Y') + 3; $i>1929; $i--) 
										{ 
											if($i == $year){
												echo "<option selected = 'selected' value='" . $i . "'>" . $i . "</option>";
											}
											else{
												echo "<option value='" . $i . "'>" . $i . "</option>";
											}
										}
							echo "</select>
								<!--<input id = 'year' type = 'text' name = 'year' maxlength = '4' size = '2'/>-->
							</td>
						</tr>
						<tr>
							<td>(DD)</td>
							<td>(MM)</td>
							<td>(YYYY)</td>
						</tr>
					</table>
				</td>
				<td colspan='4'>4. Place of Birth
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>";
						$city = strtok($row->pob, ",");
								$prov2 = strtok(",");
						echo "
							<td width='50%'><input value = '" . $city . "' id = 'city' class='text' type = 'text' name = 'city' maxlength = '30'/></td>
							<td width='50%'><input value = '" . $prov2 . "' id = 'prov2' class='text' type = 'text' name = 'prov2' maxlength = '30'/></td>
						</tr>
						<tr>
							<td>Town/City</td>
							<td>Province</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='2'>5. Gender <a id='alert' title='Required field'>*</a><br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<td><input ";
							if($row->gender == 'm') echo "checked = 'true'";
							echo "type = 'radio' name = 'gender' value = 'm' checked />Male</td>
							<td><input ";
							if($row->gender == 'f') echo "checked = 'true'"; 
							echo "type = 'radio' name = 'gender' value = 'f'/>Female</td>
						</tr>
					</table>
				</td>
				<td colspan='4'>6. Civil Status <a id='alert' title='Required field'>*</a><br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='25%'><input ";
							if($row->civil == 'single') echo "checked = 'true' checked ";
							echo "type = 'radio' name = 'civil' value = 'single' />Single</td>
							<td width='25%'><input ";
							if($row->civil == 'married') echo "checked = 'true' checked ";
							echo "type = 'radio' name = 'civil' value = 'married' />Married</td>
							<td width='25%'><input ";
							if($row->civil == 'widowed') echo "checked = 'true' checked ";
							echo "type = 'radio' name = 'civil' value = 'widowed' />Widowed</td>
							<td width='25%'><input ";
							if($row->civil == 'separated') echo "checked = 'true' checked ";
							echo "type = 'radio' name = 'civil' value = 'separated' />Separated</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='3'>7. If married, specify the name of spouse:<br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='33%'><input value = '" . $row->spouse_sname . "' type = 'text' class='text' name = 'spouse_sname' id = 'spouse_sname' maxlength = '30' size='10'/></td>
							<td width='33%'><input value = '" . $row->spouse_fname . "' type = 'text' class='text' name = 'spouse_fname' id = 'spouse_fname' maxlength = '30' size='10'/></td>
							<td width='33%'><input value = '" . $row->spouse_mname . "' type = 'text' class='text' name = 'spouse_mname' id = 'spouse_mname' maxlength = '30' size='10'/></td>
						</tr>
						<tr>
							<td>Surname</td>
							<td>First name</td>
							<td>Middle name</td>
						</tr>
						<tr>
							<td colspan='1'>Occupation:</td>
							<td colspan='2'><input value = '" . $row->spouse_occ . "' type = 'text' class='text' name = 'spouse_occupation' id = 'spouse_occupation' maxlength = '30'/></td>
						</tr>
						<tr>
							<td colspan='1'>Contact number:</td>
							<td colspan='2'><input value = '" . $row->spouse_contact . "' type = 'text' class='text' name = 'spouse_cnum' id = 'spouse_cnum' maxlength = '40'/></td>
						</tr>
						<tr>
							<td colspan='1'>Number of children:</td>
							<td colspan='2'><input value = '" . $row->children . "' type = 'text' class='text' name = 'spouse_childno' id = 'spouse_childno' maxlength = '30' size = '1'/></td>
						</tr>
					</table>
				</td>
				<td colspan='3'>8. If single, widow or separated, specify the name of person to be contacted in case of emergency:<br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>";
							echo "<td width='33%'><input value = '" . $row->emer_sname . "' type = 'text' class='text' name = 'rel_sname' id = 'rel_sname' maxlength = '30' size='10'/></td>
							<td width='33%'><input value = '" . $row->emer_fname . "' type = 'text' class='text' name = 'rel_fname' id = 'rel_fname' maxlength = '30' size='10'/></td>
							<td width='33%'><input value = '" . $row->emer_mname . "' type = 'text' class='text' name = 'rel_mname' id = 'rel_mname' /></td>
						</tr>
						<tr>
							<td>Surname</td>
							<td>First name</td>
							<td>Middle name</td>
						</tr>
						<tr>
							<td colspan='1'>Address:</td>
							<td colspan='2'><input value = '" . $row->emer_address . "' type = 'text' class='text' name = 'rel_address' id = 'rel_address' maxlength = '50'/></td>
						</tr>
						<tr>
							<td colspan='1'>Contact number:</td>
							<td colspan='2'><input value = '" . $row->emer_contact . "' type = 'text' class='text' name = 'rel_cnum' id = 'rel_cnum' maxlength = '40'/></td>
						</tr>
					</table> 
				</td>
			</tr>
			<tr>
				<td colspan='6'>
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='20%' >9. License Number <a id='alert' title='Required field'>*</a>:</td>
							<td width='80%'><input value = '" . $row->license . "' id = 'licnum' class='text' type = 'text' name = 'licnum' maxlength = '30'/></td>
						</tr>
						<tr>
							<td>Place obtained:</td>
							<td><input value = '" . $row->license_place . "' type = 'text' id = 'placelic' class='text' name = 'placelic' maxlength = '30'/></td>
						</tr>
						<tr>
							<td>Expiration Date <a id='alert' title='Required field'>*</a>:</td>";
								$year = strtok($row->license_exp, '-');
								$month = strtok('-');
								$day = strtok('-');
							echo "<td>(MM) <select id='expirelicmonth' name='expirelicmonth'>
									<option value='1' ";
									if($month == 1) echo "selected = 'selected'";
									echo ">January</option>
									<option value='2' ";
									if($month == 2) echo "selected = 'selected'";
									echo ">February</option>
									<option value='3' ";
									if($month == 3) echo "selected = 'selected'";
									echo ">March</option>
									<option value='4' ";
									if($month == 4) echo "selected = 'selected'";
									echo ">April</option>
									<option value='5' ";
									if($month == 5) echo "selected = 'selected'";
									echo ">May</option>
									<option value='6' ";
									if($month == 6) echo "selected = 'selected'";
									echo ">June</option>
									<option value='7' ";
									if($month == 7) echo "selected = 'selected'";
									echo ">July</option>
									<option value='8' ";
									if($month == 8) echo "selected = 'selected'";
									echo ">August</option>
									<option value='9' ";
									if($month == 9) echo "selected = 'selected'";
									echo ">September</option>
									<option value='10' ";
									if($month == 10) echo "selected = 'selected'";
									echo ">October</option>
									<option value='11' ";
									if($month == 11) echo "selected = 'selected'";
									echo ">November</option>
									<option value='12' ";
									if($month == 12) echo "selected = 'selected'";
									echo ">December</option>
								</select>
								<!--<input id = 'expirelicmonth' type = 'text' name = 'expirelicmonth' maxlength = '30' size = '1'/>-->
								(DD) <select id = 'expirelicday' name='expirelicday'>";
									
									for($i = 1; $i <= 31; $i++){
										if ($day == $i){
											echo "<option selected = 'selected' value='" . $i . "'>" . $i . "</option>";
										}
										else {
											echo "<option value='" . $i . "'>" . $i . "</option>";
										}
									}
							echo "</select>
								<!--<input id = 'expirelicday' type = 'text' name = 'expirelicday' maxlength = '30' size  = '1'/>-->
								(YYYY) <select id = 'expirelicyear' name='expirelicyear'>";
									
									for ($i = date('Y') + 3; $i>1929; $i--) 
										{ 
											if($i == $year){
												echo "<option selected = 'selected'>" . $i . "</option>";
											}
											else{
												echo "<option>" . $i . "</option>";
											}
										}
								
							echo "</select>
								<!--<input id = 'expirelicyear' type = 'text' name = 'expirelicyear' maxlength = '30' size  = '1'/>-->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='6'>10. Do you own the jeepney you are driving?
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='50%' colspan='2'><input type = 'radio' name = 'yesno' value = 'yes'";
							if($row->jeep == "yes") echo "checked = 'true'";
							echo "/>Yes</td>
							<td width='50%' colspan='2'><input type = 'radio' name = 'yesno' value = 'no'";
							if($row->jeep == "no") echo "checked = 'true'";
							echo "/>No</td>
						</tr>
						<tr>
							<td width='17%'>Plate Number <a id='alert' title='Required field'>*</a>:</td>
							<td width='33%'><input value = '" . $row->plate_number . "' type = 'text' class='text' name = 'plateno' id = 'plateno' maxlength = '6'/></td>
							<td width='17%'>Name of Operator:</td>";
								$sname = strtok($row->operator, "-");
								$fname = strtok(" ");
							echo "<td width='33%'><input value = '" . $fname . "' type = 'text' class='text' name = 'nopfname' id = 'nopfname' maxlength = '30' size='10' /> (First name)<br />
								<input value = '" . $sname . "' type = 'text' class='text' name = 'nopsname' id = 'nopsname' maxlength = '30' size='10'/> (Surname)
							</td>
						</tr>
						<tr>
							<td>UPLB Sticker Number:</td>
							<td><input value = '" . $row->sticker_number . "' type = 'text' class='text' name = 'stickerno' id = 'stickerno' maxlength = '10'/></td>
							<td>Plate Number <a id='alert' title='Required field'>*</a>:</td>
							<td><input value = '" . $row->plate_number . "' type = 'text' class='text' name = 'nplateno' id = 'nplateno' maxlength = '6'></td>
						</tr>
						<tr>
							<td>Expiration of Franchise <a id='alert' title='Required field'>*</a>:</td>";
							$year = strtok($row->franchise_exp, "-");
								$month = strtok("-");
								$day = strtok("-");
							echo "<td>Month: <select id='expirefranmonth' name='expirefranmonth'>
									<option value='1' ";
									if($month == 1) echo "selected = 'selected'";
									echo ">January</option>
									<option value='2' ";
									if($month == 2) echo "selected = 'selected'";
									echo ">February</option>
									<option value='3' ";
									if($month == 3) echo "selected = 'selected'";
									echo ">March</option>
									<option value='4' ";
									if($month == 4) echo "selected = 'selected'";
									echo ">April</option>
									<option value='5' ";
									if($month == 5) echo "selected = 'selected'";
									echo ">May</option>
									<option value='6' ";
									if($month == 6) echo "selected = 'selected'";
									echo ">June</option>
									<option value='7' ";
									if($month == 7) echo "selected = 'selected'";
									echo ">July</option>
									<option value='8' ";
									if($month == 8) echo "selected = 'selected'";
									echo ">August</option>
									<option value='9' ";
									if($month == 9) echo "selected = 'selected'";
									echo ">September</option>
									<option value='10' ";
									if($month == 10) echo "selected = 'selected'";
									echo ">October</option>
									<option value='11' ";
									if($month == 11) echo "selected = 'selected'";
									echo ">November</option>
									<option value='12' ";
									if($month == 12) echo "selected = 'selected'";
									echo ">December</option>
								</select><br />
								Day: <select id='expirefranday' name='expirefranday'>";
									
									for($i = 1; $i <= 31; $i++){									
										if ($day == $i){
											echo "<option selected = 'selected' value='" . $i . "'>" . $i . "</option>";
										}
										else {
											echo "<option value='" . $i . "'>" . $i . "</option>";
										}
									}
									
								echo "</select><br />
									Year: <select id='expirefranyear' name='expirefranyear'>";
										
									
										for ($i = date('Y') + 3; $i>1929; $i--) 
										{ 
											if($i == $year){
												echo "<option selected = 'selected'>" . $i . "</option>";
											}
											else{
												echo "<option>" . $i . "</option>";
											}
										}
										
								echo "</select>
									<!--<input id = 'expirefranyear' type = 'text' name = 'expirefranyear' maxlength = '30' size  = '1'/>-->
								</td>
								<td>UPLB Sticker Number:</td>
								<td><input value = '" . $row->sticker_number . "' type = 'text' class='text' name = 'nstickerno' id = 'nstickerno' maxlength = '10'/></td>
							</tr>
							<tr>
								<td>Contact Number:</td>
								<td><input value = '" . $row->contact . "' ";
							if ($row->jeep == "no") echo "disabled='disabled'";
							echo " type = 'text' class='text' name = 'cnum2' id = 'cnum2' maxlength = '11'/></td>
								<td>Expiration of Franchise <a id='alert' title='Required field'>*</a>:</td>
								<td>Month: <select id='nexpirefranmonth' name='nexpirefranmonth'>
										<option value='1' ";
									if($month == 1) echo "selected = 'selected'";
									echo ">January</option>
									<option value='2' ";
									if($month == 2) echo "selected = 'selected'";
									echo ">February</option>
									<option value='3' ";
									if($month == 3) echo "selected = 'selected'";
									echo ">March</option>
									<option value='4' ";
									if($month == 4) echo "selected = 'selected'";
									echo ">April</option>
									<option value='5' ";
									if($month == 5) echo "selected = 'selected'";
									echo ">May</option>
									<option value='6' ";
									if($month == 6) echo "selected = 'selected'";
									echo ">June</option>
									<option value='7' ";
									if($month == 7) echo "selected = 'selected'";
									echo ">July</option>
									<option value='8' ";
									if($month == 8) echo "selected = 'selected'";
									echo ">August</option>
									<option value='9' ";
									if($month == 9) echo "selected = 'selected'";
									echo ">September</option>
									<option value='10' ";
									if($month == 10) echo "selected = 'selected'";
									echo ">October</option>
									<option value='11' ";
									if($month == 11) echo "selected = 'selected'";
									echo ">November</option>
									<option value='12' ";
									if($month == 12) echo "selected = 'selected'";
									echo ">December</option>
								</select><br />
									Day: <select id='nexpirefranday' name='nexpirefranday'>";
									
										for($i = 1; $i <= 31; $i++){									
										if ($day == $i){
											echo "<option selected = 'selected' value='" . $i . "'>" . $i . "</option>";
										}
										else {
											echo "<option value='" . $i . "'>" . $i . "</option>";
										}
									}
									
									echo "</select><br />
									<!--<input id = 'expirefranday' type = 'text' name = 'expirefranday' maxlength = '30' size  = '1'/>-->
									Year: <select id='nexpirefranyear' name='nexpirefranyear'>";
										for ($i = date('Y') + 3; $i>1929; $i--) 
										{ 
											if($i == $year){
												echo "<option selected = 'selected'>" . $i . "</option>\n";
											}
											else{
												echo "<option>" . $i . "</option>\n";
											}
										}
											
									echo "</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>Contact Number:</td>
								<td><input value = '" . $row->contact . "' type = 'text' class='text' name = 'ncnum2' id = 'ncnum2' = '40'/></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan='6'><center><input class = 'submit' type='submit' value='Submit' /></center></td>
				</tr>
			</form>
		</table>";
				}
	include("footer.php");
				$checker++;
			}
			else redirect('main/');
		}
	}
 ?>