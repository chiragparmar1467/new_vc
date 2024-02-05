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
        JOIN purchase_management as CM ON CM.fk_account_member_id = AM.id
        where AM.deleted = 0 AND AM.status= 1;')->result_array();

        // $table_data = $this->db->query('select * from account_master where deleted = 0 AND status = 1')->result_array();

        // if($table_data[$party]){

        // }
        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'create', $this->data);
    }

    public function create($acc_no = NULL)
    {
print_r('<pre>');
print_r('In');
print_r('<pre>');
print_r($_POST);
exit();
        $this->data['page_title'] = 'Add Purchase';

        // Set validation rules for array inputs
        $this->form_validation->set_rules('voucher_no[]', 'Voucher No.', 'required');

        $table_data = $this->db->query('select * from account_master as AM
        JOIN purchase_management as CM ON CM.fk_account_member_id = AM.id
        where AM.deleted = 0 AND AM.status= 1;')->result_array();
        // $voucherNumbers = $this->input->post('voucher_no[]');
        if ($this->input->post('voucher_no[]') != $table_data['voucher_no']) {
            
            if ($this->form_validation->run() == TRUE) {
                
                $voucherNumbers = $this->input->post('voucher_no[]');
                print_r('<pre>');
                print_r($voucherNumbers);
                   exit();
                $purchaseDates = $this->input->post('cash_date[]');
                $memberNames = $this->input->post('member_name[]');
                $amounts = $this->input->post('amount[]');

                // Check if the variables are arrays before using count()
                if (is_array($voucherNumbers) && is_array($cashDates) && is_array($memberNames) && is_array($amounts)) {
                    $count = count($voucherNumbers); // Assuming all arrays have the same length

                    for ($i = 0; $i < $count; $i++) {
                        $data = array(
                            'voucher_no' => $voucherNumbers[$i],
                            'cash_date' => $cashDates[$i],
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
        } else {
        
            $voucher_no = $this->input->post('voucher_no');
             
                $voucher_data = $this->db->query('select * from account_master as AM
                                                JOIN purchase_management as CM ON CM.fk_account_member_id = AM.id
                                                where AM.deleted = 0 AND AM.status= 1 AND CM.voucher_no =' . $voucher_no)->row_array();
                print_r('<pre>');
                print_r($voucher_data);
                exit();
            
        }
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
