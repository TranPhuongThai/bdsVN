<?php
class Mwb_user extends CI_Model{

    private $_table = "wb_user";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('u.ID, u.Username, u.Name, u.Type, u.Active, u.Status, t.Name as TypeName');
        $this->db->from($this->_table." u");
        $this->db->join("wb_tuser t","u.Type = t.ID");
        $this->db->where("u.ID > ",1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("u.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countAllData(){
        return $this->db->count_all($this->_table);
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

    function getInfoByEmail($email){
        $this->db->where("Email",$email);
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

    function deleteData($id){
        if($id!=1){
            $this->db->where("ID",$id);
            $this->db->delete($this->_table);
        }
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
        $u = $username;
        $p = $password;
        $this->db->where("Username",$u);
        $this->db->where("Password",$p);
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }else{
            return $query->row_array();
        }
    }

    function getSearchData($text, $order, $record_number, $record_start){
        $this->db->select('u.ID, u.Username, u.Name, u.Type, u.Active, u.Status, t.Name as TypeName');
        $this->db->from($this->_table." u");
        $this->db->join("wb_tuser t","u.Type = t.ID");
        $this->db->where("u.ID > ",2);
        $this->db->where("(u.Username like '%$text%' or u.Name like '%$text%')");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("u.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countSearchData($text){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." u");
        $this->db->join("wb_tuser t","u.Type = t.ID");
        $this->db->where("u.ID > ",2);
        $this->db->where("(u.Username like '%$text%' or u.Name like '%$text%')");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }
}
?>
