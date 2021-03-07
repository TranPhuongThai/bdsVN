<?php
class Mmodreal_site_real_menu extends CI_Model{

    private $_table = "site_real_menu";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("Status",1);
        $this->db->order_by("Level",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function getDataByID($id){
        $this->db->where("ID",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
}
?>
