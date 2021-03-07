<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mwb_statistics extends CI_Model{

    private $_table = "wb_statistics";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getAllData($order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
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

    function getToDayOnline(){
        $date = date("Y-m-d");
        $this->db->select('SUM(Hit) as Sum');
        $this->db->from($this->_table);
        $this->db->where("DATEDIFF(Dateset,'$date')",0);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }

    function getThisMonthOnline(){
        $date = date("Y-m-d");
        $this->db->select('SUM(Hit) as Sum');
        $this->db->from($this->_table);
        $this->db->where("YEAR(Dateset)",date("Y"));
        $this->db->where("MONTH(Dateset)",date("m"));
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }
    
    function getSumOnline(){
        $this->db->select('SUM(Hit) as Sum');
        $this->db->from($this->_table);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }
}
?>
