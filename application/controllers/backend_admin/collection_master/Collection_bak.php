<?php
require_once 'vendor/autoload.php';
class Collection extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'collection_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/collection_master/Collection/';
        $this->CreditDebitControllerPath = 'backend_admin/credit_debit_money_mst/Credit_debit_money_mst/';
        $this->viewPath = 'admin/collection_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Collection';
        // $this->tablename = 'member_master';
    }

    public function index()
    {
        
        $this->data['page_title'] = 'Collection';
        $table_data = $this->db->query('select coll.id as coll_id,
        DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,
        month.month_name,
        coll.amount,
        mem.member_name,
        mem.status as member_status,
        grp.name as group_name,
        grp.id,
        grp.status as group_status, 
        grp.end_date,
        vc.name,
        vc.instalment
     from collection_master as coll
             INNER JOIN member_master as mem ON coll.fk_member_id = mem.id
             INNER JOIN month_master as month ON coll.fk_month_code = month.month_code
             INNER JOIN group_master as grp ON coll.fk_group_id = grp.id
             INNER JOIN vc_master as vc ON coll.fk_vc_id = vc.id
             where coll.deleted = 0 AND coll.status = 1 
             AND mem.status = 1 AND mem.deleted = 0
             AND grp.status = 1 AND grp.deleted = 0
             AND vc.status = 1 AND vc.deleted = 0;')->result_array();

     
        $this->data['table_data'] = $table_data;
     
        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create($vc_id = null , $group_id = null)
    {
        
        $this->data['page_title'] = 'Add Collection';
        if(isset($_POST['submit'])){
          
      
       $this->form_validation->set_rules('member_name', 'member Name', 'required');
   
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
        if ($this->form_validation->run() == TRUE) {
           
            $data = array(
                'collection_date' => $this->input->post('collection_date'),
                'fk_group_id' => $this->input->post('group_name'),
                'fk_month_code' => $this->input->post('month'),
                'fk_vc_id' => $this->input->post('vc_name'),
                'fk_acc_id' => $this->input->post('member_name'),
                'fk_member_id' => $member->fk_member_id,
                'bank_name' => $this->input->post('bank_name'),
                  'credit_bank_name' => $this->input->post('credit_bank_name'),
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
                // redirect($this->controllerPath, 'refresh');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        }
        else{
            $this->session->set_flashdata('errors', 'Something went wrong ');
       $this->render_template($this->viewPath . 'create', $this->data);
        }
       
    } 
        else {
            $this->data['vc_id'] = $vc_id;
    
            $this->data['group_id'] = $group_id;
        
            $this->render_template($this->viewPath . 'create', $this->data);
        }
 
    }

    public function edit($id = null)
    {
        
        $this->data['page_title'] = 'Edit Collection Details';

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
                        // print_r('<pre>');   
                        //    print_r($data['upload_data']['file_name']); 
                        //    exit(); 
                        $acc_id = $this->input->post('member_name');
                        $member = $this->db->get_where('account_master',array('account_no'=>$acc_id))->row();
                        if ($this->form_validation->run() == TRUE) {
            
            $data = array(
                'collection_date' => $this->input->post('collection_date'),
                'fk_group_id' => $this->input->post('group_name'),
                'fk_month_code' => $this->input->post('month'),
                'fk_vc_id' => $this->input->post('vc_name'),
                  'credit_bank_name' => $this->input->post('credit_bank_name'),
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
                // $update = $this->model_groups->edit($data, $id);
                $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $id), $data);

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    // redirect($this->controllerPath, 'refresh');
                    redirect($this->controllerPath.'collection_view/'.$data['fk_vc_id'], 'refresh');

                } else {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath.'collection_view/'.$data['fk_vc_id'], 'refresh');
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

    public function collection_view($vc_id = NUll)
    {
        if ($vc_id) {
            $this->data['page_title'] = 'Collection';
            $this->data['vc_id'] = $vc_id;
            $table_data = $this->db->query('select coll.id as coll_id,DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_name,coll.amount,mem.member_name,mem.status as member_status,grp.name,grp.id,grp.status as group_status, grp.end_date from collection_master as coll
            INNER JOIN member_master as mem ON coll.fk_member_id = mem.id
            INNER JOIN month_master as month ON coll.fk_month_code = month.month_code
            INNER JOIN group_master as grp ON coll.fk_group_id = grp.id
            where coll.deleted = 0 AND coll.status = 1 AND coll.fk_vc_id = '.$vc_id)->result_array();
            // $table_data = $this->db->query('select DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,coll.amount,mem.member_name,grp.name from collection_master as coll
            // INNER JOIN member_master as mem ON coll.fk_member_id = mem.id
            // INNER JOIN group_master as grp ON coll.fk_group_id = grp.id
            // where coll.fk_vc_id = 1;')->result_array();
            // $table_data = $this->db->query('SELECT party.member_name,col.fk_group_id,party.address,party.status as party_status,acc.status as acc_status,col.id, DATE_FORMAT(col.collection_date, "%d-%m-%Y") as collection_date,col.amount,acc.end_date FROM member_master AS party INNER JOIN collection_master AS col ON party.id = col.fk_member_id INNER JOIN 
            // group_master AS acc ON col.fk_group_id = acc.id where col.deleted = 0 AND acc.deleted = 0 AND party.deleted = 0 AND col.fk_vc_id = "'.$id.'" order by col.id DESC;')->result_array();
    
         
            $this->data['table_data'] = $table_data;
         
            $this->render_template($this->viewPath . 'coll_view', $this->data);
        }
    }

    public function form_view($coll_id = NULL){
      
        $this->data['table_data'] = $this->db->query('select acc.account_no,coll.id as coll_id,DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_name,coll.amount,coll.bank_name,coll.cheque_no,mem.member_name,mem.address,mem.mobile_number,mem.status as member_status,grp.name as group_name,DATE_FORMAT(grp.start_date, "%d-%m-%Y") as start_date,grp.id as grp_id,grp.status as group_status, DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from collection_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        Left JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
        INNER JOIN month_master as month ON month.month_code = coll.fk_month_code
        INNER JOIN group_master as grp ON coll.fk_group_id = grp.id 
        INNER JOIN vc_master as vc ON coll.fk_vc_id = vc.id where coll.id = '.$coll_id)->row_array();
      
        $this->render_template($this->viewPath . 'view', $this->data);

    }

    public function viewpdf($id)
    {
       
        $data['table_data'] = $this->db->query('select acc.account_no,coll.id as coll_id,
        DATE_FORMAT(coll.collection_date, "%d-%m-%Y") as collection_date,month.month_shortname,coll.amount,
        coll.bank_name,coll.cheque_no,mem.member_name,mem.address,mem.mobile_number,mem.status as member_status,
        grp.name as group_name,DATE_FORMAT(grp.start_date, "%d-%m-%Y") as start_date,grp.id as grp_id,grp.status as group_status, 
        DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from collection_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        INNER JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
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
        DATE_FORMAT(grp.end_date, "%d-%m-%Y") as end_date,vc.name,pay.payment_mode,pay.id from collection_master as coll 
        INNER JOIN member_master as mem ON coll.fk_member_id = mem.id 
        INNER JOIN account_master as acc ON acc.account_no = coll.fk_acc_id
        INNER JOIN payment_mode as pay ON coll.fk_payment_id = pay.id 
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


    public function get_vc_name(){
       $id = $_POST['id'];
     
       $table_data = $this->Crud_model->get('vc_master', '', array('group_id' => $id,'deleted'=>'0','status'=>'1','fk_financial_year_id' => $_SESSION['year']));
     
       echo "<option selected disabled hidden>Select Vc </option>";
	foreach ($table_data as $value) {
      
        echo "<option value='" . $value['id'] .  "'>" . $value['name'] . "</option>";
                                        }
    }

  

    public function collection_amount($id = NULL){
     $id = $_POST['id'];

        $table_data = $this->db->get_where('account_master',array('account_no' => $id,'deleted'=>'0','status'=>'1'))->row();
        // echo  '<input type="text" class="form-control" id="amount" name="amount" value="' . $table_data->daily_collection_amount . '" placeholder="Enter Amount" autocomplete="off" >';
        echo   $table_data->daily_collection_amount;            
    }

    public function get_amount(){
        $vc_id = $_POST['vc_id'];
        $table_data = $this->db->get_where('vc_master',array('id' => $vc_id,'deleted'=>'0','status'=>'1','fk_financial_year_id' => $_SESSION['year']))->row();
        // echo  '<input type="text" class="form-control" id="amount" name="amount" value="' . $table_data->daily_collection_amount . '" placeholder="Enter Amount" autocomplete="off" >';
        echo   $table_data->instalment; 
    }

    public function get_member_name(){
        $group_id = $_POST['group_id'];
        $vc_id = $_POST['vc_id'];
        $month_id = $_POST['month_id'];

        $q = $this->db->query('
       SELECT DISTINCT map.fk_account_id,member.id,member.member_name
         FROM `group_member_mapping_master` as map 
         JOIN member_master as member ON member.id = map.fk_member_id 
         JOIN account_master as acc ON map.fk_account_id = acc.account_no
         WHERE acc.status = 1 AND acc.deleted = 0 AND acc.account_no NOT IN (SELECT col.fk_acc_id FROM collection_master as col 
         where  col.fk_vc_id = '.$vc_id.' AND col.fk_month_code = '.$month_id.'
          AND col.status = 1 AND col.deleted = 0)
         AND map.fk_group_id = '.$group_id.';
        ')->result_array();
        echo '<option disabled selected hidden>Select Members</option>';
        foreach ($q as $k => $v){
            echo "<option value='".$v['fk_account_id']."'>(". $v['fk_account_id'] .")".$v['member_name']."</option>";
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

} // main function