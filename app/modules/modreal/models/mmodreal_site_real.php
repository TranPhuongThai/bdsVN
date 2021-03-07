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
    
    function getDataByID($id){
        $this->db->select('r.*, d.Name as DName, w.Name as WName, p.Name as PName, m.Name as MName');
        $this->db->from($this->_table." r, site_real_menu m, site_add_ward w, site_add_district d, site_add_province p");
        $this->db->where("r.ID",$id);
        $this->db->where("r.Menu = m.ID and r.District = d.ID and r.Ward = w.ID and r.Province = p.ID");
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

    function getDistrictData2($district, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('r.District', $district);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countDistrictData2($district){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('r.District', $district);
        $this->db->where("r.District = d.ID");
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
        
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

    function getData($fieldSort, $order, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("r.$fieldSort",$order);
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

    function getTypeData($fieldSort, $order, $type, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('Type', $type);
        $this->db->where("r.District = d.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("r.$fieldSort",$order);
        $this->db->order_by("r.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countTypeData($type){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where('Type', $type);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getUserData($userId, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        //$this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->where('User', $userId);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID","DESC");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countUserData($userId){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where('UserId', $userId);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getMenuData($menu, $fieldSort, $order, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where("r.District = d.ID");
        $this->db->where('Menu', $menu);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("$fieldSort",$order);
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

    function getSearchData($text, $menu, $district, $ward, $area1, $area2, $cost1, $cost2, $direction, $bedroom, $sittingroom, $record_number, $record_start){
        $this->db->select('r.*, d.Name as DName');
        $this->db->from($this->_table." r, site_add_district d");
        $this->db->where("r.District = d.ID");
        $this->db->where('r.Status', 1);
        
        if($text && $text != 'none'){
            $this->db->like("r.Name", $text);
        }
        if(is_numeric($menu) && $menu)
            $this->db->where("Menu", $menu);
        if(is_numeric($district) && $district)
            $this->db->where("District", $district);
        if(is_numeric($ward) && $ward)
            $this->db->where("Ward", $ward);
            
        if($direction)
            $this->db->where("Direction", $direction);
        if($area1 > 0)
            $this->db->where("LandArea >= ", $area1);
        if($area2 > 0)
            $this->db->where("LandArea <= ", $area2);
        if($cost1 > 0)
            $this->db->where("Total >= ", $cost1);
        if($cost2 > 0)
            $this->db->where("Total <= ", $cost2);
        if(is_numeric($bedroom) && $bedroom)
            $this->db->where("BedRoom", $bedroom);
        if(is_numeric($sittingroom) && $sittingroom)
            $this->db->where("SittingRoom", $sittingroom);
            
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function countSearchData($text, $menu = 0, $district, $ward, $area1, $area2, $cost1, $cost2, $direction, $bedroom, $sittingroom){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." r");
        $this->db->where('r.Status', 1);
        
        if($text && $text != 'none'){
            $this->db->like("r.Name", $text);
        }
        if(is_numeric($menu) && $menu)
            $this->db->where("Menu", $menu);
        if(is_numeric($district) && $district)
            $this->db->where("District", $district);
        if(is_numeric($ward) && $ward)
            $this->db->where("Ward", $ward);
            
        if($direction)
            $this->db->where("Direction", $direction);
        if($area1 > 0)
            $this->db->where("LandArea >= ", $area1);
        if($area2 > 0)
            $this->db->where("LandArea <= ", $area2);
        if($cost1 > 0)
            $this->db->where("Total >= ", $cost1);
        if($cost2 > 0)
            $this->db->where("Total <= ", $cost2);
        if(is_numeric($bedroom) && $bedroom)
            $this->db->where("BedRoom", $bedroom);
        if(is_numeric($sittingroom) && $sittingroom)
            $this->db->where("SittingRoom", $sittingroom);
            
        $query = $this->db->get();
        if($query){
            $row = $query->row_array();
            return $row['Sum'];
        }else{
            return 0;
        }
    }

    function getSimilarData($id, $menu, $type, $order, $record_number, $record_start){
        $this->db->select('r.*, m.Name as MName, d.Name as DName');
        $this->db->from($this->_table." r, site_real_menu m, site_add_district d");
        $this->db->where('r.Status', 1);
        $this->db->where('r.Menu', $menu);
        $this->db->where('r.Type', $type);
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
