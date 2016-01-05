<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Author : Ajmal Azeez
emailid: ajmalazeez007@gmail.com
created on: 30/12/15

*/
class Model_user extends CI_Model {
    
    
    public function validate_login(){
        //SELECT * FROM `user` WHERE 1 `emailid` `name``password``cid``token`
        $query = $this->db->get_where('user', array('emailid' => $this->input->post('username') , 'password' => do_hash($this->input->post('password'))));
        
        if($query->num_rows()==1){
            
            $row= $query->row();
            $ses['user_uid']=$row->uid;
            $ses['user_name']=$row->name;
            $ses['user_email']=$row->emailid;
            $ses['user_cid']=$row->cid;
            $ses['user_token']=$row->token;
            $ses['user_status']=true;
            $this->session->set_userdata($ses);
            return true;
        }
        return false;
                                      
                            
    }
    


    public function get_class(){
        $query = $this->db->get('class');

        $data=array();
        foreach ($query->result() as $row)
        {
                $data[$row->cid] =$row->name;
        }
        
        return $data;
    }
    
    public function signup(){
        //SELECT * FROM `user` WHERE 1 `emailid` `name``password``cid``token`
        $data = array(
        'emailid' => $this->input->post('emailid'),
        'name' => $this->input->post('name'),
        'password' => do_hash($this->input->post('password')) ,
        'cid' => $this->input->post('class') ,
        'token' => random_string('alnum', 16)
);

        if($this->db->insert('user', $data)){
            $ses['user_uid']=$this->db->insert_id();
            $ses['user_name']=$data['name'];
            $ses['user_email']=$data['emailid'];
            $ses['user_cid']=$data['cid'];
            $ses['user_token']=$data['token'];
            $ses['user_status']=true;
            $this->session->set_userdata($ses);
            return true;
        }
        
        return false;
        
    }
    
    public function get_available_quiz(){
        //SELECT * FROM `result` WHERE 1  `rid``tid``uid``attempted``missed``correct``wrong``score`
       // SELECT * FROM `test` WHERE 1 `tid` `name``classid``tid``startdate``enddate``duration``maxattempt``passperc``viewans``corscore``incorscore``testtype`
        $statement='SELECT * FROM   test t WHERE classid = '.$this->session->user_cid .' AND NOT EXISTS (  SELECT * FROM   result r WHERE  r.tid = t.tid AND uid = '.$this->session->user_uid  .')';
        $query = $this->db->query($statement);
        $data=array();
        $i=0;
        foreach ($query->result() as $row)
        {
            
            $data[$i]['name']=$row->name;
            $data[$i]['id']=$row->tid;
            $data[$i]['startdate']=$row->startdate;
            $data[$i]['enddate']=$row->enddate;
            
            $i++;
        }
        
        return $data;
    }
    
    public function get_questions(){
        
        //SELECT * FROM `quizquestions` WHERE 1 `qqid``tid``question``description``option1``option2``option3``option4``ans`
        
        $query = $this->db->get_where('quizquestions', array('tid' => $this->session->userdata('user_selected_test')));
        $data=array();
        $i=0;
        foreach ($query->result() as $row)
        {
            $data[$i]['id']=$row->qqid;
            $data[$i]['question']=$row->question;
            $data[$i]['description']=$row->description;
            $data[$i]['option1']=$row->option1;
            $data[$i]['option2']=$row->option2;
            $data[$i]['option4']=$row->option4;
            $data[$i]['option3']=$row->option3;
            $data[$i]['ans']=$row->ans;
            
            $i++;
        }
        
        return $data;
    }
    
    
    public function evaluate_test($questions){
        $correctscore=0;
        $incorrectscore=0;
        
        $totalscore=0;
        $attempted=0;
        $missed=0;
        $correctans=0;
        $wrongans=0;
        $query = $this->db->get_where('test', array('tid' => $this->session->userdata('user_selected_test')));
        if($query->num_rows()==1){
            $row= $query->row();
            $correctscore=$row->corscore;
            $incorrectscore=$row->incorscore;
        }
        for($i=0;$i<sizeof($questions);$i++){
            
            if(null==$this->input->post($questions[$i]['id']))
                $missed++;
            else{
     
                $attempted++;
                if($this->input->post($questions[$i]['id'])==$questions[$i]['ans'])
                    $correctans++;
                else
                    $wrongans++;

            }
        }
        
        
        
        //SELECT * FROM `result` WHERE 1  `tid``uid``attempted``missed``correct``wrong``score`
        $totalscore= $correctans*$correctscore- $wrongans*$incorrectscore;
        $data=array('tid' => $this->session->userdata('user_selected_test'),
                   'uid' => $this->session->userdata('user_uid'),
                   'attempted' => $attempted,
                    'missed' => $missed,
                    'correct' => $correctans,
                    'wrong' => $wrongans,
                    'score' => $totalscore
                   );
        $this->db->insert('result', $data);
        
    }
}

?>