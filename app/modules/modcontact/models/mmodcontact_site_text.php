<?php
class Mmodcontact_site_text extends CI_Model{

    private $_table = "site_text";
    
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
}
?>
