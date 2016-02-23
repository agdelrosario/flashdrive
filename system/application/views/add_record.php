<?php
	// PAGE DESCRIPTION: This page displays the form to add a record to the database.
	// The records are contained in the 'drivers' table.
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display the header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display the reminders for adding a record.
		echo "<h1>Add a record</h1>
		<p><b>Step One.</b> Fill in profile form.</p><p><strong>IMPORTANT REMINDERS:</strong> Do <u>not</u> proceed if you do not have a <u>picture of the driver</u> to upload. The chance of uploading the driver's picture is offered only once, and that chance is in the step two of adding this record. <b>Please double check before submitting the form.</b> Do <u>not</u> leave the required fields blank. Read the <a href='" . base_url() . "index.php/admin_controller/manual'>manual</a> for more detailed instructions.</p>
		<p>Thank you for reading. Please proceed to filling the form.</p><br />";
		
		// Display the form for adding a record.
		$attr = array('class' => 'form1', 'id' => 'form1');
		echo form_open('add_controller/requestAdd', $attr);
		
		echo "<table class = 'addform' cellpadding='0' cellspacing='0'>";
		
		// Identification Number field.
		echo "<th colspan='6'>Identification Number</th>
			<tr>
				<td colspan='3' width='50%'> <!-- ID NUMBER (REQUIRED) : Integer only -->
					ID NUMBER <a id='alert' title='Required field'>*</a><br />
					<input id = 'idnumb' class='text' type = 'text' name = 'idnumb' maxlength = '30' />
		
				</td>
				<td colspan='3' width='50%'> <!-- ID COLOR (REQUIRED) -->
					ID COLOR <a id='alert' title='Required field'>*</a><br />
					<select name='idcolor'>
						<option value='blue'>Blue</option>
						<option value='yellow'>Yellow</option>
					</select>
				</td>
			</tr>";
			
		// Personal Information field.
		echo "<th colspan='6'>Personal Information</th>
			<tr> <!-- NUMBER ONE : Name -->
				<td colspan='2' width='33.33%'> <!-- SURNAME (REQUIRED) : 15 character limit -->
					1. Surname <a id='alert' title='Required field'>*</a><br />
					<input id = 'surname' class='text' type = 'text' name = 'surname' maxlength = '15' />
				</td>
				<td colspan='2' width='33.33%'> <!-- FIRST NAME (REQUIRED) : 25 character limit -->
					First name <a id='alert' title='Required field'>*</a><br />
					<input id = 'fname' class='text' type = 'text' name = 'fname' maxlength = '25'/>
				</td>
				<td colspan='2' width='33.33%'> <!-- MIDDLE NAME (REQUIRED) : 15 character limit -->
					Middle name <a id='alert' title='Required field'>*</a><br />
					<input id = 'mname' class='text' type = 'text' name = 'mname' maxlength = '15'/>
				</td>
			</tr>
			<tr> <!-- NUMBER TWO : Address -->
				<td colspan='6'>2. Address</td>
			</tr>
			<tr>
				<td colspan='1' width='15%'><input id = 'sno' class='text' type = 'text' name = 'sno' maxlength = '15'/></td> <!-- STREET NUMBER : 15 character limit -->
				<td colspan='2' width='30%'><input id = 'brgy' class='text' type = 'text' name = 'brgy' maxlength = '15'/></td> <!-- BARANGAY : 15 character limit -->
				<td colspan='1' width='15%'><input id = 'municipality' class='text' type = 'text' name = 'municipality' maxlength = '15'/></td> <!-- MUNICIPALITY : 15 character limit -->
				<td colspan='2' width='30%'><input id = 'prov' class='text' type = 'text' name = 'prov' maxlength = '15'/></td> <!-- PROVINCE : 15 character limit -->
			</tr>
			<tr>
				<td colspan='1'>Street number</td>
				<td colspan='2'>Barangay</td>
				<td colspan='1'>Municipality</td>
				<td colspan='2'>Province</td>
			</tr>
			<tr> <!-- NUMBER THREE : Date of Birth (REQUIRED) : Format YYYY-MM-DD -->
				<td colspan='2'>
					3. Date of Birth <a id='alert' title='Required field'>*</a><br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='33%'> <!-- DAY : 1 to 31 -->
								<select name='day'>";
		
		echo "<option value='notspecified'>N/A</option>";
		echo "<option>---</option>";
		
		// Generate the days 1 to 31 for the option tag.
		for ($i = 1; $i<=31; $i++) { 
			echo "<option value='". $i ."'>". $i ."</option>\n"; 
		}
		
		echo "					</select>
							</td>
							<td width='33%'> <!-- MONTH -->
								<select name='month'>		
									<option value='notspecified'>N/A</option>
									<option>---</option>
									<option value='1'>January</option>
									<option value='2'>February</option>
									<option value='3'>March</option>
									<option value='4'>April</option>
									<option value='5'>May</option>
									<option value='6'>June</option>
									<option value='7'>July</option>
									<option value='8'>August</option>
									<option value='9'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
								</select>
							</td>
							<td width='33%'> <!-- YEAR : 1930 to present -->
								<select name='year'>";

		// Generate present year until 1930.
		for ($i = date("Y"); $i>1929; $i--) { 
			echo "<option>$i</option>\n"; 
		}
		
		echo "					</select>
							</td>
						</tr>
						<tr>
							<td>(DD)</td>
							<td>(MM)</td>
							<td>(YYYY)</td>
						</tr>
					</table>
				</td>
				<td colspan='4'> <!-- NUMBER FOUR : Place of Birth : 60 character limit, joining town/city and province -->
					4. Place of Birth
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='50%'><input id = 'city' class='text' type = 'text' name = 'city' maxlength = '30'/></td> <!-- TOWN/CITY -->
							<td width='50%'><input id = 'prov2' class='text' type = 'text' name = 'prov2' maxlength = '30'/></td> <!-- PROVINCE -->
						</tr>
						<tr>
							<td>Town/City</td>
							<td>Province</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='2'> <!-- NUMBER FIVE : Gender (REQUIRED) : Male or female -->
					5. Gender <a id='alert' title='Required field'>*</a><br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='50%'><input type = 'radio' name = 'gender' value = 'm' checked />Male</td>
							<td width='50%'><input type = 'radio' name = 'gender' value = 'f'/>Female</td>
						</tr>
					</table>
				</td>
				<td colspan='4'> <!-- NUMBER SIX : Civil status (REQUIRED) : Single, Married, Widowed or Separated -->
					6. Civil Status <a id='alert' title='Required field'>*</a><br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='25%'><input type = 'radio' name = 'civil' value = 'single' checked />Single</td>
							<td width='25%'><input type = 'radio' name = 'civil' value = 'married' />Married</td>
							<td width='25%'><input type = 'radio' name = 'civil' value = 'widowed' />Widowed</td>
							<td width='25%'><input type = 'radio' name = 'civil' value = 'separated' />Separated</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='3'> <!-- NUMBER SEVEN : If married (Highlight if civil status is married, else disable) -->
					7. If married, specify the name of spouse:<br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='33%'> <!-- SURNAME OF SPOUSE : 15 character limit -->
								<input type = 'text' class='text' name = 'spouse_sname' id = 'spouse_sname' maxlength = '15' size='10'/>
							</td>
							<td width='33%'> <!-- FIRST NAME OF SPOUSE : 25 character limit -->
								<input type = 'text' class='text' name = 'spouse_fname' id = 'spouse_fname' maxlength = '15' size='10'/>
							</td>
							<td width='33%'> <!-- MIDDLE NAME OF SPOUSE : 15 character limit -->
								<input type = 'text' class='text' name = 'spouse_mname' id = 'spouse_mname' maxlength = '15' size='10'/>
							</td>
						</tr>
						<tr>
							<td>Surname</td>
							<td>First name</td>
							<td>Middle name</td>
						</tr>
						<tr> <!-- OCCUPATION OF SPOUSE : 25 character limit -->
							<td colspan='1'>Occupation:</td>
							<td colspan='2'><input type = 'text' class='text' name = 'spouse_occupation' id = 'spouse_occupation' maxlength = '25'/></td>
						</tr>
						<tr> <!-- CONTACT NUMBER OF SPOUSE : 20 character limit -->
							<td colspan='1'>Contact number:</td>
							<td colspan='2'><input type = 'text' class='text' name = 'spouse_cnum' id = 'spouse_cnum' maxlength = '40'/></td>
						</tr>
						<tr> <!-- NUMBER OF CHILDREN : 3 integer limit -->
							<td colspan='1'>Number of children:</td>
							<td colspan='2'><input type = 'text' class='text' name = 'spouse_childno' id = 'spouse_childno' maxlength = '3' size = '1'/></td>
						</tr>
					</table>
				</td>
				<td colspan='3'> <!-- NUMBER EIGHT : If single, widowed, separated (Highlight if civil status is single, widowed or separated, else disable) -->
					8. If single, widow or separated, specify the name of person to be contacted in case of emergency:<br />
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr> <!-- NAME OF PERSON TO BE CONTACTED IN CASE OF EMERGENCY -->
							<td width='33%'> <!-- SURNAME : 15 character limit -->
								<input type = 'text' class='text' name = 'rel_sname' id = 'rel_sname' maxlength = '15' size='10'/>
							</td>
							<td width='33%'> <!-- FIRST NAME : 25 character limit -->
								<input type = 'text' class='text' name = 'rel_fname' id = 'rel_fname' maxlength = '25' size='10'/>
							</td>
							<td width='33%'> <!-- MIDDLE NAME : 15 character limit -->
								<input type = 'text' class='text' name = 'rel_mname' id = 'rel_mname' maxlength = '15' size='10'/>
							</td>
						</tr>
						<tr>
							<td>Surname</td>
							<td>First name</td>
							<td>Middle name</td>
						</tr>
						<tr> <!-- ADDRESS OF PERSON TO BE CONTACTED IN CASE OF EMERGENCY : 60 character limit -->
							<td colspan='1'>Address:</td>
							<td colspan='2'><input type = 'text' class='text' name = 'rel_address' id = 'rel_address' maxlength = '60'/></td>
						</tr>
						<tr> <!-- CONTACT NUMBER OF PERSON TO BE CONTACTED IN CASE OF EMERGENCY : 11 character limit -->
							<td colspan='1'>Contact number:</td>
							<td colspan='2'><input type = 'text' class='text' name = 'rel_cnum' id = 'rel_cnum' maxlength = '40'/></td>
						</tr>
					</table> 
				</td>
			</tr>
			<tr>
				<td colspan='6'>
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr> <!-- NUMBER NINE : License -->
							<td width='20%' >9. License Number <a id='alert' title='Required field'>*</a>:</td> <!-- LICENSE : 20 character limit -->
							<td width='80%'><input id = 'licnum' class='text' type = 'text' name = 'licnum' maxlength = '20'/></td>
						</tr>
						<tr>
							<td>Place obtained:</td> <!-- PLACE OBTAINED : 60 character limit -->
							<td><input type = 'text' id = 'placelic' class='text' name = 'placelic' maxlength = '60'/></td>
						</tr>
						<tr> <!-- EXPIRATION DATE (REQUIRED) : Format YYYY-MM-DD -->
							<td>Expiration Date <a id='alert' title='Required field'>*</a>:</td>
							<td>(MM) <select id='expirelicmonth' name='expirelicmonth'>
									<option value='01'>January</option>
									<option value='02'>February</option>
									<option value='03'>March</option>
									<option value='04'>April</option>
									<option value='05'>May</option>
									<option value='06'>June</option>
									<option value='07'>July</option>
									<option value='08'>August</option>
									<option value='09'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
								</select>
								<!--<input id = 'expirelicmonth' type = 'text' name = 'expirelicmonth' maxlength = '30' size = '1'/>-->
								(DD) <select id = 'expirelicday' name='expirelicday'>";
									
		// Generate the days 1 to 31 for the option tag.
		for ($i = 1; $i<=31; $i++) { 
			echo "<option value='". $i ."'>". $i ."</option>\n"; 
		}
		
		echo 					"</select>
								(YYYY) <select id = 'expirelicyear' name='expirelicyear'>";
		
		// Generate year three years from now until 1930.
		for ($i = date("Y") + 3; $i>1929; $i--) { 
			echo "<option value='". $i ."'>". $i ."</option>\n"; 
		}
								
		echo "					</select>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> <!-- NUMBER TEN : OWNERSHIP OF JEEPNEY -->
				<td colspan='6'>
					10. Do you own the jeepney you are driving?
					<table id='innertable' cellpadding='0' cellspacing='0'>
						<tr>
							<td width='50%' colspan='2'><input type = 'radio' name = 'yesno' value = 'yes' checked='checked' />Yes</td>
							<td width='50%' colspan='2'><input type = 'radio' name = 'yesno' value = 'no' />No</td>
						</tr>
						<tr> <!-- YES : PLATE NUMBER -->
							<td width='17%'>Plate Number <a id='alert' title='Required field'>*</a>:</td>
							<td width='33%'><input type = 'text' class='text' name = 'plateno' id = 'plateno' maxlength = '6'/></td>
							<!-- NO : NAME OF OPERATOR -->
							<td width='17%'>Name of Operator:</td>
							<td width='33%'><input type = 'text' class='text' name = 'nopfname' id = 'nopfname' maxlength = '30' size='10' /> (First name)<br />
								<input type = 'text' class='text' name = 'nopsname' id = 'nopsname' maxlength = '30' size='10'/> (Surname)
							</td>
						</tr>
						<tr> <!-- YES : UPLB Sticker Number -->
							<td>UPLB Sticker Number:</td>
							<td><input type = 'text' class='text' name = 'stickerno' id = 'stickerno' maxlength = '20'/></td>
							<!-- NO : PLATE NUMBER -->
							<td>Plate Number <a id='alert' title='Required field'>*</a>:</td>
							<td><input type = 'text' class='text' name = 'nplateno' id = 'nplateno' maxlength = '6'></td>
						</tr>
						<tr> <!-- YES : Expiration of Franchise (REQUIRED) -->
							<td>Expiration of Franchise <a id='alert' title='Required field'>*</a>:</td>
							<td>Month: <select id='expirefranmonth' name='expirefranmonth'>
									<option value='01'>January</option>
									<option value='02'>February</option>
									<option value='03'>March</option>
									<option value='04'>April</option>
									<option value='05'>May</option>
									<option value='06'>June</option>
									<option value='07'>July</option>
									<option value='08'>August</option>
									<option value='09'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
								</select><br />
								Day: <select id='expirefranday' name='expirefranday'>";
		
		// Generate the days 1 to 31 for the option tag.
		for ($i = 1; $i <=31; $i++) { 
			echo "<option value='". $i ."'>". $i ."</option>\n"; 
		}
		
		echo "						</select><br />
									Year: <select id='expirefranyear' name='expirefranyear'>";
										
		// Generate year three years from now until 1930.
		for ($i = date("Y") + 3; $i>1929; $i--) { 
			echo "<option>$i</option>\n"; 
		}
		
		echo "						</select>
								</td>
								<!-- NO : UPLB Sticker Number -->
								<td>UPLB Sticker Number:</td>
								<td><input type = 'text' class='text' name = 'nstickerno' id = 'nstickerno' maxlength = '10'/></td>
							</tr>
							<tr> <!-- YES : Contact Number -->
								<td>Contact Number:</td>
								<td><input type = 'text' class='text' name = 'cnum2' id = 'cnum2' maxlength = '11'/></td>
								<!-- NO : Expiration of Franchise -->
								<td>Expiration of Franchise <a id='alert' title='Required field'>*</a>:</td>
								<td>Month: <select id='nexpirefranmonth' name='nexpirefranmonth'>
										<option value='01'>January</option>
										<option value='02'>February</option>
										<option value='03'>March</option>
										<option value='04'>April</option>
										<option value='05'>May</option>
										<option value='06'>June</option>
										<option value='07'>July</option>
										<option value='08'>August</option>
										<option value='09'>September</option>
										<option value='10'>October</option>
										<option value='11'>November</option>
										<option value='12'>December</option>
									</select><br />
									Day: <select id='nexpirefranday' name='nexpirefranday'>";
									
		// Generate the days 1 to 31 for the option tag.
		for ($i = 1; $i<=31; $i++) {
			echo "<option value='". $i ."'>". $i ."</option>\n"; 
		}
		
		echo "						</select><br />
									Year: <select id='nexpirefranyear' name='nexpirefranyear'>";
										
		// Generate year three years from now until 1930.
		for ($i = date("Y") + 3; $i>1929; $i--)  { 
			echo "<option>$i</option>\n"; 
		}
		
		echo "						</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td> <!-- NO : Contact Number -->
								<td>Contact Number:</td>
								<td><input type = 'text' class='text' name = 'ncnum2' id = 'ncnum2' maxlength = '40'/></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan='6'><center><input class = 'submit' type='submit' name='submit' value='Submit' />
					</center></td>
				</tr>
			</form>
		</table>
		<p align='center'><b>REMINDER:</b> Before submitting this form, please make sure that you have a picture of the driver to upload and that you have double checked the information you filled in.<br /><span id='alert'>*</span> Required fields.</p>";
		
		// Display footer.
		include("footer.php");
	}
?>