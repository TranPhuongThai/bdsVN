<?php
class Msite_album extends CI_Model{

    private $_table = "site_album";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('a.*, m.Name as MName');
        $this->db->from($this->_table." a");
        $this->db->join("site_album_menu m", "a.Menu = m.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("a.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countAllData(){
        return $this->db->count_all($this->_table);
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

    function getMenuData($menu, $order, $record_number, $record_start){
        $this->db->select('a.*, m.Name as MName');
        $this->db->from($this->_table." a");
        $this->db->join("site_album_menu m", "a.Menu = m.ID");
        $this->db->where("a.Menu", $menu);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("a.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countMenuData($menu){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." a");
        $this->db->join("site_album_menu m", "a.Menu = m.ID");
        $this->db->where("a.Menu", $menu);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }

    function getSearchData($name, $menu, $order, $record_number, $record_start){
        $this->db->select('a.*, m.Name as MName');
        $this->db->from($this->_table." a");
        $this->db->join("site_album_menu m", "a.Menu = m.ID");
        if($name){
            $this->db->where("(a.Name = '$name' OR a.ID = '$name' OR a.Name = '$name' OR a.Name like '%$name%' OR a.Name like '%$name' OR a.Name like '$name%')");
        }
        if(is_numeric($menu) && $menu > 0){
            $this->db->where("a.Menu", "$menu");
        }
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("a.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countSearchData($name, $menu){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." a");
        $this->db->join("site_album_menu m", "a.Menu = m.ID");
        if($name){
            $this->db->where("(a.Name = '$name' OR a.ID = '$name' OR a.Name = '$name' OR a.Name like '%$name%' OR a.Name like '%$name' OR a.Name like '$name%')"); 
        }
        if(is_numeric($menu) && $menu > 0){
            $this->db->where("a.Menu", "$menu");
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }
}
?>
