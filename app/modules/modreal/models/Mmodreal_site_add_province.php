<?php
class Mmodreal_site_add_province extends CI_Model{

    private $_table = "site_add_province";
    
    public function __construct(){
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

    function getNationData($nation, $order, $record_number, $record_start){
        $this->db->select('d.*');
        $this->db->from($this->_table." d");
        $this->db->where("d.Nation = ",$nation);
        $this->db->order_by("Level",$order);
        $this->db->limit($record_start,$record_number); 
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
