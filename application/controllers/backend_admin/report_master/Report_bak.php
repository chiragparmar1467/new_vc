<?php
require_once 'vendor/autoload.php';


class Report extends Admin_Controller
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
        $this->controllerPath = 'backend_admin/report_master/Report/';
        $this->viewPath = 'admin/report/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Report';
    }

    public function index()
    {

        $this->data['page_title'] = 'Report';

        $data['table_data'] = '';
 
        $this->render_template($this->viewPath . 'index', $this->data);

    }

    public function create()
    {
        $this->data['page_title'] = 'Report';
        
        if(isset($_POST['submit'])){
            
            $type =  $this->input->post('report_type');
            $from_date =  $this->input->post('from_date');
            $to_date =  $this->input->post('to_date');
            $group_no =  $this->input->post('group_name');
            $vc_number = $this->input->post('vc_name');
            $member_name =  $this->input->post('member_name');
            $account_no = $this->input->post('acc_no');
       
                 if(!empty($from_date) || !empty($to_date) || !empty($member_name) || 
                    !empty($group_no) || !empty($vc_number) || !empty($account_no)){
                    
                     $filter_date = "";
                     $grp_no = "";
                     $vc_no = "";
                     $member = "";
                     $acc_no = "";

                 if(!empty($from_date) && $from_date !=  'dd-mm-yyyy' ){

                   $f_date = strtotime($from_date);
                   $from = date('Ymd',$f_date);
                    $filter_date = " AND coll.collection_date = $from";
                    $date = "Collection Date = $from_date <br>";
                 }

                if(!empty($to_date) && $to_date !=  'dd-mm-yyyy' ){

                     $t_date = strtotime($to_date);
                     $to = date('Ymd',$t_date);

                     if(!empty($from_date)){
                      $filter_date = " AND coll.collection_date BETWEEN $from AND $to";
                      $date = "Collection Date = Between " . date('d-m-Y', strtotime( $from_date)) ." and ".date('d-m-Y', strtotime( $to_date)) ."  <br>";
                     }
                     else{
                        $filter_date = " AND coll.collection_date = $to";
                        $date = "collection Date = $to_date <br>";
                     }  

                }

                if(!empty($group_no)){
                    
                    $grp_no = " AND coll.fk_group_id = $group_no";
                    $g_id = " AND id = ".$group_no;
                    $group_name = $this->db->get_where('group_master',array('id'=>$group_no))->row();
                    $group = " Group Name = ".$group_name->name."<br>";
                    
                }

                if(!empty($vc_number)){
                    $vc_no = " AND coll.fk_vc_id = $vc_number";
                    $vc_num = " AND vc.id = $vc_number";
                    $vc_name = $this->db->get_where('vc_master',array('id'=>$vc_number))->row();
                    
                    $g_id = " AND id = ".$vc_name->group_id;
                    $vc = " Loan Name = ".$vc_name->name."<br>";

                }

                if(!empty($member_name)){
                    
                    $member = " AND coll.fk_member_id = $member_name";
                    $mem_name = $this->db->get_where('member_master',array('id'=>$member_name))->row();
                    $mem = " Member Name = ".$mem_name->member_name."<br>";

                }

                if(!empty($account_no)){
                    
                    $acc_no = " AND coll.fk_acc_id = $account_no";
                    $ac = " Account Number = $account_no";

                }
                 
              if($type == 'Collection'){

                   $data['table_data'] = $this->db->query('SELECT grp.id as grp_id,mem.member_name ,mem.mobile_number,coll.fk_acc_id,coll.collection_date ,coll.fk_vc_id, coll.bank_name , coll.cheque_no ,coll.amount,
                      vc.name as vc_name, vc.vc_opening_date,vc.vc_closing_date,vc.minimum_amount,vc.maximum_amount,vc.instalment,
                      grp.name,grp.start_date as grp_start_date,grp.end_date,pay.payment_mode,month.month_name
                      FROM member_master as mem 
                      JOIN collection_master AS coll ON  mem.id = coll.fk_member_id
                      JOIN vc_master as vc ON vc.id = coll.fk_vc_id
                      JOIN group_master as grp ON grp.id = coll.fk_group_id
                      JOIN payment_mode as pay ON pay.id = coll.fk_payment_id
                      JOIN month_master as month ON month.month_code = coll.fk_month_code 
                      WHERE coll.deleted = 0 AND coll.fk_financial_year_id ='.$_SESSION['year'].' AND coll.status = 1' 
                      .$filter_date.$grp_no.$vc_no.$member.$acc_no.
                      ' GROUP BY coll.fk_vc_id order by coll.fk_vc_id DESC' )->result_array();
        
                   $vc_id = array();
             
                   foreach ($data['table_data'] as $row) {
           
                      array_push($vc_id, $row['fk_vc_id']);
                   }

                  $collection_query = 'SELECT mem.member_name ,mem.mobile_number,coll.fk_acc_id,coll.collection_date ,coll.fk_vc_id, coll.bank_name , coll.cheque_no ,coll.amount,
                     vc.name as vc_name, vc.vc_opening_date,vc.vc_closing_date,vc.minimum_amount,vc.maximum_amount,vc.instalment,
                     grp.name,grp.start_date as grp_start_date ,grp.end_date as grp_end_date,pay.payment_mode,month.month_name
                     FROM member_master as mem 
                     JOIN collection_master AS coll ON  mem.id = coll.fk_member_id
                     JOIN vc_master as vc ON vc.id = coll.fk_vc_id
                     JOIN group_master as grp ON grp.id = coll.fk_group_id
                     JOIN payment_mode as pay ON pay.id = coll.fk_payment_id
                     JOIN month_master as month ON month.month_code = coll.fk_month_code 
                     WHERE coll.deleted = 0 AND coll.fk_financial_year_id ='.$_SESSION['year'].' AND coll.status = 1 
                     AND coll.fk_vc_id IN ("' .implode('", "',$vc_id) .'")'
                     .$filter_date.$grp_no.$vc_no.$member.$acc_no.
                      ' order by coll.fk_vc_id DESC'; 

      
                     $data['collection_data'] = $this->db->query($collection_query)->result_array();
                    
                       $vc_return_query = "
                       SELECT mem.member_name ,mem.mobile_number,rvc.fk_month_code,rvc.fk_acc_id,rvc.collection_date ,rvc.fk_vc_id, rvc.bank_name , rvc.cheque_no ,rvc.amount,
                       vc.name as vc_name, vc.vc_opening_date,vc.vc_closing_date,vc.minimum_amount,vc.maximum_amount,vc.instalment,
                       grp.name,grp.start_date as grp_start_date,grp.end_date,pay.payment_mode,month.month_name
                       FROM member_master as mem 
                       JOIN vc_return_master AS rvc ON  mem.id = rvc.fk_member_id
                       JOIN vc_master as vc ON vc.id = rvc.fk_vc_id
                       JOIN group_master as grp ON grp.id = rvc.fk_group_id
                       JOIN payment_mode as pay ON pay.id = rvc.fk_payment_id
                       JOIN month_master as month ON month.month_code = rvc.fk_month_code 
                       WHERE rvc.status = 1 AND rvc.deleted = 0  AND rvc.fk_financial_year_id = ".$_SESSION['year'].";
                   ";

                     $data['vc_return_data'] = $this->db->query($vc_return_query)->result_array();

                     $view = "pdf";
                }

                elseif($type == 'Return'){

                    $data['groups'] = $this->db->query("SELECT * FROM group_master WHERE 
                                              fk_financial_year_id =". $_SESSION['year'] .$g_id)->result_array();
             
                    $data['vc'] = $this->db->query("SELECT vc.*,month.month_name FROM vc_master as vc 
                    JOIN month_master as month ON month.month_code = vc.fk_month_code
                    WHERE vc.fk_financial_year_id = ".$_SESSION['year'].$vc_num)->result_array();

                   $vc_return_query = "
                      SELECT mem.member_name ,mem.mobile_number,coll.fk_month_code,coll.fk_acc_id,coll.collection_date ,coll.fk_vc_id, coll.bank_name , coll.cheque_no ,coll.amount,
                       grp.id as group_id,vc.name as vc_name, vc.vc_opening_date,vc.vc_closing_date,
                        vc.minimum_amount,vc.maximum_amount,vc.instalment,
                        grp.name,grp.start_date as grp_start_date,grp.end_date,pay.payment_mode,month.month_name
                        FROM member_master as mem 
                        JOIN vc_return_master AS coll ON  mem.id = coll.fk_member_id
                        JOIN vc_master as vc ON vc.id = coll.fk_vc_id
                        JOIN group_master as grp ON grp.id = coll.fk_group_id
                        JOIN payment_mode as pay ON pay.id = coll.fk_payment_id
                        JOIN month_master as month ON month.month_code = coll.fk_month_code 
                        WHERE coll.status = 1 AND coll.deleted = 0 AND coll.fk_financial_year_id = ".$_SESSION['year']."
                        $filter_date $grp_no $vc_no $member $acc_no;
                   ";
                    //   print_r('<pre>');   
                    //   print_r($vc_return_query); 
                    //   exit(); 
                     $data['vc_return_data'] = $this->db->query($vc_return_query)->result_array();


                     $collection_query = 'SELECT mem.member_name ,mem.mobile_number,coll.fk_acc_id,coll.collection_date ,coll.fk_vc_id, coll.bank_name , coll.cheque_no ,coll.amount,
                     vc.name as vc_name, vc.vc_opening_date,vc.vc_closing_date,vc.minimum_amount,vc.maximum_amount,vc.instalment,
                     grp.id as group_id,grp.name,grp.start_date as grp_start_date ,grp.end_date as grp_end_date,pay.payment_mode,month.month_name
                     FROM member_master as mem 
                     JOIN collection_master AS coll ON  mem.id = coll.fk_member_id
                     JOIN vc_master as vc ON vc.id = coll.fk_vc_id
                     JOIN group_master as grp ON grp.id = coll.fk_group_id
                     JOIN payment_mode as pay ON pay.id = coll.fk_payment_id
                     JOIN month_master as month ON month.month_code = coll.fk_month_code 
                     WHERE coll.deleted = 0 AND coll.fk_financial_year_id ='.$_SESSION['year'].' AND coll.status = 1
                      order by coll.fk_vc_id DESC'; 

      
                     $data['collection_data'] = $this->db->query($collection_query)->result_array();
                    //  print_r('<pre>');   
                    //  print_r($data['vc_return_data']); 
                    //  exit(); 
                     $month_id = array();
             
                   foreach ($data['vc_return_data'] as $row) {
           
                      array_push($month_id, $row['fk_month_code']);
                   }

                     $view = "vc_return_pdf";
                }
                 $data['result_on'] = $date.$group.$vc.$mem.$ac;
                 $data['memb_filter'] =$mem;
                 $data['ac_filter'] = $ac;
                 $data['date_filter'] = $date;
                 $data['vc_filter'] = $vc;
                
              
                 $mpdf =  new \Mpdf\Mpdf(['format' => 'A5']);
                //  $mpdf = new \Mpdf\Mpdf();
                
                 $html = $this->load->view($this->viewPath.'/'.$view, $data,true);
        
                 $mpdf->WriteHTML($html);
                 $mpdf->Output();
               
    }
    else {
          $this->data['page_title'] = 'Report';

          $data['table_data'] = '';

          $this->render_template($this->viewPath . 'index', $data); 
      
    }
  }
        else {
            $this->data['page_title'] = 'Report';

            $data['table_data'] = '';
    
            $this->render_template($this->viewPath . 'index', $data); 
          
        }

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


    public function get_vc(){
        $group_id = $this->input->post('group_id');
        echo '<option selected disabled hidden>Select VC</option>';
        $query = $this->db->query("
        select * from vc_master where status = 1 AND deleted = 0 AND group_id ='" .$group_id."'
        ")->result_array();
        foreach ($query as $k => $v){
            echo "<option value='".$v['id']."'>".$v['name']."</option>";
            }
    }

    public function get_member(){
        $group_id = $this->input->post('group_id');
      
        echo '<option selected disabled hidden>Select Member Name</option>';
        $query = $this->db->query("
        SELECT DISTINCT mem.id,mem.member_name FROM group_member_mapping_master as map 
        JOIN member_master AS mem ON mem.id = map.fk_member_id
        WHERE map.fk_group_id ='" .$group_id."'
        ")->result_array();
        foreach ($query as $k => $v){
            echo "<option value='".$v['id']."'>".$v['member_name']."</option>";
            }
    }

    public function get_acc(){
        $group_id = $this->input->post('group_id');
        $member_id = $this->input->post('member_id');
        if(!empty($member_id)){
            $mem_where = " AND map.fk_member_id = " .$member_id;
            // print_r('<pre>');   
            //    print_r($group_id); 
            //    print_r($mem_where); 
            //    exit(); 
        }
        if(!empty($group_id)){
        $group_where = " AND map.fk_group_id = ".$group_id;
        }
        echo '<option selected disabled hidden>Select Account No</option>';
        $query = $this->db->query("
        SELECT map.fk_member_id,map.fk_account_id FROM group_member_mapping_master as map 
        WHERE map.status = 1 AND map.deleted = 0" . $group_where . $mem_where
        )->result_array();
        //  print_r('<pre>');   
        //  print_r($query); 
        //  print_r('<pre>');   
        //     print_r($this->db->last_query()); 
        //     exit(); 
        foreach ($query as $k => $v){
            echo "<option value='".$v['fk_account_id']."'>".$v['fk_account_id']."</option>";
            }
    }
}