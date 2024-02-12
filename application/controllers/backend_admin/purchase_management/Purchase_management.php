<?php

class Purchase_management extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'purchase_management';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/purchase_management/Purchase_management';
        $this->viewPath = 'admin/purchase_management/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Purchase';
        // $this->tablename = 'party_master';
    }

    public function index()
    {

        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Purchase';

        $table_data = $this->db->query('select * from account_master as AM
        JOIN purchase_management as PM ON PM.fk_account_member_id = AM.account_no
        where PM.deleted = 0 AND PM.status= 1 AND PM.fk_financial_year_id=' . $_SESSION['year'] . ' AND AM.fk_financial_year_id = ' . $_SESSION['year'])->result_array();

        $voucher_no = $this->db->query('select * from account_master as AM
        JOIN purchase_management as PM ON PM.fk_account_member_id = AM.account_no
        where PM.deleted = 0 AND PM.status= 1 ORDER BY PM.voucher_no ASC ')->result_array();

        $this->data['voucher_no'] = end($voucher_no)['voucher_no'];

        // $this->data['voucher_no'] = end($table_data)['voucher_no'];


        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }

    public function create($acc_no = NULL)
    {

        $this->data['page_title'] = 'Add Purchase';

        if (isset($_POST['submit'])) {
            foreach ($_POST['row'] as $v) {

                $data = array(
                    'voucher_no' => $v['voucher_no'],
                    'purchase_date' => $v['purchase_date'],
                    'fk_account_member_id' => $v['member_name'],
                    'amount' => $v['amount'],
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

        $data = $this->db->query("select PM.id as id,PM.purchase_date as date,PM.voucher_no as voucherno,PM.amount as amountno,PM.fk_account_member_id as membername, AM.account_no as account_no, PM.transaction as transaction from account_master as AM
        JOIN purchase_management as PM ON PM.fk_account_member_id = AM.account_no
        where AM.deleted = 0 AND AM.status= 1 AND PM.voucher_no =" . $voucherno . " AND PM.fk_financial_year_id=" . $_SESSION['year'])->row_array();

        echo json_encode($data);
    }

    public function edit($acc_no = null)
    {


        $this->data['page_title'] = 'Edit Purchase';


        if ($acc_no) {

            $this->form_validation->set_rules('member_name', 'Member Name', 'required');

            if ($this->form_validation->run() == TRUE) {


                $data = array(
                    'member_name' => $this->input->post('member_name'),
                    'address' => $this->input->post('address'),
                    'mobile_number' => $this->input->post('mobile_no'),
                    'email' => $this->input->post('email'),
                    'status' => $this->input->post('status'),
                    'opening_balance' => $this->input->post('opening_balance'),
                    'fk_financial_year_id' => $_SESSION['year'],
                    'account_no' =>  $acc_no,
                );

                //  print_r('<pre>');   
                //     print_r($data); 
                //     exit(); 


                // $data['acc_closing_date'] = date('Y-m-d',$closing_date);
                $affectedRows = $this->Crud_model->update($this->tableName, array('account_no' => $acc_no), $data);

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . '/index' . $id, 'refresh');
                }
            } else {

                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('account_no' => $acc_no));

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
}