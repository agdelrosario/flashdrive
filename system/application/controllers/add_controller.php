<?php // This controller is for add functionalities.

	class Add_Controller extends Controller {

		function Add_Controller() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
		}
		
		function index() { // Displays the add record page.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) $this->load->view('add_record', array('query' => $query));
					else redirect('main/');
				}
			}
		}
		
		function requestAdd() { // Adds the record to the database.
			$query = $this->Users->logged();
			$checker = 0;
			$counter = 0;
			$this->db->select ('idnum');
			$this->db->from ('drivers');
			$idno = $this->db->get();
			$primary = $_POST['idnumb'];
			foreach($idno->result() as $idnoResult) {
				$var = $idnoResult->idnum;
				if ($var == $primary) $counter++;
			}
			if ($query->num_rows == 0) redirect('main/'); // No user is logged in.
			else { // A user has logged in.
				if ($counter == 0 ) {
					// Error checking.
					if ($_POST['idnumb'] == "" || $_POST['surname'] == "" || $_POST['fname'] == "" || $_POST['mname'] == "" || $_POST['licnum'] == "" || $_POST['plateno'] == "") $this->load->view('add_failed');
					else {
					// Adding.
						foreach ($query->result() as $row) {
							if ($row->role != 'upf' && $checker++ == 0) {
								/*if($_POST['civil'] == 'married') {
									if($_POST['yesno'] == 'yes') { // Owns jeepney
										$data = array(
											'idnum' => $_POST['idnumb'] ,
											'idcolor' => $_POST['idcolor'] ,
											'surname' => $_POST['surname'] ,
											'firstname' => $_POST['fname'],
											'midname' => $_POST['mname'],
											'street' => $_POST['sno'],
											'barangay' => $_POST['brgy'],
											'municipality' => $_POST['municipality'],
											'province' => $_POST['prov'],
											'dob' => $_POST['year']."-".$_POST['month']."-".$_POST['day'],
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
											'idnum' => $_POST['idnumb'] ,
											'idcolor' => $_POST['idcolor'] ,
											'surname' => $_POST['surname'] ,
											'firstname' => $_POST['fname'],
											'midname' => $_POST['mname'],
											'street' => $_POST['sno'],
											'barangay' => $_POST['brgy'],
											'municipality' => $_POST['municipality'],
											'province' => $_POST['prov'],
											'dob' => $_POST['year']."-".$_POST['month']."-".$_POST['day'],
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
											'operator' => $_POST['nopfname']."-".$_POST['nopsname']
										);
									}
								}
								else { // Single
									if($_POST['yesno'] == 'yes') { // Owns jeepney
										$data = array(
											'idnum' => $_POST['idnumb'] ,
											'idcolor' => $_POST['idcolor'] ,
											'surname' => $_POST['surname'] ,
											'firstname' => $_POST['fname'],
											'midname' => $_POST['mname'],
											'street' => $_POST['sno'],
											'barangay' => $_POST['brgy'],
											'municipality' => $_POST['municipality'],
											'province' => $_POST['prov'],
											'dob' => $_POST['year']."-".$_POST['month']."-".$_POST['day'],
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
											'idnum' => $_POST['idnumb'] ,
											'idcolor' => $_POST['idcolor'] ,
											'surname' => $_POST['surname'] ,
											'firstname' => $_POST['fname'],
											'midname' => $_POST['mname'],
											'street' => $_POST['sno'],
											'barangay' => $_POST['brgy'],
											'municipality' => $_POST['municipality'],
											'province' => $_POST['prov'],
											'dob' => $_POST['year']."-".$_POST['month']."-".$_POST['day'],
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
								}*/
								$data = array(
									'idnum' => $_POST['idnumb'] ,
									'idcolor' => $_POST['idcolor'] ,
									'surname' => $_POST['surname'] ,
									'firstname' => $_POST['fname'],
									'midname' => $_POST['mname'],
									'street' => $_POST['sno'],
									'barangay' => $_POST['brgy'],
									'municipality' => $_POST['municipality'],
									'province' => $_POST['prov'],
									'dob' => $_POST['year']."-".$_POST['month']."-".$_POST['day'],
									'pob' => $_POST['city'].",".$_POST['prov2'],
									'gender' => $_POST['gender'],
									'civil' => $_POST['civil'],
									'jeep' => $_POST['yesno'],
									'spouse_sname' => $_POST['spouse_sname'],
									'spouse_fname' => $_POST['spouse_fname'],
									'spouse_mname' => $_POST['spouse_mname'],
									'spouse_occ' => $_POST['spouse_occupation'],
									'spouse_contact' => $_POST['spouse_cnum'],
									'emer_sname' => $_POST['rel_sname'],
									'emer_fname' => $_POST['rel_fname'],
									'emer_mname' => $_POST['rel_mname'],
									'emer_address' => $_POST['rel_address'],
									'emer_contact' => $_POST['rel_cnum'],
									'children' => $_POST['spouse_childno'],
									'license' => $_POST['licnum'],
									'license_place' => $_POST['placelic'],
									'license_exp' => $_POST['expirelicyear']."-".$_POST['expirelicmonth']."-".$_POST['expirelicday'],
									'plate_number' => $_POST['plateno'],
									'sticker_number' => $_POST['stickerno'],
									'franchise_exp' => $_POST['expirefranyear']."-".$_POST['expirefranmonth']."-".$_POST['expirefranday'],
									'contact' => $_POST['cnum2'],
									'operator' => $_POST['nopfname']."-".$_POST['nopsname']
								);
								
								$id = array ('idno' => $_POST['idnumb']);
								$status = $this->Users->ID($id);
								$status = $this->Users->addData($data);
								
								$this->load->view('add_image');
							}
							else {
								$query = $this->Users->logged();
								$_POST = $query;
								$this->load->view('add_image', $_POST);
							}
						}
					}
				}
				else redirect ('main/');
			}
		}
		
		function addViolation($data) { // Displays add violation form.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) {
						$query = $this->Users->searchByID($data);
						$_POST = $query;
						$this->load->view('add_violation', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestAddViolation($data) { // Adds violation.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker == 0) {
						$d = $this->Users->searchByID($data);
						$checker++;
						
						foreach ($d->result() as $row) {
							$data = array(
							   'idno' => $row->idnum ,
							   'surname' => $row->surname ,
							   'firstname' => $row->firstname,
							   'middlename' => $row->midname,
							   'violation' => $_POST['violation'],
							   'officer' => $_POST['officer_surname'].", ".$_POST['officer_firstname']." ".$_POST['officer_middlename'],
							   'date' => $_POST['year']."-".$_POST['month']."-".$_POST['day']
							);
							
							$status = $this->Users->addViolation($data);
							redirect('view_controller/requestProfile/' . $row->idnum);
						}
					}
					else redirect('main/');
				}
			}
		}
		
		function deleteViolation ($data) { // Deletes violation.
			$q = $this->Users->logged();
			$_POST = $q;
			$num = strtok($data, "-");
			$idnum = strtok("-");
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) {
						$this->Users->deleteViolation($num, $idnum);
						redirect('view_controller/requestProfile/' . $idnum);
					}
					else redirect('main/');
				}
			}
		}
		
		function addImage() { // Displays upload form.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) $this->load->view('add_image');
					else redirect('main/');
				}
			}
		}

		function doUpload() { // Uploads images to the uploads folder.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) {
						$query = $this->db->get('current_id', 'idno');
					
						foreach($query->result() as $row) {
							$var = $row->idno;
						}
					
						$config['upload_path'] = 'uploads/';
						$config['allowed_types'] = 'jpg|jpeg';
						$config['max_size'] = '1000';
						$config['max_width'] = '1920';
						$config['max_height'] = '1280';
						$config['file_name'] = $var;

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload()) { 
							$error = $this->upload->display_errors();
							$this->load->view ('add_image', $error);
						}
						else {
							$fInfo = $this->upload->data();
							$this->_createThumbnail($fInfo['file_name']);
							
							$data['uploadInfo'] = $fInfo;
							$data['thumbnail_name'] = $fInfo['raw_name'] . '_thumb' . $fInfo['file_ext'];
							$this->load->view('home');
						}
					}
					else redirect('main/');
				}
			}
		}

		function _createThumbnail($fileName) { // Creates thumbnail for the uploaded image.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) {
						$config['image_library'] = 'gd2';
						$config['source_image'] = 'uploads/' . $fileName;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 100;
						$config['height'] = 100;
						$this->load->library('image_lib', $config);
						
						if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
					}
					redirect('main/');
				}
			}
		}
		
		function addID ($data) { // Displays Add ID form.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $checker++ == 0) {
						$query = $this->Users->searchByID($data);
						$_POST = $query;
						$this->load->view('add_id', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestAddID ($data) { // Adds ID to a record.
			$q = $this->Users->logged();
			$checker = 0;
			$counter = 0;
			$idno = $this->db->get('drivers', 'idnum');
			$primary = $_POST['newid'];
			
			foreach($idno->result() as $idnoResult) {
				$var = $idnoResult->idnum;
				if ($var == $primary) $counter++;
			}
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				if ($counter == 0) {
					foreach ($q->result() as $row) {
						if ($_POST['newid'] != "") {
							if ($row->role != 'upf' && $row->logged == 'true' && $checker++ == 0) {
								$d = $this->Users->searchByID($data);
								
								foreach ($d->result() as $row) {
									$data = array(
									   'fromrecord' => $row->idnum ,
									   'idno' => $_POST['newid'],
									   'color' => $_POST['color']
									);
									
									$status = $this->Users->addID($data);
									redirect('view_controller/requestProfile/' . $row->idnum);
								}
							}
							else redirect('main/');
						}
						else redirect('main/');
					}
				}
				else redirect('main/');
			}
		}
	}
?>