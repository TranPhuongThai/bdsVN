<?php
class Mmodnews_site_news extends CI_Model{

    private $_table = "site_news";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    function _getChildMenu($menu){
        $this->db->select('m.ID');
        $this->db->from("site_news_menu m");
        $this->db->where("m.PID", $menu);
        $this->db->where("m.Status ", 1);
        $query = $this->db->get();
        $data = $query->result_array();
        $result = array();
        foreach($data as $row){
            $result[] = $row['ID'];
        }
        return $result;
    }
    
    function _getAllChildMenu($menu){
        $arrMenu = $this->_getChildMenu($menu);
        if($arrMenu){
            foreach($arrMenu as $row){
                $arrMenu2 = $this->_getChildMenu($row);
                $arrMenu = array_merge($arrMenu, $arrMenu2);
            }
        }
        return $arrMenu;
    }
    
    function countAllData(){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Status", 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function addHit($id){
        $this->db->query("update ".$this->_table." set Hit = Hit+1 where ID = '$id'");
        return TRUE;
    }
    
    function getDataByID($id){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.ID", $id);
        $this->db->where("n.Status", 1);
        $query = $this->db->get();
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    function getHotData($order, $record_number, $record_start){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Hot", 1);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getTopHitData($order, $record_number, $record_start){
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("Hit",'DESC');
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getHotDataMenu($menu, $order, $record_number, $record_start){
        $arrMenu = $this->_getAllChildMenu($menu);
        $arrMenu[] = $menu;
        
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where("n.Hot", 1);
        $this->db->where("n.Status", 1);
        $this->db->where_in("n.Menu", $arrMenu);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countMenuData($menu){
        $arrMenu = $this->_getAllChildMenu($menu);
        $arrMenu[] = $menu;
        
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where_in("n.Menu", $arrMenu);
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
        $arrMenu = $this->_getAllChildMenu($menu);
        $arrMenu[] = $menu;
        
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where_in("n.Menu", $arrMenu);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getMenuDataHot($menu, $order, $record_number, $record_start){
        $arrMenu = $this->_getAllChildMenu($menu);
        $arrMenu[] = $menu;
        
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where_in("n.Menu", $arrMenu);
        $this->db->where("n.Hot", 1);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getSimilarData($menu, $id, $order, $record_number, $record_start){
        $arrMenu = $this->_getAllChildMenu($menu);
        $arrMenu[] = $menu;
        
        $this->db->select('n.*, m.ID as MID, m.Name as MName');
        $this->db->from($this->_table." n");
        $this->db->join('site_news_menu m', 'n.Menu = m.ID');
        $this->db->where_in("n.Menu", $arrMenu);
        $this->db->where("n.ID !=", $id);
        $this->db->where("n.Status", 1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
