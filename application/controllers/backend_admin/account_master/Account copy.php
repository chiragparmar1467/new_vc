<?php

class Account extends Admin_Controller
{
    // Specify the primary table name for whole controller
    public $tableName = 'account_master';
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/account_master/Account';
        $this->viewPath = 'admin/account_master/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Account';
        // $this->tablename = 'party_master';
    }

    public function index()
    {
        // $this->data['js'] = 'application/views/groups/index-js.php';
        $this->data['page_title'] = 'Account';



        // $table_data = $this->db->query('select *,member_master.status as member_status from member_master 
        // INNER JOIN account_master ON member_master.id=account_master.fk_member_id where account_master.deleted = 0 AND member_master.deleted = 0 order by account_master.id ASC;')->result_array();

        $table_data = $this->db->query('select * from account_master;')->result_array();

        // if($table_data[$party]){

        // }
        $this->data['table_data'] = $table_data;

        $this->render_template($this->viewPath . 'index', $this->data);
    }

    public function create($acc_no = NULL)
    {


        $this->data['page_title'] = 'Add Account';

        $this->form_validation->set_rules('account_number[]','Account Number','member_name', 'Member Name', 'required');
              print_r('<pre>');
                    print_r('e');
                    // exit();
        if ($this->form_validation->run() == TRUE) {

            $acc_no =  $this->input->post('account_number[]');
            // $acc_no =  $_POST['account_number[]'];
            $member_name = $this->input->post('member_name[]');
            $address = $this->input->post('address[]');
            $mobile_number = $this->input->post('mobile_no[]');
            $opening_balance = $this->input->post('opening_balance[]');
                print_r('<pre>');
                    print_r('dfg');
                    print_r($_POST);
                    print_r($acc_no);
                    exit();
            if (is_array($acc_no) && is_array($member_name) && is_array($address) && is_array($mobile_number) && is_array($opening_balance)) {
                    print_r('<pre>');
                        print_r('DS');
                        exit();
                $count = count($acc_no);    

                    for ($i = 0; $i < $count; $i++) {
                        $data = array(
                            'member_name' => $member_name[$i],
                            'address' => $address[$i],
                            'mobile_number' => $mobile_number[$i],
                            // 'email' => $this->input->post('email'),
                            'opening_balance' => $opening_balance[$i],
                            'fk_financial_year_id' => $_SESSION['year'],
                            'account_number' =>  $acc_no[$i],
                            'status' => 1
                        );

                        $create = $this->Crud_model->save($this->tableName, $data);
                    }

                    if ($create == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect($this->controllerPath, 'refresh');
                    } else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect($this->controllerPath , 'refresh');
                    }
            } else {
                // Handle the case where one or more variables are not arrays
                $this->session->set_flashdata('errors', 'Invalid data format!!');
                redirect($this->controllerPath , 'refresh');
            }
        } else {
            $this->db->order_by('account_no', "DESC");
            $table_data = $this->db->get('account_master')->result_array()[0];
            $this->data['table_data'] = $table_data;
            $this->render_template($this->viewPath , $this->data);
        }
    }

    public function edit($acc_no = null)
    {


        $this->data['page_title'] = 'Edit Account Details';


        if ($acc_no) {

            $this->form_validation->set_rules('member_name', 'Member Name', 'required');

            if ($this->form_validation->run() == TRUE) {


                $data = array(
                    'member_name' => $this->input->post('member_name'),
                    'address' => $this->input->post('address'),
                    'mobile_number' => $this->input->post('mobile_no'),
                    // 'email' => $this->input->post('email'),
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