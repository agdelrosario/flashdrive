<?php
	echo "<div id='anchors'>";
	if ($row->role != 'administrator') echo "<a href='" . base_url() . "index.php/admin_controller/deleteUser/" . $row->username . "'>Delete</a> | ";
	echo "<a href='" . base_url() . "index.php/admin_controller/editUser/" . $row->username . "'>Edit</a>";
	echo "</div>";
?>