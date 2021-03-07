<?php
class Mmodmenu_site_menu extends CI_Model{
    private $_table = "site_menu";
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

    function getPidStatusData($pid, $status, $order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("PID", $pid);
        $this->db->where("Status", $status);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("Level",$order);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
