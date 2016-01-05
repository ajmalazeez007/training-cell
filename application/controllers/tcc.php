<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Author : Ajmal Azeez
emailid: ajmalazeez007@gmail.com
created on: 31/12/15

*/


//        if($this->session->userdata('tcc_status')){
//        $this->load->view('home_dash');
//          
//        }else{
//            redirect('tcc/login');
//        }
    
//    if ($this->form_validation->run() == FALSE)
//                {
//                 
//                
//                }
//                else
//                {
//                     
//                    }
    //$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_dash_space');
class Tcc extends CI_Controller {

	
	public function index()
	{
                if($this->session->userdata('tcc_status')){
        $this->load->view('tcc_dashboard');
          
        }else{
            redirect('tcc/login');
        }
        
		
	}
    
    
    public function login(){

		       if($this->session->userdata('tcc_status')){
       				redirect('tcc');
         
       }else{

	$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric');

                   $this->load->model('model_tcc');
   if ($this->form_validation->run() == FALSE)
               {
                
                 $this->load->view('tcc_login',array('msg' => ''));
               
               }
               else
               {
                   
                   if($this->model_tcc->validate_login())
                       redirect('tcc');
                   else
                       $this->load->view('tcc_login',array('msg' => 'Wrong Credentials'));
                  
                }
           
       
       }

	}
    
    public function create_category(){
        
                if($this->session->userdata('tcc_status')){
                     $this->load->model('model_tcc');
                    $data['users']=$this->model_tcc->getUsers();
                    
                    for($i=0;$i<sizeof($data['users']);$i++){
                         $this->form_validation->set_rules($data['users'][$i]['id'], $data['users'][$i]['name'], 'trim|integer|greater_than[0]|less_than[2]');
                    }
                    
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('type', 'Type', 'trim|required|integer');
                    
                    
                   
                    
                   if ($this->form_validation->run() == FALSE)
                        {
                           $data['msg']='';
                           $this->load->view('tcc_add_category',$data);

                        }
                        else
                        {
                            $this->model_tcc->create_category($data['users']);
                            redirect('tcc');
                        }


                }else{
                    redirect('tcc/login');
                }
        
    }
    
    public function create_test(){
        
        if($this->session->userdata('tcc_status')){
                     $this->load->model('model_tcc');
            
                    $data['category']=$this->model_tcc->get_category();
                    
                    for($i=0;$i<sizeof($data['category']);$i++){
                         $this->form_validation->set_rules($data['category'][$i]['id'], $data['category'][$i]['name'], 'trim|integer|greater_than[0]|less_than[2]');
                    }
                    
                   $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
                   $this->form_validation->set_rules('startdate', 'Start date', 'trim|required|integer');
                   $this->form_validation->set_rules('enddate', 'End date', 'trim|required|integer');
                   $this->form_validation->set_rules('duration', 'Duration', 'trim|required|integer');
                   $this->form_validation->set_rules('maxattempt', 'Maximum attempt', 'trim|required|integer');
                   $this->form_validation->set_rules('passpercent', 'Pass Percentage', 'trim|required|numeric');
                   $this->form_validation->set_rules('corscore', 'Correct Score', 'trim|required|integer');
                   $this->form_validation->set_rules('incorscore', 'InCorrect Score', 'trim|required|integer');
                    
                    
                   
                    
                   if ($this->form_validation->run() == FALSE)
                        {
                           $data['msg']='';
                           $this->load->view('tcc_create_test',$data);

                        }
                        else
                        {
                            $this->model_tcc->create_test($data['category']);
                            redirect('tcc');
                        }


                }else{
                    redirect('tcc/login');
                }
    }
    
    public function select_test(){
        
        if($this->session->userdata('tcc_status')){

        $this->load->model('model_tcc');
            $data['test']=$this->model_tcc->get_test();
        $this->form_validation->set_rules('test', '', 'trim|required|integer');
                   
                        if ($this->form_validation->run() == FALSE)
                        {
                            
                            $this->load->view('tcc_select_test',$data);
                        }
                        else
                        {
                            $this->session->set_userdata('testid',$this->input->post('test'));
                            
                            redirect('tcc/add_questions');
                            
                        }
                    
                    
                    
                }else{
                    redirect('tcc/login');
                }
    }
    
    public function add_questions(){
                if($this->session->userdata('tcc_status')){
                    

                    $this->form_validation->set_rules('test', '', 'trim|required|integer');
                    $this->form_validation->set_rules('question', 'Question', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('description', 'Description', 'trim|alpha_numeric_spaces');
                    $this->form_validation->set_rules('option1', 'Option 1', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('option2', 'Option 2', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('option3', 'Option 3', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('option4', 'Option 4', 'trim|required|alpha_numeric_spaces');
                    $this->form_validation->set_rules('ans', 'Answer ', 'trim|required|integer|less_than[5]|greater_than[0]');
                        if ($this->form_validation->run() == FALSE)
                        {

                            $this->load->view('tcc_add_questions');
                        }
                        else
                            
                        {
                            
                            $this->load->model('model_tcc');;
                            $this->model_tcc->add_question();
                             $this->load->view('tcc_add_questions');
                        }
                    
                    
                    
                }else{
                    redirect('tcc/login');
                }
        
    }
    
    public function logout(){
        
        $this->session->sess_destroy();
        redirect('tcc/login');
    }
    
    
    
}

?>