<?php
require_once 'vendor/autoload.php';
class Carry_forward extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'carry_forward';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/carry_forward/Carry_forward/';
        $this->viewPath = 'admin/carry_forward/account/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Carry forward';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Carry forward';
        
        // $table_data = $this->db->query('SELECT  * FROM loan_party_master where fk_financial_year_id = '.$_SESSION['year'].' AND  status =1 AND deleted=0;')->result_array();
        // $table_data = $this->db->query('SELECT  * FROM financial_year_master where deleted=0;')->result_array();
        $table_data = $this->db->query('SELECT DISTINCT carry.fk_financial_year_id, carry.old_fk_financial_year_id , f_year1.title as new_fin_year, f_year2.title as old_fin_year FROM carry_forward AS carry 
                                        LEFT JOIN financial_year_master as f_year1 ON carry.fk_financial_year_id = f_year1.id 
                                        LEFT JOIN financial_year_master as f_year2 ON carry.old_fk_financial_year_id = f_year2.id 
                                        where carry.deleted=0')->result_array();
            // print_r('<pre>');
            //     print_r($table_data);
            //     exit();
        if('collected' == 0){
            
        }
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function view_loan($id)
    {

        $this->data['page_title'] = 'Loan Master';
        // $table_data = $this->db->query('SELECT * FROM vc_master where status = 1 AND deleted=0 AND is_carry_forward =1 AND fk_financial_year_id ='.$id)->result_array();
        // $table_data = $this->db->query('SELECT  * FROM loan_master where status = 1 AND deleted=0 AND fk_financial_year_id = '.$_SESSION['year'].' AND fk_party_id ='.$id)->result_array();
       
        // $table_data = $this->db->query('SELECT carry.fk_loan_id, carry.fk_financial_year_id, loan.account_no, loan.month,loan.loan_amount,loan.interest_amount,loan.fk_party_id ,loan.fk_loan_category_id,loan.acc_opening_date,loan.acc_closing_date,loan.per_month_interest,loan.total_interest_amount,loan.final_amount,carry.total_collection,loan.bank_name,loan.cheque_no FROM loan_master as loan inner join carry_forward as carry on loan.id = carry.fk_loan_id where loan.status = 1 AND loan.deleted=0 AND carry.fk_financial_year_id ='.$_SESSION['year'].' ')->result_array();

        // print_r('<pre>');
            //     print_r($table_data);
            //     print_r($this->db->last_query());
            //     exit();
        $this->data['table_data'] = $table_data;
        $this->render_template($this->viewPath . 'loan_index', $this->data);
    }

    public function create($account_number = null)
    { 
            
        $this->data['page_title'] = 'Add Account';
        // $this->form_validation->set_rules('party_name', 'Party Name', 'required');
        $this->load->library('upload');
        if(isset($_POST['submit'])){
                //  print_r('<pre>');
                //      print_r('sdf'); 
                //      exit();
            $closing_year =  $this->input->post('closing_year');
            $carry_forward = $this->input->post('cary_forward');
            // print_r('<pre>');
            // print_r($closing_year);
            // exit();
            // $fk_loan_id = $this->input->post('fk_loan_id');

            // $get_data = $this->db->query('SELECT * FROM vc_master WHERE status = 1 AND fk_financial_year_id = '.$closing_year.'')->result_array();
            //     print_r('<pre>');
            // print_r($get_data);
            // print_r($this->db->last_query());
            // exit();
                    foreach($get_data as $get){
            $total_collection = $this->db->get_where('collection_master',array('status' => 1,'fk_vc_id' => $get['id']))->result_array();
                // print_r('<pre>');
                //     print_r($total_collection);
                //     print_r($this->db->last_query());
                //     exit();
            // $closing_year_data = $this->db->get_where('loan_master',array('collected'=> 0 ,'fk_financial_year_id'=>$closing_year))->result_array();
                // print_r('<pre>');
                //     print_r($closing_year_data);
                //     print_r($this->db->last_query());
                //     exit();
                $bal = 0;
                foreach($total_collection as $balance){
                    $bal = $balance['amount'] + $bal;
                }
                    // print_r('<pre>');
                    //     print_r('sdf');
                    //     exit(); 
                    // foreach($closing_year_data as $closing ){

                        $data = array(
                            'status' => $get['status'],
                            'old_fk_financial_year_id' => $closing_year,
                            'fk_financial_year_id' => $carry_forward,
                            'fk_vc_id' => $get['id'],
                            'total_collection' => $bal,
                            'is_carry_forward' => 1,
                            'deleted' => 0
                            // 'fk_loan_category_id' => $get['fk_loan_category_id'],
                            // 'fk_party_id' => $get['fk_party_id'],
                // 'account_no' => $get['account_no'],
                // 'acc_opening_date' => $get['acc_opening_date'],
                // 'acc_closing_date' => $get['acc_closing_date'],
                // 'loan_amount' => $get['loan_amount'],
                // 'bank_name' => $get['bank_name'],
                // 'cheque_no' => $get['cheque_no'],
                // 'cheque_image' =>$get['cheque_image'],
                // 'month' => $get['month'],
                // 'interest_amount' => $get['interest_amount/'],
                // 'per_month_interest' => $get['per_month_interest'],
                // 'total_interest_amount' => $get['total_interest_amount'],
                // 'final_amount' => $get['final_amount'],
                // 'fk_loan_id' => $closing['fk_loan_id'],
            );
            
            // print_r('<pre>');
            //     print_r($data);
            //     exit();
            $create = $this->Crud_model->save($this->tableName, $data);
            // $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $get['id']), array('deleted' => 1));
            // $carry_forward = $this->Crud_model->update('vc_master',array('status' => 1 , 'id' => $get['id']), array('is_carry_forward' => 1));
            // print_r('<pre>');
            //     print_r($data);
            //     print_r($this->db->last_query());
            //     exit();
        }
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }

        } else {
            $this->db->order_by('id', "DESC");
           $table_data = $this->db->get('vc_master')->result_array()[0];
            $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($id = null)
    {
        $this->data['page_title'] = 'Edit Account Details';
        
        
        if ($id) {

            
            // $this->form_validation->set_rules('party_name', 'Select Party Name', 'required');
            $this->load->library('upload');
            
            if(isset($_POST['submit'])){
                
               
            $data = array(
                'fk_party_id' => $this->input->post('party_name'),
                'fk_loan_category_id' => $this->input->post('category_name'),
                'status' => $this->input->post('status'),
                'acc_opening_date' => $this->input->post('acc_opening_date'),
                'acc_closing_date' => $this->input->post('acc_closing_date'),
                'loan_amount' => $this->input->post('enter_loan_amount'),
                'bank_name' => $this->input->post('bank_name'),
                'cheque_no' => $this->input->post('cheque_no'),
                'month' => $this->input->post('month'),
                'fk_financial_year_id' => $_SESSION['year'],
                'interest_amount' => $this->input->post('interest_amount'),
             
                
            );
               
            if(!empty($this->input->post('cheque_image'))){
                $config['upload_path']   = 'assets/uploads/document/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                $this->upload->initialize($config);
                if ($this->upload->do_upload('cheque_image')) {
                                                    // print_r('<pre>');
                                                    //     print_r('upload');
                                                    //     exit();
                                                    $front = array('upload_data' => $this->upload->data());
                                                    // echo "<script>alert('File uploaded Successfully!');</script>";
                                                    $data = array('cheque_image' =>$front['upload_data']['file_name']);
                                                   
                                                    $this->Crud_model->update('loan_master',array('id' => $id),$data);
                                                    $table_data = $this->Crud_model->get($this->tableName, 'id', array('deleted' => 0));
        
                                                    $this->data['table_data'] = $table_data;
                                                   $this->render_template($this->viewPath . 'index', $this->data);
                                                  } else {
                                                    $error = array('error' => $this->upload->display_errors());                                              
                                                    print_r('<pre>');
                                                    print_r($error);
                                                    exit();
                                                           
                                                         }
                                        }
                                        else{

                                                            $data['cheque_image'] = $this->input->post('cheque_image');
                                                            
                                                 $affectedRows = $this->Crud_model->update('loan_master',array('id' => $id),$data);
                                                 $table_data = $this->Crud_model->get($this->tableName, 'id', array('deleted' => 0));
                                                  
                                                 $this->data['table_data'] = $table_data;
                                                   $this->render_template($this->viewPath . 'index', $this->data);

                                        }

            if(!empty($this->input->post('total_amount'))){
              
                $data['per_month_interest']=$this->input->post('total_amount');
            }
            if(!empty($this->input->post('monthly_amount'))){

                $data['total_interest_amount']=$this->input->post('monthly_amount');
            }
            if(!empty($this->input->post('final_amount'))){

                $data['final_amount']=$this->input->post('final_amount');
            }
            
            $opening_date = strtotime( $data['acc_opening_date'] );
            $closing_date = strtotime( $data['acc_closing_date'] );
            
            $data['acc_opening_date'] = date('Y-m-d',$opening_date);
            $closing_date = strtotime( $data['acc_closing_date'] );
            
            $data['acc_closing_date'] = date('Y-m-d',$closing_date);
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
        public function form_view($id){
        $this->db->where('id', $id);
		// $data['vc_master'] = $this->db->get('vc_master')->row_array();

        $this->render_template($this->viewPath . 'form_view',$data);
     }

     
     public function viewpdf($id)
	{
        //CERTIFICATE DATA
		$this->db->where('id', $id);
		// $data['vc_master'] = $this->db->get('vc_master')->row_array();
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

    public function downloadpdf($id)
	{   
        //CERTIFICATE DATA
		$this->db->where('id', $id);
		$data['loan_master'] = $this->db->get('loan_master')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' =>$id));
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