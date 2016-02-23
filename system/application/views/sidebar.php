<?php
	echo "<dl>";
	
	if ($checker == 1) {
		displayFunctions($role, $username);
		displayAccount($role, $username);
		displayInformation();
	}
	else displayLinks();
	
	echo "
	</div>
	</td>
	<td id='main'>";
	
	function displayFunctions ($role, $username) {
		echo "<p>Welcome, <a href='" . base_url() . "index.php/admin_controller/home'>" . $username . "</a>.</p>
		<dt><a href = '" . base_url() . "'>Functionalities</a></dt>
			<dd>
				<ul>";
		if ($role != "upf") echo "		<li><a href = '". base_url() . "index.php/add_controller/'>Add Record</a></li>";
		if ($role == "administrator") echo "<li><a href = '". base_url() . "index.php/add_controller/addColor'>Add ID Color</a></li>";
		echo "
					<li><a href = '" . base_url() . "index.php/search_controller/'>Search Database</a></li>
					<li><a href = '" . base_url() . "index.php/view_controller/viewMenu'>View Records</a></li>
				</ul>
			</dd>";
	}
	
	function displayAccount($role, $username) {
		echo "
			<dt><a href = '" . base_url() . "'>Account</a></dt>
			<dd>
				<ul>";
		if ($role == "administrator") {
			echo"	<li><a href='" . base_url() . "index.php/admin_controller/addUser'>Register User</a></li>";
			echo"	<li><a href='" . base_url() . "index.php/admin_controller/viewUsers'>View Users</a></li>";
		}
		echo "
					<li><a href='" . base_url() . "index.php/admin_controller/changePassword'>Change Password</a></li>
					<li><a href = '" . base_url() . "index.php/admin_controller/doLogout'>Logout</a></li>
			</ul>
		</dd>";
	}
	
	function displayInformation() {
		echo "<dt><a href = '" . base_url() . "'>Information</a></dt>
			<dd>
				<ul>
					<li><a href='" . base_url() . "index.php/admin_controller/manual'>Manual</a></li>
					<li><a href='" . base_url() . "index.php/admin_controller/developers'>Developers</a></li>
				</ul>
			</dd>
		";
	}
	
	function displayLinks() {
		echo "
			<dt><a href = '" . base_url() . "'>Links</a></dt>
			<dd>
				<ul>
					<!--<li><a href = '/'> About Flash-Drive </a></li>-->
					<li><a href = 'http://ovcca.uplb.edu.ph/' title='Office of the Vice Chancellor for Community Affairs'>OVCCA</a></li>
					<li><a href = 'http://www.ics.uplb.edu.ph' title='Institute of Computer Science'>ICS</a></li>
					<li><a href = 'http://www.uplb.edu.ph' title='University of the Philippines Los Baños'>UPLB</a></li>
				</ul>
			</dd>
		</dl>";
	}
?>