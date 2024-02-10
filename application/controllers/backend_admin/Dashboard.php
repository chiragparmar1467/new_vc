<?php


class Dashboard extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		// $this->data['page_title'] = 'Sliders';
		$this->load->model('Crud_model');
		$this->controllerPath = 'backend_admin/Dashboard/';
		$this->viewPath = 'admin/dashboard/';

		$this->data['company_data'] = $this->db->get('company')->row_array();
	}

	public function index()
	{

		if ($_SESSION['role_id'] == 1) {
			$this->data['page_title'] = 'Dashboard';

			$this->data['company_data'] = $this->db->get('company')->row_array();

			// for daily collection counting 
			$this->data['customer_data'] = $this->db->get_where('account_master', array('deleted' => '0','fk_financial_year_id' => $_SESSION['year']))->result_array();
			$group_id = 1;
			$is_admin = ($group_id == 1) ? true : false;
			$this->data['is_admin'] = $is_admin;
			$this->render_template('admin/dashboard/index', $this->data);
		}
	}


	public function template()
	{

		$filename = 'application/views/dashboard/' . $this->uri->segment(3) . '.php';
		if ($this->uri->segment(3) == 'rtl') {
			$this->load->view('dashboard/rtl', $this->data);
		} else {
			if (file_exists($filename)) {
				//echo "yes";
				$this->render_template('dashboard/' . $this->uri->segment(3), $this->data);
			} else {
				$this->my_404();
			}
		}
	}


	public function insert_data()
	{

		$data['member_name'] = $this->input->post('member_name');
		$data['address'] =	$this->input->POST('address');
		$data['mobile_number'] =	$this->input->POST('mobilenumber');


		$this->db->insert('member_master', $data);
		$this->data['company_data'] = $this->db->get('company')->row_array();

		$group_id = 1;
		$is_admin = ($group_id == 1) ? true : false;
		$this->data['is_admin'] = $is_admin;
		$this->render_template('admin/dashboard/index');
	}
}
