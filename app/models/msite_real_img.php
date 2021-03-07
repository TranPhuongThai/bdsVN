<?php
class Msite_real_img extends CI_Model{

    private $_table = "site_real_img";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('i.*, a.Name as AName');
        $this->db->from($this->_table." i");
        $this->db->join("site_real a", "i.Real = a.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("i.ID",$order);
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

    function getRealData($real, $order, $record_number, $record_start){
        $this->db->select('i.*, a.Name as AName');
        $this->db->from($this->_table." i");
        $this->db->join("site_real a", "i.Real = a.ID");
        $this->db->where("i.Real", $real);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("i.Level","ASC");
        $this->db->order_by("i.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countRealData($real){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." i");
        $this->db->join("site_real a", "i.Real = a.ID");
        $this->db->where("i.Real", $real);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }
}
?>
