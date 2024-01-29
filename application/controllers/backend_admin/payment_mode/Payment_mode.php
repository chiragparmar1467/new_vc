<?php

class Payment_mode extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'payment_mode';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/payment_mode/Payment_mode/';
        $this->viewPath = 'admin/payment_mode/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Payment Mode';
        $this->tablename = 'payment_mode';
    }

    public function index()
    {
       
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Payment Mode';  

        // $table_data = $this->db->query('SELECT vc.id,vc.name,vc.status,grp.id as group_id,grp.name as group_name,grp.short_name,grp.start_date,grp.end_date FROM vc_master as vc INNER JOIN group_master as grp ON vc.group_id = grp.id where vc.deleted = 0 AND grp.deleted = 0;')->result_array();
        $table_data = $this->Crud_model->get($this->tablename,'',array('deleted' =>0 , 'status' =>1));
     
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create()
    {

        $this->data['page_title'] = 'Add Payment Mode';

        $this->form_validation->set_rules('payment_mode', 'required');
    // print_r('<pre>');
    //     print_r('sdf');
    //     exit();
        if(isset($_POST['submit'])){

            $data = array(            
                'payment_mode' => $this->input->post('payment_mode'),
                'status' => $this->input->post('status'),
            );
                // print_r('<pre>');
                //     print_r($data);
                //     exit();
        
             $create = $this->Crud_model->save($this->tableName, $data);
             
            if ($create == true) {
                $this->session->set_flashdata('success', 'successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
          
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($vc_id = null)
    {
      
 
        $this->data['page_title'] = 'Edit Vc Details';

        if ($vc_id) {
            
            
            $this->form_validation->set_rules( 'required');

        if (isset($_POST['submit'])) {
           
         
             
            $data = array(            
                'payment_mode' => $this->input->post('payment_mode'),
                'status' => $this->input->post('status'),
            );

             $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $vc_id), $data);     

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'index' . $id, 'refresh');
                }
            } else {
             
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $vc_id));
          
                $this->data['edit_data'] = $slider_data;
                $this->render_template($this->viewPath . 'edit', $this->data);
            }
        }
     
    }

    public function view($id = null){
        $this->data['page_title'] = 'View Vc Details';
        $this->data['view_data'] = $this->db->query('SELECT vc.id,vc.name,vc.status,grp.id as group_id,grp.name as group_name,grp.short_name,grp.start_date,grp.end_date FROM vc_master as vc INNER JOIN group_master as grp ON vc.group_id = grp.id where vc.deleted = 0 AND grp.deleted = 0 AND vc.id ="'.$id.'";')->row();
    
        $this->render_template($this->viewPath . 'view', $this->data);
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