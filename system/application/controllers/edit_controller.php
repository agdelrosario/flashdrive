<?php // This controller is for editing of a record in the drivers table.

	class Edit_Controller extends Controller {

		function Edit_Controller() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
		}
		
		function requestEdit($data) { // Display the edit form.
			$query = $this->Users->viewProfile($data);
			$_POST = $query;
			$this->load->view('view_prof2', $_POST);
		}
		
		function requestEditRecord($data2) { // Edits the information in a record.
			$q = $this->Users->logged();
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				$this->db->where('idnum', $data2);
				$query = $this->db->get('drivers', '*');
				
				if ($_POST['surname'] == "" || $_POST['fname'] == "" || $_POST['mname'] == "" || $_POST['licnum'] == "" || $_POST['plateno'] == "") $this->load->view('add_failed');
				else {
				
					foreach ($query->result() as $row) {
						// Married
						if($_POST['civil'] == 'married') {
							if($_POST['yesno'] == 'yes') { // Owns jeepney
								$data = array(
								   'idnum' => $data2,
								   'idcolor' => $row->idcolor,
								   'surname' => $_POST['surname'] ,
								   'firstname' => $_POST['fname'],
								   'midname' => $_POST['mname'],
								   'street' => $_POST['sno'],
								   'barangay' => $_POST['brgy'],
								   'municipality' => $_POST['municipality'],
								   'province' => $_POST['prov'],
								   'dob' => $_POST['dobyear']."-".$_POST['dobmonth']."-".$_POST['dobday'],
								   'pob' => $_POST['city'].",".$_POST['prov2'],
								   'gender' => $_POST['gender'],
								   'civil' => $_POST['civil'],
								   'jeep' => $_POST['yesno'],
									'spouse_sname' => $_POST['spouse_sname'],
									'spouse_fname' => $_POST['spouse_fname'],
									'spouse_mname' => $_POST['spouse_mname'],
								   'spouse_occ' => $_POST['spouse_occupation'],
								   'spouse_contact' => $_POST['spouse_cnum'],
								   'children' => $_POST['spouse_childno'],
								   'license' => $_POST['licnum'],
								   'license_place' => $_POST['placelic'],
								   'license_exp' => $_POST['expirelicyear']."-".$_POST['expirelicmonth']."-".$_POST['expirelicday'],
								   'plate_number' => $_POST['plateno'],
								   'sticker_number' => $_POST['stickerno'],
								   'franchise_exp' => $_POST['expirefranyear']."-".$_POST['expirefranmonth']."-".$_POST['expirefranday'],
								   'contact' => $_POST['cnum2'],
								);
							}
							else { // Does not own jeepney
								$data = array(
								   'idnum' => $data2 ,
								   'idcolor' => $row->idcolor ,
								   'surname' => $_POST['surname'] ,
								   'firstname' => $_POST['fname'],
								   'midname' => $_POST['mname'],
								   'street' => $_POST['sno'],
								   'barangay' => $_POST['brgy'],
								   'municipality' => $_POST['municipality'],
								   'province' => $_POST['prov'],
								   'dob' => $_POST['dobyear']."-".$_POST['dobmonth']."-".$_POST['dobday'],
								   'pob' => $_POST['city'].",".$_POST['prov2'],
								   'gender' => $_POST['gender'],
								   'civil' => $_POST['civil'],
									'spouse_sname' => $_POST['spouse_sname'],
									'spouse_fname' => $_POST['spouse_fname'],
									'spouse_mname' => $_POST['spouse_mname'],
								   'spouse_occ' => $_POST['spouse_occupation'],
								   'spouse_contact' => $_POST['spouse_cnum'],
								   'children' => $_POST['spouse_childno'],
								   'jeep' => $_POST['yesno'],
								   'license' => $_POST['licnum'],
								   'license_place' => $_POST['placelic'],
								   'license_exp' => $_POST['expirelicyear']."-".$_POST['expirelicmonth']."-".$_POST['expirelicday'],
								   'plate_number' => $_POST['nplateno'],
								   'sticker_number' => $_POST['nstickerno'],
								   'franchise_exp' => $_POST['nexpirefranyear']."-".$_POST['nexpirefranmonth']."-".$_POST['nexpirefranday'],
								   'contact' => $_POST['ncnum2'],
								   'operator' => $_POST['nopfname']." ".$_POST['nopsname']
								);
							}
						}
						else if($_POST['civil'] == 'single' || $_POST['civil'] == 'widowed' || $_POST['civil'] == 'separated'){ // Single
							if($_POST['yesno'] == 'yes') { // Owns jeepney
								$data = array(
								   'idnum' => $data2 ,
								   'idcolor' => $row->idcolor ,
								   'surname' => $_POST['surname'] ,
								   'firstname' => $_POST['fname'],
								   'midname' => $_POST['mname'],
								   'street' => $_POST['sno'],
								   'barangay' => $_POST['brgy'],
								   'municipality' => $_POST['municipality'],
								   'province' => $_POST['prov'],
								   'dob' => $_POST['dobyear'] . "-" . $_POST['dobmonth'] . "-" . $_POST['dobday'] ,
								   'pob' => $_POST['city'].",".$_POST['prov2'],
								   'gender' => $_POST['gender'],
								   'civil' => $_POST['civil'],
								   'jeep' => $_POST['yesno'],
									'emer_sname' => $_POST['rel_sname'],
									'emer_fname' => $_POST['rel_fname'],
									'emer_mname' => $_POST['rel_mname'],
								   'emer_address' => $_POST['rel_address'],
								   'emer_contact' => $_POST['rel_cnum'],
								   'license' => $_POST['licnum'],
								   'license_place' => $_POST['placelic'],
								   'license_exp' => $_POST['expirelicyear']."-".$_POST['expirelicmonth']."-".$_POST['expirelicday'],
								   'plate_number' => $_POST['plateno'],
								   'sticker_number' => $_POST['stickerno'],
								   'franchise_exp' => $_POST['expirefranyear']."-".$_POST['expirefranmonth']."-".$_POST['expirefranday'],
								   'contact' => $_POST['cnum2'],
								);
							}
							else { // Does not own jeepney
								$data = array(
								   'idnum' => $data2 ,
								   'idcolor' => $row->idcolor ,
								   'surname' => $_POST['surname'] ,
								   'firstname' => $_POST['fname'],
								   'midname' => $_POST['mname'],
								   'street' => $_POST['sno'],
								   'barangay' => $_POST['brgy'],
								   'municipality' => $_POST['municipality'],
								   'province' => $_POST['prov'],
								   'dob' => $_POST['dobyear']."-".$_POST['dobmonth']."-".$_POST['dobday'],
								   'pob' => $_POST['city'].",".$_POST['prov2'],
								   'gender' => $_POST['gender'],
								   'civil' => $_POST['civil'],
								   'jeep' => $_POST['yesno'],
									'emer_sname' => $_POST['rel_sname'],
									'emer_fname' => $_POST['rel_fname'],
									'emer_mname' => $_POST['rel_mname'],
								   'emer_address' => $_POST['rel_address'],
								   'emer_contact' => $_POST['rel_cnum'],
								   'license' => $_POST['licnum'],
								   'license_place' => $_POST['placelic'],
								   'license_exp' => $_POST['expirelicyear']."-".$_POST['expirelicmonth']."-".$_POST['expirelicday'],
								   'plate_number' => $_POST['nplateno'],
								   'sticker_number' => $_POST['nstickerno'],
								   'franchise_exp' => $_POST['nexpirefranyear']."-".$_POST['nexpirefranmonth']."-".$_POST['nexpirefranday'],
								   'contact' => $_POST['ncnum2'],
								   'operator' => $_POST['nopfname']."-".$_POST['nopsname']
								);
							}
						}
						
						$_POST = $data2;
						$query = $this->Users->EditRecord($data);
						redirect('main/');
					}
				}
			}
		}
		
	}
?>