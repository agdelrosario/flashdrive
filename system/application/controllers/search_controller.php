<?php // This controller is for search functionalities.

	class Search_Controller extends Controller {

		function Search_Controller() {
			parent::Controller();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('Users', '', TRUE);
		}
		
		function index() { // Displays the search menu.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('search', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchName() { // Displays the search by name form.
			$query = $this->Users->logged();
			$_POST = $query;
			$checker = 0;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('search_name', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchBySurname() { // Searches by name and displays the results in the search_print page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$data = $this->input->post('sname');
						$data = $_POST['sname'];
						$query = $this->Users->searchByName($data);
						$_POST = $query;
						$this->load->view('search_print', $query);
					}
					else redirect('main/');
				}
			}
		}
		
		function searchPlate() { // Displays the search by plate form.
			$query = $this->Users->logged();
			$checker = 0;
			$_POST = $query;
			
			if ($query->num_rows == 0) redirect('main/');
			else {
				foreach ($query->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('search_plate', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchByPlateNumber() { // Searches by plate and displays the result in the search_print page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$data = $this->input->post('platenumber');
						$query = $this->Users->searchByPlate($data);
						$_POST = $query;
						$this->load->view('search_print', $query);
					}
					else redirect('main/');
				}
			}
		}
		
		function searchID() { // Displays the search by ID form.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('search_id', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchByIDNumber() { // Searches by ID and displays the result in the search_print_id page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$data = $this->input->post('id');
						$data = $_POST['id'];
						$_POST = $data;
						$this->load->view('search_print_id', $_POST);
					}
					else redirect('main/');
				}
			}
		}
		
		function searchLicense() { // Displays the search by expiration of license form.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) $this->load->view('search_license', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchByDocumentExpiration() { // Searches by expiration of license and displays the results in the search_print_license page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$data = array(
							'month' => $_POST['month'],
							'year' => $_POST['year']
						);
						
						$query = $this->Users->searchByExpiration($data);
						$_POST = $query;
						$this->load->view('search_print_license', array('query' => $query, 'data' => $data));
					}
					else redirect('main/');
				}
			}
		}
		
		function searchFranchise() { // Displays the search by expiration of franchise form.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($checker++ == 0) $this->load->view('search_franchise', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function requestSearchFranchise() { // Searches by expiration of franchise and displays the results in the search_print_franchise page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($checker++ == 0) {
						$data = array(
							'month' => $_POST['month'],
							'year' => $_POST['year']
						);
						
						$query = $this->Users->searchByExpiration($data);
						$_POST = $query;
						$this->load->view('search_print_franchise',array('query' => $query, 'data' => $data));
					}
					else redirect('main/');
				}
			}
		}
		
		function searchColor() { // Displays the search by color form.
			$q = $this->Users->logged();
			$_POST = $q;
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($checker++ == 0) $this->load->view('search_color', $_POST);
					else redirect('main/');
				}
			}
		}
		
		function searchByIDColor() { // Searches by color and displays the results in the search_color_print page.
			$q = $this->Users->logged();
			$checker = 0;
			
			if ($q->num_rows == 0) redirect('main/');
			else {
				foreach ($q->result() as $row) {
					if ($row->logged == 'true' && $checker++ == 0) {
						$data = array (
							'color' => $_POST['color'] ,
							'surname' => $_POST['surname']
						);
				
						$query = $this->Users->searchByColor($data);
						$this->load->view('search_color_print', array('query' => $query, 'data' => $data));
					}
					else redirect('main/');
				}
			}
		}	
	}
?>