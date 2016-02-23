<?php
	// PAGE DESCRIPTION: This page displays the form to add another ID to a certain record.
	
	// Retrieves the record where the ID number will be added to.
	$query = $_POST;
	
	// Retrieves the logged user.
	$q = $this->Users->logged();
	
	if ($q->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($q->result() as $row) {
			displayContent($row->role, $row->username, $query);
		}
	}
	
	function displayContent($role, $username, $query) {
		// Displays the header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display the form.
		foreach ($query->result() as $row) {
			$attr2 = array('class' => 'form2', 'id' => 'form2');
			echo form_open('add_controller/requestAddID/' . $row->idnum ,$attr2);
				
			echo "<h1>Add a new ID to " . $row->surname . ", " . $row->firstname . " " . $row->midname . "</h1>
			<FORM BANE='form2'>
				<TABLE CLASS='users' cellpadding='0' cellspacing='0' width='100%'>
					<TR>
						<TD width='15%'>New ID number:</TD>
						<TD width='35%'><INPUT TYPE='TEXT' class='text' id='text' name='newid' /></TD>
						<td width='15%'>Color:</td>
						<td width='35%'>
							<select name='color'>
								<option value='blue'>Blue</option>
								<option value='yellow'>Yellow</option>
							</select>
						</td>						
					</TR>
					<TR>
						<TD COLSPAN='4'><center><input class='submit' type='submit' value='Submit' /></center></TD>
					</TR>
				</TABLE>
			</FORM>";
		}
		
		// Display the footer.
		include("footer.php");
	}
?>