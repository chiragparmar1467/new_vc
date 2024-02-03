<?php

class Bank_management extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'bank_management';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/bank_management/Bank_management';
        $this->viewPath = 'admin/bank_management/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Bank';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Bank';
        $table_data = $this->db->query('select * from account_master as AM
        JOIN bank_management as BM ON BM.fk_account_member_id = AM.id
        where AM.deleted = 0 AND AM.status= 1;')->result_array();
        
        
        $this->data['bill_no'] = end($table_data)['bill_no'];
                   

        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }

    public function create($acc_no = NULL)
    {

        $this->data['page_title'] = 'Add Cash';

        // Set validation rules for array inputs
        $this->form_validation->set_rules('bill_no[]', 'Bill No.', 'required');

        if ($this->form_validation->run() == TRUE) {

            $billNumbers = $this->input->post('bill_no[]');
            $bankDates = $this->input->post('bank_date[]');
            $memberNames = $this->input->post('member_name[]');
            $amounts = $this->input->post('amount[]');

            // Check if the variables are arrays before using count()
            if (is_array($billNumbers) && is_array($bankDates) && is_array($memberNames) && is_array($amounts)) {
                $count = count($billNumbers); // Assuming all arrays have the same length

                for ($i = 0; $i < $count; $i++) {
                    $data = array(
                        'bill_no' => $billNumbers[$i],
                        'bank_date' => $bankDates[$i],
                        'fk_account_member_id' => $memberNames[$i],
                        'amount' => $amounts[$i],
                    );

                    // Assuming you have a model named YourModel
                    $create = $this->Crud_model->save($this->tableName, $data);
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
        } else {
            $this->db->order_by('account_no', "DESC");
            $table_data = $this->db->get('account_master')->result_array()[0];
            $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath . '/create', $this->data);
        }
    }

    public function ajax_bill_no($billno)
    {

        $data = $this->db->query("select BM.id as id,BM.bank_date as date,BM.bill_no as billno,BM.amount as amountno,BM.fk_account_member_id as membername from account_master as AM
        JOIN bank_management as BM ON BM.fk_account_member_id = AM.id
        where AM.deleted = 0 AND AM.status= 1 AND BM.bill_no =" . $billno)->row_array();

        $data['id'] = $data[0]['id'];
        $data['bank_date'] = $data[0]['date'];
        $data['bill_no'] = $data[0]['billno'];
        $data['amount'] = $data[0]['amountno'];
        $data['member_name'] = $data[0]['membername'];

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
