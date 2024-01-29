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
		
		if($_SESSION['role_id'] == 1){
        $this->data['page_title'] = 'Dashboard';
		
		$this->data['company_data'] = $this->db->get('company')->row_array();
	
    
				// for daily collection counting 
		$this->data['customer_data'] = $this->db->get_where('member_master',array('deleted' => '0'))->result_array();
		$this->data['account_data'] = $this->db->query('SELECT party.member_name,party.address,party.status as party_status,acc.status as acc_status,acc.account_no FROM member_master AS party INNER JOIN account_master AS acc ON party.id = acc.fk_member_id where acc.deleted = 0 AND party.deleted = 0;')->result_array(); 
		$this->data['collection_data'] = $this->db->query('SELECT party.member_name,col.fk_group_id,party.address,party.status as party_status,acc.status as acc_status,col.id, DATE_FORMAT(col.collection_date, "%d-%m-%Y") as collection_date,col.amount,acc.account_no FROM member_master AS party INNER JOIN collection_master AS col ON party.id = col.fk_member_id INNER JOIN 
        account_master AS acc ON col.fk_group_id = acc.account_no where acc.deleted = 0 AND col.deleted = 0 AND party.deleted = 0 AND col.fk_financial_year_id = '.$_SESSION['year'])->result_array();
				// counting daily collection  close 

		$date = date('Y-m-d');


			$this->data['groups'] = $this->db->get_where("group_master",array('status' =>1,'deleted' =>0,'fk_financial_year_id'=>$_SESSION['year']))->result_array(); 
			$this->data['groups_coll'] = $this->db->query("
			SELECT coll.amount,coll.fk_group_id,coll.fk_vc_id,grp.name
FROM collection_master AS coll 
JOIN group_master as grp ON grp.id = coll.fk_group_id
WHERE grp.status = 1 AND grp.deleted = 0 
AND coll.status = 1 AND coll.deleted = 0 AND coll.fk_financial_year_id =".$_SESSION['year'])->result_array(); 
		
// Today's Collection Data close


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


	public function insert_data(){
		 
	$data['member_name'] = $this->input->post('member_name');
	$data['address'] =	$this->input->POST('address');
	$data['mobile_number'] =	$this->input->POST('mobilenumber');

 
		$this->db->insert('member_master',$data);
		$this->data['company_data'] = $this->db->get('company')->row_array();
		
		$group_id = 1;
		$is_admin = ($group_id == 1) ? true : false;
		$this->data['is_admin'] = $is_admin;
		$this->render_template('admin/dashboard/index');

	}

}