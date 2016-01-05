<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Author : Ajmal Azeez
emailid: ajmalazeez007@gmail.com
created on: 30/12/15

*/


//        if($this->session->userdata('status')){
//        $this->load->view('home_dash');
//          
//        }else{
//            redirect('superman/login');
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
class Superman extends CI_Controller {

	
	public function index()
	{
                if($this->session->userdata('superman_status')){
        $this->load->view('superman_dashboard');
          
        }else{
            redirect('superman/login');
        }
        
		
	}

	public function login(){

		       if($this->session->userdata('superman_status')){
       				redirect('superman');
         
       }else{

	$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric');

   if ($this->form_validation->run() == FALSE)
               {
                
                 $this->load->view('superman_login',array('msg' => ''));
               
               }
               else
               {
                   
                    $this->load->model('model_superman');
                   if($this->model_superman->validate_login())
                       redirect('superman');
                   else
                       $this->load->view('superman_login',array('msg' => 'Wrong Credentials'));
                  
                }
           
       
       }

	}
    
    public function createclass(){
        
           if($this->session->userdata('superman_status')){
               
               $this->form_validation->set_rules('classname', 'Class Name', 'trim|required|alpha_numeric_spaces');

   if ($this->form_validation->run() == FALSE)
               {
                
                 $this->load->view('superman_class',array('msg' => ''));
               
               }
               else
               {
                   
                    $this->load->model('model_superman');
                   if($this->model_superman->create_class())
                       redirect('superman');
                   else
                        $this->load->view('superman_class',array('msg' => 'Error'));
                  
                }
               
               
       				
         
       }else{

	
           redirect('superman/login');
       
       }
        
    }
    
    public function createtco(){
        
        if($this->session->userdata('superman_status')){
           $this->load->model('model_superman');
            $data['class']=$this->model_superman->get_class();
            $data['msg']='';
               $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
               $this->form_validation->set_rules('email', 'Email id', 'trim|required|valid_email');
               $this->form_validation->set_rules('class', 'Class ', 'trim|required|integer');

   if ($this->form_validation->run() == FALSE)
               {
                 $data['msg']='';
                 $this->load->view('superman_create_user',$data);
               
               }
               else
               {
                   $this->load->helper('string');
                    $this->load->helper('security');
                    
                   if($this->model_superman->create_tco())
                       redirect('superman');
                   else
                        $this->load->view('superman_create_user',$data);
                  
                }
               
               
       				
         
       }else{

	
           redirect('superman/login');
       
       }
    }
    
    public function logout(){
        
        $this->session->sess_destroy();
        redirect('superman');
    }
}


?>