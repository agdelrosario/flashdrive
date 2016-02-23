<?php
	// PAGE DESCRIPTION: This page displays the search menu.
	
	// Retrieve logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent ($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		// Display header and sidebar.
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		echo "<script type='text/javascript'>
			function showhide(obj) {
				var options = new Array('surname', 'exp', 'idcolor', 'idnumber', 'platenumber', 'licexp', 'franexp');
				
				for (var i = 0; i < 7; i++) {
					if (options[i] == obj) {
						/*if (obj == 'licexp') {
							show ('exp');
						}*/
						show (obj);
					}
					else hide(options[i]);
				}
			}
		
			function show(obj) {
				obj1 = document.getElementById(obj);
				obj1.style.visibility = 'visible';
				obj1.style.display = 'block';
			}
			
			function hide(obj) {
				obj1 = document.getElementById(obj);
				obj1.style.visibility = 'hidden';
				obj1.style.display = 'none';
			}
		</script>";
		
		// Display the form for searching for records.
		$attr = array('class' => 'form1', 'id' => 'form1');
		
		// Display content.
		echo "<h1>Select a search feature</h1>";
		
		echo "
		<table width='100%' class='visible'>
			<tr>
				<td width='25%'>Search by:</td>
				<td width='25%'>
					<select name='search' onchange='showhide(this.value)'>
						<option>Select search feature</option>
						<option>----------------------</option>
						<option value='surname'>Surname</option>
						<option value='exp'>Expiration of Document</option>
						<option value='idcolor'>ID Color</option>
						<option value='idnumber'>ID Number</option>
						<option value='platenumber'>Plate Number</option>
					</select>
				</td>
				<td width='25%'>&nbsp;</td>
				<td width='25%'>&nbsp;</td>
			</tr>
		</table>
		<div class='invisible' id='surname'>" . form_open('search_controller/searchBySurname', $attr) . "
			<table width='100%'>
				<tr>
					<td width='25%'>Enter surname:</td>
					<td width='25%'><input type='text' id='text' name='sname' class='username' /></td>
					<td width='25%'><input class='lbutton' type='submit' value='Submit' id='submit' /></td>
					<td width='25%'>&nbsp;</td>
				</tr>
			</table>" . form_close() . "
		</div>
		<div class='invisible' id='exp'>" . form_open('search_controller/searchByDocumentExpiration', $attr) . "
			<table width='100%'>
				<tr>
					<td width='25%'>Document type:</td>
					<td width='25%'><input type='radio' name='document_type' value='license' /> License</td>
					<td width='25%'><input type='radio' name='document_type' value='franchise' /> Franchise</td>
					<td width='25%'>&nbsp;</td>
				</tr>
				<tr>
					<td>Expiration date:</td>
					<td><input type='checkbox' name='document_type' value='only year' onclick=\"document.getElementById('month').style.display = this.checked ? 'none' : 'inline'; document.getElementById('month').style.visibility = this.checked ? 'hidden' : 'visible';\" /> Search by year only</td>
					<td>
						<select name='month' id='month'>
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
						<select name='year'>";
		
		// Generate year from three years from now until 1930.
		for ($i = date("Y") + 3; $i>1929; $i--) { 
			echo "<option>$i</option>\n"; 
		}
		
		echo "			</select>
					</td>
					<td><input class='lbutton' type='submit' value='Submit' id='submit' /></td>
				</tr>
			</table>" . form_close() . "
		</div>
		<div class='invisible' id='idcolor'>" . form_open('search_controller/searchByIDColor', $attr) . "
			<table width='100%'>
				<tr>
					<td width='25%'>ID color:</td>
					<td width='25%'><select name='color'>
						<option value='blue'>Blue</option>
						<option value='yellow'>Yellow</option>
					</select></td>
					<td width='25%'>Surname:</td>
					<td width='25%'><input type = \"text\" id = \"sname\" name = \"surname\" class = \"username\"></td>
				</tr>
				<tr>
					<td colspan='4'><center><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\" /></center></td>
				</tr>
			</table>" . form_close() . "
		</div>
		<div class='invisible' id='idnumber'>" . form_open('search_controller/searchByIDNumber', $attr) . "
			<table width='100%'>
				<tr>
					<td width='25%'>ID number:</td>
					<td width='25%'><input type = \"text\" id = \"id\" name = \"id\" class = \"username\"></td>
					<td width='25%'><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\" /></td>
					<td width='25%'>&nbsp;</td>
				</tr>
			</table>" . form_close() . "
		</div>
		<div class='invisible' id='platenumber'>" . form_open('search_controller/searchByPlateNumber', $attr) . "
			<table width='100%'>
				<tr>
					<td width='25%'>Plate Number:</td>
					<td width='25%'><input type = \"text\" id = \"text\" name = \"platenumber\" class = \"username\"></td>
					<td width='25%'><input class = \"lbutton\" type = \"submit\" value = \"Submit\" id = \"submit\" /></td>
					<td width='25%'>&nbsp;</td>
				</tr>
			</table>" . form_close() . "
		</div>";
		
		form_close();
		
		// Display content.
		/*echo "<h1>Select a search feature</h1>
		<ul id='featureselection'>
			<li><a href='" . base_url() . "index.php/search_controller/searchName'>Search by surname</a></li>
			<li><a href='" . base_url() . "index.php/search_controller/searchPlate'>Search by plate number</a></li>
			<li><a href='" . base_url() . "index.php/search_controller/searchID'>Search by ID number</a></li>
			<li><a href='" . base_url() . "index.php/search_controller/searchLicense'>Search by Expiration of Licenses</a></li>
			<li><a href='" . base_url() . "index.php/search_controller/searchFranchise'>Search by Expiration of Franchises</a></li>
			<li><a href='" . base_url() . "index.php/search_controller/searchColor'>Search by ID color</a></li>
		</ul>";*/

		// Display footer.
		include("footer.php");
	}
?>