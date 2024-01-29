<?php


class Change_pass extends Admin_Controller
{
    public $tableName = 'users';

	public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/Change_pass/';
        $this->viewPath = 'admin/change_pass/';
        $this->data['name'] = 'Change Password`';

      
        $this->data['company_data'] = $this->db->get('company')->row_array();
    
    }

	public function index(){

         $this->data['page_title'] = 'Change Password';

        
        
        $table_data = $this->Crud_model->get($this->tableName, 'id');
      
        $this->data['table_data'] = $table_data;
     
        // $this->render_template($this->viewPath . 'index', $this->data);
		$this->render_template('admin/change_pass/index_change_pass',$this->data);

    
    }
	public function change_pass($id = null){
      
        $this->data['page_title'] = "Change";
        $this->data['id'] = $id;
		$this->render_template('admin/change_pass/change_pass',$this->data);

	}

    public function reset($id = null){
      
        $old = $this->input->post('oldPassword');
        $new = $this->input->post('newPassword');
        $new_conf = $this->input->post('cNewPassword');
        $new_password['password'] = MD5($new_conf);
        
         $query = $this->db->get_where('users', array('id' =>$id))->result_array();
            //  print_r('<pre>');
            //      print_r($query);
            //      exit();
         if($new != $new_conf){

             $this->session->set_flashdata('errors', 'New Password & Confirm password Is not mached');
             redirect($this->controllerPath .'change_pass/'.$id, 'refresh');
             
            }
         
            if(count($query) == 1) {

                 
             $hash_password = password_verify($old, $query[0]['password']);
              $md5_password = MD5($old);
                
             	if($hash_password === true) {
  
                    // $this->db->insert('users' ,$new_conf);
                     $this->session->set_flashdata('success', 'Password Is changed');
                    $this->db->update('users', $new_password, array('id'=> $id));
                     redirect($this->controllerPath , 'refresh');
                }
                    
                else if($md5_password == $query[0]['password']){

                     $this->session->set_flashdata('success', 'Password Is changed');
				  $this->db->update('users', $new_password, array('id'=> $id));
                    redirect($this->controllerPath , 'refresh');

                }
                
                else{
                      $this->session->set_flashdata('errors', 'Old Password Is Incorrect');
                        redirect($this->controllerPath .'change_pass/'.$id, 'refresh');
                }
            }
    }
}