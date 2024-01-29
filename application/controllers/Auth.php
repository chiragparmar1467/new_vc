<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_auth');
		$this->load->model('model_company');
		$this->load->model('Crud_model');
		// $this->data['company_data'] = $this->model_company->getCompanyData(1);
		$this->data['page_title'] = "Login";
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
	
        
		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
			
            // true case
           	$email_exists = $this->Model_auth->check_email($this->input->post('email'));
               


           	if($email_exists == TRUE) {
           		$login = $this->Model_auth->login($this->input->post('email'), $this->input->post('password'));
                 
                  
           	   $financial_year = $this->db->query('SELECT  * FROM financial_year_master where status = 1 AND deleted=0 ')->row();
                  
           		if($login) {
           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
						'store_id' =>  $login['store_id'],
						'role_id' =>  $login['role_id'],
				        'logged_in' => TRUE,
						'year' =>  $financial_year->id,
					);
					$this->session->set_userdata($logged_in_sess);
					   
				if($_SESSION['role_id'] == 1){ 
					redirect(base_url('backend_admin/Dashboard'), 'refresh');
				}
			
           		}
           		else {
				
           			$this->data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect username/password </div>';
           			
					$this->load->view('admin/login', $this->data);
					
           		}
                    
           	}
           	else {
           		$this->data['errors'] = '<div class="alert alert-danger" role="alert">Email does not exists</div>';
				
           		$this->load->view('admin/login', $this->data);
			
           	}	
        }
        else {
            // false case
           
            $this->load->view('admin/login');
        }	
	}

public function change_financial_year($financial_year_id = null)
    {
        $set_data = $this->session->set_userdata('year',$financial_year_id);
		// print_r($_SESSION["year"]);
		if(!isset($set_data)){
		    $this->db->query("UPDATE financial_year_master SET status = 0");
		    $this->db->query("UPDATE financial_year_master SET status = 1 WHERE id = $financial_year_id");
               	// print_r('<pre>');
				// 	   print_r($_SESSION);
				// 	   exit();
			redirect('backend_admin/Dashboard');
		}

    }
	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

}
