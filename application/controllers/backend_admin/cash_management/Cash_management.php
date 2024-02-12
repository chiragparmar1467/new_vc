<?php

class Cash_management extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'cash_management';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/cash_management/Cash_management';
        $this->viewPath = 'admin/cash_management/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Cash';
        // $this->tablename = 'party_master';
    }

    public function index()
    {

        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Cash';

        $table_data = $this->db->query('select * from account_master as AM
        JOIN cash_management as CM ON CM.fk_account_member_id = AM.account_no
        where CM.deleted = 0 AND CM.status= 1 AND CM.fk_financial_year_id=' . $_SESSION['year'] . ' AND AM.fk_financial_year_id = ' . $_SESSION['year'] . ' ORDER BY CM.voucher_no ASC ')->result_array();
             
        $this->data['voucher_no'] = end($table_data)['voucher_no'];


        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }

    public function create($acc_no = NULL)
    {
        $this->data['page_title'] = 'Add Cash';

        if (isset($_POST['submit'])) {
            foreach ($_POST['row'] as $v) {
                $data = array(
                    'voucher_no' => $v['voucher_no'],
                    'cash_date' => $v['cash_date'],
                    'fk_account_member_id' => $v['member_name'],
                    'amount' => $v['amount'],
                    'transaction' => $v['transaction'],
                    'fk_financial_year_id' => $_SESSION['year'],
                    'status' => 1
                );
                if ($v['is_exist'] == '0') {
                    // exit();
                    $create = $this->Crud_model->save($this->tableName, $data);
                } else {
                    // exit();
                    $create = $this->Crud_model->update($this->tableName, array('voucher_no' => $v['voucher_no']), $data);
                }
            }
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect(site_url($this->controllerPath), 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect(site_url($this->controllerPath . '/create'), 'refresh');
            }
        } else {
            // Handle the case where one or more variables are not arrays
            $this->session->set_flashdata('errors', 'Invalid data format!!');
            redirect(site_url($this->controllerPath . '/create'), 'refresh');
        }
    }

    public function ajax_voucher_no($voucherno)
    {

        $data = $this->db->query("select CM.id as id,CM.cash_date as date,CM.voucher_no as voucherno,CM.amount as amountno,CM.fk_account_member_id as membername, AM.account_no as account_no, CM.transaction as transaction from account_master as AM
        JOIN cash_management as CM ON CM.fk_account_member_id = AM.account_no
        where AM.deleted = 0 AND AM.status= 1 AND CM.voucher_no =" . $voucherno . " AND CM.fk_financial_year_id =" . $_SESSION['year'] . " AND AM.fk_financial_year_id = " . $_SESSION['year'])->row_array();

        echo json_encode($data);
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
}
