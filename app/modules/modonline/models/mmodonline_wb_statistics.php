<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mmodonline_wb_statistics extends CI_Model{

    private $_table = "wb_statistics";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function addData($data){
        if($this->db->insert($this->_table,$data))
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function addHit(){
        $date = date("Y-m-d");
        $this->db->query("update ".$this->_table." set Hit = Hit+1 where DATEDIFF(Dateset,'$date') = 0");
        return TRUE;
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

    function getYesterdayOnline(){
        $date = _addDate(date("d/m/Y"),-1);
        $this->db->select('SUM(Hit) as Sum');
        $this->db->from($this->_table);
        $this->db->where("DATEDIFF(Dateset,'$date')",0);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }

    function getThisMonthOnline(){
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
