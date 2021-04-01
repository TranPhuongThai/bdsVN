<?php
class Mpagereal_site_real extends CI_Model{

    private $_table = "site_real";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function addHit($id){
        $this->db->query("update ".$this->_table." set Hit = Hit+1 where ID = '$id'");
        return TRUE;
    }
    
    function getDataByID($id){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_real_menu m', 'n.Menu = m.ID');
        $this->db->where("n.ID", $id);
        $this->db->where("n.Status", 1);
        $query = $this->db->get();
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
    function countMenuData($menu){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." n");
        $this->db->join('site_real_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Menu", $menu);
        $this->db->where("n.Status", 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getMenuData($menu, $order, $record_number, $record_start){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_real_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Menu", $menu);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getSimilarData($menu, $id, $order, $record_number, $record_start){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_real_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Menu", $menu);
        $this->db->where("n.ID !=", $id);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    


    function getDistrictList() {
        $this->db->select('n.*');
        $this->db->from("site_add_district n");
        $this->db->order_by("Name",'ASC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getCommentByNewId($id) {
        $this->db->select('n.*, u.Name');
        $this->db->from("site_real_comment n");
        $this->db->join('site_real m', 'n.Real = m.ID');
        $this->db->join('wb_user u', 'n.User = u.ID');
        $this->db->where("m.ID", $id);
        $this->db->limit(5, 0);
        $this->db->order_by("n.Date",'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } 
}
