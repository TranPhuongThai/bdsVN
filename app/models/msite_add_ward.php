<?php
class Msite_add_ward extends CI_Model{

    private $_table = "site_add_ward";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.District, d.Level, d.Status, p.Name as DistrictName, p.Level as DistrictLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_district p","d.District = p.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("DistrictLevel",$order);
        $this->db->order_by("d.District",$order);
        $this->db->order_by("d.Level",$order);
        $this->db->order_by("d.Name",$order);
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

    function getDistrictData($district, $order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.District, d.Level, d.Status, p.Name as DistrictName, p.Level as DistrictLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_district p","d.District = p.ID");
        $this->db->where("d.District", $district);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("DistrictLevel",$order);
        $this->db->order_by("d.Status","DESC");
        $this->db->order_by("d.District",$order);
        $this->db->order_by("d.Level",$order);
        $this->db->order_by("d.Name",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getDistrictData_2($district, $status, $order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.District, d.Level, d.Status, p.Name as DistrictName, p.Level as DistrictLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_district p","d.District = p.ID");
        $this->db->where("d.District", $district);
        $this->db->where("d.Status", $status);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("DistrictLevel",$order);
        $this->db->order_by("d.Status","DESC");
        $this->db->order_by("d.District",$order);
        $this->db->order_by("d.Level",$order);
        $this->db->order_by("d.Name",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

}
?>
