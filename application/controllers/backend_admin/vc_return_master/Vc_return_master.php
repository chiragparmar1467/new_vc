<?php
require_once 'vendor/autoload.php';
class Vc_return_master extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'vc_return_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/vc_return_master/Vc_return_master/';
        $this->viewPath = 'admin/vc_return_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Loan Return';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Loan Master'; 
        
        $table_data = $this->db->query('
        SELECT vc_return.id,vc_return.status as return_status,vc_return.deleted as return_deleted, 
        member.member_name as member_name, grp.name as group_name,vc.name as vc_name,
        month.month_name FROM vc_return_master as vc_return 
        JOIN member_master as member ON vc_return.fk_member_id = member.id
        JOIN group_master as grp ON vc_return.fk_group_id = grp.id
        JOIN vc_master as vc ON vc_return.fk_vc_id = vc.id
        JOIN month_master as month ON vc_return.fk_month_code = month.month_code
        WHERE vc_return.status = 1 AND vc_return.deleted = 0 AND 
        vc.status = 1 AND vc.deleted = 0 AND vc.fk_financial_year_id = '.$_SESSION['year'].' AND
        grp.status = 1 AND grp.deleted = 0
        order by vc_return.id DESC')->result_array();
      
     
        $this->data['table_data'] = $table_data;
      
        $this->render_template($this->viewPath . 'index', $this->data);
    }
    public function view_loan($id)
    {     
        $this->data['page_title'] = 'Loan Return Master';
        $table_data = $this->db->query('SELECT  * FROM vc_return_master where status = 1 AND deleted=0 AND id ='.$id)->result_array();
        $this->data['table_data'] = $table_data;
        $this->render_template($this->viewPath . 'return_index', $this->data);
    }

    public function create($account_number = null)
    { 
        $this->data['page_title'] = 'Add Return';
        $this->form_validation->set_rules('party_name', 'Party Name', 'required');
        if(isset($_POST['submit'])){
            if (!empty($_FILES['attachment']['name'])) {
                $config['upload_path']   = 'assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
               
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('attachment')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit();
                    // $this->load->view($this->viewPath . 'add', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    // echo "<script>alert('File uploaded Successfully!');</script>";
                }}
                $acc_id = $this->input->post('member_name');
                $member = $this->db->get_where('account_master',array('account_no'=>$acc_id))->row();
     
            $data = array(
                'collection_date' => $this->input->post('collection_date'),
                'fk_group_id' => $this->input->post('group_name'),
                'fk_month_code' => $this->input->post('month'),
                'fk_vc_id' => $this->input->post('vc_name'),
                'fk_acc_id' => $this->input->post('member_name'),
                'fk_member_id' => $member->fk_member_id,
                'bank_name' => $this->input->post('bank_name'),
                'cheque_no' => $this->input->post('cheque_no'),
                'fk_financial_year_id' => $_SESSION['year'],
                'amount' => $this->input->post('amount'),
                'fk_payment_id' => $this->input->post('payment_mode'),
                'attachment' => $data['upload_data']['file_name'], 
            );
   
            $collection_date = strtotime( $data['collection_date'] );
         
            $data['collection_date'] = date('Y-m-d',$collection_date);
            
            $create = $this->Crud_model->save($this->tableName, $data);
          
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
        //     $this->db->order_by('account_no', "DESC");
        //    $table_data = $this->db->get('vc_return_master')->result_array()[0];
        //     $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath . 'create', $this->data);
        }
    }

    public function edit($id = null)
    {
        $this->data['page_title'] = 'Edit Loan Returned Details';

        if ($id) {
            
            if(isset($_POST['submit'])){
                $this->form_validation->set_rules('amount', 'Amount', 'required');
                  
                if (!empty($_FILES['attachment']['name'])) {
                    $config['upload_path']   = 'assets/uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|pdf';
                   
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('attachment')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        exit();
                        // $this->load->view($this->viewPath . 'add', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        // echo "<script>alert('File uploaded Successfully!');</script>";
                    }}
                    else{
                        $data['upload_data'] = array('file_name' => $this->input->post('prev_attachment'));
                    }
                    
                      $acc_id = $this->input->post('member_name');
                    $member = $this->db->get_where('account_master',array('account_no'=>$acc_id))->row();
                 
        if ($this->form_validation->run() == TRUE) {
            
            $data = array(
                'collection_date' => $this->input->post('collection_date'),
                'fk_group_id' => $this->input->post('group_name'),
                'fk_month_code' => $this->input->post('month'),
                'fk_vc_id' => $this->input->post('vc_name'),
               'fk_acc_id' => $this->input->post('member_name'),
                'fk_member_id' => $member->fk_member_id,
                'bank_name' => $this->input->post('bank_name'),
                'fk_financial_year_id' => $_SESSION['year'],
                'cheque_no' => $this->input->post('cheque_no'),
                'amount' => $this->input->post('amount'),
                'fk_payment_id' => $this->input->post('payment_mode'),
                'attachment' => $data['upload_data']['file_name'], 
             
            );
            
            $collection_date = strtotime( $data['collection_date'] );
            $data['collection_date'] = date('Y-m-d',$collection_date);
                // $update = $this->model_groups->edit($data, $id);
                $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $id), $data);

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    // redirect($this->controllerPath, 'refresh');
                    redirect($this->controllerPath, 'refresh');

                } else {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                }
            }
             else{
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $id));
                $this->data['edit_data'] = $slider_data;
            $this->session->set_flashdata('errors', 'Account Name Should Be Characters Only');
            $this->render_template($this->viewPath . 'edit', $this->data);
        }
    }
            else {
              
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $id));
         
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
   
     public function form_view($coll_id = NULL){
            
        $this->data['page_title'] = 'Returned Details';

        $this->data['table_data'] = $this->db->query('select acc.account_no,coll.id as coll_id,
        DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_shortname,coll.amount,
        coll.bank_name,coll.cheque_no,mem.member_name,mem.address,mem.mobile_number,mem.status as member_status,
        grp.name as group_name,DATE_FORMAT(grp.start_date, "%d-%m-%Y") as start_date,grp.id as grp_id,grp.status as group_status, 
        DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from vc_return_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        INNER JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
        INNER JOIN month_master as month ON month.month_code = coll.fk_month_code
        INNER JOIN group_master as grp ON coll.fk_group_id = grp.id 
        INNER JOIN vc_master as vc ON coll.fk_vc_id = vc.id where coll.id = '.$coll_id)->row_array();
      
        $this->render_template($this->viewPath . 'form_view', $this->data);

    }
    //  public function pdf(){
        
    //     $this->render_template($this->viewPath . 'pdf');
    //  }
     
    public function viewpdf($id)
	{
        //CERTIFICATE DATA
        $data['table_data'] = $this->db->query('select acc.account_no,coll.id as coll_id,
        DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_shortname,coll.amount,
        coll.bank_name,coll.cheque_no,mem.member_name,mem.address,mem.mobile_number,mem.status as member_status,
        grp.name as group_name,DATE_FORMAT(grp.start_date, "%d-%m-%Y") as start_date,grp.id as grp_id,grp.status as group_status, 
        DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from vc_return_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        LEFT JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
        INNER JOIN month_master as month ON month.month_code = coll.fk_month_code
        INNER JOIN group_master as grp ON coll.fk_group_id = grp.id 
        INNER JOIN vc_master as vc ON coll.fk_vc_id = vc.id where coll.id = '.$id)->row_array();
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

    public function downloadpdf($id,$fk_party_id = NULL)
	{   
        $data['table_data'] = $this->db->query('select acc.account_no,coll.id as coll_id,
        DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_shortname,coll.amount,
        coll.bank_name,coll.cheque_no,mem.member_name,mem.address,mem.mobile_number,mem.status as member_status,
        grp.name as group_name,DATE_FORMAT(grp.start_date, "%d-%m-%Y") as start_date,grp.id as grp_id,grp.status as group_status, 
        DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from vc_return_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        LEFT JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
        INNER JOIN month_master as month ON month.month_code = coll.fk_month_code
        INNER JOIN group_master as grp ON coll.fk_group_id = grp.id 
        INNER JOIN vc_master as vc ON coll.fk_vc_id = vc.id where coll.id = '.$id)->row_array();
        $member_name = $data['table_data']['member_name'];
		$mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 10,			
			'mode' => 'utf-8',
			'format' => 'A5',
		]);
        $mpdf->curlAllowUnsafeSslRequests = true;
		$download = $this->load->view($this->viewPath . 'pdf',$data,true);
		$mpdf->WriteHTML($download);
		$mpdf->Output($member_name.'.pdf','D');
	}
    
    public function get_vc_name(){
         $group_id = $this->input->post('id');
        echo '<option selected disabled hidden>Select VC</option>';
        $query = $this->db->query("
        select * from vc_master as vc 
        where vc.status = 1 
        AND vc.group_id = ".$group_id."
        AND vc.deleted = 0;
        ")->result_array();
        // $query = $this->db->query("
        // select * from vc_master as vc 
        // where vc.status = 1 
        // AND vc.group_id = ".$group_id."
        // AND vc.id NOT IN(SELECT vc_r.fk_vc_id FROM vc_return_master as vc_r 
        // WHERE vc_r.fk_group_id = ".$group_id.")
        // AND vc.deleted = 0;
        // ")->result_array();
        foreach ($query as $k => $v){
            echo "<option value='".$v['id']."'>".$v['name']."</option>";
            }
    }


    public function get_member_name(){

        
            $vc_id = $this->input->post('vc_id');
            $group_id = $this->input->post('group_id');
          
        echo '<option selected disabled hidden>Select Member Name</option>';
        $q = $this->db->query("
        SELECT map.fk_member_id,map.fk_account_id, mem.member_name FROM account_master AS acc
        JOIN member_master AS mem
        ON mem.id = acc.fk_member_id
        JOIN group_member_mapping_master AS map
        ON map.fk_account_id = acc.account_no
        WHERE mem.deleted = 0 AND acc.status = 1 AND acc.deleted = 0 
        AND map.fk_group_id = 
        ".$group_id
        )->result_array();
        // $q = $this->db->query("
        // SELECT map.fk_member_id,map.fk_account_id, mem.member_name FROM account_master AS acc
        // JOIN member_master AS mem
        // ON mem.id = acc.fk_member_id
        // JOIN group_member_mapping_master AS map
        // ON map.fk_account_id = acc.account_no
        // WHERE mem.deleted = 0 AND acc.status = 1 AND acc.deleted = 0 AND 
        //  acc.account_no  NOT IN (SELECT vc_return.fk_acc_id FROM vc_return_master as vc_return 
        //  where  vc_return.fk_group_id = ".$group_id." AND vc_return.status = 1 AND vc_return.deleted = 0)
        // AND map.fk_group_id = 
        // ".$group_id
        // )->result_array(); 
        
        foreach ($q as $k => $v){
        echo "<option value='".$v['fk_account_id']."'>(". $v['fk_account_id'] .")".$v['member_name']."</option>";
        }
    }

    public function get_amount(){
        $vc_id = $this->input->post('vc_id');
        $group_id = $this->input->post('group_id');
        $month_id = $this->input->post('month_id');
        $total_amount = 0;
        $colletion = $this->db->query("
        select * from collection_master 
        where fk_group_id = $group_id AND fk_month_code = $month_id AND fk_vc_id = $vc_id
        ")->result_array();
       foreach($colletion as $amount){
            $total_amount = $amount['amount'] + $total_amount;
       }
       echo $total_amount;
    }

    public function get_month(){
        $vc_id = $this->input->post('vc_id');
        $group_id = $this->input->post('group_id');

        $data = $this->db->query("
        SELECT * FROM month_master as month
        WHERE month.deleted = 0;
        ")->result_array();
        
        // $data = $this->db->query("
        // SELECT * FROM month_master as month
        // JOIN vc_master as vc ON vc.id = ".$vc_id."
        // WHERE month.month_code = vc.fk_month_code;
        // ")->result_array();

        // $data = $this->db->query("
        // SELECT * FROM month_master where month_master.month_code 
        // NOT IN (SELECT vc_return.fk_month_code FROM vc_return_master as vc_return 
        // where 
        // vc_return.fk_group_id = $group_id AND vc_return.status = 1 AND vc_return.deleted = 0)
        // ")->result_array();
        
         echo "<option selected disabled hidden>Select Month Name</option>";
        foreach ($data as $k => $v){
            echo "<option value='".$v['month_code']."'>".$v['month_shortname']."</option>";
            }
    }
    
     public function delete_attachment($id = null){
      
        $this->db->where('id', $id);
    
        $data =  array(
            'attachment' => '',
        );
        $query = $this->db->update($this->tableName, $data);
        if($query == true){
            $this->session->set_flashdata('success', 'Successfully Deleted Attachment');
            // redirect($this->controllerPath, 'refresh');
            redirect($this->controllerPath.'edit/'.$id, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Cannot Deleted Attachment');
            // redirect($this->controllerPath, 'refresh');
            redirect($this->controllerPath.'edit/'.$id, 'refresh');
        }
    }
    
}