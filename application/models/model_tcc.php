<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Author : Ajmal Azeez
emailid: ajmalazeez007@gmail.com
created on: 30/12/15

*/
class Model_tcc extends CI_Model {
    
    
    public function validate_login(){
        
        $query = $this->db->get_where('tcc', array('emailid' => $this->input->post('username'),'password' =>$this->input->post('password')));
        
        if($query->num_rows()==1){
            $row= $query->row();
            $data['tcc_name']= $row->name;
            $data['tcc_emailid']= $row->emailid;
            $data['tcc_token']= $row->token;
            $data['tcc_cid']= $row->cid;
            $data['tcc_status']=true;
            $this->session->set_userdata($data);
            
            return true;
        }
        
        return false;
        
    }
    
    
    public function getUsers(){
        
        // `name``emailid``password``cid``token``uid`
        $query = $this->db->get_where('user', array('cid' => $this->session->tcc_cid));
       // $query = $this->db->get('user');
        $data=array();
        $i=0;
        foreach ($query->result() as $row)
        {
                $data[$i]['name']= $row->name;
                $data[$i]['id']= $row->uid;
            $i++;
        }
        
        return $data;
    }
    
    
    
    public function create_category($userlist){
        
        //SELECT * FROM `category` WHERE 1  `catid``tccid``name` 'type'
        //SELECT * FROM `user_list` WHERE 1 `ulid``catid``uid`
        $this->db->insert('category', array('tccid' =>$this->session->tcc_cid ,'name' => $this->input->post('name'),'type' => $this->input->post('type')));
        $catid=$this->db->insert_id();
        if($catid&& $this->input->post('type')==2){
            for($i=0;$i<sizeof($userlist);$i++){
                if(!empty($this->input->post($userlist[$i]['id'])))
              $this->db->insert('user_list', array('catid' =>$catid,'uid' => $this->input->post($userlist[$i]['id'])));   
            }
           
        }
    }
    
    public function get_category(){
        $query = $this->db->get_where('category', array('tccid' => $this->session->tcc_cid));
       // SELECT * FROM `category` WHERE 1  `catid``tccid``name``type`
        $data=array();
        $i=0;
        foreach ($query->result() as $row)
        {
                $data[$i]['name']= $row->name;
                $data[$i]['id']= $row->catid;
            $i++;
        }
        
        return $data;
    }
    
    public function create_test($category){
        // setup test type and view ans facility
        ////`name``startdate``enddate``duration``maxattempt``passperc``viewans``corscore``testtype``incorscore`classid
        //SELECT * FROM `testcategory` WHERE 1  `tid``catid`
        $data = array(
        'classid' => $this->session->tcc_cid,
        'name' => $this->input->post('name'),
        'startdate' => $this->input->post('startdate'),
        'enddate' => $this->input->post('enddate'),
        'duration' => $this->input->post('duration'),
        'maxattempt' => $this->input->post('maxattempt'),
        'passperc' => $this->input->post('passpercent'),
      //  'viewans' => $this->input->post('corscore'),
        'corscore' => $this->input->post('corscore'),
        'incorscore' => $this->input->post('incorscore'),
      //  'testtype' => $this->input->post('name'),
        
        );

        $this->db->insert('test', $data);
        
        $testid=$this->db->insert_id();
        
        for($i=0;$i<sizeof($category);$i++){
            
            if(!empty($this->input->post($category[$i]['id'])))
                $this->db->insert('testcategory', array('tid' => $testid,'catid' =>$category[$i]['id']));
        }
        
    }
    
    public function get_test(){
        //SELECT * FROM `test` WHERE `classid``tid` `name``startdate` `testtype`
        $query = $this->db->get_where('test', array('classid' => $this->session->tcc_cid ));
        
        
        $data=array();
        $i=0;
        foreach ($query->result() as $row)
        {
                $data[$i]['name']= $row->name;
                $data[$i]['id']= $row->tid;
                $data[$i]['startdate']= $row->startdate;
            $i++;
        }
        
        return $data;
    }
    
    public function add_question(){
        
        //SELECT * FROM `quizquestions` WHERE 1  `qqid``tid``question``description``option1``option2``option3``option4``ans`
        
        $data['tid']=$this->session->testid;
        $data['question']=$this->input->post('question');
        if(!empty($this->input->post('description')))
            $data['description']=$this->input->post('description');
        $data['option1']=$this->input->post('option1');
        $data['option2']=$this->input->post('option2');
        $data['option3']=$this->input->post('option3');
        $data['option4']=$this->input->post('option4');
        $data['ans']=$this->input->post('ans');
        
        $this->db->insert('quizquestions', $data);
    }
}


?>