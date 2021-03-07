<?php
class Madmin_menu extends CI_Model{
    private $_table = "admin_menu";
    public function __construct(){
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
            return TRUE;
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
    /*get menu admin*/
    function adminMenu($permis, $pid, $status, $order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        if(is_numeric($pid)){
            $this->db->where("PID", $pid);
        }
        if(is_numeric($status)){
            $this->db->where("Status", $status);
        }
        if(is_numeric($permis)){
            $this->db->where("INSTR((select Permission from wb_tuser where ID = $permis), concat('[',Module,']'))");
        }
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("PID",$order);
        $this->db->order_by("Level",$order);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    /*get menu admin index*/

    function adminMenuIndex($permis,$type, $status, $order, $record_number, $record_start){
        $this->db->select('*');
        if(is_numeric($type)){
            $this->db->where("Type", $type);
        }
        if(is_numeric($status)){
            $this->db->where("Status", $status);
        }
        if(is_numeric($permis)){
            $this->db->where("INSTR((select Permission from wb_tuser where ID = $permis), concat('[',Module,']'))");
        }
        $this->db->from($this->_table);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("PID",$order);
        $this->db->order_by("Level",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getPidStatusData($pid, $status, $order, $record_number, $record_start){
        $this->db->select('*');
        $this->db->from($this->_table);
        if(is_numeric($pid)){
            $this->db->where("PID", $pid);
        }
        if(is_numeric($status)){
            $this->db->where("Status", $status);
        }
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("PID",$order);
        $this->db->order_by("Level",$order);
        $this->db->order_by("ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getTypeStatusData($type, $status, $order, $record_number, $record_start){
        $this->db->select('*');
        if(is_numeric($type)){
            $this->db->where("Type", $type);
        }
        if(is_numeric($status)){
            $this->db->where("Status", $status);
        }
        $this->db->from($this->_table);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("PID",$order);
        $this->db->order_by("Level",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
