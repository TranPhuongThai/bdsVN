<?php
class Mmodads_site_ads extends CI_Model{
    private $_table = "site_ads";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getStatusData($status, $order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("Status", $status);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("Level",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function getDataByID($id){
        $this->db->select('n.*');
        $this->db->from($this->_table." n");
        $this->db->where("n.ID", $id);
        $this->db->where("n.Status", 1);
        $query = $this->db->get();
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

}
?>
