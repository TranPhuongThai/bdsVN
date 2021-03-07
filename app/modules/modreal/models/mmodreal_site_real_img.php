<?php
class Mmodreal_site_real_img extends CI_Model{

    private $_table = "site_real_img";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getRealData($real, $record_number, $record_start){
        $this->db->select('i.*');
        $this->db->from($this->_table." i");
        $this->db->where('i.Status', 1);
        $this->db->where('i.Real', $real);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("i.Level","ASC");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
