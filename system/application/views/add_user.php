<?php
	// PAGE DESCRIPTION: This page displays the form to add a record to the database.
	
	// Retrieves the logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display form to add user.
		echo "<h1>Register a user</h1>";
		$attr2 = array('class' => 'form2', 'id' => 'form2');
		echo form_open('admin_controller/requestAddUser', $attr2);
		
		echo "<FORM BANE='form2'>
			<TABLE cellpadding='0' cellspacing='0' width='100%' id='user'>
				<TR>
					<TD width='15%' colspan='1'>Username:</TD>
					<TD width='35%'><INPUT TYPE='TEXT' class='text' id='text' name='username' /></TD>
					<td width='15%'>E-mail:</td>
					<td width='35%'><input type='text' id='text' class='text' name='email' /></td>
				</TR>
				<TR>
					<TD>Password:</TD>
					<TD><INPUT TYPE='password' id='text' class='text' name='password' /></TD>
					<td>Code:</td>
					<td><input type='text' id='text' class='text' name='code' /></td>
				</TR>
				<TR>
					<TD>Role:</TD>
					<TD>
						<select name='role'>
							<option value='studentassistant'>Student Assistant</option>
							<option value='upf'>University Police Force</option>
						</select>
					</TD>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</TR>
				<TR>
					<TD colspan='4'><br /><center><input class='submit' type='submit' value='Submit' /></center></TD>
				</TR>
			</TABLE>
		</FORM>";
		
		// Display footer.
		include("footer.php");
	}
?>