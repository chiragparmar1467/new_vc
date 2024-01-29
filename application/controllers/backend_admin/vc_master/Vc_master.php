<?php

class Vc_master extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'vc_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/vc_master/Vc_master/';
        $this->viewPath = 'admin/vc_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Loan Details';
        $this->tablename = 'vc_master';
    }

    public function index()
    {
       
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Vc';  

        $table_data = $this->db->query('SELECT vc.id,vc.name,vc.status,grp.id as group_id,
        grp.name as group_name,grp.short_name,vc.vc_opening_date,vc.vc_closing_date,month.month_name
        FROM vc_master as vc 
        INNER JOIN group_master as grp ON vc.group_id = grp.id 
        JOIN month_master AS month ON month.month_code = vc.fk_month_code
        where vc.deleted = 0 AND grp.deleted = 0 AND vc.status = 1 AND grp.status = 1
          AND vc.fk_financial_year_id = '.$_SESSION['year'].'
        order by vc.id DESC;')->result_array();
        // $table_data = $this->Crud_model->get($this->tablename,'',array('deleted' =>0));
     
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create()
    {
         
        $this->data['page_title'] = 'Add Vc details';

        $this->form_validation->set_rules('vc_name', 'Name', 'required');

        if ($this->form_validation->run() == TRUE) {
       
             
            $data = array(            
                'vc_opening_date' => $this->input->post('vc_opening_date'),
                'vc_closing_date' => $this->input->post('vc_closing_date'),
                'minimum_amount' => $this->input->post('minimum'),
                'fk_month_code' => $this->input->post('month'),
                'maximum_amount' => $this->input->post('maximum'),
                  'fk_financial_year_id' => $_SESSION['year'],
                'instalment' => $this->input->post('instalment'),
                'total_amount' => $this->input->post('total_amnt'),
                'vc_draw_date' => $this->input->post('vc_draw_date'),
                'name' => $this->input->post('vc_name'),
                'group_id' => $this->input->post('group'),
                'status' => $this->input->post('status'),
            );

            $opening_date = strtotime( $data['vc_opening_date'] ); 
            $data['vc_opening_date'] = date('Y-m-d',$opening_date);

            $closing_date = strtotime( $data['vc_closing_date'] ); 
            $data['vc_closing_date'] = date('Y-m-d',$closing_date);

            $draw_date = strtotime( $data['vc_draw_date'] ); 
            $data['vc_draw_date'] = date('Y-m-d',$draw_date);
        //  print_r('<pre>');   
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
            
            
            $this->form_validation->set_rules('vc_name', 'vc Name', 'required');

        if ($this->form_validation->run() == TRUE) {
           
         
             
            $data = array(            
                'vc_opening_date' => $this->input->post('vc_opening_date'),
                'vc_closing_date' => $this->input->post('vc_closing_date'),
                'minimum_amount' => $this->input->post('minimum'),
                'fk_month_code' => $this->input->post('month'),
                'maximum_amount' => $this->input->post('maximum'),
                  'fk_financial_year_id' => $_SESSION['year'],
                'total_amount' => $this->input->post('total_amnt'),
                'instalment' => $this->input->post('instalment'),
                'vc_draw_date' => $this->input->post('vc_draw_date'),
                'name' => $this->input->post('vc_name'),
                'group_id' => $this->input->post('group'),
                'status' => $this->input->post('status'),
            );

            $opening_date = strtotime( $data['vc_opening_date'] ); 
            $data['vc_opening_date'] = date('Y-m-d',$opening_date);

            $closing_date = strtotime( $data['vc_closing_date'] ); 
            $data['vc_closing_date'] = date('Y-m-d',$closing_date);
            if(!empty($data['vc_draw_date'])) {
            $draw_date = strtotime( $data['vc_draw_date'] ); 
            $data['vc_draw_date'] = date('Y-m-d',$draw_date);
            }
       
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
        exit();
        $this->data['page_title'] = 'View Vc Details';
        $this->data['view_data'] = $this->db->query('SELECT vc.id,vc.name,vc.vc_closing_date,vc.vc_opening_date,vc.status,grp.id as group_id,grp.name as group_name,grp.short_name,grp.start_date,grp.end_date FROM vc_master as vc INNER JOIN group_master as grp ON vc.group_id = grp.id where vc.deleted = 0 AND grp.deleted = 0 AND vc.id ="'.$id.'";')->row();
    
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