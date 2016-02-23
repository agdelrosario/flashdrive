<?php
	// This page generates a table of records.
	
	$query = $_POST;
	
	$q = $this->Users->logged();
	$checker = 0;
	$data = 0;
	
	foreach ($q->result() as $row) {
		if ($checker == 0) {
			$data = array(
				'role' => $row->role,
				'username' => $row->username
			);
			$checker++;
		}
	}
	
	if ($checker == 0) redirect ('main/');
	else displayContent($data, $query);
	
	function displayContent($data, $query) {
		include("header.php");
		$role = $data['role'];
		$username = $data['username'];
		$checker = 1;
		include("sidebar.php");
		
		echo "<h1>View All Users</h1>";
		
		// Generation of the table and its headings.
		echo "<table width='100%' cellpadding='0px' cellspacing='0px' id='viewlist'>
			<tr>
				<td width='20%'><b>Username</b></td>
				<td width='20%'><b>Role</b></td>
				<td width='20%'><b>Code</b></td>
				<td width='20%'><b>Verified</b></td>
				<td width='20%' align='right'><b>Functions</b></td>
			</tr>";
		
		// Accessing and printing of the fetched data.
		foreach ($query->result() as $row) {	
			if ($checker % 2 == 0) echo "<tr class='altcolor2'>";
			else echo "<tr class='altcolor1'>";
			echo "<td><a href='" . base_url() . "index.php/admin_controller/viewUserProfile/" . $row->username . "'>" . $row->username . "</a></td>
			<td>";
			if ($row->role == 'administrator') echo "Administrator";
			else if ($row->role == 'upf') echo "University Police Force";
			else if ($row->role == 'studentassistant') echo "Student Assistant";
			echo "</td>
			<td>" . $row->code . "</td>
			<td> " . $row->verified . "</td>
			<td align='right'>";
			include('anchors2.php');
			echo "</td>";
			$checker++;
		}
		
		echo "</table>";
		echo '<p>Total number of users: <b>' . $query->num_rows . "</b></p>";
		include("footer.php");
	}
?>