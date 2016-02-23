<?php
	$query = $_POST;
	
	$q = $this->Users->logged();
	$checker = 0;
	
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
	else displayProfile($data, $query);
	
	function displayProfile ($data, $query) {
		include("header.php");
		$role = $data['role'];
		$username = $data['username'];
		$checker = 1;
		include("sidebar.php");
		
		$checker = 0;
		
		foreach ($query->result() as $row) {
			if ($checker == 0) {
				echo "<h1>" . $row->username . " <a href='" . base_url() . "index.php/admin_controller/editUser/" . $row->username . "'>[Edit]</a>";
				if ($row->role != 'administrator') echo " <a href='" . base_url() . "index.php/admin_controller/deleteUser/" . $row->username . "'>[Delete]</a>";
				echo "</h1>";
			}
			
			echo "<table class='addform'>
				<tr>
					<td width='25%'>Username:</td>
					<td width='25%'>" . $row->username . "</td>
					<td width='25%'>Password:</td>
					<td width='25%'>" . $row->password . "</td>
				</tr>
				<tr>
					<td width='25%'>E-mail:</td>
					<td width='25%'>" . $row->email . "</td>
					<td width='25%'>Code:</td>
					<td width='25%'>" . $row->code . "</td>
				</tr>
				<tr>
					<td width='25%'>Verified account:</td>
					<td width='25%'>";
			
			if ($row->verified == "true") echo "Yes";
			else if ($row->verified == "false") echo "No";
			
			echo "</td>
				<td>Role:</td>
				<td>";
			
			if ($row->role == "administrator") echo "Administrator";
			else if ($row->role == "studentassistant") echo "Student Assistant";
			else if ($row->role == "upf") echo "University Police Force";
			
			echo "</td>
				</tr>
			</table>";
		}
		
		include("footer.php");
	}
?>