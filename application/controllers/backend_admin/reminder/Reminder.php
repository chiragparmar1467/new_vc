<?php


class Reminder extends Admin_Controller
{
	public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        // $this->data['page_title'] = 'Sliders';
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/reminder/Reminder/';
        $this->viewPath = 'admin/reminder/';
      
        $this->data['company_data'] = $this->db->get('company')->row_array();
    
    }

	public function daily_reminder_details(){
		$this->data['page_title'] = 'Reminder';
		$date = date('Y-m-d');
	
        $this->data['daily_coll'] = $this->db->query('SELECT acc.id,acc.account_no,acc.daily_collection_amount,acc.fk_party_id,acc.acc_opening_date,acc.acc_closing_date,acc.interest_amount,acc.status,acc.deleted from account_master as acc where acc.deleted = 0 AND acc.acc_closing_date < "'.$date.'" ;')->result_array();

		$this->render_template($this->viewPath .'daily_collection/reminder_daily_coll', $this->data);

}

public function monthly_reminder_details(){
	$this->data['page_title'] = 'Reminder';
	$date = date('Y-m-d');

	$this->data['monthly_coll'] = $this->db->query('SELECT acc.id,acc.account_no,acc.daily_collection_amount,acc.fk_party_id,acc.acc_opening_date,acc.acc_closing_date,acc.status,acc.deleted from monthly_account_master as acc where acc.deleted = 0 AND acc.acc_closing_date < "'.$date.'" ;')->result_array();
    $this->render_template($this->viewPath .'monthly_collection/reminder_monthly_coll', $this->data);

}

public function loan_reminder_details(){
	$this->data['page_title'] = 'Reminder';
	$date = date('Y-m-d');
	
	$this->data['loan_coll'] = $this->db->query('SELECT acc.id,acc.account_no,acc.loan_amount,acc.interest_amount,acc.daily_collection_amount,acc.fk_party_id,acc.acc_opening_date,acc.status,acc.deleted from loan_account_master as acc where acc.deleted = 0 AND acc.collected = 1 ;')->result_array();

    $this->render_template($this->viewPath .'loan_collection/reminder_loan_coll', $this->data);


}



public function daily_edit($acc_no = null)
{
  
	$this->data['page_title'] = 'Edit Account Details';

	if ($acc_no) {
		
		
		if (isset($_POST['submit'])) {
			
			$data = array(
				'interest_amount' => $this->input->post('interest_amount'),
				'status' => $this->input->post('status'),
				'deleted' => 1,
			);
		
			$table_name = 'account_master';
			
	
		
			$affectedRows = $this->Crud_model->update($table_name, array('account_no' => $acc_no), $data);

			if ($affectedRows == true) {
				$this->session->set_flashdata('success', 'Successfully updated');
				redirect($this->controllerPath.'daily_reminder_details', 'refresh');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect($this->controllerPath . 'daily_reminder_details' . $id, 'refresh');
			}
		} else {

			
		
			$slider_data = $this->db->query('SELECT party.account_name,party.address, party.opening_balance,acc.account_no,acc.acc_opening_date,acc.acc_closing_date ,acc.fk_party_id, col.collection_date , col.amount FROM party_master AS party INNER JOIN collection_master AS col ON party.id = col.fk_party_id INNER JOIN 
			account_master AS acc ON col.fk_account_id = acc.account_no where acc.account_no ='.$acc_no)->result_array();
	
		//  print_r('<pre>');   
        //     print_r($this->db->last_query()); 
        //     print_r($slider_data); 
        //     exit(); 
			$this->data['edit_data'] = $slider_data;
			
			$this->render_template($this->viewPath .'daily_collection/edit', $this->data);
		}
        
       
	}

    }

    

public function monthly_edit($acc_no = null)
{
  
	$this->data['page_title'] = 'Edit Account Details';

	if ($acc_no) {
		
		
		if (isset($_POST['submit'])) {
			
			
			$data = array(
			
				'status' => $this->input->post('status'),
				'deleted' => 1,
			);
		
			$table_name = 'monthly_account_master';
			
	
		
			$affectedRows = $this->Crud_model->update($table_name, array('account_no' => $acc_no), $data);

			if ($affectedRows == true) {
				$this->session->set_flashdata('success', 'Successfully updated');
				redirect($this->controllerPath . 'monthly_reminder_details', 'refresh');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect($this->controllerPath . 'monthly_reminder_details' . $id, 'refresh');
			}
		} else {

			
		
            $slider_data = $this->db->query('SELECT party.account_name,party.address, party.opening_balance,acc.account_no,acc.acc_opening_date,acc.acc_closing_date ,acc.fk_party_id, col.collection_date , col.amount FROM monthly_party_master AS party INNER JOIN monthly_collection_master AS col ON party.id = col.fk_party_id INNER JOIN 
			monthly_account_master AS acc ON col.fk_account_id = acc.account_no where acc.account_no ='.$acc_no)->result_array();
		
		
			$this->data['edit_data'] = $slider_data;
			
			$this->render_template($this->viewPath .'monthly_collection/edit', $this->data);
		}
		
	}

    }

    public function loan_edit($acc_no = null )
    {
      
        $this->data['page_title'] = 'Edit Account Details';
        
        
        
        if ($acc_no) {
            
            
            if (isset($_POST['submit'])) {
                
                
                        $data = array(
                            'status' => $this->input->post('status'),
                            'deleted' => 1,
                        );
                $table_name = 'loan_account_master';
          
                $affectedRows = $this->Crud_model->update($table_name, array('account_no' => $acc_no), $data);
    
                if ($affectedRows == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect($this->controllerPath . 'loan_reminder_details', 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect($this->controllerPath . 'loan_reminder_details' . $id, 'refresh');
                }
            } else {
    
                
            
                $slider_data = $this->db->query('SELECT party.account_name,party.address, party.opening_balance,acc.loan_amount,acc.account_no,acc.acc_opening_date,acc.interest_amount,acc.fk_party_id, col.collection_date , col.amount FROM loan_party_master AS party INNER JOIN loan_collection_master AS col ON party.id = col.fk_party_id INNER JOIN 
                loan_account_master AS acc ON col.fk_account_id = acc.account_no where acc.account_no ='.$acc_no)->result_array();
           
                $this->data['edit_data'] = $slider_data;
                
                $this->render_template($this->viewPath .'loan_collection/edit', $this->data);

            }
            
        }
        
    }
    



}
?>