<?php

class Financial_year_master extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'financial_year_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/financial_year_master/Financial_year_master/';
        $this->viewPath = 'admin/financial_year_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Financial year';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Financial year ';
        
        
        
        $table_data = $this->db->query('SELECT  * FROM financial_year_master where deleted = 0')->result_array();
        // if($table_data[$party]){

        // }
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }
public function view_financial_year($id)
    {
        $this->data['page_title'] = 'Financial year';
        $table_data = $this->db->query('SELECT  * FROM financial_year_master where status = 1 AND deleted=0 AND id ='.$id)->result_array();
        $this->data['table_data'] = $table_data;
        $this->render_template($this->viewPath . 'year_index', $this->data);
    }
    public function create($account_number = null)
    { 
        $this->data['page_title'] = 'Add Financial Year';
        $this->form_validation->set_rules('party_name', 'Party Name', 'required');
        if(isset($_POST['submit'])){
            $data = array(
                'title' => $this->input->post('title'),
                'start_date' => $this->input->post('start_Date'),
                'end_date' => $this->input->post('end_Date'),
                'year' => $this->input->post('year'),
                'status' => $this->input->post('status'),
            );  
               
            $opening_date = strtotime( $data['start_date'] );
            
            $data['start_date'] = date('Y-m-d',$opening_date);
            $closing_date = strtotime( $data['end_date'] );
            
            $data['end_date'] = date('Y-m-d',$closing_date);
            
            $create = $this->Crud_model->save($this->tableName, $data);
	    	$query=$this->Crud_model->update($this->tableName, array('id !=' => $create), array('status' => 0));
            $logged_in_sess = array(
            
             'year' =>  $create,
             );
     
         $this->session->set_userdata($logged_in_sess);
            
         
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
            $this->db->order_by('id', "ASC");
           $table_data = $this->db->get('financial_year_master')->result_array()[0];
            $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($id = null)
    {
        $this->data['page_title'] = 'Edit Financial year';
        
        
        if ($id) {

            
            // $this->form_validation->set_rules('party_name', 'Select Party Name', 'required');
            
            if(isset($_POST['submit'])){
               
            $data = array(
                'title' => $this->input->post('title'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'year' => $this->input->post('year'),
                'status' => $this->input->post('status'),   
            );
                // print_r('<pre>');
                //     print_r($data);
                //     exit();

            
            $start_date = strtotime( $data['start_date'] );
            $data['start_date'] = date('Y-m-d',$start_date);
           
            $end_date = strtotime( $data['end_date'] );
            $data['end_date'] = date('Y-m-d',$end_date);
            $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $id), $data);
            
         

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'index/' . $id, 'refresh');
                }
            } else {
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' =>$id));
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
    public function account_no(){
        $id = $_POST['id'];
        $table_data = $this->Crud_model->get('loan_account_master', '', array('fk_party_id' => $id,'deleted'=>'0','status'=>'1'));
     
        echo "<option selected disabled hidden>Select Account No</option>";
     foreach ($table_data as $value) {
       
         echo "<option value='" . $value['account_no'] .  "'>" . $value['account_no'] . "</option>";
                                         }
     }
     public function form_view($id,$fk_party_id){
        $this->db->where('id', $id);
		$data['financial_year_master'] = $this->db->get('financial_year_master')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' =>$id));
        $this->data['edit_data'] = $slider_data;

        $this->render_template($this->viewPath . 'form_view',$data);
     }
    //  public function pdf(){
        
    //     $this->render_template($this->viewPath . 'pdf');
    //  }
     
     public function viewpdf($id)
	{
        //CERTIFICATE DATA
		$this->db->where('id', $id);
		$data['loan_master'] = $this->db->get('loan_master')->row_array();
		$data['loan_party_master'] = $this->db->get('loan_party_master')->row_array();
		$data['document'] = $this->db->get('document')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' =>$id));
        $this->data['edit_data'] = $slider_data;
		$mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 10,			
			'mode' => 'utf-8',
			'format' => 'A5',
		]);
        $mpdf->curlAllowUnsafeSslRequests = true;
		$pdf = $this->load->view($this->viewPath . 'pdf',$data,true);
		     
		$mpdf->WriteHTML($pdf);
		$mpdf->Output(); // opens in browser
    
		//$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
	}

    public function downloadpdf($id,$fk_party_id)
	{   
        //CERTIFICATE DATA
		$this->db->where('id', $id);
		$data['loan_master'] = $this->db->get('loan_master')->row_array();
		$this->db->where('id', $fk_party_id);
		$data['loan_party_master'] = $this->db->get('loan_party_master')->row_array();
        
		$data['document'] = $this->db->get('document')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' =>$id));
        $party_name = $data['loan_party_master']['account_name'];
    
        $this->data['edit_data'] = $slider_data;
		$mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 10,			
			'mode' => 'utf-8',
			'format' => 'A5',
		]);
        $mpdf->curlAllowUnsafeSslRequests = true;
		$download = $this->load->view($this->viewPath . 'pdf',$data,true);
		$mpdf->WriteHTML($download);
		$mpdf->Output($party_name.'.pdf','D');
	}
    
}