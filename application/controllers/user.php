<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*Author : Ajmal Azeez
*emailid: ajmalazeez007@gmail.com
*created on: 01/01/16

*/

/* My first class of 2016!! :P */


//        if($this->session->userdata('user_status')){
//        $this->load->view('user_dashboard');
//          
//        }else{
//            redirect('user/login');
//        }
    
//    if ($this->form_validation->run() == FALSE)
//                {
//                 
//                
//                }
//                else
//                {
//                     
//                }
    //$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_dash_space');
class User extends CI_Controller {

	
	public function index()
	{
                if($this->session->userdata('user_status')){
        $this->load->view('user_dashboard');
          
        }else{
            redirect('user/login');
        }
        
    }
    
    public function login(){
        if($this->session->userdata('user_status')){
            redirect('user/dashboard');
          
        }else{
            $this->form_validation->set_rules('username', 'Email Id', 'trim|required|valid_email');
             $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric_spaces');
                if ($this->form_validation->run() == FALSE)
                {
                $this->load->view('user_login',array('msg' => ''));
                }
                else
                {
                    $this->load->helper('security');
                    $this->load->model('model_user');
                     if($this->model_user->validate_login())
                         redirect('user/dashboard');
                    else
                        $this->load->view('user_login',array('msg' => 'Wrong Credentials'));
                }
              
            
            
        }
        
    }
    
    public function dashboard(){
        
       // echo 'Dash board';
        
                if($this->session->userdata('user_status')){
                    $this->load->model('model_user');
                    $data['test']=$this->model_user->get_available_quiz();
                    $selected=0;
                    for($i=0;$i<sizeof($data['test']);$i++){
                        $this->form_validation->set_rules($data['test'][$i]['id'], $data['test'][$i]['name'], 'trim|integer');
                        if(null !== $this->input->post($data['test'][$i]['id']))
                            $selected=$data['test'][$i]['id'];
                        
                    }
                    
                        if ($this->form_validation->run() == FALSE)
                        {
                             
                            $this->load->view('user_dashboard',$data);

                        }
                        else
                        {
                            
                            $this->session->set_userdata('user_selected_test', $selected);
                            
                            redirect('user/attend_test');

                        }
                    
                   

                }else{
                    redirect('user/login');
                }
        
        
        
        //print_r($this->session);
    }
    public function signup(){
        
         if($this->session->userdata('user_status')){
            redirect('user/dashboard');
          
        }else{
              $this->load->model('model_user');
             
             $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
             $this->form_validation->set_rules('emailid', 'Email Id', 'trim|required|valid_email|is_unique[user.emailid]');
             $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric_spaces|matches[cpassword]');
             $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|alpha_numeric_spaces');
             $this->form_validation->set_rules('class', 'Class', 'trim|required|integer');
                 if ($this->form_validation->run() == FALSE)
                {
                
                    $data['class']=$this->model_user->get_class();
                     $data['msg']="";
                    $this->load->view('user_signup',$data);
                
                }
                else
                {
                    $this->load->helper('string');
                    $this->load->helper('security');
                    
                        if($this->model_user->signup()){
                            redirect('user/dashboard');
                        }else{
                            $data['msg']="Unknown error occured";
                            $this->load->view('user_signup',$data);
                        }
                     
                    
                }
            
             
        }
    }
    
    
    public function logout(){
        
        $this->session->sess_destroy();
        redirect('user/login');
    }
    
    public function attend_test(){
        
                if($this->session->userdata('user_status')){
        
                    $this->load->model('model_user');
                    $data['questions']=$this->model_user->get_questions();
                    
                    for($i=0;$i<sizeof($data['questions']);$i++){
                        $this->form_validation->set_rules('qno', 'Question', 'trim|integer|required');
                        $this->form_validation->set_rules($data['questions'][$i]['id'], 'Question', 'trim|integer');
                        
                    }
                   
                        if ($this->form_validation->run() == FALSE)
                        {
                            $this->load->view('user_attend_test',$data);
                        }
                        else
                        {

                            $this->model_user->evaluate_test($data['questions']);
                            
                            redirect('user/dashboard');
                        }
                    
                    
                    

          
        }else{
            redirect('user/login');
        }
        
    }
    
}


?>