<?php
	if ($role != "upf") {
		echo "<div id='anchors'>
		<a href='" . base_url() . "index.php/add_controller/addViolation/" . $row2->idnum . "'>Add Violation</a>
		| <a href='" . base_url() . "index.php/add_controller/addID/" . $row2->idnum . "'>Add ID</a>
		| <a href='" . base_url() . "index.php/edit_controller/requestEdit/" . $row2->idnum . "'>Edit</a>
		</div>";
	}
?>