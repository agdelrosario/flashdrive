<?php
	// PAGE DESCRIPTION: This page displays the homepage of the system.
	
	// Retrieves all the users in the database.
	$this->load->database();
	$query = $this->db->get('user', '*');
	
	// Variable declaration.
	$checker = 0;
	
	if ($query->num_rows == 0) redirect('main/'); // If there are no users, view the log-in page.
	else { // If there are users and the user is logged, display the homepage.
		foreach ($query->result() as $row) {
			if ($checker == 0) {
				if ($row->logged == 'true' && $row->ip == $this->input->ip_address()) {
					$checker++;
					
					// Display header and sidebar.
					include("header.php");
					$role = $row->role;
					$username = $row->username;
					include("sidebar.php");
					
					// Display content.
					echo "<h1>Introduction</h1>
					<p>";
					include("welcome.php");
					echo "If you are in need of help regarding the use of the site, please check the <a href='" . base_url() . "index.php/admin_controller/manual'>manual</a>. If there is anything you want to change in the database, contact the <a href='" . base_url() . "index.php/admin_controller/developers'>developer team</a>, especially if the software program will be touched by other developers.</p>
					<p>This site is best viewed in Google Chrome and Mozilla Firefox.</p>";
					
					// Display footer.
					include("footer.php");
				}
			}
		}
	}
	
?>