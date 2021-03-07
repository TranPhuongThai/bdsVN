<?php
class Mmodreal_site_add_ward extends CI_Model{

    private $_table = "site_add_ward";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getDistrictData($district, $order, $record_number, $record_start){
        $this->db->select('d.*');
        $this->db->from($this->_table." d");
        $this->db->where("d.District = ",$district);
        $this->db->order_by("Level",$order);
        $this->db->limit($record_start,$record_number); 
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
