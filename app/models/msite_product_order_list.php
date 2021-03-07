<?php
class Msite_product_order_list extends CI_Model{

    private $_table = "site_product_order_list";
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getOrderData($orderID, $record_number, $record_start){
        $this->db->select('l.*, p.Name as PName');
        $this->db->from($this->_table.' l, site_product p');
        $this->db->where('l.OrderID = ',$orderID);
        $this->db->where('l.Product = p.ID');
        $this->db->limit($record_number, $record_start);
        $this->db->order_by("l.ID",'ASC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>
