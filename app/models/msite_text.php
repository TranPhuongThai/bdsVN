<?php
class Msite_text extends CI_Model{

    private $_table = "site_text";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($record_number, $record_start);
        $this->db->where("ID >", 1);
        $this->db->order_by("ID",$order);
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

    function addData($data){
        if($this->db->insert($this->_table,$data))
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function deleteData($id){
        $this->db->where("ID",$id);
        $this->db->delete($this->_table);
    }

    function updateData($data,$id){
        $this->db->where("ID",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
}
?>
