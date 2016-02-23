<?php
	// PAGE DESCRIPTION: This page allows the administrator to edit the information of a user.
	
	// Retrieves information about the user to be edited.
	$query = $_POST;
	
	// Retrieves logged user.
	$q = $this->Users->logged();
	
	if ($q->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($q->result() as $row) {
			if (row->role != "upf") displayContent($row->role, $row->username, $query);
			else redirect('main/');
		}
	}
	
	function displayContent($role, $username, $query) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display edit form.
		foreach ($query->result() as $row) {
			echo "<h1>Edit " . $row->username . "'s information</h1>";
			$attr2 = array('class' => 'form2', 'id' => 'form2');
			echo form_open('admin_controller/requestEditUser/' . $row->username,$attr2);
			
			echo "<FORM BANE='form2'>
				<TABLE cellpadding='0' cellspacing='0' width='100%' id='user'>
					<TR>
						<TD width='15%' colspan='1'>Username:</TD>
						<TD width='35%'><INPUT TYPE='TEXT' class='text' id='text' name='username' value='" . $row->username . "'/></TD>
						<td width='15%'>E-mail:</td>
						<td width='35%'><input type='text' id='text' class='text' name='email' value='" . $row->email . "' /></td>
					</TR>
					<TR>
						<TD>Password:</TD>
						<TD><INPUT TYPE='password' id='text' class='text' name='password' value='" . $row->password . "'/></TD>
						<td>Code:</td>
						<td><input type='text' id='text' class='text' name='code' value='" . $row->code . "'/></td>
					</TR>";
			if ($row->role != 'administrator') {
				echo "<TR>
						<TD>Role:</TD>
						<TD>
							<select name='role'>";
				if ($row->role == 'studentassistant') echo "<option value='studentassistant' selected='selected'>Student Assistant</option>
					<option value='upf'>University Police Force</option>";
				else if ($row->role == 'upf') echo "<option value='studentassistant'>Student Assistant</option>
					<option value='upf' selected='selected'>University Police Force</option>";
				echo "		</select>
						</TD>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</TR>";
			}
			echo "	<TR>
						<TD colspan='4'><br /><center><input class='submit' type='submit' value='Submit' /></center></TD>
					</TR>
				</TABLE>
			</FORM>";
		}
		
		// Display footer.
		include("footer.php");
	}
?>