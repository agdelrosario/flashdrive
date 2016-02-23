<?php // This controller deals with functionalities related to users of the system.

	class Admin_Controller extends Controller {
		
		function Admin_Controller() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
			$this->load->library('email');
			$this->load->database();
			session_start(); 	
			date_default_timezone_set('Asia/Manila');
		}
		
		function index() { // Loads the log-in page if there is no logged user. If there is a logged user, loads the homepage.
			redirect('main/');
		}
		
		function addUser () { // Displays the add user form.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker == 0) $this->load->view('add_user', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function requestAddUser() { // Adds the user to the table drivers.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker == 0) {
						$data = array (
							'username' => $_POST['username'],
							'password' => $_POST['password'],
							'logged' => "false",
							'ip' => $this->input->ip_address(),
							'role' => $_POST['role'],
							'email' => $_POST['email'],
							'verified' => "false",
							'code' => $_POST['code']
						);
						
						$checker++;
						
						$status = $this->Users->registerUser($data);
						$this->load->view('home');
					}
					else redirect('main/');
				}
			}
		}
		
		function editUser ($data) { // Displays the edit user page.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) {
						$q = $this->Users->findUser($data);
						$_POST = $q;
						$this->load->view('edit_user', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestEditUser ($data) { // Edits the record in the user table.
			$query = $this->Users->logged();
			$checker = 0;
			$counter = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) {
						$q = $this->Users->findUser($data);
						
						foreach ($q->result() as $row2) {
							if ($counter++ == 0) {
								if ($row2->role == 'administrator') $role = $row2->role;
								else $role = $_POST['role'];
								
								$data = array (
									'username' => $_POST['username'],
									'password' => $_POST['password'],
									'logged' => $row2->logged,
									'ip' => $this->input->ip_address(),
									'role' => $role,
									'email' => $_POST['email'],
									'verified' => $row2->verified,
									'code' => $_POST['code']
								);
							}
						}
						
						$status = $this->Users->editUser($data);
						redirect('admin_controller/viewUsers');
					}
					else redirect('main/');
				}
			}
		}
		
		function doLogout() { // Log out.
			$query = $this->Users->logged();
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					$this->Users->logout($row->username, $row->password);
				}
			}
		}
	
		function home() { // Display homepage.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($checker++ == 0) $this->load->view('home');
					else redirect('main/');
				}
			}
		}
	
		function manual() { // Display manual.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($checker++ == 0) $this->load->view('manual', $_POST);
					else redirect('main/');
				}
			}
		}
	
		function developers() { // Display developer team information.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($checker++ == 0) $this->load->view('developers', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function forgotPassword() { // Display forgot password form.
			$query = $this->Users->logged();
			
			if ($query->num_rows > 0) redirect('admin_controller/home');
			else $this->load->view('forgot_password', array('query' => $query));
		}
		
		function sendPassword() { // Sends password to registered mail.
			$query = $this->Users->logged();
			
			if ($query->num_rows == 0) {
				$this->db->where ('username', $_POST['username']);
				$q = $this->db->get ('user', '*');
				
				if ($q->num_rows == 0) $this->load->view('forget_password_fail', array('query' => $query));
				else {
					foreach ($q->result() as $row) {
						$this->email->from('aletheia.delrosario@gmail.com', 'Aletheia Grace del Rosario');
						$this->email->to($row->email);

						$this->email->subject('Flash Drive (UPLB OVCCA Drivers Database) Account Password');
						$this->email->message('Greetings.

The password for your account ' . $row->username . ' is: ' . $row->password . '

Please remember your password to avoid this incident. Thank you.

Aletheia Grace del Rosario
Flash Drive Developer Team Leader');

						$this->email->send();

						echo $this->email->print_debugger();
						
						redirect('main/');
					}
				}
			}
			else redirect('admin_controller/home');
		}
		
		function verify() { // Display verify page.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) $this->load->view('verify', $_POST);
			else redirect('admin_controller/home');
		}
		
		function verifyAccount() { // Verifies an account.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) {
				$this->load->database();
				$this->db->where('username', $_POST['username']);
				$q = $this->db->get('user', '*');

				foreach ($q->result() as $row) {
					if ($row->code == $_POST['code']) {
						$data = array (
							'username' => $_POST['username'],
							'password' => $_POST['password'],
							'logged' => "false",
							'ip' => $this->input->ip_address(),
							'role' => $row->role,
							'email' => $row->email,
							'verified' => "true",
							'code' => $row->code
						);
						
						$status = $this->Users->verifyUser($data);
						$_POST = "success";
						$this->load->view('verify_result', $_POST);
					}	
					else {
						$_POST = "fail";
						$this->load->view('verify_result', $_POST);
					}
				}
			}
			else redirect('admin_controller/home');
		}
		
		function changePassword() { // Display change password form.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($checker++ == 0) $this->load->view('change_password', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function requestChangePassword() { // Changes password of the user.
			$query = $this->Users->logged();
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($checker++ == 0) {
						if ($row->password == $_POST['oldpassword']) {
							$data = array(
								'username' => $row->username,
								'password' => $_POST['newpassword'],
								'logged' => "true",
								'role' => $row->role,
								'ip' => $this->input->ip_address(),
								'email' => $row->email,
								'verified' => $row->verified,
								'code' => $row->code
							);
							
							$status = $this->Users->changePassword($data);
							redirect('admin_controller/home');
						}
						else {
							$_POST = $query;
							$this->load->view('change_password_fail', $_POST);
						}
					}
					else redirect('main/');
				}
			}
		}
		
		function viewUsers() { // Views all the users of the system.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) {
						$query = $this->Users->viewUsers();
						$_POST = $query;
						$this->load->view('view_users', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function deleteUser($data) { // Display confirmation upon request to delete a user from the system.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) {
						$query = $this->Users->findUser($data);
						$this->load->view('delete_user', array('query' => $query, 'loggedUser' => $_POST));
					}
					else redirect('main/');
				}
			}
		}
		
		function requestDelete($data) { // Deletes a user from the system.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) $query = $this->Users->deleteUser($data);
					else redirect('main/');
				}
			}
		}
		
		function viewUserProfile ($data) { // Views the profile of a user.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->role != 'upf' && $row->role != 'studentassistant' && $checker++ == 0) {
						$query = $this->Users->viewUserProfile($data);
						$_POST = $query;
						$this->load->view('view_user_prof', $_POST);
					}
					else redirect('main/');
				}
			}
		}
	}
?>