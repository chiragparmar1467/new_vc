<?php 
class template extends CI_Controller
{

public function index(){
    $data['view'] = 'home';
     
    $this->load->view('layout.php',$data);
}

}  // end controller class
?>