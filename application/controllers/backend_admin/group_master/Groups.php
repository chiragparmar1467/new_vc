<?php

class Groups extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'group_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/group_master/Groups/';
        $this->viewPath = 'admin/groups/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Groups';
        $this->tablename = 'group_master';
    }

    public function index()
    {
       
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Groups';  

        // $table_data = $this->db->query('select distinct name,short_name,start_date,end_date,status from group_master where deleted = 0')->result_array();
       $table_data = $this->Crud_model->get($this->tablename,'',array('deleted'=>0,'status'=>1,'fk_financial_year_id' => $_SESSION['year']));
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create()
    {

         
         
        $this->data['page_title'] = 'Add Groups';

        $this->form_validation->set_rules('group_name', 'Group Name', 'required');

        if ($this->form_validation->run() == TRUE) {
            
            $data = array(
                
                'start_date' => $this->input->post('acc_opening_date'),
                'end_date' => $this->input->post('acc_closing_date'),
                'name' => $this->input->post('group_name'),
                'short_name' => $this->input->post('group_short_name'),
              'fk_financial_year_id' => $_SESSION['year'],
                'status' => $this->input->post('status'),
                'total_month' => $this->input->post('months'),

            );
            
            $opening_date = strtotime( $data['start_date'] ); 
            $data['start_date'] = date('Y-m-d',$opening_date);

            $closing_date = strtotime( $data['end_date'] ); 
            $data['end_date'] = date('Y-m-d',$closing_date);
        
            $create = $this->Crud_model->save($this->tableName, $data);
             
            
            $m_name = $this->input->post('members_name');
            
            foreach($m_name as $acc_id) { 
                $member = $this->db->get_where('account_master',array('account_no'=>$acc_id))->row();
                  
                $data = array(
                        'fk_group_id' => $create,
                        'fk_account_id' => $acc_id,
                        'fk_member_id' => $member->fk_member_id,
                );
 
                $save_member = $this->Crud_model->save('group_member_mapping_master', $data);
            }
            
           
            if ($create == true) {
                $this->session->set_flashdata('success', 'Group successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
          
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($g_id = null)
    {
      
 
        $this->data['page_title'] = 'Edit Group Details';

        if ($g_id) {
            
            
            $this->form_validation->set_rules('group_name', 'Group Name', 'required');

        if ($this->form_validation->run() == TRUE) {
           
         
             
            $data = array(
                
                'start_date' => $this->input->post('acc_opening_date'),
                'end_date' => $this->input->post('acc_closing_date'),
                'name' => $this->input->post('group_name'),
                'short_name' => $this->input->post('group_short_name'),
                'fk_financial_year_id' => $_SESSION['year'],
                'status' => $this->input->post('status'),
                'total_month' => $this->input->post('months'),

            );
            $opening_date = strtotime( $data['start_date'] ); 
            $data['start_date'] = date('Y-m-d',$opening_date);
            
            $closing_date = strtotime( $data['end_date'] ); 
            $data['end_date'] = date('Y-m-d',$closing_date);
            
            $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $g_id), $data);
            
            
            
            $m_name = $this->input->post('members_name');             
            // print_r('<pre>');   
            // print_r($acc_id); 
            // exit(); 
            $this->db->where('fk_group_id',$g_id);
            $delete_mapped_member = $this->db->delete('group_member_mapping_master');
             foreach($m_name as $acc_id) { 
              
                $member = $this->db->get_where('account_master',array('account_no'=>$acc_id))->row();
                   
                $data = array(
                        'fk_group_id' => $g_id,
                        'fk_account_id' => $acc_id,
                        'fk_member_id' => $member->fk_member_id,
                );

               $save_member = $this->Crud_model->save('group_member_mapping_master', $data);
             }
   
                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'index' . $id, 'refresh');
                }
            } else {
             
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $g_id));
                
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