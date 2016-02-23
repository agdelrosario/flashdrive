<?php
	// PAGE DESCRIPTION: This page displays the log-in page of the system.
	
	// Retrieve all the users in the database.
	$query = $_POST;
	
	// Variable declaration.
	$checker = 0;
	$verified = "true";
	
	if ($query->num_rows != 0) {
		foreach ($query->result() as $row) {
			if ($row->verified == "false") $verified = "false";
			if ($row->logged == 'true' && $checker == 0 && $row->ip == $this->input->ip_address()) $checker++;
		}
	}
	
	if ($checker == 1) redirect('admin_controller/home');
	else {
		displayContent($verified);
		include('footer.php'); // Display footer.
	}
	
	function displayContent ($verified) {
		// Display header and sidebar.
		include("header.php");
		$checker = 0;
		include("sidebar.php");
		
		// Display log-in page contents.
		echo "<h1>Welcome</h1>
			<p>";
		include("welcome.php");
		echo "Access to this site is limited to the staff of OVCCA.</p>
		<h1>Log-in</h1>";
		
		$attr = array('class' => 'loginform', 'id' => 'loginform');
		echo form_open('main/doLogin', $attr);
		echo "<form name='loginform'>
			<table id = 'log-in'>
				<tr>
					<td width = '100px'>Username:</td>
					<td width = '200px'><input id = 'uname' name = 'uname' type = 'text' class = 'username' id = 'username'/></td>
					<td width = '300px' rowspan = '3' valign = 'top'><a href='" . base_url() . "index.php/admin_controller/forgotPassword'>Forgot your password?</a>";
		if ($verified == "false") displayVerify();			
		echo "			<br /><br ></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input id = 'password' name = 'password' type = 'password' class = 'password' id = 'password'/></td>
				</tr>
				<tr>
					<td colspan = '2'><center><input class = 'lbutton' type = 'submit' value = 'Submit' id = 'submit'/></center></td>
				</tr>
				</table>
			</form>";
	}
	
	function displayVerify () { // Display verification link.
		echo "<br /><br />You are not a verified user. <a href='" . base_url() . "index.php/admin_controller/verify'>Please verify your account first.</a>";
	}
?>