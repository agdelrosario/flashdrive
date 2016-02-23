<?php
	// PAGE DESCRIPTION: This page displays the form to change the password of a certain user.
	
	// Retrived logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display the header and the sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		// Display the form.
		echo "<h1>Change password</h1>";
		$attr2 = array('class' => 'form2', 'id' => 'form2');
		echo form_open('admin_controller/requestChangePassword', $attr2) . "
		<FORM BANE='form2'>
		<TABLE cellpadding='0' cellspacing='0' width='100%' id='user'>
			<TR>
				<TD width='15%' colspan='1'>Old password:</TD>
				<TD width='35%'><INPUT TYPE='password' class='text' id='text' name='oldpassword' /></TD>
				<td width='15%'>New password:</td>
				<td width='35%'><input type='password' id='text' class='text' name='newpassword' /></td>
			</TR>
			<TR>
				<TD colspan='4'><br /><center><input class='submit' type='submit' value='Submit' /></center></TD>
			</TR>
		</TABLE>
	</FORM>";
		
		// Display the footer.
		include("footer.php");
	}
?>