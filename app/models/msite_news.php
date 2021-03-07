<?php
class Msite_news extends CI_Model{

    private $_table = "site_news";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('n.*, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
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

    function countSearchData($name, $menu){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        if(is_numeric($menu) && $menu > 0){
            $this->db->where("n.Menu", $menu);
        }
        if($name){
            $this->db->where("(n.Name = '$name' OR n.ID = '$name' OR n.Name = '$name' OR n.Name like '%$name%' OR n.Name like '%$name' OR n.Name like '$name%')"); 
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }

    function getSearchData($name, $menu, $order, $record_number, $record_start){
        $this->db->select('n.*, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        if(is_numeric($menu) && $menu > 0){
            $this->db->where("n.Menu", $menu);
        }
        if($name){
            $this->db->where("(n.Name = '$name' OR n.ID = '$name' OR n.Name = '$name' OR n.Name like '%$name%' OR n.Name like '%$name' OR n.Name like '$name%')");
        }
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("n.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
