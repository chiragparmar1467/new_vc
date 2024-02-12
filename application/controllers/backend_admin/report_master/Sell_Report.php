<?php
require_once 'vendor/autoload.php';


class Sell_Report extends Admin_Controller
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
        $this->controllerPath = 'backend_admin/report_master/Sell_Report/';
        $this->viewPath = 'admin/report/sell_report/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Sell';
    }

    public function index()
    {
        $this->data['page_title'] = 'Sell Report';

        $data['table_data'] = '';

        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create()
    {
        $this->data['page_title'] = 'Sell Report';

        if (isset($_POST['submit'])) {

            $voucher_no =  $this->input->post('voucher_no');
            $from_date =  $this->input->post('from_date');
            $to_date =  $this->input->post('to_date');
            $member_name =  $this->input->post('member_name');
            $data['isAccountSelected'] = 0;

            if (!empty($from_date) || !empty($to_date) || !empty($member_name) || !empty($voucher_no)) {


                $filter_date = "";
                // $voucher_no = "";
                $member = "";

                if (!empty($from_date) && $from_date !=  'dd-mm-yyyy') {
                    $filter_date = " AND SM.sell_date = '$from_date'";
                };

                if (!empty($to_date) && $to_date !=  'dd-mm-yyyy') {

                    $t_date = strtotime($to_date);
                    $to = date('Ymd', $t_date);

                    if (!empty($from_date) && $from_date !=  'dd-mm-yyyy') {
                        $filter_date = " AND SM.sell_date BETWEEN '$from_date' AND '$to_date'";
                    } else {
                        $filter_date = " AND SM.sell_date = $to_date";
                    }
                }

                if (!empty($member_name)) {

                    $member = " AND SM.fk_account_member_id	 = $member_name";
                    $member_id = " AND AM.account_no = $member_name";
                    $mem_name = $this->db->get_where('account_master', array('account_no' => $member_name))->row();
                    $mem = "Name : " . $mem_name->member_name . "<br>";
                    $opening_balance =  $mem_name->opening_balance;
                    $created_at_date =  $mem_name->created_at;
                }


                if (!empty($voucher_no)) {
                    $voucher = " AND SM.voucher_no = $voucher_no";
                }

                $year = " AND SM.fk_financial_year_id =" . $_SESSION['year'];

                $data['table_data'] = $this->db->query("
                SELECT AM.member_name,
                AM.account_no,
                SM.sell_date,
                SM.voucher_no,
                SM.amount
                FROM sell_management AS SM
                LEFT JOIN account_master AM ON AM.account_no = SM.fk_account_member_id
                WHERE SM.status = 1
                      AND SM.deleted = 0
                      AND AM.status = 1
                      AND AM.deleted = 0 AND AM.fk_financial_year_id = " . $_SESSION['year'] . $filter_date . $member . $voucher . $year . "
                    ")->result_array();

                $data['from'] = $from_date;
                $data['to'] = $to_date;
                $data['member'] = $mem;
                $data['opening_balance'] = $opening_balance;
                $formatted_date = date("d-m-Y", strtotime($created_at_date));
                $data['created_at_date'] = $formatted_date;

                $mpdf =  new \Mpdf\Mpdf(['format' => 'A5']);
                //  $mpdf = new \Mpdf\Mpdf();

                $html = $this->load->view($this->viewPath . 'vc_return_pdf', $data, true);

                $mpdf->WriteHTML($html);
                $mpdf->Output();
            } else {
                $this->data['page_title'] = 'Sell';

                $data['table_data'] = '';

                $this->render_template($this->viewPath . 'index', $data);
            }
        } else {
            $this->data['page_title'] = 'Sell';

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


    public function get_vc()
    {
        $group_id = $this->input->post('group_id');
        echo '<option selected disabled hidden>Select VC</option>';
        $query = $this->db->query("
        select * from vc_master where status = 1 AND deleted = 0 AND group_id ='" . $group_id . "'
        ")->result_array();
        foreach ($query as $k => $v) {
            echo "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
        }
    }

    public function get_voucher()
    {

        $member_id = $this->input->post('member_id');

        echo '<option selected disabled hidden>Select Voucher No</option>';
        $query = $this->db->query("
        SELECT DISTINCT * FROM purchase_management as PM JOIN account_master as AM ON AM.account_no = PM.fk_account_member_id
        WHERE PM.fk_account_member_id = '" . $member_id . "'
        ")->result_array();
        foreach ($query as $k => $v) {
            echo "<option value='" . $v['voucher_no'] . "'>" . $v['voucher_no'] . "</option>";
        }
    }

    public function get_acc()
    {
        $group_id = $this->input->post('group_id');
        $member_id = $this->input->post('member_id');
        if (!empty($member_id)) {
            $mem_where = " AND map.fk_member_id = " . $member_id;
            // print_r('<pre>');   
            //    print_r($group_id); 
            //    print_r($mem_where); 
            //    exit(); 
        }
        if (!empty($group_id)) {
            $group_where = " AND map.fk_group_id = " . $group_id;
        }
        echo '<option selected disabled hidden>Select Account No</option>';
        $query = $this->db->query(
            "
        SELECT map.fk_member_id,map.fk_account_id FROM group_member_mapping_master as map 
        WHERE map.status = 1 AND map.deleted = 0" . $group_where . $mem_where
        )->result_array();
        //  print_r('<pre>');   
        //  print_r($query); 
        //  print_r('<pre>');   
        //     print_r($this->db->last_query()); 
        //     exit(); 
        foreach ($query as $k => $v) {
            echo "<option value='" . $v['fk_account_id'] . "'>" . $v['fk_account_id'] . "</option>";
        }
    }
}
