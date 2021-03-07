<?php
class Msite_add_district extends CI_Model{

    private $_table = "site_add_district";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.Province, d.Level, d.Status, p.Name as ProvinceName, p.Level as ProvinceLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_province p","d.Province = p.ID");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ProvinceLevel",$order);
        $this->db->order_by("d.Province",$order);
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

    function getProvinceData($province, $order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.Province, d.Level, d.Status, p.Name as ProvinceName, p.Level as ProvinceLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_province p","d.Province = p.ID");
        $this->db->where("d.Province", $province);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ProvinceLevel",$order);
        $this->db->order_by("d.Status","DESC");
        $this->db->order_by("d.Province",$order);
        $this->db->order_by("d.Level",$order);
        $this->db->order_by("d.Name",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getProvinceData_2($province, $status, $order, $record_number, $record_start){
        $this->db->select('d.ID, d.Name, d.Province, d.Level, d.Status, p.Name as ProvinceName, p.Level as ProvinceLevel');
        $this->db->from($this->_table." d");
        $this->db->join("site_add_province p","d.Province = p.ID");
        $this->db->where("d.Province", $province);
        $this->db->where("d.Status", $status);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ProvinceLevel",$order);
        $this->db->order_by("d.Status","DESC");
        $this->db->order_by("d.Province",$order);
        $this->db->order_by("d.Level",$order);
        $this->db->order_by("d.Name",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

}
?>
