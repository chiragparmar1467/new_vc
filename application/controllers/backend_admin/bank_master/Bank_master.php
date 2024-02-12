<?php

class Bank_master extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'bank_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/bank_master/Bank_master';
        $this->viewPath = 'admin/bank_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Bank';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Bank';

        $table_data = $this->db->query('select * from bank_master where deleted = 0 AND status = 1 AND fk_financial_year_id =' . $_SESSION['year'])->result_array();

        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }

    public function create($acc_no = NULL)
    {

        $this->data['page_title'] = 'Add Bank';

        $this->form_validation->set_rules('bank_account_no', 'Bank Account No', 'required');

        if ($this->form_validation->run() == TRUE) {


            $data = array(
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'bank_ifsc' => $this->input->post('bank_ifsc'),
                'status' => $this->input->post('status'),
                'fk_financial_year_id' => $_SESSION['year'],
                'status' => 1
            );


            $create = $this->Crud_model->save($this->tableName, $data);
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect($this->controllerPath, 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect($this->controllerPath . '/create', 'refresh');
            }
        } else {
            // $this->db->order_by('account_no', "DESC");
            $table_data = $this->db->get('bank_master')->result_array()[0];
            $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath . '/create', $this->data);
        }
    }

    public function edit($acc_no = null)
    {


        $this->data['page_title'] = 'Edit Bank Details';


        if ($acc_no) {

            $this->form_validation->set_rules('bank_account_no', 'Bank Account No', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'bank_name' => $this->input->post('bank_name'),
                    'bank_ifsc' => $this->input->post('bank_ifsc'),
                    'status' => $this->input->post('status'),
                    'fk_financial_year_id' => $_SESSION['year'],
                    'status' => 1
                );

                // $data['acc_closing_date'] = date('Y-m-d',$closing_date);
                $affectedRows = $this->Crud_model->update($this->tableName, array('id' => $acc_no), $data);

                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath, 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . '/index' . $id, 'refresh');
                }
            } else {

                $slider_data = $this->Crud_model->get_where_data($this->tableName, array('id' => $acc_no));

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
            $delete = $this->Crud_model->delete_by_id($this->tableName,  $id);

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
