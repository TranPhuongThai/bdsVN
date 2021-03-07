<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mwb_online extends CI_Model{

    private $_table = "wb_online";
    
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
    
    function countOnline(){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }
    function getOnline($order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    // get user online (user = member or guess)

    function getUserOnline($order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("user !=", "guess");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    function countUserOnline(){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where("user !=", "guess");
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }
    function getGuessOnline($order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("user =", "guess");
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    function countGuessOnline(){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table);
        $this->db->where("user =", "guess");
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['Sum'];
    }
    function getDataBySessionID($session_id){
        $this->db->where("SessionID",$session_id);
        $query = $this->db->get($this->_table);
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
	public function delOnlineTime($time)
	{
        $this->db->where("Time <",$time);
        $this->db->delete($this->_table);
	}
}
?>
