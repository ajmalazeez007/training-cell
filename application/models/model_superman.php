<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Author : Ajmal Azeez
emailid: ajmalazeez007@gmail.com
created on: 30/12/15

*/
class Model_superman extends CI_Model {
    
    public function validate_login(){
        //`smid``emailid``password``name``token`
        
        $query = $this->db->get_where('superman', array('emailid' => $this->input->post('username'),'password' =>$this->input->post('password')));

        if($query->num_rows()==1){
            $row= $query->row();
            $data['name']= $row->name;
            $data['emailid']= $row->emailid;
            $data['token']= $row->token;
            $data['superman_status']=true;
            $this->session->set_userdata($data);
            
            return true;
        }
        
        return false;
        
    }
    
    public function create_class(){
        

        if($this->db->insert('class', array('name' => $this->input->post('classname'))))
           return true;
        return false;
           
    }
    
    public function create_tco(){
        
        //SELECT * FROM `tcc` WHERE 1 `toid``name``emailid``password``cid``token`
        $data = array(
        'emailid' => $this->input->post('email'),
        'name' => $this->input->post('name'),
       // 'password' => do_hash($this->input->post('password')) ,
        'password' => 'passwprd',
        'cid' => $this->input->post('class') ,
        'token' => random_string('alnum', 16)
);
        
        if($this->db->insert('tcc',$data))
           return true;
        return false;
    }
    
    public function get_class(){
        //`cid``name`
        $data=array();
        $query = $this->db->get('class');
       
        foreach ($query->result() as $row)
        {
                $data[$row->cid]= $row->name;
        }
        
        return $data;
    }
}

?>