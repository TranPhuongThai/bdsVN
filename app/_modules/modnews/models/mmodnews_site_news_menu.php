<?php
class Mmodnews_site_news_menu extends CI_Model{

    private $_table = "site_news_menu";
    
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

    function getAllData($record_number, $record_start){
        $this->db->select('m.ID, m.Name');
        $this->db->from($this->_table." m");
        $this->db->where("m.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("m.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getPidData($pid, $record_number, $record_start){
        $this->db->select('m.ID, m.Name');
        $this->db->from($this->_table." m");
        $this->db->where("m.PID", $pid);
        $this->db->where("m.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("m.Level",'ASC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getMenuData($pid, $record_number, $record_start){
        $this->db->select('m.ID, m.Name');
        $this->db->from($this->_table." m");
        $this->db->where("m.PID", $pid);
        $this->db->where("m.ID NOT IN (1,3,4,8,9)");
        $this->db->where("m.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("m.Level",'ASC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}