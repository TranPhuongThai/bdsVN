<?php
class Mmodreal_site_real extends CI_Model{

    private $_table = "site_real";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function addHit($id){
        $num = rand(1,4);
        $this->db->query("update ".$this->_table." set Hit = Hit+$num where ID = '$id'");
        return TRUE;
    }
    
    function getDataByID($id){
        $this->db->select('r.*, d.Name as DName, p.Name as PName, m.Name as MName');
        $this->db->from($this->_table." r, site_real_menu m, site_add_district d, site_add_province p");
        $this->db->where("r.ID",$id);
        $this->db->where("r.Menu = m.ID and r.District = d.ID and r.Province = p.ID");
        $query = $this->db->get();
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    function getTopHitData($record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("r.Hit",'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getHotData($record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('r.Hot', 1);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getNewData($order, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("r.DateUp",$order);
        $this->db->order_by("r.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countNewData(){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getMenuData($menu, $order, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->where('Menu', $menu);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countMenuData($menu){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where('Menu', $menu);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getSearchData($district,$menu,$direction,$area1,$area2,$cost1,$cost2,$order,$record_number,$record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        
        if(is_numeric($district) && $district)
            $this->db->where("District", $district);
        if(is_numeric($menu) && $menu)
            $this->db->where("Menu", $menu);
        if(isset($direction) && $direction != "all" && $direction)
            $this->db->where("Direction", $direction);
        if($area1 > 0)
            $this->db->where("LandArea >= ", $area1);
        if($area2 > 0)
            $this->db->where("LandArea <= ", $area2);
        if($cost1 > 0)
            $this->db->where("Total >= ", $cost1);
        if($cost2 > 0)
            $this->db->where("Total <= ", $cost2);
            
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countSearchData($district,$menu,$direction,$area1,$area2,$cost1,$cost2){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        
        if(is_numeric($district) && $district)
            $this->db->where("District", $district);
        if(is_numeric($menu) && $menu)
            $this->db->where("Menu", $menu);
        if(isset($direction) && $direction != "all" && $direction)
            $this->db->where("Direction", $direction);
        if($area1 > 0)
            $this->db->where("LandArea >= ", $area1);
        if($area2 > 0)
            $this->db->where("LandArea <= ", $area2);
        if($cost1 > 0)
            $this->db->where("Total >= ", $cost1);
        if($cost2 > 0)
            $this->db->where("Total <= ", $cost2);
            
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getSimilarData($id, $order, $record_number, $record_start){
        $this->db->select('r.*, m.Name as MName, d.Name as DName');
        $this->db->from($this->_table." r, site_real_menu m, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('r.Menu = m.ID');
        $this->db->where("r.ID != ", $id);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("r.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getDistrictData($order, $record_number, $record_start){
        $this->db->select('District, d.Name');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where("r.District = d.ID");
        $this->db->group_by("District"); 
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
