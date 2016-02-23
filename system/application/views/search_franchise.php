<?php	
	$query = $_POST;
	
	$checker = 0;
	$data = 0;
	
	foreach ($query->result() as $row) {
		if ($row->logged == 'true' && $checker == 0) {
			$data = array (
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

		$attr = array('id' => 'searchform', 'class' => 'searchform');
		echo Form_open('search_controller/requestSearchFranchise', $attr);
		
		echo "
			<h1>Search by Franchise</h1>
			<form name = \"searchform\" method = \"post\">
			<table id = \"searchtable\">
				<tr>
					<td>
						Enter parameter: 
					</td>
					<td>
						<select name='month'>
							<option value='1'>January</option>
							<option value='2'>February</option>
							<option value='3'>March</option>
							<option value='4'>April</option>
							<option value='5'>May</option>
							<option value='6'>June</option>
							<option value='7'>July</option>
							<option value='8'>August</option>
							<option value='9'>September</option>
							<option value='10'>October</option>
							<option value='11'>November</option>
							<option value='12'>December</option>
						</select>
					</td>
					<td>
						<select name='year'>";
								for ($i = date("Y") + 3; $i>1929; $i--) 
								{ 
									echo "<option>$i</option>\n"; 
								}
						echo "</select>
					</td>
					<td>
						<input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\">
					</td>
				</tr>
			</table>
			</form>
		";

		include("footer.php");
	}
?>