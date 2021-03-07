<?php
class Mpagenews_site_news_menu extends CI_Model{

    private $_table = "site_news_menu";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    function getDataByID($id){
        $this->db->select('m.*');
        $this->db->from($this->_table." m");
        $this->db->where("m.ID", $id);
        $this->db->where("m.Status", 1);
        $query = $this->db->get();
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    function getDataByPID($PID, $order, $record_number, $record_start){
        $this->db->select('m.*');
        $this->db->from($this->_table." m");
        $this->db->where("m.PID", $PID);
        $this->db->where("m.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("m.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
