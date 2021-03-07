<?php
class Mmodcontact_site_contact_email extends CI_Model{

    private $_table = "site_contact_email";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getDataByID($id){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("ID", $id);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }
}
?>
