<?php
	// PAGE DESCRIPTION: This page displays the form to add a violation to a certain record.
	
	// Retrieves the record where the violation will be added to.
	$query = $_POST;
	
	// Retrieves the logged user.
	$q = $this->Users->logged();
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($q->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent($role, $username, $query) {
		// Display header and footer.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display the form.
		foreach ($query->result() as $row) {
			$attr2 = array('class' => 'form2', 'id' => 'form2');
			echo form_open('add_controller/requestAddViolation/' . $row->idnum ,$attr2) .
			"<h1>Add Violation to " . $row->surname . ", " . $row->firstname . " " . $row->midname . "</h1>
			<FORM BANE='form2'>
				<TABLE CLASS='violations' cellpadding='0' cellspacing='0'>
				<TR>
					<TD>Name of violation:</TD>
					<TD COLSPAN='3'><INPUT TYPE='TEXT' class='text' id='text' name='violation' /></TD>
				</TR>
				<TR>
					<TD>Officer in charge:</TD>
					<TD><INPUT TYPE='TEXT' id='text' class='text' name='officer_surname'></TD>
					<TD><INPUT TYPE='TEXT' id='text' class='text' name='officer_firstname'></TD>
					<TD><INPUT TYPE='TEXT' id='text' class='text' name='officer_middlename'></TD>
				</TR>
				<TR>
					<TD></TD>
					<TD>Last Name</TD>
					<TD>First Name</TD>
					<TD>Middle Name</TD>
				</TR>
				<TR>
					<TD>Date:</TD>
					<TD>Month:
						<select name='month'>
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
					</TD>
					<TD>Day:
						<select name='day'>";
						
			// Generate days 1 to 31.
			for ($i = 1; $i<=31; $i++) { 
				echo "<option value='$i'>$i</option>\n"; 
			}
			
			echo "		</select>
					</TD>
					<!--<input id = 'text' type = 'text' name = 'expirefranday' maxlength = '30' size  = '1'/>-->
					<TD>Year:
						<select name='year'>";
			
			// Generate from present year until 1930.
			for ($i = date("Y"); $i>1929; $i--) { 
				echo "<option value='$i'>$i</option>\n"; 
			}
			
			echo "		</select>
						</TD>
					</TR>
					<TR>
						<TD COLSPAN='4'><center><input class='submit' type='submit' value='Submit' /></center></TD>
					</TR>
				</TABLE>
			</FORM>";
			}
		include("footer.php");
	}
?>