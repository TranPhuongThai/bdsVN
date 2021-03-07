<?php
class Mmoduser_wb_user extends CI_Model{

    private $_table = "wb_user";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    function getDataByID($id){
        $this->db->where("ID",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
    function getDataByUsername($username){
        $this->db->where("Username",$username);
        $query = $this->db->get($this->_table);
        
        if($query->num_rows()!=0){
            return $query->row_array();;
        }else{
            return FALSE;
        }
    }

    function getDataByEmail($email){
        $this->db->where("Email",$email);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    function getDataByKey($key){
        $this->db->where("Key",$key);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    function addData($data){
        if($this->db->insert($this->_table,$data))
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function updateData($data,$id){
        $this->db->where("ID",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
    
    function checkActive($id){
        $this->db->select("ID,Active");
        $this->db->where("ID",$id);
        $query = $this->db->get($this->_table);
        $info  = $query->row_array();
        if($info){
            if($info['Active']==1)
            return TRUE;
        else
            return FALSE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function checkKeyActive($id,$key){
         if($id!="" && $key!=""){
            $this->db->where("ID",$id);
            $this->db->where("Key",$key);
            $query = $this->db->get($this->_table);
            if($query->num_rows()!=0){
                return $query->row_array();
            }else{
                return FALSE;
            }
            
        }else{
            return FALSE;
        }
    }
    
    function checkLogin($username,$password){
        $this->db->where("Username",$username);
        $this->db->where("Password",$password);
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }else{
            return $query->row_array();
        }
    }
}
?>
