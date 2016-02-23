<?php // This controller is for view functionalities.

	class View_Controller extends Controller {

		function View_Controller() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
		}
		
		function index() {
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($checker++ == 0) $this->load->view('view_print', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function requestView()  { // Displays all the records in the database.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewAll();
						$_POST = $query;
						$this->load->view('view_print',$_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestProfile($data) { // Displays the profile of a driver.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewProfile($data);
						$_POST = $query;
						$this->load->view('view_prof', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function viewMenu() { // Displays the view menu.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('view_menu', $_POST);
					else redirect('main');
				}
			}
		}
		
		function requestViewExpFranchise() { // Displays all the drivers in the database with expired franchises.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewFranchise();
						$_POST = $query;
						$this->load->view('view_expfranchise',$_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestViewExpLicense() { // Displays all the drivers in the database with expired licenses.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewLicense();
						$_POST = $query;
						$this->load->view('view_explicense', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestViewBlue() { // Displays all the drivers in the database with blue IDs.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewColor('blue');
						$_POST = $query;
						$this->load->view('view_blue', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function requestViewYellow() { // Displays all the drivers in the database with yellow IDs.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$query = $this->Users->viewColor('yellow');
						$_POST = $query;
						$this->load->view('view_yellow', $_POST);
					}
					else redirect('main/');
				}
			}
		}
	}
?>