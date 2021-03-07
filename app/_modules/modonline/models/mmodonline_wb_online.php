<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mmodonline_wb_online extends CI_Model{

    private $_table = "wb_online";
    
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
    function updateDataBySessionID($data,$session_id){
        $this->db->where("SessionID",$session_id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
	public function delOnlineTime($time)
	{
        $this->db->where("Time < ",$time);
        $this->db->delete($this->_table);
	}
    function getDataBySessionID($session_id){
        $this->db->where("SessionID",$session_id);
        $query = $this->db->get($this->_table);
        if($query)
            return $query->row_array();
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
}
?>
