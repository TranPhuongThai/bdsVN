<?php
class Msite_product_menu_img extends CI_Model{

    private $_table = "site_product_menu_img";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getMenuData($menu){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("Menu =",$menu);
        $this->db->order_by("Level","ASC");
        $this->db->order_by("ID","DESC");
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

    function addData($data){
        if($this->db->insert($this->_table,$data))
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function deleteData($id){
        $this->db->where("ID",$id);
        $this->db->delete($this->_table);
    }

    function updateData($data,$id){
        $this->db->where("ID",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
}
?>
