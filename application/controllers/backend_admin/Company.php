<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Company extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Company';

		$this->load->model('model_company');
	}

	/* 
    * It redirects to the company page and displays all the company information
    * It also updates the company information into the database if the 
    * validation for each input field is successfully valid
    */
	public function index()
	{
		if (!in_array('updateCompany', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'Vat Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');



		if ($this->form_validation->run() == TRUE) {
			// true case

			$files = $_FILES;



			//PHOTO
			if (!empty($files['company_logo']['name'])) {
				$config['upload_path']   = './assets/uploads/logo/';
				$new_name = time() . rand(9999, 999999);
				$config['file_name'] = $new_name;

				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('company_logo')) {
					$error = array('error' => $this->upload->display_errors());
					print_r('<pre>');
					print_r($error);
					exit();
					$this->session->set_flashdata('msg_error', 'Registered Failed');
					// redirect(base_url('mainsite/register?advtid=' . $redirect_advtid));
				} else {
				
					$ImageUploaddata = array('upload_data' => $this->upload->data());
				}

				$logo =  $ImageUploaddata['upload_data']['file_name'];
			} else {
				$logo =  $this->input->post('company_logo1');
			}

			

		


			$data = array(
				'company_name' => $this->input->post('company_name'),
				// 'service_charge_value' => $this->input->post('service_charge_value'),
				'vat_charge_value' => $this->input->post('vat_charge_value'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				// 'country' => $this->input->post('country'),
				'facebook_link' => $this->input->post('facebook_link'),
				'instagram_link' => $this->input->post('instagram_link'),
				'youtube_link' => $this->input->post('youtube_link'),
				'twitter_link' => $this->input->post('twitter_link'),
				'working_hours' => $this->input->post('working_hours'),
				'message' => $this->input->post('message'),
				// 'currency' => $this->input->post('currency'),
				'logo' => $logo,
			);

			

			$update = $this->model_company->update($data, 1);

			
			if ($update == true) {
				$this->session->set_flashdata('success', 'Successfully Updated');
				redirect('backend_admin/company/', 'refresh');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('backend_admin/company/index', 'refresh');
			}
		} else {

			// false case

			$this->data['company_data'] = $this->model_company->getCompanyData(1);
			$this->render_template('admin/company/index', $this->data);
		}
	}
}