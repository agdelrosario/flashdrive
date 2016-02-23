<?php
	// PAGE DESCRIPTION: This page displays the verification form.
	
	// Retrieve logged user.
	$query = $_POST;
	
	// Variable declaration.
	$checker = 0;
	
	if ($query->num_rows == 0) displayContent();
	else redirect ('admin_controller/home');
	
	function displayContent() {
		// Display header and sidebar.
		include("header.php");
		$checker = 0;
		include("sidebar.php");
	
		echo "<h1>Verify your account</h1>";
		$attr2 = array ('class' => 'form2', 'id' => 'form2');
		echo form_open('admin_controller/verifyAccount', $attr2);
		
		echo "<form bane='form2'>
			<table cellpadding='0' cellspacing='0' id='user' width='100%'>
				<tr>
					<td width='15%'>Username:</td>
					<td width='35%'><input type='text' class='text' id='text' name='username' /></td>
					<td width='25%'>&nbsp;</td>
					<td width='25%'>&nbsp;</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td colspan='3'><input type='password' class='text' id='text' name='password' /></td>
				</tr>
				<tr>
					<td>Code:</td>
					<td colspan='3'><input type='text' class='text' id='text' name='code' /></td>
				</tr>
				<tr>
					<td colspan='2'><center><input class='submit' type='submit' value='Submit' /></center></td>
					<td width='25%'>&nbsp;</td>
					<td width='25%'>&nbsp;</td>
				</tr>
			</table>
		</form>";
		
		// Display footer.
		include("footer.php");
	}
?>