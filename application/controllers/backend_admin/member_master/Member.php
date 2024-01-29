<?php

class Member extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'member_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/member_master/Member/';
        $this->viewPath = 'admin/members/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Member';
        $this->tablename = 'member_master';
    }

    public function index()
    {
       
    
        $this->data['page_title'] = 'Member';
  
        $table_data = $this->Crud_model->get($this->tablename,'',array('deleted'=>0));
     
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create()
    {

        
        $this->data['page_title'] = 'Add Member';

        $this->form_validation->set_rules('member_name', 'Member Name', 'required');

        if ($this->form_validation->run() == TRUE) {
            
            $data = array(
                
                  'member_name' => $this->input->post('member_name'),
                  'address' => $this->input->post('address'),
                'mobile_number' => $this->input->post('mobile_no'),
                'email' => $this->input->post('email'),
                 'fk_financial_year_id' => $_SESSION['year'],
                'status' => $this->input->post('status'),

            );
          
            $create = $this->Crud_model->save($this->tableName, $data);

            if ($create == true) {
                $this->session->set_flashdata('success', 'Member successfully added');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
         
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($m_id = null)
    {
      
 
        $this->data['page_title'] = 'Edit Member Details';

        if ($m_id) {
            
            
            $this->form_validation->set_rules('member_name', 'Member Name', 'required');

        if ($this->form_validation->run() == TRUE) {
           
            $data = array(
                'member_name' => $this->input->post('member_name'),
                  'address' => $this->input->post('address'),
                'mobile_number' => $this->input->post('mobile_no'),
                'email' => $this->input->post('email'),
                 'fk_financial_year_id' => $_SESSION['year'],
                'status' => $this->input->post('status'),
            );
            
         
         
                $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $m_id), $data);

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'index' . $id, 'refresh');
                }
            } else {
             
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $m_id));

                $this->data['edit_data'] = $slider_data;
                $this->render_template($this->viewPath . 'edit', $this->data);
            }
        }
     
    }

    function updateStatus($id=NULL, $status=NULL)
	{
    
		$query=$this->Crud_model->update($this->tableName, array('id' => $id), array('status' => $status));
		
		redirect($this->controllerPath);
	}

    public function delete($id)
    {
 
        if ($id) {
            $delete = $this->Crud_model->delete_by_id($this->tableName, $id);
            if ($delete == true) {
                
                $this->session->set_flashdata('success', 'Successfully removed');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect($this->controllerPath . 'delete/' . $id, 'refresh');
            }
        }
    }
}