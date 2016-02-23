<?php
	// PAGE DESCRIPTION: This page displays the forgot password form.
	
	// Variable declaration.
	$checker = 0;
	
	if ($query->num_rows == 0) displayContent();
	else redirect ('admin_controller/home');
	
	function displayContent() {
		// Display header and sidebar.
		include("header.php");
		$checker = 0;
		include("sidebar.php");
	
		echo "<h1>Send password to mail</h1>
		<p>To use this function, please make sure that you are connected to the Internet. We will send to the e-mail you provided your password. Thank you.</p>";
		$attr2 = array ('class' => 'form2', 'id' => 'form2');
		echo form_open('admin_controller/sendPassword', $attr2);
		
		echo "<form bane='form2'>
			<table cellpadding='0' cellspacing='0' id='user' width='100%'>
				<tr>
					<td width='15%'>Username:</td>
					<td width='25%'><input type='text' class='text' id='text' name='username' /></td>
					<td width='35%'><input class='submit' type='submit' value='Submit' /></td>
					<td width='25%'>&nbsp;</td>
				</tr>
			</table>
		</form>";
		
		// Display footer.
		include("footer.php");
	}
?>