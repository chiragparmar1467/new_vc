<?php

class Daily_accounts extends Admin_Controller
{
   
    public $controllerPath = '';
    public $viewPath = '';
    public $uploadFolder = '';
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Crud_model');
        $this->controllerPath = 'backend_admin/closed_accounts/Daily_accounts/';
        $this->viewPath = 'admin/closed_accounts/daily_accounts/';
        $this->uploadFolder = '';
        $this->data['company_data'] = $this->db->get('company')->row_array();
        $this->data['name'] = 'Closed accounts';
       
    }

    public function index()
    {
        $this->data['daily_coll'] = $this->db->query('SELECT acc.id,acc.account_no,acc.daily_collection_amount,acc.fk_party_id,acc.acc_opening_date,acc.acc_closing_date,acc.interest_amount,acc.status,acc.deleted from account_master as acc where deleted = 1 order by id DESC;')->result_array();
      
		$this->render_template($this->viewPath . 'daily_accounts', $this->data);
    }

    public function close_acc_view($acc_no = null){
  
        $this->data['page_title'] = 'Edit Account Details';
     
        if ($acc_no) {
        
                $slider_data = $this->db->query('SELECT party.account_name,party.address, party.opening_balance,acc.account_no,DATE_FORMAT(acc.acc_opening_date, "%d-%m-%Y") as acc_opening_date,DATE_FORMAT(acc.acc_closing_date, "%d-%m-%Y") as acc_closing_date,acc.interest_amount,acc.fk_party_id, col.collection_date , col.amount FROM party_master AS party INNER JOIN collection_master AS col ON party.id = col.fk_party_id INNER JOIN 
                account_master AS acc ON col.fk_account_id = acc.account_no where acc.account_no ='.$acc_no)->result_array();
             
                $this->data['edit_data'] = $slider_data;
                
                $this->render_template($this->viewPath . 'edit', $this->data);
            }
            
        }

    public function pdf($acc_no = null){
      
        $this->data['page_title'] = 'Pdf';

        $data['customer_details'] = $this->db->query('SELECT party.account_name,party.address, party.opening_balance,acc.account_no,DATE_FORMAT(acc.acc_opening_date, "%d-%m-%Y") as acc_opening_date,DATE_FORMAT(acc.acc_closing_date, "%d-%m-%Y") as acc_closing_date,acc.interest_amount,acc.fk_party_id, col.collection_date , col.amount FROM party_master AS party INNER JOIN collection_master AS col ON party.id = col.fk_party_id INNER JOIN 
        account_master AS acc ON col.fk_account_id = acc.account_no where acc.account_no ='.$acc_no)->result_array();
 
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLHeader(
            '<table class="table" width="100%">
            <tr>
			<td style="text-align: Center; font-size:15px; font-weight: bold;">Jai Mataji</td>
            </tr>
			<tr>
			<td style="text-align: Center; font-size:18px; font-weight: bold;">Daily Collection Customer datails</td>
			</tr>
            <hr>
            </table>'
        );
        $mpdf->SetHTMLFooter(
            '<table class="table" width="100%">
			<tr>
			<td width="33%"></td>
			<td width="33%" style="text-align: right; font-size:16px;">{PAGENO}</td>
			</tr>
			</table>'
        );
    
        $html = $this->load->view($this->viewPath.'/pdf', $data,true);
            
    
            $mpdf->WriteHTML($html);
            $mpdf->Output();

    }
}
?>