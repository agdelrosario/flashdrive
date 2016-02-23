<?php
	// This is a model named Users.

	class Users extends Model {
		
		function Users() {
			parent::Model();
			$this->load->database();
		}
		
		// User authentication methods.
		function login($username, $password) {
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('user', '*');
			$_POST = $query;
			
			if ($query->num_rows() <= 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					
					if ($row->verified == "true") {					
						$data = array(
							'username' => $username,
							'password' => $password,
							'logged' => "true",
							'ip' => $this->input->ip_address(),
							'role' => $row->role,
							'email' => $row->email,
							'verified' => $row->verified,
							'code' => $row->code
						);
						
						$this->db->from('user');
						$this->db->where('username', $username);
						$this->db->update('user', $data);
						redirect('admin_controller/home');
					}
					else $this->load->view('login.php', $_POST);
					
				}
			}
		}
		
		function logout($username,$password) {
			
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('user', '*');
			
			foreach ($query->result() as $row) {
				
				$data = array(
					'username' => $username,
					'password' => $password,
					'logged' => "false",
					'ip' => $this->input->ip_address(),
					'role' => $row->role,
					'email' => $row->email,
					'verified' => $row->verified,
					'code' => $row->code
				);
				
				$this->db->from('user');
				$this->db->where('username', $username);
				$this->db->update('user', $data);
			}
			
			session_destroy();
			redirect('main/');
		}
		
		function logged () {
			$this->db->where('logged', "true");
			$this->db->where('ip', $this->input->ip_address());
			$query = $this->db->get('user', '*');
			return $query;
		}
		
		function changePassword($data) {
			$this->db->where('username', $data['username']);
			$this->db->update('user', $data);
		}
		
		function findUser($data) {
			$this->db->where('username', $data);
			$query = $this->db->get('user', '*');
			return $query;
		}
		
		function deleteUser($data) {
			$this->db->where('username', $data);
			$query = $this->db->get('user');
			
			foreach ($query->result() as $row) {
				if ($row->role == 'administrator') {
					$this->db->where('logged', "true");
					$q = $this->db->get('user', '*');
					$_POST = $q;
					$this->load->view('delete_fail', $_POST);
				}
				else {					
					$this->db->where('username', $data);
					$this->db->delete('user');
					redirect('admin_controller/viewUsers');
				}
			}
		}
		
		function viewUserProfile($data) {
			$this->db->where('username', $data);
			$query = $this->db->get('user', '*');
			return $query;
		}
		
		function verifyUser($data) {
			$this->db->where('username', $data['username']);
			$this->db->update('user', $data);
		}
		
		function editUser($data) {
			$this->db->where('username', $data['username']);
			$this->db->update('user', $data);
		}
		
		// Add functions.
		function addData($data) {
			$this->db->insert('drivers', $data);
		}
		
		function registerUser($data) {
			$this->db->insert('user', $data);
		}
		
		function addViolation($data) {
			$this->db->insert('violations', $data);
		}
		
		function addID($data) {
			$this->db->insert('ids', $data);
		}
		
		// Delete functions.
		function deleteViolation($num, $idnum) {
			$this->db->where('idno', $idnum);
			$this->db->where('num', $num);
			$this->db->delete('violations');
		}
		
		// Filename of image.
		function ID($data) {
			$this->db->truncate('current_id');
			$this->db->insert('current_id', $data);
		}
		
		// Search functions.
		function searchByName($data) {
			$this->db->where('surname', $data);
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function searchByPlate($data) {
			$this->db->where('plate_number', $data);
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function searchById($data) {
			$this->db->where('idnum', $data);
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function searchByExpiration($data) {
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function searchByColor($data) {
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		// View functions.
		function viewAll(){
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function viewUsers(){
			$query = $this->db->get('user', '*');
			return $query;
		}
		
		function viewProfile($data) {
			$this->db->where('idnum', $data);
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		/*function viewViolations($data) {
			$this->db->where('idno', $data);
			$query = $this->db->get('violations', '*');
			return $query;
		}*/
		
		function viewLicense() {
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function viewColor($data) {
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		function viewFranchise() {
			$query = $this->db->get('drivers', '*');
			return $query;
		}
		
		// Edit function.
		function EditRecord($data){
			$var = $_POST;
			$this->db->where('idnum', $var);
			$this->db->update('drivers', $data);
		}
	}
?>