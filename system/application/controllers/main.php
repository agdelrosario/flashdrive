<?php // This controller deals with the log-in of a user.

	class Main extends Controller {

		function Main() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
			$this->load->database();
		}
		
		function index() { // Displays the login page.
			$query = $this->Users->logged();
			$_POST = $query;
			$this->load->view('login', $_POST);
		}
		
		function doLogin() {
			$username = $_POST['uname']; //$values[0];
			$password = $_POST['password']; //$values[1];
			
			if(isset($username) && isset($password)){
				$this->load->model('Users', '', TRUE);
				$this->Users->login($username,$password);
			}
			else $this->load->view('login');
		}
	}
?>