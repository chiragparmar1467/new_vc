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
        if ('collected' == 0) {
        }
        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }


    public function create($account_number = null)
    {

        $this->data['page_title'] = 'Add Carry forward';
        // $this->form_validation->set_rules('party_name', 'Party Name', 'required');
        $this->load->library('upload');
        if (isset($_POST['submit'])) {

            $closing_year =  $this->input->post('closing_year');
            $carry_forward = $this->input->post('cary_forward');

            $bankmaster_data = $this->db->query('SELECT bank_name,bank_ifsc,bank_account_no,fk_financial_year_id
            FROM bank_master
            WHERE status = 1
                  AND deleted = 0
                  AND fk_financial_year_id =' . $closing_year)->result_array();

            if ($bankmaster_data != null) {
                foreach ($bankmaster_data as $bank_master) {
                    $data = array(
                        'bank_account_no' => $bank_master['bank_account_no'],
                        'bank_name' => $bank_master['bank_name'],
                        'bank_ifsc' => $bank_master['bank_ifsc'],
                        'status' => 1,
                        'fk_financial_year_id' => $carry_forward,

                    );
                    $create = $this->Crud_model->save('bank_master', $data);
                }
            }

            $accmaster_data = $this->db->query('SELECT account_no,member_name,
                                                address,mobile_number,opening_balance
                                                            FROM account_master
            WHERE status = 1
                  AND deleted = 0
                  AND fk_financial_year_id =' . $closing_year)->result_array();

            if ($accmaster_data != null) {
                foreach ($accmaster_data as $acc_master) {
                    $data = array(
                        'account_no' => $acc_master['account_no'],
                        'member_name' => $acc_master['member_name'],
                        'address' => $acc_master['address'],
                        'opening_balance' => $acc_master['opening_balance'],
                        'mobile_number' => $acc_master['mobile_number'],
                        'status' => 1,
                        'fk_financial_year_id' => $carry_forward,
                        'deleted' =>0,
                    );
                    $create = $this->Crud_model->save('account_master', $data);
                }
            }

            $cashaccount_data = $this->db->query('SELECT member_name,
                                                    account_no,
                                                    address,
                                                    mobile_number,
                                                    fk_financial_year_id,
                                                    SUM(credit) AS credit,
                                                    SUM(debit) AS debit,
                                                    SUM(debit) -  SUM(credit) AS balance
                                                    FROM (
                                                    SELECT AM.member_name as member_name,
                                                        AM.account_no,
                                                        CM.fk_financial_year_id,
                                                        AM.address,
                                                        AM.mobile_number,
                                                        SUM(CASE WHEN CM.transaction = 1 THEN CM.amount ELSE 0 END) AS credit,
                                                        SUM(CASE WHEN CM.transaction = 0 THEN CM.amount ELSE 0 END) AS debit
                                                    FROM cash_management CM
                                                    JOIN account_master AM ON AM.account_no = CM.fk_account_member_id
                                                    WHERE CM.status = 1
                                                        AND CM.deleted = 0
                                                        AND AM.status = 1
                                                        AND AM.deleted = 0 AND cm.fk_financial_year_id = ' . $closing_year . '
                                                    GROUP BY AM.account_no, AM.member_name
                                                    ) AS subquery
                                                    GROUP BY member_name, account_no;')->result_array();

                                                   
            if ($cashaccount_data != null) {
                foreach ($cashaccount_data as $acc) {

                    $data = array(
                        'opening_balance' => $acc['balance'],
                    );

                    $create = $this->Crud_model->update('account_master', array('account_no'=>$acc['account_no'], 'fk_financial_year_id'=>$carry_forward),$data);
                }
            }

            $purchase_data = $this->db->query(' SELECT AM.member_name,
            AM.account_no,
            PM.purchase_date,
            PM.voucher_no,
            PM.amount
            FROM purchase_management AS PM
            LEFT JOIN account_master AM ON AM.account_no = PM.fk_account_member_id
            WHERE PM.status = 1
                  AND PM.deleted = 0
                  AND AM.status = 1
                  AND AM.deleted = 0 AND PM.fk_financial_year_id =' . $closing_year . ' AND AM.fk_financial_year_id =' . $closing_year)->result_array();

            if ($purchase_data != null) {
                foreach ($purchase_data as $purchase) {

                    $data = array(
                        'voucher_no' => $purchase['voucher_no'],
                        'purchase_date' => $purchase['purchase_date'],
                        'fk_account_member_id' => $purchase['account_no'],
                        'amount' => $purchase['amount'],
                        'fk_financial_year_id' => $carry_forward,
                        'status' => 1
                    );

                    $create = $this->Crud_model->save('purchase_management', $data);
                }
            }

            $sell_data = $this->db->query('SELECT AM.member_name,
            AM.account_no,
            SM.sell_date,
            SM.voucher_no,
            SM.amount
            FROM sell_management AS SM
            LEFT JOIN account_master AM ON AM.account_no = SM.fk_account_member_id
            WHERE SM.status = 1
                  AND SM.deleted = 0
                  AND AM.status = 1
                  AND AM.deleted = 0 AND AM.fk_financial_year_id =' . $closing_year)->result_array();

            if ($sell_data != null) {
                foreach ($sell_data as $sell) {

                    $data = array(
                        'voucher_no' => $sell['voucher_no'],
                        'sell_date' => $sell['sell_date'],
                        'fk_account_member_id' => $sell['account_no'],
                        'amount' => $sell['amount'],
                        'fk_financial_year_id' => $carry_forward,
                        'status' => 1
                    );

                    $create = $this->Crud_model->save('sell_management', $data);
                }
            }

            $bank_data = $this->db->query('(
                SELECT AM.member_name,
                         AM.account_no,
                         BM.bank_date,
                         BM.voucher_no,
                         BM.amount credit,
                         NULL AS debit,
                         BM.transaction,
                         BM.amount as amount,
                         MB.bank_name as bank_name,
                         MB.id as bank_id
                     FROM bank_management BM
                   LEFT JOIN account_master AM ON AM.account_no = BM.fk_account_member_id
                   JOIN bank_master as MB ON MB.id = BM.fk_bank_id
                        WHERE BM.status = 1
                               AND BM.deleted = 0
                               AND BM.transaction = 1
                               AND AM.status = 1
                               AND AM.deleted = 0 AND AM.fk_financial_year_id = ' . $closing_year . '
                )
                       UNION ALL
                (
                SELECT AM.member_name,
                         AM.account_no,
                         BM.bank_date,
                         BM.voucher_no,
                         NULL AS credit,
                         BM.amount debit,
                         BM.transaction,
                         BM.amount as amount,
                         MB.bank_name as bank_name,
                         MB.id as bank_id
                     FROM bank_management BM
                    LEFT JOIN account_master AM ON AM.account_no = BM.fk_account_member_id
                    JOIN bank_master as MB ON MB.id = BM.fk_bank_id
                        WHERE BM.status = 1
                               AND BM.deleted = 0
                               AND BM.transaction = 0
                               AND AM.status = 1
                               AND AM.deleted = 0 AND AM.fk_financial_year_id =' . $closing_year . ' )')->result_array();


            if ($bank_data != null) {
                foreach ($bank_data as $bank) {

                    $data = array(
                        'voucher_no' => $bank['voucher_no'],
                        'bank_date' => $bank['bank_date'],
                        'fk_account_member_id' => $bank['account_no'],
                        'amount' => $bank['amount'],
                        'fk_bank_id' => $bank['bank_id'],
                        'transaction' => $bank['transaction'],
                        'fk_financial_year_id' => $carry_forward,
                        'status' => 1
                    );

                    $create = $this->Crud_model->save('bank_management', $data);
                }
            }

            if (!empty($closing_year) && !empty($carry_forward)) {
                $data = array(
                    'old_fk_financial_year_id' => $closing_year,
                    'fk_financial_year_id' => $carry_forward,
                );

                $create = $this->Crud_model->save('carry_forward', $data);
            }

            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . 'create', 'refresh');
            }
        } else {
            //     $this->db->order_by('id', "DESC");
            //    $table_data = $this->db->get('vc_master')->result_array()[0];
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

            if (isset($_POST['submit'])) {


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

                if (!empty($this->input->post('cheque_image'))) {
                    $config['upload_path']   = 'assets/uploads/document/';
                    $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('cheque_image')) {
                        // print_r('<pre>');
                        //     print_r('upload');
                        //     exit();
                        $front = array('upload_data' => $this->upload->data());
                        // echo "<script>alert('File uploaded Successfully!');</script>";
                        $data = array('cheque_image' => $front['upload_data']['file_name']);

                        $this->Crud_model->update('loan_master', array('id' => $id), $data);
                        $table_data = $this->Crud_model->get($this->tableName, 'id', array('deleted' => 0));

                        $this->data['table_data'] = $table_data;
                        $this->render_template($this->viewPath . 'index', $this->data);
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        print_r('<pre>');
                        print_r($error);
                        exit();
                    }
                } else {

                    $data['cheque_image'] = $this->input->post('cheque_image');

                    $affectedRows = $this->Crud_model->update('loan_master', array('id' => $id), $data);
                    $table_data = $this->Crud_model->get($this->tableName, 'id', array('deleted' => 0));

                    $this->data['table_data'] = $table_data;
                    $this->render_template($this->viewPath . 'index', $this->data);
                }

                if (!empty($this->input->post('total_amount'))) {

                    $data['per_month_interest'] = $this->input->post('total_amount');
                }
                if (!empty($this->input->post('monthly_amount'))) {

                    $data['total_interest_amount'] = $this->input->post('monthly_amount');
                }
                if (!empty($this->input->post('final_amount'))) {

                    $data['final_amount'] = $this->input->post('final_amount');
                }

                $opening_date = strtotime($data['acc_opening_date']);
                $closing_date = strtotime($data['acc_closing_date']);

                $data['acc_opening_date'] = date('Y-m-d', $opening_date);
                $closing_date = strtotime($data['acc_closing_date']);

                $data['acc_closing_date'] = date('Y-m-d', $closing_date);
                $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $id), $data);



                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'index/' . $id, 'refresh');
                }
            } else {
                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $id));
                $this->data['edit_data'] = $slider_data;
                $this->render_template($this->viewPath . 'edit', $this->data);
            }
        }
    }

    function updateStatus($id = NULL, $status = NULL)
    {

        $query = $this->Crud_model->update($this->tableName, array('id' => $id), array('status' => $status));

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

    public function account_no()
    {
        $id = $_POST['id'];
        $table_data = $this->Crud_model->get('loan_account_master', '', array('fk_party_id' => $id, 'deleted' => '0', 'status' => '1'));

        echo "<option selected disabled hidden>Select Account No</option>";
        foreach ($table_data as $value) {

            echo "<option value='" . $value['account_no'] .  "'>" . $value['account_no'] . "</option>";
        }
    }
    public function form_view($id)
    {
        $this->db->where('id', $id);
        // $data['vc_master'] = $this->db->get('vc_master')->row_array();

        $this->render_template($this->viewPath . 'form_view', $data);
    }


    public function viewpdf($id)
    {
        //CERTIFICATE DATA
        $this->db->where('id', $id);
        // $data['vc_master'] = $this->db->get('vc_master')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $id));
        $this->data['edit_data'] = $slider_data;
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 10,
            'mode' => 'utf-8',
            'format' => 'A5',
        ]);
        $mpdf->curlAllowUnsafeSslRequests = true;
        $pdf = $this->load->view($this->viewPath . 'pdf', $data, true);

        $mpdf->WriteHTML($pdf);
        $mpdf->Output(); // opens in browser

        //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    }

    public function downloadpdf($id)
    {
        //CERTIFICATE DATA
        $this->db->where('id', $id);
        $data['loan_master'] = $this->db->get('loan_master')->row_array();
        $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $id));
        $this->data['edit_data'] = $slider_data;
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 10,
            'mode' => 'utf-8',
            'format' => 'A5',
        ]);
        $mpdf->curlAllowUnsafeSslRequests = true;
        $download = $this->load->view($this->viewPath . 'pdf', $data, true);
        $mpdf->WriteHTML($download);
        $mpdf->Output($party_name . '.pdf', 'D');
    }
}
