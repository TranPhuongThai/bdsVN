<?php
class Mmodslide_site_slide extends CI_Model{

    private $_table = "site_slide";
    
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
}
?>
