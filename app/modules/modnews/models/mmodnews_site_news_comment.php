<?php
class Mmodnews_site_news_comment extends CI_Model{

    private $_table = "site_news_comment";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getNewsPIDData($type, $news, $pid, $order, $record_number, $record_start){
        $this->db->select('n.*');
        $this->db->from($this->_table." n");
        $this->db->where('n.News',(int)($news));
        $this->db->where('n.Type',(int)($type));
        $this->db->where('n.PID',$pid);
        $this->db->where('n.Status',1);
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("n.ID",$order);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    function countNewsPIDData($type, $news){
        $this->db->select('count(*) as Sum');
        $this->db->from($this->_table." n");
        $this->db->where('n.News',(int)($news));
        $this->db->where('n.Type',(int)($type));
        $this->db->where('n.PID',$pid);
        $this->db->where('n.Status',1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data[0]['Sum'];
    }

    function addData($data){
        if($this->db->insert($this->_table,$data))
            return $this->db->insert_id();
        else
            return FALSE;
    }
}
?>
